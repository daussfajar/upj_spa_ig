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

    public function index(){
        $session = $this->session->userdata('user_sessions');
        $kode_unit = $session['kode_unit'];
        $jabatan = $session['kode_jabatan'];
        if($kode_unit == "003") {
            $this->Global_model->only_ga_and_admin();
            $data['approval_actbud'] = $this->m_history_approval->get_rkat_history_approval_umum($this->year);
        } else if($kode_unit == "006") {
            $this->Global_model->only_hrd_and_admin();
            $data['approval_actbud'] = $this->m_history_approval->get_rkat_history_approval_hrd($this->year);
        } else if($kode_unit == "004") {
            $this->Global_model->only_ict_and_admin();
            $data['approval_actbud'] = $this->m_history_approval->get_rkat_history_approval_ict($this->year);
        } else if($kode_unit == "013") {
            $this->Global_model->only_bkal_and_admin();
            $data['approval_actbud'] = $this->m_history_approval->get_rkat_history_approval_bkal($this->year);
        } else if($kode_unit == "016") {
            $this->Global_model->only_p2m_and_admin();
            $data['approval_actbud'] = $this->m_history_approval->get_rkat_history_approval_p2m($this->year);
        } else if($kode_unit == "002"){
            $this->Global_model->only_finance_and_admin();
            $data['approval_actbud'] = $this->m_history_approval->get_rkat_history_approval_keuangan($this->year);
        } else if($kode_unit == "018"){
            $this->Global_model->only_dekan_and_admin();
            $data['approval_actbud'] = $this->m_history_approval->get_rkat_history_approval_dekan_ftd($this->year);
        } else if($kode_unit == "017"){
            $this->Global_model->only_dekan_and_admin();
            $data['approval_actbud'] = $this->m_history_approval->get_rkat_history_approval_dekan_fhb($this->year);
        } else if($kode_unit == "007" && $jabatan == 3){
            $this->Global_model->only_warek_1_and_admin();
            $data['approval_actbud'] = $this->m_history_approval->get_rkat_history_approval_warek1($this->year);
        } else if($kode_unit == "007" && $jabatan == 4){
            $this->Global_model->only_warek_2_and_admin();
            $data['approval_actbud'] = $this->m_history_approval->get_rkat_history_approval_warek2($this->year);
        } else if($kode_unit == "007" && $jabatan == 2){
            $this->Global_model->only_rektor_and_admin();
            $data['approval_actbud'] = $this->m_history_approval->get_rkat_history_approval_rektor($this->year);
        } else if($kode_unit == "011" && $jabatan == 1){
            $this->Global_model->only_presiden_and_admin();
            $data['approval_actbud'] = $this->m_history_approval->get_rkat_history_approval_presiden($this->year);
        } else {
            $this->Global_model->is_kabag($kode_unit);
            $data['approval_actbud'] = $this->m_history_approval->get_rkat_history_approval_kepala_unit($this->year, $kode_unit);
        }
        
        return view('spa.approval.history-approval', $data);
    }

    public function detail(int $id_actbud)
    {
        $this->Global_model->except_dosen_staff();
        $this->load->model('SPA/RKAT_model', 'm_rkat');
        $session = $this->session->userdata('user_sessions');        
        $method = $this->input->method();        
             
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


        $session = $this->session->userdata('user_sessions');
        if ($session['kode_unit'] == "006" && ($session['kode_jabatan'] == "0" || $session['kode_jabatan'] == "22")) {
            $access = true;
        } else {
            $access = false;
        }
        
        return view('spa.approval.detail.detail-history-approval', $data);
    }
}
?>