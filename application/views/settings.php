
<?php   $user	='<label>Email </label>' ;
    	$user .= '<div class="input-control text" data-role="input-control">';
		
    	$data = array( 'name'=> 'email', 'placeholder'=>'enter your email', 'required'=>'required'  ,'disabled' => 'disabled');
        $user .=    form_email($data, $this->session->userdata('email'));
    	$user .=	'<button class="btn-clear" tabindex="-1"></button>';
    	$user .= '</div>';
    	
    	$user .= '<label>Password </label>';
        $user .= '<div class="input-control password" data-role="input-control">';
   		$data = array( 'name'=> 'password', 'placeholder'=>'enter your password', 'required'=>'required');
        $user .=form_password($data);
        $user .=' <button class="btn-reveal" tabindex="-1"></button>';
        $user .= '</div>';
        $user .='<label>Confirm Password </label>';
        $user .='<div class="input-control password" data-role="input-control">';
       $data = array( 'name'=> 'cPassword', 'placeholder'=>'confirm your password', 'required'=>'required');
        $user .= form_password($data);
        $user .='.<button class="btn-reveal" tabindex="-1"></button>
        </div>
        <label>First name </label>';
    	
       $data = array( 'name'=> 'fname', 'placeholder'=>'enter your first name','required'=>'required', 'data-transform'=>'input-control');
        $user .=  form_input($data, $this->session->userdata('fname'));
    	
        $user .='<label>Last name </label>
    	<div class="input-control text" data-role="input-control">';
		
 $data = array( 'name'=> 'lname', 'placeholder'=>'enter your last name','required'=>'required');
        $user .= form_input($data, $this->session->userdata('lname'));
    	$user .='	<button class="btn-clear" tabindex="-1"></button>
    	</div>';
?>



<div class="container">
    	
        
      
<h2 id="_default"><i class="icon-accessibility on-left"></i>SETTINGS</h2>




    <?php echo validation_errors(); ?>
    <div class="accordion with-marker" data-role="accordion">
    <div class="accordion-frame active">
        <a href="#" class=" bg-lightBlue fg-white heading">Frame heading</a>
        <div class="content">...</div>
    </div>
    <div class="accordion-frame ">
        <a href="#" class=" bg-lightBlue fg-white heading">Password</a>
        <div class="content">
        <?php 
        $attributes = array( 'enctype' => 'multipart/form-data', 'id'=> 'editUser_form');
			 echo form_open('admin/editPassword_validation',$attributes); ?>
   			 <fieldset>
    
   			 <legend>Edit Password</legend>
             <?php   echo form_error('oldPassword');
			 echo form_error('password');
			 		echo form_error('cPassword');
			  ?>
        <label>Old Password </label>
        <div class="input-control password" data-role="input-control">
   		<?php $data = array( 'name'=> 'oldPassword', 'placeholder'=>'enter your old password', 'required'=>'required');
        	echo form_password($data); ?>
         <button class="btn-reveal" tabindex="-1"></button>
       </div>
        <label>Password </label>
        <div class="input-control password" data-role="input-control">
   		<?php $data = array( 'name'=> 'password', 'placeholder'=>'enter your password', 'required'=>'required');
        	echo form_password($data); ?>
         <button class="btn-reveal" tabindex="-1"></button>
       </div>
        <label>Confirm Password </label>
        <div class="input-control password" data-role="input-control">
       	<?php $data = array( 'name'=> 'cPassword', 'placeholder'=>'confirm your password', 'required'=>'required');
        	echo form_password($data); ?>
       	<button class="btn-reveal" tabindex="-1"></button>
        </div>
             
             	 <?php echo form_submit('signup_submit','Sign up'); ?>
                 
                </fieldset>
            <?php echo form_close();?>
        
        </div>
    </div>
    <div class="accordion-frame">
        <a href="#" class="heading">Edit Details</a>
        <div class="content">
         <?php
			$attributes = array( 'enctype' => 'multipart/form-data', 'id'=> 'editUser_form');
			 echo form_open('main/edituser_validation',$attributes); ?>
   			 <fieldset>
    
   			 <legend>Update Information</legend>
             	<input type="hidden" name="id" value="<?php echo $this->session->userdata('id'); ?>" />
   		 <?php  ?>
    
  		<?php echo $user;
			if($this->session->userdata('usertype') == "USER"){
		?>
               <label>Age </label>
                <div class="input-control text" data-role="input-control">
                    <?php $data = array( 'name'=> 'age', 'placeholder'=>'enter your Age','required'=>'required');?>
                    <?php echo form_input($data, $this->session->userdata('age')); ?>
                    <button class="btn-clear" tabindex="-1"></button>
                </div>
                <label>Address </label>
                    <?php $data = array( 'name'=> 'address', 'placeholder'=>'enter your Address','required'=>'required','data-transform'=>'input-control');?>
                    <?php echo form_input($data, $this->session->userdata('address')); ?>
                <label>Gender </label>
                <div class="input-control select" >
                    <select name="gender" required>
                        <option value=''<?php echo set_select('gender', '', TRUE); ?> disabled="disabled"> Select Gender</option>
                        <option value='1'<?php echo set_select('gender', '1', TRUE); ?>> Male</option>
                        <option value='2' <?php echo set_select('gender', '2'); ?>> Female</option>
                    </select>
                </div>	
				<?php	
                }else if($this->session->userdata('usertype') == "ADMIN"){                           
                }
             ?>

			 <?php echo form_submit('signup_submit','Sign up'); ?>
                </fieldset>
            <?php echo form_close();?>

        </div>
    </div>	
</div>
    
 

</div>




<?php echo $success;?>






