<?php
//Model_data.php
defined('BASEPATH') OR exit('No direct script access allowed');

Class M_konfirmasi_request extends CI_Model{

	public function load_karyawan(){
		$sql = $this->db->query("SELECT * FROM t_izin WHERE status = '0'");
		return $sql->result_array();
	}

	public function simpan($post){

		//pastikan nama index post yang dipanggil sama seperti di form input
		$first_name = $this->db->escape($post['first_name']);
		$email = $this->db->escape($post['email']);
		$Kode = $this->db->escape($post['Kode']);
		$alasan = $this->db->escape($post['alasan']);
		$keterangan = $this->db->escape($post['keterangan']);

		$sql = "INSERT INTO t_izin (Kode,Nama,Ket,Alasan) VALUES (?,?,?,?)";
		$this->db->query($sql, array($_POST['Kode'],$_POST['first_name'],$_POST['keterangan'],$_POST['alasan']));

		if($sql)
			return true;
		return false;
	}

	public function get_default($id){
		$sql = $this->db->query("SELECT * FROM t_izin WHERE id = ".intval($id));
		if($sql->num_rows() > 0)
			return $sql->row_array();
		return false;
	}

	public function diterima($id){
		$sql = $this->db->query("UPDATE t_izin SET status = '1' WHERE id = ".intval($id));
	}

	public function ditolak($id){
		$sql = $this->db->query("UPDATE t_izin SET status = '2' WHERE id = ".intval($id));
	}
}
