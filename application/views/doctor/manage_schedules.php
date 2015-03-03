 
    <div class = "container">
    <h2 id="_default"><i class="icon-accessibility on-left"></i>Add Schedules</h2>
	<div class="grid fluid">
    	<div class="row">
        	<div class="span3">
            	 <div class="calendar" id="component_id"></div>
            </div>
            <div class="span7 offset 4">
                <div id="calendar-output" class="header"></div><br/>
                <div id="selectTime" class="span6 offset 1 display-none">
                    <form id="timeform" method="post" role="form">
                        <p class="subheader-secondary">Time Start:</p>
                        <div class="input-control select" data-role="input-control" required>
                            <select id="start_time" name="timestart" required>
                                <option value="" disabled default selected class="display-none">Time Start</option>
                                <option value="08:00">08:00 AM</option>
                                <option value="08:30">08:30 AM</option>
                                <option value="09:00">09:00 AM</option>
                                <option value="09:30">09:30 AM</option>
                                <option value="10:00">10:00 AM</option>
                                <option value="10:30">10:30 AM</option>
                                <option value="11:00">11:00 AM</option>
                                <option value="11:30">11:30 AM</option>
                                <option value="12:00">12:00 NN</option>
                                <option value="12:30">12:30 NN</option>
                                <option value="13:00">01:00 PM</option>
                                <option value="13:30">01:30 PM</option>
                                <option value="14:00">02:00 PM</option>
                                <option value="14:30">02:30 PM</option>
                                <option value="15:00">03:00 PM</option>
                                <option value="15:30">03:30 PM</option>
                                <option value="16:00">04:00 PM</option>
                                <option value="16:30">04:30 PM</option>
                            </select>
                        </div>
                        <p class="subheader-secondary">Time End: </p>
                        <div class="input-control select" data-role="input-control" required>
                            <select id="end_time" name="timeend" required>
                                <option value="" disabled default selected class="display-none">Time End</option>
                                <option value="09:00">09:00 AM</option>
                                <option value="09:30">09:30 AM</option>
                                <option value="10:00">10:00 AM</option>
                                <option value="10:30">10:30 AM</option>
                                <option value="11:00">11:00 AM</option>
                                <option value="11:30">11:30 AM</option>
                                <option value="12:00">12:00 NN</option>
                                <option value="12:30">12:30 NN</option>
                                <option value="13:00">01:00 PM</option>
                                <option value="13:30">01:30 PM</option>
                                <option value="14:00">02:00 PM</option>
                                <option value="14:30">02:30 PM</option>
                                <option value="15:00">03:00 PM</option>
                                <option value="15:30">03:30 PM</option>
                                <option value="16:00">04:00 PM</option>
                                <option value="16:30">04:30 PM</option>
                                <option value="17:00">05:00 PM</option>
                                <option value="17:30">05:30 PM</option>
                                <option value="18:00">06:00 PM</option>
                            </select>
                        </div>
                        <button type="submit" id="add" class="large default">GO</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
     
</div>


<div id="bla"></div>
	

