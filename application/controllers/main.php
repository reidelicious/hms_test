<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	 //index
	public function index()
	{
		$this->login();
	}
	
	//loginpage
	public function login(){
	
		if($this->session->userdata('is_logged_in') == 1){
			if($this->session->userdata('usertype') == "USER"){
				redirect('home');
			}else if($this->session->userdata('usertype') == "ADMIN"){
				redirect('add_user');
			}
			
			
		}else{
			$this->load->view('templates/header/header_all');
			$this->load->view('login');
		}	
		
		
	}
	
	//signup page
	public function signup(){
		$data['mail'] = ' ';
		$data['notif'] = ' ';
		$data['success'] = ' ';
		$this->load->view('templates/header/header_all');
		$this->load->view('user/signup',$data);
	}
	

	
	//restricted page
	public function restricted(){
		$this->load->view('restricted');
	}
	
	//login validation
	public function login_validation(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|xss_clean|callback_validate_credentials');
		//callback_validate_credentials will call validate_credentials() and return true or false
		$this->form_validation->set_rules('password', 'Password', 'required|md5|trim');	
		
		
		if($this->form_validation->run()){
			$this->load->model('model_users');
			
			$row = $this->model_users->what_userType();
			
			if($row->utype == "ADMIN"){
				$row =  $this->model_users->getAdmin_sessions($row->id);
				$data1 = array('id' => $row->id);
				
			}else if($row->utype == "USER"){
				$row =  $this->model_users->getUser_sessions($row->id);
				
				$data1 = array(
					'id' => $row->id,
					'address' => $row->p_address,
					'gender' =>$row->p_gender,
					'age' => $row->p_age
				);
				
			}
			
			$data2 = array(
				'email' => $this->input->post('email'),
				'is_logged_in'=> 1,
				'usertype'=> $row->utype,
				'fname' => $row->fname,
				'lname' => $row->lname,
				'avatar' => $row->avatar
				 
			);
			$data = array_merge($data1, $data2);
			$this->session->set_userdata($data);
			
			if($row->utype == "USER"){
				redirect('home');	
			}else if($row->utype == "ADMIN"){
				redirect('add_user');	
			}
				
		}else{
			$this->load->view('templates/header/header_all');
			$this->load->view('login');
		}
	}
	
	
	//main
	public function signup_validation(){
		$data['mail'] = ' ';
		$data['success'] = ' ';
		$data['notif'] = ' ';
		$this->load->library('form_validation');	
	
		$this->form_validation->set_message('is_unique',"That Email Address is already in use");
		if($this->form_validation->run('user_patient') ){
			
			if($this->input->post('usertype') == 1){
				$key = md5(uniqid());		
				$config = array(
					'mailtype' => 'html',
				);		
				$this->load->library('email', $config);
				$this->load->model('model_users');	
				$this->email->from('hms_administrator@gmail.com',"Administrator");
				$this->email->to($this->input->post('email'));
				$this->email->subject("Confirm you account.");
				$message  = "Hello ".$this->input->post('fname')." ".$this->input->post('lname')."!";
				$message .= "<p>Thank you for signing up!</p>";
				$message .="<p><a href ='".base_url()."main/register_user/$key'>Click here </a> to confirm your account</p>";
				
				$this->email->message($message);
				
				//send mail to the user
				if($this->model_users->add_temp_user($key)){
					if (!$this->email->send()){
						$data['mail'] = $this->ret_failmail_notif();
					}
					else{ 
						$data['mail'] = $this->ret_succmail_notif(); 
						$data['notif'] = "<script>var not = $.Notify({
										style: {background: 'BLUE', color: 'white'},
										caption: 'CONFIRMATION',
										content: 'CHECK YOUR EMAIL TO ACTIVATE YOUR ACCOUNT',
										timeout: 10000 // 10 seconds
											});					
										</script>";
				}
					
				}else{
					$data['success'] = $this->ret_fail_notif();
				}	
			}else {}//do nothing //**}
				
	    }//end of if
			$this->load->view('templates/header/header_all');
			$this->load->view('user/signup',$data);
		
	}//end of function

	
	
	public function validate_credentials(){
		$this->load->model('model_users');
		
		if($this->model_users->can_log_in()){
			return true;
		}else{
			$this->form_validation->set_message('validate_credentials', 'Incorrect username/passowrd.');
			return false;
		}
	}
	
	public function logout(){
		$this->session->sess_destroy();
		redirect('login');	
	}
	
	
	public function register_user($key){
		$this->load->model('model_users');
		
		if($this->model_users->is_key_valid($key)){
			if($newemail =  $this->model_users->add_user($key)){
				
				$data = array(
				'email' => $newemail,
				'is_logged_in' => 1,
				'usertype' => 'USER' ,
				);
			
				
				$this->session->set_userdata($data);
				redirect('main/members');
			}else{
				show_404();
			}
		}else{
			
			
			echo "invalid key";
		}
		
	}
	
		public function edituser_validation(){
		echo "lalala";
		$this->load->library('form_validation');			
		$this->load->model('model_users');		
		$data['mail'] = ' ';
		$data['success'] = ' ';
			
		if($this->form_validation->run('edit_users')){		
			if($this->model_users->edit_adminifo($this->input->post('id'))){
				$this->settings();
			}
			
			
		}else{
			echo "not run";
			$this->settings();
		}

		
	}// end of adduservalidation
	
	public function settings(){
		$data['success'] = ' ';
		
		if($this->session->userdata('is_logged_in') == 1){
			$this->load->view('templates/header/header_all');
			
			if($this->session->userdata('usertype') == "USER"){
				$this->load->view('templates/header/header_patient');
				$this->load->view('settings',$data);
				
			}else if($this->session->userdata('usertype') == "ADMIN"){
				$this->load->view('templates/header/navbar_admin');
				$this->load->view('settings',$data);
				$this->load->view('templates/footer/footer_admin');
				
			}
			
			
		}else{
			$this->load->view('templates/header/header_all');
			$this->load->view('login');
		}			
}
	



	

	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */