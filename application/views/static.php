<!DOCTYPE html>
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
		<style>
			#gambar {
				width : 100px;
				height : 100px;
			}
		</style>
	</head>
  <body>
    <nav class="navbar navbar-inverse" id="mainNav">
      <div class="container-fluid">
		<div class="navbar-header">
			  <a class="navbar-brand" href="#">
				<span class="glyphicon glyphicon-play-circle" aria-hidden="true"></span>
			  </a>
			  <a class="navbar-text">REKA SINERGI PRATAMA</a>
		</div>
        <!-- 
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <i class="fa fa-bars"></i>
        </button> -->
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="nav nav-tabs nav-justified">
            <li class="nav-item">
              <a class="nav-link" href="Calendar">
			  <span class="glyphicon glyphicon-calendar" aria-hidden="true">
			  Calendar
			  </span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="Karyawan">
			  <span class="glyphicon glyphicon-pencil" aria-hidden="true">
			  Data
			  </span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="Izin">
			  <span class="glyphicon glyphicon-stats" aria-hidden="true">
			  Statistik
			  </span></a>
            </li>
			
			<?php
			$this->load->model("User");
			$user_mail = $this->session->userdata('userData');
			$cekperan = $this->User->checkPeran($user_mail);
			$peran = null;
			foreach ($cekperan as $post) {
			$peran = $post['Peran'];
			// $this->session->set_userdata('peran', 1);
				}
			$this->session->userdata('userData');
			if($peran == 1){
			?>
			<li class="nav-item">
              <a class="nav-link" href="Pendaftar">
			  <span class="glyphicon glyphicon-user" aria-hidden="true">
			  Pendaftar
			  </span></a>
            </li>
			<li class="nav-item">
              <a class="nav-link" href="Pengaturan">
			  <span class="glyphicon glyphicon-cog" aria-hidden="true">
			  Pengaturan
			  </span></a>
            </li>
			<?php	} 
				else{
			}
				?>
			

			<li>
			<div class="dropdown" >
					<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
						<img class "gambar" src="<?php echo @$userData['picture_url']; ?>" width=30px/>
					</button>
					<div class="dropdown-content" aria-labelledby="dropdownMenu1">
						<a href="#"><?php echo @$userData['first_name'].' '.@$userData['last_name']; ?></a>
						<a href="#"><?php echo @$userData['email']; ?></a>
						<a href="<?php echo base_url().'user_authentication/logout'; ?>"><span class="glyphicon glyphicon-off" aria-hidden="true"> Logout</a>
					</div>
				</div>
			</li>
            </div>
          </ul>
        </div>
      </div>
    </nav>
    <!-- Main Content -->
   <?php echo $contents;?>
          <hr>
          <!-- Pager -->

    <hr>

    <!-- Footer -->
    <footer>
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-10 mx-auto">
            <ul class="list-inline text-center">
              <li class="list-inline-item">
                <a href="#">
                  <span class="fa-stack fa-lg">
                    <i class="fa fa-circle fa-stack-2x"></i>
                    <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
                  </span>
                </a>
              </li>
              <li class="list-inline-item">
                <a href="#">
                  <span class="fa-stack fa-lg">
                    <i class="fa fa-circle fa-stack-2x"></i>
                    <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
                  </span>
                </a>
              </li>
              <li class="list-inline-item">
                <a href="#">
                  <span class="fa-stack fa-lg">
                    <i class="fa fa-circle fa-stack-2x"></i>
                    <i class="fa fa-github fa-stack-1x fa-inverse"></i>
                  </span>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </footer>
  </body>

</html>
