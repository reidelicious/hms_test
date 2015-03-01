<?php

class Model_users extends CI_Model{
	public function can_log_in(){
		$this->db->where('email', $this->input->post('email'));
		$this->db->where('password', md5($this->input->post('password')));
		
		$query = $this->db->get('users');
		
		if($query->num_rows() == 1 ){
			return true;	
		}else{
			return false;
		}
	}
	
	

	
	public function add_temp_user($key){
	
		$data = array(
			'email' => $this->input->post('email'),
			'password' => md5($this->input->post('password')),
			'fname' => $this->input->post('fname'),
			'lname' => $this->input->post('lname'),
			'age' => $this->input->post('age'),
			'gender' => $this->input->post('gender'),
			'address' => $this->input->post('address'),
			'utype' => $this->input->post('usertype'),	
			'key' => $key,
		);	
		
		$query = $this->db->insert('temp_users',$data);
		if($query){
			return true;
		}else{
			return false;
		}
	}
	
	public function is_key_valid($key){
		$this->db->where('key',$key);
		
		$query = $this->db->get('temp_users');
		
		if($query->num_rows() == 1){
			return true;
		}else{ return false;}
	
	}
	
	public function deleteUserFromDB($id){
		$this->db->where('id',$id);
		
		$query = $this->db->delete('users');
		
		if($this->db->affected_rows()>0){
			return true;
		}else{ return false;}

	}

	public function deleteClinicFromDB($id){
		$this->db->trans_start();
		$this->db->where('clinic_id',$id);
		$this->db->delete('clinic');
		$this->db->trans_complete();
		if($this->db->trans_status() === FALSE){
			return FALSE;
		}else{ return TRUE;}
	}

	public function check_schedule($d){
		$query = $this->db->get_where('doctor_schedule', array('d_id' => $this->session->userdata('d_id'), 'date' => $d));
		return $query->num_rows();
	}

	public function add_schedule_forDoctor($a){
		$data = array(
				'd_id' => $this->session->userdata('d_id'),
				'date' => $a[0],
				'time_start' => $a[1],
				'time_end' => $a[2]
			);
		$this->db->insert('doctor_schedule', $data);
	}

	public function overwrite_schedule_forDoctor($a){
		$array = array('d_id' => $this->session->userdata('d_id'), 'date' => $a[0]);
		$this->db->where($array); 
		$data = array(
				'time_start' => $a[1],
				'time_end' => $a[2]
			);
		$this->db->update('doctor_schedule', $data);
	}
	
	public function add_user($key){
		$this->db->where('key',$key);
		$temp_user = $this->db->get('temp_users');	
		$row = $temp_user->row();
		
		
		if($temp_user){
			$this->db->where('email',$row->email);
			$isEmail_exist = $this->db->get('users');
			
			if($isEmail_exist->num_rows() > 0){
					return false;
			}else{
					$data = array(
					'email' =>$row->email,
					'password' => $row->password,
					'fname' => $row->fname,
					'lname' => $row->lname,
					'utype' => $row->utype,
				);
				$did_add_user = $this->db->insert('users', $data);
				$this->db->select_max('id');
				$max_query = $this->db->get('users');
				$u_id = $max_query->row();
				$data2 = array(
					'p_address' => $row->address,
					'p_gender' => $row->gender,
					'p_age' => $row->age,
					'u_id' => $u_id->id
				
				);
		
				$did_add_user2 = $this->db->insert('patients', $data2);
				
				if($did_add_user && $did_add_user2){
					$this->db->where('key',$key);
					$this->db->delete('temp_users');
					return $data['email'];
				}else{ //incase of duplicate entry from email
					$this->db->where('key',$key);
					$this->db->delete('temp_users');
					return false;
				}
			
				
				
			}
		}else{
			//do nothing
		}		
	}//end of function
	
