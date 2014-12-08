<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Patient extends CI_Controller {
		
	
	
		// patient
	public function home(){
		if($this->session->userdata('is_logged_in')){
			$this->load->view('templates/header/header_all');
			$this->load->view('templates/header/header_patient');
			$this->load->view('patient/home');
		}else{
			redirect('main/restricted');
		}	
	}
	
	public function explore(){
		
	
		
		$this->load->view('templates/header/header_all');
		$this->load->view('templates/header/header_patient');
		$this->load->view('patient/explore',$data);
	}
	
	
	public function explore_doctors(){
		
	}
	
	
	
	
	
}
