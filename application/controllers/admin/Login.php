<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once 'Inc.php';

class Login extends Inc {

	public function index()
	{
		$data['title'] = 'Login | E-Lab';
		$this->load->view('admin/login', $data , FALSE);
	}

	public function checking()
	{
		$username = $this->input->post('username');
		$password = md5($this->input->post('password'));


		$sql = $this->db->get_where('admin', ['admin_username' => $username, 'admin_password' => $password]);

		if( $sql->num_rows() == 1 ) {

			$s = $sql->row();

			$array = array(
				'__ci_adminid'       => $s->admin_id,
				'__ci_adminname'     => $s->admin_name
				
			);
			
			$this->session->set_userdata( $array );

			redirect( base_url().'admin/dashboard' );

		} else {
			
			$this->_msg('warning','Account not found');

			redirect( base_url().'admin/login' );
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();

		redirect( base_url().'admin/login' );
	}

}

/* End of file Login.php */
/* Location: ./application/controllers/admin/Login.php */