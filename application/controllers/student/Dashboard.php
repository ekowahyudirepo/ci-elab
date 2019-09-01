<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once 'Inc.php';

class Dashboard extends Inc {

	public function index()
	{

		$this->load->model('Model_main', 'main');

		$data['student_point'] = $this->main->student_point( $this->session->userdata('__ci_studentid'));

		$data['qw_jadwal']   = array();
		$data['qw_reading']   = array();
		$data['qw_grammer']   = array();
		$data['qw_listening'] = array();
		$data['qw_speaking']  = array();

		$qw_jadwal_reading   = $this->db->get_where('reading_test', ['reading_test_status' => 'pending', 'teacher_id' => $this->session->userdata('__ci_teacherid')]);
		$qw_jadwal_grammer   = $this->db->get_where('grammer_test', ['grammer_test_status' => 'pending', 'teacher_id' => $this->session->userdata('__ci_teacherid')]);
		$qw_jadwal_listening = $this->db->get_where('listening_test', ['listening_test_status' => 'pending', 'teacher_id' => $this->session->userdata('__ci_teacherid')]);
		$qw_jadwal_speaking  = $this->db->get_where('speaking_test', ['speaking_test_status' => 'pending', 'teacher_id' => $this->session->userdata('__ci_teacherid')]);

		foreach ($qw_jadwal_reading->result() as $r ) {
			$data['qw_reading']['title']     = $r->reading_test_name;
			$data['qw_reading']['start']     = $r->reading_test_start;
			$data['qw_reading']['end']       = $r->reading_test_finish;
			$data['qw_reading']['className'] = 'bg-info';
		}

		foreach ($qw_jadwal_grammer->result() as $g ) {
			$data['qw_grammer']['title']     = $g->grammer_test_name;
			$data['qw_grammer']['start']     = $g->grammer_test_start;
			$data['qw_grammer']['end']       = $g->grammer_test_finish;
			$data['qw_grammer']['className'] = 'bg-primary';
		}

		foreach ($qw_jadwal_listening->result() as $l ) {
			$data['qw_listening']['title']     = $l->listening_test_name;
			$data['qw_listening']['start']     = $l->listening_test_start;
			$data['qw_listening']['end']       = $l->listening_test_finish;
			$data['qw_listening']['className'] = 'bg-success';
		}

		foreach ($qw_jadwal_speaking->result() as $s ) {
			$data['qw_speaking']['title']     = $s->speaking_test_name;
			$data['qw_speaking']['start']     = $s->speaking_test_start;
			$data['qw_speaking']['end']       = $s->speaking_test_finish;
			$data['qw_speaking']['className'] = 'bg-danger';
		}

		if( count($data['qw_reading']) ){
			array_push($data['qw_jadwal'], $data['qw_reading']);
		}

		if( count($data['qw_grammer']) ){
			array_push($data['qw_jadwal'], $data['qw_grammer']);
		}

		if( count($data['qw_listening']) ){
			array_push($data['qw_jadwal'], $data['qw_listening']);
		}

		if( count($data['qw_speaking']) ){
			array_push($data['qw_jadwal'], $data['qw_speaking']);
		}


		$data['title'] = 'E-Lab';

		$data['inc']  = $this->load->view('student/dashboard/home', $data, TRUE);

		$this->load->view('student/inc', $data , FALSE);
	}

}

/* End of file Dashboard.php */
/* Location: ./application/modules/member/controllers/Dashboard.php */