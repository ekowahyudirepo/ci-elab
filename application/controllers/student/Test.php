<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once 'Inc.php';

class Test extends Inc {

	public function index()
	{
		$data['qw_teacher'] = $this->db->get_where('teacher', ['teacher_id' => 1])->row(); 						             							            
		$data['title'] = 'E-Lab';

		$data['inc']  = $this->load->view('student/test', $data, TRUE);

		$this->load->view('student/inc', $data , FALSE);
	}

	# Reading

	public function reading()
	{
		if( $this->input->get('status') ) {

			$array = array(
				'reading_test_status' => $this->input->get('status')
			);
			
			$this->session->set_userdata( $array );

		}

		$where = array(
			'reading_answer.student_id'          => $this->session->userdata('__ci_studentid'), 
			'reading_test.reading_test_level'    => $this->session->userdata('__ci_studentlevel'), 
			'reading_test.reading_test_category' => 'test',
			'reading_test.teacher_id'            => $this->session->userdata('__ci_teacherid')
		);

		if( $this->session->userdata('reading_test_status') ){
			$data['status']                   = $this->session->userdata('reading_test_status');

			if( $this->session->userdata('reading_test_status') != 'all' ){
				$where['reading_test.reading_test_status'] = $this->session->userdata('reading_test_status');
			}

		}else{
			$data['status']                            = 'pending';
			$where['reading_test.reading_test_status'] = 'pending';
		}

		$data['qw_reading_test'] = $this->db->order_by('reading_test.reading_test_add','desc')
										->group_by('reading_answer.student_id')
										->join('reading_answer','reading_answer.reading_test_id = reading_test.reading_test_id','left')
									    ->get_where('reading_test', $where);

		$data['title'] = 'E-Lab';

		$data['inc']  = $this->load->view('student/test/reading/home', $data, TRUE);

		$this->load->view('student/inc', $data , FALSE);
	}

	public function reading_question_view($id)
	{
		if( $this->test_status == 'false' ){

			$this->_msg('warning','Fail to access');

			redirect( base_url().'student/test/reading' );

			die();
		}

		$data['qw_submit'] = 'false';

		$where = array(
			'reading_test.reading_test_id'    => $id,
			'reading_test.teacher_id'         => $this->session->userdata('__ci_teacherid')
		);

		$data['qw_reading_sub_test'] = $this->db->join('reading_test','reading_test.reading_test_id = reading_sub_test.reading_test_id','right')
									   ->order_by('reading_sub_test_id','asc')
									   ->get_where('reading_sub_test', $where);

		if( $this->input->post('submit') ){

			foreach( $data['qw_reading_sub_test']->result() as $a ) {

				$where_point = array(
					'reading_sub_test_id' => $a->reading_sub_test_id ,
					'student_id'          => $this->session->userdata('__ci_studentid'), 
					'reading_test_id'     => $id 
				);

				$where_update = array(
					'reading_answer_choose' => $this->input->post('choose'.$a->reading_sub_test_id)
				);

				if( $this->input->post('choose'.$a->reading_sub_test_id) == $a->reading_sub_test_answer ) {

					$where_update['reading_answer_correct'] = 'true';

				} else {

					$where_update['reading_answer_correct'] = 'false';

				}


				$this->db->where($where_point)->update('reading_answer', $where_update);

			}

			redirect( base_url().'student/test/reading' );

		}

		$data['title'] = 'E-Lab';

		$data['inc']  = $this->load->view('student/test/reading/question_view', $data, TRUE);

		$this->load->view('student/inc', $data , FALSE);
	}

