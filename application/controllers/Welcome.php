<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		$this->load->view('welcome', $data='', FALSE);
	}

}

/* End of file Welcome.php */
/* Location: ./application/controllers/Welcome.php */