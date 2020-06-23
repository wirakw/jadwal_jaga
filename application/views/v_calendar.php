<!DOCTYPE html>
<html>
<script type='text/javascript'>
		$(document).ready(function() {
		  $('#calendar').fullCalendar({
			googleCalendarApiKey: 'AIzaSyD26uOplXHt94W1FfJgq4TwWCLrkL7oEhs',
			events: {
			  googleCalendarId: 'panglimas100@gmail.com',
			  className: 'gcal-event' // an option!
			}
		  });
		});

	</script>
<body>
  <div class="content">
                <!-- Notification -->
      <div class="row">
         <div class="col-sm-12 column">
			      <div class="box box-primary">
						   <div class="box-header with-border">
							     <div class="col-xs-1">
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
										     <div class="dropdown">
  										            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
  											                          <span class="glyphicon glyphicon-option-vertical" aria-hidden="true">
  											                          <span class="caret"></span>
  										            </button>
										              <div class="dropdown-content" aria-labelledby="dropdownMenu1">
              											<a href="#">Set Cuti Kantor</a>
              											<a data-toggle="modal" data-target="#input_libur">Set Jadwal Libur</a>
              											<a href="Genetik/Penjadwalan">Set Jaga Random</a>
										              </div>
										     </div>
										     <?php	}

										else{}
									  ?>
									</div>
							</div>
                        <div id='calendar' style="background-color: orange;"></div>
					</div>
                </div>
            </div>
        </div>

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

<!-- Modal -->
      <div class="modal fade" id="input_libur" role="dialog">
        <div class="modal-dialog">

      <!-- Modal content-->
        <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4>Masukan Jadwal libur</h4>
        </div>
        <div class="modal-body">
          <form role="form">
              <input class="col-md-6" type="text" name="Ket_libur" id="Ket_libur" placeholder="Keterangan Libur">
              <input class="col-md-6" type="text" name="status_libur" id="status_libur" placeholder="Status Libur">
              <div class="col-md-6" style="margin-top : 10px;">mulai libur : <input type="date"  name="start_libur" id="start_libur"></div>
              <div class="col-md-6" style="margin-top : 10px;">akhir libur : <input type="date"  name="end_libur" id="end_libur"></div>
              <input type="text" id="color_libur" value="#ff0000" hidden="true">
          </form>
        </div>
        <div class="modal-footer">
          <button type="submit" id="insert_libur" class="btn btn-success">Submit</button>
          <button type="submit" class="btn btn-default" data-dismiss="modal">Cancel</button>
        </div>
      </div>

        </div>
      </div>

		<?php
  }
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
	        <div class="modal fade" id="modal">
            <div class="modal-dialog" style="height:100px;width:300px;">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title"></h4>
                    </div>
                    <div class="modal-body">
                        <div class="error"></div>
                        <form class="form-horizontal" id="crud-form">
                          <input type="hidden" id="start"/>
                          <input type="hidden" id="end"/>
						                    <div class="row form-group">
						                       <div align="center" class="col-md-12">
						                          <b>Primary Dev<b><br>
						                           <select name="title" value="primary" id="title">
  									                      <option> - Pilih Developer -</option>
                              					<?php
                              						foreach ($Calendar->result() as $baris) {
                              						echo "<option value='".$baris->Nama."'>".$baris->Nama."</option>";
                              						}
                              		   			?>
						                            </select>
						                           <input id="status" value="primary" type="hidden"/>
						                         </div>
						                     </div>
                                 <div class="row form-group">
                                   <div align="center" class="col-md-12">
								                    <b>Secondary Dev<b><br>
                                    <select name="title2" value="primary" id="title2">
                    									<option> - Pilih Developer -</option>
                    										<?php
                    											foreach ($Karyawan->result() as $baris) {
                    											echo "<option value='".$baris->Nama."'>".$baris->Nama."</option>";
                    											}
                    										?>
                    								</select>
                                    <input id="status2" value="secondary" type="hidden"/>
                                  </div>
                                </div>
                                    <input id="color" name="color" value="#094cb7" type="hidden"/>
                                    <input id="color2" name="color2" value="#6298ef" type="hidden"/>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modal1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title"></h4>
                    </div>
                    <div class="modal-body">
                        <div class="error"></div>
                        <form class="form-horizontal" id="crud-form">
                        <input type="hidden" id="start">
                        <input type="hidden" id="end">
                          <div class="row form-group">
                                <div class="col-md-4">
                                    <input id="title_update" name="title_update" type="text" class="form-control input-md" placeholder="nama" readonly="true"/>
                                    <!-- <input id="status" name="status" type="text" hidden="true"/> -->
                                </div>
                                <div class="text-center col-md-4">
								<img style="height:40px; width:160px" src="<?php echo base_url();?>assets/img/arrow.png" class="img-rounded" alt="Cinque Terre">
								</div>
                                <div class="col-md-4">
								 <select name="dev_sebelumnya" placeholder="Pilih Developer" id="dev_sebelumnya">
										<?php
											foreach ($Karyawan->result() as $baris) {
											echo "<option value='".$baris->Nama."'>".$baris->Nama."</option>";
											}
										?>
								</select>
                                </div>
                          </div>
                                  <textarea class="form-control" id="description" name="description" placeholder="keterangan"></textarea>
                                    <!-- <input id="color" name="color" type="text" value="#ff8000" hidden="true"/>
                                    <input id="color2" name="color2" type="text" value="#ff9900" hidden="true"/> -->
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
	<?php	}
	else{
		}
	?>
    </body>

</html>
