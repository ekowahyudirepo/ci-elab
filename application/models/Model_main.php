<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_main extends CI_Model {

	public function student_table_point($table, $id, $test_id = null)
	{	
		$where = array(
			''.$table.'_answer.'.$table.'_answer_correct' => 'true',
			''.$table.'_answer.student_id'                => $id
		);
		
		if( $test_id != null ) {
			$where[''.$table.'_answer.'.$table.'_test_id'] = $test_id;
		}

		$point = $this->db->select_sum(''.$table.'_sub_test.'.$table.'_sub_test_point')
								  ->join(''.$table.'_test',''.$table.'_test.'.$table.'_test_id = '.$table.'_answer.'.$table.'_test_id','left')
								  ->join(''.$table.'_sub_test',''.$table.'_sub_test.'.$table.'_sub_test_id = '.$table.'_answer.'.$table.'_sub_test_id','left')
								  ->get_where(''.$table.'_answer', $where);

		if( $point->row_array()[''.$table.'_sub_test_point'] == null ) {
			return 0;
		} else {
			return $point->row_array()[''.$table.'_sub_test_point'];
		}

	}


	public function student_point($id)
	{
		$reading   = $this->student_table_point('reading', $id);
		$grammer   = $this->student_table_point('grammer', $id);
		$listening = $this->student_table_point('listening', $id);
		$speaking  = $this->student_table_point('speaking', $id);

		return $reading + $grammer + $listening + $speaking;
	}

	public function kelas_terisi($capacity, $id)
	{
		return $capacity - $this->db->get_where('kelompok', ['kelas_id' => $id])->num_rows();
	}

}

/* End of file Model_main.php */
/* Location: ./application/models/Model_main.php */