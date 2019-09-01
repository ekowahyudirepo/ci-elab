<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inc extends CI_Controller {

    public $test_status = 'false';
    public $test_link   = '';
    public $test_finish = '';
    public $test_table  = '';
    public $test_id     = '';


	public function __construct()
	{
		parent::__construct();

		date_default_timezone_set('Asia/Jakarta');

                $this->has_login();

                $this->load->helper('format');

                if( $this->session->userdata('__ci_studentid') ) {

                        $test = $this->db->get_where('test', ['test_status' => 'start']);

                        if( $test->num_rows() ) {
                        
                                $this->test_table = $test->row()->test_table;

            
                                $where = array(
                                        ''.$this->test_table.'_answer.student_id'          => $this->session->userdata('__ci_studentid'),
                                        ''.$this->test_table.'_test.'.$this->test_table.'_test_status' => 'start',
                                        ''.$this->test_table.'_test.'.$this->test_table.'_test_category' => 'test'
                                );

                                $test_status = $this->db->join(''.$this->test_table.'_test',''.$this->test_table.'_test.'.$this->test_table.'_test_id = '.$this->test_table.'_answer.'.$this->test_table.'_test_id','left')
                                         ->group_by(''.$this->test_table.'_answer.student_id')
                                         ->get_where(''.$this->test_table.'_answer', $where );

                                if( $test_status->num_rows() == 1 ) {
                                        $this->test_status = 'true';
                                        $this->test_link   = base_url().'student/test/'.$this->test_table.'_police/'.$test_status->row_array()[$this->test_table.'_test_id'];
                                        $this->test_finish = date('M d, Y H:i:s', strtotime($test_status->row_array()[$this->test_table.'_test_finish']));

                                        $this->test_id = $test_status->row_array()[$this->test_table.'_test_id'];
                                }
                        }                        

                }
	}

	public function _msg($type, $message)
	{
		return $this->session->set_flashdata('message', '<div class="alert alert-'.$type.'"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>'.$message.'</div>');
	}

        public function has_login()
        {
                if( ! $this->session->userdata('__ci_studentid') ) {

                        $this->_msg('warning','You Must Login');

                        redirect( base_url().'session/auth' );
                }
        }

	public function _send_email( $to, $from, $subject, $message )
	{
		$this->load->library('email');

                $config['protocol'] = "smtp";
                $config['smtp_host'] = "mail.jombangdev.com";
                $config['smtp_port'] = "587";
                $config['smtp_user'] = "qurbanapp@jombangdev.com";
                $config['smtp_pass'] = "qurbanapp";
                $config['charset'] = "utf-8";
                $config['mailtype'] = "html";
                $config['newline'] = "\r\n";
                
                $this->email->initialize($config);
                $this->email->to($to);
                $this->email->from($from,'no_reply.qurbanapp@jombangdev.com');
                $this->email->subject($subject);
                $this->email->message($message);
                
                return $this->email->send();

	}

}

/* End of file Inc.php */
/* Location: ./application/controllers/admin/Inc.php */