<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require 'vendor/autoload.php'; // If you're using Composer (recommended)
class Notif extends CI_Controller {

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
 	}


	public function send_mail()
	{
	$data = $this->M_mail->getEmail_jaga();
	$list_mail = array();
	$list_id = array();
	$list_nama = array();
	$list_status = array();
	$pengirim = $this->M_mail->get_kirim();
	$kirim = null;
	foreach ($pengirim as $post) {
      	$kirim = $post['pengirim'];
      	}
	$from = new \SendGrid\Mail\From($kirim, "Jadwal Jaga");
	$no=0;
	foreach ($data as $row) {
		$list_mail[$no] = $row['Email'];
		$list_id[$no] = $row['id'];
		$list_nama[$no] = $row['Nama'];
		$list_status[$no] = $row['status'];
		$tos[$no] = new \SendGrid\Mail\To(
				$list_mail[$no], "user".	$list_id[$no],
				array(
						'-name-' => $list_nama[$no],
						'-github-' => base_url().'request/izin/'.$list_id[$no]
						),
				"Jadwal Jaga ".$list_status[$no]."  -name-"
				);
		$no++;
		}

	$subject = new \SendGrid\Mail\Subject("Hi -name-"); // default subject
	$reqest_izin = "<html>
	<body>
	<table align='center' border='1' cellpadding='0' cellspacing='0' width='600'>
	 <tr>
	 <td align='center' bgcolor='#222'>
					 <h2 style='color :#f39c12;'>REKA SINERGI PRATAMA</h2>
	 </td>
	 </tr>
	 <tr>
	 <td align='center' bgcolor='#444' style='padding: 5px 0px 5px 0px;'>
		 <h3 style='color:yellow;'>INFORMASI</h3>
		 <h5 style='color:#ffffff;'>di ingatkan kembali besok adalah jadwal jaga anda.<br>
		 silahkan klik link berikut, untuk request izin jadwal jaga besok</h5>
		 <a href=\"-github-\"><button class='btn bg-primary text-white'> Request Izin Jadwal Jaga</button></a>
	 </td>
	 </tr>
	</table>
	</body>
	</html>";
	$htmlContent = new \SendGrid\Mail\HtmlContent($reqest_izin);
	$email = new \SendGrid\Mail\Mail(
	    $from,
	    $tos,
	    $subject, // or array of subjects, these take precendence
	    $htmlContent
	);

	$sendgrid = new \SendGrid('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');
	try {
	    $response = $sendgrid->send($email);
	    print $response->statusCode() . "\n";
	    print_r($response->headers());
	    print $response->body() . "\n";
			// $this->addMail($tos);
			$this->slack();
	} catch (Exception $e) {
	    echo 'Caught exception: '.  $e->getMessage(). "\n";
	}


}

Public function addMail($penerima = array())
{
	$no=0;
	while ($no <= 1) {
		$waktu_kirim = date('Y-m-d H:i:s');
		// $email_penerima = $list[$no];
				$data = array(
					"waktu_kirim" => $waktu_kirim,
					"email_penerima" =>  $penerima[$no],
					);
				$this->M_mail->insert($data);
				$no++;
	}
}

// public function index()
// {
// 	$now = date('Y-m-d H:i:s');
// 	$data['mail'] = $this->email->cekEmail();
// 	$this->load->view('v_mail',$data);
// 	if($selisih <= 2){
// 	$this->send_mail();
// 	}
// }

public function index(){
	$this->load->model('M_mail');
 	$data = $this->mail->cekEmail();
	foreach ($data as $row) {
		$get_time = $row['waktu_kirim'];
		$last_Send = new DateTime($get_time);
		$now = new DateTime();
		$selisih =  $last_Send->diff($now)->format("%i");
		// $selisih_hari =  $last_Send->diff($now)->format("%d");


		if (($selisih >= 2)){
			 	$this->send_mail();
		}
		else{
				echo "selisih :".$selisih;
			}
	}
}

public function slack(){
	// Load the slack library:
		$this->load->library('Slack');
		$data = $this->M_mail->getEmail_jaga();
		foreach ($data as $post) {

    // Setup the configuration for the slack notification.
    $this->slack->username = 'jadwal_jaga';
    $this->slack->channel  = ['random'];

    // Send the notification
    if ($this->slack->send('Jadwal Jaga Besok yaitu :'.$post['Nama'] )) {
        print_r($this->slack->output); // Print the response from Slack if you want.
    } else {
        print_r($this->slack->error); // This will output the error.
    }
	}
}

// public function getEmail(){
// 	$this->load->model('M_mail');
//
// 		return $list;
// }
}
