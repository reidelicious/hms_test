
<div class="container">      
  <h2 id="_default"><i class="icon-accessibility on-left"></i>View Announcements</h2>

  <div class="grid fluid">   
  	<div class="row"> 
  			<?php echo $this->table->generate();    ?>
    </div>
  </div>
</div>

  


<script>

$( document ).ready(function() {	
	 oTable = $('#dataTables-1').dataTable( {
		"bProcessing": true,
		"bServerSide": true,
		"sAjaxSource": '<?php echo base_url('admin/datatable_announcement'); ?>',
                
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
	var madefrom = $(this).parents('td').prev();	
	var subject = madefrom.prev();	
  
  var id = $(this).siblings('input').val();
  var details = $(this).siblings('div').html();

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
            var content = '<form action="<?php echo base_url('admin/editAnnouncement'); ?>" method="POST" id="editform">' +
                '<label>ID</label>' +
                '<div class="input-control text"><input type="text" name="id" value="'+id+'" readOnly="true">'+
               ' <button class="btn-clear"></button></div> ' +
			           '<label>Subject</label>' +
                '<div class="input-control text"><input type="text"  value= "'+subject.text()+'" name="subject" required>'+
               ' <button class="btn-clear"></button></div> ' +
			          '<label>Details</label>' +
                '<textarea name="details" style="display:block; width:100%; max-width:100%;" required>'+details+'</textarea>'+
               ' <button class="btn-clear"></button></div> ' +
			  
                '<div class="form-actions">' +
                '<button class="button primary" onclick="$.Dialog.close()">EDIT</button> '+
                '<button class="button" type="button" onclick="$.Dialog.close()">Cancel</button> '+
                '</div>'+
                '</form>';
 
            $.Dialog.title("Modify Announcement");
            $.Dialog.content(content);
            $.Metro.initInputs();
        }
    });
    
    $('#editform').validate({
        rules: {
          subject: {
            minlength: 2,
            required: true,
            alphanumeric: true
          },
          details: {
             minlength: 2,
             required: true
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
        title: 'Delete Announcement',
		width: 300,
        content: '',
        padding: 10,
        onShow: function(_dialog){
            var content = '<div>Are you sure you want to delete this announcement? </div></br>' +
						  '<div class="grid fluid">'+
   						  '<div class="row">'+
                		  '<div class="span8 offset2"> <button class="btn-close" onclick="$.Dialog.close()"><i class="icon-folder-2 on-left"></i>Cancel</button> '+
    					  '<button class="confirmDelete" value="'+id+'" onclick="$.Dialog.close();confirmDeleteFunc(this.value); "><i class="icon-floppy on-left"></i>Delete</button>'+
        				  '</div>'+
   						  '</div>'+
						'</div> ';
						
 
            $.Dialog.title("Delete Announcement ");
            $.Dialog.content(content);
            $.Metro.initInputs();
        }
    });
	

});	

$(document).on('submit','#editform', function(e){
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
       				content: "Update of Announcement is successful!!!",
      			  	timeout: 10000 // 10 seconds
			});
			 oTable.fnDraw();
		  }else if(msg == "error"){
			 	var not = $.Notify({
				 	style: {background: 'red', color: 'white'},
    				caption: "Update",
       				content: "Update of Announcement has Failed!!!",
      			  	timeout: 10000 // 10 seconds
			});
		  }  
		  
        },
       
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
