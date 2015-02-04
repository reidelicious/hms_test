<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Doctor extends CI_Controller {
	public function home_doctor(){
		$data['title'] = 'Hospital Management System';
		if($this->session->userdata('is_logged_in')){
			$this->load->model('model_users');
			$data['countTotApp'] = $this->model_users->countDoctorAppointments(0);
			$data['countPenApp'] = $this->model_users->countDoctorAppointments(1);
			$data['countOKApp'] = $this->model_users->countDoctorAppointments(2);
			$data['countRejApp'] = $this->model_users->countDoctorAppointments(3);
			$data['announcements'] = $this->model_users->fetchAnnouncements();
			$this->load->view('templates/header/header_all', $data);
			$this->load->view('templates/header/header_doctor');
			$this->load->view('doctor/home_doctor', $data);
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
	public function manage_schedules(){
		$data['success'] = '';
		$data['title'] = 'Manage Schedules';
		$this->load->view('templates/header/header_all',$data);	
		$this->load->view('templates/header/header_doctor');
		$this->load->view('doctor/manage_schedules', $data);	
	}

	public function is_schedule_unique(){
		$this->load->model('model_users');
		$date = $_POST['day'];
		$result = $this->model_users->check_schedule($date);
		print_r($result);
		if($result > 0)
			return 1;
		else
			return 0;
	}

	public function manage_schedule_toDB(){
		$this->load->model('model_users');
		$a = $_POST['arr'];		
		$flag = $_POST['flag'];
		if($flag == 0)
			$this->model_users->add_schedule_forDoctor($a);
		else
			$this->model_users->overwrite_schedule_forDoctor($a);
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

	public function manage_appointment(){
		$this->load->model('model_users');
		$data['title'] = 'Manage Appointment';
		$data['pending'] = $this->model_users->getPendingAppointments();
		if($this->session->userdata('is_logged_in')){
			$this->load->view('templates/header/header_all', $data);
			$this->load->view('templates/header/header_doctor');
			$this->load->view('doctor/manage_appointment', $data);
		}else{
			redirect('main/restricted');
		}	
	}

	public function changeStat_appointment(){
		$id = $_POST['id'];
		$flag = $_POST['flag'];
		$this->load->model('model_users');
		if($this->model_users->updateStatus_appointment($id, $flag)){
			echo "Success";
		}
		else{
			echo "Fail";
		}
	}
	public function view_appointment(){
		$data['title'] = 'View Timeline';
		if($this->session->userdata('is_logged_in')){
			$this->load->view('templates/header/header_all', $data);
			$this->load->view('templates/header/header_doctor');
			$this->load->view('doctor/view_appointment');
		}else
			redirect('main/restricted');
	}
	public function build_timeline_doctor(){
		$this->load->model('model_users');
		$d = $_POST['d'];
		$data['appointment'] = $this->model_users->getPatientsAppointments($d);
		if($data['appointment']){
			$this->load->view('templates/header/header_all');
			$this->load->view('doctor/appointment_details_doctor', $data);
		}
		else{
			echo "No Appointment";
		}
	}
}