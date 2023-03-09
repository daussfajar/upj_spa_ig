<?php
defined('BASEPATH') or exit('No direct script access allowed');

class HistoryApproval extends CI_Controller{

    var $year = 2022;

    function __construct(){
        parent::__construct();
        $this->load->model('SPA/HistoryApproval_model', 'm_history_approval');
        $this->Global_model->is_logged_in();
        header("X-XSS-Protection: 1; mode=block");
    }

    public function index($as){
        $session = $this->session->userdata('user_sessions');
        $kode_unit = $session['kode_unit'];
        $data['as'] = $as;
        if($as == "kepala-unit"){
            $this->Global_model->is_kabag($kode_unit);
            $data['approval_actbud'] = $this->m_history_approval->get_rkat_history_approval_kepala_unit($this->year, $kode_unit);
        } else if($as == "umum"){
            $data['approval_actbud'] = $this->m_history_approval->get_rkat_history_approval_umum($this->year);
        } else if($as == "hrd"){
            $data['approval_actbud'] = $this->m_history_approval->get_rkat_history_approval_hrd($this->year);
        } else if($as == "ict"){
            $data['approval_actbud'] = $this->m_history_approval->get_rkat_history_approval_ict($this->year);
        } else if($as == "bkal"){
            $data['approval_actbud'] = $this->m_history_approval->get_rkat_history_approval_bkal($this->year);
        } else if($as == "p2m"){
            $data['approval_actbud'] = $this->m_history_approval->get_rkat_history_approval_p2m($this->year);
        } else if($as == "keuangan"){
            $this->Global_model->only_finance_and_admin();
            $data['approval_actbud'] = $this->m_history_approval->get_rkat_history_approval_keuangan($this->year);
        } else if($as == "dekan-ftd"){
            $data['approval_actbud'] = $this->m_history_approval->get_rkat_history_approval_dekan_ftd($this->year);
        } else if($as == "dekan-fhb"){
            $data['approval_actbud'] = $this->m_history_approval->get_rkat_history_approval_dekan_fhb($this->year);
        } else if($as == "warek1"){
            $data['approval_actbud'] = $this->m_history_approval->get_rkat_history_approval_warek1($this->year);
        } else if($as == "warek2"){
            $data['approval_actbud'] = $this->m_history_approval->get_rkat_history_approval_warek2($this->year);
        } else if($as == "rektor"){
            $data['approval_actbud'] = $this->m_history_approval->get_rkat_history_approval_rektor($this->year);
        } else if($as == "presiden"){
            $data['approval_actbud'] = $this->m_history_approval->get_rkat_history_approval_presiden($this->year);
        } else {
            show_404();
            exit();
        }
        
        return view('spa.approval.history-approval', $data);
    }

    public function detail($as, int $id_actbud){
        $this->load->model('SPA/RKAT_model', 'm_rkat');
        $session = $this->session->userdata('user_sessions');
        $method = $this->input->method();
        $kode_unit = $session['kode_unit'];
        $data['as'] = $as;
        if($as == "kabag"){
            $this->Global_model->is_kabag($kode_unit);
        } else if($as == "umum"){
        } else if($as == "hrd"){
        } else if($as == "ict"){
        } else if($as == "bkal"){
        } else if($as == "p2m"){
        } else if($as == "keuangan"){
            $this->Global_model->only_finance_and_admin();
        } else if($as == "dekan-ftd"){
        } else if($as == "dekan-fhb"){
        } else if($as == "warek1"){
        } else if($as == "warek2"){
        } else if($as == "rektor"){
        } else if($as == "presiden"){
        } else {
            show_404();
            exit();
        }
             
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
        
        return view('spa.approval.detail.detail-history-approval', $data);
    }
}
?>