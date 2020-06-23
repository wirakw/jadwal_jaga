<!DOCTYPE html>
<html>
	<head>
		<title>Jadwal Jaga</title>
		<!-- fle css -->
		<link rel="stylesheet" href="<?php echo base_url()."assets/";?>dist/css/bootstrap.css">
		<link rel="stylesheet" href="<?php echo base_url()."assets/";?>dist/css/bootstrap.min.css">
		<link rel="stylesheet" href="<?php echo base_url()."assets/";?>dist/css/AdminLTE.min.css">
		<link rel="stylesheet" href="<?php echo base_url()."assets/";?>dist/css/fullcalendar.css"/>
		<link rel="stylesheet" href="<?php echo base_url()."assets/";?>dist/css/sweetalert.css">
		<link rel="stylesheet" href="<?php echo base_url()."assets/";?>dist/css/bootstrapValidator.min.css">
		<link rel="stylesheet" href="<?php echo base_url()."assets/";?>dist/css/bootstrap-colorpicker.min.css">
		<link rel="stylesheet" href="<?php echo base_url()."assets/";?>dist/css/custom.css">
		<link rel="stylesheet" href="<?php echo base_url()."assets/";?>plugins/datatables/dataTables.bootstrap.css">
		<link rel="stylesheet" href="<?php echo base_url()."assets/";?>plugins/datatables/jquery.dataTables.min.css">
		<!-- fle js -->
		<script src="<?php echo base_url()."assets/";?>dist/js/moment.min.js"></script>
		<script src="<?php echo base_url()."assets/";?>dist/js/jquery.min.js"></script>
		<script src="<?php echo base_url()."assets/";?>dist/js/bootstrap.min.js"></script>
		<script src="<?php echo base_url()."assets/";?>dist/js/sweetalert.min.js"></script> <!-- lib js untuk sweet alert -->	
		<script src="<?php echo base_url()."assets/";?>plugins/jQuery/jQuery-2.1.4.min.js"></script> <!-- lib js untuk ajax -->
		<script src="<?php echo base_url()."assets/";?>plugins/datatables/jquery.dataTables.min.js"></script> <!-- lib js untuk datatables -->
		<script src="<?php echo base_url()."assets/";?>plugins/datatables/dataTables.bootstrap.min.js"></script> <!-- lib js untuk datatables -->	
		<script src="<?php echo base_url()."assets/";?>dist/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url()."assets/";?>dist/js/bootstrapValidator.min.js"></script>
        <script src="<?php echo base_url()."assets/";?>dist/js/fullcalendar.min.js"></script>
        <script src="<?php echo base_url()."assets/";?>dist/js/bootstrap-colorpicker.min.js"></script>
        <script src="<?php echo base_url()."assets/";?>dist/js/main.js"></script> 
	</head>
<body>
<div class="container">
<div class="row">
  <div class="col-sm-5">
    <div class="thumbnail">
      <div class="caption">
        <h3><b>Login</h3><br>
        <img src="<?php echo base_url(); ?>assets/images/user.png" alt="logo" style=width:80px;><br><br>
		<button type="button" class="btn btn-danger"><a href="<?php echo $loginURL; ?>">.   Masuk dengan Google+   .</a></button>
		<h5><b>Atau</b></h5>
		<button type="button" class="btn btn-primary"><a href="<?php echo $loginURL; ?>">.    Masuk dengan Outlook    .</a></button>
		</div>
    </div>
  </div>
</div>
</body>
</html>
