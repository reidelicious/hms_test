<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Patient extends CI_Controller {
	
		// patient
	public function home(){
		$data['title'] = 'Hospital Management System';
		if($this->session->userdata('is_logged_in')){
			$this->load->view('templates/header/header_all',$data);
			$this->load->view('templates/header/header_patient');
			$this->load->view('patient/home');
		}else{
			redirect('main/restricted');
		}	
	}
	
	public function explore(){
		redirect('patient/doctors');
	}// end of explore
	
	public function clinics(){
		$this->load->model('model_users');
		$data['title'] = 'Explore Doctors or Clinic';
		
		$category = $this->model_users->browse_category();
		$data['output'] = '<div class="listview-outlook" data-role="listview">';
		
		foreach($category as $c){
			$clinic = $this->model_users->browse_clinic_name($c->specialist_id);
			
			$data['output'] .= '<div class="list-group collapsed ">';
			$data['output'] .= '<a href="" class="group-title">'.$c->specialist.'</a>';
			$data['output'] .=  '<div class="group-content">';
			
			foreach($clinic as $i){
				$dcount = $this->model_users->count_doctors($i->clinic_id);
				  $data['output'].='<a class="list marked" href="#">';
          		  $data['output'].='	<div class="list-content">';
          		  $data['output'].='		<span class="list-title"> '.$i->clinic_name.'</span>';
          		  $data['output'].='		<span class="list-subtitle">room number here</span>';
           		  $data['output'].='		<span class="list-remark">There are '.$dcount.' doctors in this clinic</span>';
           		  $data['output'].='	</div>';
             	  $data['output'].='</a>';	
			}//foreach
			$data['output'] .=  '</div>'; // content
			$data['output'] .=  '</div>'; // listgroyp
		}
		$data['output'] .= '</div>';
	
	$this->load->view('templates/header/header_all', $data);
    $this->load->view('templates/header/header_patient');
	$this->load->view('patient/explore_clinic',$data);
	
	}
	
	public function doctors(){
		$data['title'] = 'Explore Doctors or Clinic';
		$this->load->model("model_users");
		$config = array();
		$config['base_url'] = base_url('patient/doctors/page/');
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
		
		$this->load->view('templates/header/header_all', $data);
		$this->load->view('templates/header/header_patient');
		$this->load->view('patient/explore',$data);
		
	}
	public function appointment(){
		$this->load->model('model_users');
		$data['title'] = 'appointment';
		$data['specialization'] = $this->model_users->get_Specialists();
		$this->load->view('templates/header/header_all',$data);
		$this->load->view('templates/header/header_patient');
		$this->load->view('patient/appointment', $data);
		
	}
	public function appointmentv2(){
		$this->load->model('model_users');
		$data['title'] = 'appointment';
		$data['specialization'] = $this->model_users->get_Specialists();
		$this->load->view('templates/header/header_all',$data);
		$this->load->view('templates/header/header_patient');
		$this->load->view('patient/appointmentv2', $data);
	}
	public function build_timeline_appointment(){
		$this->load->model('model_users');
		$d = $_POST['d'];
		$data['appointment'] = $this->model_users->getAppointments($d);
		if($data['appointment']){
			$this->load->view('templates/header/header_all');
			$this->load->view('patient/appointment_details', $data);
		}
		else{
			echo "No Appointment";
		}
	}

	public function build_drop_clinic_fromCategory(){
		$id = $_POST['category'];
		$this->load->model('model_users');
		$data['clinic'] = $this->model_users->getClinicByCategory($id);
        
       $output = null;
       $output .= "<option value='' disabled default selected class='display-none'>Select Clinic</option>";
        foreach ($data['clinic'] as $s)
        {
            $output .= "<option value='".$s->clinic_id."'>".$s->clinic_name."</option>";
        }

        echo  $output;
	}

	public function build_drop_doctor_fromCategory(){
		$id = $_POST['category'];
		$this->load->model('model_users');
		$data['doctor'] = $this->model_users->getDoctorByCategory($id);
        
       $output = null;
       $output .= "<option value='' disabled default selected class='display-none'>Select Doctor</option>";
        foreach ($data['doctor'] as $s)
        {
            $output .= "<option value='".$s->d_id."'> Dr. ".$s->lname."</option>";
        }

        echo  $output;
	}
	
	public function build_drop_doctor_fromClinic(){
		$spec = $_POST['doctor'];
		$cate = $_POST['category'];
		$this->load->model('model_users');
		$data['doctor'] = $this->model_users->getDoctorByClinic($spec, $cate);
        
       $output = null;
       $output .= "<option value='' disabled default selected class='display-none'>Select Doctor</option>";
        foreach ($data['doctor'] as $s)
        {
            $output .= "<option value='".$s->d_id."'> Dr. ".$s->lname."</option>";
        }

        echo  $output;
	}

	public function build_drop_schedule(){
		$id = $_POST['doctor'];
		$d = $_POST['day'];
		$this->load->model('model_users');
		$row = $this->model_users->getSchedule($id, $d);
		if($row){
			$timestart = date("g:i a", strtotime($row[0]->time_start));
			$timeend = date("g:i a", strtotime($row[0]->time_end));	
			$output = null;
			$output .= $timestart." - ".$timeend."";
			echo $output;
		}
		else{
			echo "Not Yet Available!";
		}
		
	}

	public function build_time_start(){
		$id = $_POST['doctor'];
		$d = $_POST['day'];
		$this->load->model('model_users');
		$row = $this->model_users->getSchedule($id, $d);
		if($row){
			//$timestart = date("h:i", strtotime($row[0]->time_start));
			//echo $timestart;
			echo $row[0]->time_start;
		}
		else{
			echo "Not Yet Available!";
		}
	}

	public function build_time_end(){
		$id = $_POST['doctor'];
		$d = $_POST['day'];
		$this->load->model('model_users');
		$row = $this->model_users->getSchedule($id, $d);
		if($row){
			//$timeend = date("H:i", strtotime($row[0]->time_end));
			//echo $timeend;
			echo $row[0]->time_end;
		}
		else{
			echo "Not Yet Available!";
		}
	}
	public function saveAppointmentToDB(){
		$arr = $_POST['arr'];
		$this->load->model('model_users');
		$this->model_users->patient_addAppointment($arr);
	}
	public function arrange_alphabetically($letter){
		
		if (ctype_alpha($letter)) {}
		else{echo "not a letter";}
		$this->load->view('templates/header/header_all');
		$this->load->view('templates/header/header_patient');
		$this->load->view('patient/explore',$data);
		
	}
	
	public function search_results(){
		$this->load->model('model_users');
		$item = $this->input->post('search');
		$data['s_doctor'] = $this->model_users->search_doctors('T');
		$data['s_clinic'] = $this->model_users->search_clinics($item);
		
		print_r($data['s_doctor']);
		
	//	$result['s_result'] = array_merge($data['s_doctor'], $data['s_clinic']);
		
	/*	if($result['s_result'] != NULL){
			echo 'fcuk';
		}else{echo "hear";}
		*/
			
	
	}
	
	
	
}
