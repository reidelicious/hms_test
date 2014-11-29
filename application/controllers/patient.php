<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Patient extends CI_Controller {
	
	//marjun git test part 2
	
	
	
	
	public function explore(){
		
		$this->load->view('templates/header/header_all');
		$this->load->view('templates/header/header_patient');
		$this->load->view('patient/explore');
	}
	
	
	
	
	
	
}