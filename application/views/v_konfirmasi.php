<!doctype html>
<html lang="en">
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
        <h3><b>Konfirmasi</h3><br>
        <h5><b>Ada akun yang melakukan Login pada website,</b></h5>
		<h5><b>dan meminta akses untuk bisa masuk ke website</b></h5>
		<h5><b>Silahkan lakukan proses konfirmasi !!!</b></h5>
		</div>
	  <div class="caption-one">
		<?php echo "<h6>".$this->session->flashdata('message')."</h6>";?><br>
			<!-- ISI DATA AKAN MUNCUL DISINI -->
			<?php
			$no = 1; //untuk menampilkan no
			foreach($list_konfirmasi as $row){
				echo "
				<tr>
					Nama : <td>$row[first_name]</td><td>$row[last_name]</td><br>
					Email : <td>$row[email]</td><br>
					<td><br>
					<a href='konfirmasi/tolak/$row[id]' class='btn btn-danger'>Tolak</a>
					<a href='konfirmasi/edit/$row[id]' class='btn btn-success'>Terima</a>
					</td><br><br>
				</tr>
				";
			 }
				$no++;
			?>
	  </div>
    </div>
  </div>
</div>
</div>
</body>
</html>
