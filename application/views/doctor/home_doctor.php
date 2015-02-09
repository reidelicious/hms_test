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
						<a href="<?php echo base_url()."main/settings" ?>" id="editProfile">Edit Profile</a><br/>
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
							<div class="panel">
							    <div class="panel-header bg-darkBlue fg-white">
							    	<?php echo $row->announcement_subject; ?>    
							    </div>
							    <div class="panel-content">
							        <?php echo $row->announcement_details; ?>
							    </div>
							    <div class="panel-footer bg-lightTeal">
							    	Added from <?php if($row->fk_clinic_id != 0){ echo $row->room_num ." (". $row->clinic_name .")"; }else{ echo "Admin"; } ?><br/>
							    	<?php echo $row->announcement_datetime_made; ?>
							    </div>
							</div>	<br/>
						<?php endforeach; ?>	
				</div>
			</div>
			</div>
		</div>
	</div>