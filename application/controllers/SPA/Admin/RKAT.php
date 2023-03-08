<?php
defined('BASEPATH') or exit('No direct script access allowed');

class RKAT extends CI_Controller{

    function __construct(){
        parent::__construct();
        $this->load->model('SPA/RKAT_model', 'm_rkat');
        $this->Global_model->is_logged_in();
        header("X-XSS-Protection: 1; mode=block");
    }

    public function index(){
        return redirect(base_url('app/sim-spa/admin/rkat/pic/program-kerja'));
    }

    // endpoint datatable
    public function get_pic_rkat_program_kerja(){
        $method = $this->input->method();
        if ($method == "post"){
            header('Content-Type: application/json');
            $year = date('Y');
            echo $this->m_rkat->get_pic_rkat_admin('PK', $year);
        } else return show_404();
    }
    
    public function get_pic_rkat_operasional(){
        $method = $this->input->method();
        if ($method == "post"){
            header('Content-Type: application/json');
            $year = date('Y');
            echo $this->m_rkat->get_pic_rkat_admin('OPS', $year);
        } else return show_404();
    }
    
    public function get_pic_rkat_investasi(){
        $method = $this->input->method();
        if($method == "post"){
            header('Content-Type: application/json');
            $year = date('Y');
            echo $this->m_rkat->get_pic_rkat_admin('INV', $year);
        } else return show_404();
    }

    // view
    public function pic_rkat_program_kerja(){
        $data['karyawan'] = $this->m_rkat->get_master_data_karyawan();

        return view('spa.admin.rkat.ubah-pic-program-kerja', $data);
    }

    public function pic_rkat_operasional(){
        $data['karyawan'] = $this->m_rkat->get_master_data_karyawan();

        return view('spa.admin.rkat.ubah-pic-operasional', $data);
    }

    public function pic_rkat_investasi(){
        $data['karyawan'] = $this->m_rkat->get_master_data_karyawan();

        return view('spa.admin.rkat.ubah-pic-investasi', $data);
    }

    public function list_rkat_program_kerja(){
        $year = date('Y');
        $data['list_rkat'] = $this->m_rkat->get_list_rkat_admin('PK', $year);

        return view('spa.admin.rkat.list-program-kerja', $data);
    }

    public function list_rkat_operasional(){
        $year = date('Y');
        $data['list_rkat'] = $this->m_rkat->get_list_rkat_admin('OPS', $year);

        return view('spa.admin.rkat.list-operasional', $data);
    }

    public function list_rkat_investasi(){
        $year = date('Y');
        $data['list_rkat'] = $this->m_rkat->get_list_rkat_admin('INV', $year);

        return view('spa.admin.rkat.list-investasi', $data);
    }

    public function ubah_pic(){
        $this->form_validation->set_rules('kode', 'Data', 'trim|required', [
			'required' => '%s tidak boleh kosong'
		]);
        $this->form_validation->set_rules('pic', 'PIC', 'trim|required', [
			'required' => '%s tidak boleh kosong'
		]);
		if($this->form_validation->run() === TRUE){
            $kode_uraian = $this->input->post('kode');
            $queryUpdate = $this->db->update('tbl_uraian', [ 'pic' => $this->input->post('pic', true) ], array('kode_uraian' => $kode_uraian));
            if($queryUpdate){
                $this->session->set_flashdata('alert', [
                    'message' => 'Berhasil mengubah PIC pada RKAT',
                    'type'    => 'success',	
                    'title'   => ''
                ]);
            } else {
                $this->session->set_flashdata('alert', [
                    'message' => 'Gagal mengubah PIC pada RKAT',
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

    // Laporan Pencairan RKAT
    public function laporan_pencairan($id = null){
        $this->Global_model->only_finance_and_admin();
        if($id == null){
            $year = date('Y');
            $year = 2022;
            $data['laporan_pencairan'] = $this->m_rkat->get_laporan_pencairan(array('a.tahun' => $year));

            return view('spa.admin.rkat.laporan-pencairan', $data);
        } else {
            $data['kd_act'] = $id;
            $data['actbud'] = $this->m_rkat->get_laporan_pencairan(array('a.kd_act' => $id));
            if(!empty($data['actbud'])){
                $data['unit']       = $this->db->query('SELECT nama_unit FROM tbl_unit WHERE kode_unit=?', array($data['actbud'][0]['kode_unit']))->row_array();
                $data['nm']         = $this->db->query('SELECT * FROM tbl_karyawan WHERE nik=?', array($data['actbud'][0]['pelaksana']))->row_array();
                $data['upload_act'] = $this->db->query('SELECT * FROM tbl_upload_act WHERE kd_act=?', array($id))->result_array();
                $data['t_j_b_act']  = $this->db->query('SELECT * FROM t_j_b_act WHERE kd_act=?', array($id))->result_array();
                $data['chat']       = $this->db->query('SELECT * FROM tbl_chat a LEFT JOIN tbl_karyawan b on a.nik=b.nik WHERE a.kd_act=?', array($id))->result_array();
    
                return view('spa.admin.rkat.detail-laporan-pencairan', $data);
            } else {
                show_404();
            }
        }
    }

    public function kirim_pesan_laporan_pencairan($id){
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

    public function cetak_actbud_laporan_pencairan($id){
        $data['actbud'] = $this->m_rkat->get_laporan_pencairan(array('a.kd_act' => $id));
        if(!empty($data['actbud'])){
            $data['t_j_b_act'] = $this->db->query('SELECT * FROM t_j_b_act WHERE kd_act=?', array($id))->result_array();
            $data['unit'] = $this->db->query('SELECT nama_unit FROM tbl_unit WHERE kode_unit=?', array($data['actbud'][0]['kode_unit']))->row_array();
            $data['nm'] = $this->db->query('SELECT nama_lengkap FROM tbl_karyawan WHERE nik=?', array($data['actbud'][0]['pelaksana']))->row_array();

            return view('spa.admin.rkat.cetak-actbud-laporan-pencairan', $data);
        } else {
            show_404();
        }
    }

    public function cetak_petty_laporan_pencairan($id){
        $data['actbud'] = $this->m_rkat->get_laporan_pencairan(array('a.kd_act' => $id));
        if(!empty($data['actbud'])){
            $data['t_j_b_act'] = $this->db->query('SELECT * FROM t_j_b_act WHERE kd_act=?', array($id))->result_array();
            $data['unit'] = $this->db->query('SELECT nama_unit FROM tbl_unit WHERE kode_unit=?', array($data['actbud'][0]['kode_unit']))->row_array();
            $data['nm'] = $this->db->query('SELECT nama_lengkap FROM tbl_karyawan WHERE nik=?', array($data['actbud'][0]['pelaksana']))->row_array();

            return view('spa.admin.rkat.cetak-petty-cash-laporan-pencairan', $data);
        } else {
            show_404();
        }
    }
}