	public function reading_answer_view($id)
	{

		$where = array(
			'reading_test.reading_test_id'    => $id,
			'reading_test.teacher_id'         => $this->session->userdata('__ci_teacherid')
		);

		$data['qw_reading_sub_test'] = $this->db->join('reading_test','reading_test.reading_test_id = reading_sub_test.reading_test_id','right')
									   ->order_by('reading_sub_test_id','asc')
									   ->get_where('reading_sub_test', $where);


		$where2 = array(
			'reading_answer.reading_test_id' => $id , 
			'reading_answer.student_id'      => $this->session->userdata('__ci_studentid')
		);

		$data['qw_reading_answer']   = $this->db->join('reading_test','reading_test.reading_test_id = reading_answer.reading_test_id','right')
												->join('reading_sub_test','reading_sub_test.reading_sub_test_id = reading_answer.reading_sub_test_id','right')
												->get_where('reading_answer', $where2);


		$data['qw_submit'] = 'true';

		$data['qw_answer']  = array();

		$data['qw_correct'] = array();

		$data['qw_point'] = 0;

		foreach( $data['qw_reading_answer']->result() as $a ) {

			$data['qw_answer'][]  = $a->reading_answer_choose;


			$data['qw_correct'][] = $a->reading_sub_test_answer;

			if( $a->reading_answer_choose == $a->reading_sub_test_answer ) {

				$data['qw_point'] += $a->reading_sub_test_point;

			}

		}
		
		$data['qw_point_pass'] = ( $data['qw_point'] >= $data['qw_reading_sub_test']->row()->reading_test_point_pass )? 'Pass' : 'Not pass';

		$data['title'] = 'E-Lab';

		$data['inc']  = $this->load->view('student/test/reading/answer_view', $data, TRUE);

		$this->load->view('student/inc', $data , FALSE);
	}

	public function reading_question_finish($id)
	{

		if( $this->db->where('reading_test_id', $id)->update('reading_test', ['reading_test_status' => 'finish'] ) ) {

			$this->db->where(['test_table_test_id' => $id, 'test_table' => 'reading'])->delete('test');

			$this->_msg('success','Success to update');

		} else {

			$this->_msg('warning','Fail to update');

		}

		redirect( base_url().'student/test/reading' );
	}

	public function reading_police($id)
	{
		$data['qw_reading_test'] = $this->db->get_where('reading_test', ['reading_test_id' => $id])->row();

		$data['title'] = 'E-Lab';

		$data['inc']  = $this->load->view('student/test/reading/police', $data, TRUE);

		$this->load->view('student/inc', $data , FALSE);
	}







	
	# Grammer

	public function grammer()
	{
		if( $this->input->get('status') ) {

			$array = array(
				'grammer_test_status' => $this->input->get('status')
			);
			
			$this->session->set_userdata( $array );

		}

		$where = array(
			'grammer_answer.student_id'          => $this->session->userdata('__ci_studentid'), 
			'grammer_test.grammer_test_level'    => $this->session->userdata('__ci_studentlevel'), 
			'grammer_test.grammer_test_category' => 'test',
			'grammer_test.teacher_id'            => $this->session->userdata('__ci_teacherid')
		);

		if( $this->session->userdata('grammer_test_status') ){
			$data['status']                   = $this->session->userdata('grammer_test_status');

			if( $this->session->userdata('grammer_test_status') != 'all' ){
				$where['grammer_test.grammer_test_status'] = $this->session->userdata('grammer_test_status');
			}

		}else{
			$data['status']                            = 'pending';
			$where['grammer_test.grammer_test_status'] = 'pending';
		}

		$data['qw_grammer_test'] = $this->db->order_by('grammer_test.grammer_test_add','desc')
										->group_by('grammer_answer.student_id')
										->join('grammer_answer','grammer_answer.grammer_test_id = grammer_test.grammer_test_id','left')
									    ->get_where('grammer_test', $where);

		$data['title'] = 'E-Lab';

		$data['inc']  = $this->load->view('student/test/grammer/home', $data, TRUE);

		$this->load->view('student/inc', $data , FALSE);
	}

