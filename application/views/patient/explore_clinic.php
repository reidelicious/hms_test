<?php echo link_tag('assets/css/l&g.css');echo link_tag('assets/css/dimmer.min.css');?>
<script src="<?php echo base_url('assets/js/dimmer.min.js')?>"></script>
<style type="text/css">
.alphabetical li .active a{
	 font-weight: bold;
	};
</style>
<div class="container">
    <div class="grid fluid">
        <div class="row">	
            <div class="span3">  </br></br></br>
            	<nav class="sidebar light">
                    <ul>
                    	<li class="stick bg-red"><a href="<?php echo base_url('patient/doctors') ?>"><i class="icon-cog"></i>Doctors</a></li>
                   		<li class="stick bg-yellow"><a href="<?php echo base_url('patient/clinics') ?>"><i class="icon-cog"></i>Clinic</a></li>
                    </ul>
                </nav>
          		<?php echo $output;?>
            </div>
            <div class="span9">
                <div class="lg"> 
                    <header>                 
                    	<h1>Clinics</h1>   
                        <strong>
				
            		</strong>    
                    </header>
                  	<div class="tab-control" data-role="tab-control">
                    
                        <ul class="tabs">
                          <?php echo $tabs ?>
                        </ul>
                        
                        
                        
                         <div class="frames">
                            <div class="frame" id="ann">
                               <?php echo $ann;?>
                            
                            </div>
                             <?php echo $docs;?>
					               </div>
               
                </div> 
            </div>                   
    </div>
</div>



<script type="text/javascript">

$(document).on('click','.clinic_list', function(){
		var $clinic_id = $(this).children('#clinic_id').val();
	//	var $clinic_name = $(this).children('#clinic_id').val();	
	window.location.replace("<?php echo base_url('patient/clinics/clinic_id/').'/'; ?>"+$clinic_id+"");	

/*  $.ajax({
        url : "get_clinic_info/"+$clinic_id+"",
        type: "GET",
       // data : postData,
        success:function(msg) 
        {
			alert(msg);
		}
	  });
*/
	});	//end of viewProfile
    
 
 	$(document).on('click','.makeAppointment', function(){
	  $(".appointmentForm").toggle();
	  var currentdate = new Date(); 
	  var date = "Last Sync: "+ currentdate.getFullYear() + " / " 
                + (currentdate.getMonth()+1)  + "/"
				+ currentdate.getDate() + "@" ;
		var app = 				'<label>Date</label>' +
											'<div class="input-control text" id="datepicker" data-role="datepicker" data-date="'+date+'"  data-format="dddd, mmmm d, yyyy" data-effect="fade">'+
                                   ' <input type="text" placeholder="please enter date" >'+
                                   ' <button class="btn-date"></button>'+
                              '  </div> '+
											'<label>Time</label>' +
											'<div class="input-control text"><input type="time"  value= "" name="time" required>'+
											'</div> ' ;
		
		$('.appointmentForm').html(app);
	});
    
</script>