<body class="metro">
    <header class="bg-dark">
        <div class="navbar fixed-top <?php echo $this->session->userdata('timeline'); ?>">
            <div class="navbar-content <?php echo $this->session->userdata('timeline'); ?>">
                <a href="<?php echo base_url()."home"?>" class="element"><span class="icon-accessibility"></span>    Doctor's Appointment System<sup>beta</sup></a>
                <span class="element-divider"></span>
                <a class="pull-menu" href="#"></a>
                <ul class="element-menu">
                    <li>
                        <li><a href="<?php echo base_url()."home"?>">Home </a></li>
                    </li>
                    <li>
                        <a class="dropdown-toggle" href="#">Appointments </a>
                        <ul class="dropdown-menu" data-role="dropdown">
                            <li><a href="<?php echo base_url()."appointmentv4"?>">Make Appointment</a></li>
                            <li><a href="<?php echo base_url()."view_records_patient"?>">View Records</a></li>   
                        </ul>
                    </li>
                    <li>
                    	<li><a href="<?php echo base_url()."explore"?>">Explore </a></li>
                    </li>
    
                </ul>
                 <ul class="element-menu place-right">
                 	<li>
                    	<button class="element image-button image-left">
                       	<?php echo $this->session->userdata('fname') ."  " .$this->session->userdata('lname') ;  ?>
                       <?php echo  img(''.$this->session->userdata('avatar').''); ?>
                        </button>
                    </li>
                    
                 	<li>
                        <a class="dropdown-toggle" href="#"><span class="icon-cog"></span></a>
                        <ul class="dropdown-menu place-right" data-role="dropdown">
                        	<li><a href="<?php echo base_url()."main/settings" ?>" id="editProfile">Edit Profile</a></li>    
                            <li><a href="<?php echo base_url()."main/logout" ?>"> Log out</a></li>
                        </ul>
               
                    </li>
                    <li> <span class="element-divider place-right"></span></li>
                 
                   
                   
               
               </ul>
            </div> <!--navbar-content -->
        </div><!-- navbar fixed-top---> 
    </header>