
<div class="container">      
  <h2 id="_default"><i class="icon-accessibility on-left"></i>All Rejected Appointments</h2>

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
		"sAjaxSource": '<?php echo base_url('doctor/datatable_rejectedAppointments'); ?>',
                
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
				   
 				
		



					
$(document).on('click','.showMsg', function(){
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
            var content = '<p class="readable-text">'+details+'</p>';
 
            $.Dialog.title("Message");
            $.Dialog.content(content);
        }
    });
});
});				
							

</script>
