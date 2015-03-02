  
    <div class = "container">
    <h2 id="_default"><i class="icon-accessibility on-left"></i>Appointments</h2>
    <div id="makeAppointment" class="ui primary button">Make Appointment</div>
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
            <div id="myMod" class="modal fade bs-example-modal-lg">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content" style="background-color: #e7e5e3;">
                        <div class="modal-header">
                            <h4 class="modal-title">Appointment</h4>
                        </div>
                        <div class="modal-body">
                            <div class="grid">
                                <div class="row">
                                    <div class="span12">
                                        <div class="row">
                                            <div class="span3">
                                                <p class="subheader ">Select a Date:</p>
                                                 <div class="calendar" id="component_id2" ></div>
                                            </div>
                                            <div id="begin" class="span4 offset1" style="display:none;">
                                                <label for="datesched">Schedule an Appointment on : </label>
                                                <div id="calendar-output2" class="subheader-secondary readable-text text-warning"></div><br/>
                                                <p class="subheader ">Find a Doctor:</p>
                                                <label for="category">Specialization : </label>
                                                <select id="category" class="input-control" name="category" required="required">
                                                  <option value="" disabled default selected class="display-none">Select Specialization</option>
                                                  <?php foreach($specialization as $s):?>
                                                    <option value="<?php echo $s->specialist_id;?>"><?php echo $s->specialist;?></option> 
                                                  <?php endforeach;?>                              
                                                </select>
                                                <label for="clinic">Clinic : </label>
                                                <select id="clinic" class="input-control" name="clinic">
                                                </select> 
                                                <label for="doctor">Doctors : </label>
                                                <select id="doctor" class="input-control" name="doctor" required="required">
                                                </select> 
                                            </div>
                                            <div id="availsched" class="span3" style="display:none;">
                                                <div id="ndoctor" class="readable-text subheader"></div>
                                                <div id="sched" class="readable-text subheader text-warning"></div><br/>
                                                <form id="makeAppointmentHere">
                                                <center><input id="gimme" type="time" step="1800" style="display:none;" required></center><br/>
                                                <div id="notice" style="display:none;" class="notice marker-on-top">
                                                  <strong>Note:</strong> Time should be in 30 minute intervals and should be at least 30 minutes before the closing time
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="footer" class="modal-footer" style="display:none;">
                                <button id="savedata" type="click" class="primary button"> Make an Appointment </button>
                            </div>
                          </form>
                    	</div>
              	  </div>  
       			 </div>
    
    		</div>          
		</div>


		</div>
        
	</div>
    



