
<div class="container">      
  <h2 id="_default"><i class="icon-accessibility on-left"></i>Manage Appointments</h2>

  <div class="input-control select span4">
      <span class="text-warning" style="font-family:verdana; font-size:14px;">SHOW: 
          <select style="margin-top:10px;" onChange="location = this.options[this.selectedIndex].value">
              <?php if(!$this->input->get('show')) { ?>
                  <option selected value="<?php echo base_url(); ?>manage_appointmentv2">Active</option>
                  <option value="<?php echo base_url(); ?>manage_appointmentv2?show=1">Inactive</option>
              <?php }if($this->input->get('show') == '1'){ ?>
                  <option selected value="<?php echo base_url(); ?>manage_appointmentv2">Active</option>
                  <option <?php echo $_GET['show'] == '1' ? 'selected' : ''?> value="<?php echo base_url(); ?>manage_appointmentv2?show=1">Inactive</option>
              <?php } ?>
           </select>
      </span>
  </div>
  <br/>
  <button type="button" class="warning" id="refresh"><i class="icon-cycle"></i> Refresh</button>
  <input type="hidden" value="<?php echo $this->input->get('show'); ?>" id="filter" />
  <div class="grid fluid">   
  	<div class="row"> 
  			<?php echo $this->table->generate();    ?>
    </div>
  </div>
</div>

  


<script>

$( document ).ready(function() {
if($('#filter').val() == '1'){
  oTable = $('#dataTables-1').dataTable( {
    "bProcessing": true,
    "bServerSide": true,
    "sAjaxSource": '<?php echo base_url('doctor/datatable_inactiveAppointments'); ?>',
                
                "sPaginationType": "full_numbers",
           
         
        "fnInitComplete": function() {
                //oTable.fnAdjustColumnSizing();
         },
                'fnServerData': function(sSource, aoData, fnCallback)
            {
              $.ajax
              ({
                'dataType': 'json',
                'type'    : 'POST',
                'url'     : sSource,
                'data'    : aoData,
                'success' : fnCallback
              });
            }
  } );
}	
else{
  oTable = $('#dataTables-1').dataTable( {
    "bProcessing": true,
    "bServerSide": true,
    "sAjaxSource": '<?php echo base_url('doctor/datatable_activeAppointments'); ?>',
                
                "sPaginationType": "full_numbers",
           
         
        "fnInitComplete": function() {
                //oTable.fnAdjustColumnSizing();
         },
                'fnServerData': function(sSource, aoData, fnCallback)
            {
              $.ajax
              ({
                'dataType': 'json',
                'type'    : 'POST',
                'url'     : sSource,
                'data'    : aoData,
                'success' : fnCallback
              });
            }
  } );
}
	 
var hybridID;			   
 				
$(document).on('click', '#refresh', function(){
  oTable.fnDraw();
});


$(document).on('click', '.approve', function(){
  var bla = $(this).parents('td').prev();
  hybridID = $(this).siblings('input').val();
  var fname = bla.prev();
  var lname = fname.prev();
  var time = lname.prev();
  var date = time.prev();
  $.Dialog({
        overlay: true,
        shadow: true,
        flat: true,
        draggable: true,
        icon: '<img src="images/excel2013icon.png">',
        title: 'Approving Appointment',
        width: 300,
        content: '',
        padding: 10,
        onShow: function(_dialog){
            var content =     '<p class="readable-text">Requesting for an appointment<p/>' +
                              '<dl class="horizontal">' + 
                              '<dt>Patient Name: </dt>' + 
                              '<dd>' + lname.text() + ", " + fname.text() +'</dd>' +
                               
                              '<dt>Date: </dt>' + 
                              '<dd>' + date.text() + "</dd>" + 
                              '<dt>Time: </dt>' +
                              '<dd>' + time.text() + '</dd>' +
                              '</dl><center><div class="readable-text">Are you sure you want to approve this appointment?</div>' +
                              '<div class="grid fluid">'+
                              '<div class="row">'+
                              '<div class="span8 offset2"> <button class="danger btn-close" onclick="$.Dialog.close()"><i class="icon-cancel-2 on-left"></i>   NO</button> '+
                              '<button class="primary confirmOverwrite" id="overwrite" onclick="$.Dialog.close();approveAppointment()"><i class="icon-thumbs-up on-left"></i>  YES</button>'+
                              '</div>'+
                              '</div></center>'+
                            '</div> ';
            
 
            $.Dialog.title("Approving Appointment");
            $.Dialog.content(content);
            $.Metro.initInputs();
        }
    });
});

window.approveAppointment = function(){
        flag = 1;
        
        $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>doctor/changeStat_appointmentToApprove",
                data: {id:hybridID},
                success:function(msg){
                  if(msg == "Success"){
                    var not = $.Notify({
                      style: {background: 'green', color: 'white'},
                      caption: "Approved Appointment!",
                      content: "Approving of Appointment is Successful!",
                      timeout: 10000 // 10 seconds
                     });
                  }else{
                    var not = $.Notify({
                      style: {background: 'red', color: 'white'},
                      caption: "Error!",
                      content: "Approving of Appointment Errored!",
                      timeout: 10000 // 10 seconds
                    });
                  }
                }
            }).done(function(){
                oTable.fnDraw();
            });
    };

    window.rejectAppointment = function(){
          $.Dialog({
                overlay: true,
                shadow: true,
                flat: true,
                draggable: true,
                icon: '<img src="<?php echo base_url('assets/images/Windows-8-Logo.png')?>">',
                title: 'Flat window',
                content: '',
                width: 500,
                padding: 10,
                onShow: function(_dialog){
                    var content = '<form action="<?php echo base_url('doctor/changeStat_appointmentToReject'); ?>" method="POST" id="editform">' +
                        '<label class="readable-text">Send a message to the Patient</label>'+
                        '<textarea style="margin: 0px; height:200px; width: 100%; max-width: 100%;" name="message"  required></textarea>'+
                       '<div class="input-control text"><input type="hidden" name="appointid" value="'+hybridID+'" required>'+
                        '<div class="form-actions">' +
                        '<button type="submit" class="button primary" onclick="$.Dialog.close();">Send</button> '+
                        '<button class="button" type="button" onclick="$.Dialog.close()">Cancel</button> '+
                        '</div>'+
                        '</form>';
                    $.Dialog.title("Send a message to the Patient");
                    $.Dialog.content(content);
                    $.Metro.initInputs();
                }
            });
    }

					
