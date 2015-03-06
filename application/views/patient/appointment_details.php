<div class="input-control switch place-right">
    <label class="text-info">
        Switch
        <input id="change" type="checkbox" />
        <span class="check"></span>
    </label>
</div>
<div class="streamer" id="showTimeline" data-role="streamer" data-scroll-bar="true" data-slide-speed="500">
    <div class="streams">
        <div class="streams-title">
        </div>
        <?php foreach ($appointment as $doctors): ?>
        <div class="stream <?php echo $doctors->timeline; ?>">
            <div class="stream-title">DR. <?php echo ucfirst($doctors->lname); ?><br /><?php echo $doctors->specialist; ?></div>
            <div class="stream-number">Clinic: <?php echo $doctors->clinic_name; ?></div>
        </div>
        <?php endforeach; ?>
   
    </div>

    <div class="events">
        <div class="events-area" style="">
            <div class="events-grid">
                <div class="event-group">
                	<?php foreach($appointment as $app): ?>
                	<div class="event-stream" >
                	<?php
						$interval = date_interval_create_from_date_string('30 min');
						$begin = date_create('09:00');
						$end = date_create($app->time);
						foreach (new DatePeriod($begin, $interval, $end) as $dt) {
							echo '<div class="event"></div>';
						}
               		 ?>
                        <div class="event" >
                        	<div class="event-content ">
                        		<div class="event-content-logo">
                        			<img class="icon" src="<?php echo base_url().$app->avatar?>"> 
                       				<div class="time"><center><?php echo date("g:i", strtotime($app->time)); ?></center></div>
               		 			</div>
                    			<div class="event-content-data">
                                    <?php if($app->status == "Approved"){ ?>
                                            <div class="title text-success">
                                    <?php }else if($app->status == "Cancelled"){ ?>
                                            <div class="title text-warning">
                                    <?php }else if($app->status == "Reject"){ ?>
                                            <div class="title text-alert">
                                    <?php }else{ ?>
                                            <div class="title text-info">
                                    <?php } ?>
                                                <?php echo $app->status; ?>
                                            </div>
                        			<!--<div class="title text-success">-->
                        			<div class="subtitle">Contact Number: <?php echo $app->contact_num ?></div>
                                    <?php if($app->date > date("Y-m-d") && $app->status != "Cancelled"){ ?>
                                        <div class="remark"><button id="cancel" rowid="<?php echo $app->appoint_id; ?>" class="small warning">Cancel Appointment</button></div>
                                    <?php } ?>
                    			</div>           
                			</div>
               			 </div>
                         
                         <?php
						$interval = date_interval_create_from_date_string('30 min');
						$begin = date_create($app->time)->add($interval);
						$end = date_create('18:00');
						foreach (new DatePeriod($begin, $interval, $end) as $dt) {
							echo '<div class="event"></div>';
						}
               		 ?>
                	</div>
                	<?php endforeach; ?>
            		
                </div>
        
                <div class="event-group double">
                    <div class="event-super padding20">
                        <div>18:00</div>
                        <h2 class="no-margin">Closing Time</h2>
                  	</div>
                </div>
            </div>
        </div>
    </div>
</div>

<table class="table striped" id="showTable" style="display:none;">
    <thead>
        <tr>
            <th class="text-center">Time</th>
            <th class="text-center">Doctor (Specialist)</th>
            <th class="text-center">Clinic</th>
            <th class="text-center">Status</th>
            <th class="text-center">Action</th>
        </tr> 
    </thead>
    <tbody>
        <?php foreach($appointment as $row): ?>
            <tr>
                <td class="text-center"><?php echo $row->time; ?></td>
                <td class="text-center">Dr. <?php echo ucfirst($row->lname) ." (".$row->specialist.")"; ?></td>
                <td class="text-center"><?php echo ucfirst($row->clinic_name); ?></td>
                <td class="text-center"><?php echo $row->status; ?></td>
                <?php if($app->date > date("Y-m-d") && $app->status != "Cancelled"){ ?>
                    <td class="text-center"><button id="cancel" rowid="<?php echo $app->appoint_id; ?>"  class="small warning">Cancel Appointment</button></td>
                <?php }else{ ?>
                    <td class="text-center"></td>
                <?php } ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script type="text/javascript">
$(document).ready(function(){
    var flagger = 0; //timeline is active else 1 if table
    $('#change').change(function(){
        if(flagger == 0){
            $('#showTable').show();
            $('#showTimeline').hide();
            flagger = 1;
        }else{
            $('#showTable').hide();
            $('#showTimeline').show();
            flagger = 0;
        }
    });

    window.confirmCancel = function(id){
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('patient/cancelappointment/')?>/"+id,
                
        }).done(function(msg){
            if(msg=="success"){
                 var not = $.Notify({
                        style: {background: 'green', color: 'white'},
                        caption: "CANCELLED APPOINTMENT",
                        content: "Cancellation of Appointment is Successful!!",
                        timeout: 10000 // 10 seconds
                 });

            }else if(msg=="fail"){
              var not = $.Notify({
                  style: {background: 'red', color: 'white'},
                    caption: "Cancellation Failed",
                      content: "There is some error runnning on the system! Sorry for the inconvenience",
                        timeout: 10000 // 10 seconds
                 });
        }
                    //alert(msg);
        });

    }

    $(document).on('click','#cancel', function(){
        var id = $(this).attr('rowid');
        $.Dialog({
            overlay: true,
            shadow: true,
            flat: true,
            draggable: true,
            icon: '<img src="images/excel2013icon.png">',
            title: 'Cancel Appointment',
            width: 300,
            content: '',
            padding: 10,
            onShow: function(_dialog){
                var content = '<div>Are you sure you want to Cancel this Appointment? </div></br>' +
                              '<div class="grid fluid">'+
                              '<div class="row">'+
                              '<div class="span8 offset2"> <button class="warning large btn-close" onclick="$.Dialog.close()"><i class="icon-cancel-2 on-center">   No</i></button> '+
                              '<button class="danger large confirmDelete" value="'+id+'" onclick="$.Dialog.close();confirmCancel(this.value); "><i class="icon-thumbs-up on-center"></i>    Yes</button>'+
                              '</div>'+
                              '</div>'+
                            '</div> ';
                            
     
                $.Dialog.title("Cancel Appointment ");
                $.Dialog.content(content);
                $.Metro.initInputs();
            }
        });
    }); 

    
});
</script>