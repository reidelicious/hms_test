<style>

.pull-left {
  float: left !important;
  margin-left:0 !important;
}
.pull-right {
  float: right !important;
}

</style>
<body class="metro">
<div class="bg-lightBlue fg-white">
			<img src = "<?php echo base_url('assets/images/Icon/hms-logo.png'); ?>" style="width: 100px; height: 100px;">
</div>
	<div class="container">
		<div class="grid fluid">
			<div class="row">
				<div class="span6 offset3">
					<h1>Sign up</h1>    
						<?php $attributes = array('id' => 'signup');

                        echo form_open('main/signup_validation',$attributes);
                        echo validation_errors();
						 ?>
						<fieldset>
						</br>
						<div class="input-control text " data-role="input-control">
							<?php echo form_input('fname', '', 'placeholder="First Name"'); ?>
                            <button class="btn-clear" tabindex="-1"></button>
						</div>	
						<div class="input-control text" data-role="input-control">
							<?php echo form_input('lname', '', 'placeholder="Last Name"'); ?>
                            <button class="btn-clear" tabindex="-1"></button>
						</div>
						</br>
						<div class="input-control text" data-role="input-control">
							<?php echo form_email('email', $this->input->post('email'),'placeholder="Email"'); ?>
							<button class="btn-clear" tabindex="-1"></button>
						</div>
						</br>	
						<div class="input-control password" data-role="input-control">
							<?php echo form_password('password', '', 'id ="pass" placeholder="Password"'); ?>
							<button class="btn-reveal"></button>
						</div>
						</br>
						<div class="input-control password" data-role="input-control">
							<?php echo form_password('cPassword', '', 'placeholder="Confirm Password"'); ?>
							<button class="btn-reveal"></button>
						</div>
						</br>
						<div class="input-control text" data-role="input-control">
							<?php echo form_input('age', '', 'placeholder="Age"'); ?>
                            <button class="btn-clear" tabindex="-1"></button>
						</div>
						</br>
						<div class="input-control select">
							<select name="gender">
								<option value='1'<?php echo set_select('gender', '1', TRUE); ?>> Male</option>
								<option value='2' <?php echo set_select('gender', '2'); ?>> Female</option>						
							</select>
						</div>
						</br>
						<div class="input-control text" data-role="input-control">	
							<?php echo form_input('address', '', 'placeholder="Address"'); ?>
                            <button class="btn-clear" tabindex="-1"></button>
						</div>
						</br></br>
						<?php echo form_submit('signup_submit','Create Account','class="large info"'); 
						$data = array(
              				'usertype'  => '1'
            			);
						echo form_hidden($data); ?>
						</fieldset>
						<?php echo form_close(); ?>
					</div>
		</div>
	</div>
	</div>
    
    
<?php echo $mail;
	echo $success;
	echo $notif;
?>


</body>



<script type="text/javascript">
$(document).ready(function(){

	// Validate
	// http://bassistance.de/jquery-plugins/jquery-plugin-validation/
	// http://docs.jquery.com/Plugins/Validation/
	// http://docs.jquery.com/Plugins/Validation/validate#toptions

		$('#signup').validate({
	    rules: {
	      fname: {
	        minlength: 2,
	        required: true
	      },
	      lname: {
	         minlength: 2,
	         required: true
	      },
	      email: {
	      	minlength: 2,
	        required: true
	      },
	      password: {
	        minlength: 6,
	        required: true
	      },
		  cPassword: {
	        minlength: 6,
	        required: true,
			 equalTo: "#pass"

	      },
		  age: {
	        minlength: 1,
	        required: true,
			number: true,
    		maxlength: 2
	      },
		   address: {
	        minlength: 2,
	        required: true
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
</html>