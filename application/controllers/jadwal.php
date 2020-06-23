<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Jadwal extends CI_Controller
{

	function __construct()
    {
        parent::__construct();
				//$this->load->model('generate');
				$this->load->library('template');
				$this->load->library('form_validation');
		// $this->load->model(array('m_dosen',
		// 						 'm_matakuliah',
		// 						 'm_ruang',
		// 						 'm_jam',
		// 						 'm_hari',
		// 						 'm_pengampu',
		// 						 'm_waktu_tidak_bersedia',
		// 						 'm_jadwalkuliah'));
		include_once("genetik.php");
    }

		function index(){
			echo "hao";
		}

	// function render_view($data)
	// {
  //     $this->load->view('page',$data);
	// }

	// function index()
	// {
	// 	$data = array();
	// 	$data['page_name'] = 'home';
	// 	$data['page_title'] = 'Welcome';
	//
	// 	$this->render_view($data);
	// }


	function penjadwalan(){
		$this->load->model('generate');

		$data = array();

		if(!empty($_POST)){
			// $this->form_validation->set_rules('semester_tipe','Semester','xss_clean|required');
			// $this->form_validation->set_rules('tahun_akademik','Tahun Akademik','xss_clean|required');
			$this->form_validation->set_rules('jumlah_populasi','Jumlah Populiasi','xss_clean|required');
			$this->form_validation->set_rules('probabilitas_crossover','Probabilitas CrossOver','xss_clean|required');
			$this->form_validation->set_rules('probabilitas_mutasi','Probabilitas Mutasi','xss_clean|required');
			$this->form_validation->set_rules('jumlah_generasi','Jumlah Generasi','xss_clean|required');

				//tempat keajaiban dimulai. SEMANGAAAAAATTTTTTT BANZAIIIIIIIIIIIII !


				$jumlah_populasi = $this->input->post('jumlah_populasi');
				$crossOver = $this->input->post('probabilitas_crossover');
				$mutasi = $this->input->post('probabilitas_mutasi');
				$jumlah_generasi = $this->input->post('jumlah_generasi');

				$data['jumlah_populasi'] = $jumlah_populasi;
				$data['probabilitas_crossover'] = $crossOver;
				$data['probabilitas_mutasi'] = $mutasi;
				$data['jumlah_generasi'] = $jumlah_generasi;

			    $rs_data = $this->db->query("SELECT   a.id,"
                                    . "       b.Nama,"
                                    . "       a.kode_status "
                                    . "FROM pengampu a "
                                    . "LEFT JOIN t_anggota b "
                                    . "ON a.id = b.id ");

				if($rs_data->num_rows() == 0){

					$data['msg'] = 'Tidak Ada Data dengan Semester dan Tahun Akademik ini <br>Data yang tampil dibawah adalah data dari proses sebelumnya';

					//redirect(base_url() . 'web/penjadwalan','reload');
				}else{
					$genetik = new genetik($jumlah_populasi, $crossOver, $mutasi);
					$genetik->AmbilData();
					$genetik->Inisialisai();



					$found = false;

					for($i = 0;$i < $jumlah_generasi;$i++ ){
						$fitness = $genetik->HitungFitness();

						//if($i == 100){
						//	var_dump($fitness);
						//	exit();
						//}

						$genetik->Seleksi($fitness);
						$genetik->StartCrossOver();

						$fitnessAfterMutation = $genetik->Mutasi();

						for ($j = 0; $j < count($fitnessAfterMutation); $j++){
							//test here
							if($fitnessAfterMutation[$j] == 1){

								$this->db->query("TRUNCATE TABLE events");

								$jadwal_jaga = array(array());
								$jadwal_jaga = $genetik->GetIndividu($j);



								for($k = 0; $k < count($jadwal_jaga);$k++){

									$kode_pengampu = intval($jadwal_jaga[$k][0]);
									$kode_hari = intval($jadwal_jaga[$k][1]);
									$kode_dev = intval($jadwal_jaga[$k][2]);
									$kode_status_dev = intval($jadwal_jaga[$k][3]);
									$this->db->query("INSERT INTO events (title,status,events.start, color) ".
													 "VALUES($kode_pengampu,$kode_status_dev,$kode_hari, '#FFFFFF')");
								}

								//var_dump($jadwal_jaga);
								//exit();

								$found = true;
							}

							if($found){break;}
						}

						if($found){break;}
					}

					if(!$found){
						$data['msg'] = 'Tidak Ditemukan Solusi Optimal';
					}

				}
			}else{
				$data['msg'] = validation_errors();
			}

		$data['rs_jadwal'] = $this->generate->get();
	$this->template->load('static','penjadwalan',$data);
	}

}
