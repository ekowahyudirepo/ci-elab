<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once 'Inc.php';

class Practice extends Inc {

	public function index()
	{

		$where = array(
			'teacher_id'            => $this->session->userdata('__ci_teacherid')
		);

		$data['reading_beginner']     = $this->db->where('reading_test_category', 'practice')
												 ->where('reading_test_level', 'beginner')
											     ->get_where('reading_test', $where)->num_rows();
		$data['reading_intermediate'] = $this->db->where('reading_test_category', 'practice')
												 ->where('reading_test_level', 'intermediate')
												 ->get_where('reading_test', $where)->num_rows();
		$data['reading_advanced']     = $this->db->where('reading_test_category', 'practice')
												 ->where('reading_test_level', 'advanced')
									             ->get_where('reading_test', $where)->num_rows();

		$data['grammer_beginner']     = $this->db->where('grammer_test_category', 'practice')
												 ->where('grammer_test_level', 'beginner')
											     ->get_where('grammer_test', $where)->num_rows();
		$data['grammer_intermediate'] = $this->db->where('grammer_test_category', 'practice')
												 ->where('grammer_test_level', 'intermediate')
												 ->get_where('grammer_test', $where)->num_rows();
		$data['grammer_advanced']     = $this->db->where('grammer_test_category', 'practice')
												 ->where('grammer_test_level', 'advanced')
									             ->get_where('grammer_test', $where)->num_rows();

		$data['listening_beginner']     = $this->db->where('listening_test_category', 'practice')
												 ->where('listening_test_level', 'beginner')
											     ->get_where('listening_test', $where)->num_rows();
		$data['listening_intermediate'] = $this->db->where('listening_test_category', 'practice')
												 ->where('listening_test_level', 'intermediate')
												 ->get_where('listening_test', $where)->num_rows();
		$data['listening_advanced']     = $this->db->where('listening_test_category', 'practice')
												 ->where('listening_test_level', 'advanced')
									             ->get_where('listening_test', $where)->num_rows();

		$data['speaking_beginner']     = $this->db->where('speaking_test_category', 'practice')
												 ->where('speaking_test_level', 'beginner')
											     ->get_where('speaking_test', $where)->num_rows();
		$data['speaking_intermediate'] = $this->db->where('speaking_test_category', 'practice')
												 ->where('speaking_test_level', 'intermediate')
												 ->get_where('speaking_test', $where)->num_rows();
		$data['speaking_advanced']     = $this->db->where('speaking_test_category', 'practice')
												 ->where('speaking_test_level', 'advanced')
									             ->get_where('speaking_test', $where)->num_rows();							             							            

		$data['title'] = 'E-Lab';

		$data['inc']  = $this->load->view('teacher/practice', $data, TRUE);

		$this->load->view('teacher/inc', $data , FALSE);
	}

	# Reading

	public function reading($level)
	{
		$where = array(
			'reading_test_level'    => $level, 
			'reading_test_category' => 'practice',
			'teacher_id'            => $this->session->userdata('__ci_teacherid')
		);

		$data['qw_reading_test'] = $this->db->order_by('reading_test_add','desc')
									   ->get_where('reading_test', $where);

		$data['title'] = 'E-Lab';

		$data['inc']  = $this->load->view('teacher/practice/reading/home', $data, TRUE);

		$this->load->view('teacher/inc', $data , FALSE);
	}

	public function reading_add($level)
	{
		$name       = $this->input->post('name');
		$point      = $this->input->post('point');
		$teacher_id = $this->session->userdata('__ci_teacherid');

		$res  = $this->db->get_where('reading_test', ['reading_test_name' => $name ,'reading_test_level' => $level, 'reading_test_category' => 'practice' ]);

		if( $res->num_rows() ) {

			$this->_msg('warning','Name is exist');

		} else {

			$object = array(
				'reading_test_name'       => $name, 
				'reading_test_level'      => $level, 
				'reading_test_category'   => 'practice', 
				'reading_test_point_pass' => $point, 
				'reading_test_add'        => date('Y-m-d H:i:s'), 
				'teacher_id'              => $teacher_id
			);

			if( $this->db->insert('reading_test', $object) ) {

				$this->_msg('success','Success to add');

			} else {

				$this->_msg('warning','Fail to add');

			}

		}

		redirect( $this->input->server('HTTP_REFERER') );
	}

