<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_izin extends CI_Model {

	public function insert($data){
		$this->db->insert('t_izin', $data);
	}

	public function update($data,$id){
		$this->db->where('id', $id);
		$this->db->update('t_izin', $data);
	}

	public function delete($id){
		$this->db->where('id', $id);
		$this->db->delete('t_izin');
	}

	public function select(){
		$data = $this->db->get('t_izin')->result_array();
		$r = 0;
		foreach ($data as $value) {
			$data_conv[$r][0] = $value['id'];
			$data_conv[$r][1] = $value['Nama'];
			$data_conv[$r][2] = $value['created_at'];	
			if($value['Ket'] == 1){
				$Keterangan = "Izin";}
				else if ($value['Ket'] == 2) {$Keterangan = "Sakit";}
				else { $Keterangan = "Tugas_Kantor";}
			$data_conv[$r][3] = $Keterangan;
			$data_conv[$r][4] = $value['Alasan'];
			if($value['status'] == 1){
				$status = "Diterima";}
				else if ($value['status'] == 2) {$status = "Ditolak";}
				else { $status = "menunggu konfirmasi";}
			$data_conv[$r][5] = $status;
			$data_conv[$r][6] = $value['updated_at'];
			$r++;
		}
		
		return $data_conv;
	}
	
	public function select_personal(){
		$data = $this->db->query("select * from t_izin inner join users on t_izin.Nama = users.first_name where t_izin.Nama = users.first_name")->result_array();
		$r = 0;
		foreach ($data as $value) {
			$data_conv[$r][0] = $value['id'];
			$data_conv[$r][1] = $value['Nama'];
			$data_conv[$r][2] = $value['created_at'];	
			if($value['Ket'] == 1){
				$Keterangan = "Izin";}
				else if ($value['Ket'] == 2) {$Keterangan = "Sakit";}
				else { $Keterangan = "Tugas_Kantor";}
			$data_conv[$r][3] = $Keterangan;
			$data_conv[$r][4] = $value['Alasan'];
			if($value['status'] == 1){
				$status = "Diterima";}
				else if ($value['status'] == 2) {$status = "Ditolak";}
				else { $status = "menunggu konfirmasi";}
			$data_conv[$r][5] = $status;
			$data_conv[$r][6] = $value['updated_at'];
			$r++;
		}
		
		return $data_conv;
	}

	public function select_where_id($id){
		return $this->db->get_where('t_izin', array('id' => $id))->result();
	}
}
?>
