<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once 'Inc.php';

class Media extends Inc {

	public function index($type='image')
	{
		$data['qw_image_num'] = $this->db->get_where('media', [ 'teacher_id' => $this->session->userdata('__ci_teacherid'), 'media_type' => 'image'])->num_rows();
		$data['qw_audio_num'] = $this->db->get_where('media', [ 'teacher_id' => $this->session->userdata('__ci_teacherid'), 'media_type' => 'audio'])->num_rows();
		$data['qw_doc_num']   = $this->db->get_where('media', [ 'teacher_id' => $this->session->userdata('__ci_teacherid'), 'media_type' => 'doc'])->num_rows();
		$data['qw_xls_num']   = $this->db->get_where('media', [ 'teacher_id' => $this->session->userdata('__ci_teacherid'), 'media_type' => 'xls'])->num_rows();
		$data['qw_pdf_num']   = $this->db->get_where('media', [ 'teacher_id' => $this->session->userdata('__ci_teacherid'), 'media_type' => 'pdf'])->num_rows();
		$data['qw_zip_num']   = $this->db->get_where('media', [ 'teacher_id' => $this->session->userdata('__ci_teacherid'), 'media_type' => 'zip'])->num_rows();

		$data['qw_media'] = $this->db->get_where('media', ['teacher_id' => $this->session->userdata('__ci_teacherid'), 'media_type' => $type] );

		$data['title'] = 'E-Lab';

		$data['inc']  = $this->load->view('teacher/media/home', $data, TRUE);

		$this->load->view('teacher/inc', $data , FALSE);
	}

	public function add($type)
	{

		$name = $this->input->post('name');

		$allowed_types = '';

		switch ($type) {
			case 'image':
				$allowed_types = 'jpg|png';
				break;
			case 'doc':
				$allowed_types = 'doc|docx';
				break;
			case 'xls':
				$allowed_types = 'xls|xlsx';
				break;
			case 'pdf':
				$allowed_types = 'pdf';
				break;
			case 'zip':
				$allowed_types = 'zip';
				break;
			case 'audio':
				$allowed_types = 'mp3';
				break;
			
			default:
				# code...
				break;
		}

		$config['upload_path'] = './media/'.$type.'/';
		$config['allowed_types'] = $allowed_types;
		$config['max_size']  = '2000';
		
		$this->load->library('upload', $config);
		
		if ( ! $this->upload->do_upload('file')){

			$this->_msg('warning','Fail to add becouse ' . $this->upload->display_errors());

		}
		else{

			$object = array(
				'media_name' => $name , 
				'media_type' => $type , 
				'media_file_name' => $this->upload->data('file_name') , 
				'media_dir'  => base_url().'media/'.$type.'/'.$this->upload->data('file_name') , 
				'media_add'  => date('Y-m-d H:i:s') , 
				'teacher_id' => $this->session->userdata('__ci_teacherid') 
			);

			if( $this->db->insert('media', $object) ) {

				$this->_msg('success','Success to add');

			} else {

				$this->_msg('warning','Fail to add');

				@unlink('./media/'.$type.'/'.$this->upload->data('file_name').'');

			}
		}

		redirect( $this->input->server('HTTP_REFERER') );
	}

	public function del($id)
	{

		$res = $this->db->get_where('media', ['media_id' => $id])->row();

		if( @unlink('./media/'.$res->media_type.'/'.$res->media_file_name.'') ) {

			if( $this->db->where('media_id', $id)->delete('media') ) {

				$this->_msg('success','Success to delete data');

			} else {

				$this->_msg('warning','Fail to delete data');

			}

		} else {

			$this->_msg('warning','Fail to delete file');

		}
		redirect( $this->input->server('HTTP_REFERER') );
	}

}

/* End of file Media.php */
/* Location: ./application/modules/member/controllers/Media.php */