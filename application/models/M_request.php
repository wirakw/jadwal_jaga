<?php
//Model_data.php
defined('BASEPATH') OR exit('No direct script access allowed');

Class M_request extends CI_Model{

	public function load_request($id){
		$sql = $this->db->query("select * from events where id = '$id' ");
		return $sql->result_array();
	}

	public function simpan($post){

		//pastikan nama index post yang dipanggil sama seperti di form input
		$Nama = $this->db->escape($post['Nama']);
		$alasan = $this->db->escape($post['alasan']);
		$keterangan = $this->db->escape($post['keterangan']);

		$sql = "INSERT INTO t_izin (Nama,Ket,Alasan) VALUES (?,?,?)";
		$this->db->query($sql, array($_POST['Nama'],$_POST['keterangan'],$_POST['alasan']));

		if($sql)
			return true;
		return false;
	}

	public function get_default($id){
		$sql = $this->db->query("SELECT * FROM events WHERE id = ".intval($id));
		if($sql->num_rows() > 0)
			return $sql->row_array();
		return false;
	}

	function get_detail_data($id)
	{
		$query=$this->db->query("SELECT events.id, t_anggota.Nama, t_anggota.Email, events.status FROM t_anggota RIGHT OUTER JOIN events ON t_anggota.Nama = events.title where events.id ='$id' AND events.start = CURDATE() + INTERVAL 1 DAY");
		return $query->result_array();
	}
}
