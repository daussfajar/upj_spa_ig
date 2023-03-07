<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Approval extends CI_Controller{

    function __construct(){
        parent::__construct();
        $this->load->model('SPA/Approval_model', 'm_approval');
        $this->Global_model->is_logged_in();
        header("X-XSS-Protection: 1; mode=block");
    }

    public function index(){
        return show_404();
    }

    // START Approval Warek 1
    public function approval_warek_1($id = null){
        if($id == null){
            $session = $this->session->userdata('user_sessions');
            $year = date('Y');
            $data['approval_actbud'] = $this->m_approval->get_actbud_approval_warek1($year);

            return view('spa.approval.approval-warek1', $data);
        } else {
            $data['kd_act'] = $id;
            $data['actbud'] = $this->m_approval->get_actbud(array('a.kd_act' => $id));
            if(!empty($data['actbud'])){
                $data['unit']       = $this->db->query('SELECT nama_unit FROM tbl_unit WHERE kode_unit=?', array($data['actbud'][0]['kode_unit']))->row_array();
                $data['nm']         = $this->db->query('SELECT * FROM tbl_karyawan WHERE nik=?', array($data['actbud'][0]['pelaksana']))->row_array();
                $data['upload_act'] = $this->db->query('SELECT * FROM tbl_upload_act WHERE kd_act=?', array($id))->result_array();
                $data['t_j_b_act']  = $this->db->query('SELECT * FROM t_j_b_act WHERE kd_act=?', array($id))->result_array();
                $data['chat']       = $this->db->query('SELECT * FROM tbl_chat a LEFT JOIN tbl_karyawan b on a.nik=b.nik WHERE a.kd_act=?', array($id))->result_array();
    
                return view('spa.approval.detail-approval-warek1', $data);
            } else {
                show_404();
            }
        }
    }
    
    public function kirim_catatan_warek_1(){
        $this->form_validation->set_rules('id', 'Data Detail Biaya', 'trim|required', [
			'required' => '%s tidak boleh kosong'
		]);
        $this->form_validation->set_rules('catatan', 'Catatan', 'trim|required', [
			'required' => '%s tidak boleh kosong'
		]);
		if($this->form_validation->run() === TRUE){
            $queryUpdate = $this->db->update('t_j_b_act', array('c_jns_b_wr1' => $this->input->post('catatan')), array('id' => $this->input->post('id')));
            if($queryUpdate){
                $this->session->set_flashdata('alert', [
                    'message' => 'Berhasil beri catatan',
                    'type'    => 'success',	
                    'title'   => ''
                ]);
            } else {
                $this->session->set_flashdata('alert', [
                    'message' => 'Gagal beri catatan',
                    'type'    => 'error',	
                    'title'   => ''
                ]);
            }
            return redirect($_SERVER['HTTP_REFERER']);
        } else {
            $error = [
				'form_error' => validation_errors_array()
			];
			$this->session->set_flashdata('error_validation', $error);
            return redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function kirim_persetujuan_warek_1($id){
        $this->form_validation->set_rules('st_warek_1', 'Persetujuan Actbud', 'trim|required', [
			'required' => '%s tidak boleh kosong'
		]);
        $this->form_validation->set_rules('catatan', 'Catatan', 'trim|required', [
			'required' => '%s tidak boleh kosong'
		]);
		if($this->form_validation->run() === TRUE){
            $dataUpdate = array(
                            'st_warek_1' => $this->input->post('st_warek_1'),
                            'c_warek1' => $this->input->post('catatan'),
                            'stamp_warek1' => date('d-m-Y H:i:s')
                        );
            $queryUpdate = $this->db->update('tbl_actbud', $dataUpdate, array('kd_act' => decrypt($id)));
            if($queryUpdate){
                $this->session->set_flashdata('alert', [
                    'message' => 'Terima Kasih Telah Melakukan Persetujuan Kegiatan ini',
                    'type'    => 'success',	
                    'title'   => ''
                ]);
                return redirect(base_url('app/sim-spa/approval/warek1'));
            } else {
                $this->session->set_flashdata('alert', [
                    'message' => 'Gagal melakukan persetujuan kegiatan ini',
                    'type'    => 'error',	
                    'title'   => ''
                ]);
                return redirect($_SERVER['HTTP_REFERER']);
            }
        } else {
            $error = [
				'form_error' => validation_errors_array()
			];
			$this->session->set_flashdata('error_validation', $error);
            return redirect($_SERVER['HTTP_REFERER']);
        }
    }
    // END Approval Warek 1

    // START Approval Warek 2
    public function approval_warek_2($id = null){
        if($id == null){
            $session = $this->session->userdata('user_sessions');
            $year = date('Y');
            $year = 2021;
            $data['approval_actbud'] = $this->m_approval->get_actbud_approval_warek2($year);

            return view('spa.approval.approval-warek2', $data);
        } else {
            $data['kd_act'] = $id;
            $data['actbud'] = $this->m_approval->get_actbud(array('a.kd_act' => $id));
            if(!empty($data['actbud'])){
                $data['unit']       = $this->db->query('SELECT nama_unit FROM tbl_unit WHERE kode_unit=?', array($data['actbud'][0]['kode_unit']))->row_array();
                $data['nm']         = $this->db->query('SELECT * FROM tbl_karyawan WHERE nik=?', array($data['actbud'][0]['pelaksana']))->row_array();
                $data['upload_act'] = $this->db->query('SELECT * FROM tbl_upload_act WHERE kd_act=?', array($id))->result_array();
                $data['t_j_b_act']  = $this->db->query('SELECT * FROM t_j_b_act WHERE kd_act=?', array($id))->result_array();
                $data['chat']       = $this->db->query('SELECT * FROM tbl_chat a LEFT JOIN tbl_karyawan b on a.nik=b.nik WHERE a.kd_act=?', array($id))->result_array();
    
                return view('spa.approval.detail-approval-warek2', $data);
            } else {
                show_404();
            }
        }
    }
    
    public function kirim_catatan_warek_2(){
        $this->form_validation->set_rules('id', 'Data Detail Biaya', 'trim|required', [
			'required' => '%s tidak boleh kosong'
		]);
        $this->form_validation->set_rules('catatan', 'Catatan', 'trim|required', [
			'required' => '%s tidak boleh kosong'
		]);
		if($this->form_validation->run() === TRUE){
            $queryUpdate = $this->db->update('t_j_b_act', array('c_jns_b_wr2' => $this->input->post('catatan')), array('id' => $this->input->post('id')));
            if($queryUpdate){
                $this->session->set_flashdata('alert', [
                    'message' => 'Berhasil beri catatan',
                    'type'    => 'success',	
                    'title'   => ''
                ]);
            } else {
                $this->session->set_flashdata('alert', [
                    'message' => 'Gagal beri catatan',
                    'type'    => 'error',	
                    'title'   => ''
                ]);
            }
            return redirect($_SERVER['HTTP_REFERER']);
        } else {
            $error = [
				'form_error' => validation_errors_array()
			];
			$this->session->set_flashdata('error_validation', $error);
            return redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function kirim_persetujuan_warek_2($id){
        $this->form_validation->set_rules('st_warek_2', 'Persetujuan Actbud', 'trim|required', [
			'required' => '%s tidak boleh kosong'
		]);
        $this->form_validation->set_rules('catatan', 'Catatan', 'trim|required', [
			'required' => '%s tidak boleh kosong'
		]);
		if($this->form_validation->run() === TRUE){
            $dataUpdate = array(
                            'st_warek_2' => $this->input->post('st_warek_2'),
                            'c_warek2' => $this->input->post('catatan'),
                            'stamp_warek2' => date('d-m-Y H:i:s')
                        );
            $queryUpdate = $this->db->update('tbl_actbud', $dataUpdate, array('kd_act' => decrypt($id)));
            if($queryUpdate){
                $this->session->set_flashdata('alert', [
                    'message' => 'Terima Kasih Telah Melakukan Persetujuan Kegiatan ini',
                    'type'    => 'success',	
                    'title'   => ''
                ]);
                return redirect(base_url('app/sim-spa/approval/warek2'));
            } else {
                $this->session->set_flashdata('alert', [
                    'message' => 'Gagal melakukan persetujuan kegiatan ini',
                    'type'    => 'error',	
                    'title'   => ''
                ]);
                return redirect($_SERVER['HTTP_REFERER']);
            }
        } else {
            $error = [
				'form_error' => validation_errors_array()
			];
			$this->session->set_flashdata('error_validation', $error);
            return redirect($_SERVER['HTTP_REFERER']);
        }
    }
    // END Approval Warek 2

    public function kirim_pesan($id){
        $this->form_validation->set_rules('nik', 'Data Pengirim', 'trim|required', [
			'required' => '%s tidak boleh kosong'
		]);
        $this->form_validation->set_rules('pesan', 'Pesan', 'trim|required', [
			'required' => '%s tidak boleh kosong'
		]);
		if($this->form_validation->run() === TRUE){
            $dataInsert = array(
                                'kd_act' => decrypt($id),
                                'nik' => decrypt($this->input->post('nik')),
                                'pesan' => $this->input->post('pesan')
                            );
            $queryInsert = $this->db->insert('tbl_chat', $dataInsert);
            if($queryInsert){
                $this->session->set_flashdata('alert', [
                    'message' => 'Berhasil mengirim pesan',
                    'type'    => 'success',	
                    'title'   => ''
                ]);
            } else {
                $this->session->set_flashdata('alert', [
                    'message' => 'Gagal mengirim pesan',
                    'type'    => 'error',	
                    'title'   => ''
                ]);
            }
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
?>