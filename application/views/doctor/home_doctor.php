<style type="text/css">

/* Glyph, by Harry Roberts */
		
hr.style-eight {
    padding: 0;
    border: none;
    border-top: medium double #333;
    color: #333;
    text-align: center;
}
</style>
<title>Hospital Management System</title>
	<div class="container">
		<div class="grid fluid">
			<div class="row">
				<div class="span3">
					<br/><br/>
					<center>
						<img class="rounded polaroid <?php echo $this->session->userdata('timeline'); ?> bd-white shadow" src="<?php echo $this->session->userdata('avatar') ?>" ><br/>
						<h4><?php echo ucfirst($this->session->userdata('lname')) .", ". ucfirst($this->session->userdata('fname')); ?></h4>
						<a href="<?php echo base_url("main/settings") ?>" id="editProfile">Edit Profile</a><br/>
					</center>
					<h4>Total Appointments : 	</h4>
					<p class="header readable-text text-warning" ><?php echo $countTotApp; ?></p><br/>
					<h4>Pending Appointments: 	</h4>
					<p class="header readable-text text-warning" ><?php echo $countPenApp; ?></p><br/>
					<h4>Approved Appointments: </h4>
					<p class="header readable-text text-warning" ><?php echo $countOKApp; ?></p><br/>
					<h4>Rejected Appointments: </h4>
					<p class="header readable-text text-warning" ><?php echo $countRejApp; ?></p><br/>
				</div>
				<div class="span6">
								<h1 class="subheader">Announcements
								<span class="place-right"><a href="<?php echo base_url('doctor/makeAnnouncement') ?>"><button class="default"><i class="icon-pencil on-center"></i></button></a></span></h1>
						<?php foreach($announcements as $row): ?>
							<hr class="style-eight">
								<div class="panel">
								    <div class="panel-header <?php echo $this->session->userdata('timeline'); ?> fg-white">
								    	
								    	<?php if($row->fk_clinic_id != 0){ echo $row->room_num; }else{ echo "Admin"; } ?>
								    	<span class="place-right" style="font-size:14px">
								    		<?php echo $row->announcement_datetime_made; ?>
								    	</span>
								    </div>
								    <div class="panel-content">
								    	<strong><?php echo $row->announcement_subject; ?>    </strong>
  										<span class="place-right" style="font-size:14px">
  											<button id="show" class="small default" rowid="<?php echo $row->id; ?>" data-toggle="modal" data-target="#detailsModal" >Show Details</button>
								    	</span>
								    </div>
								</div>
						<?php endforeach; ?>	
				</div>
				<div class="span3">
						<h1 class="subheader text-center">Update</h1>
						<hr class="style-eight">
							<div id="greetings" class="subheader readable-text  text-success"></div><br/>
                        	<?php if($appoint){?>
                        			<p class="subheader-secondary readable-text"> You have <strong><?php echo $countAppoint; ?></strong> Appointment(s) for this day, Doctor. <i class="icon-smiley"></i><br/><br/><strong>Patients: </strong></p>
                        			<?php foreach($appoint as $ment): ?>
                        					<blockquote>
                        						<p class="readable-text"><?php echo ucfirst($ment->lname) .", ". ucfirst($ment->fname); ?></p>
                        					</blockquote>	
                        			<?php endforeach; ?>
                        			<form action="<?php echo base_url('doctor/generateToDoc'); ?>" method="POST">
								        <input type="hidden" name="deyt" id="d" value="<?php echo date('Y-m-d'); ?>">
								        <button type="submit" id="gen" class="primary place-right"><i class="icon-file-word"></i>	Get a Copy!</button>
								    </form>
							<?php }else{ ?>
									<p class="subheader-secondary readable-text" >You have NO Appointments for this day.</p>
							<?php } ?>
					</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="detailsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="danger close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title">Announcement Details</h4>
	      </div>
	      <div class="modal-body" id="showDetails">
			
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="default" data-dismiss="modal">Close</button>
	      </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	<script type="text/javascript">
		$(document).ready(function(){
			var now = new Date();
			var hrs = now.getHours();
			var msg = "";
			
			if (hrs >  0) msg = "Mornin' Doc! How's your sleep?"; // REALLY early
			if (hrs >  6) msg = "Good Morning Doc!";      // After 6am
			if (hrs > 12) msg = "Good Afternoon Doc!";    // After 12pm
			if (hrs > 17) msg = "Good Evening Doc!";      // After 5pm

			$('#greetings').empty();
			$('#greetings').append(msg);


			$(document).on('click', '#show', function(){
				var id = $(this).attr('rowid');
				$.ajax({
					type: "POST",
					url: "<?php echo base_url(); ?>main/announcement_details",
					data: {id:id},
					success: function(details){
						$('#showDetails').empty();
						$('#showDetails').append(details);
					}
				})
			});
		})
	</script>