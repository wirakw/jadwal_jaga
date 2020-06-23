<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Generate extends CI_Model {


	public function getPengampu()
	{
		$query = $this->db->query("SELECT id, Status FROM t_anggota where peran = 2");
		return $query->result_array();
	}

	public function getPrimary()
	{
		$query = $this->db->query("SELECT id, Status FROM t_anggota where Status = 1");
		return $query->result_array();
	}

	public function getSecondary()
	{
		$query = $this->db->query("SELECT id, Status FROM t_anggota where peran = 2");
		return $query->result_array();
	}

	function get(){
		$rs = $this->db->query(	"SELECT * FROM events ORDER by start asc");
		return $rs;
	}

	function insert_event($data){
		$sql = "INSERT INTO events (title,status,description,color,start) VALUES (?,?,?,?,?)";
		$this->db->query($sql, array($data['nama'], $data['status_jaga'], $data['kode_pengampu'], $data['color'], $data['kode_hari']));
		return $sql;
	}

	function get_nama($id){
			$sql = $this->db->query("SELECT Nama, Status FROM t_anggota where id = ".$id);
			return $sql->row_array();
	}



}
?>
