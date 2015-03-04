<div class="streamer" data-role="streamer" data-scroll-bar="true" data-slide-speed="500">
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
                        			<div class="title"><?php echo $app->status; ?></div>
                        			<div class="subtitle">Contact Number: <?php echo $app->contact_num ?></div>
                                    <?php if($app->date > date("Y-m-d")){ ?>
                                        <div class="remark"><button class="small warning">Cancel Appointment</button></div>
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