<script src="<?php echo base_url('assets/js/bootstrap.min.js')?>"></script>    
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
            	<div class="streamer" data-role="streamer" data-scroll-bar="true" data-slide-to-group="3" data-slide-speed="500">
                        <div class="streams">
                            <div class="streams-title">
                                <div class="toolbar">
                                    <button class="button small js-show-all-streams" title="Show all streams" data-role=""><span class="icon-eye"></span></button>
                                    <button class="button small js-schedule-mode" title="On|Off schedule mode" data-role=""><span class="icon-history"></span></button>
                                    <button class="button small js-go-previous-time" title="Go to previous time interval" data-role=""><span class="icon-previous"></span></button>
                                    <button class="button small js-go-next-time" title="Go to next time interval" data-role=""><span class="icon-next"></span></button>
                                </div>
                            </div>
                            <div class="stream bg-teal">
                                <div class="stream-title">INTERNET<br />BUSINESS</div>
                                <div class="stream-number">room 1</div>
                            </div>
                            <div class="stream bg-orange">
                                <div class="stream-title">ADVERTISING<br />ANALYST<br />SEO</div>
                                <div class="stream-number">room 2</div>
                            </div>
                            <div class="stream bg-lightBlue">
                                <div class="stream-title">STARTUPS<br />E-COMMERCE</div>
                                <div class="stream-number">room 3</div>
                            </div>
                            <div class="stream bg-darkGreen">
                                <div class="stream-title">MOBILE<br />GAMES<br />USABILITY</div>
                                <div class="stream-number">room 4</div>
                            </div>
                            <div class="stream bg-pink">
                                <div class="stream-title">INTERNET<br />TECHNOLOGY</div>
                                <div class="stream-number">room 5</div>
                            </div>
                            <div class="stream bg-violet">
                                <div class="stream-title">MASTERS</div>
                                <div class="stream-number">room 6</div>
                            </div>
                        </div>

                        <div class="events">
                            <div class="events-area">
                                <div class="events-grid">
                                    <div class="event-group double">
                                        <div class="event-super padding20">
                                            <div>9:00 - 9:40</div>
                                            <h2 class="no-margin">Registration</h2>
                                        </div>
                                    </div>
                                    <div class="event-group double" id="qwerty">
                                        <div class="event-super padding20">
                                            <div>9:40 - 10:20</div>
                                            <h2 class="no-margin">Keynote speech</h2>

                                            <br />
                                            <img src="images/org-01.png">
                                            <h4 class="no-margin">Aleksandr Olshanskiy</h4>
                                            <p>Imena.UA, MiroHost</p>

                                        </div>
                                    </div>

                                    <div class="event-group">
                                        <div class="event-stream" >
                                            <div class="event" data-role="live">
                                                <div class="event-content">
                                                    <div class="event-content-logo">
                                                        <img class="icon" src="images/live1.jpg">
                                                        <div class="time">10:20</div>
                                                    </div>
                                                    <div class="event-content-data">
                                                        <div class="title">Katerina Kostereva</div>
                                                        <div class="subtitle">Terrasoft</div>
                                                        <div class="remark">Create and develop a business without external investment</div>
                                                    </div>
                                                </div>
                                                <div class="event-content">
                                                    <div class="event-content-logo">
                                                        <img class="icon" src="images/live2.jpg">
                                                        <div class="time">10:30</div>
                                                    </div>
                                                    <div class="event-content-data">
                                                        <div class="title">Vlad Voskresensky</div>
                                                        <div class="subtitle">InvisibleCRM</div>
                                                        <div class="remark">Team Building in your startup: what to do and what not</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="event double">
                                                <div class="event-content">
                                                    <div class="event-content-logo">
                                                        <img class="icon" src="images/x.jpg">
                                                        <div class="time">10:40</div>
                                                    </div>
                                                    <div class="event-content-data">
                                                        <div class="title">Round table</div>
                                                        <div class="remark">Trends in mobile platforms</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="event"></div>
                                            <div class="event"></div>
                                            <div class="event"></div>
                                            <div class="event"></div>
                                            <div class="event"></div>
                                            <div class="event"></div>
                                            <div class="event"></div>
                                            <div class="event double"></div>
                                            <div class="event double"></div>
                                            <div class="event"></div>
                                            <div class="event"></div>
                                            <div class="event"></div>
                                            <div class="event"></div>
                                            <div class="event double"></div>
                                            <div class="event"></div>
                                            <div class="event"></div>
                                            <div class="event"></div>
                                            <div class="event"></div>
                                        </div>

                                        <div class="event-stream" >
                                            <div class="event triple">
                                                <div class="event-content">
                                                    <div class="event-content-logo">
                                                        <img class="icon" src="images/x.jpg">
                                                        <div class="time">10:40</div>
                                                    </div>
                                                    <div class="event-content-data">
                                                        <div class="title">Round table</div>
                                                        <div class="remark">Trends in mobile platforms</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="event">
                                                <div class="event-content">
                                                    <div class="event-content-logo">
                                                        <img class="icon" src="images/me.jpg">
                                                        <div class="time">10:20</div>
                                                    </div>
                                                    <div class="event-content-data">
                                                        <div class="title">Sergey Pimenov</div>
                                                        <div class="subtitle">Metro UI CSS</div>
                                                        <div class="remark">Create a site with interface similar to Windows 8</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="event-stream" >
                                            <div class="event" data-role="live" data-effect="slideUp" data-period="3000">
                                                <div class="event-content">
                                                    <div class="event-content-logo">
                                                        <img class="icon" src="images/me.jpg">
                                                        <div class="time">10:20</div>
                                                    </div>
                                                    <div class="event-content-data">
                                                        <div class="title">Sergey Pimenov</div>
                                                        <div class="subtitle">Metro UI CSS</div>
                                                        <div class="remark">Create a site with interface similar to Windows 8</div>
                                                    </div>
                                                </div>
                                                <div class="event-content">
                                                    <div class="event-content-logo">
                                                        <img class="icon" src="images/x.jpg">
                                                        <div class="time">10:30</div>
                                                    </div>
                                                    <div class="event-content-data">
                                                        <div class="title">Round table</div>
                                                        <div class="subtitle">Metro UI CSS</div>
                                                        <div class="remark">Discussion</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="event double">
                                                <div class="event-content">
                                                    <div class="event-content-logo">
                                                        <img class="icon" src="images/x.jpg">
                                                        <div class="time">10:40</div>
                                                    </div>
                                                    <div class="event-content-data">
                                                        <div class="title">Round table</div>
                                                        <div class="remark">Trends in mobile platforms</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="event-group double">
                                        <div class="event-super padding20">
                                            <div>18:20</div>
                                            <h2 class="no-margin">Final ceremony</h2>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
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
                                                <input id="gimme" class="input-control" type="time" style="display:none;"></input>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <div id="footer" class="modal-footer" style="display:none;">
                        <button id="savedata" type="button" name="addlist" class="primary button"> Make an Appointment </a>
                    </div>
                    </div>
                </div>  
        </div>
    
    </div>         
	<div id="dummy" value = "-1"></div> 
     
