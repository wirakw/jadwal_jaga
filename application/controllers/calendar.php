<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Calendar extends CI_Controller {

		function __construct()
    {
        // Call the Model constructor
        parent::__construct();
				$this->load->helper('url');
        $this->load->model('M_calendar');
				if(!$this->session->userdata('status')){
						redirect('/User_authentication/');
				}
    }

	public function index()
	{
		$data['userData'] = $this->session->userdata('userData');


		$this->load->model("User");
			$user_mail = $this->session->userdata('userData');
			$cekperan = $this->User->checkPeran($user_mail);
			$peran = null;
			foreach ($cekperan as $post) {
				$peran = $post['Peran'];
				// $this->session->set_userdata('peran', 1);
			}
			if($peran == 1 || $peran == 3){
				$data['Calendar'] = $this->M_calendar->primary_data();
				$data['Karyawan'] = $this->M_calendar->secondary_data();
				$this->template->load('static','v_calendar',$data);
			}
			else{
				$data['Calendar'] = $this->M_calendar->primary_data();
				$data['Karyawan'] = $this->M_calendar->secondary_data();
				$this->template->load('static','v_calendar',$data);
			}
	}

	/*Home page Calendar view  */

	/*Get all Events */

	Public function getEvents()
	{
		$result=$this->M_calendar->getEvents();
		echo json_encode($result);
	}
	/*Add new event */
	Public function addEvent()
	{
		$result=$this->M_calendar->addEvent();
		echo $result;
	}
	/*Update Event */
	Public function updateEvent()
	{
		$result=$this->M_calendar->updateEvent();
		echo $result;
	}
	/*Delete Event*/
	Public function deleteEvent()
	{
		$result=$this->M_calendar->deleteEvent();
		echo $result;
	}
	Public function dragUpdateEvent()
	{

		$result=$this->M_calendar->dragUpdateEvent();
		echo $result;
	}

	Public function addLibur()
	{
		$result=$this->M_calendar->addLibur();
		echo $result;
	}



}
