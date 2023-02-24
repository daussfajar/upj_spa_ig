<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PIC extends CI_Controller {

    private $data = [];

	function __construct(){
        parent::__construct();
        $this->Global_model->is_logged_in();
        $this->load->model('IG/Hibah_model');
		$this->Global_model->is_finance();
    }

    public function set_pic(){
        $this->form_validation->set_rules('id', 'ID', 'trim|required', [
			'required' => '%s tidak boleh kosong.'
		]);
        $this->form_validation->set_rules('pic', 'PIC', 'trim|required', [
			'required' => '%s tidak boleh kosong.'
		]);

		if($this->form_validation->run() === TRUE){

            $id = $this->input->post('id', true);
            $decrypt_id = decrypt($id);
            $pic = $this->input->post('pic', true);

            $this->db->where('id', $decrypt_id);
            $this->db->update('ig_tbl_uraian', [
                'pic' => $pic
            ]);

            $this->session->set_flashdata('alert', [
				'message' => 'Selamat anda berhasil set pic.',
				'type'    => 'success',	
				'title'   => ''
			]);
			return redirect($_SERVER['HTTP_REFERER']);
        } else {
            $error = [
				'form_error' => validation_errors_array()
			];
			$this->session->set_flashdata('error_validation', $error);				
			return redirect($_SERVER['HTTP_REFERER']);
        }
    }
}
