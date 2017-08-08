<!DOCTYPE html>
<html lang="en">  
<head>
    <meta charset="utf-8">
    <title><?php echo $page_title; ?> - Timbremedia Radio Admin</title>
    <link rel="icon" href="<?php echo $this->config->item('assets_url')?>favicon.ico" type="image/ico" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">    
     <!-- Bootstrap Core CSS -->
    <link href="<?php echo $this->config->item('assets_url')?>admin/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo $this->config->item('assets_url')?>admin/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="<?php echo $this->config->item('assets_url')?>admin/dist/css/timeline.css" rel="stylesheet">
    
    <link href="<?php echo $this->config->item('assets_url')?>admin/dist/css/datepicker.min.css" rel="stylesheet">
     
      <!-- DataTables CSS -->
    <link href="<?php echo $this->config->item('assets_url')?>admin/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="<?php echo $this->config->item('assets_url')?>admin/bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link href="<?php echo $this->config->item('assets_url')?>admin/dist/css/sb-admin-2.css" rel="stylesheet">
    
    <link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('assets_url')?>admin/dist/css/sweet-alert.css">
    
    <!-- Morris Charts CSS -->
    <link href="<?php echo $this->config->item('assets_url')?>admin/bower_components/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo $this->config->item('assets_url')?>admin/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    
    <link href="<?php echo $this->config->item('assets_url')?>admin/dist/css/sumoselect.css" rel="stylesheet">
	
	 <!-- jQuery -->
    <script src="<?php echo $this->config->item('assets_url')?>admin/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo $this->config->item('assets_url')?>admin/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo $this->config->item('assets_url')?>admin/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="<?php echo $this->config->item('assets_url')?>admin/bower_components/raphael/raphael-min.js"></script>
    <!--<script src="<?php //echo $this->config->item('assets_url')?>admin/bower_components/morrisjs/morris.min.js"></script>-->
    <!--<script src="<?php //echo $this->config->item('assets_url')?>admin/js/morris-data.js"></script>-->
    <script src="<?php echo $this->config->item('assets_url')?>admin/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo $this->config->item('assets_url')?>admin/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo $this->config->item('assets_url')?>admin/dist/js/sweet-alert.min.js"></script>
    
    <script src="<?php echo $this->config->item('assets_url')?>admin/dist/js/jquery.sumoselect.js"></script>
    
    <script type="text/javascript" src="<?php echo $this->config->item('assets_url')?>admin/dist/js/bootstrap-datepicker.js"></script>
    
    <!-- Custom Theme JavaScript -->
    <script src="<?php echo $this->config->item('assets_url')?>admin/dist/js/sb-admin-2.js"></script>
	<script src="<?php echo $this->config->item('assets_url')?>ckeditor/ckeditor.js"></script>
	 
</head>

<body>
