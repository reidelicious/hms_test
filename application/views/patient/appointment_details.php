<div class="streamer" data-role="streamer" data-scroll-bar="true" data-slide-speed="500">
<div class="streams">
    <div class="streams-title">
        <div class="toolbar">
            <button class="button small js-show-all-streams" title="Show all streams" data-role=""><span class="icon-eye"></span></button>
            <button class="button small js-schedule-mode" title="On|Off schedule mode" data-role=""><span class="icon-history"></span></button>
            <button class="button small js-go-previous-time" title="Go to previous time interval" data-role=""><span class="icon-previous"></span></button>
            <button class="button small js-go-next-time" title="Go to next time interval" data-role=""><span class="icon-next"></span></button>
        </div>
    </div>
    <?php foreach ($appointment as $doctors): ?>
                    <div class="stream bg-teal">
                        <div class="stream-title">DR. <?php echo $doctors->lname; ?><br /><?php echo $doctors->specialist; ?></div>
                        <div class="stream-number">Clinic: <?php echo $doctors->clinic_name; ?> <input type="hidden" value="<?php  echo $doctors->u_id;?>"  /></div>
                    </div>
    <?php endforeach; ?>
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
                     <div class="event-group">
                     	 <?php foreach($appointment as $app): ?>
                        <div class="event-stream" >
							<?php
                            $interval = date_interval_create_from_date_string('30 min');
							$begin = date_create('09:00');
							$end = date_create($app->time);
							$i=0;
							foreach (new DatePeriod($begin, $interval, $end) as $dt) {
								$i++;
								echo '<div class="event" data-role="live">    b  '.$end->format("H:i:s").'</div>';
							}
                            ?>
                            <div class="event" data-role="live">
                                <div class="event-content ">
                                    <div class="event-content-logo">
                                        <img class="icon" src="<?php echo base_url().$app->avatar?>"> 
                                        <div class="time"><?php echo date("g:i", strtotime($app->time)); ?></div>
                                    </div>
                                    <div class="event-content-data">
                                        <div class="title">Appointment on <?php echo date("g:i a", strtotime($app->time)); ?></div>
                                        <div class="subtitle"><?php echo $app->status; ?></div>
                                        <div class="remark">Contact Number: <?php echo $app->contact_num ?></div>
                                    </div>           
                            	</div>
                        	</div>
                       </div>
                <?php endforeach; ?>
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