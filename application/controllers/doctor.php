<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Doctor extends CI_Controller {
	public function home_doctor(){
		$data['title'] = 'Hospital Management System';
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

	public function changeStat_appointmentToReject(){
		$this->load->model('model_users');
		if($this->model_users->rejectStatus_appointment()){
			$data['notif'] = "<script>var not = $.Notify({
										style: {background: 'green', color: 'white'},
										caption: 'Success Rejecting Appointment',
										content: 'The message already been sent',
										timeout: 10000 // 10 seconds
											});					
										</script>";
		}
		else{
			$data['notif'] = "<script>var not = $.Notify({
										style: {background: 'red', color: 'white'},
										caption: 'Error Rejecting Appointment',
										content: '',
										timeout: 10000 // 10 seconds
											});					
										</script>";
		}
		$data['title'] = 'Manage Appointment';
		if(!$this->input->get('show'))
			$data['pending'] = $this->model_users->getPendingActiveAppointments();
		else if($this->input->get('show') == '1')
			$data['pending'] = $this->model_users->getPendingInActiveAppointments();
		if($this->session->userdata('is_logged_in')){
			$this->load->view('templates/header/header_all', $data);
			$this->load->view('templates/header/header_doctor');
			$this->load->view('doctor/manage_appointment', $data);
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