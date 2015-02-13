   
    <div class = "container">
    <h2 id="_default"><i class="icon-accessibility on-left"></i>Appointments</h2>
    <form action="<?php echo base_url('doctor/generateToDoc'); ?>" method="POST">
        <input type="hidden" name="deyt" id="d">
        <button type="submit" id="gen" class="primary" style="display:none;">Generate into .docx</button>
    </form>
	<div class="grid fluid">
    	<div class="row">
        	<div class="span3">
            	 <div class="calendar" id="component_id" ></div>
                 <div id="calendar-output"></div>
            </div>
            <div class="span9">
            	<div id="timeline">
                </div>
                <div id="noapp" class="header readable-text text-warning" style="display:none;">No Appointments Available on this Date</div>
            </div>
        </div>
      </div>   






<script type="text/javascript">
$(document).ready(function(){
    var day = '';
   var cal =  $('#component_id').calendar({
        format: 'yyyy-mm-dd',
        multiSelect: false, //default true (multi select date)
        startMode: 'day', //year, month, day
      
        locale: 'en', // 'ru', 'ua', 'fr' or 'en', default is $.Metro.currentLocale
        otherDays: false, // show days for previous and next months,
        weekStart: 0, //start week from sunday - 0 or monday - 1
        click: function(d){
                var out = $("#calendar-output").html("");
                day = d;
                $('#d').val(day);
                $('#timeline').empty();
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>doctor/build_timeline_doctor",
                    data: {d:d},
                    success: function(data){
                        if(data != "No Appointment"){
                            $('#noapp').hide();
                            $('#gen').show();
                            $('#timeline').html(data);
                         	$('.streamer').streamer();
                        }
                        else{
                            $('#gen').hide();
                            $('#noapp').show();
                        }
                    }
                });
        } // fired when user clicked on day, in "d" stored date
    });



	   $.ajax({
                    type: "GET",
                    url: "<?php echo base_url('doctor/doctor_calendar_appointments'); ?>",
					dataType: "json"
              //      data: {day: day}
          }).done(function(data){		 
				 for(var k in data) {
				   setCalendar(data[k].date);
				}
				
			  
		 });
		 
		 function setCalendar(d){
		
		 cal.calendar('setDate', d);
		 
}

});



</script>