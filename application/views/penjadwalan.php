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
		<h3><b>Set Jadwal Random</h3><br>
		<form method="post" class="form-horizontal">
			<div class="form-group">
				<label class="control-label col-sm-4">
					Jumlah Populasi
				</label>
				<div class="col-sm-8">
					 <input type="text" name="jumlah_populasi" value="<?php echo isset($jumlah_populasi) ? $jumlah_populasi : '10' ;?>">
				</div>
			</div>
			<input type="hidden" name="probabilitas_crossover" value="<?php echo isset($probabilitas_crossover) ? $probabilitas_crossover: '0.90' ;?>">
			<input type="hidden" name="probabilitas_mutasi" value="<?php echo isset($probabilitas_mutasi) ? $probabilitas_mutasi : '0.40' ;?>">
			<div class="form-group">
				<label class="control-label col-sm-4">
					Jumlah Generasi
				</label>
				<div class="col-sm-8">
					<input type="text" name="jumlah_generasi" value="<?php echo isset($jumlah_generasi) ? $jumlah_generasi : '10000' ;?>">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-4">
					Mulai Generate
				</label>
				<div class="col-sm-8">
					<input type="date" name="start" value="<?php echo date('Y-m-d'); ?>">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-4">
					Akhir Generate
				</label>
				<div class="col-sm-8">
					<input type="date" name="end" value="<?php $date = strtotime("+7 day", strtotime(date('Y-m-d'))); echo $start = date("Y-m-d", $date);?>">
				</div>
			</div>
			<br>
			<center>
					<input name="tombol_submit" type="submit" value="Generate" class="btn btn-success">
			</center>
		</form>
		<?php if($rs_jadwal->num_rows() === 0):?>
		<!--
		<div class="alert alert-error">
            <button type="button" class="close" data-dismiss="alert">�</button>
			Tidak ada data.
        </div>
		-->
		<?php else: ?>
		<div id="content_ajax">

          <div class="pagination pull-right" id="ajax_paging">
            <ul>
            </ul>
          </div>




           <div class="pagination pull-right" id="ajax_paging">
             <ul>
             </ul>
          </div>
        </div>
        <?php endif; ?>
	</div>
	</div>

</div>
</div>
</div>
</div>
</body>
</html>
