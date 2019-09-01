<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once 'Inc.php';

class Test extends Inc {

	public function index()
	{

		$where = array(
			'teacher_id'            => $this->session->userdata('__ci_teacherid')
		);

		$data['reading_beginner']     = $this->db->where('reading_test_category', 'test')
												 ->where('reading_test_level', 'beginner')
											     ->get_where('reading_test', $where)->num_rows();
		$data['reading_intermediate'] = $this->db->where('reading_test_category', 'test')
												 ->where('reading_test_level', 'intermediate')
												 ->get_where('reading_test', $where)->num_rows();
		$data['reading_advanced']     = $this->db->where('reading_test_category', 'test')
												 ->where('reading_test_level', 'advanced')
									             ->get_where('reading_test', $where)->num_rows();

		$data['grammer_beginner']     = $this->db->where('grammer_test_category', 'test')
												 ->where('grammer_test_level', 'beginner')
											     ->get_where('grammer_test', $where)->num_rows();
		$data['grammer_intermediate'] = $this->db->where('grammer_test_category', 'test')
												 ->where('grammer_test_level', 'intermediate')
												 ->get_where('grammer_test', $where)->num_rows();
		$data['grammer_advanced']     = $this->db->where('grammer_test_category', 'test')
												 ->where('grammer_test_level', 'advanced')
									             ->get_where('grammer_test', $where)->num_rows();

		$data['listening_beginner']     = $this->db->where('listening_test_category', 'test')
												 ->where('listening_test_level', 'beginner')
											     ->get_where('listening_test', $where)->num_rows();
		$data['listening_intermediate'] = $this->db->where('listening_test_category', 'test')
												 ->where('listening_test_level', 'intermediate')
												 ->get_where('listening_test', $where)->num_rows();
		$data['listening_advanced']     = $this->db->where('listening_test_category', 'test')
												 ->where('listening_test_level', 'advanced')
									             ->get_where('listening_test', $where)->num_rows();

		$data['speaking_beginner']     = $this->db->where('speaking_test_category', 'test')
												 ->where('speaking_test_level', 'beginner')
											     ->get_where('speaking_test', $where)->num_rows();
		$data['speaking_intermediate'] = $this->db->where('speaking_test_category', 'test')
												 ->where('speaking_test_level', 'intermediate')
												 ->get_where('speaking_test', $where)->num_rows();
		$data['speaking_advanced']     = $this->db->where('speaking_test_category', 'test')
												 ->where('speaking_test_level', 'advanced')
									             ->get_where('speaking_test', $where)->num_rows();							             							            

		$data['title'] = 'E-Lab';

		$data['inc']  = $this->load->view('teacher/test', $data, TRUE);

		$this->load->view('teacher/inc', $data , FALSE);
	}

	# Reading

	public function reading($level)
	{

		if( $this->input->get('status') ) {

			$array = array(
				'reading_test_status' => $this->input->get('status')
			);
			
			$this->session->set_userdata( $array );

		}

		$where = array(
			'reading_test_level'    => $level, 
			'reading_test_category' => 'test',
			'teacher_id'            => $this->session->userdata('__ci_teacherid')
		);

		if( $this->session->userdata('reading_test_status') ){
			$data['status']             = $this->session->userdata('reading_test_status');
			if( $this->session->userdata('reading_test_status') != 'all' ){
				$where['reading_test_status'] = $this->session->userdata('reading_test_status');
			}
		}else{
			$data['status']               = 'new';
			$where['reading_test_status'] = 'new';
		}

		$data['qw_reading_test'] = $this->db->order_by('reading_test_add','desc')
									   ->get_where('reading_test', $where);


		$data['title'] = 'E-Lab';

		$data['inc']  = $this->load->view('teacher/test/reading/home', $data, TRUE);

		$this->load->view('teacher/inc', $data , FALSE);
	}

