<?php defined('BASEPATH') OR exit('No direct script access allowed');
class User_authentication extends CI_Controller
{
    function __construct(){
        parent::__construct();

        //load google login library
        $this->load->library('Google');
		    $this->load->library('Template');

        //load user model
        $this->load->model('User');
    }

    public function index(){
        //redirect to profile page if user already logged in
        if($this->session->userdata('loggedIn') == true){
            redirect('User_authentication/profile/');
        }

        if(isset($_GET['code'])){
            //authenticate user
            $this->google->getAuthenticate();

            //get user info from google
            $gpInfo = $this->google->getUserInfo();

            //preparing data for database insertion
            $userData['oauth_provider'] = 'google';
            $userData['oauth_uid']      = $gpInfo['id'];
            $userData['first_name']     = $gpInfo['given_name'];
            $userData['last_name']      = $gpInfo['family_name'];
            $userData['email']          = $gpInfo['email'];
            $userData['gender']         = !empty($gpInfo['gender'])?$gpInfo['gender']:'';
            $userData['locale']         = !empty($gpInfo['locale'])?$gpInfo['locale']:'';
            $userData['profile_url']    = !empty($gpInfo['link'])?$gpInfo['link']:'';
            $userData['picture_url']    = !empty($gpInfo['picture'])?$gpInfo['picture']:'';


      	$this->load->model("User");
      	$user_mail = $this->session->userdata('userData');
      	$cekperan = $this->User->checkPendaftaran();
      	$peran = null;
      	foreach ($cekperan as $post) {
      	$peran = $post['pendaftaran'];
      		// $this->session->set_userdata('peran', 1);
      	}
      	$this->session->userdata('userData');
      	if($peran == 'Buka'){
			$userID = $this->User->checkUser($userData);

            //status session user saat akses
            $this->session->set_userdata('loggedIn', true);
            $this->session->set_userdata('userData', $userData);

            //jika sukses maka saya akan menuju ke frofile
            redirect('User_authentication/profile/');
			}
		else{

			$this->session->set_userdata('loggedIn', true);
            $this->session->set_userdata('userData', $userData);

			$data['userData'] = $this->session->userdata('userData');
        $cekID = $this->User->checkUserStatus($this->session->userdata('userData'));
        foreach ($cekID as $row) {
          $status = $row['status'];
          if ($status == 1){
            $this->session->set_userdata('status', $status);
            redirect(base_url().'Calendar');
          }
		}
            //jika sukses maka saya akan menuju ke frofile
            redirect('User_authentication/tutup/');

		}





            //memasuk atau merubah data ke dalam database

        }

        //google login url
        $data['loginURL'] = $this->google->loginURL();

        //menampilkan google login view
        $this->load->view('user_authentication/index',$data);
    }

    public function profile(){
        //redirect to login page if user not logged in
        if(!$this->session->userdata('loggedIn')){
            redirect('/User_authentication/');
        }
        else{
        //get user info from session
        $data['userData'] = $this->session->userdata('userData');
        $cekID = $this->User->checkUserStatus($this->session->userdata('userData'));
        foreach ($cekID as $row) {
          $status = $row['status'];
          if ($status == 1){
            if($this->session->userdata('konfirmasi') == true){
              $this->session->set_userdata('status', $status);
              redirect(base_url().'Konfirmasi');
            }
            else if($this->session->userdata('konfirmasi_request') == true){
              $this->session->set_userdata('status', $status);
              redirect(base_url().'konfirmasi_request');
            }
            else{
              $this->session->set_userdata('status', $status);
              redirect(base_url().'Calendar');
            }
			}
          else {
            $pesan = '<html>
          	 <head>
          	  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
          	  <title>Demystifying Email Design</title>
          	  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
          	</head>

          	<body style="margin: 0; padding: 0;">
          	<table align="center" border="1" cellpadding="0" cellspacing="0" width="600">
          	 <tr>
          	 <td align="center" bgcolor="#222">
          	         <h2 style="color :#f39c12;">REKA SINERGI PRATAMA</h2>
          	 </td>
          	 </tr>
          	 <tr>
          	 <td align="center" bgcolor="#444" style="padding: 5px 0px 5px 0px;">
          	   <h3 style="color:yellow;">INFORMASI</h3>
          	 	 <h5 style="color:#ffffff;">Ada akun yang menunggu konfirmasi dari suport.<br>
          	 	 silahkan klik link berikut, untuk konfirmasi akun pendaftar</h5>
          	   <a href="'.base_url().'konfirmasi"><button class="btn bg-primary text-white">Konfirmasi akun pendaftar</button></a>
          	 </td>
          	 </tr>
          	</table>
          	</body>
          	</html>';
            $subject = "ada yang daftar nih";
            $this->session->set_userdata('pesan_email', $pesan);
            $this->session->set_userdata('subject_email', $subject);
            redirect(base_url().'Mail');
            }
        }
      }


    }


    public function logout(){
        //delete login status & user info from session
        $this->session->unset_userdata('status');
        $this->session->unset_userdata('loggedIn');
        $this->session->unset_userdata('userData');
        $this->session->sess_destroy();

        redirect('/User_authentication/');
    }
	public function tutup(){
        //delete login status & user info from session
        $this->session->unset_userdata('status');
        $this->session->unset_userdata('loggedIn');
        $this->session->unset_userdata('userData');
        $this->session->sess_destroy();

		$this->load->view('user_authentication/tutup');
	}

}