	public function reading_del($id)
	{

		if( $this->db->where('reading_test_id', $id)->delete('reading_test') ) {

			$this->_msg('success','Success to delete');

		} else {

			$this->_msg('warning','Fail to delete');

		}

		redirect( $this->input->server('HTTP_REFERER') );
	}

	public function reading_question($id)
	{

		$where = array(
			'reading_test.reading_test_id'    => $id,
			'reading_test.teacher_id'         => $this->session->userdata('__ci_teacherid')
		);

		$data['qw_point_total'] = $this->db->select_sum('reading_sub_test.reading_sub_test_point')
		                                   ->join('reading_test','reading_test.reading_test_id = reading_sub_test.reading_test_id','right')
									       ->get_where('reading_sub_test', $where)->row()->reading_sub_test_point;

		$data['qw_reading_sub_test'] = $this->db->join('reading_test','reading_test.reading_test_id = reading_sub_test.reading_test_id','right')
									   ->order_by('reading_sub_test_id','asc')
									   ->get_where('reading_sub_test', $where);

		$data['title'] = 'E-Lab';

		$data['inc']  = $this->load->view('teacher/practice/reading/question', $data, TRUE);

		$this->load->view('teacher/inc', $data , FALSE);
	}

	public function reading_question_input($id)
	{

		$data['title'] = 'E-Lab';

		$data['inc']  = $this->load->view('teacher/practice/reading/question_input', $data, TRUE);

		$this->load->view('teacher/inc', $data , FALSE);
	}

	public function reading_question_add($id)
	{
		$intro    = $this->input->post('intro');
		$question = $this->input->post('question');
		$a        = $this->input->post('a');
		$b        = $this->input->post('b');
		$c        = $this->input->post('c');
		$d        = $this->input->post('d');
		$answer   = $this->input->post('answer');
		$point    = $this->input->post('point');


		$object = array(
			'reading_sub_test_intro'     => ( $intro == '' )? null : $intro , 
			'reading_sub_test_question' => $question, 
			'reading_sub_test_a'        => $a, 
			'reading_sub_test_b'        => $b, 
			'reading_sub_test_c'        => $c, 
			'reading_sub_test_d'        => $d, 
			'reading_sub_test_answer'   => $answer, 
			'reading_sub_test_point'    => $point, 
			'reading_test_id'           => $id
		);

		if( $this->db->insert('reading_sub_test', $object) ) {

			$this->_msg('success','Success to add');

		} else {

			$this->_msg('warning','Fail to add');

		}

		redirect( $this->input->server('HTTP_REFERER') );
	}

	public function reading_question_del($id)
	{

		if( $this->db->where('reading_sub_test_id', $id)->delete('reading_sub_test') ) {

			$this->_msg('success','Success to delete');

		} else {

			$this->_msg('warning','Fail to delete');

		}

		redirect( $this->input->server('HTTP_REFERER') );
	}

	public function reading_question_view($id)
	{
		$where = array(
			'reading_test.reading_test_id'    => $id,
			'reading_test.teacher_id'         => $this->session->userdata('__ci_teacherid')
		);

		$data['qw_reading_sub_test'] = $this->db->join('reading_test','reading_test.reading_test_id = reading_sub_test.reading_test_id','right')
									   ->order_by('reading_sub_test_id','asc')
									   ->get_where('reading_sub_test', $where);

		$data['title'] = 'E-Lab';

		$data['inc']  = $this->load->view('teacher/practice/reading/question_view', $data, TRUE);

		$this->load->view('teacher/inc', $data , FALSE);
	}






	
	# Grammer

