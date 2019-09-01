<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once 'Inc.php';

class Library extends Inc {

	public function index($category='reading')
	{
		$data['qw_reading_num'] = $this->db->get_where('library', [ 'library_level' => $this->session->userdata('__ci_studentlevel') ,'library_category' => 'reading'])->num_rows();
		$data['qw_grammar_num'] = $this->db->get_where('library', [ 'library_level' => $this->session->userdata('__ci_studentlevel') ,'library_category' => 'grammar'])->num_rows();
		$data['qw_listening_num']   = $this->db->get_where('library', [ 'library_level' => $this->session->userdata('__ci_studentlevel') ,'library_category' => 'listening'])->num_rows();
		$data['qw_speaking_num']   = $this->db->get_where('library', [ 'library_level' => $this->session->userdata('__ci_studentlevel') ,'library_category' => 'speaking'])->num_rows();

		$data['qw_library'] = $this->db->get_where('library', [ 'library_level' => $this->session->userdata('__ci_studentlevel') ,'library_category' => $category] );

		$data['title'] = 'E-Lab';

		$data['inc']  = $this->load->view('student/library/home', $data, TRUE);

		$this->load->view('student/inc', $data , FALSE);
	}

}

/* End of file Library.php */
/* Location: ./application/modules/member/controllers/Library.php */