<?php

require_once 'Notification.php';

defined('BASEPATH') OR exit('No direct script access allowed');

class PengalihanAnggaran extends CI_Controller {    

	function __construct(){
        parent::__construct();
        $this->Global_model->is_logged_in();
        $this->load->model('IG/Hibah_model');
        $this->load->model('IG/PengalihanAnggaran_model', 'm_pengalihan');
        $this->Global_model->is_finance();
        header("X-XSS-Protection: 1; mode=block");
    }

    public function index(string $qry = ""){
        $nik = decrypt($_SESSION['user_sessions']['nik']);
        $imp_arr = implode("/", $this->uri->segment_array());
        if (!empty($_GET['q']) && $_GET['q'] !== "") {
            $search = trim(filter_var($this->input->get('q', true), FILTER_SANITIZE_STRING));
            $qry .= "AND (b.nama_lengkap LIKE '%".$search."%' OR a.kode_uraian LIKE '%".$search."%' 
            OR a.kode_uraian_out LIKE '%".$search."%' OR a.keterangan LIKE '%".$search."%' OR a.kode_pencairan LIKE 
            '%".$search."%' OR a.kode_pencairan_out LIKE '%".$search."%')";
            $this->session->set_userdata('session_where', [
                'url' => base_url() . $imp_arr,
                'value' => $qry
            ]);
        } else {
            unset($_SESSION['session_where']);
        }

        $data['unit'] = $this->db->get_where('tbl_unit', ['status' => 'Aktif'])->result_array();
        $data['karyawan'] = $this->db->select('a.nik, a.nama_lengkap, a.kode_unit')
                            ->from('tbl_karyawan AS a')
                            ->where('a.status', 'Aktif')
                            ->order_by('a.nama_lengkap', 'ASC')
                            ->get()
                            ->result_array();        
        $data['kegiatan'] = $this->Global_model->get_rincian_anggaran();

