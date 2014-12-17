<body class="metro" style="position:relative">
    <header class="bg-dark">
        <div class="navbar fixed-top ">
            <div class="navbar-content">
                <a href="#" class="element"><span class="icon-grid-view"></span> hospital management system <sup>2.0</sup></a>
                <span class="element-divider"></span>
                <a class="pull-menu" href="#"></a>
                <ul class="element-menu">
                    <li>
                    	<li><a href="<?php echo base_url()."admin/makeAnnouncement"?>">Make Announcement</a></li>
                    </li>
                    <li><span class="element-divider"></span></li>
                    <li>
                        <a class="dropdown-toggle"  href="#">Manage Users</a>
                        <ul class="dropdown-menu" data-role="dropdown">
                            <li><a href="<?php echo base_url()."add_user"?>">Add User</a></li>
                            <li><a href="<?php echo base_url()."admin/view_user"?>">View User</a></li>   
                        </ul>
                	</li>
                   
                    <li>
                    	<li><a class="element brand" href="#"><span class="icon-spin"></span></a></li>
                    </li>
                    <li>
                    	<li><a class="element brand" href="#"><span class="icon-printer"></span></a></li>
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
                      		<li><a href="#" id="editProfile">Edit Profile</a></li>
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
    
    
    
                  <script type="text/javascript">

                        $(document).on('click','#updateProfile', function(){
                        var id = $(this).siblings('input').val()
                        $.Dialog({
                            overlay: false,
                            shadow: true,
                            flat: true,
                            draggable: true,
                            icon: '<img src="<?php echo base_url('assets/images/Windows-8-Logo.png')?>">',
                            title: 'Flat window',
                            content: '',
                            width: 500,
                            padding: 10,
                            onShow: function(_dialog){
                                var content = '<form action="<?php echo base_url('main/editAccount'); ?>" method="POST" id="editaccountform">' +
                                     '<label>First Name</label>' +
                                    '<div class="input-control text"><input type="text" name="fname" value="<?php echo $this->session->userdata('fname') ?>" required>'+
                                   ' <button class="btn-clear"></button></div> ' +
                                     '<label>Last Name</label>' +
                                    '<div class="input-control text"><input type="text" name="lname" value="<?php echo $this->session->userdata('lname') ?>"  required>'+
                                   ' <button class="btn-clear"></button></div> ' +
                                      '<label>Email</label>' +
                                    '<div class="input-control text"><input type="email" name="email" value="<?php echo $this->session->userdata('email') ?>" required>'+
                                    '<label>Password</label>' +
                                    '<div class="input-control text"><input type="password" name="password"  required>'+
                                    '<label>Confirm Password</label>' +
                                    '<div class="input-control text"><input type="password" name="rpassword"  required>'+
                                   ' <button class="btn-clear"></button></div> ' +
                                   
                                  
                                    '<div class="form-actions">' +
                                    '<button class="button primary">EDIT</button> '+
                                    '<button class="button" type="button" onclick="$.Dialog.close()">Cancel</button> '+
                                    '</div>'+
                                    '</form>';
                     
                                $.Dialog.title("User login");
                                $.Dialog.content(content);
                                $.Metro.initInputs();
                            }
                        });

                        $(document).on('submit','#editaccountform', function(e){
                            //alert("asd");
                            var postData = $(this).serializeArray();
                            var formURL = $(this).attr("action");
                            
                             $.ajax({
                                url : formURL,
                                type: "POST",
                                data : postData,
                                success:function(msg) 
                                {
                                  if(msg == "success"){
                                    var not = $.Notify({
                                            style: {background: 'green', color: 'white'},
                                            caption: "Update",
                                            content: "Update of User is successful!!!",
                                            timeout: 10000 // 10 seconds
                                    });
                                     oTable.fnDraw();
                                  }else if(msg == "error"){
                                        var not = $.Notify({
                                            style: {background: 'red', color: 'white'},
                                            caption: "Update",
                                            content: "Update of User has Failed!!!",
                                            timeout: 10000 // 10 seconds
                                    });
                                  }else if(msg == 'passwordnotmatch'){
                                    var not = $.Notify({
                                            style: {background: 'red', color: 'white'},
                                            caption: "Update",
                                            content: "Password does not match.",
                                            timeout: 10000 // 10 seconds
                                    });
                                  }  
                                  
                                },
                               
                            });

                            
                            e.preventDefault(); //STOP default action
                            e.unbind(); //unbind. to stop multiple form submit.
                        });
                    }); 
 

                    </script>