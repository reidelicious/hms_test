<body class="metro">
    <header class="bg-dark">
        <div class="navbar fixed-top <?php echo $this->session->userdata('timeline'); ?>">
            <div class="navbar-content <?php echo $this->session->userdata('timeline'); ?>">
                <a href="<?php echo base_url()."home_doctor"?>" class="element"><span class="icon-accessibility"></span>    Doctor's Appointment System<sup>beta</sup></a>
                <span class="element-divider"></span>
                <a class="pull-menu" href="#"></a>
                <ul class="element-menu">
                    <li>
                        <li><a href="<?php echo base_url()."home_doctor"?>">Home </a></li>
                    </li>
                    <li>
                        <a class="dropdown-toggle"  href="#">Appointments </a>
                        <ul class="dropdown-menu" data-role="dropdown">
                            <li><a href="<?php echo base_url()."manage_appointmentv2"?>">Manage Appointments</a></li>
                            <li><a href="<?php echo base_url()."view_appointment"?>">View Timeline</a></li>   
                            <li><a href="<?php echo base_url()."view_records"?>">View Records</a></li>   
                        </ul>
                    </li>
                    <li>
                        <li><a href="<?php echo base_url()."manage_schedules"?>">Manage Schedules </a></li>
                    </li>
                    <li>
                        <a class="dropdown-toggle"  href="#">Manage Announcement </a>
                        <ul class="dropdown-menu" data-role="dropdown">
                            <li><a href="<?php echo base_url()."makeAnnouncement_doctor"?>">Make Announcement</a></li>
                            <li><a href="<?php echo base_url()."viewAnnouncement"?>">View Announcement</a></li>   
                        </ul>
                    </li>
                </ul>
                 <ul class="element-menu place-right">
                 	<li>
                        <a href="<?php echo base_url()."home_doctor"?>"  class="element image-button image-left">
                       	<?php echo $this->session->userdata('fname') ."  " .$this->session->userdata('lname') ;  ?>
                       <?php echo  img(''.$this->session->userdata('avatar').''); ?>
                        </a>
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