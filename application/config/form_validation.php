<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
		
$config = array(
                 'users' => array(
                                    array(
                                            'field' => 'email',
                                            'label' => 'Email',
                                            'rules' => 'required|trim|valid_email|is_unique[users.email]'
											
                                         ),
                                    array(
                                            'field' => 'password',
                                            'label' => 'Password',
                                            'rules' => 'required|trim'
                                         ),
                                    array(
                                            'field' => 'cPassword',
                                            'label' => 'Confirm Password',
                                            'rules' => 'required|trim|matches[password]'
                                         ),
                                    array(
                                            'field' => 'fname',
                                            'label' => 'Fname',
                                            'rules' => 'required|trim'
                                         ),
									array(
											'field' => 'lname',
											'label' => 'Lname',
											'rules' => 'required|trim'
										 )
								
                                    ),
                 'patients' => array(
                                    array(
											'field' => 'age',
											'label' => 'Age',
											'rules' => 'required|trim'
										 ),
									array(
											'field' => 'gender',
											'label' => 'Gender',
											'rules' => 'required|trim'
										 ),
									array(
											'field' => 'address',
											'label' => 'Address',
											'rules' => 'required|trim'
										 )
                                    ),
				 'doctors' => array(
                                    array(
											'field' => 'Specialization',
											'label' => 'Specialization',
											'rules' => 'required|trim'
										 ),
									array(
											'field' => 'C_num',
											'label' => 'Gender',
											'rules' => 'C_num|trim'
										 ),
									array(
											'field' => 'R_num',
											'label' => 'R_num',
											'rules' => 'required|trim'
										 )
                                    )                                
               );
			   
			   
$config["user_patient"] = array_merge($config['users'], $config['patients']);
$config["user_doctor"] = array_merge($config['users'], $config['doctors']);



