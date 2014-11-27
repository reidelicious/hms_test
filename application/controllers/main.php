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
				redirect('members');
			}else if($this->session->userdata('usertype') == "ADMIN"){
				redirect('admin');
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
	
	// patient
	public function members(){
		if($this->session->userdata('is_logged_in')){
			$this->load->view('user/members');
		}else{
			redirect('main/restricted');
		}	
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
			$data = array(
				'email' => $this->input->post('email'),
				'is_logged_in'=> 1,
				'usertype'=> $row->utype,
				'fname' => $row->fname,
				'lname' => $row->lname,
				'avatar' => $row->avatar
				 
			);
			$this->session->set_userdata($data);
			
			if($row->utype == "USER"){
				redirect('members');	
			}else if($row->utype == "ADMIN"){
				redirect('admin');	
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
	
public function admin(){
	
$data['mail'] = '';
	$data['success'] = '';

		if($this->session->userdata('usertype') == "ADMIN"){
			$this->load->view('templates/header/header_all');
			$this->load->view('templates/header/navbar_admin');
			$this->load->view('admin/admin',$data);
		}else{
			show_404();
		}		
	}
	public function view_user(){
		if($this->session->userdata('usertype') == "ADMIN"){
			$tmpl = array('table_open' => '<table class="table striped hovered dataTable" id="dataTables-1">');
			$this->table->set_template($tmpl);
			$this->table->set_heading('id', 'email', 'fname','lname','utype','action');
			
			$this->load->view('templates/header/header_all');
			$this->load->view('templates/header/navbar_admin');
			$this->load->view('admin/view_user');
			$this->load->view('templates/footer/footer_admin');
		}else{
			show_404();
		}		
	}
	
	public function datatable(){
        $this->datatables->select('id,email,fname,lname,utype')
			->add_column('action', get_buttons('$1'), 'id')
            ->from('users');
 
        echo $this->datatables->generate();
    }
	
	public function deleteUser($id){
		$this->load->model('model_users');
		if($this->model_users->deleteUserFromDB($id)){
			
				echo "success";
		}else{
			echo "invalid id";
		}	
	}
	
	public function editUserInfo(){
		
		$this->load->model('model_users');
		
		if($this->model_users->edit_user()){
					echo "success";
					
		}else{
			echo $this->input->post('uiD');
			echo "error";
		}	
	
	}
	
	public function ret_success_notif(){
		
		return "<script>var not = $.Notify({
				 	style: {background: 'green', color: 'white'},
    				caption: 'DATABASE',
       				content: 'add to database success!!!',
      			  	timeout: 10000 // 10 seconds
						});
					
					</script>";
		
	}
	
	public function ret_fail_notif(){
		
		return "<script>var not = $.Notify({
				 	style: {background: 'RED', color: 'white'},
    				caption: 'DATABASE',
       				content: 'add to database FAIL!!!',
      			  	timeout: 10000 // 10 seconds
						});
					
					</script>";
		
	}
	
	
	public function ret_failmail_notif(){
		return "<script>var not = $.Notify({
				 	style: {background: 'red', color: 'white'},
    				caption: 'MAIL FAIL',
       				content: 'SEND to EMAIL  FAIL!!!',
      			  	timeout: 10000 // 10 seconds
						});
					
					</script>";
	}
	
	public function ret_succmail_notif(){
	 return "<script>var not = $.Notify({
				 	style: {background: '#00EEFF', color: 'white'},
    				caption: 'MAIL SUCCESS',
       				content: 'SEND to EMAIL  SUCCESS!!!',
      			  	timeout: 10000 // 10 seconds
						});
					
					</script>";	
	}	
	public function addUser_validation(){
		$this->load->library('form_validation');	
			$config = array(
					'mailtype' => 'html',
				);		
				
		$data['mail'] = ' ';
		$data['success'] = ' ';
		$this->load->library('email', $config);
		$this->load->model('model_users');	
		

		
		if($this->input->post('utype') == 1){//user	
			if($this->form_validation->run('user_patient')){		
				$this->email->from('hms_administrator@gmail.com',"Administrator");
				$this->email->to($this->input->post('email'));
				$this->email->subject("Your Account");
				$message  = "Hello ".$this->input->post('fname')." ".$this->input->post('lname')."!";
				$message .= "<p>The credentials for your account is ".$this->input->post('email') ."</p>";
				$message .= "<p> and the password is ".$this->input->post('password') ."</p>";	
				$this->email->message($message);
				
				//send mail to the user
				if($this->model_users->admin_addUser()){
					$data['success'] = $this->ret_success_notif();
					if (!$this->email->send()){
						$data['mail'] = $this->ret_failmail_notif();
					}
					else 
						$data['mail'] = $this->ret_succmail_notif(); 		
				}else
					$data['success'] = $this->ret_fail_notif();
					
			}else {}//do nothing //**}
	
		}else if($this->input->post('utype') == 2){//doctor
	
		}else if($this->input->post('utype') == 3){//admin
			if($this->form_validation->run('users')){		
				$this->email->from('hms_administrator@gmail.com',"Administrator");
				$this->email->to($this->input->post('email'));
				$this->email->subject("Your Account");
				$message  = "Hello ".$this->input->post('fname')." ".$this->input->post('lname')."!";
				$message .= "<p>The credentials for your account is ".$this->input->post('email') ."</p>";
				$message .= "<p> and the password is ".$this->input->post('password') ."</p>";	
				$this->email->message($message);
				
					//send mail to the user
				if($this->model_users->admin_addUser()){
					$data['success'] = $this->ret_success_notif();
					if (!$this->email->send()){
						$data['mail'] = $this->ret_failmail_notif();
					}
					else 
						$data['mail'] = $this->ret_succmail_notif(); 		
				}else{
					$data['success'] = $this->ret_fail_notif();
				}	
			
			}else{
			  //do nothing
		
			}			
		}
		$this->load->view('templates/header/header_all');
		$this->load->view('templates/header/navbar_admin');
		$this->load->view('admin/admin',$data);
	}
	
	public function makeAnnouncement(){
		$this->load->view('templates/header/header_all');
		$this->load->view('templates/header/navbar_admin');
		$this->load->view('makeAnnouncement');	
	}
	
	public function makeAnnouncement_validation(){
		$this->load->library('form_validation');		
		$this->form_validation->set_rules('subject','Subject','required|trim');
		$this->form_validation->set_rules('details','Details','required|trim');
		
		if($this->form_validation->run()){
			$this->load->model('model_users');
			if($this->model_users->addAnnouncement()){
				echo "Successfully added";
		}
		}
		else{
			
			$this->makeAnnouncement();
		}
		
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */