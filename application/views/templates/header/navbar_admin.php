<body class="metro" style="position:relative">
    <header class="bg-dark">
        <div class="navbar fixed-top ">
            <div class="navbar-content">
                <a href="<?php echo base_url()."add_user"?>" class="element"><span class="icon-accessibility"></span>    Doctor's Appointment System<sup>beta</sup></a>
                <span class="element-divider"></span>
                <a class="pull-menu" href="#"></a>
                <ul class="element-menu">

                    <li><span class="element-divider"></span></li>
                    <li>
                        <a class="dropdown-toggle"  href="#">Manage Users</a>
                        <ul class="dropdown-menu" data-role="dropdown">
                            <li><a href="<?php echo base_url()."add_user"?>">Add User</a></li>
                            <li><a href="<?php echo base_url()."admin/view_user"?>">View User</a></li>   
                        </ul>
                	</li>
                    <li>
                        <a class="dropdown-toggle"  href="#">Manage Clinic</a>
                        <ul class="dropdown-menu" data-role="dropdown">
                            <li><a href="<?php echo base_url()."add_clinic"?>">Add Clinic</a></li>
                            <li><a href="<?php echo base_url()."admin/view_clinic"?>">View Clinic</a></li>   
                        </ul>
                    </li>                   
                    <li>
                        <a class="dropdown-toggle" href="#">Manage Announcement</a>
                        <ul class="dropdown-menu" data-role="dropdown">
                           <li><a href="<?php echo base_url()."admin/makeAnnouncement"?>">Make Announcement</a></li>
                           <li><a href="<?php echo base_url()."admin/view_announcement"?>">View Announcements</a></li>
                        </ul>
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
    
    
    
         
