
<div class="container">      
  <h2 id="_default"><i class="icon-accessibility on-left"></i>All Rejected Appointments</h2>

  <div class="input-control select span4">
      <span class="text-warning" style="font-family:verdana; font-size:14px;">SHOW: 
          <select style="margin-top:10px;" onChange="location = this.options[this.selectedIndex].value">
              <?php if(!$this->input->get('show')) { ?>
                  <option selected value="<?php echo base_url(); ?>view_table">History</option>
                  <option value="<?php echo base_url(); ?>view_table?show=1">Upcoming</option>
                  <option value="<?php echo base_url(); ?>view_table?show=2">Rejected</option>
           </select>
      </span>
  </div>

  <div class="grid fluid">   
  	<div class="row"> 
  			<?php echo $this->table->generate();    ?>
    </div>
  </div>
</div>

  


<script>

$( document ).ready(function() {	
	 oTable = $('#dataTables-1').dataTable({
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
