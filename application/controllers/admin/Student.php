<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once 'inc.php';

class Student extends Inc {

	public function __construct()
	{
		parent::__construct();

		$this->has_login();
	}

	public function index()
	{

		$data['qw_student'] = $this->db->get('student');

		$data['title'] = 'Student | E-Lab';
		$data['inc']  = $this->load->view('admin/student/home', $data, TRUE);
		$this->load->view('admin/inc', $data , FALSE);
	}

	public function add()
	{
		$email      = $this->input->post('email');
		$no         = $this->input->post('no');
		$name       = $this->input->post('name');
		$jk         = $this->input->post('jk');
		$phone      = $this->input->post('phone');
		$kelas_id   = $this->input->post('kelas_id');

		$data = array(
			'student_email'    => $email  , 
			'student_password' => md5($email) ,
			'student_no'       => $no  , 
			'student_name'     => $name  , 
			'student_jk'       => $jk  , 
			'student_phone'    => $phone  , 
			'kelas_id'         => $kelas_id  
		);

		if( $this->db->get_where('student', ['student_email' => $email] )->num_rows() == 0 ) {

			if( $this->db->get_where('student', ['student_no' => $no] )->num_rows() == 0 ) {

				if( $this->db->insert('student', $data) ) {

					$this->_msg('success', 'Success to add');

				} else {

					$this->_msg('warning', 'Failed to add');

				}

			} else {
			
				$this->_msg('warning', 'ID is exist');

			}

		} else {
			
			$this->_msg('warning', 'Email is exist');

		}

		redirect( $this->input->server('HTTP_REFERER') );
	}

	public function reset($id)
	{
		$email = $this->db->get_where('student', ['student_id' => $id] )->row()->student_email;

		$data = array(
			'student_password' => md5($email) , 
		);

		if( $this->db->where('student_id', $id)->update('student', $data) ) {

			$this->_msg('success', $email . ' Success to reset');

		} else {

			$this->_msg('warning', 'Failed to reset');

		}

		redirect( $this->input->server('HTTP_REFERER') );
	}

	public function del($id)
	{
		if( $this->db->where('student_id', $id)->delete('student') ) {

			$this->_msg('success', ' Success to delete');

		} else {

			$this->_msg('warning', 'Failed to delete');

		}

		redirect( $this->input->server('HTTP_REFERER') );
	}


}

/* End of file Student.php */
/* Location: ./application/modules/member/controllers/Student.php */