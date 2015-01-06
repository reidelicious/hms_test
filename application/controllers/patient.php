<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Patient extends CI_Controller {
		
	
	
		// patient
	public function home(){
		$data['title'] = 'home';
		if($this->session->userdata('is_logged_in')){
			$this->load->view('templates/header/header_all',$data);
			$this->load->view('templates/header/header_patient');
			$this->load->view('patient/home');
		}else{
			redirect('main/restricted');
		}	
	}
	
	public function explore(){
		$this->load->model("model_users");
		$config = array();
		$config['base_url'] = base_url('patient/explore/page/');
		$config["total_rows"] = $this->model_users->doctor_count();
        $config['per_page'] = 10;
        $config["uri_segment"] = '4';
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

		$array = $this->uri->uri_to_assoc(4);
		
		
		$this->pagination->initialize($config);
		
		if($this->uri->segment(3) == "page" ||$this->uri->segment(3) === FALSE){
			if($this->uri->segment(4)){		
				$page = ( $this->uri->segment(4)* $config['per_page'])-10;
			}else{ $page = 0;}
	
		
		   // $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 1;
			$data["results"] = $this->model_users->
				fetch_doctors($config['per_page'], $page );
			$data["links"] = $this->pagination->create_links();
		}else{
		
			$data["results"] = $this->model_users->fetch_doctors_alpha($this->uri->segment(4));
			$data["links"] = '';
			
		}
		
		$this->load->view('templates/header/header_all');
		$this->load->view('templates/header/header_patient');
		$this->load->view('patient/explore',$data);
	}// end of explore
	
	
	public function explore_doctors(){
		
		
	}
	public function appointment(){
		$data['title'] = 'appointment';
		$this->load->view('templates/header/header_all',$data);
		$this->load->view('templates/header/header_patient');
		$this->load->view('patient/appointment');
		
	}
	
	public function arrange_alphabetically($letter){
		
		if (ctype_alpha($letter)) {}
		else{echo "not a letter";}
		$this->load->view('templates/header/header_all');
		$this->load->view('templates/header/header_patient');
		$this->load->view('patient/explore',$data);
		
	}
	
	
	
	
	
}