	public function grammer($level)
	{
		$where = array(
			'grammer_test_level'    => $level, 
			'grammer_test_category' => 'practice',
			'teacher_id'            => $this->session->userdata('__ci_teacherid')
		);

		$data['qw_grammer_test'] = $this->db->order_by('grammer_test_add','desc')
									   ->get_where('grammer_test', $where);

		$data['title'] = 'E-Lab';

		$data['inc']  = $this->load->view('teacher/practice/grammer/home', $data, TRUE);

		$this->load->view('teacher/inc', $data , FALSE);
	}

	public function grammer_add($level)
	{
		$name       = $this->input->post('name');
		$point      = $this->input->post('point');
		$teacher_id = $this->session->userdata('__ci_teacherid');

		$res  = $this->db->get_where('grammer_test', ['grammer_test_name' => $name ,'grammer_test_level' => $level, 'grammer_test_category' => 'practice' ]);

		if( $res->num_rows() ) {

			$this->_msg('warning','Name is exist');

		} else {

			$object = array(
				'grammer_test_name'       => $name, 
				'grammer_test_level'      => $level, 
				'grammer_test_category'   => 'practice', 
				'grammer_test_point_pass' => $point, 
				'grammer_test_add'        => date('Y-m-d H:i:s'), 
				'teacher_id'              => $teacher_id
			);

			if( $this->db->insert('grammer_test', $object) ) {

				$this->_msg('success','Success to add');

			} else {

				$this->_msg('warning','Fail to add');

			}

		}

		redirect( $this->input->server('HTTP_REFERER') );
	}

	public function grammer_del($id)
	{

		if( $this->db->where('grammer_test_id', $id)->delete('grammer_test') ) {

			$this->_msg('success','Success to delete');

		} else {

			$this->_msg('warning','Fail to delete');

		}

		redirect( $this->input->server('HTTP_REFERER') );
	}

	public function grammer_question($id)
	{

		$where = array(
			'grammer_test.grammer_test_id'    => $id,
			'grammer_test.teacher_id'         => $this->session->userdata('__ci_teacherid')
		);

		$data['qw_point_total'] = $this->db->select_sum('grammer_sub_test.grammer_sub_test_point')
		                                   ->join('grammer_test','grammer_test.grammer_test_id = grammer_sub_test.grammer_test_id','right')
									       ->get_where('grammer_sub_test', $where)->row()->grammer_sub_test_point;

		$data['qw_grammer_sub_test'] = $this->db->join('grammer_test','grammer_test.grammer_test_id = grammer_sub_test.grammer_test_id','right')
									   ->order_by('grammer_sub_test_id','asc')
									   ->get_where('grammer_sub_test', $where);


		$qw_point_pass = $this->db->select('grammer_test.grammer_test_point_pass')
									   ->get_where('grammer_test', $where)->row()->grammer_test_point_pass;

		$data['title'] = 'E-Lab';

		$data['inc']  = $this->load->view('teacher/practice/grammer/question', $data, TRUE);

		$this->load->view('teacher/inc', $data , FALSE);
	}

	public function grammer_question_input($id)
	{

		$data['title'] = 'E-Lab';

		$data['inc']  = $this->load->view('teacher/practice/grammer/question_input', $data, TRUE);

		$this->load->view('teacher/inc', $data , FALSE);
	}

	public function grammer_question_add($id)
	{
		$question = $this->input->post('question');
		$a        = $this->input->post('a');
		$b        = $this->input->post('b');
		$c        = $this->input->post('c');
		$d        = $this->input->post('d');
		$answer   = $this->input->post('answer');
		$point    = $this->input->post('point');


		$object = array(
			'grammer_sub_test_question' => $question, 
			'grammer_sub_test_a'        => $a, 
			'grammer_sub_test_b'        => $b, 
			'grammer_sub_test_c'        => $c, 
			'grammer_sub_test_d'        => $d, 
			'grammer_sub_test_answer'   => $answer, 
			'grammer_sub_test_point'    => $point, 
			'grammer_test_id'           => $id
		);

		if( $this->db->insert('grammer_sub_test', $object) ) {

			$this->_msg('success','Success to add');

		} else {

			$this->_msg('warning','Fail to add');

		}

		redirect( $this->input->server('HTTP_REFERER') );
	}

