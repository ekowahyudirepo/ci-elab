<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once 'Inc.php';

class Dashboard extends Inc {

	public function __construct()
	{
		parent::__construct();

		$this->has_login();
	}

	public function index()
	{
		$data['title'] = 'Dashboard | E-Lab';

		$data['jml_guru']        = $this->db->get('teacher')->num_rows();
		$data['jml_siswa']       = $this->db->get('student')->num_rows();
		$data['jml_contributor'] = $this->db->get('contributor')->num_rows();

		$data['inc']   = $this->load->view('admin/dashboard/home', $data, TRUE);
		$this->load->view('admin/inc', $data , FALSE);
	}

}

/* End of file Dashboard.php */
/* Location: ./application/controllers/admin/Dashboard.php */