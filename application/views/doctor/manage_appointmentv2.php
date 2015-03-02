
<div class="container">      
  <h2 id="_default"><i class="icon-accessibility on-left"></i>Manage Appointment</h2>

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
});						

$(document).on('click','.reject', function(){
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
            alert('Successfully Rejected Appointment');
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
      });

  	
    e.preventDefault(); //STOP default action
    e.unbind(); //unbind. to stop multiple form submit.
});


			
});//ready end
					
function  confirmDeleteFunc(id){
$.ajax({
		type: "POST",
		url: "<?php echo base_url('admin/deleteAnnouncement/')?>/"+id,
			
	}).done(function(msg){
		if(msg=="success"){
			 var not = $.Notify({
				 	style: {background: 'green', color: 'white'},
    				caption: "Delete",
       				content: "Deletion of Announcement is successful!!!",
      			  	timeout: 10000 // 10 seconds
   			 });
		 oTable.fnDraw();
		}else if(msg=="fail"){

      var not = $.Notify({
          style: {background: 'red', color: 'white'},
            caption: "Delete FAIL",
              content: "Deletion of Announcement Failed!!",
                timeout: 10000 // 10 seconds
         });
    }
				//alert(msg);
	});

}

					

</script>