<script type="text/javascript">
$(document).ready(function(){
    var day = '';
		var today = new Date();
	var dd = today.getDate();
	var mm = today.getMonth()+1; //January is 0!
	var yyyy = today.getFullYear();
	
	if(dd<10) {
		dd='0'+dd
	} 
	
	if(mm<10) {
		mm='0'+mm
	} 
	
	today = yyyy+'-'+mm+'-'+dd;
	 $.ajax({
		           type: "POST",
                    url: "<?php echo base_url(); ?>patient/build_timeline_appointment",
                    data: {d:today},
                    success: function(data){
                        if(data != "No Appointment"){
                            $('#noapp').hide();
                            $("#timeline").html(data);
							$('.streamer').streamer();
                        }
                        else{
							$("#timeline").html('');
                            $('#noapp').show();
						}

					}
	 });
    var cal = $('#component_id').calendar({
        format: 'yyyy-mm-dd',
        multiSelect: false, //default true (multi select date)
        startMode: 'day', //year, month, day
      
        locale: 'en', // 'ru', 'ua', 'fr' or 'en', default is $.Metro.currentLocale
        otherDays: false, // show days for previous and next months,
        weekStart: 0, //start week from sunday - 0 or monday - 1
        click: function(d){
                var out = $("#calendar-output").html("");
                day = d;
                
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>patient/build_timeline_appointment",
                    data: {d:d},
                    success: function(data){
                        if(data != "No Appointment"){
                            $('#noapp').hide();
							 $("#timeline").html(data);
							$('.streamer').streamer();
                      
                        }
                        else{
                            $('#noapp').show();
							$("#timeline").html('');
						}

                    }
                });
        } // fired when user clicked on day, in "d" stored date
    });
    var cal2 = $('#component_id2').calendar({
        format: 'yyyy-mm-dd',
        multiSelect: false, //default true (multi select date)
        startMode: 'day', //year, month, day
      
        locale: 'en', // 'ru', 'ua', 'fr' or 'en', default is $.Metro.currentLocale
        otherDays: false, // show days for previous and next months,
        weekStart: 0, //start week from sunday - 0 or monday - 1
        click: function(d){
                var out = $("#calendar-output2").html("");
                out.html(d);
                day = d;
                $('#begin').show();
                if($('#doctor').val() != null){  
                  $.ajax({
                    url:"<?php echo base_url(); ?>patient/build_drop_schedule",    
                    data: {doctor:$('#doctor').val(), day:day},
                    type: "POST",
                      success: function(data){
                        $("#sched").html("");
                        $("#sched").html(data);
                        if(data == "Not Yet Available!"){
                            $('#gimme').hide();
                            $('#notice').hide();
                            $('#footer').hide();
                        }
                        else{ //new
                          $.ajax({
                            url: "<?php echo base_url(); ?>patient/build_time_start",
                            data: {doctor:$('#doctor').val(), day:day},
                            type: "POST",
                            success:function(time_start){
                              $('#gimme').attr('min', time_start);
                            }
                          });
                          $.ajax({
                            url: "<?php echo base_url(); ?>patient/build_time_end",
                            data: {doctor:$('#doctor').val(), day:day},
                            type: "POST",
                            success:function(time_end){
                              var fifteen = new Date("Thu, 01 Jan 1970 " + time_end);
                              if(fifteen.getMinutes() == "00"){
                                fifteen.setHours(fifteen.getHours() - 1);
                                fifteen.setMinutes(30);
                                var x = fifteen.getHours() + ":" + fifteen.getMinutes() + ":" + fifteen.getSeconds() + fifteen.getMilliseconds();
                              }else{
                                var x = fifteen.getHours() + ":00:00";
                              }
                              $('#gimme').attr('max', x);
                            }
                          });

                            $('#gimme').show();
                            $('#notice').show();
                            $('#footer').show();
                        }
                      }
                  });
                }
        }
    });
		

	<?php if($appointments){foreach($appointments as $apps) :	?>

	  cal.calendar('setDate', '<?php echo $apps->date?> ');
	  cal2.calendar('setDate', '<?php echo $apps->date?> ');
	 <?php  endforeach;} ?>
	
    $(document).on('click','#makeAppointment', function(){ 
        $.ajax({
          url: "<?php echo base_url(); ?>patient/countAppointmentsForTheDay",
          type: "POST",
          success:function(result){
            if(result < 5){
              $('#myMod').modal('show');
            }
            else{
              alert('Sorry, You can\'t appoint for today. You already made an appointment 5 times in a row for this day.');
              $('#makeAppointment').hide();
            }
          }
        })

        
        //
    }); 
    $('#category').change(function(){
        
        $.ajax({
              url:"<?php echo base_url(); ?>patient/build_drop_clinic_fromCategory",    
              data: {category:$(this).val()},
              type: "POST",
              success: function(data){
                  $("#clinic").html(data);
              }
          })
          $.ajax({
              url:"<?php echo base_url(); ?>patient/build_drop_doctor_fromCategory",    
              data: {category:$(this).val()},
              type: "POST",
              success: function(data){
                  $("#doctor").html(data);
              }
          })
    });
    $('#clinic').change(function(){
        $.ajax({
              url:"<?php echo base_url(); ?>patient/build_drop_doctor_fromClinic",    
              data: {doctor:$(this).val(), category:$('#category').val()},
              type: "POST",
              success: function(data){
                  $("#doctor").html(data);
              }
          });
    });
    $('#doctor').change(function(){
        $('#availsched').show();
        $("#ndoctor").html("Available Time of " + $('#doctor option:selected').text());
        $.ajax({
          url:"<?php echo base_url(); ?>patient/build_drop_schedule",    
          data: {doctor:$(this).val(), day:day},
          type: "POST",
          success: function(data){
            $("#sched").html("");
            $("#sched").html(data);
            if(data == "Not Yet Available!"){
                $('#gimme').hide();
                $('#notice').hide();
                $('#footer').hide();
            }
            else{ //new
              $.ajax({
                url: "<?php echo base_url(); ?>patient/build_time_start",
                data: {doctor:$('#doctor').val(), day:day},
                type: "POST",
                success:function(time_start){
                  $('#gimme').attr('min', time_start);
                }
              });
              $.ajax({
                url: "<?php echo base_url(); ?>patient/build_time_end",
                data: {doctor:$('#doctor').val(), day:day},
                type: "POST",
                success:function(time_end){
                  var fifteen = new Date("Thu, 01 Jan 1970 " + time_end);
                  if(fifteen.getMinutes() == "00"){
                    fifteen.setHours(fifteen.getHours() - 1);
                    fifteen.setMinutes(30);
                    var x = fifteen.getHours() + ":" + fifteen.getMinutes() + ":" + fifteen.getSeconds() + fifteen.getMilliseconds();
                  }else{
                    var x = fifteen.getHours() + ":00:00";
                  }
                  $('#gimme').attr('max', x);
                }
              });

                $('#gimme').show();
                $('#notice').show();
                $('#footer').show();
            }
          }
        });
    });
    $("#makeAppointmentHere").submit(function(){
            var time_input = document.getElementById("gimme").value + ":00";
            var arr = [];
            arr.push(day);
            arr.push(time_input);
            arr.push($('#doctor').val());
            $.ajax({
              url:"<?php echo base_url(); ?>patient/saveAppointmentToDB",    
              data: {arr:arr},
              type: "POST",
              success:function(data){
                if(data == "Success"){
                  var not = $.Notify({
                          style: {background: 'green', color: 'white'}, 
                          caption: 'SUCCESSFULLY SAVED!',
                          content: "Please wait for the secretary to approve your request",
                          timeout: 10000 // 10 seconds
                      });
                  
                      
                      $('#myMod').modal('hide');
                }
              }
            });
            return false;
    });
    
})
</script>