	public function reading_add($level)
	{
		$name       = $this->input->post('name');
		$point      = $this->input->post('point');
		$start      = $this->input->post('start');
		$time       = $this->input->post('time');
		$duration   = $this->input->post('duration');
		$teacher_id = $this->session->userdata('__ci_teacherid');

		$res  = $this->db->get_where('reading_test', ['reading_test_name' => $name ,'reading_test_level' => $level, 'reading_test_category' => 'test' ]);

		if( $res->num_rows() ) {

			$this->_msg('warning','Name is exist');

		} else {

			$object = array(
				'reading_test_name'       => $name, 
				'reading_test_level'      => $level, 
				'reading_test_category'   => 'test', 
				'reading_test_point_pass' => $point, 
				'reading_test_start'      => $start.' '.$time, 
				'reading_test_finish'     => date('Y-m-d H:i:s', strtotime($start.' '.$time) + ($duration * 60 )), 
				'reading_test_add'        => date('Y-m-d H:i:s'), 
				'reading_test_status'     => 'new',
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

		$level = $this->db->get_where('reading_test', ['reading_test_id' => $id ])->row()->reading_test_level;

		$where = array(
			'reading_test_level'    => $level, 
			'reading_test_category' => 'practice',
			'teacher_id'              => $this->session->userdata('__ci_teacherid')
		);

		$data['qw_reading_test'] = $this->db->order_by('reading_test_add','desc')
									   ->get_where('reading_test', $where);							   


		$data['title'] = 'E-Lab';

		$data['inc']  = $this->load->view('teacher/test/reading/question', $data, TRUE);

		$this->load->view('teacher/inc', $data , FALSE);
	}

	public function reading_question_input($id)
	{

		$data['title'] = 'E-Lab';

		$data['inc']  = $this->load->view('teacher/test/reading/question_input', $data, TRUE);

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

		$data['inc']  = $this->load->view('teacher/test/reading/question_view', $data, TRUE);

		$this->load->view('teacher/inc', $data , FALSE);
	}

	public function reading_student($id)
	{

		$this->load->model('Model_main', 'main');

		$data['test'] = $this->db->get_where('reading_test', ['reading_test_id' => $id])->row();

		$where = array(
			'kelas.kelas_level'              => $data['test']->reading_test_level,
			'kelas.teacher_id'               => $this->session->userdata('__ci_teacherid'),
			'reading_answer.reading_test_id' => $id
		);

		$data['qw_student'] = $this->db->select('student.student_id, student.student_name')
		                              ->join('kelompok','kelompok.student_id = reading_answer.student_id','left')
		                              ->join('kelas','kelas.kelas_id = kelompok.kelas_id','left')
		                              ->join('student','student.student_id = kelompok.student_id','left')
									  ->group_by('reading_answer.student_id')
							   		  ->get_where('reading_answer', $where);

		$data['qw_student2'] = $this->db->join('kelas','kelas.kelas_id = kelompok.kelas_id','left')
										->join('student','student.student_id = kelompok.student_id','left')
										->get_where('kelompok', ['kelas.kelas_level' => $data['test']->reading_test_level, 'kelas.teacher_id' => $this->session->userdata('__ci_teacherid')]);



		$data['qw_student_id'] = array();

		foreach ($data['qw_student']->result() as $i  ) {
			
			$data['qw_student_id'][] = $i->student_id;

		}

		// Pie
		$data['qw_pass']     = 0;
		$data['qw_not_pass'] = 0;

		foreach ($data['qw_student']->result() as $st) {
			
			if( $this->main->student_table_point( 'reading', $st->student_id ) >= $data['test']->reading_test_point_pass ) {
				$data['qw_pass']++;
			} else {
				$data['qw_not_pass']++;
			}
		}

		$data['title'] = 'E-Lab';

		$data['inc']  = $this->load->view('teacher/test/reading/student', $data, TRUE);

		$this->load->view('teacher/inc', $data , FALSE);
	}

	public function reading_student_add($id)
	{
		$array_student_id = $this->input->post('student_id');

		$sub_test_id = $this->db->select('reading_sub_test_id')->get_where('reading_sub_test', ['reading_test_id' => $id]);

		if( $sub_test_id->num_rows() == 0 ) {

			$this->_msg('warning','Fail to add because nothing test question');

			redirect( $this->input->server('HTTP_REFERER') );

			exit();
		}

		$object = array();

		for( $a=0; $a<count($array_student_id); $a++ ) {

			foreach( $sub_test_id->result() as $b ) {

				$object[] = array(
					'reading_sub_test_id' => $b->reading_sub_test_id , 
					'reading_test_id' => $id , 
					'student_id' => $array_student_id[$a] 
				);

			}


		}

		if( $this->db->insert_batch('reading_answer', $object) ) {

			$this->_msg('success','Success to add');

		} else {

			$this->_msg('warning','Fail to add');

		}

		redirect( $this->input->server('HTTP_REFERER') );
		
	}

	public function reading_student_del($id, $student_id)
	{
		$where = array(
			'reading_test_id' => $id , 
			'student_id'      => $student_id 
		);

		if( $this->db->where($where)->delete('reading_answer') ) {

			$this->_msg('success','Success to delete');

		} else {

			$this->_msg('warning','Fail to delete');

		}

		redirect( $this->input->server('HTTP_REFERER') );
	}

	public function reading_student_view($id, $student_id)
	{
		$where = array(
			'reading_test.reading_test_id'    => $id,
			'reading_test.teacher_id'         => $this->session->userdata('__ci_teacherid')
		);

		$data['qw_reading_sub_test'] = $this->db->join('reading_test','reading_test.reading_test_id = reading_sub_test.reading_test_id','right')
									   ->order_by('reading_sub_test_id','asc')
									   ->get_where('reading_sub_test', $where);

		$data['qw_correct']   = $this->db->get_where('reading_answer', ['reading_test_id' => $id, 'student_id' => $student_id, 'reading_answer_correct' => 'true'])->num_rows();

		$data['qw_incorrect'] = $this->db->get_where('reading_answer', ['reading_test_id' => $id, 'student_id' => $student_id, 'reading_answer_correct' => 'false'])->num_rows();

		$data['qw_point']     = $this->db->select_sum('reading_sub_test_point')->join('reading_sub_test','reading_sub_test.reading_sub_test_id = reading_answer.reading_sub_test_id','left')
										 ->get_where('reading_answer', ['reading_answer.reading_test_id' => $id, 'reading_answer.student_id' => $student_id, 'reading_answer_correct' => 'true'])->row()->reading_sub_test_point;

		$data['title'] = 'E-Lab';

		$data['inc']  = $this->load->view('teacher/test/reading/student_view', $data, TRUE);

		$this->load->view('teacher/inc', $data , FALSE);
	}

	public function reading_play($id)
	{
		$object = array('reading_test_status' => 'pending' );

		if( $this->db->where('reading_test_id', $id)->update('reading_test', $object) ) {

			$this->_msg('success','Success to update');

		} else {

			$this->_msg('warning','Fail to update');

		}

		redirect( $this->input->server('HTTP_REFERER') );

	}

	public function reading_police($id)
	{

		$data['qw_reading_test'] = $this->db->get_where('reading_test', ['reading_test_id' => $id])->row();

		$data['title'] = 'E-Lab';

		$data['inc']  = $this->load->view('teacher/test/reading/police', $data, TRUE);

		$this->load->view('teacher/inc', $data , FALSE);
	}

	public function reading_update_police($id)
	{
		$police = $this->input->post('police');

		$object = array('reading_test_police' => $police );

		if( $this->db->where('reading_test_id', $id)->update('reading_test', $object) ) {

			$this->_msg('success','Success to update');

		} else {

			$this->_msg('warning','Fail to update');

		}

		redirect( $this->input->server('HTTP_REFERER') );
	}






	
	# Grammer

	public function grammer($level)
	{
		if( $this->input->get('status') ) {

			$array = array(
				'grammer_test_status' => $this->input->get('status')
			);
			
			$this->session->set_userdata( $array );

		}

		$where = array(
			'grammer_test_level'    => $level, 
			'grammer_test_category' => 'test',
			'teacher_id'            => $this->session->userdata('__ci_teacherid')
		);

		if( $this->session->userdata('grammer_test_status') ){
			$data['status']             = $this->session->userdata('grammer_test_status');
			if( $this->session->userdata('grammer_test_status') != 'all' ){
				$where['grammer_test_status'] = $this->session->userdata('grammer_test_status');
			}
		}else{
			$data['status']               = 'new';
			$where['grammer_test_status'] = 'new';
		}

		$data['qw_grammer_test'] = $this->db->order_by('grammer_test_add','desc')
									   ->get_where('grammer_test', $where);

		$data['title'] = 'E-Lab';

		$data['inc']  = $this->load->view('teacher/test/grammer/home', $data, TRUE);

		$this->load->view('teacher/inc', $data , FALSE);
	}

	public function grammer_add($level)
	{
		$name       = $this->input->post('name');
		$point      = $this->input->post('point');
		$start      = $this->input->post('start');
		$time       = $this->input->post('time');
		$duration   = $this->input->post('duration');
		$teacher_id = $this->session->userdata('__ci_teacherid');

		$res  = $this->db->get_where('grammer_test', ['grammer_test_name' => $name ,'grammer_test_level' => $level, 'grammer_test_category' => 'test' ]);

		if( $res->num_rows() ) {

			$this->_msg('warning','Name is exist');

		} else {

			$object = array(
				'grammer_test_name'       => $name, 
				'grammer_test_level'      => $level, 
				'grammer_test_category'   => 'test', 
				'grammer_test_point_pass' => $point, 
				'grammer_test_start'      => $start.' '.$time, 
				'grammer_test_finish'     => date('Y-m-d H:i:s', strtotime($start.' '.$time) + ($duration * 60 )), 
				'grammer_test_add'        => date('Y-m-d H:i:s'), 
				'grammer_test_status'     => 'new',
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

		$level = $this->db->get_where('grammer_test', ['grammer_test_id' => $id ])->row()->grammer_test_level;

		$where = array(
			'grammer_test_level'    => $level, 
			'grammer_test_category' => 'practice',
			'teacher_id'              => $this->session->userdata('__ci_teacherid')
		);

		$data['qw_grammer_test'] = $this->db->order_by('grammer_test_add','desc')
									   ->get_where('grammer_test', $where);							   

		$data['title'] = 'E-Lab';

		$data['inc']  = $this->load->view('teacher/test/grammer/question', $data, TRUE);

		$this->load->view('teacher/inc', $data , FALSE);
	}

	public function grammer_question_input($id)
	{

		$data['title'] = 'E-Lab';

		$data['inc']  = $this->load->view('teacher/test/grammer/question_input', $data, TRUE);

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

		$data['inc']  = $this->load->view('teacher/test/grammer/question_view', $data, TRUE);

		$this->load->view('teacher/inc', $data , FALSE);
	}

	public function grammer_student($id)
	{
		$this->load->model('Model_main', 'main');

		$data['test'] = $this->db->get_where('grammer_test', ['grammer_test_id' => $id])->row();

		$where = array(
			'kelas.kelas_level'              => $data['test']->grammer_test_level,
			'kelas.teacher_id'               => $this->session->userdata('__ci_teacherid'),
			'grammer_answer.grammer_test_id' => $id
		);

		$data['qw_student'] = $this->db->select('student.student_id, student.student_name')
		                              ->join('kelompok','kelompok.student_id = grammer_answer.student_id','left')
		                              ->join('kelas','kelas.kelas_id = kelompok.kelas_id','left')
		                              ->join('student','student.student_id = kelompok.student_id','left')
									  ->group_by('grammer_answer.student_id')
							   		  ->get_where('grammer_answer', $where);

		$data['qw_student2'] = $this->db->join('kelas','kelas.kelas_id = kelompok.kelas_id','left')
										->join('student','student.student_id = kelompok.student_id','left')
										->get_where('kelompok', ['kelas.kelas_level' => $data['test']->reading_test_level, 'kelas.teacher_id' => $this->session->userdata('__ci_teacherid')]);


		$data['qw_student_id'] = array();

		foreach ($data['qw_student']->result() as $i  ) {
			
			$data['qw_student_id'][] = $i->student_id;

		}

		// Pie
		$data['qw_pass']     = 0;
		$data['qw_not_pass'] = 0;

		foreach ($data['qw_student']->result() as $st) {
			
			if( $this->main->student_table_point( 'grammer', $st->student_id ) >= $data['test']->grammer_test_point_pass ) {
				$data['qw_pass']++;
			} else {
				$data['qw_not_pass']++;
			}
		}

		$data['title'] = 'E-Lab';

		$data['inc']  = $this->load->view('teacher/test/grammer/student', $data, TRUE);

		$this->load->view('teacher/inc', $data , FALSE);
	}

	public function grammer_student_add($id)
	{
		$array_student_id = $this->input->post('student_id');

		$sub_test_id = $this->db->select('grammer_sub_test_id')->get_where('grammer_sub_test', ['grammer_test_id' => $id]);

		if( $sub_test_id->num_rows() == 0 ) {

			$this->_msg('warning','Fail to add because nothing test question');

			redirect( $this->input->server('HTTP_REFERER') );

			exit();
		}

		$object = array();

		for( $a=0; $a<count($array_student_id); $a++ ) {

			foreach( $sub_test_id->result() as $b ) {

				$object[] = array(
					'grammer_sub_test_id' => $b->grammer_sub_test_id , 
					'grammer_test_id' => $id , 
					'student_id' => $array_student_id[$a] 
				);

			}


		}

		if( $this->db->insert_batch('grammer_answer', $object) ) {

			$this->_msg('success','Success to add');

		} else {

			$this->_msg('warning','Fail to add');

		}

		redirect( $this->input->server('HTTP_REFERER') );
		
	}

	public function grammer_student_del($id, $student_id)
	{
		$where = array(
			'grammer_test_id' => $id , 
			'student_id'      => $student_id 
		);

		if( $this->db->where($where)->delete('grammer_answer') ) {

			$this->_msg('success','Success to delete');

		} else {

			$this->_msg('warning','Fail to delete');

		}

		redirect( $this->input->server('HTTP_REFERER') );
	}

	public function grammer_student_view($id, $student_id)
	{
		$where = array(
			'grammer_test.grammer_test_id'    => $id,
			'grammer_test.teacher_id'         => $this->session->userdata('__ci_teacherid')
		);

		$data['qw_grammer_sub_test'] = $this->db->join('grammer_test','grammer_test.grammer_test_id = grammer_sub_test.grammer_test_id','right')
									   ->order_by('grammer_sub_test_id','asc')
									   ->get_where('grammer_sub_test', $where);

		$data['qw_correct']   = $this->db->get_where('grammer_answer', ['grammer_test_id' => $id, 'student_id' => $student_id, 'grammer_answer_correct' => 'true'])->num_rows();

		$data['qw_incorrect'] = $this->db->get_where('grammer_answer', ['grammer_test_id' => $id, 'student_id' => $student_id, 'grammer_answer_correct' => 'false'])->num_rows();

		$data['qw_point']     = $this->db->select_sum('grammer_sub_test_point')->join('grammer_sub_test','grammer_sub_test.grammer_sub_test_id = grammer_answer.grammer_sub_test_id','left')
										 ->get_where('grammer_answer', ['grammer_answer.grammer_test_id' => $id, 'grammer_answer.student_id' => $student_id, 'grammer_answer_correct' => 'true'])->row()->grammer_sub_test_point;

		$data['title'] = 'E-Lab';

		$data['inc']  = $this->load->view('teacher/test/grammer/student_view', $data, TRUE);

		$this->load->view('teacher/inc', $data , FALSE);
	}

	public function grammer_play($id)
	{
		$object = array('grammer_test_status' => 'pending' );

		if( $this->db->where('grammer_test_id', $id)->update('grammer_test', $object) ) {

			$this->_msg('success','Success to update');

		} else {

			$this->_msg('warning','Fail to update');

		}

		redirect( $this->input->server('HTTP_REFERER') );

	}

	public function grammer_police($id)
	{

		$data['qw_grammer_test'] = $this->db->get_where('grammer_test', ['grammer_test_id' => $id])->row();

		$data['title'] = 'E-Lab';

		$data['inc']  = $this->load->view('teacher/test/grammer/police', $data, TRUE);

		$this->load->view('teacher/inc', $data , FALSE);
	}

	public function grammer_update_police($id)
	{
		$police = $this->input->post('police');

		$object = array('grammer_test_police' => $police );

		if( $this->db->where('grammer_test_id', $id)->update('grammer_test', $object) ) {

			$this->_msg('success','Success to update');

		} else {

			$this->_msg('warning','Fail to update');

		}

		redirect( $this->input->server('HTTP_REFERER') );
	}






	# Listening

	public function listening($level)
	{
		if( $this->input->get('status') ) {

			$array = array(
				'listening_test_status' => $this->input->get('status')
			);
			
			$this->session->set_userdata( $array );

		}

		$where = array(
			'listening_test_level'    => $level, 
			'listening_test_category' => 'test',
			'teacher_id'            => $this->session->userdata('__ci_teacherid')
		);

		if( $this->session->userdata('listening_test_status') ){
			$data['status']             = $this->session->userdata('listening_test_status');
			if( $this->session->userdata('listening_test_status') != 'all' ){
				$where['listening_test_status'] = $this->session->userdata('listening_test_status');
			}
		}else{
			$data['status']               = 'new';
			$where['listening_test_status'] = 'new';
		}

		$data['qw_listening_test'] = $this->db->order_by('listening_test_add','desc')
									   ->get_where('listening_test', $where);

		$data['title'] = 'E-Lab';

		$data['inc']  = $this->load->view('teacher/test/listening/home', $data, TRUE);

		$this->load->view('teacher/inc', $data , FALSE);
	}

	public function listening_add($level)
	{
		$name       = $this->input->post('name');
		$point      = $this->input->post('point');
		$start      = $this->input->post('start');
		$time       = $this->input->post('time');
		$duration   = $this->input->post('duration');
		$teacher_id = $this->session->userdata('__ci_teacherid');

		$res  = $this->db->get_where('listening_test', ['listening_test_name' => $name ,'listening_test_level' => $level, 'listening_test_category' => 'test' ]);

		if( $res->num_rows() ) {

			$this->_msg('warning','Name is exist');

		} else {

			$object = array(
				'listening_test_name'       => $name, 
				'listening_test_level'      => $level, 
				'listening_test_category'   => 'test', 
				'listening_test_point_pass' => $point, 
				'listening_test_start'      => $start.' '.$time, 
				'listening_test_finish'     => date('Y-m-d H:i:s', strtotime($start.' '.$time) + ($duration * 60 )), 
				'listening_test_add'        => date('Y-m-d H:i:s'), 
				'listening_test_status'     => 'new',
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

		$level = $this->db->get_where('listening_test', ['listening_test_id' => $id ])->row()->listening_test_level;

		$where = array(
			'listening_test_level'    => $level, 
			'listening_test_category' => 'practice',
			'teacher_id'              => $this->session->userdata('__ci_teacherid')
		);

		$data['qw_listening_test'] = $this->db->order_by('listening_test_add','desc')
									   ->get_where('listening_test', $where);							   


		$data['title'] = 'E-Lab';

		$data['inc']  = $this->load->view('teacher/test/listening/question', $data, TRUE);

		$this->load->view('teacher/inc', $data , FALSE);
	}

	public function listening_question_input($id)
	{
		$data['qw_audio'] = $this->db->get_where('media', ['media_type' => 'audio']);

		$data['title'] = 'E-Lab';

		$data['inc']  = $this->load->view('teacher/test/listening/question_input', $data, TRUE);

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

		$data['inc']  = $this->load->view('teacher/test/listening/question_view', $data, TRUE);

		$this->load->view('teacher/inc', $data , FALSE);
	}

	public function listening_student($id)
	{
		$this->load->model('Model_main', 'main');
		
		$data['test'] = $this->db->get_where('listening_test', ['listening_test_id' => $id])->row();

		$where = array(
			'kelas.kelas_level'              => $data['test']->listening_test_level,
			'kelas.teacher_id'               => $this->session->userdata('__ci_teacherid'),
			'listening_answer.listening_test_id' => $id
		);

		$data['qw_student'] = $this->db->select('student.student_id, student.student_name')
		                              ->join('kelompok','kelompok.student_id = listening_answer.student_id','left')
		                              ->join('kelas','kelas.kelas_id = kelompok.kelas_id','left')
		                              ->join('student','student.student_id = kelompok.student_id','left')
									  ->group_by('listening_answer.student_id')
							   		  ->get_where('listening_answer', $where);

		$data['qw_student2'] = $this->db->join('kelas','kelas.kelas_id = kelompok.kelas_id','left')
										->join('student','student.student_id = kelompok.student_id','left')
										->get_where('kelompok', ['kelas.kelas_level' => $data['test']->reading_test_level, 'kelas.teacher_id' => $this->session->userdata('__ci_teacherid')]);


		$data['qw_student_id'] = array();

		foreach ($data['qw_student']->result() as $i  ) {
			
			$data['qw_student_id'][] = $i->student_id;

		}

		// Pie
		$data['qw_pass']     = 0;
		$data['qw_not_pass'] = 0;

		foreach ($data['qw_student']->result() as $st) {
			
			if( $this->main->student_table_point( 'listening', $st->student_id ) >= $data['test']->listening_test_point_pass ) {
				$data['qw_pass']++;
			} else {
				$data['qw_not_pass']++;
			}
		}

		$data['title'] = 'E-Lab';

		$data['inc']  = $this->load->view('teacher/test/listening/student', $data, TRUE);

		$this->load->view('teacher/inc', $data , FALSE);
	}

	public function listening_student_add($id)
	{
		$array_student_id = $this->input->post('student_id');

		$sub_test_id = $this->db->select('listening_sub_test_id')->get_where('listening_sub_test', ['listening_test_id' => $id]);

		if( $sub_test_id->num_rows() == 0 ) {

			$this->_msg('warning','Fail to add because nothing test question');

			redirect( $this->input->server('HTTP_REFERER') );

			exit();
		}

		$object = array();

		for( $a=0; $a<count($array_student_id); $a++ ) {

			foreach( $sub_test_id->result() as $b ) {

				$object[] = array(
					'listening_sub_test_id' => $b->listening_sub_test_id , 
					'listening_test_id' => $id , 
					'student_id' => $array_student_id[$a] 
				);

			}


		}

		if( $this->db->insert_batch('listening_answer', $object) ) {

			$this->_msg('success','Success to add');

		} else {

			$this->_msg('warning','Fail to add');

		}

		redirect( $this->input->server('HTTP_REFERER') );
		
	}

	public function listening_student_del($id, $student_id)
	{
		$where = array(
			'listening_test_id' => $id , 
			'student_id'      => $student_id 
		);

		if( $this->db->where($where)->delete('listening_answer') ) {

			$this->_msg('success','Success to delete');

		} else {

			$this->_msg('warning','Fail to delete');

		}

		redirect( $this->input->server('HTTP_REFERER') );
	}

	public function listening_student_view($id, $student_id)
	{
		$where = array(
			'listening_test.listening_test_id'    => $id,
			'listening_test.teacher_id'         => $this->session->userdata('__ci_teacherid')
		);

		$data['qw_listening_sub_test'] = $this->db->join('listening_test','listening_test.listening_test_id = listening_sub_test.listening_test_id','right')
									   ->order_by('listening_sub_test_id','asc')
									   ->get_where('listening_sub_test', $where);

		$data['qw_correct']   = $this->db->get_where('listening_answer', ['listening_test_id' => $id, 'student_id' => $student_id, 'listening_answer_correct' => 'true'])->num_rows();

		$data['qw_incorrect'] = $this->db->get_where('listening_answer', ['listening_test_id' => $id, 'student_id' => $student_id, 'listening_answer_correct' => 'false'])->num_rows();

		$data['qw_point']     = $this->db->select_sum('listening_sub_test_point')->join('listening_sub_test','listening_sub_test.listening_sub_test_id = listening_answer.listening_sub_test_id','left')
										 ->get_where('listening_answer', ['listening_answer.listening_test_id' => $id, 'listening_answer.student_id' => $student_id, 'listening_answer_correct' => 'true'])->row()->listening_sub_test_point;

		$data['title'] = 'E-Lab';

		$data['inc']  = $this->load->view('teacher/test/listening/student_view', $data, TRUE);

		$this->load->view('teacher/inc', $data , FALSE);
	}

	public function listening_play($id)
	{
		$object = array('listening_test_status' => 'pending' );

		if( $this->db->where('listening_test_id', $id)->update('listening_test', $object) ) {

			$this->_msg('success','Success to update');

		} else {

			$this->_msg('warning','Fail to update');

		}

		redirect( $this->input->server('HTTP_REFERER') );

	}

	public function listening_police($id)
	{

		$data['qw_listening_test'] = $this->db->get_where('listening_test', ['listening_test_id' => $id])->row();

		$data['title'] = 'E-Lab';

		$data['inc']  = $this->load->view('teacher/test/listening/police', $data, TRUE);

		$this->load->view('teacher/inc', $data , FALSE);
	}

	public function listening_update_police($id)
	{
		$police = $this->input->post('police');

		$object = array('listening_test_police' => $police );

		if( $this->db->where('listening_test_id', $id)->update('listening_test', $object) ) {

			$this->_msg('success','Success to update');

		} else {

			$this->_msg('warning','Fail to update');

		}

		redirect( $this->input->server('HTTP_REFERER') );
	}





	# Speaking

	public function speaking($level)
	{
		if( $this->input->get('status') ) {

			$array = array(
				'speaking_test_status' => $this->input->get('status')
			);
			
			$this->session->set_userdata( $array );

		}

		$where = array(
			'speaking_test_level'    => $level, 
			'speaking_test_category' => 'test',
			'teacher_id'            => $this->session->userdata('__ci_teacherid')
		);

		if( $this->session->userdata('speaking_test_status') ){
			$data['status']             = $this->session->userdata('speaking_test_status');
			if( $this->session->userdata('speaking_test_status') != 'all' ){
				$where['speaking_test_status'] = $this->session->userdata('speaking_test_status');
			}
		}else{
			$data['status']                = 'new';
			$where['speaking_test_status'] = 'new';
		}

		$data['qw_speaking_test'] = $this->db->order_by('speaking_test_add','desc')
									   ->get_where('speaking_test', $where);

		$data['title'] = 'E-Lab';

		$data['inc']  = $this->load->view('teacher/test/speaking/home', $data, TRUE);

		$this->load->view('teacher/inc', $data , FALSE);
	}

	public function speaking_add($level)
	{
		$name       = $this->input->post('name');
		$point      = $this->input->post('point');
		$start      = $this->input->post('start');
		$time       = $this->input->post('time');
		$duration   = $this->input->post('duration');
		$teacher_id = $this->session->userdata('__ci_teacherid');

		$res  = $this->db->get_where('speaking_test', ['speaking_test_name' => $name ,'speaking_test_level' => $level, 'speaking_test_category' => 'test' ]);

		if( $res->num_rows() ) {

			$this->_msg('warning','Name is exist');

		} else {

			$object = array(
				'speaking_test_name'       => $name, 
				'speaking_test_level'      => $level, 
				'speaking_test_category'   => 'test', 
				'speaking_test_point_pass' => $point, 
				'speaking_test_start'      => $start.' '.$time, 
				'speaking_test_finish'     => date('Y-m-d H:i:s', strtotime($start.' '.$time) + ($duration * 60 )), 
				'speaking_test_add'        => date('Y-m-d H:i:s'), 
				'speaking_test_status'     => 'new',
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
			'speaking_test.speaking_test_id'   => $id,
			'speaking_test.teacher_id'         => $this->session->userdata('__ci_teacherid')
		);

		$data['qw_point_total'] = $this->db->select_sum('speaking_sub_test.speaking_sub_test_point')
		                                   ->join('speaking_test','speaking_test.speaking_test_id = speaking_sub_test.speaking_test_id','right')
									       ->get_where('speaking_sub_test', $where)->row()->speaking_sub_test_point;

		$data['qw_speaking_sub_test'] = $this->db->join('speaking_test','speaking_test.speaking_test_id = speaking_sub_test.speaking_test_id','right')
									   ->order_by('speaking_sub_test_id','asc')
									   ->get_where('speaking_sub_test', $where);

		$level = $this->db->get_where('speaking_test', ['speaking_test_id' => $id ])->row()->speaking_test_level;

		$where = array(
			'speaking_test_level'    => $level, 
			'speaking_test_category' => 'practice',
			'teacher_id'              => $this->session->userdata('__ci_teacherid')
		);

		$data['qw_speaking_test'] = $this->db->order_by('speaking_test_add','desc')
									   ->get_where('speaking_test', $where);


		$data['title'] = 'E-Lab';

		$data['inc']  = $this->load->view('teacher/test/speaking/question', $data, TRUE);

		$this->load->view('teacher/inc', $data , FALSE);
	}

	public function speaking_question_input($id)
	{

		$data['qw_audio'] = $this->db->get_where('media', ['media_type' => 'audio']);

		$data['title'] = 'E-Lab';

		$data['inc']  = $this->load->view('teacher/test/speaking/question_input', $data, TRUE);

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

		$data['inc']  = $this->load->view('teacher/test/speaking/question_view', $data, TRUE);

		$this->load->view('teacher/inc', $data , FALSE);
	}

	public function speaking_student($id)
	{
		$this->load->model('Model_main', 'main');

		$data['test'] = $this->db->get_where('speaking_test', ['speaking_test_id' => $id])->row();

		$where = array(
			'kelas.kelas_level'              => $data['test']->speaking_test_level,
			'kelas.teacher_id'               => $this->session->userdata('__ci_teacherid'),
			'speaking_answer.speaking_test_id' => $id
		);

		$data['qw_student'] = $this->db->select('student.student_id, student.student_name')
		                              ->join('kelompok','kelompok.student_id = speaking_answer.student_id','left')
		                              ->join('kelas','kelas.kelas_id = kelompok.kelas_id','left')
		                              ->join('student','student.student_id = kelompok.student_id','left')
									  ->group_by('speaking_answer.student_id')
							   		  ->get_where('speaking_answer', $where);

		$data['qw_student2'] = $this->db->join('kelas','kelas.kelas_id = kelompok.kelas_id','left')
										->join('student','student.student_id = kelompok.student_id','left')
										->get_where('kelompok', ['kelas.kelas_level' => $data['test']->reading_test_level, 'kelas.teacher_id' => $this->session->userdata('__ci_teacherid')]);

		$data['qw_student_id'] = array();

		foreach ($data['qw_student']->result() as $i  ) {
			
			$data['qw_student_id'][] = $i->student_id;

		}

		// Pie
		$data['qw_pass']     = 0;
		$data['qw_not_pass'] = 0;

		foreach ($data['qw_student']->result() as $st) {
			
			if( $this->main->student_table_point( 'speaking', $st->student_id ) >= $data['test']->speaking_test_point_pass ) {
				$data['qw_pass']++;
			} else {
				$data['qw_not_pass']++;
			}
		}

		$data['title'] = 'E-Lab';

		$data['inc']  = $this->load->view('teacher/test/speaking/student', $data, TRUE);

		$this->load->view('teacher/inc', $data , FALSE);
	}

	public function speaking_student_add($id)
	{
		$array_student_id = $this->input->post('student_id');

		$sub_test_id = $this->db->select('speaking_sub_test_id')->get_where('speaking_sub_test', ['speaking_test_id' => $id]);

		if( $sub_test_id->num_rows() == 0 ) {

			$this->_msg('warning','Fail to add because nothing test question');

			redirect( $this->input->server('HTTP_REFERER') );

			exit();
		}

		$object = array();

		for( $a=0; $a<count($array_student_id); $a++ ) {

			foreach( $sub_test_id->result() as $b ) {

				$object[] = array(
					'speaking_sub_test_id' => $b->speaking_sub_test_id , 
					'speaking_test_id' => $id , 
					'student_id' => $array_student_id[$a] 
				);

			}


		}

		if( $this->db->insert_batch('speaking_answer', $object) ) {

			$this->_msg('success','Success to add');

		} else {

			$this->_msg('warning','Fail to add');

		}

		redirect( $this->input->server('HTTP_REFERER') );
		
	}

	public function speaking_student_del($id, $student_id)
	{
		$where = array(
			'speaking_test_id' => $id , 
			'student_id'      => $student_id 
		);

		if( $this->db->where($where)->delete('speaking_answer') ) {

			$this->_msg('success','Success to delete');

		} else {

			$this->_msg('warning','Fail to delete');

		}

		redirect( $this->input->server('HTTP_REFERER') );
	}

	public function speaking_student_view($id, $student_id)
	{
		$where = array(
			'speaking_test.speaking_test_id'    => $id,
			'speaking_test.teacher_id'         => $this->session->userdata('__ci_teacherid')
		);

		$data['qw_speaking_sub_test'] = $this->db->join('speaking_test','speaking_test.speaking_test_id = speaking_sub_test.speaking_test_id','right')
									   ->order_by('speaking_sub_test_id','asc')
									   ->get_where('speaking_sub_test', $where);

		$data['qw_correct']   = $this->db->get_where('speaking_answer', ['speaking_test_id' => $id, 'student_id' => $student_id, 'speaking_answer_correct' => 'true'])->num_rows();

		$data['qw_incorrect'] = $this->db->get_where('speaking_answer', ['speaking_test_id' => $id, 'student_id' => $student_id, 'speaking_answer_correct' => 'false'])->num_rows();

		$data['qw_point']     = $this->db->select_sum('speaking_sub_test_point')->join('speaking_sub_test','speaking_sub_test.speaking_sub_test_id = speaking_answer.speaking_sub_test_id','left')
										 ->get_where('speaking_answer', ['speaking_answer.speaking_test_id' => $id, 'speaking_answer.student_id' => $student_id, 'speaking_answer_correct' => 'true'])->row()->speaking_sub_test_point;

		$data['title'] = 'E-Lab';

		$data['inc']  = $this->load->view('teacher/test/speaking/student_view', $data, TRUE);

		$this->load->view('teacher/inc', $data , FALSE);
	}

	public function speaking_student_correct($id, $student_id, $status)
	{
		$where = array(
			'speaking_sub_test_id' => $id , 
			'student_id'           => $student_id 
		);

		if( $this->db->where($where)->update('speaking_answer', ['speaking_answer_correct' => $status]) ) {

			$this->_msg('success','Success to update');

		} else {

			$this->_msg('warning','Fail to update');

		}

		redirect( $this->input->server('HTTP_REFERER') );
	}

	public function speaking_play($id)
	{
		$object = array('speaking_test_status' => 'pending' );

		if( $this->db->where('speaking_test_id', $id)->update('speaking_test', $object) ) {

			$this->_msg('success','Success to update');

		} else {

			$this->_msg('warning','Fail to update');

		}

		redirect( $this->input->server('HTTP_REFERER') );

	}

	public function speaking_police($id)
	{

		$data['qw_speaking_test'] = $this->db->get_where('speaking_test', ['speaking_test_id' => $id])->row();

		$data['title'] = 'E-Lab';

		$data['inc']  = $this->load->view('teacher/test/speaking/police', $data, TRUE);

		$this->load->view('teacher/inc', $data , FALSE);
	}

	public function speaking_update_police($id)
	{
		$police = $this->input->post('police');

		$object = array('speaking_test_police' => $police );

		if( $this->db->where('speaking_test_id', $id)->update('speaking_test', $object) ) {

			$this->_msg('success','Success to update');

		} else {

			$this->_msg('warning','Fail to update');

		}

		redirect( $this->input->server('HTTP_REFERER') );
	}

	public function speaking_get_from_practice($test_id, $test_id_from_practice)
	{
		if( $this->db->get_where('speaking_sub_test', ['speaking_test_id' => $test_id])->num_rows() ) {

			$this->db->where('speaking_test_id', $test_id)->delete('speaking_sub_test');

		}

		$qw_sub_test = $this->db->get_where('speaking_sub_test', ['speaking_test_id' => $test_id_from_practice]);

		$object = array();

		foreach ($qw_sub_test->result() as $row) {
			$object[] = array(
				'speaking_sub_test_intro'    => $row->speaking_sub_test_intro,
				'speaking_sub_test_question' => $row->speaking_sub_test_question,
				'speaking_sub_test_answer'   => $row->speaking_sub_test_answer,
				'speaking_sub_test_point'    => $row->speaking_sub_test_point,
				'speaking_test_id'           => $test_id
			);
		}

		if( $this->db->insert_batch('speaking_sub_test', $object) ) {

			$this->_msg('success','Success to add');

		} else {

			$this->_msg('warning','Fail to add');

		}

		redirect( $this->input->server('HTTP_REFERER') );
	}

}

/* End of file Test.php */
/* Location: ./application/modules/member/controllers/Test.php */