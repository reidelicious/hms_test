
<?php  
?>



<div class="container">
    	
        
      
<h2 id="_default"><i class="icon-accessibility on-left"></i>SETTINGS</h2>




    <?php echo validation_errors(); ?>
    <div class="accordion with-marker" data-role="accordion">
    <div class="accordion-frame active">
        <a href="#" class="<?php echo $this->session->userdata('timeline'); ?> fg-white heading">Edit Avatar </a>
        <div class="content">
        	<div class="thumb" style="margin: 0 auto;"><img  class="scale" src = "<?php echo base_url($this->session->userdata('avatar'))?>" ></div>
        <br />
  			<div style="margin: 0 auto;" class="span5"> 
            
			<?php 
			echo $error;
			echo form_open_multipart('main/do_upload');?>

            <input type="file" name="userfile" size="20" />
            
            <br /><br />
            
            <input type="submit" class="primary" value="Upload Picture" />
            
            </form>
        
      	  </div>
    </div>
    </div>
    <div class="accordion-frame ">
        <a href="#" class="<?php echo $this->session->userdata('timeline'); ?> fg-white heading">Password</a>
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
             
             	 <?php echo form_submit('signup_submit','Change password', 'class="primary"'); ?>
                 
                </fieldset>
            <?php echo form_close();?>
        
        </div>
    </div>
    <div class="accordion-frame">
        <a href="#" class="<?php echo $this->session->userdata('timeline'); ?> fg-white heading">Edit Details</a>
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
                        <option value=''<?php echo set_select('gender', '', TRUE); ?> disabled="disabled"> <?php echo $this->session->userdata('gender'); ?></option>
                        <?php if($this->session->userdata('gender') != "MALE"){ ?>
                            <option value='MALE'<?php echo set_select('gender', '1'); ?>> MALE</option>
                        <?php }else{ ?>
                            <option value='FEMALE' <?php echo set_select('gender', '2'); ?>> FEMALE</option>
                        <?php } ?>
                    </select>
                </div>	
				<?php	
                }else if($this->session->userdata('usertype') == "ADMIN"){                           
                }
             ?>

			 <?php echo form_submit('signup_submit','Edit Info', 'class="primary"'); ?>
                </fieldset>
            <?php echo form_close();?>

        </div>
    </div>	
    <?php if($this->session->userdata('usertype') != "ADMIN"){ ?>
      <div class="accordion-frame">
        <a href="#" class="<?php echo $this->session->userdata('timeline'); ?> fg-white heading">Change Theme</a>
        <div class="content">
          <div class="grid">
          <div class="row">
            <form action="<?php echo base_url('main/changeColor'); ?>" method="POST">
              <div class="span3 offset3">
                <div class="input-control radio default-style margin10" data-role="input-control">
                    <label>
                        <input type="radio" name="r1" value="bg-black" />
                        <span class="check"></span>
                        <span class="square10 inline-block bg-black on-left"></span>  Black
                    </label>
                </div><br/>
                <div class="input-control radio default-style margin10" data-role="input-control">
                    <label>
                        <input type="radio" name="r1" value="bg-lime" />
                        <span class="check"></span>
                        <span class="square10 inline-block bg-lime on-left"></span>  Lime
                    </label>
                </div><br/>
                <div class="input-control radio default-style margin10" data-role="input-control">
                    <label>
                        <input type="radio" name="r1" value="bg-green" />
                        <span class="check"></span>
                        <span class="square10 inline-block bg-green on-left"></span>  Green
                    </label>
                </div><br/>
                <div class="input-control radio default-style margin10" data-role="input-control">
                    <label>
                        <input type="radio" name="r1" value="bg-emerald"  />
                        <span class="check"></span>
                        <span class="square10 inline-block bg-emerald on-left"></span>  Emerald
                    </label>
                </div><br/>
                <div class="input-control radio default-style margin10" data-role="input-control">
                    <label>
                        <input type="radio" name="r1" value="bg-teal" />
                        <span class="check"></span>
                        <span class="square10 inline-block bg-teal on-left"></span>  Teal
                    </label>
                </div><br/>
                <div class="input-control radio default-style margin10" data-role="input-control">
                    <label>
                        <input type="radio"  value="bg-cyan" name="r1" />
                        <span class="check"></span>
                        <span class="square10 inline-block bg-cyan on-left"></span>  Cyan (Default Color)
                    </label>
                </div><br/>
                <div class="input-control radio default-style margin10" data-role="input-control">
                    <label>
                        <input type="radio" name="r1" value="bg-cobalt" />
                        <span class="check"></span>
                        <span class="square10 inline-block bg-cobalt on-left"></span>  Cobalt
                    </label>
                </div><br/>
              </div>
              <div class="span3">
                <div class="input-control radio default-style margin10" data-role="input-control">
                    <label>
                        <input type="radio" name="r1" value="bg-indigo"  />
                        <span class="check"></span>
                        <span class="square10 inline-block bg-indigo on-left"></span>  Indigo
                    </label>
                </div><br/>
                <div class="input-control radio default-style margin10" data-role="input-control">
                    <label>
                        <input type="radio" name="r1" value="bg-violet"  />
                        <span class="check"></span>
                        <span class="square10 inline-block bg-violet on-left"></span>  Violet
                    </label>
                </div><br/>
                <div class="input-control radio default-style margin10" data-role="input-control">
                    <label>
                        <input type="radio" name="r1" value="bg-pink"  required />
                        <span class="check"></span>
                        <span class="square10 inline-block bg-pink on-left"></span>  Pink
                    </label>
                </div><br/>
                <div class="input-control radio default-style margin10" data-role="input-control">
                    <label>
                        <input type="radio" name="r1" value="bg-magenta"  />
                        <span class="check"></span>
                        <span class="square10 inline-block bg-magenta on-left"></span>  Magenta
                    </label>
                </div><br/>
                <div class="input-control radio default-style margin10" data-role="input-control">
                    <label>
                        <input type="radio" name="r1" value="bg-crimson"  />
                        <span class="check"></span>
                        <span class="square10 inline-block bg-crimson on-left"></span>  Crimson
                    </label>
                </div><br/>
                <div class="input-control radio default-style margin10" data-role="input-control">
                    <label>
                        <input type="radio" name="r1" value="bg-red" />
                        <span class="check"></span>
                        <span class="square10 inline-block bg-red on-left"></span>  Red
                    </label>
                </div><br/>
                <div class="input-control radio default-style margin10" data-role="input-control">
                    <label>
                        <input type="radio" name="r1"  value="bg-orange" />
                        <span class="check"></span>
                        <span class="square10 inline-block bg-orange on-left"></span>  Orange
                    </label>
                </div><br/>
              </div>
              <div class="span3">
                <div class="input-control radio default-style margin10" data-role="input-control">
                    <label>
                        <input type="radio" name="r1"  value="bg-amber"  />
                        <span class="check"></span>
                        <span class="square10 inline-block bg-amber on-left"></span>  Amber
                    </label>
                </div><br/>
                <div class="input-control radio default-style margin10" data-role="input-control">
                    <label>
                        <input type="radio" name="r1" value="bg-brown"  />
                        <span class="check"></span>
                        <span class="square10 inline-block bg-brown on-left"></span>  Brown
                    </label>
                </div><br/>
                <div class="input-control radio default-style margin10" data-role="input-control">
                    <label>
                        <input type="radio" name="r1" value="bg-olive"  />
                        <span class="check"></span>
                        <span class="square10 inline-block bg-olive on-left"></span>  Olive
                    </label>
                </div><br/>
                <div class="input-control radio default-style margin10" data-role="input-control">
                    <label>
                        <input type="radio" name="r1" value="bg-steel"  />
                        <span class="check"></span>
                        <span class="square10 inline-block bg-steel on-left"></span>  Steel
                    </label>
                </div><br/>
                <div class="input-control radio default-style margin10" data-role="input-control">
                    <label>
                        <input type="radio" name="r1" value="bg-mauve"  />
                        <span class="check"></span>
                        <span class="square10 inline-block bg-mauve on-left"></span>  Mauve
                    </label>
                </div><br/>
                <div class="input-control radio default-style margin10" data-role="input-control">
                    <label>
                        <input type="radio" name="r1"  value="bg-taupe"  />
                        <span class="check"></span>
                        <span class="square10 inline-block bg-taupe on-left"></span>  Taupe
                    </label>
                </div><br/>
                <div class="input-control radio default-style margin10" data-role="input-control">
                    <label>
                        <input type="radio" name="r1"  value="bg-gray"  />
                        <span class="check"></span>
                        <span class="square10 inline-block bg-gray on-left"></span>  Gray
                    </label>
                </div><br/>
              </div>

        </div><br/>
        <center>
                <button type="submit" class="primary">Save</button>
        </center>
        </div>
      </div>
    <?php } ?>
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
	        required: true,
			notEqualtoOldPass: true
	      },
		  cPassword: {
	        minlength: 6,
	        required: true,
			 equalTo: "#pass"

	      },
		  oldPassword: {
	    	 minlength: 6,
	        required: true,
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
	        required: true,
            lettersonly: true
	      },
	      lname: {
	         minlength: 2,
	         required: true,
             lettersonly: true
	      },<?php if($this->session->userdata('usertype') == "USER"){?>
		  age: {
	        minlength: 1,
	        required: true,
			number: true,
    		maxlength: 2
	      },
		   address: {
	        minlength: 2,
	        required: true,
            alphanumeric: true
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