<script>

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
    var arr = [];
    var flag = 0;
    var cal = $('#component_id').calendar({
        format: 'yyyy-mm-dd',
        multiSelect: false, //default true (multi select date)
        startMode: 'day', //year, month, day
      
        locale: 'en', // 'ru', 'ua', 'fr' or 'en', default is $.Metro.currentLocale
        otherDays: false, // show days for previous and next months,
        weekStart: 0, //start week from sunday - 0 or monday - 1
        /*
        getDates:function(data){
                var r = "", out = $("#calendar-output").html("");
                $.each(data, function(i, d){
                    r += d + "<br />";
                });
                out.html(r);
                day = r;
            }, // see example below
        */
        click: function(d){
                var out = $("#calendar-output").html("");
                out.html(d);
                day = d;


            } // fired when user clicked on day, in "d" stored date
        
    });

	//<?php// foreach($appointments as $apps) :	?>
	//	setCalendar('<?php// echo $apps->date ?>');
		//	$('#bla').append(<?php// echo $apps->date ?>+'  ');
	// <?php//  endforeach; ?>
	 //	setCalendar(today);

    $(document).on('submit', '#timeform', function(){
		

        if(day != ''){
            var start_time = $("#start_time").val();
            var end_time = $("#end_time").val();
            //convert both time into timestamp
            var stt = new Date("December 20, 1993 " + start_time);
            stt = stt.getTime();

            var endt = new Date("December 20, 1993 " + end_time);
            endt = endt.getTime();
            arr = [];   
            if(stt < endt) {
                arr.push(day);
                arr.push($("#start_time").val());
                arr.push($("#end_time").val());
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('doctor/is_schedule_unique'); ?>",
                    data: {day: day}
                })
                .done(function(answer){
                    if(answer == 1){
                        $.Dialog({
                            overlay: true,
                            shadow: true,
                            flat: true,
                            draggable: true,
                            icon: '<img src="images/excel2013icon.png">',
                            title: 'Overwrite Schedule',
                            width: 300,
                            content: '',
                            padding: 10,
                            onShow: function(_dialog){
                                var content = '<div>This date already have a schedule. Do you want to overwrite it? </div></br>' +
                                              '<div class="grid fluid">'+
                                              '<div class="row">'+
                                              '<div class="span8 offset2"> <button class="btn-close" onclick="$.Dialog.close()"><i class="icon-cancel-2 on-left"></i>Cancel</button> '+
                                              '<button class="confirmOverwrite" id="overwrite" onclick="$.Dialog.close();overWriteSchedule(); "><i class="icon-floppy on-left"></i>Overwrite</button>'+
                                              '</div>'+
                                              '</div>'+
                                            '</div> ';
                                            
                     
                                $.Dialog.title("Overwrite User ");
                                $.Dialog.content(content);
                                $.Metro.initInputs();
                            }
                        });
						
							
                    }
                    else{
                        flag = 0;
                        $.ajax({
                            type: "POST",
                            url: "<?php echo base_url('doctor/manage_schedule_toDB'); ?>",
                            data: {arr : arr, flag: flag}
                        })
                        .done(function(){
                            var not = $.Notify({
                                        style: {background: 'green', color: 'white'}, 
                                        caption: 'SUCCESS',
                                        content: "Schedule is added to the database",
                                        timeout: 10000 // 10 seconds
                                       });
                        });
							setCalendar(arr[0]);
						
						
                    }
                });
            }
            else{
                var not = $.Notify({
                        style: {background: 'red', color: 'white'}, 
                        caption: 'ERROR TIME INPUT',
                        content: "Time End must be after Time Start",
                        timeout: 10000 // 10 seconds
                    });
            }  
        }
        else{                    
            var not = $.Notify({
                        style: {background: 'red', color: 'white'}, 
                        caption: 'DATE NOT FOUND',
                        content: "Please Specify by clicking the corresponding date",
                        timeout: 10000 // 10 seconds
                    });        
        }
        return false;            
    });
    
    window.overWriteSchedule = function(){
        flag = 1;
        $.ajax({
                type: "POST",
                url: "<?php echo base_url('doctor/manage_schedule_toDB'); ?>",
                data: {arr : arr, flag: flag}
            })
            .done(function(){
                var not = $.Notify({
                            style: {background: 'green', color: 'white'}, 
                            caption: 'OVERWRITE SUCCESS',
                            content: "Schedule is overwritten to the database",
                            timeout: 10000 // 10 seconds
                           });
            });
    };
	
	
	   $.ajax({
                    type: "GET",
                    url: "<?php echo base_url('doctor/doc_calendar_app'); ?>",
					dataType: "json"
              //      data: {day: day}
          }).done(function(data){		 
				 for(var k in data) {
				   setCalendar(data[k].date);
				}
				  cal.calendar('unsetDate', today);
			  
		 });

function setCalendar(d){
		
		 cal.calendar('setDate', d);
		 
}


});



</script>


