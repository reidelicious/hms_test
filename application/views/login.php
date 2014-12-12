
    
 <style type="text/css">

/* Glyph, by Harry Roberts */
		
hr.style-eight {
    padding: 0;
    border: none;
    border-top: medium double #333;
    color: #333;
    text-align: center;
}
hr.style-eight:after {
    content: "OR";
    display: inline-block;
    position: relative; 
    top: -0.7em;  
    font-size: 1.5em;
    padding: 0 0.25em;
    background: white;
}
.btn-block {
display: block;
width: 100%;
}
	</style>
</head>
<body class="metro">

<div class=" bg-lightBlue fg-white">
  <?php $data = array( 'src' => 'assets/images/hms-logo.png', 'width' => '100','height' => '100'); echo img($data); ?>
</div>
  <div class="container">
    <div class="grid fluid">
          <div class="row">
            <div class="span5 offset1">
              </br></br></br></br>
              <strong><h2>Welcome to Hospital Management System.</h2></strong>
              <p>Make and Schedule your appointment to a Doctor -- Know your doctor and many more.</p>
            </div>
            <div class="span4 offset1">
              <center><img src = "<?php echo base_url('assets/images/hms-logo.png'); ?>" style="width:120px; height: 120px; border-radius:10px;"></center>
             <form action="<?php echo base_url('main/login_validation') ?>" method="post">
              <?php
               // echo form_open('main/login_validation'); 
                echo validation_errors();
			 ?>  
             </fieldset>
              </br>
                <div class="input-control text" data-role="input-control">
                   
                    <input type="email" name="email" placeholder="enter your email" value="<?php echo $this->input->post('email');?>" required>
                    
            
                    <button class="btn-clear" tabindex="-1"></button>
                </div>
         
                  <div class="input-control password" data-role="input-control">
						<?php $data = array( 'name'=> 'password', 'placeholder'=>'enter your password', 'required'=>'required');?>
                        <?php echo form_password($data);  ?>
                        <button class="btn-reveal" tabindex="-1"></button>
                   </div>
                  <?php echo form_submit('login_submit','Sign In','class="large info btn-block"'); ?>
               </fieldset>
               
               </form>
              <?php //echo form_close(); ?>
              <hr class="style-eight">
              <a href="<?php echo base_url('new_user/signup ')?>"><button  class="large default btn-block">Create New Account</button></a>
            </div>
          </div>
    </div>
  </div>
</body>
</html>