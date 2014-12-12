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
		$this->load->model("model_users");
        $this->load->library("pagination");
		
		$config = array();
		$config['base_url'] = base_url('patient/explore');
		$config["total_rows"] = $this->model_users->doctor_count();

        $config["per_page"] = 1;
        $config["uri_segment"] = 3;
$config['use_page_numbers'] = TRUE;
		
		
$config['full_tag_open'] = '<ul>';
$config['full_tag_close'] = '</ul>';

$config['prev_link'] = '&lt;';
$config['prev_tag_open'] = '<li>';
$config['prev_tag_close'] = '</li>';
$config['next_link'] = '&gt;';
 
$config['next_tag_open'] = '<li>';
$config['next_tag_close'] = ' </li>';

$config['cur_tag_open'] = '<li class="active"><a href="#">';
$config['cur_tag_close'] = '</a></li>';

$config['num_tag_open'] = '<li>';
$config['num_tag_close'] = '</li>';
 
$config['first_tag_open'] = '<li>';
$config['first_tag_close'] = '</li>';
$config['last_tag_open'] = '<li>';
$config['last_tag_close'] = '</li>';
 
$config['first_link'] = '&lt;&lt;';
$config['last_link'] = '&gt;&gt;';

		

		
		$this->pagination->initialize($config);
 
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 1;
		$data["results"] = $this->model_users->
            fetch_doctors($config['per_page'], $page-1);
		$data["links"] = $this->pagination->create_links();
		
		$this->load->view('templates/header/header_all');
		$this->load->view('templates/header/header_patient');
		$this->load->view('patient/explore',$data);
	}
	
	
	public function explore_doctors(){
		
		
	}
	
	
	
	
	
}
