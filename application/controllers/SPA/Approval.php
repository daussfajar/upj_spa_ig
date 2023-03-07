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

    public function v_warek_1(){
        $session = $this->session->userdata('user_sessions');
        $year = date('Y');
        $year = 2022;
        $data['approval_actbud'] = $this->m_approval->get_rkat_approval_warek1($year);

        return view('spa.approval.warek-1', $data);
    }

    public function v_kepala_unit(){
        $session = $this->session->userdata('user_sessions');
        $kode_unit = $session['kode_unit'];
        $year = date('Y');
        // $year = 2022;
        $data['approval_actbud'] = $this->m_approval->get_rkat_approval_kepala_unit($year, $kode_unit);
        
        return view('spa.approval.kepala-unit', $data);
    }

    public function v_detail(int $id_actbud){
        $this->load->model('SPA/RKAT_model', 'm_rkat');
        $method = $this->input->method();
        $session = $this->session->userdata('user_sessions');
        $nik = decrypt($session['nik']);
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
                default:
                    return show_error("Bad Request", 400, "400 - Error");
                    break;
            }
        }

        return view('spa.pencairan_rkat.detail.v_detail_actbud_petty_cash', $data);
    }

    public function submit_actbud_kabag(){
        pr($_REQUEST);
    }
}
?>