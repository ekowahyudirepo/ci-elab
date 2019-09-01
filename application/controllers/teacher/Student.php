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

		$data['qw_teacher_name'] = $this->db->get_where('teacher', ['teacher_id' =>  $this->session->userdata('__ci_teacherid') ])->row()->teacher_name;

		$data['qw_student_beginner'] = $this->db->get_where('student', ['teacher_id' =>  $this->session->userdata('__ci_teacherid'), 'student_level' => 'beginner'])->num_rows();

		$data['qw_student_intermediate'] = $this->db->get_where('student', ['teacher_id' =>  $this->session->userdata('__ci_teacherid'), 'student_level' => 'intermediate'])->num_rows();

		$data['qw_student_advanced'] = $this->db->get_where('student', ['teacher_id' =>  $this->session->userdata('__ci_teacherid'), 'student_level' => 'advanced'])->num_rows();

		$data['title'] = 'Teacher | E-Lab';
		$data['inc']  = $this->load->view('teacher/student/group', $data, TRUE);
		$this->load->view('teacher/inc', $data , FALSE);
	}

	public function beginner()
	{
		$this->load->model('Model_main', 'main');

		$data['qw_teacher_name'] = $this->db->get_where('teacher', ['teacher_id' =>  $this->session->userdata('__ci_teacherid') ])->row()->teacher_name;

		$data['qw_student']      = $this->db->get_where('student', [ 'student_level' => 'beginner', 'teacher_id' =>  $this->session->userdata('__ci_teacherid') ]);

		if( $this->input->post('keyword') ) {

			$data['qw_student_filter']      = $this->db->where('student_level', 'new')->like('student_no', $this->input->post('keyword'))->get('student');
		}

		$data['title'] = 'Teacher | E-Lab';
		$data['inc']  = $this->load->view('teacher/student/student', $data, TRUE);
		$this->load->view('teacher/inc', $data , FALSE);
	}

	public function intermediate()
	{
		$this->load->model('Model_main', 'main');

		$data['qw_teacher_name'] = $this->db->get_where('teacher', ['teacher_id' =>  $this->session->userdata('__ci_teacherid') ])->row()->teacher_name;

		$data['qw_student']      = $this->db->get_where('student', [ 'student_level' => 'intermediate', 'teacher_id' =>  $this->session->userdata('__ci_teacherid') ]);

		if( $this->input->post('keyword') ) {

			$data['qw_student_filter']      = $this->db->where('student_level', 'new')->like('student_no', $this->input->post('keyword'))->get('student');
		}

		$data['title'] = 'Teacher | E-Lab';
		$data['inc']  = $this->load->view('teacher/student/student', $data, TRUE);
		$this->load->view('teacher/inc', $data , FALSE);
	}

	public function advanced()
	{
		$this->load->model('Model_main', 'main');
		
		$data['qw_teacher_name'] = $this->db->get_where('teacher', ['teacher_id' =>  $this->session->userdata('__ci_teacherid') ])->row()->teacher_name;

		$data['qw_student']      = $this->db->get_where('student', [ 'student_level' => 'advanced', 'teacher_id' =>  $this->session->userdata('__ci_teacherid') ]);

		if( $this->input->post('keyword') ) {

			$data['qw_student_filter']      = $this->db->where('student_level', 'new')->like('student_no', $this->input->post('keyword'))->get('student');
		}

		$data['title'] = 'Teacher | E-Lab';
		$data['inc']  = $this->load->view('teacher/student/student', $data, TRUE);
		$this->load->view('teacher/inc', $data , FALSE);
	}
}

/* End of file Student.php */
/* Location: ./application/modules/member/controllers/Student.php */