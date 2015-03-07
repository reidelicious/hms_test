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
		$data['title'] = "DAS";
	
		if($this->session->userdata('is_logged_in') == 1){
			if($this->session->userdata('usertype') == "USER"){
				redirect('home');
			}else if($this->session->userdata('usertype') == "ADMIN"){
				redirect('add_user');
			}
		}else{
			$this->load->view('templates/header/header_all',$data);
			$this->load->view('login');
		}	
		
		
	}

	//signup page
	public function signup(){
		$data['title'] = "Signing Up!";
		$data['mail'] = ' ';
		$data['notif'] = ' ';
		$data['success'] = ' ';
		$this->load->view('templates/header/header_all',$data);
		$this->load->view('user/signup',$data);
	}
	

	
	//restricted page
	public function restricted(){
		$this->load->view('restricted');
	}
	
	//login validation
	public function login_validation(){
		$data['title'] = "DAS";
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
					'p_id' => $row->p_id,
					'address' => $row->p_address,
					'gender' =>$row->p_gender,
					'age' => $row->p_age
				);
				
			}else if($row->utype == "DOCTOR"){
				$row = $this->model_users->getDoctor_sessions($row->id);

				$data1 = array(
					'id' =>	$row->id,
					'd_id' => $row->d_id,
					'contactnum' => $row->contact_num,
					'clinic_id' => $row->clinic
				);
			}
			
			$data2 = array(
				'email' => $this->input->post('email'),
				'is_logged_in'=> 1,
				'usertype'=> $row->utype,
				'fname' => $row->fname,
				'lname' => $row->lname,
				'avatar' => $row->avatar,
				'timeline' => $row->timeline
				 
			);
			$data = array_merge($data1, $data2);
			$this->session->set_userdata($data);
			
			if($row->utype == "USER"){
				redirect('home');	
			}else if($row->utype == "ADMIN"){
				redirect('add_user');	
			}else if($row->utype == "DOCTOR"){
				redirect('home_doctor');
			}
				
		}else{
			$this->load->view('templates/header/header_all',$data);
			$this->load->view('login');
		}
	}
	
	
	//main
	public function signup_validation(){
		$data['title'] = "sign up";
		$data['mail'] = ' ';
		$data['success'] = ' ';
		$data['notif'] = ' ';
		$this->load->library('form_validation');	
	
		$this->form_validation->set_message('is_unique',"That Email Address is already in use");
		if($this->form_validation->run('user_patient') ){
			
			if($this->input->post('usertype') == 1){
				$key = md5(uniqid());		
				
				$this->load->library('email');	
			
				$this->load->model('model_users');	
				$this->email->from('reideliciouss@gmail.com',"Administrator");
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
										style: {background: '#008287' , color: 'white'},
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
			$this->load->view('templates/header/header_all',$data);
			$this->load->view('user/signup',$data);
		
	}//end of function

	
	
	public function validate_credentials(){
		$this->load->model('model_users');
		
		if($this->model_users->can_log_in()){
			return true;
		}else{
			$this->form_validation->set_message('validate_credentials', 'Incorrect username/password.');
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
				
				redirect('main/index');
			}else{
				show_404();
			}
		}else{
			
			
			echo "invalid key";
		}
		
	}
	
		
	public function editinfo_notif_succ(){
		
		return"<script>var not = $.Notify({
						style: {background: 'green', color: 'white'},
						caption: 'update info ',
						content: 'update info SUCCESS!!!',
						timeout: 10000 // 10 seconds
							});
						
						</script>";
	}

	public function edittheme_notif_succ(){
		
		return"<script>var not = $.Notify({
						style: {background: 'green', color: 'white'},
						caption: 'Update Theme Success',
						timeout: 10000 // 10 seconds
							});
						
						</script>";
	}

	public function editinfo_notif_fail(){
		
		return"<script>var not = $.Notify({
						style: {background: 'red', color: 'white'},
						caption: 'update info ',
						content: 'update info fail!!!',
						timeout: 10000 // 10 seconds
							});
						
						</script>";
	}
	
	public function edituser_validation(){
			$data['title'] = "edit user";		
			$this->load->library('form_validation');
			$this->load->model('model_users');	
			$data['success'] = ' ';	
			$data['error'] = ' ';	
		
		
			$this->form_validation->set_rules('fname', 'Fname', 'required|trim');
			$this->form_validation->set_rules('lname', 'lname', 'required|trim');
			if($this->session->userdata('usertype') == "USER"){
				$this->form_validation->set_rules('age', 'age', 'required|trim');
				$this->form_validation->set_rules('address', 'address', 'required|trim');
			}else{}
			
			if($this->session->userdata('usertype') == "USER"){	
				if($this->form_validation->run()){		
					if($this->model_users->edit_userinfo()){
						$data['success'] = $this->editinfo_notif_succ();
						$this->session->set_userdata($data);
					}else{
					$data['success'] = $this->editinfo_notif_fail();	
					}
				}
				$this->load->view('templates/header/header_all',$data);
				$this->load->view('templates/header/header_patient');
				$this->load->view('settings',$data);
					
			}else if($this->session->userdata('usertype') == "ADMIN"){
				if($this->form_validation->run()){		
					if($this->model_users->edit_admininfo()){
						$data['success'] = $this->editinfo_notif_succ();					
					}else{
					$data['success'] = $this->editinfo_notif_fail();	
					}
					
					$this->load->view('templates/header/header_all',$data);
					$this->load->view('templates/header/navbar_admin');
					$this->load->view('settings',$data);
					$this->load->view('templates/footer/footer_admin');
				}else{}	
			}else if($this->session->userdata('usertype') == "DOCTOR"){
				if($this->form_validation->run()){		
					if($this->model_users->edit_doctorinfo()){		
					
						$data['success'] = $this->editinfo_notif_succ();
					}else{
							$data['success'] = $this->editinfo_notif_fail();
					}
					
					$this->load->view('templates/header/header_all',$data);
					$this->load->view('templates/header/header_doctor');
					$this->load->view('settings',$data);
				
				}else{}
			}else{}
		
	}// end of adduservalidation

	public function changeColor(){
		$data['title'] = "Settings";	
		$data['error'] = '';
		$this->load->model('model_users');
		if($this->model_users->changeColor()){
			$color = array('timeline' => $this->input->post('r1'));
			$data['success'] = $this->edittheme_notif_succ();
			$this->session->set_userdata($color);
		}else{
			$data['success'] = $this->editinfo_notif_fail();	
		}
		$this->load->view('templates/header/header_all',$data);			
		if($this->session->userdata('usertype') == "USER"){
			$this->load->view('templates/header/header_patient');
			$this->load->view('settings',$data);				
		}else if($this->session->userdata('usertype') == "ADMIN"){
			$this->load->view('templates/header/navbar_admin');
			$this->load->view('settings',$data);
			$this->load->view('templates/footer/footer_admin');	
		}else if($this->session->userdata('usertype') == "DOCTOR"){
			$this->load->view('templates/header/header_doctor');
			$this->load->view('settings',$data);
		}
	}
	
	public function settings(){
		$data['title'] = "settings";
		$data['success'] = ' ';
		$data['error'] = ' ';	
		if($this->session->userdata('is_logged_in') == 1){
			$this->load->view('templates/header/header_all',$data);			
			if($this->session->userdata('usertype') == "USER"){
				$this->load->view('templates/header/header_patient');
				$this->load->view('settings',$data);				
			}else if($this->session->userdata('usertype') == "ADMIN"){
				$this->load->view('templates/header/navbar_admin');
				$this->load->view('settings',$data);
				$this->load->view('templates/footer/footer_admin');	
			}else if($this->session->userdata('usertype') == "DOCTOR"){
				$this->load->view('templates/header/header_doctor');
				$this->load->view('settings',$data);
			}
		}else{
			$this->load->view('templates/header/header_all',$data);
			$this->load->view('login');
		}				
	}

	public function editpass_notif_succ(){	
		return"<script>var not = $.Notify({
						style: {background: 'green', color: 'white'},
						caption: 'PASSWORD ',
						content: 'update password SUCCESS!!!',
						timeout: 10000 // 10 seconds
							});
						
						</script>";
	}

	public function editpass_notif_error(){
		$retval = "<script>var not = $.Notify({
						style: {background: 'red', color: 'white'},
						caption: 'PASSWORD ', 
						timeout: 10000 ,
						content: 'fail to update password' 
					});
						
						</script>";
		
		return $retval;			
	}

	public function editPassword_validation(){
			$data['success'] = ' ';	
			$data['error'] = ' ';	
			$this->load->library('form_validation');			
			$this->load->model('model_users');		
		
			$this->form_validation->set_message('check_passmatch', 'the password must not be the same as the old password');
			$this->form_validation->set_message('check_oldpass', 'Please enter correct old password');
			if($this->form_validation->run('edit_password')){		
				if($this->model_users->edit_password($this->session->userdata('id'))){
					$data['success'] = $this->editpass_notif_succ();
				}else{}
			}else{
					$data['success'] = $this->editpass_notif_error();		
			}	
				if($this->session->userdata('usertype') == "USER"){
					$this->load->view('templates/header/header_all',$data);
					$this->load->view('templates/header/header_patient');
					$this->load->view('settings',$data);		
				}else if($this->session->userdata('usertype') == "ADMIN"){
					$this->load->view('templates/header/header_all',$data);
					$this->load->view('templates/header/navbar_admin');
					$this->load->view('settings',$data);
					$this->load->view('templates/footer/footer_admin');	
				}else if($this->session->userdata('usertype') == "DOCTOR"){
					$this->load->view('templates/header/header_all',$data);
					$this->load->view('templates/header/header_doctor');
					$this->load->view('settings',$data);
		
					
				}
		}// end of editPassword
	
	public function check_passmatch(){
		if($this->input->post('oldPassword') == $this->input->post('password')){
			return false;
		}
		else return true;
	
	}
	public function check_oldpass(){
		$this->load->model('model_users');	
		if($this->model_users->checkOldPass($this->session->userdata('id'))){
			return true;
		}
		else return false;	
	}


	public function upload_notif_succ(){
		return"<script>var not = $.Notify({
						style: {background: 'green', color: 'white'},
						caption: 'avatar ',
						content: 'Avatar successfully changed',
						timeout: 10000 // 10 seconds
							});
						
						</script>";
	}

	public function upload_notif_error(){	
		$retval = "<script>var not = $.Notify({
						style: {background: 'red', color: 'white'},
						caption: 'avatar ', 
						timeout: 10000 ,
						content: 'FAIL!!' 
					});
						
						</script>";	
		return $retval;     		
	}

