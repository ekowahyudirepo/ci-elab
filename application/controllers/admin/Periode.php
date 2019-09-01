<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once 'inc.php';

class Periode extends Inc {

	public function __construct()
	{
		parent::__construct();

		$this->has_login();
	}

	public function index()
	{

		$data['qw_periode'] = $this->db->order_by('periode_year','desc')->get('periode');

		$data['title'] = 'Periode | E-Lab';
		$data['inc']  = $this->load->view('admin/periode/home', $data, TRUE);
		$this->load->view('admin/inc', $data , FALSE);
	}

	public function add()
	{
		$name   = $this->input->post('name');
		$note   = $this->input->post('note');
		$year   = $this->input->post('year');
		$status = 'new';

		$data = array(
			'periode_name'   => $name  ,
			'periode_note'   => $note  , 
			'periode_year'   => $year  , 
			'periode_status' => $status 
		);

		if( $this->db->get_where('periode', ['periode_name' => $name, 'periode_year' => $year] )->num_rows() == 0 ) {

			if( $this->db->insert('periode', $data) ) {

				$this->_msg('success', 'Success to add');

			} else {

				$this->_msg('warning', 'Failed to add');

			}

		} else {
			
			$this->_msg('warning', 'Periode is exist');

		}

		redirect( $this->input->server('HTTP_REFERER') );
	}

	public function update_status($id)
	{
		if( $this->db->get_where('periode', ['periode_status' => 'open'])->num_rows() ){

			$this->_msg('warning', 'Peride open is exist');

			redirect( $this->input->server('HTTP_REFERER') );

			die();

		}

		$status = $this->input->get('status');

		if( $this->db->where('periode_id', $id)->update('periode', ['periode_status' => $status]) ) {

			$this->_msg('success', ' Success to update');

		} else {

			$this->_msg('warning', 'Failed to update');

		}

		redirect( $this->input->server('HTTP_REFERER') );
	}

	public function del($id)
	{
		if( $this->db->where('periode_id', $id)->delete('periode') ) {

			$this->_msg('success', ' Success to delete');

		} else {

			$this->_msg('warning', 'Failed to delete');

		}

		redirect( $this->input->server('HTTP_REFERER') );
	}


}

/* End of file Periode.php */
/* Location: ./application/modules/member/controllers/Periode.php */