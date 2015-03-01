<!DOCTYPE html>
<html>
<head>
<?php header('Cache-Control: no-cache, no-store, must-revalidate'); // HTTP 1.1.
header('Pragma: no-cache'); // HTTP 1.0.
header('Expires: 0');
?>

	<title><?php echo $title ?></title>
 	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="description" content="hms admin">
    <meta name="author" content="Angel James Torayno, ph, Reid">

	
   
	<?php   echo link_tag('assets/css/bootstrap.css'); ?>
   	<link href="<?php echo base_url('assets/css/metro-bootstrap.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/metro-bootstrap-responsive.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/iconFont.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/docs.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/js/prettify/prettify.css')?>" rel="stylesheet">

    <!-- Load JavaScript Libraries -->
    <script src="<?php echo base_url('assets/js/jquery/jquery.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/jquery/jquery.widget.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/jquery/jquery.mousewheel.js')?>"></script>
    <script src="<?php echo base_url('assets/js/jquery/jquery.dataTables.js')?>"></script>

    <script src="<?php echo base_url('assets/js/prettify/prettify.js')?>"></script>

    <!-- Metro UI CSS JavaScript plugins -->
    <script src="<?php echo base_url('assets/js/metro.min.js')?>"></script>
	<script src="<?php echo base_url('assets/js/metro/metro-streamer.js')?>"></script>
    <script src="<?php echo base_url('assets/js/metro/metro-calendar.js')?>"></script>         
	<script src="<?php echo base_url('assets/js/jquery.validate.js')?>"></script> 
    	<script src="<?php echo base_url('assets/js/additional-methods.js')?>"></script> 


 <script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.js');?>"></script>
 <style type="text/css">
 div.thumb {  min-height:200px; max-height:200px; min-width:200px; max-width:200px; overflow:hidden; }

.thumb img.scale{height:200px;width:auto;}
.thumb img.scale{height:auto;width:200px;}
 </style>

        

</head>