	public function grammer_question_del($id)
	{

		if( $this->db->where('grammer_sub_test_id', $id)->delete('grammer_sub_test') ) {

			$this->_msg('success','Success to delete');

		} else {

			$this->_msg('warning','Fail to delete');

		}

		redirect( $this->input->server('HTTP_REFERER') );
	}

	public function grammer_question_view($id)
	{
		$where = array(
			'grammer_test.grammer_test_id'    => $id,
			'grammer_test.teacher_id'         => $this->session->userdata('__ci_teacherid')
		);

		$data['qw_grammer_sub_test'] = $this->db->join('grammer_test','grammer_test.grammer_test_id = grammer_sub_test.grammer_test_id','right')
									   ->order_by('grammer_sub_test_id','asc')
									   ->get_where('grammer_sub_test', $where);

		$data['title'] = 'E-Lab';

		$data['inc']  = $this->load->view('teacher/practice/grammer/question_view', $data, TRUE);

		$this->load->view('teacher/inc', $data , FALSE);
	}






	# Listening

	public function listening($level)
	{
		$where = array(
			'listening_test_level'    => $level, 
			'listening_test_category' => 'practice',
			'teacher_id'              => $this->session->userdata('__ci_teacherid')
		);

		$data['qw_listening_test'] = $this->db->order_by('listening_test_add','desc')
									   ->get_where('listening_test', $where);

		$data['title'] = 'E-Lab';

		$data['inc']  = $this->load->view('teacher/practice/listening/home', $data, TRUE);

		$this->load->view('teacher/inc', $data , FALSE);
	}

	public function listening_add($level)
	{
		$name       = $this->input->post('name');
		$point      = $this->input->post('point');
		$teacher_id = $this->session->userdata('__ci_teacherid');

		$res  = $this->db->get_where('listening_test', ['listening_test_name' => $name ,'listening_test_level' => $level, 'listening_test_category' => 'practice' ]);

		if( $res->num_rows() ) {

			$this->_msg('warning','Name is exist');

		} else {

			$object = array(
				'listening_test_name'       => $name, 
				'listening_test_level'      => $level, 
				'listening_test_category'   => 'practice', 
				'listening_test_point_pass' => $point, 
				'listening_test_add'        => date('Y-m-d H:i:s'), 
				'teacher_id'              => $teacher_id
			);

			if( $this->db->insert('listening_test', $object) ) {

				$this->_msg('success','Success to add');

			} else {

				$this->_msg('warning','Fail to add');

			}

		}

		redirect( $this->input->server('HTTP_REFERER') );
	}

	public function listening_del($id)
	{

		if( $this->db->where('listening_test_id', $id)->delete('listening_test') ) {

			$this->_msg('success','Success to delete');

		} else {

			$this->_msg('warning','Fail to delete');

		}

		redirect( $this->input->server('HTTP_REFERER') );
	}

	public function listening_question($id)
	{

		$where = array(
			'listening_test.listening_test_id'    => $id,
			'listening_test.teacher_id'         => $this->session->userdata('__ci_teacherid')
		);

		$data['qw_point_total'] = $this->db->select_sum('listening_sub_test.listening_sub_test_point')
		                                   ->join('listening_test','listening_test.listening_test_id = listening_sub_test.listening_test_id','right')
									       ->get_where('listening_sub_test', $where)->row()->listening_sub_test_point;

		$data['qw_listening_sub_test'] = $this->db->join('listening_test','listening_test.listening_test_id = listening_sub_test.listening_test_id','right')
									   ->order_by('listening_sub_test_id','asc')
									   ->get_where('listening_sub_test', $where);


		$qw_point_pass = $this->db->select('listening_test.listening_test_point_pass')
									   ->get_where('listening_test', $where)->row()->listening_test_point_pass;

		$data['title'] = 'E-Lab';

		$data['inc']  = $this->load->view('teacher/practice/listening/question', $data, TRUE);

		$this->load->view('teacher/inc', $data , FALSE);
	}

	public function listening_question_input($id)
	{

		$data['qw_audio'] = $this->db->get_where('media', ['media_type' => 'audio']);

		$data['title'] = 'E-Lab';

		$data['inc']  = $this->load->view('teacher/practice/listening/question_input', $data, TRUE);

		$this->load->view('teacher/inc', $data , FALSE);
	}

	public function listening_question_add($id)
	{
		$intro    = $this->input->post('intro');
		$dir      = $this->input->post('dir');
		$question = $this->input->post('question');
		$a        = $this->input->post('a');
		$b        = $this->input->post('b');
		$c        = $this->input->post('c');
		$d        = $this->input->post('d');
		$answer   = $this->input->post('answer');
		$point    = $this->input->post('point');


		$object = array(
			'listening_sub_test_intro'    => ( $intro == '' )? null : $intro , 
			'listening_sub_test_dir'      => ( $dir == '' )? null : $dir, 
			'listening_sub_test_question' => $question, 
			'listening_sub_test_a'        => $a, 
			'listening_sub_test_b'        => $b, 
			'listening_sub_test_c'        => $c, 
			'listening_sub_test_d'        => $d, 
			'listening_sub_test_answer'   => $answer, 
			'listening_sub_test_point'    => $point, 
			'listening_test_id'           => $id
		);

		if( $this->db->insert('listening_sub_test', $object) ) {

			$this->_msg('success','Success to add');

		} else {

			$this->_msg('warning','Fail to add');

		}

		redirect( $this->input->server('HTTP_REFERER') );
	}

	public function listening_question_del($id)
	{

		if( $this->db->where('listening_sub_test_id', $id)->delete('listening_sub_test') ) {

			$this->_msg('success','Success to delete');

		} else {

			$this->_msg('warning','Fail to delete');

		}

		redirect( $this->input->server('HTTP_REFERER') );
	}

	public function listening_question_view($id)
	{
		$where = array(
			'listening_test.listening_test_id'    => $id,
			'listening_test.teacher_id'         => $this->session->userdata('__ci_teacherid')
		);

		$data['qw_listening_sub_test'] = $this->db->join('listening_test','listening_test.listening_test_id = listening_sub_test.listening_test_id','right')
									   ->order_by('listening_sub_test_id','asc')
									   ->get_where('listening_sub_test', $where);

		$data['title'] = 'E-Lab';

		$data['inc']  = $this->load->view('teacher/practice/listening/question_view', $data, TRUE);

		$this->load->view('teacher/inc', $data , FALSE);
	}





	# Speaking

	public function speaking($level)
	{
		$where = array(
			'speaking_test_level'    => $level, 
			'speaking_test_category' => 'practice',
			'teacher_id'              => $this->session->userdata('__ci_teacherid')
		);

		$data['qw_speaking_test'] = $this->db->order_by('speaking_test_add','desc')
									   ->get_where('speaking_test', $where);

		$data['title'] = 'E-Lab';

		$data['inc']  = $this->load->view('teacher/practice/speaking/home', $data, TRUE);

		$this->load->view('teacher/inc', $data , FALSE);
	}

