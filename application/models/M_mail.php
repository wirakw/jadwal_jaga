<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_mail extends CI_Model {

	public function insert($data){
		$this->db->insert('log_mail', $data);
	}

	// public function update($data,$id){
	// 	$this->db->where('id', $id);
	// 	$this->db->update('log_mail', $data);
	// }

	// public function delete($id){
	// 	$this->db->where('id', $id);
	// 	$this->db->delete('log_mail');
	// }

	public function select(){
		$data = $this->db->get('log_mail')->result_array();
		$r = 0;
		foreach ($data as $value) {
			$data_conv[$r][0] = $value['id'];
			$data_conv[$r][1] = $value['waktu_kirim'];
			$data_conv[$r][2] = $value['penerima'];
			$r++;
		}
		return $data_conv;
	}

	public function select_where_id($id){
		return $this->db->get_where('log_mail', array('id' => $id))->result();
	}

	public function cekEmail()
	{
		$query = $this->db->query("SELECT waktu_kirim FROM log_mail ORDER BY id DESC LIMIT 1");
		return $query->result_array();
	}


		public function get_kirim()
		{
			$query = $this->db->query("SELECT pengirim FROM pengaturan");
			return $query->result_array();
		}

	public function getEmail_jaga()
	{
		$query = $this->db->query("SELECT events.id, t_anggota.Nama, t_anggota.Email, events.status FROM events RIGHT OUTER JOIN t_anggota ON events.title = t_anggota.Nama  where events.start = CURDATE() + INTERVAL 1 DAY ORDER BY events.status asc ");
		return $query->result_array();
	}

	public function getEmail_Suport()
	{
		$query = $this->db->query("SELECT Email FROM t_anggota where Peran = '3'");
		return $query->result_array();
	}

}
?>
