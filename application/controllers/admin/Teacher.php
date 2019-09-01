<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once 'inc.php';

class Teacher extends Inc {

	public function __construct()
	{
		parent::__construct();

		$this->has_login();
	}

	public function index()
	{

		$data['qw_teacher'] = $this->db->get('teacher');

		$data['title'] = 'Teacher | E-Lab';
		$data['inc']  = $this->load->view('admin/teacher/home', $data, TRUE);
		$this->load->view('admin/inc', $data , FALSE);
	}

	public function add()
	{
		$email = $this->input->post('email');
		$name  = $this->input->post('name');
		$jk    = $this->input->post('jk');
		$phone = $this->input->post('phone');

		$data = array(
			'teacher_email'    => $email  , 
			'teacher_name'     => $name  , 
			'teacher_password' => md5($email),
			'teacher_jk'       => $jk  , 
			'teacher_phone'    => $phone 
		);

		if( $this->db->get_where('teacher', ['teacher_email' => $email] )->num_rows() == 0 ) {

			if( $this->db->insert('teacher', $data) ) {

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
		$email = $this->db->get_where('teacher', ['teacher_id' => $id] )->row()->teacher_email;

		$data = array(
			'teacher_password' => md5($email) , 
		);

		if( $this->db->where('teacher_id', $id)->update('teacher', $data) ) {

			$this->_msg('success', $email . ' Success to reset');

		} else {

			$this->_msg('warning', 'Failed to reset');

		}

		redirect( $this->input->server('HTTP_REFERER') );
	}

	public function del($id)
	{
		if( $this->db->where('teacher_id', $id)->delete('teacher') ) {

			$this->_msg('success', ' Success to delete');

		} else {

			$this->_msg('warning', 'Failed to delete');

		}

		redirect( $this->input->server('HTTP_REFERER') );
	}

}

/* End of file Teacher.php */
/* Location: ./application/modules/member/controllers/Teacher.php */