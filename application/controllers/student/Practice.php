<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once 'Inc.php';

class Practice extends Inc {

	public function index()
	{					
		$data['qw_teacher'] = $this->db->get_where('teacher', ['teacher_id' => 1])->row();           

		$data['title'] = 'E-Lab';

		$data['inc']  = $this->load->view('student/practice', $data, TRUE);

		$this->load->view('student/inc', $data , FALSE);
	}

	# Reading

	public function reading()
	{
		$where = array(
			'reading_test_level'    => $this->session->userdata('__ci_studentlevel'), 
			'reading_test_category' => 'practice',
			'teacher_id'            => $this->session->userdata('__ci_teacherid')
		);

		$data['qw_reading_test'] = $this->db->order_by('reading_test_add','desc')
									   ->get_where('reading_test', $where);

		$data['title'] = 'E-Lab';

		$data['inc']  = $this->load->view('student/practice/reading/home', $data, TRUE);

		$this->load->view('student/inc', $data , FALSE);
	}


	public function reading_question_view($id)
	{
		$data['qw_submit'] = 'false';

		$where = array(
			'reading_test.reading_test_id'    => $id,
			'reading_test.teacher_id'         => $this->session->userdata('__ci_teacherid')
		);

		$data['qw_reading_sub_test'] = $this->db->join('reading_test','reading_test.reading_test_id = reading_sub_test.reading_test_id','right')
									   ->order_by('reading_sub_test_id','asc')
									   ->get_where('reading_sub_test', $where);

		if( $this->input->post('submit') ){

			$data['qw_submit'] = 'true';

			$data['qw_answer']  = array();

			$data['qw_correct'] = array();

			$data['qw_point'] = 0;

			foreach( $data['qw_reading_sub_test']->result() as $a ) {

				$data['qw_answer'][]  = $this->input->post('choose'.$a->reading_sub_test_id);


				$data['qw_correct'][] = $a->reading_sub_test_answer;

				if( $this->input->post('choose'.$a->reading_sub_test_id) == $a->reading_sub_test_answer ) {

					$data['qw_point'] += $a->reading_sub_test_point;

				}

			}

			$data['qw_point_pass'] = ( $data['qw_point'] >= $data['qw_reading_sub_test']->row()->reading_test_point_pass )? 'Pass' : 'Not pass';

		}

		$data['title'] = 'E-Lab';

		$data['inc']  = $this->load->view('student/practice/reading/question_view', $data, TRUE);

		$this->load->view('student/inc', $data , FALSE);
	}






	
	# Grammer

	public function grammer()
	{
		$where = array(
			'grammer_test_level'    => $this->session->userdata('__ci_studentlevel'), 
			'grammer_test_category' => 'practice',
			'teacher_id'            => $this->session->userdata('__ci_teacherid')
		);

		$data['qw_grammer_test'] = $this->db->order_by('grammer_test_add','desc')
									   ->get_where('grammer_test', $where);

		$data['title'] = 'E-Lab';

		$data['inc']  = $this->load->view('student/practice/grammer/home', $data, TRUE);

		$this->load->view('student/inc', $data , FALSE);
	}

	public function grammer_question_view($id)
	{
		$data['qw_submit'] = 'false';

		$where = array(
			'grammer_test.grammer_test_id'    => $id,
			'grammer_test.teacher_id'         => $this->session->userdata('__ci_teacherid')
		);

		$data['qw_grammer_sub_test'] = $this->db->join('grammer_test','grammer_test.grammer_test_id = grammer_sub_test.grammer_test_id','right')
									   ->order_by('grammer_sub_test_id','asc')
									   ->get_where('grammer_sub_test', $where);

		if( $this->input->post('submit') ){

			$data['qw_submit'] = 'true';

			$data['qw_answer']  = array();

			$data['qw_correct'] = array();

			$data['qw_point'] = 0;

			foreach( $data['qw_grammer_sub_test']->result() as $a ) {

				$data['qw_answer'][]  = $this->input->post('choose'.$a->grammer_sub_test_id);


				$data['qw_correct'][] = $a->grammer_sub_test_answer;

				if( $this->input->post('choose'.$a->grammer_sub_test_id) == $a->grammer_sub_test_answer ) {

					$data['qw_point'] += $a->grammer_sub_test_point;

				}

			}

			$data['qw_point_pass'] = ( $data['qw_point'] >= $data['qw_grammer_sub_test']->row()->grammer_test_point_pass )? 'Pass' : 'Not pass';

		}

		$data['title'] = 'E-Lab';

		$data['inc']  = $this->load->view('student/practice/grammer/question_view', $data, TRUE);

		$this->load->view('student/inc', $data , FALSE);
	}






	# Listening

	public function listening()
	{
		$where = array(
			'listening_test_level'    => $this->session->userdata('__ci_studentlevel'), 
			'listening_test_category' => 'practice',
			'teacher_id'              => $this->session->userdata('__ci_teacherid')
		);

		$data['qw_listening_test'] = $this->db->order_by('listening_test_add','desc')
									   ->get_where('listening_test', $where);

		$data['title'] = 'E-Lab';

		$data['inc']  = $this->load->view('student/practice/listening/home', $data, TRUE);

		$this->load->view('student/inc', $data , FALSE);
	}

	public function listening_question_view($id)
	{
		$data['qw_submit'] = 'false';
		
		$where = array(
			'listening_test.listening_test_id'    => $id,
			'listening_test.teacher_id'         => $this->session->userdata('__ci_teacherid')
		);

		$data['qw_listening_sub_test'] = $this->db->join('listening_test','listening_test.listening_test_id = listening_sub_test.listening_test_id','right')
									   ->order_by('listening_sub_test_id','asc')
									   ->get_where('listening_sub_test', $where);

		if( $this->input->post('submit') ){

			$data['qw_submit'] = 'true';

			$data['qw_answer']  = array();

			$data['qw_correct'] = array();

			$data['qw_point'] = 0;

			foreach( $data['qw_listening_sub_test']->result() as $a ) {

				$data['qw_answer'][]  = $this->input->post('choose'.$a->listening_sub_test_id);


				$data['qw_correct'][] = $a->listening_sub_test_answer;

				if( $this->input->post('choose'.$a->listening_sub_test_id) == $a->listening_sub_test_answer ) {

					$data['qw_point'] += $a->listening_sub_test_point;

				}

			}

			$data['qw_point_pass'] = ( $data['qw_point'] >= $data['qw_listening_sub_test']->row()->listening_test_point_pass )? 'Pass' : 'Not pass';

		}

		$data['title'] = 'E-Lab';

		$data['inc']  = $this->load->view('student/practice/listening/question_view', $data, TRUE);

		$this->load->view('student/inc', $data , FALSE);
	}





	# Speaking

	public function speaking()
	{
		$where = array(
			'speaking_test_level'    => $this->session->userdata('__ci_studentlevel'), 
			'speaking_test_category' => 'practice',
			'teacher_id'              => $this->session->userdata('__ci_teacherid')
		);

		$data['qw_speaking_test'] = $this->db->order_by('speaking_test_add','desc')
									   ->get_where('speaking_test', $where);

		$data['title'] = 'E-Lab';

		$data['inc']  = $this->load->view('student/practice/speaking/home', $data, TRUE);

		$this->load->view('student/inc', $data , FALSE);
	}

	public function speaking_question_view($id)
	{
		$where = array(
			'speaking_test.speaking_test_id'    => $id,
			'speaking_test.teacher_id'         => $this->session->userdata('__ci_teacherid')
		);

		$data['qw_speaking_sub_test'] = $this->db->join('speaking_test','speaking_test.speaking_test_id = speaking_sub_test.speaking_test_id','right')
									   ->order_by('speaking_sub_test_id','asc')
									   ->get_where('speaking_sub_test', $where);

		$data['title'] = 'E-Lab';

		$data['inc']  = $this->load->view('student/practice/speaking/question_view', $data, TRUE);

		$this->load->view('student/inc', $data , FALSE);
	}

}

/* End of file Practice.php */
/* Location: ./application/modules/member/controllers/Practice.php */