<?php
//Model_data.php
defined('BASEPATH') OR exit('No direct script access allowed');

Class M_konfirmasi extends CI_Model{

	public function load_karyawan(){
		$sql = $this->db->query("SELECT * FROM users WHERE status = 0");
		return $sql->result_array();
	}


	public function simpan($post){

		//pastikan nama index post yang dipanggil sama seperti di form input
		$first_name = $this->db->escape($post['first_name']);
		$email = $this->db->escape($post['email']);
		$Kode = $this->db->escape($post['Kode']);
		$Status = $this->db->escape($post['Status']);
		$Peran = $this->db->escape($post['Peran']);

		$sql = "INSERT INTO t_anggota (Kode,Nama,Status,Peran,Email) VALUES (?,?,?,?,?)";
		$this->db->query($sql, array($_POST['Kode'],$_POST['first_name'],$_POST['Status'],$_POST['Peran'], $_POST['email']));

		if($sql){return true;}
		else{return false;}

	}

	public function get_default($id){
		$sql = $this->db->query("SELECT * FROM users WHERE id = ".intval($id));
		if($sql->num_rows() > 0)
			return $sql->row_array();
		}

	public function diterima($id){
		$sql = $this->db->query("UPDATE users SET status = 1 WHERE id = ".intval($id));
	}

	public function ditolak($id){
		$sql = $this->db->query("UPDATE users SET status = 2 WHERE id = ".intval($id));
	}

	public function code_angka($varkode = null)
	{
            $this->db->select('Right(t_anggota.Kode,1) as Kode ',true);
			if(isset($varkode)) $this->db->like('Kode', $varkode);
            $this->db->order_by('Kode', 'desc');
            $query = $this->db->get('t_anggota');
            $this->db->limit(1);
            if($query->num_rows()>0){
                $data = $query->row();
                $Kode = intval($data->Kode)+1;
            }else{
                $Kode = 1;

            }
            $kodemax = str_pad($Kode,1,"0",STR_PAD_LEFT);
            return $kodemax;
    }
}
