<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once 'Inc.php';

class Competition extends Inc {

	public function index()
	{
		$data['title'] = 'E-Lab';

		$data['inc']  = $this->load->view('teacher/competition/home', $data, TRUE);

		$this->load->view('teacher/inc', $data , FALSE);
	}

}

/* End of file Competition.php */
/* Location: ./application/modules/member/controllers/Competition.php */