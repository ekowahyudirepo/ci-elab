<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once 'Inc.php';

class Dashboard extends Inc {

	public function index()
	{
		$data['title'] = 'E-Lab';

		$data['inc']  = $this->load->view('teacher/dashboard/home', $data, TRUE);

		$this->load->view('teacher/inc', $data , FALSE);
	}

}

/* End of file Dashboard.php */
/* Location: ./application/modules/member/controllers/Dashboard.php */