	public function get_Specialists(){
		$query = $this->db->get('medical_specialist');	
		return $query->result();
	}
	public function getAppointments($d){
		$this->db->where('date', $d);
		$this->db->where('patient_id', $this->session->userdata('p_id'));
		$this->db->from('appointments');
		$this->db->join('doctors', 'appointments.doctor_id = doctors.d_id', 'inner');
		$this->db->join('users', 'doctors.u_id = users.id', 'inner');
		$this->db->join('clinic', 'doctors.clinic = clinic.clinic_id', 'inner');
		$this->db->join('medical_specialist', 'doctors.specialization = medical_specialist.specialist_id', 'inner');
		$query = $this->db->get();
		return $query->result();
	}

	public function getPatientsAppointments($d){
		$this->db->where('doctor_id', $this->session->userdata('d_id'));
		$this->db->where('date', $d);
		$this->db->where('status', 2);
		$this->db->from('appointments');
		$this->db->order_by('date');
		$this->db->join('users', 'appointments.patient_id = users.id', 'inner');
		$query = $this->db->get();
		return $query->result();
	}
	public function getPendingActiveAppointments(){
		$this->db->where('date >=', 'CURDATE()', FALSE);
		$this->db->where('doctor_id', $this->session->userdata('d_id'));
		$this->db->where('status', 1);
		$this->db->from('appointments');
		$this->db->order_by('date');
		$this->db->join('users', 'appointments.patient_id = users.id', 'inner');
		$query = $this->db->get();
		return $query->result();
	}
	public function getPendingInActiveAppointments(){
		$this->db->where('date <', 'CURDATE()', FALSE);
		$this->db->where('doctor_id', $this->session->userdata('d_id'));
		$this->db->where('status', 1);
		$this->db->from('appointments');
		$this->db->order_by('date');
		$this->db->join('users', 'appointments.patient_id = users.id', 'inner');
		$query = $this->db->get();
		return $query->result();
	}
	public function get_Clinic(){
		$query = $this->db->get('clinic');
		return $query->result();
	}	
	public function getClinicByCategory($id){
		$this->db->where('clinic_category', $id);
		$query = $this->db->get('clinic');
		return $query->result();
	}
	public function getDoctorByCategory($id){
		$this->db->where('specialization', $id);
		$this->db->from('users');
		$this->db->join('doctors','users.id = doctors.u_id');
		$query = $this->db->get();
		return $query->result();
	}
	public function getDoctorByClinic($spec, $cate){
		$this->db->where('clinic', $spec);
		$this->db->where('specialization', $cate);
		$this->db->from('doctors');
		$this->db->join('users','users.id = doctors.u_id');
		$query = $this->db->get();
		return $query->result();
	}
	public function checkDuplicateAppointments($id, $d){
		$this->db->where('doctor_id', $id);
		$this->db->where('date', $d);
		$this->db->where('patient_id', $this->session->userdata('id'));
		$this->db->from('appointments');
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->result();
		}
		else
			return true;
	}
	public function getSchedule($id, $d){
		$this->db->where('d_id', $id);
		$this->db->where('date', $d);
		$this->db->from('doctor_schedule');
		$query = $this->db->get();
		if($this->db->count_all_results() > 0)
			return $query->result();
		else
			return false;
	}
	public function approveStatus_appointment($id){
		$data = array('status' => 2);
		$this->db->where('appoint_id', $id);
		$query = $this->db->update('appointments', $data);
		if($query)
			return true;
		else
			return false;
	}
	public function rejectStatus_appointment(){
		$data = array(
				'status' => 3,
				'message' => $this->input->post('message')
			);
		$this->db->where('appoint_id', $this->input->post('appointid'));
		$query = $this->db->update('appointments', $data);
		if($this->db->affected_rows()>0)
			return true;
		else
			return false;
	}
	public function countAppointments($flag){
		$this->db->where('patient_id', $this->session->userdata('id'));
		if($flag == 1){
			$this->db->where('status', 1);	
		} // Pending
		if($flag == 2){
			$this->db->where('status', 2);	
		} // Pending
		if($flag == 3){
			$this->db->where('status', 3);	
		} // Pending
		$query = $this->db->get('appointments');
		return $query->num_rows();
	}

	public function countDoctorAppointments($flag){
		$this->db->where('doctor_id', $this->session->userdata('id'));
		if($flag == 1){
			$this->db->where('status', 1);	
		} // Pending
		if($flag == 2){
			$this->db->where('status', 2);	
		} // Pending
		if($flag == 3){
			$this->db->where('status', 3);	
		} // Pending
		$query = $this->db->get('appointments');
		return $query->num_rows();
	}

	public function fetchAnnouncements(){
		$this->db->from('announcement');
		$this->db->join('clinic', 'clinic_id = announcement.fk_clinic_id','left');
		$this->db->order_by('announcement_datetime_made', 'DESC');
		$query = $this->db->get();
		return $query->result();
	}
	public function fetchAnnouncementsByID($id){
		$this->db->select('announcement_details');
		$this->db->from('announcement');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->result();
	}
	public function fetchAppointments(){
		$this->db->where('patient_id', $this->session->userdata('id'));
		$this->db->from('appointments');
		$this->db->join('doctors', 'appointments.doctor_id = doctors.d_id');
		$this->db->join('users', 'doctors.u_id = users.id');
		$this->db->order_by('date', 'DESC');
		$query = $this->db->get();
		return $query->result();
	}

	public function fetchAppointmentsToGenerate(){
		$this->db->where('date', $this->input->post('deyt'));
		$this->db->where('status', 'Approved');
		$this->db->from('appointments');
		$this->db->join('users', 'appointments.patient_id = users.id');
		$this->db->join('patients', 'patients.u_id = users.id');
		$this->db->order_by('time');
		$query = $this->db->get();
		return $query->result();
	}
	public function patient_addAppointment($arr){
		$data = array(
				'date' => $arr[0],
				'time' => $arr[1],
				'doctor_id' => $arr[2],
				'patient_id' => $this->session->userdata('p_id'),
				'status' => 1
			);
		$query = $this->db->insert('appointments', $data);
		if($query)
			return true;
		else
			return false;
	}
	public function explore_addAppointment(){
		$id = $this->db->select('d_id')->from('doctors')->where('u_id', $this->input->post('doctorid'))->get()->result();
		$data = array(
				'date' => $this->input->post('date'),
				'time' => $this->input->post('time'),
				'doctor_id' => $id[0]->d_id,
				'patient_id' => $this->session->userdata('id'),
				'status' => 1
			);
		$query = $this->db->insert('appointments', $data);
		if($query)
			return true;
		else
			return false;
	}
	public function edit_clinic(){
		$id = $this->input->post('id');
		$data = array(
		'clinic_name' => $this->input->post('clinicname'),
		'room_num' =>  $this->input->post('room_num')
	    );

		$this->db->where('clinic_id', $id);
		$this->db->update('clinic', $data);

		if($this->db->affected_rows()>0)
			return true;
		else
		 	return false;
	}

	public function admin_addUser(){
		$data1 = array(
			'email' => $this->input->post('email'),
			'password' => md5($this->input->post('password')),
			'fname' => $this->input->post('fname'),
			'lname' => $this->input->post('lname'),
			'utype' => $this->input->post('utype'),	

		);	
		$did_add_user = $this->db->insert('users', $data1);
		$this->db->select_max('id');
		$max_query = $this->db->get('users');
		$u_id = $max_query->row();
		
		$data2 = array(	
			'p_age' => $this->input->post('age'),
			'p_gender' => $this->input->post('gender'),
			'p_address' => $this->input->post('address'),
			'u_id' => $u_id->id,
			
		);
		$did_add_user2 = $this->db->insert('patients', $data2);

		if($did_add_user && $did_add_user2){
			return true;
		}else{ 
			return false;
		}
	}


	public function admin_addDoctor(){

		$data1 = array(
			'email' => $this->input->post('email'),
			'password' => md5($this->input->post('password')),
			'fname' => $this->input->post('fname'),
			'lname' => $this->input->post('lname'),
			'utype' => $this->input->post('utype'),	

		);	
		$did_add_user = $this->db->insert('users', $data1);

	$last_id = $this->db->insert_id();	
	$data2 = array(	
		'specialization' => $this->input->post('Specialization'),
		'contact_num' => $this->input->post('C_num'),
		'clinic' => $this->input->post('clinic'),
		'u_id' => $last_id
			
		);
		
		$did_add_user2 = $this->db->insert('doctors', $data2);

				if($did_add_user && $did_add_user2){
			
					return true;
				}else{ 

					return false;
				}

	}



	public function admin_addAdmin(){
	$data1 = array(
			'email' => $this->input->post('email'),
			'password' => md5($this->input->post('password')),
			'fname' => $this->input->post('fname'),
			'lname' => $this->input->post('lname'),
			'utype' => $this->input->post('utype'),	

		);	
		$did_add_user = $this->db->insert('users', $data1);

		

				if($did_add_user){
			
					return true;
				}else{ 

					return false;
				}


	}

	public function admin_addClinic(){
		$data = array(
				'clinic_name' => $this->input->post('clinicname'),
				'clinic_category' => $this->input->post('Specialization'),
				'room_num' => $this->input->post('room_num')
			);
		$query = $this->db->insert('clinic', $data);
		if($query)
			return true;
		else
			return false;
	}


	public function addAnnouncement($type){
		

		$data = array(
			'announcement_subject' => $this->input->post('subject'),
			'announcement_details' => $this->input->post('details'),
			'fk_clinic_id' => $type
		);	

	

	$query = $this->db->insert('announcement', $data);
	if($query)
		return true;
	else
		return false;
	}

	public function edit_announcement(){
		$data = array(
				'announcement_subject' => $this->input->post('subject'),
				'announcement_details' => $this->input->post('details'),
			);	

		$query = $this->db->update('announcement', $data);
		if($query)
			return true;
		else
			return false;
	}

	public function deleteAnnouncmentfromDb($id){
	
		$this->db->where('id',$id);
		
		$query = $this->db->delete('announcement');
		
		if($this->db->affected_rows()>0){
			return true;
		}else{ return false;}
	}



	public function doctor_count(){
	return $this->db->count_all('doctors');
	}	

	public function fetch_doctors($limit,$start){

	$this->db->limit($limit,$start);
	$this->db->order_by("fname", "asc"); 
	$this->db->select('*');
	$this->db->from('users');
	$this->db->join('doctors','users.id = doctors.u_id');
	$this->db->join('medical_specialist','medical_specialist.specialist_id =  doctors.specialization ');
	$query = $this->db->get();	

		if($query->num_rows() > 0 ){
			foreach($query->result() as $row){
					$data[] = $row;
				}
				return $data;	
		}
		
		return false;
	}	


	

	

	



