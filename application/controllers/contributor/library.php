<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once 'Inc.php';

class Library extends Inc {

	public function index($category='reading')
	{
		$data['qw_reading_num'] = $this->db->get_where('library', [ 'actor_id' => $this->session->userdata('__ci_contributorid'),  'library_actor' => 'contributor', 'library_category' => 'reading'])->num_rows();
		$data['qw_grammar_num'] = $this->db->get_where('library', [ 'actor_id' => $this->session->userdata('__ci_contributorid'),  'library_actor' => 'contributor', 'library_category' => 'grammar'])->num_rows();
		$data['qw_listening_num']   = $this->db->get_where('library', [ 'actor_id' => $this->session->userdata('__ci_contributorid'),  'library_actor' => 'contributor', 'library_category' => 'listening'])->num_rows();
		$data['qw_speaking_num']   = $this->db->get_where('library', [ 'actor_id' => $this->session->userdata('__ci_contributorid'),  'library_actor' => 'contributor', 'library_category' => 'speaking'])->num_rows();

		$data['qw_library'] = $this->db->get_where('library', [ 'actor_id' => $this->session->userdata('__ci_contributorid'), 'library_actor' => 'contributor' , 'library_category' => $category] );

		$data['title'] = 'E-Lab';

		$data['inc']  = $this->load->view('contributor/library/home', $data, TRUE);

		$this->load->view('contributor/inc', $data , FALSE);
	}

	public function add($category)
	{

		$name     = $this->input->post('name');
		$level    = $this->input->post('level');
		$dir      = $this->input->post('dir');

		$object = array(
			'library_name'     => $name , 
			'library_category' => $category , 
			'library_level'    => $level , 
			'library_dir'      => $dir ,  
			'library_actor'    => 'contributor' ,
			'library_actor_name'    => $this->session->userdata('__ci_contributorname'),   
			'library_add'      => date('Y-m-d H:i:s') , 
			'actor_id'       => $this->session->userdata('__ci_contributorid') 
		);

		if( $this->db->insert('library', $object) ) {

			$this->_msg('success','Success to add');

		} else {

			$this->_msg('warning','Fail to add');

		}
		

		redirect( $this->input->server('HTTP_REFERER') );
	}

	public function del($id)
	{

		if( $this->db->where('library_id', $id)->delete('library') ) {

			$this->_msg('success','Success to delete data');

		} else {

			$this->_msg('warning','Fail to delete data');

		}

		redirect( $this->input->server('HTTP_REFERER') );
	}

}

/* End of file Library.php */
/* Location: ./application/modules/member/controllers/Library.php */