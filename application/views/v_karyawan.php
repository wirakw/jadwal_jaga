<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if(!$this->session->userdata('status')){
		redirect('/user_authentication/');
}
?>
<!DOCTYPE html>
<html>
	<body>
		<div >
			<section class="content">
				<div class="row">
					<div class="col-xs-12">
						<!-- box box-primary -->
						<div class="box box-primary">

							<!-- modal dialog-->
							<div class="modal fade" id="mymodaladd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							  <div class="modal-dialog">
							    <div class="modal-content">
								      <div class="modal-header">
									  
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
										
								        <h4 class="modal-title" id="myModalLabel">Tambah Data Karyawan</h4>
								      </div>
								      <div class="modal-body">
											<div class="form-group">
							                  <label>Kode</label>
							                  <input id="kode" type="text" class="form-control" name="add_kode" placeholder="Kode" readonly="true">
							                </div>
							                <div class="form-group">
							                  <label>Nama</label>
							                  <input type="text" class="form-control" name="add_nama" placeholder="Nama">
							                </div>
							                <div class="form-group">
							                  <label>Email</label>
							                    <input type="Email" class="form-control" name="add_email" placeholder="Email">
							                </div>
							                <div class="form-group">
							                  <label>Role</label>
											  <select id="Peran" class="form-control" name="add_peran" onchange="kode_otomatis()"><?=isset($default['Peran'])? $default['Peran'] : ""?> >
							                      <option value="1">Administrator</option>
							                      <option value="2">Developer</option>
												  <option value="3">Support</option>
							                  </select>
							                </div>
											<div class="form-group">
							                  <label>Status</label>
							                  <select class="form-control" name="add_status" >
							                      <option value="1">Primary</option>
							                      <option value="2">Secondary</option>
												  <option value="3">Null</option>
							                  </select>
							                </div>
											
								      </div>
										<div class="modal-footer">
									      <button type="submit" class="btn btn-success" data-dismiss="modal" id="add_action">Simpan</button>
									      <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
										</div>
		
							    </div>
							  </div>
							</div>
							<div class="modal fade" id="mymodalupdate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							  <div class="modal-dialog">
							    <div class="modal-content">
								      <div class="modal-header">
								        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								        <h4 class="modal-title" id="myModalLabel">Ubah Data Karyawan</h4>
								      </div>
								      <div class="modal-body">
											<div class="form-group">
							                  <label>Kode</label>
							                  <input type="text" class="form-control" name="update_kode" placeholder="Kode" readonly="true">
							                </div>
							                <div class="form-group">
							                  <label>Nama</label>
							                  <input type="hidden" class="form-control" name="update_id">
							                  <input type="text" class="form-control" name="update_nama" placeholder="Nama" readonly="true">
							                </div>
							                <div class="form-group">
							                  <label>Email</label>
							                    <input type="Email" class="form-control" name="update_email" placeholder="Email">
							                </div>
							                <div class="form-group">
							                  <label>Role</label>
											  <select class="form-control" name="update_peran" >
							                      <option value="1">Administrator</option>
							                      <option value="2">Developer</option>
												  <option value="3">Support</option>
							                  </select>
										   </div>
											<div class="form-group">
							                  <label>Status</label>
							                  <select class="form-control" name="update_status" >
							                      <option value="1">Primary</option>
							                      <option value="2">Secondary</option>
												  <option value="3">-</option>
							                  </select>
							                </div>
								      </div>
								      <div class="modal-footer">
									      <button type="submit" class="btn btn-success" data-dismiss="modal" id = "update_action">Ubah</button>
									      <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
								      </div>
							    </div>
							  </div>
							</div>
							<!-- /modal dialog-->
							<!-- box-header -->
							<div class="box-header with-border">
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
										if($peran == 1 || $peran == 3){
										?>
										<button class="btn btn-primary tambah-form" data-toggle="modal" data-target="#mymodaladd"><i class="fa fa-plus"></i>Tambah</button>
										<?php	} 
										
										else{
										
											}
									  ?>
							</div>
							<!-- /box-header -->
							<!-- view data -->
			                <div class="box-body">
								<table id="tabel_data_pegawai" class="table table-bordered table-striped">
									<thead>
										<tr>
											<th>Id</th>
											<th>Kode</th>
											<th>Nama</th>
											<th>Email</th>
											<th>Peran</th>
											<th>Status</th>
											
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
										if($peran == 1 || $peran == 3){
										?>
										<th>Action</th>
										<?php	} 
										
										else{
										
											}
									  ?>
									
										</tr>
									</thead>
								</table>
			                </div><!-- /.box-body -->
							<!-- /view data -->
						</div>
						<!-- /box box-primary-->
					</div><!--/.col (right) -->
				</div> <!-- /.row -->
			</section><!-- /.content -->
		</div>

<script type="text/javascript">