public function do_upload()
	{
		$data['title'] = "settings";
		$this->load->model('model_users');	
		$data['success'] = '';	
		$data['error'] = ' ';		
		$config['max_size']	= '10000';
		$config['max_width']  = '0';
		$config['max_height']  = '0';
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'gif|jpg|png';

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload())
		{
			$data['error'] = $this->upload->display_errors();
			$data['success'] = $this->upload_notif_error();
		}
		else
		{	
			$upload_data = $this->upload->data();
			$file_name = $upload_data['file_name'];
		     $file_name = 'uploads/'.$file_name;			 
			 if($this->model_users->updateAvatar($file_name)){
				$data['success'] = $this->upload_notif_succ();
			}else{}	
		}
		if($this->session->userdata('usertype') == "USER"){
				$this->load->view('templates/header/header_all',$data);
				$this->load->view('templates/header/header_patient');
				$this->load->view('settings',$data);
				
		}
		else if($this->session->userdata('usertype') == "ADMIN"){
			$this->load->view('templates/header/header_all',$data);
				$this->load->view('templates/header/navbar_admin');
				$this->load->view('settings',$data);
				$this->load->view('templates/footer/footer_admin');	
		}else if($this->session->userdata('usertype') == "DOCTOR"){
				$this->load->view('templates/header/header_all',$data);
				$this->load->view('templates/header/header_doctor');
				$this->load->view('settings',$data);

			
		}
	}
	public function makeAnnouncement_validation(){
		$this->load->library('form_validation');		
		$type = $this->session->userdata('clinic_id')? $this->session->userdata('clinic_id') : 0;
			$this->load->model('model_users');
			if($this->model_users->addAnnouncement($type)){
				echo "Success";
			}else{
				echo "Fail";
			}
	}
	public function announcement_details(){
		$id = $_POST['id'];
		$this->load->model('model_users');
		$data['details'] = $this->model_users->fetchAnnouncementsByID($id);
		echo 
			"
			<span class='place-right'>".$data['details'][0]->announcement_datetime_made."</span>
			<em>".$data['details'][0]->clinic_name."</em>
			<dl class='horizontal'>
				<dt>Subject</dt>
				<dd>".$data['details'][0]->announcement_subject."</dd>
				<dt>Details</dt>
				<dd>".$data['details'][0]->announcement_details."</dd>
			</dl>";
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
				 	style: {background: '#4390df', color: 'white'},
    				caption: 'MAIL SUCCESS',
       				content: 'SEND to EMAIL  SUCCESS!!!',
      			  	timeout: 10000 // 10 seconds
						});
					
					</script>";	
	}	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */