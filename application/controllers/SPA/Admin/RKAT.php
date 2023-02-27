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
        $data['list_rkat'] = $this->m_rkat->get_list_rkat_admin('PK');

        return view('spa.admin.rkat.list-program-kerja', $data);
    }

    public function list_rkat_operasional(){
        $data['list_rkat'] = $this->m_rkat->get_list_rkat('OPS');

        return view('spa.admin.rkat.list-operasional', $data);
    }

    public function list_rkat_investasi(){
        $data['list_rkat'] = $this->m_rkat->get_list_rkat('INV');

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
}
