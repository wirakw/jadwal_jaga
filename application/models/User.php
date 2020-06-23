<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User extends CI_Model{
    function __construct() {
        $this->tableName = 'users';
        $this->primaryKey = 'id';
    }
    public function checkUser($data = array()){
        $this->db->select($this->primaryKey);
        $this->db->from($this->tableName);
        $this->db->where(array('email'=>$data['email']));
        $query = $this->db->get();
        $check = $query->num_rows();

        if($check > 0){
            $result = $query->row_array();
            $data['modified'] = date("Y-m-d H:i:s");
            $update = $this->db->update($this->tableName,$data,array('id'=>$result['id']));
            $userID = $result['id'];
        }else{
            $data['created'] = date("Y-m-d H:i:s");
            $data['modified'] = date("Y-m-d H:i:s");
            $insert = $this->db->insert($this->tableName,$data);
            $userID = $this->db->insert_id();
        }

        return $userID?$userID:false;
    }

    public function checkUserStatus($data = array()){
        $this->db->select('status');
        $this->db->from($this->tableName);
        $this->db->where(array('email'=>$data['email']));
        $query = $this->db->get();

        $check = $query->num_rows();
		    return $query->result_array();
    }


	
    public function checkPeran($data = array())
    {
      $user_mail = $data['email'];
      $query = $this->db->query("SELECT t_anggota.Peran FROM t_anggota RIGHT OUTER JOIN users ON t_anggota.Email = users.email where users.email = '$user_mail'");
      return $query->result_array();
    }

	 public function checkEmail()
    {
      $this->db->query("UPDATE t_anggota a JOIN users b ON a.Email = b.email SET b.first_name = a.Nama");
    }
	
	public function checkPendaftaran()
    {
      $query = $this->db->query("SELECT pendaftaran FROM pengaturan");
      return $query->result_array();
    }

	public function checkStatus()
    {
       $this->db->select($this->primaryKey);
        $this->db->from($this->tableName);
        $this->db->where(array('email'=>$data['email']));
        $query = $this->db->get();
        $check = $query->num_rows();

        if($check > 0){
            $result = $query->row_array();
            $data['modified'] = date("Y-m-d H:i:s");
            $update = $this->db->update($this->tableName,$data,array('id'=>$result['id']));
            $cekstatus = $result['id'];
        }else{
            
        }

        return $cekstatus?$cekstatus:false;
    }

}
