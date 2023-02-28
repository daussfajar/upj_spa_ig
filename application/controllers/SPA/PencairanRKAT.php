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
        
        return view('spa.pencairan_rkat.actbud.v_input_actbud', $data);
    }

    public function v_proses_input_actbud(int $id){
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

        $data['data'] = $this->m_rkat->get_detail_uraian($data['kode_rkat_master'], $data['periode'], ['a1.pic' => $nik, 'a1.kode_uraian' => $id]);
        if(empty($data['data'])) return show_404();
        $data['id'] = $id;

        if($method === "post"){
            return $this->save_input_actbud($id, $data['data']);
        }

        return view('spa.pencairan_rkat.actbud.v_proses_input_actbud', $data);
    }

    private function save_input_actbud(int $id, array $data){
        $this->form_validation->set_rules('deskripsi_kegiatan', 'Deskripsi Kegiatan', 'trim|required|max_length[255]', [
            'required' => '%s tidak boleh kosong.'
        ]);
        $this->form_validation->set_rules('pelaksana_kegiatan', 'Pelaksana Kegiatan', 'trim|required|max_length[35]|min_length[32]', [
            'required' => '%s tidak boleh kosong.'
        ]);
        $this->form_validation->set_rules('tgl_mulai', 'Tanggal Mulai', 'trim|required|max_length[35]', [
            'required' => '%s tidak boleh kosong.'
        ]);
        $this->form_validation->set_rules('tgl_selesai', 'Tanggal Selesai', 'trim|required|max_length[35]', [
            'required' => '%s tidak boleh kosong.'
        ]);

        if ($this->form_validation->run() === FALSE) {
            $error = [
                'form_error' => validation_errors_array()
            ];
            $this->session->set_flashdata('error_validation', $error);
            return redirect($_SERVER['HTTP_REFERER']);
        } else {
            $deskripsi_kegiatan = $this->input->post('deskripsi_kegiatan', true);
            $tgl_mulai = $this->input->post('tgl_mulai', true);
            $tgl_selesai = $this->input->post('tgl_selesai', true);
            $pelaksana_kegiatan = $this->input->post('pelaksana_kegiatan', true);
            $decrypt_pelaksana_kegiatan = !decrypt($pelaksana_kegiatan) ? show_404() : decrypt($pelaksana_kegiatan);
            
            if(($data['sisa_anggaran'] - $data['agr_digunakan']) == 0){
                $this->session->set_flashdata('alert', [
                    'message' => 'Maaf anggaran sudah habis',
                    'type'    => 'error',
                    'title'   => ''
                ]);

                return redirect($_SERVER['HTTP_REFERER']);
            }

            $insert_data = [
                'kode_uraian' => $data['kode_uraian'],
                'kode_pencairan' => $data['kode_pencairan'],
                'kode_unit' => $data['kode_unit'],
                'nama_kegiatan' => $data['uraian'],
                'no_borang' => $data['no_borang'],
                'pic' => $data['pic'],
                'tahun' => date('Y'),
                'tanggal_pembuatan' => date('Y-m-d H:i:s'),
                'periode' => ($data['periode'] == "Ganjil") ? "ganjil" : "genap",
                'deskrip_keg' => $deskripsi_kegiatan,
                'pelaksana' => $decrypt_pelaksana_kegiatan,
                'jns_aju_agr' => 'actbud',
                'kpi' => $data['kpi'],
                'agr' => $data['sisa_anggaran'],
                'status_act' => 'send',
                'st_kabag' => 'Submit',
                'tgl_m' => $tgl_mulai,
                'tgl_s' => $tgl_selesai
            ];
            
            $insert = $this->db->insert('tbl_actbud', $insert_data);

            if($insert === true){
                $this->session->set_flashdata('alert', [
                    'message' => 'Berhasil membuat actbud',
                    'type'    => 'success',
                    'title'   => ''
                ]);

                $insert_id = $this->db->insert_id();

                return redirect(base_url('app/sim-spa/pencairan-rkat/input-actbud/detail/' . $id . '/' . $insert_id));
            } else {
                $this->session->set_flashdata('alert', [
                    'message' => 'Gagal membuat actbud',
                    'type'    => 'error',
                    'title'   => ''
                ]);

                return redirect($_SERVER['HTTP_REFERER']);
            }
        }   
    }

    public function v_detail_actbud(int $id_uraian, int $id_actbud){
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

        $data['data'] = $this->m_rkat->get_detail_uraian($data['kode_rkat_master'], $data['periode'], ['a1.pic' => $nik, 'a1.kode_uraian' => $id_uraian]);
        if (empty($data['data'])) return show_404();
        $data['id_uraian'] = $id_uraian;
        $data['id_actbud'] = $id_actbud;
        
        return view('spa.pencairan_rkat.actbud.v_input_detail_biaya', $data);
    }

    public function v_view_actbud()
    {
        return view('spa.pencairan_rkat.actbud.v_view_actbud');
    }

    public function v_status_actbud()
    {
        return view('spa.pencairan_rkat.actbud.v_status_actbud');
    }

    public function v_input_pettycash()
    {
        return view('spa.pencairan_rkat.petty_cash.v_input_pettycash');
    }

    public function v_view_pettycash()
    {
        return view('spa.pencairan_rkat.petty_cash.v_view_pettycash');
    }

    public function v_status_pettycash()
    {
        return view('spa.pencairan_rkat.petty_cash.v_status_pettycash');
    }
}
