<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendaftar extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('date');
		$this->load->model('M_pendaftar','Pendaftar');
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
				
				$this->template->load('static','v_pendaftar',$data);
			}
			else{
				$this->template->load('static','v_pendaftar',$data);
			}
	}

	public function select_izin()
	{
		header('Content-Type: application/json');
		echo json_encode($this->Pendaftar->select());
	}

	public function action_pendaftar()
	{
		$modified = date('Y-m-d H:i:s');
		$created = date('Y-m-d H:i:s');
		$action = $this->input->post('action');
		$id = $this->input->post('id');
		$first_name = $this->input->post('first_name');
		$email = $this->input->post('email');
		$status = $this->input->post('status');
		switch ($action) {
		case 'update':
				$data = array(
					"first_name" => $first_name,
					"email" => $email,
					"status" => $status,
					"modified" => $modified
					);
				$this->Pendaftar->update($data,$id);
			break;
		case 'delete':
				$this->Pendaftar->delete($id);
			break;
		case 'add':
				$data = array(
					"first_name" => $first_name,
					"email" => $email,
					"status" => $status,
					"created" => $created,
					"modified" => $modified
					);
				$this->Pendaftar->insert($data);
			break;
		}
		header('Content-Type: application/json');
		echo json_encode($this->Pendaftar->select());
	}

	public function form_update(){
		$id = $this->input->post('id');
		header('Content-Type: application/json');
		echo json_encode($this->Pendaftar->select_where_id($id));
	}
}
