<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Pendaftar extends CI_Model {

	public function insert($data){
		$this->db->insert('users', $data);
	}

	public function update($data,$id){
		$this->db->where('id', $id);
		$this->db->update('users', $data);
	}

	public function delete($id){
		$this->db->where('id', $id);
		$this->db->delete('users');
	}

	public function select(){
		
		$data = $this->db->get('users')->result_array();
		$r = 0;
		foreach ($data as $value) {
			$data_conv[$r][0] = $value['id'];
			$data_conv[$r][1] = $value['first_name'];
			$data_conv[$r][2] = $value['email'];
				if($value['status'] == 1){
				$status = "Diterima";}
				else if ($value['status'] == 2) {$status = "Ditolak";}
				else { $status = "menunggu konfirmasi";}
			$data_conv[$r][3] = $status;
			$data_conv[$r][4] = $value['created'];
			$data_conv[$r][5] = $value['modified'];
			$data_conv[$r][6] = $value['last_name'];
			$data_conv[$r][7] = $value['oauth_provider'];
			$data_conv[$r][8] = $value['oauth_uid'];
			$data_conv[$r][9] = $value['gender'];
			$data_conv[$r][10] = $value['locale'];
			$data_conv[$r][11] = $value['picture_url'];
			$data_conv[$r][12] = $value['profile_url'];
			$r++;
		}
		
		return $data_conv;
	}

	public function select_where_id($id){
		return $this->db->get_where('users', array('id' => $id))->result();
	}
}
?>
