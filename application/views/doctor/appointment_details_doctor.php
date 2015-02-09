<div class="streams">
    <div class="streams-title">
        <div class="toolbar">
            <button class="button small js-show-all-streams" title="Show all streams" data-role=""><span class="icon-eye"></span></button>
            <button class="button small js-schedule-mode" title="On|Off schedule mode" data-role=""><span class="icon-history"></span></button>
            <button class="button small js-go-previous-time" title="Go to previous time interval" data-role=""><span class="icon-previous"></span></button>
            <button class="button small js-go-next-time" title="Go to next time interval" data-role=""><span class="icon-next"></span></button>
        </div>
    </div>
    <?php foreach ($appointment as $patients): ?>
                    <div class="stream bg-teal">
                        <div class="stream-title"><?php echo $patients->lname; ?>  <?php echo $patients->fname; ?></div>
                    </div>
    <?php endforeach; ?>
</div>

<div class="events">
    <div class="events-area">
        <div class="events-grid">
            <div class="event-group">
                <?php foreach($appointment as $app): ?>
                        <div class="event-stream" >
                            <div class="event" data-role="live">
                                <div class="event-content double">
                                    <div class="event-content-logo">
                                        <img class="icon" src="<?php echo base_url(); $app->avatar?>"> 
                                        <div class="time"><?php echo date("g:i", strtotime($app->time)); ?></div>
                                    </div>
                                    <div class="event-content-data">
                                        <div class="title"><?php echo $patients->lname; ?>  <?php echo $patients->fname; ?></div>
                                        <div class="subtitle">on <?php echo date("g:i a", strtotime($app->time)); ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>