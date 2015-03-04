<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Doctor extends CI_Controller {
	public function home_doctor(){
		$data['title'] = 'DAS';
		$this->load->model('model_users');
		$data['countTotApp'] = $this->model_users->countDoctorAppointments(0);
		$data['countPenApp'] = $this->model_users->countDoctorAppointments(1);
		$data['countOKApp'] = $this->model_users->countDoctorAppointments(2);
		$data['countRejApp'] = $this->model_users->countDoctorAppointments(3);
		$data['announcements'] = $this->model_users->fetchAnnouncements();
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
		if($this->session->userdata('is_logged_in')){
			if($this->session->userdata('usertype') == "DOCTOR"){
				$this->load->view('templates/header/header_all',$data);	
				$this->load->view('templates/header/header_doctor');
				$this->load->view('makeAnnouncement', $data);	
			}
		}
	}
	public function manage_schedules(){
		$this->load->model('model_users');
		$data['success'] = '';
		//$data['appointments'] = $this->model_users->doctor_calendar_app();
		$data['title'] = 'Manage Schedules';
		$this->load->view('templates/header/header_all',$data);	
		$this->load->view('templates/header/header_doctor');
		$this->load->view('doctor/manage_schedules', $data);	
	}
	
	public function doc_calendar_app(){
		$this->load->model('model_users');	
		$data['appointments'] = $this->model_users->doctor_calendar_app();
		echo json_encode($data['appointments']);
		//print_r($data['appointments']);		
	}
	
	public function doctor_calendar_appointments(){
		$this->load->model('model_users');	
		$data['appointments'] = $this->model_users->doctor_calendar_appointments();
		echo json_encode($data['appointments']);
		//print_r($data['appointments']);		
	}

	public function is_schedule_unique(){
		$this->load->model('model_users');
		$date = $_POST['day'];
		$result = $this->model_users->check_schedule($date);

		if($result > 0)
			echo '1';
		else
			echo '0';
	}

	public function datatable_activeAppointments(){
			$this->datatables->select('appointments.appoint_id, appointments.date, appointments.time, users.lname, users.fname, appointments.appointment_made')
							->unset_column('appointments.appoint_id')
							->add_column('action', getbutton_appointments('$1'), 'appointments.appoint_id')
							->where('appointments.date >=', 'CURDATE()', FALSE)
							->where('appointments.doctor_id', $this->session->userdata('d_id'))
							->where('appointments.status', 1)
							->from('appointments')
							->join('patients', 'patients.p_id = appointments.patient_id ', 'inner')
							->join('users', 'users.id = patients.u_id', 'inner');
		echo $this->datatables->generate();
		
	}

	public function datatable_inactiveAppointments(){
		$this->datatables->select('appointments.appoint_id, appointments.date, appointments.time, users.lname, users.fname, appointments.appointment_made')
							->unset_column('appointments.appoint_id')
							->add_column('action', '')
							->where('appointments.date <', 'CURDATE()', FALSE)
							->where('appointments.doctor_id', $this->session->userdata('d_id'))
							->where('appointments.status', 1)
							->from('appointments')
							->join('patients', 'patients.p_id = appointments.patient_id ', 'inner')
							->join('users', 'users.id = patients.u_id', 'inner');
		echo $this->datatables->generate();
	}

	public function datatable_rejectedAppointments(){
		$this->datatables->select('appointments.date, appointments.time, users.lname, users.fname, appointments.message')
			->unset_column('appointments.message')
			->add_column('action', getbutton_rejected('$1'), 'appointments.message')
			->where('appointments.status', "Reject")
			->where('doctor_id', $this->session->userdata('d_id'))
			->from('appointments')
			->join('patients', 'patients.p_id = appointments.patient_id ', 'inner')
			->join('users', 'users.id = patients.u_id', 'inner');

		echo $this->datatables->generate();
	}

	public function datatable_historyOfAppointments(){
		$this->datatables->select('appointments.date, appointments.time, users.lname, users.fname, appointments.message')
			->unset_column('appointments.message')
			->add_column('action', '')
			->where('date <', "CURDATE()", FALSE)
			->where('doctor_id', $this->session->userdata('d_id'))
			->from('appointments')
			->join('patients', 'patients.p_id = appointments.patient_id ', 'inner')
			->join('users', 'users.id = patients.u_id', 'inner');

		echo $this->datatables->generate();
	}

	public function datatable_upcomingAppointments(){
		$fivedays = Date("Y-m-d", strtotime("+5 days"));
		$this->datatables->select('appointments.date, appointments.time, users.lname, users.fname, appointments.message')
			->unset_column('appointments.message')
			->add_column('action','')
			->where('date >=', $fivedays)
			->where('doctor_id', $this->session->userdata('d_id'))
			->from('appointments')
			->join('patients', 'patients.p_id = appointments.patient_id ', 'inner')
			->join('users', 'users.id = patients.u_id', 'inner');

		echo $this->datatables->generate();
	}

	public function datatable_announcementDoctor(){
		$query = $this->db->select('clinic')->from('doctors')->where('d_id', $this->session->userdata('d_id'))->get()->result();
        $this->datatables->select('announcement.id, announcement.announcement_datetime_made, announcement.announcement_subject, announcement.announcement_details')
        	->unset_column('announcement.announcement_details')
			->add_column('action', get_buttons_wdetails('$1', '$2'), 'announcement.id, announcement.announcement_details')
			->where('fk_clinic_id', $query[0]->clinic)
            ->from('announcement');
 
        echo $this->datatables->generate();
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
		$data['notif'] = '';
		if($this->session->userdata('is_logged_in')){
			if(!$this->input->get('show'))
				$data['pending'] = $this->model_users->getPendingActiveAppointments();
			else if($this->input->get('show') == '1')
				$data['pending'] = $this->model_users->getPendingInActiveAppointments();
			$this->load->view('templates/header/header_all', $data);
			$this->load->view('templates/header/header_doctor');
			$this->load->view('doctor/manage_appointment', $data);
		}else{
			redirect('main/restricted');
		}	
	}

	public function manage_appointmentv2(){
		$this->load->model('model_users');
		$data['title'] = 'Manage Appointment';
		$data['notif'] = '';
		if($this->session->userdata('is_logged_in')){
			$tmpl = array('table_open' => '<table class="table striped hovered dataTable" id="dataTables-1">');
			$this->table->set_template($tmpl);
			$this->table->set_heading('Date', 'Time', 'Last Name', 'First Name', 'Appointment Made', 'Actions');
			

			$this->load->view('templates/header/header_all', $data);
			$this->load->view('templates/header/header_doctor');
			$this->load->view('doctor/manage_appointmentv2', $data);
		}else{
			redirect('main/restricted');
		}	
	}

	public function changeStat_appointmentToApprove(){
		$id = $_POST['id'];
		$this->load->model('model_users');
		if($this->model_users->approveStatus_appointment($id)){
			echo "Success";
		}
		else{
			echo "Failed";
		}
	}

	public function viewAnnouncement(){
		$data['title'] = 'View Announcements';
		if($this->session->userdata('usertype') == "DOCTOR"){
			$tmpl = array('table_open' => '<table class="table striped hovered dataTable" id="dataTables-1">');
			$this->table->set_template($tmpl);
			$this->table->set_heading('id', 'Date and Time Made', 'Announcement Subject', 'Action');
			
			$this->load->view('templates/header/header_all',$data);	
			$this->load->view('templates/header/header_doctor');
			$this->load->view('doctor/viewAnnouncement_doctor');
		}else{
			show_404();
		}		
	}

	public function view_records(){
		$data['title'] = 'View Records';
		if($this->session->userdata('usertype') == "DOCTOR"){
			$tmpl = array('table_open' => '<table class="table striped hovered dataTable" id="dataTables-1">');
			$this->table->set_template($tmpl);
			$this->table->set_heading('Date', 'Time', 'Last Name', 'First Name', 'Action');
			
			$this->load->view('templates/header/header_all',$data);	
			$this->load->view('templates/header/header_doctor');
			$this->load->view('doctor/view_records');
		}else{
			show_404();
		}		
	}	

	public function changeStat_appointmentToReject(){
		$this->load->model('model_users');
		if($this->model_users->rejectStatus_appointment()){
			echo "success";
		}
		else{
			echo "error";
		}
	}

	public function view_appointment(){
		$data['title'] = 'View Timeline';
		$this->load->model('model_users');
		if($this->session->userdata('is_logged_in')){
			//$data['appointment'] = $this->model_users->getPatientsAppointments();
			$data['appointment'] = array();
			for($i=0; $i<=5; $i++){
				$eachday = $this->model_users->getPatientsAppointments(Date("Y-m-d", strtotime("+".$i." days")));
				array_push($data['appointment'], $eachday);
			}
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
			$this->load->view('doctor/appointment_details_doctor', $data);
		}
		else{
			echo "No Appointment";
		}
	}

	public function generateToDoc(){
		$this->load->model('model_users');

		$data['app'] = $this->model_users->fetchAppointmentsToGenerate($this->input->post('deyt'));
		$this->load->library('word');
		//our docx will have 'portrait' paper orientation
		$section = $this->word->createSection(array('orientation'=>'portrait'));
		
		// Add text elements		
		$this->word->addFontStyle('rStyle', array('bold'=>true, 'italic'=>true, 'size'=>16));
		$this->word->addParagraphStyle('pStyle', array('align'=>'center', 'spaceAfter'=>100));
		$section->addText("Appointments for ". $this->input->post('deyt'), 'rStyle', 'pStyle');

		// Define table style arrays
		$styleTable = array('borderSize'=>6, 'borderColor'=>'006699', 'cellMargin'=>80);
		$styleFirstRow = array('borderBottomSize'=>18, 'borderBottomColor'=>'0000FF', 'bgColor'=>'66BBFF');
				
		// Define cell style arrays
		$styleCell = array('valign'=>'center');
		$styleCellBTLR = array('valign'=>'center', 'textDirection'=>PHPWord_Style_Cell::TEXT_DIR_BTLR);
				
		// Define font style for first row
		$fontStyle = array('bold'=>true, 'align'=>'center');
				
		// Add table style
		$this->word->addTableStyle('myOwnTableStyle', $styleTable, $styleFirstRow);
				
		// Add table
		$table = $section->addTable('myOwnTableStyle');
				
		// Add row
		$table->addRow(900);
				
		// Add cells
		$table->addCell(2000, $styleCell)->addText('Time', $fontStyle);
		$table->addCell(2000, $styleCell)->addText('Name', $fontStyle);
		$table->addCell(2000, $styleCell)->addText('Gender', $fontStyle);
		$table->addCell(2000, $styleCell)->addText('Email', $fontStyle);
		$table->addCell(5000, $styleCell)->addText('Remarks', $fontStyle);
				
		// Add more rows / cells
		if(is_array($data['app'])){
			foreach($data['app'] as $rows):
				$table->addRow();
				$table->addCell(2000)->addText($rows->time);
				$table->addCell(2000)->addText(ucfirst($rows->lname) ." ". ucfirst($rows->fname));
				$table->addCell(2000)->addText($rows->p_gender);
				$table->addCell(2000)->addText($rows->email);
				$table->addCell(5000)->addText('');
			endforeach;
			$filename=$this->input->post('deyt').".docx"; //save our document as this file name
			header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document'); //mime type
			header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
			header('Cache-Control: max-age=0'); //no cache
			 
			$objWriter = PHPWord_IOFactory::createWriter($this->word, 'Word2007');
			$objWriter->save('php://output');
		}
		else{
			$data['title'] = 'View Timeline';
			$this->load->view('templates/header/header_all', $data);
			$this->load->view('templates/header/header_doctor');
			$this->load->view('doctor/view_appointment');
		}
	}
}