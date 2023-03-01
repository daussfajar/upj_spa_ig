<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Anggaran extends CI_Controller{

    function __construct(){
        parent::__construct();
        $this->load->model('SPA/Anggaran_model', 'm_anggaran');
        $this->Global_model->is_logged_in();
        header("X-XSS-Protection: 1; mode=block");
    }

    public function index(){
        return show_404();
    }

    public function get_pengalihan_anggaran(){
        $method = $this->input->method();
        if ($method == "post"){
            header('Content-Type: application/json');
            $year = date('Y');
            echo $this->m_anggaran->get_pengalihan_anggaran($year);
        } else return show_404();
    }

    public function pengalihan($id = null){
        if($id == null){
            $data['karyawan'] = $this->Global_model->get_master_data_karyawan();
            $data['uraian'] = $this->m_anggaran->get_data_uraian(array('tahun' => date('Y')));
    
            return view('spa.anggaran.pengalihan-anggaran', $data);
        } else {
            $data['id'] = $id;
            $data['pengalihan'] = $this->db->query('SELECT * FROM tbl_pengalihan WHERE id=?', array($id))->row_array();

            if(!empty($data['pengalihan'])){
                $data['saldo_f'] = 0;
                $data['saldo_t'] = 0;
                $getSisaF = $this->db->query('select sisa_agr from view_sisa_agr where kode_pencairan = ?', array($data['pengalihan']['kd_pencairan_f']))->row_array();
                $getSisaT = $this->db->query('select sisa_agr from view_sisa_agr where kode_pencairan = ?', array($data['pengalihan']['kd_pencairan_t']))->row_array();

                if(count($getSisaF) > 0){
                    $data['saldo_f'] = $getSisaF['sisa_agr'];
                } else {
                    $getViewAgrRkat = mysql_fetch_array(mysql_query("select total_agr from view_agr_rkat where kode_pencairan = ?", array($data['pengalihan']['kd_pencairan_f'])));
                    if(count($getViewAgrRkat) > 0){
                        $data['saldo_f'] = $getViewAgrRkat['total_agr'];
                    }
                }

                if(count($getSisaT) > 0){
                    $data['saldo_t'] = $getSisaT['sisa_agr'];
                } else {
                    $getViewAgrRkat = mysql_fetch_array(mysql_query("select total_agr from view_agr_rkat where kode_pencairan = ?", array($data['pengalihan']['kd_pencairan_t'])));
                    if(count($getViewAgrRkat) > 0){
                        $data['saldo_t'] = $getViewAgrRkat['total_agr'];
                    }
                }
            
                return view('spa.anggaran.proses-pengalihan-anggaran', $data);
            } else {
                $this->session->set_flashdata('alert', [
                    'message' => 'Data Pengalihan Anggaran tidak ditemukan!',
                    'type'    => 'error',	
                    'title'   => ''
                ]);
                return redirect(base_url('app/sim-spa/anggaran/pengalihan'));
            }
        }
    }

    public function proses_pengalihan($id){
        $this->form_validation->set_rules('saldo_f', 'Saldo Asal', 'trim|required', [
			'required' => '%s tidak boleh kosong'
		]);
        $this->form_validation->set_rules('saldo_t', 'Saldo Tujuan', 'trim|required', [
			'required' => '%s tidak boleh kosong'
		]);
		if($this->form_validation->run() === TRUE){
            $saldo_f = $this->input->post('saldo_f');
            $saldo_t = $this->input->post('saldo_t');
            $status  = "";
            if(!empty($this->input->post('proses'))){
                $status = "sukses";
            } else if (!empty($this->input->post('tolak'))){
                $status = "Ditolak";
            }

            $data['id'] = $id;
            $data['pengalihan'] = $this->db->query('SELECT * FROM tbl_pengalihan WHERE id=?', array($id))->row_array();
            if(!empty($data['pengalihan'])){
                $dataUpdate = array('saldo_f' => $saldo_f, 'saldo_t' => $saldo_t, 'status' => $status);
                $queryUpdate = $this->db->update('tbl_pengalihan', $dataUpdate, array('id' => $id));
                if($queryUpdate){
                    $this->session->set_flashdata('alert', [
                        'message' => 'Berhasil proses pengalihan anggaran',
                        'type'    => 'success',	
                        'title'   => ''
                    ]);
                } else {
                    $this->session->set_flashdata('alert', [
                        'message' => 'Gagal proses pengalihan anggaran',
                        'type'    => 'error',	
                        'title'   => ''
                    ]);
                }
                return redirect(base_url('app/sim-spa/anggaran/pengalihan'));
            } else {
                $this->session->set_flashdata('alert', [
                    'message' => 'Data Pengalihan Anggaran tidak ditemukan!',
                    'type'    => 'error',	
                    'title'   => ''
                ]);
                return redirect(base_url('app/sim-spa/anggaran/pengalihan'));
            }
        } else {
            $error = [
				'form_error' => validation_errors_array()
			];
			$this->session->set_flashdata('error_validation', $error);
            return redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function tambah_pengalihan(){
        $this->form_validation->set_rules('kd_uraian_f', 'Kode Pencairan Asal', 'trim|required', [
			'required' => '%s tidak boleh kosong'
		]);
        $this->form_validation->set_rules('kd_uraian_t', 'Kode Pencairan Tujuan', 'trim|required', [
			'required' => '%s tidak boleh kosong'
		]);
        $this->form_validation->set_rules('pengaju_pic', 'PIC', 'trim|required', [
			'required' => '%s tidak boleh kosong'
		]);
        $this->form_validation->set_rules('alasan', 'Alasan', 'trim|required', [
			'required' => '%s tidak boleh kosong'
		]);
        $this->form_validation->set_rules('nominal', 'Nominal', 'trim|required|numeric', [
			'required' => '%s tidak boleh kosong'
		]);
		if($this->form_validation->run() === TRUE){
            $kd_uraian_f = $this->input->post('kd_uraian_f');
            $kd_uraian_t = $this->input->post('kd_uraian_t');
            $pengaju_pic = $this->input->post('pengaju_pic');
            $nominal     = $this->input->post('nominal');
            $alasan      = $this->input->post('alasan');

            $queryGetUraianF = $this->m_anggaran->get_data_uraian(array('kode_uraian' => $kd_uraian_f));
            $queryGetUraianT = $this->m_anggaran->get_data_uraian(array('kode_uraian' => $kd_uraian_t));

            if(!empty($queryGetUraianF) && !empty($queryGetUraianT)){
                $kd_pencairan_f = $queryGetUraianF[0]['kode_pencairan'];
                $periode_f      = $queryGetUraianF[0]['periode'];
                $kd_pencairan_t = $queryGetUraianT[0]['kode_pencairan'];
                $periode_t      = $queryGetUraianT[0]['periode'];

                $queryInsert = $this->db->query('INSERT INTO tbl_pengalihan (id_uraian_f, kd_pencairan_f, periode_f, id_uraian_t, kd_pencairan_t, periode_t, alasan, nominal, tahun, pengaju_pic) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                                                array($kd_uraian_f, $kd_pencairan_f, $periode_f, $kd_uraian_t, $kd_pencairan_t, $periode_t, $alasan, $nominal, date('Y'), $pengaju_pic)
                                            );
                if($queryInsert){
                    $this->session->set_flashdata('alert', [
                        'message' => 'Berhasil input pengalihan anggaran',
                        'type'    => 'success',	
                        'title'   => ''
                    ]);
                } else {
                    $this->session->set_flashdata('alert', [
                        'message' => 'Gagal input pengalihan anggaran',
                        'type'    => 'error',	
                        'title'   => ''
                    ]);
                }
            } else {
                $this->session->set_flashdata('alert', [
                    'message' => 'Data Kode Pencairan Asal atau Kode Pencairan Tujuan tidak ditemukan!',
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

    public function realisasi($id = null){
        if($id == null){
            $year = date('Y');
            $data['actbud_realisasi'] = $this->m_anggaran->get_realisasi_anggaran($year);
            return view('spa.anggaran.realisasi-anggaran', $data);
        } else {
            $data['id'] = $id;
            $data['actbud'] = $this->db->query('SELECT a.*, b.nama_lengkap, c.nama_unit FROM tbl_actbud a LEFT JOIN tbl_karyawan b ON b.nik=a.pic LEFT JOIN tbl_unit c ON c.kode_unit=b.kode_unit WHERE kd_act=?', array($id))->row_array();

            if(!empty($data['actbud'])){
                $data['t_j_b_act'] = $this->db->query('SELECT * FROM t_j_b_act WHERE kd_act=?', array($id))->result_array();
                
                return view('spa.anggaran.detail-realisasi-anggaran', $data);
            } else {
                $this->session->set_flashdata('alert', [
                    'message' => 'Data Pengalihan Anggaran tidak ditemukan!',
                    'type'    => 'error',	
                    'title'   => ''
                ]);
                return redirect(base_url('app/sim-spa/anggaran/realisasi'));
            }
        }
    }

    public function penyesuaian_biaya($id){
        $this->form_validation->set_rules('id', 'ID', 'trim|required', [
			'required' => '%s tidak boleh kosong'
		]);
        $this->form_validation->set_rules('kd_act', 'Kode Actbud', 'trim|required', [
			'required' => '%s tidak boleh kosong'
		]);
        $this->form_validation->set_rules('pra_pyn', 'Nominal Realisasi', 'trim|required', [
			'required' => '%s tidak boleh kosong'
		]);
        $this->form_validation->set_rules('ket_pyn', 'Catatan Realisasi', 'trim|required', [
			'required' => '%s tidak boleh kosong'
		]);
		if($this->form_validation->run() === TRUE){
            $idTJBACT   = $this->input->post('id');
            $kd_act     = $this->input->post('kd_act');
            $pra_pyn    = $this->input->post('pra_pyn');
            $ket_pyn    = $this->input->post('ket_pyn');

            $dataUpdate = array('pra_pyn' => $pra_pyn, 'ket_pyn' => $ket_pyn);
            $queryUpdate = $this->db->update('t_j_b_act', $dataUpdate, array('id' => $idTJBACT));
            if($queryUpdate){
                $this->session->set_flashdata('alert', [
                    'message' => 'Berhasil realisasi jenis biaya',
                    'type'    => 'success',	
                    'title'   => ''
                ]);
            } else {
                $this->session->set_flashdata('alert', [
                    'message' => 'Gagal realisasi jenis biaya',
                    'type'    => 'error',	
                    'title'   => ''
                ]);
            }
            return redirect(base_url('app/sim-spa/anggaran/realisasi/' . $id));
        } else {
            $error = [
				'form_error' => validation_errors_array()
			];
			$this->session->set_flashdata('error_validation', $error);
            return redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function finalisasi_penyesuaian_anggaran($id){
        $this->form_validation->set_rules('id', 'ID', 'trim|required', [
			'required' => '%s tidak boleh kosong'
		]);
        $this->form_validation->set_rules('pra_pyn', 'Nominal Realisasi', 'trim|required', [
			'required' => '%s tidak boleh kosong'
		]);

		if($this->form_validation->run() === TRUE){
            $pra_pyn    = $this->input->post('pra_pyn');
            $queryUpdateActbud = $this->db->update('tbl_actbud', array('status_penyesuaian' => 'ok', 'fnl_agr' => $pra_pyn), array('kd_act' => $id));
            $queryUpdateTJBAct = $this->db->update('t_j_b_act', array('status_penyesuaian' => 'ok'), array('kd_act' => $id));
            
            if($queryUpdateTJBAct && $queryUpdateTJBAct){
                $this->session->set_flashdata('alert', [
                    'message' => 'Berhasil Finalisasi Penyesuaian Anggaran',
                    'type'    => 'success',	
                    'title'   => ''
                ]);
            } else {
                $this->session->set_flashdata('alert', [
                    'message' => 'Gagal Finalisasi Penyesuaian Anggaran',
                    'type'    => 'error',	
                    'title'   => ''
                ]);
            }
            return redirect(base_url('app/sim-spa/anggaran/realisasi/' . $id));
        } else {
            $error = [
				'form_error' => validation_errors_array()
			];
			$this->session->set_flashdata('error_validation', $error);
            return redirect($_SERVER['HTTP_REFERER']);
        }
    }
}