        $data['data_pengalihan'] = $this->m_pengalihan->get_all_pengalihan();
        //pr($data['data_pengalihan']);
        return view('ig.users.pengalihan_anggaran.index', $data);
    }

    public function buat_pengalihan(){
        $this->form_validation->set_rules('kode_pencairan_asal', 'Kode Pencairan Asal', 'trim|required', [
            'required' => '%s tidak boleh kosong.'
        ]);
        $this->form_validation->set_rules('kode_pencairan_tujuan', 'Kode Pencairan Tujuan', 'trim|required', [
            'required' => '%s tidak boleh kosong.'
        ]);
        $this->form_validation->set_rules('pic', 'PIC/Pengaju', 'trim|required', [
            'required' => '%s tidak boleh kosong.'
        ]);
        $this->form_validation->set_rules('alasan', 'Alasan', 'trim|required', [
            'required' => '%s tidak boleh kosong.'
        ]);
        $this->form_validation->set_rules('periode', 'Periode', 'trim|required', [
            'required' => '%s tidak boleh kosong.'
        ]);
        $this->form_validation->set_rules('periode_out', 'Periode Tujuan', 'trim|required', [
            'required' => '%s tidak boleh kosong.'
        ]);
        $this->form_validation->set_rules('pic', 'PIC/Pengaju', 'trim|required', [
            'required' => '%s tidak boleh kosong.'
        ]);
        $this->form_validation->set_rules('saldo', 'Saldo', 'trim|required|numeric|is_natural_no_zero|integer', [
            'required' => '%s tidak boleh kosong.'
        ]);
        $this->form_validation->set_rules('saldo_out', 'Saldo Out', 'trim|required|numeric|is_natural_no_zero|integer', [
            'required' => '%s tidak boleh kosong.'
        ]);

        if ($this->form_validation->run() === FALSE) {
            $error = [
                'form_error' => validation_errors_array()
            ];
            $this->session->set_flashdata('error_validation', $error);
            return redirect($_SERVER['HTTP_REFERER']);
        } else {
            $kode_pencairan_asal = $this->input->post('kode_pencairan_asal', true);
            $kode_pencairan_asal = explode('_', $kode_pencairan_asal);
            if(empty($kode_pencairan_asal)) return show_404();
            if (!decrypt($kode_pencairan_asal[0]) || (!empty($kode_pencairan_asal[1]) && !decrypt($kode_pencairan_asal[1]))) return show_404();
            $kode_uraian_asal = decrypt($kode_pencairan_asal[0]);
            $kode_pencairan_asal = empty($kode_pencairan_asal[1]) ? "-" : decrypt($kode_pencairan_asal[1]);

            $kode_pencairan_tujuan = $this->input->post('kode_pencairan_tujuan', true);
            $kode_pencairan_tujuan = explode('_', $kode_pencairan_tujuan);
            if (empty($kode_pencairan_tujuan)) return show_404();
            if (!decrypt($kode_pencairan_tujuan[0]) || (!empty($kode_pencairan_tujuan[1]) && !decrypt($kode_pencairan_tujuan[1]))) return show_404();
            $kode_uraian_tujuan = decrypt($kode_pencairan_tujuan[0]);
            $kode_pencairan_tujuan = empty($kode_pencairan_tujuan[1]) ? "-" : decrypt($kode_pencairan_tujuan[1]);            
            
            $pic = $this->input->post('pic', true);
            $periode = $this->input->post('periode', true);
            $periode_tujuan = $this->input->post('periode_out', true);
            $saldo = $this->input->post('saldo', true);
            $saldo_out = $this->input->post('saldo_out', true);
            $signature = $this->input->post('signature');
            $keterangan = $this->input->post('alasan', true);
            $total_anggaran = $this->input->post('anggaran', true);
            $total_agr = str_ireplace(".", "", substr($total_anggaran, 4));
            if (!is_numeric($total_agr)) return show_error("Total anggaran harus berupa angka!", 400, "400 - Bad Request, Invalid argument (invalid request payload)");
            if (is_numeric($total_agr) && $total_agr < 0) return show_error("Total anggaran tidak boleh lebik kecil dari 0", 400, "400 - Bad Request, Invalid argument (invalid request payload)");
            $detail_anggaran = $this->Global_model->get_detail_anggaran($kode_uraian_asal);

            if($total_agr > $detail_anggaran->sisa_agr){
                return show_error("Anggaran melebihi batas, batas maksimal anggaran adalah " . rupiah($detail_anggaran->sisa_agr), 400, "400 - Bad Request, Invalid argument (invalid request payload)");
            }
            
            $image_parts = explode(";base64,", $signature);            
            if(empty($image_parts)) return show_404();
            
            // if (substr($signature, -5) == "CYII=") {
            //     $this->session->set_flashdata('alert', [
            //         'message' => 'Tanda tangan tidak boleh kosong.',
            //         'type'    => 'error',
            //         'title'   => ''
            //     ]);
            //     return redirect($_SERVER['HTTP_REFERER']);
            // }

            if (check_base64_image($signature) === false) {
                return show_error("Tanda tangan invalid!", 400, "400 - Bad Request, Invalid argument (invalid request payload)");
            }
            
            $data = [
                'kode_uraian' => $kode_uraian_tujuan,
                'kode_pencairan' => $kode_pencairan_tujuan,
                'kode_uraian_out' => $kode_uraian_asal,
                'kode_pencairan_out' => $kode_pencairan_asal,
                'keterangan' => $keterangan,                
                'nominal' => $total_agr,
                'ttd_created' => $image_parts[1],
                'pic' => $pic,
                'periode' => $periode,
                'periode_out' => $periode_tujuan,
                'disetujui' => 'Y',
                'saldo' => $saldo,
                'saldo_out' => $saldo_out
            ];            

            if (!empty($_FILES['file_pendukung']['name'])) {
                $path = FCPATH . 'app-data/pengalihan-anggaran/attachment';
                $config['upload_path']      = $path;
                $config['allowed_types']    = 'jpg|jpeg|png|docx|xlsx|pptx|pdf';
                $config['file_name']        = uniqid() . time() . '_' . $_FILES['file_pendukung']['name'];
                $config['max_size']         = 1024 * 2;
                $config['max_width']        = 2048;
                $config['max_height']       = 1024;
                $config['encrypt_name']     = false;
                $config['detect_mime']      = true;
                $config['remove_spaces']    = true;
                $config['mod_mime_fix']     = true;
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('file_pendukung')) {
                    return show_error($this->upload->display_errors(), 403, "Error");
                } else {
                    $upload_data = $this->upload->data();                    
                    $data['file_pendukung'] = $upload_data['file_name'];
                }
            }

            $insert = $this->db->insert('ig_tbl_pengalihan', $data);

            if($insert){
                $this->session->set_flashdata('alert', [
                    'message' => 'Selamat anda berhasil membuat pengalihan anggaran.',
                    'type'    => 'success',
                    'title'   => ''
                ]);
                return redirect(base_url('app/sim-ig/pengalihan-anggaran'));
            } else {
                $this->session->set_flashdata('alert', [
                    'message' => 'Maaf anda gagal membuat pengalihan anggaran.',
                    'type'    => 'success',
                    'title'   => ''
                ]);
                return redirect(base_url('app/sim-ig/pengalihan-anggaran'));
            }
        }
    }
}