/*
$(document).on('click','.approve', function(){
	   if(confirm("Are you sure you want to approve this appointment?")){
            var id = $(this).siblings('input').val();
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>doctor/changeStat_appointmentToApprove",
                data: {id:id},
                success:function(result){
                  if(result == "Success"){
                    alert('Successfull Approved Appointment');
                  }else{
                    var not = $.Notify({
                      style: {background: 'red', color: 'white'},
                        caption: "Error on Rejecting Appointment",
                            timeout: 10000 // 10 seconds
                     });
                  }  
                }
            }).done(function(){
              oTable.fnDraw();
            })
        }
});			*/			

$(document).on('click','.reject', function(){
  var bla = $(this).parents('td').prev();
  hybridID = $(this).siblings('input').val();
  
  var fname = bla.prev();
  var lname = fname.prev();
  var time = lname.prev();
  var date = time.prev();
    $.Dialog({
        overlay: true,
        shadow: true,
        flat: true,
        draggable: true,
        icon: '<img src="images/excel2013icon.png">',
        title: 'Rejecting Appointment',
        width: 300,
        content: '',
        padding: 10,
        onShow: function(_dialog){
            var content =     '<p class="readable-text">Requesting for an appointment<p/>' +
                              '<dl class="horizontal">' + 
                              '<dt>Patient Name: </dt>' + 
                              '<dd>' + lname.text() + ", " + fname.text() +'</dd>' +
                               
                              '<dt>Date: </dt>' + 
                              '<dd>' + date.text() + "</dd>" + 
                              '<dt>Time: </dt>' +
                              '<dd>' + time.text() + '</dd>' +
                              '</dl><center><div class="readable-text">Are you sure you want to reject this appointment?</div>' +
                              '<div class="grid fluid">'+
                              '<div class="row">'+
                              '<div class="span8 offset2"> <button class="danger btn-close" onclick="$.Dialog.close()"><i class="icon-cancel-2 on-left"></i>   NO</button> '+
                              '<button class="primary confirmOverwrite" id="overwrite" onclick="$.Dialog.close();rejectAppointment(); "><i class="icon-thumbs-up on-left"></i>  YES</button>'+
                              '</div>'+
                              '</div></center>'+
                            '</div> ';
 
            $.Dialog.title("Rejecting Appointment");
            $.Dialog.content(content);
            $.Metro.initInputs();
        }
    });

/*

	 if(confirm("Are you sure you want to reject this appointment?")){
            var id = $(this).siblings('input').val();
            var flag = 1;
            $.Dialog({
                overlay: true,
                shadow: true,
                flat: true,
                draggable: true,
                icon: '<img src="<?php echo base_url('assets/images/Windows-8-Logo.png')?>">',
                title: 'Flat window',
                content: '',
                width: 500,
                padding: 10,
                onShow: function(_dialog){
                    var content = '<form action="<?php echo base_url('doctor/changeStat_appointmentToReject'); ?>" method="POST" id="editform">' +
                        '<textarea style="margin: 0px; height:200px; width: 100%; max-width: 100%;" name="message"  required></textarea>'+
                       '<div class="input-control text"><input type="hidden" name="appointid" value="'+id+'" required>'+
                        '<div class="form-actions">' +
                        '<button class="button primary" onclick="$.Dialog.close();">Send</button> '+
                        '<button class="button" type="button" onclick="$.Dialog.close()">Cancel</button> '+
                        '</div>'+
                        '</form>';
                    $.Dialog.title("Send a message to the Patient");
                    $.Dialog.content(content);
                    $.Metro.initInputs();
                }
            });
        }
	
*/
});	

$(document).on('submit','#editform', function(e){
    var postData = $(this).serializeArray();
	var formURL = $(this).attr("action");
	
     $.ajax({
        url : formURL,
        type: "POST",
        data : postData,
        success:function(msg){ 
          if(msg == "success"){
            var not = $.Notify({
                    style: {background: 'green', color: 'white'},
                    caption: "Rejected Appointment",
                    content: "Rejecting of Appointment is Successful!",
                    timeout: 10000 // 10 seconds
                 });
  		    }else{
    			 	var not = $.Notify({
				 	          style: {background: 'red', color: 'white'},
    				        caption: "Error!",
                    content: "Rejecting of Appointment Errors!",
      			  	    timeout: 10000 // 10 seconds
			           });
  		    }  
      }
      }).done(function(){
        oTable.fnDraw();
      });

  	
    e.preventDefault(); //STOP default action
    e.unbind(); //unbind. to stop multiple form submit.
});


			
});//ready end
					


					

</script>
