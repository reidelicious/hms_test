
<?php  
?>



<div class="container">
    	
        
      
<h2 id="_default"><i class="icon-accessibility on-left"></i>SETTINGS</h2>




    <?php echo validation_errors(); ?>
    <div class="accordion with-marker" data-role="accordion">
    <div class="accordion-frame active">
        <a href="#" class=" bg-lightBlue fg-white heading">Edit Avatar </a>
        <div class="content">
        	<div class="thumb" style="margin: 0 auto;"><img  class="scale" src = "<?php echo base_url($this->session->userdata('avatar'))?>" ></div>
        <br />
  			<div style="margin: 0 auto;" class="span5"> 
            
			<?php 
			echo $error;
			echo form_open_multipart('main/do_upload');?>

            <input type="file" name="userfile" size="20" />
            
            <br /><br />
            
            <input type="submit" value="upload" />
            
            </form>
        
      	  </div>
    </div>
    </div>
    <div class="accordion-frame ">
        <a href="#" class=" bg-lightBlue fg-white heading">Password</a>
        <div class="content">
        <?php 
        $attributes = array( 'enctype' => 'multipart/form-data', 'id'=> 'password_form');
			 echo form_open('main/editPassword_validation',$attributes); ?>
   			 <fieldset>
    
   			 <legend>Edit Password</legend>
             <?php   echo form_error('oldPassword');
			 echo form_error('password');
			 		echo form_error('cPassword');
			  ?>
        <label>Old Password </label>
        <div class="input-control password" data-role="input-control">
   		<?php $data = array( 'name'=> 'oldPassword', 'placeholder'=>'enter your old password','id' => 'oldpass', 'required'=>'required');
        	echo form_password($data); ?>
         <button class="btn-reveal" tabindex="-1"></button>
       </div>
        <label>Password </label>
        <div class="input-control password" data-role="input-control">
   		<?php $data = array( 'name'=> 'password', 'placeholder'=>'enter your password','id' => 'pass', 'required'=>'required');
        	echo form_password($data); ?>
         <button class="btn-reveal" tabindex="-1"></button>
       </div>
        <label>Confirm Password </label>
        <div class="input-control password" data-role="input-control">
       	<?php $data = array( 'name'=> 'cPassword', 'placeholder'=>'confirm your password', 'required'=>'required');
        	echo form_password($data); ?>
       	<button class="btn-reveal" tabindex="-1"></button>
        </div>
             
             	 <?php echo form_submit('signup_submit','Change password'); ?>
                 
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
         
         		<label>Email </label>
    	  <div class="input-control text" data-role="input-control">
		
    	<?php $data = array( 'name'=> 'email', 'placeholder'=>'enter your email', 'required'=>'required'  ,'disabled' => 'disabled');
           echo   form_email($data, $this->session->userdata('email'));?>
    	 	<button class="btn-clear" tabindex="-1"></button>
    	  </div>
    	
  
         
        <label>First name </label>
    	
       <?php $data = array( 'name'=> 'fname', 'placeholder'=>'enter your first name','required'=>'required', 'data-transform'=>'input-control');
          echo  form_input($data, $this->session->userdata('fname')); ?>
    	
        <label>Last name </label>
    	<div class="input-control text" data-role="input-control">
		
 		<?php  $data = array( 'name'=> 'lname', 'placeholder'=>'enter your last name','required'=>'required');
         echo  form_input($data, $this->session->userdata('lname')); ?>
    	 <button class="btn-clear" tabindex="-1"></button>
    	</div>
    
  		<?php 
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
                        <option value='1'<?php echo set_select('gender', '1'); ?>> Male</option>
                        <option value='2' <?php echo set_select('gender', '2'); ?>> Female</option>
                    </select>
                </div>	
				<?php	
                }else if($this->session->userdata('usertype') == "ADMIN"){                           
                }
             ?>

			 <?php echo form_submit('signup_submit','Edit Info'); ?>
                </fieldset>
            <?php echo form_close();?>

        </div>
    </div>	
</div>
    
 

</div>




<?php echo $success;?>


<script type="text/javascript">
$(document).ready(function(){

	// Validate
	// http://bassistance.de/jquery-plugins/jquery-plugin-validation/
	// http://docs.jquery.com/Plugins/Validation/
	// http://docs.jquery.com/Plugins/Validation/validate#toptions
	$.validator.addMethod("notEqualtoOldPass", function(value, element) {
  	 return $('#oldpass').val() != $('#pass').val()
	}, "* Old password and new password should not match");
	$('#password_form').validate({
	    rules: {
	      password: {
	        minlength: 6,
			number: true,
	        required: true,
			notEqualtoOldPass: true
	      },
		  cPassword: {
	        minlength: 6,
	        required: true,
			 number: true,
			 equalTo: "#pass"

	      },
		  oldPassword: {
	    	 minlength: 6,
	        required: true,
			number: true,
	      }
		
		  
	    },
			highlight: function(element) {
				$(element).closest('.input-control').removeClass('success-state').addClass('error-state');
			},
			success: function(element) {
				element
					.closest('.input-control').removeClass('error-state').addClass('success-state');
			},
			
			messages: {
			 cPassword:{equalTo: "Password doesnt match"}
			}
	  });
	  
	  
	  $('#editUser_form').validate({
	    rules: {
	      fname: {
	        minlength: 2,
	        required: true
	      },
	      lname: {
	         minlength: 2,
	         required: true
	      },<?php if($this->session->userdata('usertype') == "USER"){?>
		  age: {
	        minlength: 1,
	        required: true,
			number: true,
    		maxlength: 2
	      },
		   address: {
	        minlength: 2,
	        required: true
	      }<?php }?>
		  
	    },
			highlight: function(element) {
				$(element).closest('.input-control').removeClass('success-state').addClass('error-state');
			},
			success: function(element) {
				element
					.closest('.input-control').removeClass('error-state').addClass('success-state');
			},
			
			messages: {
  			  name: "Please specify your name",
  			  email: {
				  required: "We need your email address to contact you",
				  email: "Your email address must be in the format of name@domain.com"
			  },
			 cPassword:{equalTo: "Password doesnt match"}
			}
	  });

}); // end document.ready

</script>



