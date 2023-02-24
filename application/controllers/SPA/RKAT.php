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
        return redirect(base_url('app/sim-spa/rkat/pic/program-kerja'));
    }

    // endpoint datatable
    public function get_pic_rkat_program_kerja(){
        $kode_rkat_master   = $this->input->post('kode-rkat');
        $periode            = $this->input->post('periode');
        header('Content-Type: application/json');
		echo $this->m_rkat->get_pic_rkat($kode_rkat_master, $periode, 'PK');
    }
    
    public function get_pic_rkat_operasional(){
        $kode_rkat_master   = $this->input->post('kode-rkat');
        $periode            = $this->input->post('periode');
        header('Content-Type: application/json');   
		echo $this->m_rkat->get_pic_rkat($kode_rkat_master, $periode, 'OPS');
    }
    
    public function get_pic_rkat_investasi(){
        $kode_rkat_master   = $this->input->post('kode-rkat');
        $periode            = $this->input->post('periode');
        header('Content-Type: application/json');
		echo $this->m_rkat->get_pic_rkat($kode_rkat_master, $periode, 'INV');
    }

    // view
    public function pic_rkat_program_kerja(){
        $session = $this->session->userdata('user_sessions');
        $data['karyawan'] = $this->m_rkat->get_master_data_karyawan(array('kode_unit' => $session['kode_unit']));
        $data['rkat_master'] = $this->m_rkat->get_rkat_master(array('unit' => $session['kode_unit']))->row_array();
        $data['kode_rkat_master'] = $data['rkat_master']['kode_rkat_master'];
        $data['periode'] = 0;
        if($data['rkat_master']['periode'] == "Ganjil"){
            $data['periode'] = '1';
        } else if ($data['rkat_master']['periode'] == "Genap"){
            $data['periode'] = '2';
        }

        return view('spa.rkat.ubah-pic-program-kerja', $data);
    }

    public function pic_rkat_operasional(){
        $session = $this->session->userdata('user_sessions');
        $data['karyawan'] = $this->m_rkat->get_master_data_karyawan(array('kode_unit' => $session['kode_unit']));
        $data['rkat_master'] = $this->m_rkat->get_rkat_master(array('unit' => $session['kode_unit']))->row_array();
        $data['kode_rkat_master'] = $data['rkat_master']['kode_rkat_master'];
        $data['periode'] = 0;
        if($data['rkat_master']['periode'] == "Ganjil"){
            $data['periode'] = '1';
        } else if ($data['rkat_master']['periode'] == "Genap"){
            $data['periode'] = '2';
        }

        return view('spa.rkat.ubah-pic-operasional', $data);
    }

    public function pic_rkat_investasi(){
        $session = $this->session->userdata('user_sessions');
        $data['karyawan'] = $this->m_rkat->get_master_data_karyawan(array('kode_unit' => $session['kode_unit']));
        $data['rkat_master'] = $this->m_rkat->get_rkat_master(array('unit' => $session['kode_unit']))->row_array();
        $data['kode_rkat_master'] = $data['rkat_master']['kode_rkat_master'];
        $data['periode'] = 0;
        if($data['rkat_master']['periode'] == "Ganjil"){
            $data['periode'] = '1';
        } else if ($data['rkat_master']['periode'] == "Genap"){
            $data['periode'] = '2';
        }

        return view('spa.rkat.ubah-pic-investasi', $data);
    }

    public function list_rkat_program_kerja(){
        return view('spa.rkat.list-program-kerja');
    }

    public function list_rkat_operasional(){
        return view('spa.rkat.list-operasional');
    }

    public function list_rkat_investasi(){
        return view('spa.rkat.list-investasi');
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
