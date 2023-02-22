<?php

require_once 'Notification.php';

defined('BASEPATH') OR exit('No direct script access allowed');

class KreditSaldo extends CI_Controller {

    private $data = [];

	function __construct(){
        parent::__construct();
        $this->Global_model->is_logged_in();
        $this->load->model('Hibah_model');
        $this->Global_model->is_finance();
        header("X-XSS-Protection: 1; mode=block");
    }

    public function index(){
        $nik = decrypt($_SESSION['user_sessions']['nik']);
        $data['kegiatan'] = $this->Hibah_model->get_all_in_out();        
        return view('ig.users.kredit_saldo.index', $data);
    }

    public function buat_kredit(){
        $nik = decrypt($_SESSION['user_sessions']['nik']);
        $data['kegiatan'] = $this->Hibah_model->get_all_kegiatan($nik);
        return view('ig.users.kredit_saldo.buat_kredit', $data);
    }

    public function batalkan_kredit(){
        $this->form_validation->set_rules('id', 'ID', 'trim|required');
        $this->form_validation->set_rules('kode_uraian', 'Kode Uraian', 'trim|required');
        $this->form_validation->set_rules('nama_hibah_sponsorship', 'Nama Hibah Sponsorship', 'trim|required');

        if($this->form_validation->run() === TRUE){
            $id = decrypt($this->input->post('id', true));
            $kode_uraian = $this->input->post('kode_uraian', true);
            $nama_hibah_sponsorship = $this->input->post('nama_hibah_sponsorship', true);

            $this->db->where('id', $id);
            $this->db->update('ig_tbl_in_out', [
                'status' => 'Tidak Aktif'
            ]);
            $this->session->set_flashdata('alert', [
                'message' => 'Selamat anda berhasil membatalkan kredit saldo '.$kode_uraian.'-'.$nama_hibah_sponsorship.'.',
                'type'    => 'success',	
                'title'   => ''
            ]);
            return redirect(base_url('app/sim-ig/kredit_saldo'));
        } else {
            $error = [
				'form_error' => validation_errors_array()
			];
			$this->session->set_flashdata('error_validation', $error);				
			return redirect(base_url('app/sim-ig/kredit_saldo'));
        }
    }

    public function finalisasi_kredit(){
        $this->form_validation->set_rules('id', 'ID', 'trim|required');
        $this->form_validation->set_rules('kode_uraian', 'Kode Uraian', 'trim|required');
        $this->form_validation->set_rules('nama_hibah_sponsorship', 'Nama Hibah Sponsorship', 'trim|required');
        
        if($this->form_validation->run() === TRUE){
            $id = decrypt($this->input->post('id', true));
            $kode_uraian = $this->input->post('kode_uraian', true);
            $nama_hibah_sponsorship = $this->input->post('nama_hibah_sponsorship', true);

            $this->db->where('id', $id);
            $this->db->update('ig_tbl_in_out', [
                'disetujui' => 'Y',
                'disetujui_stamp' => date('Y-m-d H:i:s')
            ]);
            $this->session->set_flashdata('alert', [
                'message' => 'Selamat anda berhasil finalisasi kredit saldo '.$kode_uraian.'-'.$nama_hibah_sponsorship.'.',
                'type'    => 'success',	
                'title'   => ''
            ]);
            return redirect(base_url('app/sim-ig/kredit_saldo'));
        } else {
            $error = [
				'form_error' => validation_errors_array()
			];
			$this->session->set_flashdata('error_validation', $error);				
			return redirect(base_url('app/sim-ig/kredit_saldo'));
        }
    }

