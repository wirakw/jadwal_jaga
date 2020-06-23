<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Izin extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('date');
		$this->load->model('M_izin','izin');
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
				
				$this->template->load('static','v_izin',$data);
			}
			else{
				$this->template->load('static','v_izin',$data);
			}
	}

	public function select_izin()
	{
		header('Content-Type: application/json');

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

			echo json_encode($this->izin->select());
			} 
				else{
			echo json_encode($this->izin->select_personal());
			}

	}

	public function action_izin()
	{
		$updated_at = date('Y-m-d H:i:s');
		$created_at = date('Y-m-d H:i:s');
		$action = $this->input->post('action');
		$id = $this->input->post('id');
		$Nama = $this->input->post('Nama');
		$Ket = $this->input->post('Ket');
		$Alasan = $this->input->post('Alasan');
		$Kode = $this->input->post('Kode');
		$status = $this->input->post('status');
		switch ($action) {
		case 'update':
				$data = array(
					"Nama" => $Nama,
					"Ket" => $Ket,
					"Alasan" => $Alasan,
					"Kode" => $Kode,
					"status" => $status,
					"updated_at" => $updated_at
					);
				$this->izin->update($data,$id);
			break;
		case 'delete':
				$this->izin->delete($id);
			break;
		case 'add':
				$data = array(
					"Nama" => $Nama,
					"Ket" => $Ket,
					"Alasan" => $Alasan,
					"Kode" => $Kode,
					"status" => $status,
					"created_at" => $created_at,
					"updated_at" => $updated_at
					);
				$this->izin->insert($data);
			break;
		}
		header('Content-Type: application/json');

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
			echo json_encode($this->izin->select());
			} 
				else{
			echo json_encode($this->izin->select_personal());
			}

	}

	public function update(){
		$id = $this->input->post('id');
		header('Content-Type: application/json');
		echo json_encode($this->izin->select_where_id($id));
	}
}
