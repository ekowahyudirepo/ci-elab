<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once 'Inc.php';

class Group extends Inc {

	public function index()
	{
		$data['qw_periode'] = $this->db->where_not_in('periode_status', 'new')->order_by('periode_year', 'desc')->get('periode');
		
		$data['title'] = 'E-Lab';

		$data['inc']  = $this->load->view('teacher/group/home', $data, TRUE);

		$this->load->view('teacher/inc', $data , FALSE);
	}

	public function kelas($id)
	{
		$this->load->model('Model_main', 'main');

		$data['qw_kelas'] = $this->db->get_where('kelas', ['periode_id' => $id, 'teacher_id' => $this->session->userdata('__ci_teacherid')]);
		
		$data['title'] = 'E-Lab';

		$data['inc']  = $this->load->view('teacher/group/kelas', $data, TRUE);

		$this->load->view('teacher/inc', $data , FALSE);
	}

	public function kelas_add($id)
	{
		$name       = $this->input->post('name');
		$level      = $this->input->post('level');
		$capacity   = $this->input->post('capacity');

		$data = array(
			'kelas_name'       => $name  ,
			'kelas_level'      => $level  ,
			'kelas_capacity'   => $capacity  ,
			'periode_id'       => $id, 
			'teacher_id'       => $this->session->userdata('__ci_teacherid')
		);

		if( $this->db->get_where('kelas', ['kelas_name' => $name] )->num_rows() == 0 ) {

			if( $this->db->insert('kelas', $data) ) {

				$this->_msg('success', 'Success to add');

			} else {

				$this->_msg('warning', 'Failed to add');

			}

		} else {
			
			$this->_msg('warning', 'Class is exist');

		}

		redirect( $this->input->server('HTTP_REFERER') );
	}

	public function kelas_del($id)
	{
		if( $this->db->where('kelas_id', $id)->delete('kelas') ) {

			$this->_msg('success', ' Success to delete');

		} else {

			$this->_msg('warning', 'Failed to delete');

		}

		redirect( $this->input->server('HTTP_REFERER') );
	}

	public function kelompok($id)
	{
		$this->load->model('Model_main', 'main');

		$data['qw_periode_id'] = $this->db->get_where('kelas', ['kelas_id' => $id ])->row()->periode_id;

		$data['qw_kelompok']      = $this->db->join('student','student.student_id = kelompok.student_id','left')->get_where('kelompok', ['kelas_id' => $id]);

		$data['keyword'] = ( $this->input->get('keyword') )? $this->input->get('keyword') : '' ;

		if( $this->input->get('keyword') ) {

			$data['qw_filter']      = $this->db->where('student_no', $this->input->get('keyword'))->get('student');
		}

		$data['title'] = 'Teacher | E-Lab';
		$data['inc']  = $this->load->view('teacher/group/kelompok', $data, TRUE);
		$this->load->view('teacher/inc', $data , FALSE);
	}

	public function kelompok_add($kelas_id,  $student_id)
	{

		$data = array(
			'kelas_id'     => $kelas_id  ,
			'student_id'   => $student_id 
		);

		if( $this->db->get_where('kelompok', ['kelas_id' => $kelas_id, 'student_id' => $student_id] )->num_rows() == 0 ) {

			if( $this->db->insert('kelompok', $data) ) {

				$this->_msg('success', 'Success to add');

			} else {

				$this->_msg('warning', 'Failed to add');

			}

		} else {
			
			$this->_msg('warning', 'Class is exist');

		}

		redirect( base_url().'teacher/group/kelompok/'.$kelas_id.'' );
	}

	public function kelompok_del($id)
	{
		if( $this->db->where('kelompok_id', $id)->delete('kelompok') ) {

			$this->_msg('success', ' Success to delete');

		} else {

			$this->_msg('warning', 'Failed to delete');

		}

		redirect( $this->input->server('HTTP_REFERER') );
	}

}

/* End of file Group.php */
/* Location: ./application/modules/member/controllers/Group.php */