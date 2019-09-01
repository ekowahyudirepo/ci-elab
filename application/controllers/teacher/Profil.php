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

		$data['qw_teacher'] = $this->db->get('teacher');

		$data['title'] = 'Profil | E-Lab';

		$data['inc']  = $this->load->view('teacher/profil/home', $data, TRUE);

		$this->load->view('teacher/inc', $data , FALSE);
	}

	public function update_nama()
	{
		$id   = $this->session->userdata('__ci_teacherid');
		$nama = $this->input->post('nama');
		$email = $this->input->post('email');
		$password = $this->input->post('password');

		$data = array(
			'teacher_name'     => $nama , 
			'teacher_email'    => $email 
		);

		if( $password ) {

			$data['teacher_password'] = md5($password);

		}

		if( $this->db->where('teacher_id', $id)->update('teacher', $data) ) {

			$array = array(
				'__ci_teachername' => $nama
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