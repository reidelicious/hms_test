 
 <div class="streamer" data-role="streamer" data-scroll-bar="true" data-slide-speed="500">      
    <?php foreach($appointment as $appoint): ?>
        <div class="streams">
            <div class="streams-title">
            </div>
            <div class="stream <?php echo $this->session->userdata('timeline'); ?>">
                 <div class="stream-title"><?php echo "Marjhun Christopher Galanido"; ?></div>                 
            </div>
        </div>

        <div class="events">
            <div class="events-area">
                <div class="events-grid">
                    <div class="event-group">
                        <div class="event-stream" >
                            <?php $lasttime = '09:00'; ?>
                            <?php foreach($appointment as $app): ?>
                            <?php
								$interval = date_interval_create_from_date_string('30 min');
								$begin = date_create($lasttime);
								$end = date_create($app->time);
                                if($begin != $end){
									foreach (new DatePeriod($begin, $interval, $end) as $dt){
										echo '<div class="event"></div>';
									}
                                }
							 ?>
                            
                            <div class="event" data-role="live">
                                <div class="event-content double">
                                    <div class="event-content-logo">
                                        <img class="icon" src=<?php echo base_url(''.$app->avatar.''); ?>>
                                        <div class="time"><?php echo date("h:i", strtotime($app->time)); ?></div>
                                    </div>
                                    <div class="event-content-data">
                                        <div class="title"><?php echo $app->lname; ?>  <?php echo $app->fname; ?></div>
                                        <div class="subtitle">on <?php echo date("g:i a", strtotime($app->time)); ?></div>
                                    </div>
                                    <?php $time = strtotime($app->time);
                                          $lasttime = date("h:i", strtotime('+30 minutes', $time)); ?>
                                </div>
                            </div>
                            <?php endforeach; ?>            
                                 
                        </div>
                    </div>
                    <div class="event-group double">
                        <h2 class="no-margin">NOTHING FOLLOWS</h2>
                  	</div>
                </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
     </div>   


    