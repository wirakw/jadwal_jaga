<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require 'vendor/autoload.php'; // If you're using Composer (recommended)
class Mail extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	 function __construct(){
 		parent::__construct();
 		$this->load->helper('url');
 		$this->load->helper('date');
 		$this->load->model('M_mail','mail');
		$this->load->library('template');
 	}

	public function send_mail()
{

	$penerima = $this->getEmail();
	// $tos = array("wirakampit@gmail.com" => "Example User2", "wira.kusuma.tif16@polban.ac.id" => "Example User3" );
	foreach ($penerima as $value) {
		$tos[$value] = $value;
	}

	$email = new \SendGrid\Mail\Mail();
	$email->setFrom("wirakampit@gmail.com", "APLIKASI JADWAL JAGA");
	$subject = $this->session->userdata('subject_email');
	$email->setSubject($subject);
	$email->addTos($tos);
	$link = base_url().'konfirmasi';
	$isi_email = $this->session->userdata('pesan_email');
	// $email->addContent("text/plain", "and easy to do anywhere, even with PH");
	$email->addContent("text/html", $isi_email);
	$sendgrid = new \SendGrid('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');
	try {
	    $response = $sendgrid->send($email);
//			echo "email terkirim ke ".$penerima[0]." dan ".$penerima[1];
			if($response){
			$this->session->unset_userdata('pesan_email');
			$this->session->unset_userdata('subject_email');
				$data['userData'] = $this->session->userdata('userData');
				$this->load->view('/user_authentication/profile',$data);
   		$this->addMail();
		}
	} catch (Exception $e) {
	    echo 'Caught exception: '. $e->getMessage() ."\n";
	}

}

Public function addMail()
{
	$penerima = $this->getEmail();
	$no=0;
	$list = array();
	foreach ($penerima as $row) {
	$list[$no] = $row;
		$waktu_kirim = date('Y-m-d H:i:s');
		// $email_penerima = $list[$no];
				$data = array(
					"waktu_kirim" => $waktu_kirim,
					"email_penerima" =>  $list[$no],
					);
				$this->mail->insert($data);
				$no++;
	}
			$this->session->unset_userdata('konfirmasi');
			$this->session->unset_userdata('pesan_email');
			$this->session->unset_userdata('subject_email');
}


public function index(){
		$this->send_mail();
}

public function slack(){
	// Load the slack library:
		$this->load->library('Slack');

    // Setup the configuration for the slack notification.
    $this->slack->username = 'jadwal_jaga';
    $this->slack->channel  = ['random'];

    // Send the notification
    if ($this->slack->send('ada yang daftar nih ')) {
        print_r($this->slack->output); // Print the response from Slack if you want.
    } else {
        print_r($this->slack->error); // This will output the error.
    }
}

public function getEmail(){
	$this->load->model('M_mail');
	$data = $this->mail->getEmail_Suport();
	$no=0;
	$list = array();
	foreach ($data as $row) {
		$list[$no] = $row['Email'];
		$no++;
		}
		return $list;
}
}