	public function grammer_question_view($id)
	{
		if( $this->test_status == 'false' ){

			$this->_msg('warning','Fail to access');

			redirect( base_url().'student/test/grammer' );

			die();
		}

		$data['qw_submit'] = 'false';

		$where = array(
			'grammer_test.grammer_test_id'    => $id,
			'grammer_test.teacher_id'         => $this->session->userdata('__ci_teacherid')
		);

		$data['qw_grammer_sub_test'] = $this->db->join('grammer_test','grammer_test.grammer_test_id = grammer_sub_test.grammer_test_id','right')
									   ->order_by('grammer_sub_test_id','asc')
									   ->get_where('grammer_sub_test', $where);

		if( $this->input->post('submit') ){

			foreach( $data['qw_grammer_sub_test']->result() as $a ) {

				$where_point = array(
					'grammer_sub_test_id' => $a->grammer_sub_test_id ,
					'student_id'          => $this->session->userdata('__ci_studentid'), 
					'grammer_test_id'     => $id 
				);

				$where_update = array(
					'grammer_answer_choose' => $this->input->post('choose'.$a->grammer_sub_test_id)
				);

				if( $this->input->post('choose'.$a->grammer_sub_test_id) == $a->grammer_sub_test_answer ) {

					$where_update['grammer_answer_correct'] = 'true';

				} else {

					$where_update['grammer_answer_correct'] = 'false';

				}


				$this->db->where($where_point)->update('grammer_answer', $where_update);

			}

			redirect( base_url().'student/test/grammer' );

		}

		$data['title'] = 'E-Lab';

		$data['inc']  = $this->load->view('student/test/grammer/question_view', $data, TRUE);

		$this->load->view('student/inc', $data , FALSE);
	}

	public function grammer_answer_view($id)
	{

		$where = array(
			'grammer_test.grammer_test_id'    => $id,
			'grammer_test.teacher_id'         => $this->session->userdata('__ci_teacherid')
		);

		$data['qw_grammer_sub_test'] = $this->db->join('grammer_test','grammer_test.grammer_test_id = grammer_sub_test.grammer_test_id','right')
									   ->order_by('grammer_sub_test_id','asc')
									   ->get_where('grammer_sub_test', $where);


		$where2 = array(
			'grammer_answer.grammer_test_id' => $id , 
			'grammer_answer.student_id'      => $this->session->userdata('__ci_studentid')
		);

		$data['qw_grammer_answer']   = $this->db->join('grammer_test','grammer_test.grammer_test_id = grammer_answer.grammer_test_id','right')
												->join('grammer_sub_test','grammer_sub_test.grammer_sub_test_id = grammer_answer.grammer_sub_test_id','right')
												->get_where('grammer_answer', $where2);


		$data['qw_submit'] = 'true';

		$data['qw_answer']  = array();

		$data['qw_correct'] = array();

		$data['qw_point'] = 0;

		foreach( $data['qw_grammer_answer']->result() as $a ) {

			$data['qw_answer'][]  = $a->grammer_answer_choose;


			$data['qw_correct'][] = $a->grammer_sub_test_answer;

			if( $a->grammer_answer_choose == $a->grammer_sub_test_answer ) {

				$data['qw_point'] += $a->grammer_sub_test_point;

			}

		}
		
		$data['qw_point_pass'] = ( $data['qw_point'] >= $data['qw_grammer_sub_test']->row()->grammer_test_point_pass )? 'Pass' : 'Not pass';

		$data['title'] = 'E-Lab';

		$data['inc']  = $this->load->view('student/test/grammer/answer_view', $data, TRUE);

		$this->load->view('student/inc', $data , FALSE);
	}

	public function grammer_question_finish($id)
	{

		if( $this->db->where('grammer_test_id', $id)->update('grammer_test', ['grammer_test_status' => 'finish'] ) ) {

			$this->db->where(['test_table_test_id' => $id, 'test_table' => 'grammer'])->delete('test');

			$this->_msg('success','Success to update');

		} else {

			$this->_msg('warning','Fail to update');

		}

		redirect( base_url().'student/test/grammer' );
	}

	public function grammer_police($id)
	{
		$data['qw_grammer_test'] = $this->db->get_where('grammer_test', ['grammer_test_id' => $id])->row();

		$data['title'] = 'E-Lab';

		$data['inc']  = $this->load->view('student/test/grammer/police', $data, TRUE);

		$this->load->view('student/inc', $data , FALSE);
	}




	# Listening

