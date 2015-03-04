
<div class="container">      
  <h2 id="_default"><i class="icon-accessibility on-left"></i>Records of Appointments</h2>

  <div class="input-control select span4">
      <span class="text-warning" style="font-family:verdana; font-size:14px;">SHOW: 
          <select style="margin-top:10px;" onChange="location = this.options[this.selectedIndex].value">
              <?php if(!$this->input->get('show')) { ?>
                  <option selected value="<?php echo base_url(); ?>view_records_patient">History</option>
                  <option value="<?php echo base_url(); ?>view_records_patient?show=1">Upcoming</option>
                  <option value="<?php echo base_url(); ?>view_records_patient?show=2">Rejected</option>
              <?php }if($this->input->get('show') == '1'){ ?>
                  <option selected value="<?php echo base_url(); ?>view_records_patient">History</option>
                  <option <?php echo $_GET['show'] == '1' ? 'selected' : ''?> value="<?php echo base_url(); ?>view_records_patient?show=1">Upcoming</option>
                  <option <?php echo $_GET['show'] == '2' ? 'selected' : ''?> value="<?php echo base_url(); ?>view_records_patient?show=2">Rejected</option>
              <?php }if($this->input->get('show') == '2'){ ?>
                  <option selected value="<?php echo base_url(); ?>view_records_patient">History</option>
                  <option <?php echo $_GET['show'] == '1' ? 'selected' : ''?> value="<?php echo base_url(); ?>view_records_patient?show=1">Upcoming</option>
                  <option <?php echo $_GET['show'] == '2' ? 'selected' : ''?> value="<?php echo base_url(); ?>view_records_patient?show=2">Rejected</option>
              <?php } ?>
           </select>
      </span>
  </div><br/>
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
  if($('#filter').val() == '2'){
     oTable = $('#dataTables-1').dataTable({
      "bProcessing": true,
      "bServerSide": true,
      "sAjaxSource": '<?php echo base_url('patient/datatable_rejectedAppointments_Patients'); ?>',
                  
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
    });
  }else if($('#filter').val() == '1'){
    oTable = $('#dataTables-1').dataTable({
      "bProcessing": true,
      "bServerSide": true,
      "sAjaxSource": '<?php echo base_url('patient/datatable_upcoming_Patients'); ?>',
                  
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
    });
  }else{
    oTable = $('#dataTables-1').dataTable({
      "bProcessing": true,
      "bServerSide": true,
      "sAjaxSource": '<?php echo base_url('patient/datatable_history_Patients'); ?>',
                  
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
    });
  }
           
        
  $(document).on('click', '#refresh', function(){
    oTable.fnDraw();
  });
    



          
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
