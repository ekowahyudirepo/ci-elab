<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		date_default_timezone_set('Asia/Jakarta');

	}

	public function update()
	{
		$this->find('reading');
		$this->find('grammer');
		$this->find('listening');
		$this->find('speaking');
	}

	public function find($table)
	{
		$find = $this->db->select( $table.'_test_id as id')->get_where( $table.'_test', [ $table.'_test_status' => 'pending', $table.'_test_start <= ' => date('Y-m-d H:i:s'), $table.'_test_finish >= ' => date('Y-m-d H:i:s') ]);

		if( $find->num_rows() ) {

			$start = $this->db->where( [ $table.'_test_status' => 'pending', $table.'_test_start <= ' => date('Y-m-d H:i:s'), $table.'_test_finish >= ' => date('Y-m-d H:i:s') ])->update( $table.'_test', [ $table.'_test_status' => 'start' ] );

			if ( $start ) {

				$object = array(
					'test_table' => $table , 
					'test_status' => 'start' , 
					'test_table_test_id' => $find->row()->id 
				);

				$this->db->insert('test', $object);
			}
		}

		

		$this->db->where( [ $table.'_test_status' => 'pending', $table.'_test_start <= ' => date('Y-m-d H:i:s'), $table.'_test_finish <= ' => date('Y-m-d H:i:s') ])->update( $table.'_test', [ $table.'_test_status' => 'finish' ] );
	}

}