	public function speaking_add($level)
	{
		$name       = $this->input->post('name');
		$point      = $this->input->post('point');
		$teacher_id = $this->session->userdata('__ci_teacherid');

		$res  = $this->db->get_where('speaking_test', ['speaking_test_name' => $name ,'speaking_test_level' => $level, 'speaking_test_category' => 'practice' ]);

		if( $res->num_rows() ) {

			$this->_msg('warning','Name is exist');

		} else {

			$object = array(
				'speaking_test_name'       => $name, 
				'speaking_test_level'      => $level, 
				'speaking_test_category'   => 'practice', 
				'speaking_test_point_pass' => $point, 
				'speaking_test_add'        => date('Y-m-d H:i:s'), 
				'teacher_id'              => $teacher_id
			);

			if( $this->db->insert('speaking_test', $object) ) {

				$this->_msg('success','Success to add');

			} else {

				$this->_msg('warning','Fail to add');

			}

		}

		redirect( $this->input->server('HTTP_REFERER') );
	}

	public function speaking_del($id)
	{

		if( $this->db->where('speaking_test_id', $id)->delete('speaking_test') ) {

			$this->_msg('success','Success to delete');

		} else {

			$this->_msg('warning','Fail to delete');

		}

		redirect( $this->input->server('HTTP_REFERER') );
	}

	public function speaking_question($id)
	{

		$where = array(
			'speaking_test.speaking_test_id'    => $id,
			'speaking_test.teacher_id'         => $this->session->userdata('__ci_teacherid')
		);

		$data['qw_point_total'] = $this->db->select_sum('speaking_sub_test.speaking_sub_test_point')
		                                   ->join('speaking_test','speaking_test.speaking_test_id = speaking_sub_test.speaking_test_id','right')
									       ->get_where('speaking_sub_test', $where)->row()->speaking_sub_test_point;

		$data['qw_speaking_sub_test'] = $this->db->join('speaking_test','speaking_test.speaking_test_id = speaking_sub_test.speaking_test_id','right')
									   ->order_by('speaking_sub_test_id','asc')
									   ->get_where('speaking_sub_test', $where);


		$qw_point_pass = $this->db->select('speaking_test.speaking_test_point_pass')
									   ->get_where('speaking_test', $where)->row()->speaking_test_point_pass;

		$data['title'] = 'E-Lab';

		$data['inc']  = $this->load->view('teacher/practice/speaking/question', $data, TRUE);

		$this->load->view('teacher/inc', $data , FALSE);
	}

	public function speaking_question_input($id)
	{

		$data['qw_audio'] = $this->db->get_where('media', ['media_type' => 'audio']);

		$data['title'] = 'E-Lab';

		$data['inc']  = $this->load->view('teacher/practice/speaking/question_input', $data, TRUE);

		$this->load->view('teacher/inc', $data , FALSE);
	}

	public function speaking_question_add($id)
	{
		$intro    = $this->input->post('intro');
		$question = $this->input->post('question');
		$answer   = $this->input->post('answer');
		$point    = $this->input->post('point');


		$object = array(
			'speaking_sub_test_intro'    => ( $intro == '' )? null : $intro , 
			'speaking_sub_test_question' => $question,
			'speaking_sub_test_answer'   => $answer, 
			'speaking_sub_test_point'    => $point, 
			'speaking_test_id'           => $id
		);

		if( $this->db->insert('speaking_sub_test', $object) ) {

			$this->_msg('success','Success to add');

		} else {

			$this->_msg('warning','Fail to add');

		}

		redirect( $this->input->server('HTTP_REFERER') );
	}

	public function speaking_question_del($id)
	{

		if( $this->db->where('speaking_sub_test_id', $id)->delete('speaking_sub_test') ) {

			$this->_msg('success','Success to delete');

		} else {

			$this->_msg('warning','Fail to delete');

		}

		redirect( $this->input->server('HTTP_REFERER') );
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

		$data['inc']  = $this->load->view('teacher/practice/speaking/question_view', $data, TRUE);

		$this->load->view('teacher/inc', $data , FALSE);
	}

}

/* End of file Practice.php */
/* Location: ./application/modules/member/controllers/Practice.php */