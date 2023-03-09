<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Approval extends CI_Controller{

    var $year = 2022;

    function __construct(){
        parent::__construct();
        $this->load->model('SPA/Approval_model', 'm_approval');
        $this->Global_model->is_logged_in();
        header("X-XSS-Protection: 1; mode=block");
    }

    public function index(){
        return show_404();
    }

    public function v_kepala_unit(){
        $session = $this->session->userdata('user_sessions');
        $kode_unit = $session['kode_unit'];
        $this->Global_model->is_kabag($kode_unit);
        $data['approval_actbud'] = $this->m_approval->get_rkat_approval_kepala_unit($this->year, $kode_unit);
        
        return view('spa.approval.kepala-unit', $data);
    }

    public function v_detail_kepala_unit(int $id_actbud){
        $this->Global_model->is_access_approval_module();
        $this->load->model('SPA/RKAT_model', 'm_rkat');
        $method = $this->input->method();
        $session = $this->session->userdata('user_sessions');
        $nik = decrypt($session['nik']);
        $kode_unit = $session['kode_unit'];        
        $data['karyawan'] = $this->m_rkat->get_master_data_karyawan(array('kode_unit' => $session['kode_unit']));
        $data['rkat_master'] = $this->m_rkat->get_rkat_master(array('unit' => $session['kode_unit']))->row_array();
        $data['kode_rkat_master'] = $data['rkat_master']['kode_rkat_master'];
        $data['periode'] = 0;
        if ($data['rkat_master']['periode'] == "Ganjil") {
            $data['periode'] = '1';
        } else if ($data['rkat_master']['periode'] == "Genap") {
            $data['periode'] = '2';
        }

        $data['data'] = $this->m_rkat->get_detail_uraian($data['kode_rkat_master'], $data['periode'], ['a7.kd_act' => $id_actbud]);
        if (empty($data['data'])) return show_404();
        $data['id_uraian'] = $data['data']['kode_uraian'];
        $data['id_actbud'] = $id_actbud;
        $data['dokumen_pendukung'] = $this->m_rkat->get_act_dokumen_pendukung($id_actbud);
        $data['rincian_kegiatan'] = $this->m_rkat->get_tjb_act($id_actbud);
        $data['messages'] = $this->m_rkat->get_data_chat_actbud($id_actbud);
        
        if ($method == "post") {
            $act = $this->input->post('act', true);
            switch ($act) {
                case 'send_message':
                    return $this->buat_pesan($id_uraian, $id_actbud, $data['data']);
                    break;
                case 'hapus_pesan':
                    return $this->hapus_pesan($id_uraian, $id_actbud, $data['data']);
                    break;
                case 'hapus_pesan_reply':
                    return $this->hapus_pesan_reply($id_uraian, $id_actbud, $data['data']);
                    break;
                default:
                    return show_error("Bad Request", 400, "400 - Error");
                    break;
            }
        }        
        
        return view('spa.approval.detail.kepala-unit', $data);
    }

    public function v_pre_approval(){
        $this->Global_model->is_access_pre_approval_module();
        $session = $this->session->userdata('user_sessions');
        $kode_unit = $session['kode_unit'];
        $data['approval_actbud'] = $this->m_approval->get_rkat_approval_sign($this->year, $kode_unit);
        
        return view('spa.approval.approval-pre-approval', $data);
    }

    public function v_detail_pre_approval(int $id_actbud){
        $this->Global_model->is_access_pre_approval_module();
        $this->load->model('SPA/RKAT_model', 'm_rkat');
        $method = $this->input->method();
        $session = $this->session->userdata('user_sessions');
        $nik = decrypt($session['nik']);
        $kode_unit = $session['kode_unit'];
        $data['karyawan'] = $this->m_rkat->get_master_data_karyawan(array('kode_unit' => $session['kode_unit']));
        $data['rkat_master'] = $this->m_rkat->get_rkat_master(array('unit' => $session['kode_unit']))->row_array();
        $data['kode_rkat_master'] = $data['rkat_master']['kode_rkat_master'];
        $data['periode'] = 0;
        if ($data['rkat_master']['periode'] == "Ganjil") {
            $data['periode'] = '1';
        } else if ($data['rkat_master']['periode'] == "Genap") {
            $data['periode'] = '2';
        }

        $data['data'] = $this->m_rkat->get_detail_uraian($data['kode_rkat_master'], $data['periode'], ['a7.kd_act' => $id_actbud]);
        if (empty($data['data'])) return show_404();
        $data['id_uraian'] = $data['data']['kode_uraian'];
        $data['id_actbud'] = $id_actbud;
        $data['dokumen_pendukung'] = $this->m_rkat->get_act_dokumen_pendukung($id_actbud);
        $data['rincian_kegiatan'] = $this->m_rkat->get_tjb_act($id_actbud);
        $data['messages'] = $this->m_rkat->get_data_chat_actbud($id_actbud);

        if ($method == "post") {
            $act = $this->input->post('act', true);
            switch ($act) {
                case 'send_message':
                    return $this->buat_pesan($id_uraian, $id_actbud, $data['data']);
                    break;
                case 'hapus_pesan':
                    return $this->hapus_pesan($id_uraian, $id_actbud, $data['data']);
                    break;
                case 'hapus_pesan_reply':
                    return $this->hapus_pesan_reply($id_uraian, $id_actbud, $data['data']);
                    break;
                default:
                    return show_error("Bad Request", 400, "400 - Error");
                    break;
            }
        }

        return view('spa.approval.detail.pre-approval', $data);
    }

    public function kirim_persetujuan_sign($id){
        $this->form_validation->set_rules('approval', 'Persetujuan Actbud', 'trim|required', [
            'required' => '%s tidak boleh kosong'
        ]);
        
        if ($this->form_validation->run() === TRUE) {            
            $data_update = [];
            $approval = $this->input->post('approval', true);
            $catatan = $this->input->post('catatan', true);
            if ($approval == "Disetujui" || $approval == "Ditolak") {
                // return true
            } else return show_error("Bad Request", 400, "400 - Error");

            $session = $this->session->userdata('user_sessions');            
            $kode_unit = $session['kode_unit'];
            
            // JIKA ICT
            if($kode_unit == 004){
                $data_update['st_ict'] = ($approval == "Disetujui" ? "Disetujui ICT" : "Ditolak ICT");
                $data_update['c_ict'] = $catatan;
                $data_update['stamp_ict'] = date('d-m-Y H:i:s');
            } 
            // JIKA HRD
            else if($kode_unit == 006){
                $data_update['st_hrd'] = ($approval == "Disetujui" ? "Disetujui HRD" : "Ditolak HRD");
                $data_update['c_hrd'] = $catatan;
                $data_update['stamp_hrd'] = date('d-m-Y H:i:s');
            }
            // JIKA UMUM
            else if($kode_unit == 003){
                $data_update['st_umum'] = ($approval == "Disetujui" ? "Disetujui GA" : "Ditolak GA");
                $data_update['c_umum'] = $catatan;
                $data_update['stamp_umum'] = date('d-m-Y H:i:s');
            }
            // JIKA BKAL
            else if($kode_unit == 013){
                $data_update['st_bkal'] = ($approval == "Disetujui" ? "Disetujui BKAL" : "Ditolak BKAL");
                $data_update['c_bkal'] = $catatan;
                $data_update['stamp_bkal'] = date('d-m-Y H:i:s');
            }
            // JIKA P2M
            else if($kode_unit == 016){
                $data_update['st_p2m'] = ($approval == "Disetujui" ? "Disetujui ICT" : "Ditolak ICT");
                $data_update['c_p2m'] = $catatan;
                $data_update['stamp_p2m'] = date('d-m-Y H:i:s');
            }
            
            $queryUpdate = $this->db->update('tbl_actbud', $data_update, array('kd_act' => decrypt($id)));
            if ($queryUpdate) {
                $this->session->set_flashdata('alert', [
                    'message' => 'Terima Kasih Telah Melakukan Persetujuan Kegiatan ini',
                    'type'    => 'success',
                    'title'   => ''
                ]);
                return redirect($_SERVER['HTTP_REFERER']);
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

    public function kirim_persetujuan_kepala_unit($id)
    {
        $this->form_validation->set_rules('approval', 'Persetujuan Actbud', 'trim|required', [
            'required' => '%s tidak boleh kosong'
        ]);
        // $this->form_validation->set_rules('catatan', 'Catatan', 'trim|required', [
        //     'required' => '%s tidak boleh kosong'
        // ]);
        if ($this->form_validation->run() === TRUE) {
            $approval = $this->input->post('approval', true);
            if($approval == "Disetujui" || $approval == "Ditolak"){
                // return true
            } else return show_error("Bad Request", 400, "400 - Error");

            $dataUpdate = array(
                'st_kabag' => $approval,
                'c_kabag' => $this->input->post('catatan', true),
                'stamp_kabag' => date('d-m-Y H:i:s')
            );
            $queryUpdate = $this->db->update('tbl_actbud', $dataUpdate, array('kd_act' => decrypt($id)));
            if ($queryUpdate) {
                $this->session->set_flashdata('alert', [
                    'message' => 'Terima Kasih Telah Melakukan Persetujuan Kegiatan ini',
                    'type'    => 'success',
                    'title'   => ''
                ]);
                return redirect($_SERVER['HTTP_REFERER']);
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

    // START Approval Dekan
    public function approval_keuangan($id = null){
        $this->Global_model->only_finance_and_admin();
        if($id == null){
            $session = $this->session->userdata('user_sessions');
            $data['approval_actbud'] = $this->m_approval->get_actbud_approval_keuangan($this->year);
            return view('spa.approval.approval-keuangan', $data);
        } else {
            $this->load->model('SPA/RKAT_model', 'm_rkat');
            $method = $this->input->method();
            $session = $this->session->userdata('user_sessions');
            $nik = decrypt($session['nik']);
            $kode_unit = $session['kode_unit'];
            $data['karyawan'] = $this->m_rkat->get_master_data_karyawan(array('kode_unit' => $session['kode_unit']));
            $data['rkat_master'] = $this->m_rkat->get_rkat_master(array('unit' => $session['kode_unit']))->row_array();
            $data['kode_rkat_master'] = $data['rkat_master']['kode_rkat_master'];
            $data['periode'] = 0;
            if ($data['rkat_master']['periode'] == "Ganjil") {
                $data['periode'] = '1';
            } else if ($data['rkat_master']['periode'] == "Genap") {
                $data['periode'] = '2';
            }

            $data['data'] = $this->m_rkat->get_detail_uraian($data['kode_rkat_master'], $data['periode'], ['a7.kd_act' => $id]);
            if (empty($data['data'])) return show_404();
            $data['id_uraian'] = $data['data']['kode_uraian'];
            $data['id_actbud'] = $id;
            $data['dokumen_pendukung'] = $this->m_rkat->get_act_dokumen_pendukung($id);
            $data['rincian_kegiatan'] = $this->m_rkat->get_tjb_act($id);
            $data['messages'] = $this->m_rkat->get_data_chat_actbud($id);

            if ($method == "post") {
                $act = $this->input->post('act', true);
                switch ($act) {
                    case 'send_message':
                        return $this->buat_pesan($id_uraian, $id, $data['data']);
                        break;
                    case 'hapus_pesan':
                        return $this->hapus_pesan($id_uraian, $id, $data['data']);
                        break;
                    case 'hapus_pesan_reply':
                        return $this->hapus_pesan_reply($id_uraian, $id, $data['data']);
                        break;
                    default:
                        return show_error("Bad Request", 400, "400 - Error");
                        break;
                }
            }
            
            return view('spa.approval.detail.keuangan', $data);
        }
    }

    public function kirim_persetujuan_keuangan($id){
        $this->form_validation->set_rules('approval', 'Persetujuan Actbud', 'trim|required', [
            'required' => '%s tidak boleh kosong'
        ]);
        // $this->form_validation->set_rules('catatan', 'Catatan', 'trim|required', [
        //     'required' => '%s tidak boleh kosong'
        // ]);
        if($this->form_validation->run() === TRUE){
            $approval = $this->input->post('approval', true);
            if ($approval == "Disetujui" || $approval == "Ditolak") {
                // return true
            } else return show_error("Bad Request", 400, "400 - Error");

            $dataUpdate = array(
                            'st_keu' => $approval,
                            'c_keu' => $this->input->post('catatan'),
                            'stamp_keu' => date('d-m-Y H:i:s')
                        );
            $queryUpdate = $this->db->update('tbl_actbud', $dataUpdate, array('kd_act' => decrypt($id)));
            if($queryUpdate){
                $this->session->set_flashdata('alert', [
                    'message' => 'Terima Kasih Telah Melakukan Persetujuan Kegiatan ini',
                    'type'    => 'success',	
                    'title'   => ''
                ]);
                return redirect($_SERVER['HTTP_REFERER']);
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

    // START Approval Dekan
    public function approval_dekan($id = null){
        $this->Global_model->only_dekan_and_admin();
        if($id == null){
            $session = $this->session->userdata('user_sessions');

            if($session['kode_unit'] == "105" || $session['kode_unit'] == "106" || $session['kode_unit'] == "107" || $session['kode_unit'] == "108" || $session['kode_unit'] == "109" || $session['kode_unit'] == "110" || $session['kode_unit'] == "018" || $session['kode_unit'] == "020"){
                $data['approval_actbud'] = $this->m_approval->get_actbud_approval_dekan_ftd($this->year);
            } else if ($session['kode_unit'] == "101" || $session['kode_unit'] == "102" || $session['kode_unit'] == "103" || $session['kode_unit'] == "104" || $session['kode_unit'] == "019" || $session['kode_unit'] == "112" || $session['kode_unit'] == "017") {
                $data['approval_actbud'] = $this->m_approval->get_actbud_approval_dekan_fhb($this->year);
            } else {
                $data['approval_actbud'] = $this->m_approval->get_actbud_approval_dekan($this->year);
            }

            return view('spa.approval.approval-dekan', $data);
        } else {
            $data['kd_act'] = $id;
            $data['actbud'] = $this->m_approval->get_actbud(array('a.kd_act' => $id));
            if(!empty($data['actbud'])){
                $data['unit']       = $this->db->query('SELECT nama_unit FROM tbl_unit WHERE kode_unit=?', array($data['actbud'][0]['kode_unit']))->row_array();
                $data['nm']         = $this->db->query('SELECT * FROM tbl_karyawan WHERE nik=?', array($data['actbud'][0]['pelaksana']))->row_array();
                $data['upload_act'] = $this->db->query('SELECT * FROM tbl_upload_act WHERE kd_act=?', array($id))->result_array();
                $data['t_j_b_act']  = $this->db->query('SELECT * FROM t_j_b_act WHERE kd_act=?', array($id))->result_array();
                $data['chat']       = $this->db->query('SELECT * FROM tbl_chat a LEFT JOIN tbl_karyawan b on a.nik=b.nik WHERE a.kd_act=?', array($id))->result_array();

                return view('spa.approval.detail-approval-dekan', $data);
            } else {
                show_404();
            }
        }
    }

    public function kirim_persetujuan_dekan_ftd($id){
        $this->form_validation->set_rules('st_dekan', 'Persetujuan Actbud', 'trim|required', [
            'required' => '%s tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('catatan', 'Catatan', 'trim|required', [
            'required' => '%s tidak boleh kosong'
        ]);
        if($this->form_validation->run() === TRUE){
            $dataUpdate = array(
                            'st_ftd' => $this->input->post('st_dekan'),
                            'c_ftd' => $this->input->post('catatan'),
                            'stamp_ftd' => date('d-m-Y H:i:s')
                        );
            $queryUpdate = $this->db->update('tbl_actbud', $dataUpdate, array('kd_act' => decrypt($id)));
            if($queryUpdate){
                $this->session->set_flashdata('alert', [
                    'message' => 'Terima Kasih Telah Melakukan Persetujuan Kegiatan ini',
                    'type'    => 'success',	
                    'title'   => ''
                ]);
                return redirect(base_url('app/sim-spa/approval/dekan'));
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

    public function kirim_persetujuan_dekan_fhb($id){
        $this->form_validation->set_rules('st_dekan', 'Persetujuan Actbud', 'trim|required', [
            'required' => '%s tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('catatan', 'Catatan', 'trim|required', [
            'required' => '%s tidak boleh kosong'
        ]);
        if($this->form_validation->run() === TRUE){
            $dataUpdate = array(
                            'st_fhb' => $this->input->post('st_dekan'),
                            'c_fhb' => $this->input->post('catatan'),
                            'stamp_fhb' => date('d-m-Y H:i:s')
                        );
            $queryUpdate = $this->db->update('tbl_actbud', $dataUpdate, array('kd_act' => decrypt($id)));
            if($queryUpdate){
                $this->session->set_flashdata('alert', [
                    'message' => 'Terima Kasih Telah Melakukan Persetujuan Kegiatan ini',
                    'type'    => 'success',	
                    'title'   => ''
                ]);
                return redirect(base_url('app/sim-spa/approval/dekan'));
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
    // END Approval Dekan

    // START Approval Warek 1
    public function approval_warek_1($id = null){
        $this->Global_model->only_warek_1_and_admin();
        if($id == null){
            $session = $this->session->userdata('user_sessions');
            $data['approval_actbud'] = $this->m_approval->get_actbud_approval_warek1($this->year);
                        
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
        $this->Global_model->only_warek_2_and_admin();
        if($id == null){
            $session = $this->session->userdata('user_sessions');
            $data['approval_actbud'] = $this->m_approval->get_actbud_approval_warek2($this->year);

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

    // START Approval Rektor
    public function approval_rektor($id = null){
        $this->Global_model->only_rektor_and_admin();
        if($id == null){
            $session = $this->session->userdata('user_sessions');
            $year = date('Y');
            $data['approval_actbud'] = $this->m_approval->get_actbud_approval_rektor($this->year);

            return view('spa.approval.approval-rektor', $data);
        } else {
            $data['kd_act'] = $id;
            $data['actbud'] = $this->m_approval->get_actbud(array('a.kd_act' => $id));
            if(!empty($data['actbud'])){
                $data['unit']       = $this->db->query('SELECT nama_unit FROM tbl_unit WHERE kode_unit=?', array($data['actbud'][0]['kode_unit']))->row_array();
                $data['nm']         = $this->db->query('SELECT * FROM tbl_karyawan WHERE nik=?', array($data['actbud'][0]['pelaksana']))->row_array();
                $data['upload_act'] = $this->db->query('SELECT * FROM tbl_upload_act WHERE kd_act=?', array($id))->result_array();
                $data['t_j_b_act']  = $this->db->query('SELECT * FROM t_j_b_act WHERE kd_act=?', array($id))->result_array();
                $data['chat']       = $this->db->query('SELECT * FROM tbl_chat a LEFT JOIN tbl_karyawan b on a.nik=b.nik WHERE a.kd_act=?', array($id))->result_array();
    
                return view('spa.approval.detail-approval-rektor', $data);
            } else {
                show_404();
            }
        }
    }
    
    public function kirim_catatan_rektor(){
        $this->form_validation->set_rules('id', 'Data Detail Biaya', 'trim|required', [
			'required' => '%s tidak boleh kosong'
		]);
        $this->form_validation->set_rules('catatan', 'Catatan', 'trim|required', [
			'required' => '%s tidak boleh kosong'
		]);
		if($this->form_validation->run() === TRUE){
            $queryUpdate = $this->db->update('t_j_b_act', array('c_jns_b_rk' => $this->input->post('catatan')), array('id' => $this->input->post('id')));
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

    public function kirim_persetujuan_rektor($id){
        $this->form_validation->set_rules('st_rek', 'Persetujuan Actbud', 'trim|required', [
			'required' => '%s tidak boleh kosong'
		]);
        $this->form_validation->set_rules('catatan', 'Catatan', 'trim|required', [
			'required' => '%s tidak boleh kosong'
		]);
		if($this->form_validation->run() === TRUE){
            $dataUpdate = array(
                            'st_rek' => $this->input->post('st_rek'),
                            'c_rek' => $this->input->post('catatan'),
                            'stamp_rek' => date('d-m-Y H:i:s')
                        );
            $queryUpdate = $this->db->update('tbl_actbud', $dataUpdate, array('kd_act' => decrypt($id)));
            if($queryUpdate){
                $this->session->set_flashdata('alert', [
                    'message' => 'Terima Kasih Telah Melakukan Persetujuan Kegiatan ini',
                    'type'    => 'success',	
                    'title'   => ''
                ]);
                return redirect(base_url('app/sim-spa/approval/rektor'));
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
    // END Approval Rektor

    // START Approval Presiden
    public function approval_presiden($id = null){
        $this->Global_model->only_presiden_and_admin();
        if($id == null){
            $session = $this->session->userdata('user_sessions');
            $data['approval_actbud'] = $this->m_approval->get_actbud_approval_presiden($this->year);

            return view('spa.approval.approval-presiden', $data);
        } else {
            $data['kd_act'] = $id;
            $data['actbud'] = $this->m_approval->get_actbud(array('a.kd_act' => $id));
            if(!empty($data['actbud'])){
                $data['unit']       = $this->db->query('SELECT nama_unit FROM tbl_unit WHERE kode_unit=?', array($data['actbud'][0]['kode_unit']))->row_array();
                $data['nm']         = $this->db->query('SELECT * FROM tbl_karyawan WHERE nik=?', array($data['actbud'][0]['pelaksana']))->row_array();
                $data['upload_act'] = $this->db->query('SELECT * FROM tbl_upload_act WHERE kd_act=?', array($id))->result_array();
                $data['t_j_b_act']  = $this->db->query('SELECT * FROM t_j_b_act WHERE kd_act=?', array($id))->result_array();
                $data['chat']       = $this->db->query('SELECT * FROM tbl_chat a LEFT JOIN tbl_karyawan b on a.nik=b.nik WHERE a.kd_act=?', array($id))->result_array();
    
                return view('spa.approval.detail-approval-presiden', $data);
            } else {
                show_404();
            }
        }
    }

    public function kirim_persetujuan_presiden($id){
        $this->form_validation->set_rules('st_pres', 'Persetujuan Actbud', 'trim|required', [
			'required' => '%s tidak boleh kosong'
		]);
        $this->form_validation->set_rules('catatan', 'Catatan', 'trim|required', [
			'required' => '%s tidak boleh kosong'
		]);
		if($this->form_validation->run() === TRUE){
            $dataUpdate = array(
                            'st_pres' => $this->input->post('st_pres'),
                            'c_pres' => $this->input->post('catatan'),
                            'stamp_pres' => date('d-m-Y H:i:s')
                        );
            $queryUpdate = $this->db->update('tbl_actbud', $dataUpdate, array('kd_act' => decrypt($id)));
            if($queryUpdate){
                $this->session->set_flashdata('alert', [
                    'message' => 'Terima Kasih Telah Melakukan Persetujuan Kegiatan ini',
                    'type'    => 'success',	
                    'title'   => ''
                ]);
                return redirect(base_url('app/sim-spa/approval/presiden'));
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
    // END Approval Presiden

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

    public function buat_pesan($id_uraian, $id_actbud, array $arr_data = null)
    {
        $pic = decrypt($_SESSION['user_sessions']['nik']);
        $pesan = $this->input->post('pesan', true);

        if (isset($_POST['reply_pesan'])) {
            $this->form_validation->set_rules('reply_id', 'ID', 'trim|required', [
                'required' => '%s tidak boleh kosong.'
            ]);
            $this->form_validation->set_rules('reply_pesan', 'Pesan', 'trim|required', [
                'required' => '%s tidak boleh kosong.'
            ]);

            if ($this->form_validation->run() === TRUE) {
                $reply_id = decrypt($this->input->post('reply_id', true));
                $reply_pesan = $this->input->post('reply_pesan', true);
                if (!empty($_FILES['reply_attachment']['name'])) {

                    $path = FCPATH . 'app-data/chat-attachment';
                    $config['upload_path']      = $path;
                    $config['allowed_types']    = 'jpg|jpeg|png|docx|xlsx|pptx|vsdx|pdf';
                    $config['file_name']        = uniqid() . time() . '_' . $_FILES['reply_attachment']['name'];
                    $config['max_size']         = 10000;
                    $config['max_width']        = 2048;
                    $config['max_height']       = 1024;
                    $config['encrypt_name']     = false;
                    $config['detect_mime']      = true;
                    $config['remove_spaces']    = true;
                    $config['mod_mime_fix']     = true;
                    $this->load->library('upload', $config);

                    if (!$this->upload->do_upload('reply_attachment')) {
                        return show_error($this->upload->display_errors(), 402, "Error");
                    } else {
                        $upload_data = $this->upload->data();
                        $file_size = $_FILES['reply_attachment']['size'];

                        $data = [
                            'id_chat' => $reply_id,
                            'nik' => $pic,
                            'pesan' => $reply_pesan,
                            'attachment' => $upload_data['file_name'],
                            'attachment_size' => $file_size
                        ];

                        $insert = $this->db->insert('tbl_chat_reply', $data);

                        if ($insert === true) {
                            $this->session->set_flashdata('alert', [
                                'message' => 'Pesan berhasil terkirim.',
                                'type'    => 'success',
                                'title'   => ''
                            ]);

                            return redirect($_SERVER['HTTP_REFERER'] . '#card-chat');
                        } else {
                            $this->session->set_flashdata('alert', [
                                'message' => 'Pesan gagal terkirim.',
                                'type'    => 'error',
                                'title'   => ''
                            ]);

                            return redirect($_SERVER['HTTP_REFERER'] . '#card-chat');
                        }
                    }
                } else {
                    $insert = $this->db->insert('tbl_chat_reply', [
                        'id_chat' => $reply_id,
                        'nik' => $pic,
                        'pesan' => $reply_pesan,
                    ]);

                    if ($insert === true) {
                        $this->session->set_flashdata('alert', [
                            'message' => 'Pesan berhasil terkirim.',
                            'type'    => 'success',
                            'title'   => ''
                        ]);

                        return redirect($_SERVER['HTTP_REFERER'] . '#card-chat');
                    } else {
                        $this->session->set_flashdata('alert', [
                            'message' => 'Pesan gagal terkirim.',
                            'type'    => 'error',
                            'title'   => ''
                        ]);

                        return redirect($_SERVER['HTTP_REFERER'] . '#card-chat');
                    }
                }
            } else {
                $error = [
                    'form_error' => validation_errors_array()
                ];
                $this->session->set_flashdata('error_validation', $error);
                return redirect($_SERVER['HTTP_REFERER'] . '#card-chat');
            }
        } else {

            $this->form_validation->set_rules('pesan', 'Pesan', 'trim|required', [
                'required' => '%s tidak boleh kosong.'
            ]);

            if ($this->form_validation->run() === TRUE) {

                if (!empty($_FILES['attachment']['name'])) {

                    $path = FCPATH . 'app-data/chat-attachment';
                    $config['upload_path']       = $path;
                    $config['allowed_types']     = 'jpg|jpeg|png|docx|xlsx|pptx|vsdx|pdf';
                    $config['file_name']         = uniqid() . time() . '_' . $_FILES['attachment']['name'];
                    $config['max_size']          = 10000;
                    $config['max_width']         = 2048;
                    $config['max_height']        = 1024;
                    $config['encrypt_name']      = false;
                    $config['detect_mime']       = true;
                    $config['remove_spaces']     = true;
                    $config['mod_mime_fix']      = true;
                    $this->load->library('upload', $config);

                    if (!$this->upload->do_upload('attachment')) {
                        return show_error($this->upload->display_errors(), 402, "Error");
                    } else {
                        $upload_data = $this->upload->data();
                        $file_size = $_FILES['attachment']['size'];

                        $data = [
                            'kd_act' => $id_actbud,
                            'nik' => $pic,
                            'pesan' => $pesan,
                            'attachment' => $upload_data['file_name'],
                            'attachment_size' => $file_size
                        ];

                        $insert = $this->db->insert('tbl_chat', $data);

                        if ($insert === true) {
                            $this->session->set_flashdata('alert', [
                                'message' => 'Pesan berhasil terkirim.',
                                'type'    => 'success',
                                'title'   => ''
                            ]);

                            return redirect($_SERVER['HTTP_REFERER'] . '#card-chat');
                        } else {
                            $this->session->set_flashdata('alert', [
                                'message' => 'Pesan gagal terkirim.',
                                'type'    => 'error',
                                'title'   => ''
                            ]);

                            return redirect($_SERVER['HTTP_REFERER'] . '#card-chat');
                        }
                    }
                } else {

                    $insert = $this->db->insert('tbl_chat', [
                        'kd_act' => $id_actbud,
                        'nik' => $pic,
                        'pesan' => $pesan
                    ]);

                    if ($insert === true) {
                        $this->session->set_flashdata('alert', [
                            'message' => 'Pesan berhasil terkirim.',
                            'type'    => 'success',
                            'title'   => ''
                        ]);

                        return redirect($_SERVER['HTTP_REFERER'] . '#card-chat');
                    } else {
                        $this->session->set_flashdata('alert', [
                            'message' => 'Pesan gagal terkirim.',
                            'type'    => 'error',
                            'title'   => ''
                        ]);

                        return redirect($_SERVER['HTTP_REFERER'] . '#card-chat');
                    }
                }
            } else {
                $error = [
                    'form_error' => validation_errors_array()
                ];
                $this->session->set_flashdata('error_validation', $error);
                return redirect($_SERVER['HTTP_REFERER'] . '#card-chat');
            }
        }
    }

    private function hapus_pesan_reply($id_uraian, $id_actbud, array $arr_data = null)
    {
        $id = decrypt($this->input->post('id', true));
        $this->form_validation->set_rules('id', 'ID', 'trim|required', [
            'required' => '%s tidak boleh kosong.'
        ]);

        if ($this->form_validation->run() === TRUE) {

            $file_name = $this->input->post('attachment', true);

            if ($file_name != "") {
                unlink(FCPATH . 'app-data/chat-attachment/' . $file_name);
            }

            $this->db->where('id_chat', $id);
            $this->db->delete('tbl_chat_reply');

            $this->session->set_flashdata('alert', [
                'message' => 'Pesan berhasil dihapus.',
                'type'    => 'success',
                'title'   => ''
            ]);
            return redirect($_SERVER['HTTP_REFERER'] . '#card-chat');
        } else {
            $error = [
                'form_error' => validation_errors_array()
            ];
            $this->session->set_flashdata('error_validation', $error);
            return redirect($_SERVER['HTTP_REFERER'] . '#card-chat');
        }
    }

    private function hapus_pesan($id_uraian, $id_actbud, array $arr_data = null)
    {
        $id = decrypt($this->input->post('id', true));
        $this->form_validation->set_rules('id', 'ID', 'trim|required', [
            'required' => '%s tidak boleh kosong.'
        ]);

        if ($this->form_validation->run() === TRUE) {

            $file_name = $this->input->post('attachment', true);

            if ($file_name != "") {
                unlink(FCPATH . 'app-data/chat-attachment/' . $file_name);
            }

            $this->db->where('id_chat', $id);
            $this->db->delete('tbl_chat');

            $this->db->where('id_chat', $id);
            $this->db->delete('tbl_chat_reply');

            $this->session->set_flashdata('alert', [
                'message' => 'Pesan berhasil dihapus.',
                'type'    => 'success',
                'title'   => ''
            ]);
            return redirect($_SERVER['HTTP_REFERER'] . '#card-chat');
        } else {
            $error = [
                'form_error' => validation_errors_array()
            ];
            $this->session->set_flashdata('error_validation', $error);
            return redirect($_SERVER['HTTP_REFERER'] . '#card-chat');
        }
    }
    
}
?>