public function fetch_doctors_alpha($letter){
	
	$this->db->like('fname',$letter,'after');
	$this->db->order_by("fname", "asc"); 
	$this->db->select('*');
	$this->db->from('users');
	$this->db->join('doctors','users.id = doctors.u_id');
	$this->db->join('medical_specialist','medical_specialist.specialist_id =  doctors.specialization ');
	$query = $this->db->get();	
	
	if($query->num_rows() > 0 ){
		foreach($query->result() as $row){
				$data[] = $row;
			}
			return $data;	
		}
		return false;
}
	
	
	
	
public function edit_account(){
	//print_r($this->session->all_userdata());exit;
	//$id = $this->input->post('id');
	//echo $id;exit;
	$data = array(
			'email' => $this->input->post('email'),
			'fname' => $this->input->post('fname'),
			'lname' => $this->input->post('lname'),
			'password' => md5($this->input->post('password'))
	        );

	$this->db->where('email', $this->session->userdata('email'));
	$this->db->update('users', $data);

	if($this->db->affected_rows()>0){
		$this->session->set_userdata($data);
		return true;
	}
	else
	 return false;

	}	
	
	public function what_userType(){
		$this->db->select('id, utype');
		$this->db->where('email', $this->input->post('email'));
		$query = $this->db->get('users');
		$row = $query->row();
		 return $row;
		
	}
	
	public function getAdmin_sessions($id){
		$this->db->where('id',$id);
		$this->db->from('users');
		$query = $this->db->get();
		
		return  $query->row();
		
		
	}
	public function getUser_sessions($id){

		$this->db->where('id',$id);
		$this->db->from('users');
		$this->db->join('patients','users.id = patients.u_id');
		$query = $this->db->get();
		
		return  $query->row();
	}
	public function getDoctor_sessions($id){

		$this->db->where('id',$id);
		$this->db->from('users');
		$this->db->join('doctors','users.id = doctors.u_id');
		$this->db->join('clinic', 'clinic.clinic_id = doctors.clinic');
		$this->db->join('medical_specialist', 'medical_specialist.specialist_id = doctors.specialization');
		$query = $this->db->get();
		
		return  $query->row();
	}
	public function edit_password($id){
		$data = array(
             'password' =>  md5($this->input->post('password')),
            );

		$this->db->where('id', $id);
		$this->db->update('users', $data); 
			if($this->db->affected_rows()>0){
				return true;
			}
		else
			return false;
		
		/*
$this->db->set('a.firstname', 'Pekka');
$this->db->set('a.lastname', 'Kuronen');
$this->db->set('b.companyname', 'Suomi Oy');
$this->db->set('b.companyaddress', 'Mannerheimtie 123, Helsinki Suomi');

$this->db->where('a.id', 1);
$this->db->where('a.id = b.id');
$this->db->update('table as a, table2 as b');
		
	*/	
	}
	
	public function checkOldPass(){
		$this->db->where('id', $this->session->userdata('id'));
		$query = $this->db->get('users');
		$row = $query ->row();
		if($query->num_rows() > 0 ){
			if($row->password == md5($this->input->post('oldPassword'))){
				return true;
				}
			else return false;
				
			
		}else{return false;}
		
	}
	
	
	public function edit_doctorinfo(){
		
			$data = array(
			'fname' => $this->input->post('fname'),
			'lname' => $this->input->post('lname'),
			
            );
			
		$this->db->where('id', $this->session->userdata('id'));
		$this->db->update('users', $data);
		
		if($this->db->affected_rows()>0){
		$this->session->set_userdata($data);
			return true;
		}
		else
		 return false;
		
	}
	
	public function edit_admininfo(){
			$data = array(
			'fname' => $this->input->post('fname'),
			'lname' => $this->input->post('lname'),
			
            );
			
		$this->db->where('id', $this->session->userdata('id'));
		$this->db->update('users', $data);
		
		if($this->db->affected_rows()>0){
		$this->session->set_userdata($data);
			return true;
		}
		else
		 return false;
		
	}
	public function edit_userinfo(){
		$data = array(
			'fname' => $this->input->post('fname'),
			'lname' => $this->input->post('lname'),
			'age' => $this->input->post('age'),
			'gender' => $this->input->post('gender'),
			'address' => $this->input->post('address'),

		);
		
		$this->db->set('u.fname', $this->input->post('fname'));
		$this->db->set('u.lname', $this->input->post('lname'));
		$this->db->set('p.p_address', $this->input->post('address') );
		$this->db->set('p.p_gender',$this->input->post('gender') );
		$this->db->set('p.p_age', $this->input->post('age'));
		
		$this->db->where('u.id', $this->session->userdata('id'));
		$this->db->where('u.id = p.u_id');
		$this->db->update('users as u, patients as p');
		
		if($this->db->affected_rows()>0){
			$this->session->set_userdata($data);
			return true;
		}
		else
		 return false;
		
		
		
	}
	
	public function updateAvatar($fn){
	
		$data = array(
			'avatar' => $fn	
            );	
		$this->db->where('id', $this->session->userdata('id'));
		$this->db->update('users', $data);
		
		if($this->db->affected_rows()>0){
			$this->session->set_userdata($data);
			return true;
		}
		else
		 return false;	
	}

	public function changeColor(){
		$data = array(
					'timeline' => $this->input->post('r1')
				);
		$query = $this->db->where('id', $this->session->userdata('id'))->update('users', $data);
		if($query)
			return true;
		else
			return false;
	}
	
	public function search_doctors($item){
		$this->db->like('lname', $item, 'after');
		$this->db->where('utype','DOCTOR'); 
		$this->db->from('users');
		$this->db->join('doctors','users.id = doctors.u_id');
		$this->db->join('clinic', 'clinic.clinic_id = doctors.clinic');
		$this->db->join('medical_specialist', 'medical_specialist.specialist_id = doctors.specialization');
		
		$query = $this->db->get();
		
		return $query->result();
		
		
	}
	public function search_clinics($item){
		
		
		
	}
	
	public function browse_category(){
		
		$this->db->from('medical_specialist');
		$query = $this->db->get();
		
		return $query -> result();
		
	}
	public function browse_clinic_name($id){
		$this->db->where('clinic_category',$id );
		$this->db->from('clinic');
		$query = $this->db->get();
		
		return $query->result();
		
		
	}
	public function count_doctors($id){
		$this->db->where('clinic',$id);
		$this->db->from('doctors');
		return $this->db->count_all_results();
		
	}
	
	public function get_clinic_announcement($id){
		$this->db->limit(3);
		$this->db->where('fk_clinic_id',$id);
		$this->db->order_by("announcement_datetime_made", "desc"); 
		$query = $this->db->get('announcement');
		
		if($query->num_rows() > 0 ){
			return $query->result();	
		}else{
			return false;
		}
		
	}

	public function fetch_clinic_doctors($id){

	$this->db->where('doctors.clinic',$id);
	$this->db->order_by("fname", "asc"); 
	$this->db->select('*');
	$this->db->from('users');
	$this->db->join('doctors','users.id = doctors.u_id');
	$this->db->join('medical_specialist','medical_specialist.specialist_id =  doctors.specialization ');
	$query = $this->db->get();	

		if($query->num_rows() > 0 ){
		
				return $query->result();	
		}
		
		return false;
	}
	
	public function get_calendar_app(){
		
	$this->db->where('patient_id',$this->session->userdata('p_id'));
	$this->db->group_by('date');
	$this->db->select('date');
	$this->db->from('appointments');
	$query = $this->db->get();
	
	return  $query->result();
	}	
	
	public function doctor_calendar_app(){
	$this->db->where('d_id',$this->session->userdata('d_id'));
	$this->db->group_by('date');
	$this->db->select('date');
	$this->db->from('doctor_schedule');
	$query = $this->db->get();
	
	return  $query->result();
		
	}
	public function doctor_calendar_appointments(){
		$this->db->where('doctor_id',$this->session->userdata('d_id'));
		$this->db->where('status', 2);
		$this->db->group_by('date');
		$this->db->select('date');
		$this->db->from('appointments');
		$this->db->join('users', 'appointments.patient_id = users.id', 'inner');
		$query = $this->db->get();
		
		return  $query->result();
		
	}
	
	public function edit_user(){
			$data = array(
			'fname' => $this->input->post('fname'),
			'lname' => $this->input->post('lname'),
	        );

			$this->db->where('id', $this->input->post('id'));
			$this->db->update('users', $data);
		
			if($this->db->affected_rows()>0){
				$this->session->set_userdata($data);
				return true;
			}
			else
			 return false;
		
		
	}

	
	
}//end of class