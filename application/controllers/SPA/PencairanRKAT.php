<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PencairanRKAT extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->Global_model->is_logged_in();
        header("X-XSS-Protection: 1; mode=block");
        $this->load->model('SPA/RKAT_model', 'm_rkat');
    }

    public function get_actbud(){
        $method                 = $this->input->method();
        if ($method == "post") {
            $nik = decrypt($_SESSION['user_sessions']['nik']);
            $kode_rkat_master   = $this->input->post('kode-rkat');
            $periode            = $this->input->post('periode');
            header('Content-Type: application/json');
            echo $this->m_rkat->get_where_pic_rkat($kode_rkat_master, $periode, ['a1.pic' => $nik]);
        } else return show_404();
    }

    public function v_input_actbud(){
        $session = $this->session->userdata('user_sessions');
        $data['karyawan'] = $this->m_rkat->get_master_data_karyawan(array('kode_unit' => $session['kode_unit']));
        $data['rkat_master'] = $this->m_rkat->get_rkat_master(array('unit' => $session['kode_unit']))->row_array();
        $data['kode_rkat_master'] = $data['rkat_master']['kode_rkat_master'];
        $data['periode'] = 0;
        if ($data['rkat_master']['periode'] == "Ganjil") {
            $data['periode'] = '1';
        } else if ($data['rkat_master']['periode'] == "Genap") {
            $data['periode'] = '2';
        }
        
        return view('spa.pencairan_rkat.v_input_actbud', $data);
    }

    public function v_proses_input_actbud(int $id){
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

        $data['data'] = $this->m_rkat->get_detail_uraian($data['kode_rkat_master'], $data['periode'], ['a1.pic' => $nik, 'a1.kode_uraian' => $id]);        
        if(empty($data['data'])) return show_404();
        
        return view('spa.pencairan_rkat.v_proses_input_actbud', $data);
    }

    public function v_view_actbud()
    {
        return view('spa.pencairan_rkat.v_view_actbud');
    }

    public function v_status_actbud()
    {
        return view('spa.pencairan_rkat.v_status_actbud');
    }

    public function v_input_pettycash()
    {
        return view('spa.pencairan_rkat.v_input_pettycash');
    }

    public function v_view_pettycash()
    {
        return view('spa.pencairan_rkat.v_view_pettycash');
    }

    public function v_status_pettycash()
    {
        return view('spa.pencairan_rkat.v_status_pettycash');
    }
}