	public function listening()
	{
		if( $this->input->get('status') ) {

			$array = array(
				'listening_test_status' => $this->input->get('status')
			);
			
			$this->session->set_userdata( $array );

		}

		$where = array(
			'listening_answer.student_id'          => $this->session->userdata('__ci_studentid'), 
			'listening_test.listening_test_level'    => $this->session->userdata('__ci_studentlevel'), 
			'listening_test.listening_test_category' => 'test',
			'listening_test.teacher_id'            => $this->session->userdata('__ci_teacherid')
		);

		if( $this->session->userdata('listening_test_status') ){
			$data['status']                   = $this->session->userdata('listening_test_status');

			if( $this->session->userdata('listening_test_status') != 'all' ){
				$where['listening_test.listening_test_status'] = $this->session->userdata('listening_test_status');
			}

		}else{
			$data['status']                            = 'pending';
			$where['listening_test.listening_test_status'] = 'pending';
		}

		$data['qw_listening_test'] = $this->db->order_by('listening_test.listening_test_add','desc')
										->group_by('listening_answer.student_id')
										->join('listening_answer','listening_answer.listening_test_id = listening_test.listening_test_id','left')
									    ->get_where('listening_test', $where);

		$data['title'] = 'E-Lab';

		$data['inc']  = $this->load->view('student/test/listening/home', $data, TRUE);

		$this->load->view('student/inc', $data , FALSE);
	}

	public function listening_question_view($id)
	{
		if( $this->test_status == 'false' ){

			$this->_msg('warning','Fail to access');

			redirect( base_url().'student/test/listening' );

			die();
		}

		$data['qw_submit'] = 'false';

		$where = array(
			'listening_test.listening_test_id'    => $id,
			'listening_test.teacher_id'         => $this->session->userdata('__ci_teacherid')
		);

		$data['qw_listening_sub_test'] = $this->db->join('listening_test','listening_test.listening_test_id = listening_sub_test.listening_test_id','right')
									   ->order_by('listening_sub_test_id','asc')
									   ->get_where('listening_sub_test', $where);

		if( $this->input->post('submit') ){

			foreach( $data['qw_listening_sub_test']->result() as $a ) {

				$where_point = array(
					'listening_sub_test_id' => $a->listening_sub_test_id ,
					'student_id'          => $this->session->userdata('__ci_studentid'), 
					'listening_test_id'     => $id 
				);

				$where_update = array(
					'listening_answer_choose' => $this->input->post('choose'.$a->listening_sub_test_id)
				);

				if( $this->input->post('choose'.$a->listening_sub_test_id) == $a->listening_sub_test_answer ) {

					$where_update['listening_answer_correct'] = 'true';

				} else {

					$where_update['listening_answer_correct'] = 'false';

				}


				$this->db->where($where_point)->update('listening_answer', $where_update);

			}

			redirect( base_url().'student/test/listening' );

		}

		$data['title'] = 'E-Lab';

		$data['inc']  = $this->load->view('student/test/listening/question_view', $data, TRUE);

		$this->load->view('student/inc', $data , FALSE);
	}

	public function listening_answer_view($id)
	{

		$where = array(
			'listening_test.listening_test_id'    => $id,
			'listening_test.teacher_id'         => $this->session->userdata('__ci_teacherid')
		);

		$data['qw_listening_sub_test'] = $this->db->join('listening_test','listening_test.listening_test_id = listening_sub_test.listening_test_id','right')
									   ->order_by('listening_sub_test_id','asc')
									   ->get_where('listening_sub_test', $where);


		$where2 = array(
			'listening_answer.listening_test_id' => $id , 
			'listening_answer.student_id'      => $this->session->userdata('__ci_studentid')
		);

		$data['qw_listening_answer']   = $this->db->join('listening_test','listening_test.listening_test_id = listening_answer.listening_test_id','right')
												->join('listening_sub_test','listening_sub_test.listening_sub_test_id = listening_answer.listening_sub_test_id','right')
												->get_where('listening_answer', $where2);


		$data['qw_submit'] = 'true';

		$data['qw_answer']  = array();

		$data['qw_correct'] = array();

		$data['qw_point'] = 0;

		foreach( $data['qw_listening_answer']->result() as $a ) {

			$data['qw_answer'][]  = $a->listening_answer_choose;


			$data['qw_correct'][] = $a->listening_sub_test_answer;

			if( $a->listening_answer_choose == $a->listening_sub_test_answer ) {

				$data['qw_point'] += $a->listening_sub_test_point;

			}

		}
		
		$data['qw_point_pass'] = ( $data['qw_point'] >= $data['qw_listening_sub_test']->row()->listening_test_point_pass )? 'Pass' : 'Not pass';

		$data['title'] = 'E-Lab';

		$data['inc']  = $this->load->view('student/test/listening/answer_view', $data, TRUE);

		$this->load->view('student/inc', $data , FALSE);
	}

