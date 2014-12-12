<div class="container">
    	
        
      
<h2 id="_default"><i class="icon-accessibility on-left"></i>Manage User</h2>
<?php
$attributes = array( 'enctype' => 'multipart/form-data', 'id'=> 'AdduserForm');

 echo form_open('admin/addUser_validation',$attributes); ?>
    <fieldset>
    
    <legend>Add User</legend>
    <?php echo validation_errors(); ?>
    
    	<label>Usertype </label>
         <div class="input-control select">
            <select name="utype" id="Category"  required>
            	<option value=''<?php echo set_select('utype', '', TRUE); ?> disabled="disabled"> Select Category</option>
				<option value='1'<?php echo set_select('utype', '1'); ?>> USER</option>
				<option value='2' <?php echo set_select('utype', '2'); ?>> DOCTOR</option>
                <option value='3'<?php echo set_select('utype', '3'); ?>> ADMIN</option>
            </select>
        </div>
   		<label>Email </label>
    	<div class="input-control text" data-role="input-control">
        	<?php $data = array( 'name'=> 'email', 'placeholder'=>'enter your email', 'required'=>'required');?>
         	<?php echo form_email($data, $this->input->post('email')); ?>
    		<button class="btn-clear" tabindex="-1"></button>
    	</div>
    	
    	<label>Password </label>
        <div class="input-control password" data-role="input-control">
        	<?php $data = array( 'name'=> 'password', 'placeholder'=>'enter your password', 'required'=>'required');?>
        	<?php echo form_password($data);  ?>
        	<button class="btn-reveal" tabindex="-1"></button>
        </div>
        <label>Confirm Password </label>
        <div class="input-control password" data-role="input-control">
        	<?php $data = array( 'name'=> 'cPassword', 'placeholder'=>'confirm your password', 'required'=>'required');?>
        	<?php echo form_password($data);  ?>
        	<button class="btn-reveal" tabindex="-1"></button>
        </div>
        <label>First name </label>
    	
        	<?php $data = array( 'name'=> 'fname', 'placeholder'=>'enter your first name','required'=>'required', 'data-transform'=>'input-control');?>
         	<?php echo form_input($data, $this->input->post('fname')); ?>
    		
    	
        <label>Last name </label>
    	<div class="input-control text" data-role="input-control">
        	<?php $data = array( 'name'=> 'lname', 'placeholder'=>'enter your last name','required'=>'required');?>
         	<?php echo form_input($data, $this->input->post('lname')); ?>
    		<button class="btn-clear" tabindex="-1"></button>
    	</div>
        
        <div class="addelem">
            
            
            
         </div>
       

        	<?php echo form_submit('signup_submit','Sign up'); ?>
    </fieldset>
<?php echo form_close();?>
    





</div>



<div id="1" style="visibility:hidden;">
 		<label>Age </label>
    	<div class="input-control text" data-role="input-control">
        	<?php $data = array( 'name'=> 'age', 'placeholder'=>'enter your Age','required'=>'required');?>
         	<?php echo form_input($data, $this->input->post('age')); ?>
    		<button class="btn-clear" tabindex="-1"></button>
    	</div>
        <label>Address </label>
    
        	<?php $data = array( 'name'=> 'address', 'placeholder'=>'enter your Address','required'=>'required','data-transform'=>'input-control');?>
         	<?php echo form_input($data, $this->input->post('address')); ?>

    
        <label>Gender </label>
        <div class="input-control select" >
            <select name="gender" required>
            	<option value=''<?php echo set_select('gender', '', TRUE); ?> disabled="disabled"> Select Gender</option>
				<option value='1'<?php echo set_select('gender', '1', TRUE); ?>> Male</option>
				<option value='2' <?php echo set_select('gender', '2'); ?>> Female</option>
            </select>
        </div>
</div>
<div id="2" style="visibility:hidden;">

		<label>Specialization  </label>
    	<div class="input-control text" data-role="input-control">
        	<?php $data = array( 'name'=> 'Specialization', 'placeholder'=>'enter Specialization ','required'=>'required');?>
         	<?php echo form_input($data, $this->input->post('Specialization')); ?>
    		<button class="btn-clear" tabindex="-1"></button>
    	</div>
 		<label>Contact Number </label>
    	<div class="input-control text" data-role="input-control">
        	<?php $data = array( 'name'=> 'C_num', 'placeholder'=>'enter room number','required'=>'required');?>
         	<?php echo form_input($data, $this->input->post('C_num')); ?>
    		<button class="btn-clear" tabindex="-1"></button>
    	</div>
        	<label>Room Number </label>
    	<div class="input-control text" data-role="input-control">
        	<?php $data = array( 'name'=> 'R_num', 'placeholder'=>'enter room number','required'=>'required');?>
         	<?php echo form_input($data, $this->input->post('R_num')); ?>
    		<button class="btn-clear" tabindex="-1"></button>
    	</div>


</div>
<div id="3" style="visibility:hidden;"></div>

<script type="text/javascript">
$(document).ready(function() {
  $('#Category').on('change', function(){
	 if($( "#Category").val() == 1){
		 var one =  $( "#1" ).html( );
		 $( ".addelem" ).html( one );
	 }else if($( "#Category").val() == 2){
		   var two =  $( "#2" ).html( );
		 $( ".addelem" ).html( two );
		 
	 }else if($( "#Category").val() == 3){
		     var three =  $( "#3" ).html( );
		 $( ".addelem" ).html( three );	 
	 }else{
		  $( ".addelem" ).empty();	 
	 }
	 });
	
	
});
</script>
  <?php echo $success;
  		echo $mail;
   ?>
  

</body>
</html>