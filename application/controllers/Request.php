<?php
Class Request extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('date');
		$this->load->model("M_request");
		
	}

	public function index(){
		$id = $this->uri->segment(2);
		$data['list_konfirmasi']=$this->M_request->load_request($id);
		$this->load->view("v_request",$data);
	}

	function izin()
	{
		$id=$this->uri->segment(3);
		$data['list_konfirmasi']=$this->M_request->get_detail_data($id);
		$this->load->view("v_request",$data);
	}

	public function edit($id){
		$data['default'] = $this->M_request->get_default($id);
		if(isset($_POST['tombol_submit'])){
			$this->session->set_flashdata('message', 'Permintaan Terkirim');
			$this->M_request->simpan($_POST, $id);
			$subject = "Pengajuan Izin";
			$pesan = "<html>
			<table align='center' border='1' cellpadding='0' cellspacing='0' width='600'>
			 <tr>
			 <td align='center' bgcolor='#222'>
							 <h2 style='color :#f39c12;'>Permintaan Izin Jaga</h2>
			 </td>
			 </tr>
			 <tr>
			 <td align='center' bgcolor='#444' style='padding: 5px 0px 5px 0px;'>
				 <h3 style='color:yellow;'>Selamat</h3>
				 <h5 style='color:#ffffff;'>Ada yang mengajukan izin<br>
				 silahkan klik link berikut, untuk menerima atau menolak Permintaan izin </h5>
				 <a href='".base_url()."Konfirmasi_request'><button class='btn bg-primary text-white'>Konfimasi Request Izin</button></a>
			 </td>
			 </tr>
			</table>
			</html>";
			$this->session->set_userdata('pesan_email', $pesan);
			$this->session->set_userdata('subject_email', $subject);
						// $this->send_mail();
			redirect(base_url().'mail');
			//redirect(base_url().'Request');
		}
		$this->load->view("v_form_request",$data);
		}


}
