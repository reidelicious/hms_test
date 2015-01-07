<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Doctor extends CI_Controller {
	public function home_doctor(){
		$data['title'] = 'Hospital Management System';
		if($this->session->userdata('is_logged_in')){
			$this->load->view('templates/header/header_all', $data);
			$this->load->view('templates/header/header_doctor');
			$this->load->view('doctor/home_doctor');
		}else{
			redirect('main/restricted');
		}	
	}
	public function makeAnnouncement(){
		$data['success'] = '';
		$data['title'] = 'Make Announcement';
		$this->load->view('templates/header/header_all',$data);	
		$this->load->view('templates/header/header_doctor');
		$this->load->view('makeAnnouncement', $data);	
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