    public function submit_kredit(){
        $this->form_validation->set_rules('jenis_kredit', 'Jenis Kredit', 'trim|required');
        $this->form_validation->set_rules('kegiatan', 'Kegiatan', 'trim|required');
        $this->form_validation->set_rules('kode_pencairan', 'Kode Pencairan', 'trim|required');
        $this->form_validation->set_rules('nominal', 'Nominal', 'trim|required');
        if($_FILES['file_pendukung']['name'] == ""){
            $this->form_validation->set_rules('file_pendukung', 'File Pendukung', 'trim|required');
        }
        $this->form_validation->set_rules('keterangan', 'keterangan', 'trim|required');

        if($this->form_validation->run() === TRUE){
            $nik  = decrypt($_SESSION['user_sessions']['nik']);

            if(!empty($_FILES['file_pendukung']['name'])){
                $path = FCPATH . 'app-data/kredit-saldo/attachment';
				$config['upload_path'] 		= $path;
				$config['allowed_types'] 	= 'jpg|jpeg|png|docx|xlsx|pptx|vsdx|webp|pdf';
				$config['file_name'] 		= uniqid() . time() . '_' . $_FILES['file_pendukung']['name'];
				$config['max_size'] 		= 10000;
				$config['max_width']  		= 1024;
				$config['max_height']  		= 768;
				$config['encrypt_name'] 	= false;
				$config['detect_mime'] 		= true;
				$config['remove_spaces'] 	= true;
				$config['mod_mime_fix'] 	= true;
				$this->load->library('upload', $config);			
                $total_nominal = $this->input->post('nominal', true);			
                $nominal = str_ireplace(".","", substr($total_nominal, 4));
                if (!is_numeric($nominal)) return show_error("Total anggaran harus berupa angka!");
                if (is_numeric($nominal) && $nominal < 0) return show_error("Total anggaran tidak boleh lebik kecil dari 0");

				if(!$this->upload->do_upload('file_pendukung')){
					return show_error($this->upload->display_errors(), 402, "Error");
				} else {
					$upload_data = $this->upload->data();
                    $kegiatan = $this->input->post('kegiatan', true);
                    $keterangan = $this->input->post('keterangan', true);
                    $data = [
                        'kode_uraian' => $kegiatan,
                        'kode_pencairan' => $this->input->post('kode_pencairan', true),
                        'keterangan' => $keterangan,
                        'file_pendukung' => $upload_data['file_name'],
                        'jenis_kredit' => $this->input->post('jenis_kredit', true),
                        'nominal' => $nominal
                    ];

                    $this->db->insert('ig_tbl_in_out', $data);
                    $jk = $this->input->post('jenis_kredit', true) == 'in' ? 'Masuk' : 'Keluar';

                    Notification::insert([
                        'item_id'       => $this->db->insert_id(),
                        'user_id'       => $nik,
                        'owner_user_id' => $nik,
                        'user_name'     => $_SESSION['user_sessions']['nama_lengkap'],
                        'url'           => 'app/sim-ig/detail-pemberitahuan/',
                        'message'       => 'berhasil melakukan Kredit <b>Saldo ' . $jk . '</b> dengan keterangan <b>"'.$keterangan.'"</b> ke kode uraian <b>'.$kegiatan.'</b>, nominalnya sebesar ' . rupiah($nominal) . '.',
                        'is_seen'       => 'no',
                        'title'         => 'Berhasil Kredit Saldo',
                        'color'         => 'success',
                        'icon'          => 'mdi-cash-plus'
                    ]);                    
                    //pr($x);
                    $this->session->set_flashdata('alert', [
                        'message' => 'Selamat anda berhasil membuat kredit saldo.',
                        'type'    => 'success',	
                        'title'   => ''
                    ]);
                    return redirect(base_url('app/sim-ig/kredit_saldo'));
                }
            }

        } else {
            $error = [
				'form_error' => validation_errors_array()
			];
			$this->session->set_flashdata('error_validation', $error);				
			return redirect(base_url('app/sim-ig/kredit_saldo/buat_kredit'));
        }
        
    }