	public function listening_question_finish($id)
	{

		if( $this->db->where('listening_test_id', $id)->update('listening_test', ['listening_test_status' => 'finish'] ) ) {

			$this->db->where(['test_table_test_id' => $id, 'test_table' => 'listening'])->delete('test');

			$this->_msg('success','Success to update');

		} else {

			$this->_msg('warning','Fail to update');

		}

		redirect( base_url().'student/test/listening' );
	}

	public function listening_police($id)
	{
		$data['qw_listening_test'] = $this->db->get_where('listening_test', ['listening_test_id' => $id])->row();

		$data['title'] = 'E-Lab';

		$data['inc']  = $this->load->view('student/test/listening/police', $data, TRUE);

		$this->load->view('student/inc', $data , FALSE);
	}




	# Speaking

	public function speaking()
	{
		if( $this->input->get('status') ) {

			$array = array(
				'speaking_test_status' => $this->input->get('status')
			);
			
			$this->session->set_userdata( $array );

		}

		$where = array(
			'speaking_answer.student_id'          => $this->session->userdata('__ci_studentid'), 
			'speaking_test.speaking_test_level'    => $this->session->userdata('__ci_studentlevel'), 
			'speaking_test.speaking_test_category' => 'test',
			'speaking_test.teacher_id'            => $this->session->userdata('__ci_teacherid')
		);

		if( $this->session->userdata('speaking_test_status') ){
			$data['status']                   = $this->session->userdata('speaking_test_status');

			if( $this->session->userdata('speaking_test_status') != 'all' ){
				$where['speaking_test.speaking_test_status'] = $this->session->userdata('speaking_test_status');
			}

		}else{
			$data['status']                            = 'pending';
			$where['speaking_test.speaking_test_status'] = 'pending';
		}

		$data['qw_speaking_test'] = $this->db->order_by('speaking_test.speaking_test_add','desc')
										->group_by('speaking_answer.student_id')
										->join('speaking_answer','speaking_answer.speaking_test_id = speaking_test.speaking_test_id','left')
									    ->get_where('speaking_test', $where);

		$data['title'] = 'E-Lab';

		$data['inc']  = $this->load->view('student/test/speaking/home', $data, TRUE);

		$this->load->view('student/inc', $data , FALSE);
	}

	public function speaking_question_view($id)
	{
		if( $this->test_status == 'false' ){

			$this->_msg('warning','Fail to access');

			redirect( base_url().'student/test/speaking' );

			die();
		}

		$data['qw_submit'] = 'false';

		$where = array(
			'speaking_test.speaking_test_id'    => $id,
			'speaking_test.teacher_id'         => $this->session->userdata('__ci_teacherid')
		);

		$data['qw_speaking_sub_test'] = $this->db->join('speaking_test','speaking_test.speaking_test_id = speaking_sub_test.speaking_test_id','right')
									   ->order_by('speaking_sub_test_id','asc')
									   ->get_where('speaking_sub_test', $where);

		if( $this->input->post('submit') ){

			foreach( $data['qw_speaking_sub_test']->result() as $a ) {

				$where_point = array(
					'speaking_sub_test_id' => $a->speaking_sub_test_id ,
					'student_id'          => $this->session->userdata('__ci_studentid'), 
					'speaking_test_id'     => $id 
				);

				$where_update = array(
					'speaking_answer_choose' => $this->input->post('choose'.$a->speaking_sub_test_id),
					'speaking_answer_correct' => ''
				);

				$this->db->where($where_point)->update('speaking_answer', $where_update);

			}

			redirect( base_url().'student/test/speaking' );

		}

		$data['title'] = 'E-Lab';

		$data['inc']  = $this->load->view('student/test/speaking/question_view', $data, TRUE);

		$this->load->view('student/inc', $data , FALSE);
	}

