<?php
//Model_data.php
defined('BASEPATH') OR exit('No direct script access allowed');

Class M_pengaturan extends CI_Model{

	public function load_karyawan(){
		$sql = $this->db->query("SELECT * FROM pengaturan");
		return $sql->result_array();
	}

	public function simpan(){
			$sql = $this->db->query("UPDATE pengaturan SET pendaftaran = $pendaftaran, pengirim = $pengirim WHERE id = ".intval($id));
	}
	
	public function insertwarna($data){
			$this->db->update('pengaturan',$data);
		}

	public function get_default($id){
		$sql = $this->db->query("SELECT * FROM pengaturan WHERE id = ".intval($id));
		if($sql->num_rows() > 0)
			return $sql->row_array();
		return false;
	}

	public function update($post, $id){
		//parameter $id wajib digunakan agar program tahu ID mana yang ingin diubah datanya.
		$pendaftaram = $this->db->escape($post['pendaftaram']);
		$pengirim = $this->db->escape($post['pengirim']);


		$sql = $this->db->query("UPDATE pengaturan SET pendaftaram = $pendaftaram, pengirim = $pengirim WHERE id = ".intval($id));

		return true;
	}

	public function hapus($id){
		$sql = $this->db->query("DELETE from pengaturan WHERE id = ".intval($id));
	}	 
	
	
	function code_angka(){
            $this->db->select('Right(pengaturan.Kode,3) as Kode ',false);
            $this->db->order_by('id', 'desc');
            $this->db->limit(1);
            $query = $this->db->get('pengaturan');
            if($query->num_rows()<>0){
                $data = $query->row();
                $Kode = intval($data->Kode)+1;
            }else{
                $Kode = 1;

            }
            $kodemax = str_pad($Kode,3,"0",STR_PAD_LEFT);
            return $kodemax;
        }


}