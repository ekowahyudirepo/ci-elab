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

		$data['qw_admin'] = $this->db->get('admin');

		$data['title'] = 'Profil | E-Lab';

		$data['inc']  = $this->load->view('admin/profil/home', $data, TRUE);

		$this->load->view('admin/inc', $data , FALSE);
	}

	public function update_nama()
	{
		$id   = $this->session->userdata('__ci_adminid');
		$nama = $this->input->post('nama');
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$data = array(
			'admin_name'     => $nama , 
			'admin_username' => $username 
		);

		if( $password ) {

			$data['admin_password'] = md5($password);

		}

		if( $this->db->where('admin_id', $id)->update('admin', $data) ) {

			$array = array(
				'__ci_adminname' => $nama
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