	public function speaking_answer_view($id)
	{

		$where = array(
			'speaking_test.speaking_test_id'    => $id,
			'speaking_test.teacher_id'         => $this->session->userdata('__ci_teacherid')
		);

		$data['qw_speaking_sub_test'] = $this->db->join('speaking_test','speaking_test.speaking_test_id = speaking_sub_test.speaking_test_id','right')
									   ->order_by('speaking_sub_test_id','asc')
									   ->get_where('speaking_sub_test', $where);


		$where2 = array(
			'speaking_answer.speaking_test_id' => $id , 
			'speaking_answer.student_id'      => $this->session->userdata('__ci_studentid')
		);

		$data['qw_speaking_answer']   = $this->db->join('speaking_test','speaking_test.speaking_test_id = speaking_answer.speaking_test_id','right')
												->join('speaking_sub_test','speaking_sub_test.speaking_sub_test_id = speaking_answer.speaking_sub_test_id','right')
												->get_where('speaking_answer', $where2);


		$data['qw_submit'] = 'true';

		$data['qw_answer']  = array();

		$data['qw_correct'] = array();

		$data['qw_point'] = 0;

		foreach( $data['qw_speaking_answer']->result() as $a ) {

			$data['qw_answer'][]  = $a->speaking_answer_choose;


			$data['qw_correct'][] = $a->speaking_sub_test_answer;

			if( $a->speaking_answer_correct == 'true' ) {

				$data['qw_point'] += $a->speaking_sub_test_point;

			}

		}
		
		$data['qw_point_pass'] = ( $data['qw_point'] >= $data['qw_speaking_sub_test']->row()->speaking_test_point_pass )? 'Pass' : 'Not pass';

		$data['title'] = 'E-Lab';

		$data['inc']  = $this->load->view('student/test/speaking/answer_view', $data, TRUE);

		$this->load->view('student/inc', $data , FALSE);
	}

	public function speaking_question_finish($id)
	{

		if( $this->db->where('speaking_test_id', $id)->update('speaking_test', ['speaking_test_status' => 'finish'] ) ) {

			$this->db->where(['test_table_test_id' => $id, 'test_table' => 'speaking'])->delete('test');

			$this->_msg('success','Success to update');

		} else {

			$this->_msg('warning','Fail to update');

		}

		redirect( base_url().'student/test/speaking' );
	}

	public function speaking_police($id)
	{
		$data['qw_speaking_test'] = $this->db->get_where('speaking_test', ['speaking_test_id' => $id])->row();

		$data['title'] = 'E-Lab';

		$data['inc']  = $this->load->view('student/test/speaking/police', $data, TRUE);

		$this->load->view('student/inc', $data , FALSE);
	}

	public function speaking_student_answer($id)
	{
		$size   = $_FILES['audio_data']['size']; //the size in bytes
		$input  = $_FILES['audio_data']['tmp_name']; //temporary name that PHP gave to the uploaded file
		$output = $_FILES['audio_data']['name'].".wav";
		$output = date('Y-m-dHis').'.mp3'; //letting the client control the filename is a rather bad idea

		//move the file from temp name to local folder using $output name
		if( move_uploaded_file($input, "./media/test/speaking/".$output) ) {

			$where = array(
				'speaking_answer_id'     => $id  
			);

			$object = array(
				'speaking_answer_choose' => base_url()."media/test/speaking/".$output."" , 
			);

			if( $this->db->where($where)->update('speaking_answer', $object) ) {
				echo "success";
			} else {
				echo "fail";
				@unlink("./media/test/speaking/".$output);
			}

		} else {
			echo "failed";
		}
	}

	public function speaking_student_answer_del($id)
	{
		$choose = $this->db->get_where('speaking_answer', ['speaking_answer_id' => $id])->row()->speaking_answer_choose;
		$dir = str_replace(base_url(), '', './'.$choose);

		if( unlink($dir) ) {

			$where = array(
				'speaking_answer_id'     => $id  
			);

			$object = array(
				'speaking_answer_choose' => null , 
			);

			if( $this->db->where($where)->update('speaking_answer', $object) ) {

				$this->_msg('success','Success to delete');

			} else {

				$this->_msg('warning','Fail to delete');
			}
		} else {
			$this->_msg('warning','Fail to delete file');
		}

		redirect( $this->input->server('HTTP_REFERER') );
	}

}

/* End of file Test.php */
/* Location: ./application/modules/member/controllers/Test.php */