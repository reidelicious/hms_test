   
    <div class = "container">
    <h2 id="_default"><i class="icon-accessibility on-left"></i>Appointments</h2>
    <form action="<?php echo base_url('doctor/generateToDoc'); ?>" method="POST">
        <input type="hidden" name="deyt" id="d">
        <button type="submit" id="gen" class="primary" style="display:none;">Generate into .docx</button>
    </form>
    
    <!--
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
      </div>   -->

      <div class="streamer" data-role="streamer" data-scroll-bar="true" data-slide-speed="500">  
            <div class="streams">
                <?php for($i=0; $i<5; $i++){ ?>
                    <div class="stream <?php echo $this->session->userdata('timeline'); ?>">
                         <?php 
                            $d = Date("m-d-y", strtotime("+".$i." days"));
                            $forDoc = Date("y-m-d", strtotime("+".$i." days"));
                            $dateObj = DateTime::createFromFormat('m-d-Y', $d);
                         ?>
                         <div class="stream-title"><?php echo $dateObj->format('M d'); ?></div>
                         <div class="stream-number"><input type="button" id="gen" class="small primary" style="display:none;">Generate into .docx</div>
                    </div>
                <?php } ?>
            </div>
            <div class="events">
                <div class="events-area">
                    <div class="events-grid">
                        <div class="event-group">
                             <?php foreach($appointment as $appoint): ?>  
                                    <?php $lasttime = '09:00'; ?>
                                    <div class="event-stream" >
                                        <?php foreach($appoint as $ment): ?>
                                         <?php 
                                                $interval = date_interval_create_from_date_string('30 min');
                                                $begin = date_create($lasttime);
                                                $end = date_create($ment->time);
                                                if($begin != $end){
                                                    foreach (new DatePeriod($begin, $interval, $end) as $dt){
                                                        echo '<div class="event"></div>';
                                                    }
                                                }
                                            ?>
                                        <div class="event">
                                            <div class="event-content double">
                                                <div class="event-content-logo">
                                                    <img class="icon" src=<?php echo base_url(''.$ment->avatar.''); ?>>
                                                    <div class="time <?php echo $ment->timeline; ?>"><?php echo date("h:i", strtotime($ment->time)); ?></div>
                                                </div>
                                                <div class="event-content-data">
                                                    <div class="title"><?php echo $ment->lname; ?>  <?php echo $ment->fname; ?></div>
                                                    <div class="subtitle">on <?php echo date("g:i a", strtotime($ment->time)); ?></div>
                                                </div>
                                                <?php $time = strtotime($ment->time);
                                                      $lasttime = date("h:i", strtotime('+30 minutes', $time));  ?>
                                            </div>
                                        </div>                              
                                        <?php endforeach; ?> 
                                    </div>
                                <?php endforeach; ?>
                        </div>
                        <div class="event-group double">
                            <div class="event-super padding20">
                                <center><h2 class="text-warning text-center">Nothing Follows</h2></center>
                            </div>
                        </div>
                           
                    </div>
                 
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