<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Doctor extends CI_Controller {
	public function home_doctor(){
		if($this->session->userdata('is_logged_in')){
			$this->load->view('templates/header/header_all');
			$this->load->view('templates/header/header_doctor');
			$this->load->view('doctor/home_doctor');
		}else{
			redirect('main/restricted');
		}	
	}
}