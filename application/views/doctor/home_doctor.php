<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>members Page</title>
   
</head>
<body>


	<h1>Doctor</h1>

    
	<?php
		
		echo "<pre>";
		print_r($this->session->all_userdata());
		echo "</pre>";
	
	?>
    
    <a href="<?php echo base_url()."main/logout" ?>">logout</a>



</body>
</html>