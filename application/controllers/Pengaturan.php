<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengaturan extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('date');
		$this->load->model('M_pengaturan','Pengaturan');
	}

	public function index()
	{
		$data['userData'] = $this->session->userdata('userData');
		$this->load->model("User");
			$user_mail = $this->session->userdata('userData');
			$cekperan = $this->User->checkPeran($user_mail);
			$peran = null;
			foreach ($cekperan as $post) {
				$peran = $post['Peran'];
				// $this->session->set_userdata('peran', 1);
			}
			if($peran == 1 || $peran == 3){
				$this->load->model("M_pengaturan");
				$data['list_karyawan'] = $this->M_pengaturan->load_karyawan();
				$this->template->load('static','v_pengaturan',$data);
			}
			else{$this->load->model("M_pengaturan");
				$data['list_karyawan'] = $this->M_pengaturan->load_karyawan();
				$this->template->load('static','v_pengaturan',$data);
			}
	}
	
	public function insert(){
			if($_POST){
				$pendaftaran = $this->input->post('pendaftaran');
				$pengirim = $this->input->post('pengirim');
				$this->load->model("M_pengaturan");
				$this->M_pengaturan->insertwarna(array(
					'pendaftaran' 		=> $pendaftaran,
					'pengirim'			=> $pengirim
				));
				redirect('Pengaturan');
			}
			$this->template->load('static','Pengaturan');
		}
	
	public function add(){
		$this->load->model("M_pengaturan");
		$this->M_pengaturan->simpan();
		redirect("pengaturan");
	}
}
