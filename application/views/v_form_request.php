<!doctype html>
<html lang="en">
	<head>
		<base href="<?=base_url()?>">
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
		<h3><b>Permintaan Izin</h3><br>
		<form method="post" class="form-horizontal">
			<div class="form-group">
				<label class="control-label col-sm-2">
				<span align="left">Nama</span>
				</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" name="Nama" value="<?=isset($default['title'])? $default['title'] : ""?>" readonly="true">
				</div>
			</div><br>
			<div class="form-group">
				<label class="col-sm-3">
					Keterangan					
				</label>
				<div class="col-sm-7">
					<select class="col-sm-12" name="keterangan">
						<option value="1">Izin</option>
						<option value="2">Sakit</option>
						<option value="3">Tugas Kantor</option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2">
				Alasan
				</label>
				<div class="col-sm-8">
				<input type="text" class="form-control" name="alasan" value="">
				</div>
			</div>
			
			<center>
				<button name="tombol_submit" class="btn btn-warning">
					Laporkan
				</button>
			</center>
		</form>
	</div>
	</div>
	</div>
	</div>
	</div>
</body>
</html>