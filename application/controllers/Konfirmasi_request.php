<?php
Class Konfirmasi_request extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('date');
		$this->load->library('session');
		$this->load->model("M_konfirmasi_request");
		if(!$this->session->userdata('status')){
				$this->session->set_userdata('konfirmasi_request', TRUE);
				redirect('/User_authentication/');
			}
	}

	public function index(){
		$data['list_konfirmasi'] = $this->M_konfirmasi_request->load_karyawan();
		$this->load->model("User");
			$user_mail = $this->session->userdata('userData');
			$cekperan = $this->User->checkPeran($user_mail);
			$peran = null;
			foreach ($cekperan as $post) {
				$peran = $post['Peran'];
				// $this->session->set_userdata('peran', 1);
			}
			if($peran == 3){
				$data['list_konfirmasi'] = $this->M_konfirmasi_request->load_karyawan();
				$this->load->view("v_konfirmasi_request",$data);
			}
			else{
				 echo '<script>alert("Maaf anda tidak memiliki akses kesini")</script>';
				 $this->session->unset_userdata('konfirmasi_request');
				 $this->session->unset_userdata('status');
				 $this->session->unset_userdata('loggedIn');
				 redirect('/User_authentication/');
			}
	}

	public function tolak($id){
		$this->M_konfirmasi_request->ditolak($id);
		$penerima = $this->M_konfirmasi_request->get_default($id);
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
			 <h3 style='color:#ffffff;'>Permintaan izin anda di tolak, silahkan hubungi suport untuk keterangan lebih lanjut.<br></h3>
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

	public function terima($id){
		$this->M_konfirmasi_request->diterima($id);
		$penerima = $this->M_konfirmasi_request->get_default($id);
		$to = $penerima['email'];
		$subject = "Permintaan izin diterima";
		$pesan = "<html>
		<table align='center' border='1' cellpadding='0' cellspacing='0' width='600'>
		 <tr>
		 <td align='center' bgcolor='#222'>
						 <h2 style='color :#f39c12;'>REKA SINERGI PRATAMA</h2>
		 </td>
		 </tr>
		 <tr>
		 <td align='center' bgcolor='#444' style='padding: 5px 0px 5px 0px;'>
			 <h3 style='color:#ffffff;'>Permintaan izin anda diterima.<br></h3>
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
