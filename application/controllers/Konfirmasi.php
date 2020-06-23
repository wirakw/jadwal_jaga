<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Konfirmasi extends CI_Controller{

	function __construct()
	{
			// Call the Model constructor
			parent::__construct();
			$this->load->helper('url');
			$this->load->library('session');
			$this->load->model("M_konfirmasi");
			if(!$this->session->userdata('status')){
				$this->session->set_userdata('konfirmasi', TRUE);
				redirect('/User_authentication/');
			}
	}

	public function index(){
		$this->load->model("User");
			$user_mail = $this->session->userdata('userData');
			$cekperan = $this->User->checkPeran($user_mail);
			$peran = null;
			foreach ($cekperan as $post) {
				$peran = $post['Peran'];
				// $this->session->set_userdata('peran', 1);
			}
			if($peran == 3 ||  $peran == 1){
				$data['list_konfirmasi'] = $this->M_konfirmasi->load_karyawan();
				$this->load->view("v_konfirmasi",$data);
			}
			else{
				 echo '<script>alert("Maaf anda tidak memiliki akses kesini")</script>';
				 $this->session->unset_userdata('konfirmasi');
				 $this->session->unset_userdata('status');
				 $this->session->unset_userdata('loggedIn');
				 redirect('/User_authentication/');
			}
	}

	public function edit($id){
		$data['default'] = $this->M_konfirmasi->get_default($id);
		$penerima = $this->M_konfirmasi->get_default($id);
		$to = $penerima['email'];
		$this->session->set_userdata('to', $to);
		$this->M_konfirmasi->diterima($id);
		$this->session->set_flashdata('message', 'Konfirmasi Berhasil');
		if(isset($_POST['tombol_submit'])){
			$this->M_konfirmasi->simpan($_POST, $id);
			$subject = "Selamat Pendaftaran Anda di terima";
			$pesan = "<html>
			<table align='center' border='1' cellpadding='0' cellspacing='0' width='600'>
			 <tr>
			 <td align='center' bgcolor='#222'>
							 <h2 style='color :#f39c12;'>REKA SINERGI PRATAMA</h2>
			 </td>
			 </tr>
			 <tr>
			 <td align='center' bgcolor='#444' style='padding: 5px 0px 5px 0px;'>
				 <h3 style='color:yellow;'>Selamat</h3>
				 <h5 style='color:#ffffff;'>Permintaan pendaftaran anda di terima.<br>
				 silahkan klik link berikut, untuk membuka web jadwal jaga</h5>
				 <a href='".base_url()."'><button class='btn bg-primary text-white'>JADWAL JAGA</button></a>
			 </td>
			 </tr>
			</table>
			</html>";
			$this->session->set_userdata('pesan_email', $pesan);
			$this->session->set_userdata('subject_email', $subject);
						// $this->send_mail();
			redirect(base_url().'mail');
		}
		$this->load->view("v_form_konfirmasi",$data);
		
		
		

	}
	
	public function get_angka()
	{
		$varkode = $this->input->get('varkode');
		
		switch($varkode)
		{
			case 1: $varkode = 'ADM'; break;
			case 2: $varkode = 'DEV'; break;
			case 3: $varkode = 'SPT'; break;
		}
		
		$angka['angka'] = $this->M_konfirmasi->code_angka($varkode);
		echo json_encode($angka);
	}

	public function tolak($id){
		$this->M_konfirmasi->ditolak($id);
		$penerima = $this->M_konfirmasi->get_default($id);
		$to = $penerima['email'];
		$subject = "Maaf Permintaan Akses Anda di Tolak";
		$pesan = "<html>
		<table align='center' border='1' cellpadding='0' cellspacing='0' width='600'>
		 <tr>
		 <td align='center' bgcolor='#222'>
						 <h2 style='color :#f39c12;'>REKA SINERGI PRATAMA</h2>
		 </td>
		 </tr>
		 <tr>
		 <td align='center' bgcolor='#444' style='padding: 5px 0px 5px 0px;'>
			 <h3 style='color:#ffffff;'>Permintaan akses anda di tolak.<br></h3>
		 </td>
		 </tr>
		</table>
		</html>";
		$this->session->set_userdata('to', $to);
		$this->session->set_userdata('pesan_email', $pesan);
		$this->session->set_userdata('subject_email', $subject);
		$this->session->set_flashdata('message', 'Konfirmasi Berhasil');
		redirect(base_url().'mail');
	}
}
