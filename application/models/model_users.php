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
	
	
	public function what_userType(){
		$this->db->where('email', $this->input->post('email'));
		$query = $this->db->get('users');
		$row = $query->row();
		 return $row;
		
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
		
		
public function edit_user(){
     $id = $this->input->post('id');
		$data = array(
			'email' => $this->input->post('email'),
			'fname' => $this->input->post('fname'),
			'lname' => $this->input->post('lname')
            );

$this->db->where('id', $id);
 $this->db->update('users', $data);

if($this->db->affected_rows()>0)
	return true;
	else
	 false;
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

public function addAnnouncement(){
	$data = array(
		'announcement_subject' => $this->input->post('subject'),
		'announcement_details' => $this->input->post('details'),
	);	
	
	$query = $this->db->insert('announcement', $data);
	if($query)
		return true;
	else
		return false;
}
	
}//end of class