    public function preview_upload(){
        error_reporting(0);
		$this->form_validation->set_rules('file_upload', 'File Upload', 'trim|required|xss_clean');
		if (empty($_FILES['file']['name'])) {
			$this->form_validation->set_rules('file', 'File Excel', 'trim|required|xss_clean');
		}
		if($this->form_validation->run() === TRUE){

			include APPPATH . 'third_party/PHPExcel/PHPExcel.php';
		
			$excelreader    = new PHPExcel_Reader_Excel2007();
			$loadexcel      = $excelreader->load($_FILES['file']['tmp_name']);
			$sheet          = $loadexcel->getActiveSheet()->toArray(null, true, true, true);
			$count_sheet    = array_slice($sheet, 1);
			$data['sheet']  = $count_sheet;			
			//pr($data);
			return view('ig.users.kredit_saldo.preview_upload_kredit', $data);
		} else {
			$error = [
				'form_error' => validation_errors_array()
			];
			$this->session->set_flashdata('error_validation', $error);				
			return redirect(base_url('app/sim-ig/kredit_saldo'));
		}
    }

    public function upload_kredit(){
        $this->form_validation->set_rules('kode_uraian[]', 'Kode Uraian', 'trim|required', [
			'required' => '%s tidak boleh kosong.'
		]);
		$this->form_validation->set_rules('kode_pencairan[]', 'Kode Pencairan', 'trim|required', [
			'required' => '%s tidak boleh kosong.'
		]);
		$this->form_validation->set_rules('keterangan[]', 'Keterangan', 'trim|required', [
			'required' => '%s tidak boleh kosong.'
		]);
		$this->form_validation->set_rules('jenis_kredit[]', 'Jenis Kredit', 'trim|required', [
			'required' => '%s tidak boleh kosong.'
		]);
		$this->form_validation->set_rules('nominal[]', 'Nominal', 'trim|required|numeric', [
			'required' => '%s tidak boleh kosong.'
		]);

        if($this->form_validation->run() === TRUE){

            $kode_uraian            = $this->input->post('kode_uraian', true);
			$kode_pencairan         = $this->input->post('kode_pencairan', true);
			$keterangan             = $this->input->post('keterangan', true);
			$jenis_kredit           = $this->input->post('jenis_kredit', true);
            $nominal                = $this->input->post('nominal', true);
			
			$image_parts            = explode(";base64,", $_POST['tanda_tangan']);                 
            $image_base64_encode    = $image_parts[1];
			$created_by             = decrypt($_SESSION['user_sessions']['nik']);
			$index                  = 0;
			$data                   = array();

            foreach($kode_uraian as $input_data){
                array_push($data, array(
                    'kode_uraian'       => $kode_uraian[$index],
                    'kode_pencairan'    => $kode_pencairan[$index],
                    'keterangan'        => $keterangan[$index],
                    'jenis_kredit'      => $jenis_kredit[$index],
                    'nominal'           => $nominal[$index],
                    'created_by'        => $created_by,
					'ttd_created'       => $image_base64_encode,
                    'disetujui'         => 'Y',
                    'disetujui_stamp'   => date('Y-m-d H:i:s')
                ));

                $index++;
            }

            $this->db->insert_batch('ig_tbl_in_out', $data);
            Notification::insert([
                'item_id'       => $this->db->insert_id(),
                'user_id'       => $nik,
                'owner_user_id' => $nik,
                'user_name'     => $_SESSION['user_sessions']['nama_lengkap'],
                'url'           => 'app/sim-ig/detail-pemberitahuan/',
                'message'       => 'berhasil melakukan upload kredit saldo.',
                'is_seen'       => 'no',
                'title'         => 'Berhasil Kredit Saldo',
                'color'         => 'success',
                'icon'          => 'mdi-cash-plus'
            ]);

			$this->session->set_flashdata('alert', [
				'message' => 'Selamat anda berhasil upload kredit saldo.',
				'type'    => 'success',	
				'title'   => ''
			]);
			return redirect(base_url('app/sim-ig/kredit_saldo'));

        } else {
            $error = [
				'form_error' => validation_errors_array()
			];
			$this->session->set_flashdata('error_validation', $error);				
			return redirect(base_url('app/sim-ig/kredit_saldo'));
        }
    }

}