<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_karyawan extends CI_Model {

	public function insert($data){
		$this->db->select('id');
		$this->db->from('t_anggota');
		$this->db->where(array('Email'=>$data['Email']));
		$query = $this->db->get();
        $check = $query->num_rows();

        if($check > 0){
		   $result = $query->row_array();
		   $this->db->update('t_anggota',$data,array('id'=>$result['id']));
        }else{
           $this->db->insert('t_anggota', $data);
        }
		return true;
	}


	public function update($data,$id){
		$this->db->where('id', $id);
		$this->db->update('t_anggota', $data);
	}

	public function edit(){
		$this->db->query("UPDATE t_anggota a JOIN users b ON a.Nama = b.first_name SET b.email = a.Email");
	}

	public function hapus($data,$Email){

		$this->db->query("select * from t_anggota inner join users on t_anggota.Email = users.email where id = ".intval($id));

	}

	public function select(){
		$data = $this->db->get('t_anggota')->result_array();
		$r = 0;
		foreach ($data as $value) {
			$data_conv[$r][0] = $value['id'];
			$data_conv[$r][1] = $value['Kode'];
			$data_conv[$r][2] = $value['Nama'];
			$data_conv[$r][3] = $value['Email'];
			if($value['Peran'] == 1){
				$peran = "Administrator";}
				else if ($value['Peran'] == 3) {$peran = "Support";}
				else { $peran = "Developer";}
			$data_conv[$r][4] = $peran;
			if($value['Status'] == 1){
				$status = "Primary";}
				else if ($value['Status'] == 2) {$status = "Secondary";}
				else { $status = "-";}
			$data_conv[$r][5] = $status;
			$data_conv[$r][6] = $value['created_at'];
			$data_conv[$r][7] = $value['updated_at'];
			$r++;
		}
		return $data_conv;
	}

	public function select_where_id($id){
		return $this->db->get_where('t_anggota', array('id' => $id))->result();
	}

	public function simpan($post){
		$sql = "INSERT INTO users (first_name,Email,status) VALUES (?,?,1)";
		$this->db->query($sql, array($_POST['Nama'],$_POST['Email']));

		if($sql){return true;}
		else{return false;}

	}

	public function delete($id){
		$this->db->query("delete t_anggota, users from t_anggota inner join users on t_anggota.Email = users.email where t_anggota.id =".intval($id));
	}

	public function get_default($id){
		$sql = $this->db->query("SELECT * FROM t_anggota WHERE id = ".intval($id));
		if($sql->num_rows() > 0)
			return $sql->row_array();
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
?>
