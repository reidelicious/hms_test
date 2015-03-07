
<div class="container">      
  <h2 id="_default"><i class="icon-accessibility on-left"></i>View Clinic</h2>

  <div class="grid fluid">   
  	<div class="row"> 
  			<?php echo $this->table->generate();   
              ?>
    </div>
  </div>
</div>

  


<script>

$( document ).ready(function() {	
	 oTable = $('#dataTables-1').dataTable( {
		"bProcessing": true,
		"bServerSide": true,
		"sAjaxSource": '<?php echo base_url('admin/datatable_clinic'); ?>',
                
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
				   
 				
		



					
$(document).on('click','.editInfo', function(){
	var room_num = $(this).parents('td').prev();	
	var specialization = room_num.prev();	
	var clinicname = specialization.prev();
	
	var id = $(this).siblings('input').val()
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
            var content = '<form action="<?php echo base_url('admin/editClinicInfo'); ?>" method="POST" id="editform">' +
                '<label>ID</label>' +
                '<div class="input-control text"><input type="text" name="id" value="'+id+'" readOnly="true">'+
               ' <button class="btn-clear"></button></div> ' +
			           '<label>Clinic Name</label>' +
                '<div class="input-control text"><input type="text"  value= "'+clinicname.text()+'" name="clinicname" required>'+
               ' <button class="btn-clear"></button></div> ' +
			          '<label>Specialization</label>' +
                '<div class="input-control text"><input type="text" value = "'+specialization.text()+'" name="specialization" readOnly="true">'+
               ' <button class="btn-clear"></button></div> ' +
			           '<label>room_num</label>' +
				        '<div class="input-control text"><input type="text" value = "'+room_num.text()+'" name="room_num" required>'+
               ' <button class="btn-clear"></button></div> ' +
			  
                '<div class="form-actions">' +
                '<button class="button primary" >EDIT</button> '+
                '<button class="button" type="button" onclick="$.Dialog.close()">Cancel</button> '+
                '</div>'+
                '</form>';
 
            $.Dialog.title("Modify Clinic");
            $.Dialog.content(content);
            $.Metro.initInputs();
        }
    });
    
    $('#editform').validate({
        rules: {
          clinicname: {
            minlength: 2,
            required: true,
            lettersonly: true
          },
          room_num: {
             minlength: 2,
             required: true,
             alphanumeric: true
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
  
});					
		
		
	
					

$(document).on('click','.deleteUser', function(){
	var id = $(this).siblings('input').val()
    $.Dialog({
        overlay: true,
        shadow: true,
        flat: true,
		draggable: true,
        icon: '<img src="images/excel2013icon.png">',
        title: 'Delete Clinic',
		width: 300,
        content: '',
        padding: 10,
        onShow: function(_dialog){
            var content = '<div>Are you sure you want to delete this clinic? </div></br>' +
						  '<div class="grid fluid">'+
   						  '<div class="row">'+
                		  '<div class="span8 offset2"> <button class="btn-close" onclick="$.Dialog.close()"><i class="icon-folder-2 on-left"></i>Cancel</button> '+
    					  '<button class="confirmDelete" value="'+id+'" onclick="$.Dialog.close();confirmDeleteFunc(this.value); "><i class="icon-floppy on-left"></i>Save</button>'+
        				  '</div>'+
   						  '</div>'+
						'</div> ';
						
 
            $.Dialog.title("Delete Clinic ");
            $.Dialog.content(content);
            $.Metro.initInputs();
        }
    });
	

});	

$(document).on('submit','#editform', function(e){
    var postData = $(this).serializeArray();
	var formURL = $(this).attr("action");
	var r = confirm('are you sure?');
	
	if( r == true){
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
       				content: "Update of Clinic is successful!!!",
      			  	timeout: 10000 // 10 seconds
			});
			 oTable.fnDraw();
		  }else if(msg == "error"){
			 	var not = $.Notify({
				 	style: {background: 'red', color: 'white'},
    				caption: "Update",
       				content: "Update of clinic has Failed!!!",
      			  	timeout: 10000 // 10 seconds
			});
		  }  
		  
        },
       
    });
	}else{}
  	
    e.preventDefault(); //STOP default action
    e.unbind(); //unbind. to stop multiple form submit.
});


			
});//ready end
					
function  confirmDeleteFunc(id){
$.ajax({
		type: "POST",
		url: "<?php echo base_url('admin/deleteClinic/')?>/"+id,
			
	}).done(function(msg){
		if(msg=="success"){
			 var not = $.Notify({
				 	style: {background: 'green', color: 'white'},
    				caption: "Delete",
       				content: "Deletion of Clinic is successful!!!",
      			  	timeout: 10000 // 10 seconds
   			 });
		 oTable.fnDraw();
		}else if(msg=="fail"){

      var not = $.Notify({
          style: {background: 'red', color: 'white'},
            caption: "Delete FAIL",
              content: "Deletion of Clinic Failed. Remove first the doctors inside the clinic!!",
                timeout: 10000 // 10 seconds
         });
    }
				//alert(msg);
	});

}

					

</script>
