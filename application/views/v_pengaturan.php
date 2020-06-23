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
							<div class="col-xs-4">
							<br>
								<img class="gambar" src="<?php echo @$userData['picture_url']; ?>" width=30px/><br>
								<div class="form-group">
									<label class="control-label col-sm-4">
										Nama
									</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" name="Nama" value="<?php echo @$userData['first_name']; ?>" readonly="true">
									</div>
								</div><br><br>
								<div class="form-group">
									<label class="control-label col-sm-4">
										Email					
									</label>
										<div class="col-sm-8">
										<input type="text" class="form-control" name="Nama" value="<?php echo @$userData['email']; ?>" readonly="true" >
									</div>
								</div><br><br>
							</div>
						<div class="col-xs-8">
							<h3><span class="glyphicon glyphicon-cog" aria-hidden="true"><b> Pengaturan</b></h3><br>
							
							
							<?php
							//untuk menampilkan no
							foreach($list_karyawan as $row){
							?>

							<?php echo form_open('Pengaturan/insert') ?>
							<div class="form-group">
									<label class="control-label col-sm-7">
										Pengaturan Pendaftaran						
									</label>
										<div class="col-sm-4">
										<input type="text" class="form-control" name="Nama" value="<?php echo "$row[pendaftaran]"?>"  readonly="true">
									</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-7">
								</label>
								<div class="col-sm-4">
								<select class="col-sm-12" name="pendaftaran">
									<option>-- Atur Ulang --</option>
									<option value="Buka">Buka</option>
									<option value="Tutup">Tutup</option>
								</select>
								</div>
							</div><br><br><br>
							<div class="form-group">
									<label class="control-label col-sm-7">
										Sesuaikan Email Pengirim					
									</label>
										<div class="col-sm-4">
										<input type="text" class="form-control" name="pengirim" value="<?php echo "$row[pengirim]"?>">
									</div>
							</div><br><br><br>
								<input class="btn btn-success" type="submit" name="tampil" value="Simpan">
							<?php echo form_close()?>
							
							<?php } ?>
						</div>
			                <div class="box-body">
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
		    				{ "width": "10%", sClass: "dt-head-center dt-body-center", "visible": false, "targets": 0 },
		    				{ "width": "20%", sClass: "dt-head-center dt-body-center", "targets": 1 },
		    				{ "width": "20%", sClass: "dt-head-center dt-body-center", "targets": 2 },
		    				{ "width": "20%", sClass: "dt-head-center dt-body-center", "targets": 3 },
		    				{ "width": "20%", sClass: "dt-head-center dt-body-center", "targets": 4 },
							{ "width": "20%", sClass: "dt-head-center dt-body-center", "targets": 5 },
		    				
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
					url:"form_update",
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
			  			$("input[name=\"update_nama\"]").val(data[0].first_name);
			  			$("input[name=\"update_email\"]").val(data[0].email);
			  			$("input[name=\"update_status\"]").val(data[0].status);
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
							url:"action_pendaftar",
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
					url:"Pendaftar/select_izin",
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


			  	$("#update_action").click(function(){
			  		var id = $("input[name=\"update_id\"]").val();
			  		var first_name = $("input[name=\"update_nama\"]").val();
			  		var email = $("input[name=\"update_email\"]").val();
			  		var status = $("input[name=\"update_status\"]").val();
					$.ajax({
						dataType: "json",
						url:"action_pendaftar",
						type:"POST",
				        contentType: false,
				        processData: false,
						data: function() {
					        var data = new FormData();
					        data.append("action", "update");
					        data.append("id", id);
					        data.append("first_name", first_name);
					        data.append("email", email);
					        data.append("status", status);
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
