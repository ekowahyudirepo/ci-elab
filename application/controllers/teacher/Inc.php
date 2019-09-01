<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inc extends CI_Controller {


	public function __construct()
	{
		parent::__construct();

		date_default_timezone_set('Asia/Jakarta');

                $this->has_login();

                $this->load->helper('format');
	}

	public function _msg($type, $message)
	{
		return $this->session->set_flashdata('message', '<div class="alert alert-'.$type.'"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>'.$message.'</div>');
	}

        public function has_login()
        {
                if( ! $this->session->userdata('__ci_teacherid') ) {

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