function kode_otomatis() 
{
	$.ajax({
		dataType: "json",
		url:"http://localhost/jadwal_jaga/Karyawan/get_angka",
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
		
			var t = $('#tabel_data_pegawai').DataTable({
					  "autoWidth": false,
					  "rowCallback": function( row, data, index ) {
						  $('td:eq(5)', row).html("<button class=\"btn btn-warning\" data-toggle=\"modal\" data-target=\"#mymodalupdate\" onclick='handleClickUpdate("+data[0]+");'><i class=\"fa fa-edit\"></i>Ubah</button>&nbsp;&nbsp;<button class=\"btn btn-danger\"  data-toggle=\"modal\" onclick='handleClickDelete("+data[0]+");'><i class=\"fa fa-trash\"></i>Hapus</button>");
					  },
					  "columnDefs": [
		    				{ "width": "2%", sClass: "dt-head-center dt-body-center", "visible": false, "targets": 0 },
		    				{ "width": "10%", sClass: "dt-head-center dt-body-center", "targets": 1 },
		    				{ "width": "20%", sClass: "dt-head-center dt-body-center", "targets": 2 },
		    				{ "width": "20%", sClass: "dt-head-center dt-body-center", "targets": 3 },
		    				{ "width": "15%", sClass: "dt-head-center dt-body-center", "targets": 4 },
		    				{ "width": "20%", sClass: "dt-head-center dt-body-center", "targets": 5 }
		  				]
					});
			
			function getDataOnJSON(data, id) {
				for(var i = 0; i < data.length; i++)
				{
					if(data[i][0] == id){
						return data[i];
					}
				}
			}


			function handleClickUpdate(id){
				$.ajax({
					dataType: "json",
					url:"update_form",
					type:"POST",
				    contentType: false,
				    processData: false,
					data: function() {
				        var data = new FormData();
				        data.append("id", id);
				        return data;
				    }(),
				    success:function(data){
				        $("input[name=\"update_id\"]").val(data[0].id);
						$("input[name=\"update_kode\"]").val(data[0].Kode);
			  			$("input[name=\"update_nama\"]").val(data[0].Nama);
			  			$("select[name=\"update_status\"]").val(data[0].Status);
			  			$("select[name=\"update_peran\"]").val(data[0].Peran);
			  			$("input[name=\"update_email\"]").val(data[0].Email);
				        console.log(JSON.stringify(data));
					}
				})
			}


			function handleClickDelete(id){
					swal({
					  title: "Apa kamu yakin?",
					  text: "Data yang terhapus tidak bisa dikembalikan!",
					  type: "warning",
					  showCancelButton: true,
					  confirmButtonClass: "btn-danger",
					  confirmButtonText: "Ya, hapus!",
					  closeOnConfirm: false
					},
					function(){
						
						$.ajax({
							dataType: "json",
							url:"action_anggota",
							type:"POST",
						    contentType: false,
						    processData: false,
							data: function() {
						        var data = new FormData();
						        data.append("action", "delete");
						        data.append("id", id);
						        return data;
						    }(),
						    success:function(data){
						    	add_data_to_table_t(t, data);
							}
						})
					  swal("Terhapus!", "Data berhasil dihapus.", "success");
					});
			}


			function add_data_to_table_t(table, data){
		  	  	table.clear().draw();
		  	  	table.rows.add(data).draw( false );
			}

			function refresh_tabel(){
				$.ajax({
					url:"karyawan/select_data",
					dataType: "json",
			        success:function(data){
			        	add_data_to_table_t(t, data);
				        console.log(JSON.stringify(data));
					}
				})
			}

		  	$(document).ready(function(){
		  		$(function(){
			  		t.order( [ 0, 'asc' ] ).draw(false);

		  			refresh_tabel();
				});

			  	$("#add_action").click(function(){
// variabel penampung					
					var Kode = $("input[name=\"add_kode\"]").val();
			  		var Nama = $("input[name=\"add_nama\"]").val();
			  		var Status = $("select[name=\"add_status\"]").val();
			  		var Peran = $("select[name=\"add_peran\"]").val();
			  		var Email = $("input[name=\"add_email\"]").val();
					$.ajax({
						dataType: "json",
						url:"action_anggota",
						type:"POST",
				        contentType: false,
				        processData: false,
// memasukan data ke database namun belum ditampilkan lngsung di view
						data: function() {
					        var data = new FormData();
					        data.append("action", "add");
							data.append("Kode", Kode);
					        data.append("Nama", Nama);
					        data.append("Status", Status);
					        data.append("Peran", Peran);
					        data.append("Email", Email);
					        return data;
				        }(),
// menampilkan data pada view
				        success:function(data){
							$("input[name=\"add_kode\"]").val(data[0].Kode);
			  				$("input[name=\"add_nama\"]").val(data[0].Nama);
			  				$("select[name=\"add_status\"]").val();
			  				$("select[name=\"add_peran\"]").val();
			  				$("input[name=\"add_email\"]").val(data[0].Email);
							add_data_to_table_t(t, data);
							
						}
					});
				});

			  	$("#update_action").click(function(){
			  		var id = $("input[name=\"update_id\"]").val();
					var Kode = $("input[name=\"update_kode\"]").val();
			  		var Nama = $("input[name=\"update_nama\"]").val();
			  		var Status = $("select[name=\"update_status\"]").val();
			  		var Peran = $("select[name=\"update_peran\"]").val();
			  		var Email = $("input[name=\"update_email\"]").val();
					$.ajax({
						dataType: "json",
						url:"action_anggota",
						type:"POST",
				        contentType: false,
				        processData: false,
						data: function() {
					        var data = new FormData();
					        data.append("action", "update");
					        data.append("id", id);
							data.append("Kode", Kode);
					        data.append("Nama", Nama);
					        data.append("Status", Status);
					        data.append("Peran", Peran);
					        data.append("Email", Email);
					        return data;
				        }(),
				        success:function(data){
				        	add_data_to_table_t(t, data);
						}
					})
				});
			});
		</script>
	</body>
</html>
