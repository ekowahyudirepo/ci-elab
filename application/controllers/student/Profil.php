<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once 'inc.php';

class Profil extends Inc {

	public function __construct()
	{
		parent::__construct();

		$this->has_login();
	}

	public function index()
	{

		$data['qw_student'] = $this->db->get('student');

		$data['title'] = 'Profil | E-Lab';

		$data['inc']  = $this->load->view('student/profil/home', $data, TRUE);

		$this->load->view('student/inc', $data , FALSE);
	}

	public function update_nama()
	{
		$id   = $this->session->userdata('__ci_studentid');
		$nama = $this->input->post('nama');
		$email = $this->input->post('email');
		$password = $this->input->post('password');

		$data = array(
			'student_name'     => $nama , 
			'student_email'    => $email 
		);

		if( $password ) {

			$data['student_password'] = md5($password);

		}

		if( $this->db->where('student_id', $id)->update('student', $data) ) {

			$array = array(
				'__ci_studentname' => $nama
			);
			
			$this->session->set_userdata( $array );

			$this->_msg('success', ' Success to update');

		} else {

			$this->_msg('warning', 'Failed to update');

		}

		redirect( $this->input->server('HTTP_REFERER') );
	}


}

/* End of file Profil.php */
/* Location: ./application/modules/member/controllers/Profil.php */