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
		<h3><b>Pendaftaran</h3><br>
		<form method="post" class="form-horizontal">
			<div class="form-group">
				<label class="control-label col-sm-2">
					Kode
				</label>
				<div class="col-sm-10">
					<input id="kode" type="text" class="form-control" name="Kode" required="" readonly="true"/>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2">
					Nama
				</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" name="first_name" value="<?=isset($default['first_name'])? $default['first_name'] : ""?>" readonly="true">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2">
					Email					
				</label>
				<div class="col-sm-10">
					<input type="email" class="form-control" name="email" value="<?=isset($default['email'])? $default['email'] : ""?>" readonly="true">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2">
				Role
				</label>
				<div class="col-sm-10">
					<select id="Peran" class="col-sm-12" name="Peran" onchange="kode_otomatis()"><?=isset($default['Peran'])? $default['Peran'] : ""?> >
						<option value="1">Administrator</option>
						<option value="2">Developer</option>
						<option value="3">Support</option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2">
				Status
				</label>
				<div class="col-sm-10">
					<select class="col-sm-12" name="Status" onchange="kode_otomatis()"><?=isset($default['Status'])? $default['Status'] : ""?>>
						<option value="1">Primary</option>
						<option value="2">Secondary</option>
						<option value="3">-</option>
					</select>
				</div>
			</div>
			
			<center>
				<button name="tombol_submit" class="btn btn-primary">
					Simpan
				</button>
			</center>


		</form>
	</div>
	</div>
	</div>
	</div>
	</div>
</body>
<script type="text/javascript">
function kode_otomatis() 
{
	$.ajax({
		dataType: "json",
		url:"http://localhost/jadwal_jaga/Konfirmasi/get_angka",
		type:"GET",
		data: {
			varkode: document.getElementById("Peran").value
		},
		success:function(data)
		{
			console.log(data);
			let angka = data.angka;
			
			let Peran = document.getElementById("Peran").value;
			
			if(Peran==="1"){
				document.getElementById("kode").value = "ADM01-"+angka;
			}
			else if(Peran==="2"){
				document.getElementById("kode").value = "DEV02-"+angka;
			}
			else if(Peran==="3"){
				document.getElementById("kode").value = "SPT03-"+angka;
			}
		}
	});
}

</script>
</html>