<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if(!$this->session->userdata('status')){
		redirect('/user_authentication/');
}
?><!DOCTYPE html>
<html>
	<body>
		<div >
			<section class="content">
				<div class="row">
					<div class="col-xs-12">
						<!-- box box-primary -->
						<div class="box box-primary">
							<!-- modal dialog-->
							<div class="modal fade" id="mymodalupdate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							  <div class="modal-dialog">
							    <div class="modal-content">
								      <div class="modal-header">
								        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								        <h4 class="modal-title" id="myModalLabel">Sesuaikan Data Izin</h4>
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
							                  <label>Keterangan</label>
							                  <select class="form-control" name="update_keterangan">
							                      <option value="1">Izin</option>
							                      <option value="2">Sakit</option>
												  <option value="3">Tugas Kantor</option>
							                  </select>
							                </div>
											<div class="form-group">
							                  <label>Alasan</label>
							                  <input type="text" class="form-control" name="update_alasan" placeholder="Alasan">
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

							<!-- view data -->
			                <div class="box-body">
								<table id="tabel_data_pegawai" class="table table-bordered table-striped">
									<thead>
										<tr>
											<th>Id</th>
											<th>Nama</th>
											<th>Tanggal</th>
											<th>Keterangan</th>
											<th>Alasan</th>
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
			var t = $('#tabel_data_pegawai').DataTable({
					  "autoWidth": false,
					  "rowCallback": function( row, data, index ) {
						  $('td:eq(5)', row).html("<button class=\"btn btn-warning\" data-toggle=\"modal\" data-target=\"#mymodalupdate\" onclick='handleClickUpdate("+data[0]+");'><i class=\"fa fa-edit\"></i>Ubah</button>");
					  },
					  "columnDefs": [
		    				{ "width": "2%", sClass: "dt-head-center dt-body-center", "visible": false, "targets": 0 },
		    				{ "width": "25%", sClass: "dt-head-center dt-body-center", "targets": 1 },
		    				{ "width": "20%", sClass: "dt-head-center dt-body-center", "targets": 2 },
		    				{ "width": "15%", sClass: "dt-head-center dt-body-center", "targets": 3 },
							{ "width": "20%", sClass: "dt-head-center dt-body-center", "targets": 4 },
		    				{ "width": "25%", sClass: "dt-head-center dt-body-center", "targets": 5 }
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
					url:"update",
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
			  			$("input[name=\"update_nama\"]").val(data[0].Nama);
			  			$("select[name=\"update_keterangan\"]").val(data[0].Ket);
			  			$("input[name=\"update_alasan\"]").val(data[0].Alasan);
			  			$("input[name=\"update_kode\"]").val(data[0].Kode);
				        console.log(JSON.stringify(data));
					}
				})
			}

			function handleClickDelete(id){
					swal({
					  title: "Apa kamu yakin?",
					  text: "Kamu tidak akan bisa mengembalikan data yang sudah terhapus!",
					  type: "warning",
					  showCancelButton: true,
					  confirmButtonClass: "btn-danger",
					  confirmButtonText: "Ya, hapus!",
					  closeOnConfirm: false
					},
					function(){
						$.ajax({
							dataType: "json",
							url:"action_izin",
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
					url:"izin/select_izin",
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
			  		var Nama = $("input[name=\"add_nama\"]").val();
			  		var Ket = $("select[name=\"add_keterangan\"]").val();
			  		var Alasan = $("input[name=\"add_alasan\"]").val();
			  		var Kode = $("input[name=\"add_kode\"]").val();
					$.ajax({
						dataType: "json",
						url:"action",
						type:"POST",
				        contentType: false,
				        processData: false,
						data: function() {
					        var data = new FormData();
					        data.append("action", "add");
					        data.append("Nama", Nama);
					        data.append("Ket", Ket);
					        data.append("Alasan", Alasan);
					        data.append("Kode", Kode);
					        return data;
				        }(),
				        success:function(data){
				        	add_data_to_table_t(t, data);
						}
					});
				});

			  	$("#update_action").click(function(){
			  		var id = $("input[name=\"update_id\"]").val();
			  		var Nama = $("input[name=\"update_nama\"]").val();
			  		var Ket = $("select[name=\"update_keterangan\"]").val();
			  		var Alasan = $("input[name=\"update_alasan\"]").val();
			  		var Kode = $("input[name=\"update_kode\"]").val();
					$.ajax({
						dataType: "json",
						url:"action_izin",
						type:"POST",
				        contentType: false,
				        processData: false,
						data: function() {
					        var data = new FormData();
					        data.append("action", "update");
					        data.append("id", id);
					        data.append("Nama", Nama);
					        data.append("Ket", Ket);
					        data.append("Alasan", Alasan);
					        data.append("Kode", Kode);
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