</div>







<script type="text/javascript">
$(document).ready(function(){
    var day = '';
    $('#component_id2').calendar({
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
                if($('#doctor').val() != ''){
                    $.ajax({
                          url:"<?php echo base_url(); ?>patient/build_drop_schedule",    
                          data: {doctor:$('#doctor').val(), day:day},
                          type: "POST",
                          success: function(data){
                            $('#sched').html("");
                            $("#sched").html(data);
                          }
                      });
                }

            } // fired when user clicked on day, in "d" stored date
    });
    $(document).on('click','#makeAppointment', function(){ 
        $('#myMod').modal('show');
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
                    $('#footer').hide();
                }
                else{
                    $('#gimme').show();
                    $('#footer').show();
                }
              }
          })
    });
    $(document).on('click', '#savedata', function(){
        $('#dummy').val("-1");
        alert($('#dummy').val());
        if($('#gimme').val() != ''){
            var time_input = document.getElementById("gimme").value;
            alert(time_input);
            $.ajax({
              url:"<?php echo base_url(); ?>patient/build_time_start",    
              data: {doctor:$('#doctor').val(), day:day},
              type: "POST",
              success: function(data){
                if(data != "Not Yet Available!"){
                   //time_start = data;
                   alert(data);
                    if(time_input < data){
                        $('#dummy').val("1");
                        var not = $.Notify({
                                style: {background: 'red', color: 'white'}, 
                                caption: 'STILL NOT OPEN AT THAT TIME',
                                content: "Please Input Time after " + data,
                                timeout: 10000 // 10 seconds
                            });
                        alert($('#dummy').val());
                    }
                }
                else{
                    $('#gimme').hide();
                    $('#footer').hide();
                }
              }
            });
            $.ajax({
              url:"<?php echo base_url(); ?>patient/build_time_end",    
              data: {doctor:$('#doctor').val(), day:day},
              type: "POST",
              success: function(data){
                if(data != "Not Yet Available!"){
                    if(time_input > data){
                        document.getElementById('dummy').value='1';
                        var not = $.Notify({
                                style: {background: 'red', color: 'white'}, 
                                caption: 'DOCTOR IS ALREADY OUT AT THAT TIME',
                                content: "Please Input Time before " + data,
                                timeout: 10000 // 10 seconds
                            });
                    }
                    else if(time_input == data){
                        $('#dummy').val("1");
                        var not = $.Notify({
                                style: {background: 'red', color: 'white'}, 
                                caption: 'DOCTOR IS ALREADY OUT AT THAT TIME',
                                content: "Please input before " + data,
                                timeout: 10000 // 10 seconds
                            });
                    }

                }
                else{
                    $('#gimme').hide();
                    $('#footer').hide();
                }
              }
             });
            alert($('#dummy').val());
             if(document.getElementById('dummy').value != 1){ //passes all the rules
                alert($('#dummy').val());
                var arr = [];
                arr.push(day);
                arr.push(time_input);
                arr.push($('#doctor').val());
                $.ajax({
                  url:"<?php echo base_url(); ?>patient/saveAppointmentToDB",    
                  data: {arr:arr},
                  type: "POST"
                }).done(function(){    
                    var not = $.Notify({
                            style: {background: 'green', color: 'white'}, 
                            caption: 'SUCCESSFULLY SAVED!',
                            content: "Please wait for the secretary to approve your request",
                            timeout: 10000 // 10 seconds
                        });
                    $
                });
            }
        }
        else{
            var not = $.Notify({
                        style: {background: 'red', color: 'white'}, 
                        caption: 'MISSING TIME',
                        content: "Please Input Time",
                        timeout: 10000 // 10 seconds
                    });
        }
    })
})
</script>