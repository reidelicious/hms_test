<body class="metro">
    <header class="bg-dark">
        <div class="navbar fixed-top ">
            <div class="navbar-content">
                <a href="#" class="element"><span class="icon-grid-view"></span> Hospital Management System <sup>Alpha v1.0</sup></a>
                <span class="element-divider"></span>
                <a class="pull-menu" href="#"></a>
                <ul class="element-menu">
                    <li>
                        <li><a href="<?php echo base_url()."home"?>">Home </a></li>
                    </li>
                    <li>
                        <li><a href="<?php echo base_url()."appointment"?>">Appointments </a></li>
                    </li>
                    <li>
                    	<li><a href="<?php echo base_url()."makeAnnouncement_doctor"?>">Make Announcement </a></li>
                    </li>
                    <li>
                        <div class="element input-element">
                            <form>
                                <div class="input-control text">
                                    <input type="text" placeholder="Search...">
                                    <button class="btn-search"></button>
                                </div>
                            </form>
                        </div>
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
                            <li><a href="#">Products</a></li>
                            <li><a href="#">Download</a></li>
                            <li><a href="#">Support</a></li>
                            <li><a href="<?php echo base_url()."main/logout" ?>"> Log out</a></li>
                        </ul>
               
                    </li>
                    <li> <span class="element-divider place-right"></span></li>
                 
                   
                   
               
               </ul>
            </div> <!--navbar-content -->
        </div><!-- navbar fixed-top---> 
    </header>