<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once 'inc.php';

class Contributor extends Inc {

	public function __construct()
	{
		parent::__construct();

		$this->has_login();
	}

	public function index()
	{

		$data['qw_contributor'] = $this->db->get('contributor');

		$data['title'] = 'Contributor | E-Lab';
		$data['inc']  = $this->load->view('admin/contributor/home', $data, TRUE);
		$this->load->view('admin/inc', $data , FALSE);
	}

	public function add()
	{
		$email = $this->input->post('email');
		$name  = $this->input->post('name');
		$jk    = $this->input->post('jk');
		$phone = $this->input->post('phone');

		$data = array(
			'contributor_email'    => $email  , 
			'contributor_name'     => $name  , 
			'contributor_password' => md5($email) ,
			'contributor_jk'       => $jk  , 
			'contributor_phone'    => $phone 
		);

		if( $this->db->get_where('contributor', ['contributor_email' => $email] )->num_rows() == 0 ) {

			if( $this->db->insert('contributor', $data) ) {

				$this->_msg('success', 'Success to add');

			} else {

				$this->_msg('warning', 'Failed to add');

			}

		} else {
			
			$this->_msg('warning', 'Email is exist');

		}

		redirect( $this->input->server('HTTP_REFERER') );
	}

	public function reset($id)
	{
		$email = $this->db->get_where('contributor', ['contributor_id' => $id] )->row()->contributor_email;

		$data = array(
			'contributor_password' => md5($email) , 
		);

		if( $this->db->where('contributor_id', $id)->update('contributor', $data) ) {

			$this->_msg('success', $email . ' Success to reset');

		} else {

			$this->_msg('warning', 'Failed to reset');

		}

		redirect( $this->input->server('HTTP_REFERER') );
	}

	public function del($id)
	{
		if( $this->db->where('contributor_id', $id)->delete('contributor') ) {

			$this->_msg('success', ' Success to delete');

		} else {

			$this->_msg('warning', 'Failed to delete');

		}

		redirect( $this->input->server('HTTP_REFERER') );
	}

}

/* End of file Contributor.php */
/* Location: ./application/modules/member/controllers/Contributor.php */