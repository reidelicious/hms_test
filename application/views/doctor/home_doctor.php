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
		<div class="grid">
			<div class="row">
			<div class="span12">
				<div class="span3">
					<br/><br/>
					<center>
						<?php echo img($this->session->userdata('avatar')); ?><br/>
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
				<div class="span9 offset 6">
						<header>
							<legend><h1>Announcements</h1></legend>
						</header><br/>
						<?php foreach($announcements as $row): ?>
							<hr class="style-eight">
								<div class="panel">
								    <div class="panel-header bg-darkBlue fg-white">
								    	
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