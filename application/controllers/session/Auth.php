<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once 'Inc.php';

class Auth extends Inc {

	public function index()
	{
		$data['title'] = 'Login | E-Lab';
		$this->load->view('login', $data , FALSE);
	}

	public function checking()
	{
		$email    = $this->input->post('email');
		$password = md5($this->input->post('password'));


		$student = $this->db->get_where('student', ['student_email' => $email, 'student_password' => $password]);
		$teacher = $this->db->get_where('teacher', ['teacher_email' => $email, 'teacher_password' => $password]);
		$contributor = $this->db->get_where('contributor', ['contributor_email' => $email, 'contributor_password' => $password]);

		if( $student->num_rows() == 1 ) {

			$s = $student->row();

			$array = array(
				'__ci_studentid'    => $s->student_id,
				'__ci_studentemail' => $s->student_email,
				'__ci_studentname'  => $s->student_name,
				'__ci_studentlevel' => $s->student_level,
				'__ci_teacherid'    => $s->teacher_id
				
			);
			
			$this->session->set_userdata( $array );

			redirect( base_url().'student/dashboard' );

		} elseif( $teacher->num_rows() == 1 ){

			$s = $teacher->row();

			$array = array(
				'__ci_teacherid'    => $s->teacher_id,
				'__ci_teacheremail' => $s->teacher_email,
				'__ci_teachername'  => $s->teacher_name
				
			);
			
			$this->session->set_userdata( $array );

			redirect( base_url().'teacher/dashboard' );

		} elseif( $contributor->num_rows() == 1 ){

			$s = $contributor->row();

			$array = array(
				'__ci_contributorid'    => $s->contributor_id,
				'__ci_contributoremail' => $s->contributor_email,
				'__ci_contributorname'  => $s->contributor_name
				
			);
			
			$this->session->set_userdata( $array );

			redirect( base_url().'contributor/dashboard' );

		} else {
			
			$this->_msg('warning','Account not found');

			redirect( base_url().'session/auth' );
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();

		redirect( base_url().'session/auth' );
	}

}

/* End of file Auth.php */
/* Location: ./application/modules/siswa/controllers/Auth.php */