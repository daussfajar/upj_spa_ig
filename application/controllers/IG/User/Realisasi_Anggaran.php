<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Realisasi_Anggaran extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->Global_model->is_logged_in();
        $this->load->model('Realisasi_Anggaran_Model');
        $this->load->model('Hibah_model');
        header("X-XSS-Protection: 1; mode=block");
	}

    public function index($qry = ''){
        //0pr($this->db->db_pconnect());
        $imp_arr = implode("/", $this->uri->segment_array());
		if (!empty($_GET['q']) && $_GET['q'] !== "") {            
			$search = trim(filter_var($this->input->get('q', true), FILTER_SANITIZE_STRING));
			$qry .= "AND (a.kode_uraian LIKE '%".$search."%' OR a.deskripsi_kegiatan LIKE '%".$search."%' OR a.kode_pencairan LIKE '%".$search."%' 
            OR b.nama_lengkap LIKE '%".$search."%' OR a.nama_kegiatan LIKE '%".$search."%' OR c.nama_unit LIKE '%".$search."%' OR a.id LIKE '%".$search."%')";
			$this->session->set_userdata('session_where', [
				'url' => base_url() . $imp_arr,
				'value' => $qry
			]);
		} else {
            $qry .= "ORDER BY a.id DESC";
			unset($_SESSION['session_where']);
		}        
        
        $data['data'] = $this->Realisasi_Anggaran_Model->get_data($qry);
        $data['count_belum_realisasi'] = $this->Realisasi_Anggaran_Model->get_total_belum_finalisasi();
                
        return view('ig.users.realisasi_anggaran.index', $data);
    }

    public function v_detail(){
        $id_actbud = decrypt($this->uri->segment(4));
        $id_uraian = decrypt($this->uri->segment(5));
        $data['data'] = $this->Realisasi_Anggaran_Model->get_detail_actbud($id_actbud);
        $data['detail_biaya'] = $this->Realisasi_Anggaran_Model->get_detail_biaya($id_actbud);
        $data['anggaran_disetujui'] = $this->Realisasi_Anggaran_Model->get_total_anggaran_disetujui($id_actbud);
        $data['anggaran_realisasi'] = $this->Realisasi_Anggaran_Model->get_total_anggaran_realisasi($id_actbud);
        $data['dokumen_pendukung'] = $this->db->get_where('ig_tbl_actbud_upload', ['id_act' => $id_actbud, 'status' => 'Aktif']);
        $data['messages'] = $this->Hibah_model->get_data_chat_actbud($id_actbud);
        //pr($data);
        return view('ig.users.realisasi_anggaran.v_realisasi_anggaran', $data);
    }

    public function buat_catatan(){
        $this->form_validation->set_rules('id', 'ID', 'trim|required', [
			'required' => '%s tidak boleh kosong.'
		]);	
        $this->form_validation->set_rules('catatan', 'Catatan', 'trim|required', [
			'required' => '%s tidak boleh kosong.'
		]);		

		if($this->form_validation->run() === TRUE){

            $raw_id = $this->input->post('id', true);
            $decrypted_id = decrypt($raw_id);
            $catatan = trim($this->input->post('catatan', true));
            
            $this->db->where('id', $decrypted_id);
            $this->db->update('ig_t_j_b_act', [
                'catatan_disetujui' => $catatan
            ]);

            $this->session->set_flashdata('alert', [
                'message' => 'Selamat anda berhasil catatan.',
                'type'    => 'success',	
                'title'   => ''
            ]);
            return redirect($_SERVER['HTTP_REFERER'] . '#card-rincian');

        } else {
            $error = [
				'form_error' => validation_errors_array()
			];
			$this->session->set_flashdata('error_validation', $error);				
			return redirect($_SERVER['HTTP_REFERER'] . '#card-rincian');
        }
    }
    
    public function buat_catatan_keu(){
        $this->form_validation->set_rules('id', 'ID', 'trim|required', [
			'required' => '%s tidak boleh kosong.'
		]);	
        $this->form_validation->set_rules('catatan', 'Catatan', 'trim|required', [
			'required' => '%s tidak boleh kosong.'
		]);		

		if($this->form_validation->run() === TRUE){

            $raw_id = $this->input->post('id', true);
            $decrypted_id = decrypt($raw_id);
            $catatan = trim($this->input->post('catatan', true));
            
            $this->db->where('id', $decrypted_id);
            $this->db->update('ig_t_j_b_act', [
                'catatan_disetujui_keu' => $catatan
            ]);

            $this->session->set_flashdata('alert', [
                'message' => 'Selamat anda berhasil catatan.',
                'type'    => 'success',	
                'title'   => ''
            ]);
            return redirect($_SERVER['HTTP_REFERER'] . '#card-rincian');

        } else {
            $error = [
				'form_error' => validation_errors_array()
			];
			$this->session->set_flashdata('error_validation', $error);				
			return redirect($_SERVER['HTTP_REFERER'] . '#card-rincian');
        }
    }

    public function buat_realisasi_anggaran(){
        $this->form_validation->set_rules('id', 'ID', 'trim|required', [
			'required' => '%s tidak boleh kosong.'
		]);
        $this->form_validation->set_rules('anggaran_realisasi', 'Anggaran Realisasi', 'trim|required', [
			'required' => '%s tidak boleh kosong.'
		]);		

		if($this->form_validation->run() === TRUE){

            $anggaran_realisasi = $this->input->post('anggaran_realisasi', true);			
			$total_agr = str_ireplace(".","", substr($anggaran_realisasi, 3));
            $raw_id = $this->input->post('id', true);
            $decrypted_id = decrypt($raw_id);
            $data = $this->db->query("SELECT a.id,a.total_anggaran,a.total_anggaran_realisasi FROM ig_t_j_b_act a WHERE a.status = 'Aktif' AND 
            a.id = '$decrypted_id'")->row();            

            if($total_agr > $data->total_anggaran){

                $this->session->set_flashdata('alert', [
                    'message' => 'Anggaran melewati batas.',
                    'type'    => 'error',	
                    'title'   => ''
                ]);
                return redirect($_SERVER['HTTP_REFERER'] . '#card-rincian');

            } else {
                $this->db->where('id', $decrypted_id);
                $this->db->update('ig_t_j_b_act', [
                    'total_anggaran_realisasi' => $total_agr
                ]);

                $this->session->set_flashdata('alert', [
                    'message' => 'Sukses.',
                    'type'    => 'success',	
                    'title'   => ''
                ]);
                return redirect($_SERVER['HTTP_REFERER'] . '#card-rincian');
            }            

        } else {
            $error = [
				'form_error' => validation_errors_array()
			];
			$this->session->set_flashdata('error_validation', $error);				
			return redirect($_SERVER['HTTP_REFERER'] . '#card-rincian');
        }
    }

    public function unggah_bukti(){        
        $this->form_validation->set_rules('id', 'ID', 'trim|required', [
			'required' => '%s tidak boleh kosong.'
		]);	
        if(empty($_FILES['lampiran']['name'])){
            $this->form_validation->set_rules('Lampiran', 'Lampiran', 'trim|required', [
                'required' => '%s tidak boleh kosong.'
            ]);
        }
        
		if($this->form_validation->run() === TRUE){
            $raw_ekstensi = explode('.', $_FILES['lampiran']['name']);
            $raw_old_lampiran = $this->input->post('old_lampiran', true);

            if($raw_old_lampiran !== ""){
                $decrypted_lampiran = !decrypt($raw_old_lampiran) ? show_error("Error") : decrypt($raw_old_lampiran);
                // cek apakah ada file lama
                if(file_exists(FCPATH . 'app-data/bukti-realisasi-anggaran/' . $decrypted_lampiran)){
                    // jika ada maka kita hapus filenya
                    unlink(FCPATH . 'app-data/bukti-realisasi-anggaran/' . $decrypted_lampiran);
                }
            }

            $raw_id = $this->input->post('id', true);
            $decrypted_id = decrypt($raw_id);

            $path = FCPATH . 'app-data/bukti-realisasi-anggaran';
			$config['upload_path'] 		= $path;
			$config['allowed_types'] 	= 'jpg|jpeg|png|docx|xlsx|pptx|webp|pdf';
			$config['file_name'] 		= uniqid() . time() . '_' . $_FILES['lampiran']['name'];
			$config['max_size'] 		= 5000;
			$config['max_width']  		= 1024;
			$config['max_height']  		= 768;
			$config['encrypt_name'] 	= false;
			$config['detect_mime'] 		= true;
			$config['remove_spaces'] 	= true;
			$config['mod_mime_fix'] 	= true;
			$this->load->library('upload', $config);

            if(!$this->upload->do_upload('lampiran')){
                return show_error($this->upload->display_errors(), 402, "Error");
            } else {
                $upload_data = $this->upload->data();
				$file_size = (int) $_FILES['lampiran']['size'];                
                $ext = end($raw_ekstensi);
                
                $icon = '';
                switch($ext){
                    case $ext == 'png' || $ext == 'jpg' || $ext == 'jpeg' 
                    || $ext == 'webp':
                        $icon .= 'mdi mdi-image';
                        break;
                    case $ext == 'pdf':
                        $icon .= 'mdi mdi-file-pdf-outline';
                        break;
                    case $ext == 'doc' || $ext == 'docx':
                        $icon .= 'mdi mdi-file-word-outline';
                        break;
                    case $ext == 'xlsx':
                        $icon .= 'mdi mdi-file-excel-outline';
                        break;
                    case $ext == 'pptx':
                        $icon .= 'mdi mdi-file-powerpoint-outline';
                        break;
                        $icon .= 'UNKNOWN';
                    default:
                }                

                $ext_file = end($raw_ekstensi);

                $this->db->where('id', $decrypted_id);
                $this->db->update('ig_t_j_b_act', [
                    'nama_file'     => (String) trim($_FILES['lampiran']['name']),
                    'ukuran_file'   => $file_size,
                    'lampiran'      => $upload_data['file_name'],
                    'ekstensi_file' => $ext_file,
                    'icon_file'     => $icon,
                ]);                

                $this->session->set_flashdata('alert', [
                    'message' => 'Sukses.',
                    'type'    => 'success',	
                    'title'   => ''
                ]);
                return redirect($_SERVER['HTTP_REFERER'] . '#card-rincian');
            }

        } else {
            $error = [
				'form_error' => validation_errors_array()
			];
			$this->session->set_flashdata('error_validation', $error);				
			return redirect($_SERVER['HTTP_REFERER'] . '#card-rincian');
        }
    }

    public function unggah_bukti_keu(){        
        $this->form_validation->set_rules('id', 'ID', 'trim|required', [
			'required' => '%s tidak boleh kosong.'
		]);	
        if(empty($_FILES['lampiran']['name'])){
            $this->form_validation->set_rules('Lampiran', 'Lampiran', 'trim|required', [
                'required' => '%s tidak boleh kosong.'
            ]);
        }
        
		if($this->form_validation->run() === TRUE){
            $raw_ekstensi = explode('.', $_FILES['lampiran']['name']);
            $raw_old_lampiran = $this->input->post('old_lampiran', true);

            if($raw_old_lampiran !== ""){
                $decrypted_lampiran = !decrypt($raw_old_lampiran) ? show_error("Error") : decrypt($raw_old_lampiran);
                // cek apakah ada file lama
                if(file_exists(FCPATH . 'app-data/bukti-realisasi-anggaran/' . $decrypted_lampiran)){
                    // jika ada maka kita hapus filenya
                    unlink(FCPATH . 'app-data/bukti-realisasi-anggaran/' . $decrypted_lampiran);
                }
            }

            $raw_id = $this->input->post('id', true);
            $decrypted_id = decrypt($raw_id);

            $path = FCPATH . 'app-data/bukti-realisasi-anggaran';
			$config['upload_path'] 		= $path;
			$config['allowed_types'] 	= 'jpg|jpeg|png|docx|xlsx|pptx|webp|pdf';
			$config['file_name'] 		= uniqid() . time() . '_' . $_FILES['lampiran']['name'];
			$config['max_size'] 		= 5000;
			$config['max_width']  		= 1024;
			$config['max_height']  		= 768;
			$config['encrypt_name'] 	= false;
			$config['detect_mime'] 		= true;
			$config['remove_spaces'] 	= true;
			$config['mod_mime_fix'] 	= true;
			$this->load->library('upload', $config);

            if(!$this->upload->do_upload('lampiran')){
                return show_error($this->upload->display_errors(), 402, "Error");
            } else {
                $upload_data = $this->upload->data();
				$file_size = (int) $_FILES['lampiran']['size'];                
                $ext = end($raw_ekstensi);
                
                $icon = '';
                switch($ext){
                    case $ext == 'png' || $ext == 'jpg' || $ext == 'jpeg' 
                    || $ext == 'webp':
                        $icon .= 'mdi mdi-image';
                        break;
                    case $ext == 'pdf':
                        $icon .= 'mdi mdi-file-pdf-outline';
                        break;
                    case $ext == 'doc' || $ext == 'docx':
                        $icon .= 'mdi mdi-file-word-outline';
                        break;
                    case $ext == 'xlsx':
                        $icon .= 'mdi mdi-file-excel-outline';
                        break;
                    case $ext == 'pptx':
                        $icon .= 'mdi mdi-file-powerpoint-outline';
                        break;
                        $icon .= 'UNKNOWN';
                    default:
                }                

                $ext_file = end($raw_ekstensi);

                $this->db->where('id', $decrypted_id);
                $this->db->update('ig_t_j_b_act', [
                    'nama_file_keu'     => (String) trim($_FILES['lampiran']['name']),
                    'ukuran_file_keu'   => $file_size,
                    'lampiran_keu'      => $upload_data['file_name'],
                    'ekstensi_file_keu' => $ext_file,
                    'icon_file_keu'     => $icon,
                ]);                

                $this->session->set_flashdata('alert', [
                    'message' => 'Sukses.',
                    'type'    => 'success',	
                    'title'   => ''
                ]);
                return redirect($_SERVER['HTTP_REFERER'] . '#card-rincian');
            }

        } else {
            $error = [
				'form_error' => validation_errors_array()
			];
			$this->session->set_flashdata('error_validation', $error);				
			return redirect($_SERVER['HTTP_REFERER'] . '#card-rincian');
        }
    }

    public function finalisasi_anggaran(){
        $raw_id_actbud = $this->uri->segment(4);
        $id_actbud = !decrypt($raw_id_actbud) ? show_error("Error") : decrypt($raw_id_actbud);
        $total_fnl_agr = $this->Realisasi_Anggaran_Model->get_total_anggaran_realisasi($id_actbud);
                
        $this->db->where('id', $id_actbud);
        $this->db->update('ig_tbl_actbud', [
            'realisasi' => 'Y',
            'fnl_agr' => $total_fnl_agr->total
        ]);

        $this->session->set_flashdata('alert', [
            'message' => 'Berhasil finalisasi.',
            'type'    => 'success',	
            'title'   => ''
        ]);
        return redirect($_SERVER['HTTP_REFERER'] . '#card-rincian');
    }

    public function buat_pesan(){
		$id_actbud = decrypt($this->uri->segment(4));
		$pic = decrypt($_SESSION['user_sessions']['nik']);
		$pesan = $this->input->post('pesan', true);
		
		if(isset($_POST['reply_pesan'])){
			$this->form_validation->set_rules('reply_id', 'ID', 'trim|required', [
				'required' => '%s tidak boleh kosong.'
			]);
			$this->form_validation->set_rules('reply_pesan', 'Pesan', 'trim|required', [
				'required' => '%s tidak boleh kosong.'
			]);	
	
			if($this->form_validation->run() === TRUE){
				$reply_id = decrypt($this->input->post('reply_id', true));
				$reply_pesan = $this->input->post('reply_pesan', true);
				if(!empty($_FILES['reply_attachment']['name'])){
					
					$path = FCPATH . 'app-data/chat-attachment';
					$config['upload_path'] 		= $path;
					$config['allowed_types'] 	= 'jpg|jpeg|png|docx|xlsx|pptx|vsdx|webp|pdf';
					$config['file_name'] 		= uniqid() . time() . '_' . $_FILES['reply_attachment']['name'];
					$config['max_size'] 		= 10000;
					$config['max_width']  		= 1024;
					$config['max_height']  		= 768;
					$config['encrypt_name'] 	= false;
					$config['detect_mime'] 		= true;
					$config['remove_spaces'] 	= true;
					$config['mod_mime_fix'] 	= true;
					$this->load->library('upload', $config);			
	
					if(!$this->upload->do_upload('reply_attachment')){
						return show_error($this->upload->display_errors(), 402, "Error");
					} else {
						$upload_data = $this->upload->data();
						$file_size = $_FILES['reply_attachment']['size'];
	
						$data = [
							'id_pesan' => $reply_id,							
							'nik' => $pic,
							'pesan' => $reply_pesan,
							'attachment' => $upload_data['file_name'],
							'attachment_size' => $file_size
						];
	
						$this->db->insert('ig_tbl_actbud_chat_reply', $data);
	
						$this->session->set_flashdata('alert', [
							'message' => 'Pesan berhasil terkirim.',
							'type'    => 'success',	
							'title'   => ''
						]);
		
						return redirect(base_url('app/realisasi_anggaran/actbud/' . $this->uri->segment(4) . '/' . $this->uri->segment(5) . '#card-chat'));
	
					}

				} else {					
					$this->db->insert('ig_tbl_actbud_chat_reply', [
						'id_pesan' => $reply_id,							
						'nik' => $pic,
						'pesan' => $reply_pesan,
					]);

					$this->session->set_flashdata('alert', [
						'message' => 'Pesan berhasil terkirim.',
						'type'    => 'success',	
						'title'   => ''
					]);
	
					return redirect(base_url('app/realisasi_anggaran/actbud/' . $this->uri->segment(4) . '/' . $this->uri->segment(5) . '#card-chat'));
				}

			} else {
				$error = [
					'form_error' => validation_errors_array()
				];
				$this->session->set_flashdata('error_validation', $error);				
				return redirect($_SERVER['HTTP_REFERER'] . '#card-chat');
			}

		} else {

			$this->form_validation->set_rules('pesan', 'Pesan', 'trim|required', [
				'required' => '%s tidak boleh kosong.'
			]);	
	
			if($this->form_validation->run() === TRUE){								
	
				if(!empty($_FILES['attachment']['name'])){
					
					$path = FCPATH . 'app-data/chat-attachment';
					$config['upload_path'] 		= $path;
					$config['allowed_types'] 	= 'jpg|jpeg|png|docx|xlsx|pptx|vsdx|webp|pdf';
					$config['file_name'] 		= uniqid() . time() . '_' . $_FILES['attachment']['name'];
					$config['max_size'] 		= 10000;
					$config['max_width']  		= 1024;
					$config['max_height']  		= 768;
					$config['encrypt_name'] 	= false;
					$config['detect_mime'] 		= true;
					$config['remove_spaces'] 	= true;
					$config['mod_mime_fix'] 	= true;
					$this->load->library('upload', $config);			
	
					if(!$this->upload->do_upload('attachment')){
						return show_error($this->upload->display_errors(), 402, "Error");
					} else {
						$upload_data = $this->upload->data();
						$file_size = $_FILES['attachment']['size'];
	
						$data = [
							'id_act' => $id_actbud,
							'nik' => $pic,
							'pesan' => $pesan,
							'attachment' => $upload_data['file_name'],
							'attachment_size' => $file_size
						];
	
						$this->db->insert('ig_tbl_actbud_chat', $data);
	
						$this->session->set_flashdata('alert', [
							'message' => 'Pesan berhasil terkirim.',
							'type'    => 'success',	
							'title'   => ''
						]);
		
						return redirect(base_url('app/realisasi_anggaran/actbud/' . $this->uri->segment(4) . '/' . $this->uri->segment(5) . '#card-chat'));
	
					}
	
				} else {
	
					$this->db->insert('ig_tbl_actbud_chat', [
						'id_act' => $id_actbud,
						'nik' => $pic,
						'pesan' => $pesan
					]);
					$this->session->set_flashdata('alert', [
						'message' => 'Pesan berhasil terkirim.',
						'type'    => 'success',	
						'title'   => ''
					]);
	
					return redirect(base_url('app/realisasi_anggaran/actbud/' . $this->uri->segment(4) . '/' . $this->uri->segment(5) . '#card-chat'));
				}						
							
			} else {
				$error = [
					'form_error' => validation_errors_array()
				];
				$this->session->set_flashdata('error_validation', $error);
				return redirect($_SERVER['HTTP_REFERER'] . '#card-chat');
			}
		}		
	}

    public function hapus_pesan(){
		$id = decrypt($this->input->post('id', true));
		$this->form_validation->set_rules('id', 'ID', 'trim|required', [
			'required' => '%s tidak boleh kosong.'
		]);	

		if($this->form_validation->run() === TRUE){

			$file_name = $this->input->post('attachment', true);

			if($file_name != ""){
				unlink(FCPATH . 'app-data/chat-attachment/' . $file_name);
			} 

			$this->db->where('id', $id);
			$this->db->update('ig_tbl_actbud_chat', [
				'status' => 'Tidak Aktif'
			]);			

			$this->session->set_flashdata('alert', [
				'message' => 'Pesan berhasil dihapus.',
				'type'    => 'success',	
				'title'   => ''
			]);
			return redirect(base_url('app/realisasi_anggaran/actbud/' . $this->uri->segment(4) . '/' . $this->uri->segment(5) . '#card-chat'));
		} else {
			$error = [
				'form_error' => validation_errors_array()
			];
			$this->session->set_flashdata('error_validation', $error);				
			return redirect($_SERVER['HTTP_REFERER'] . '#card-chat');
		}
	}
    
    public function hapus_lampiran_pic(){
        $id = decrypt($this->input->post('id', true));
        $attachment = decrypt($this->input->post('attachment', true));
        
		$this->form_validation->set_rules('id', 'ID', 'trim|required', [
			'required' => '%s tidak boleh kosong.'
		]);	
        $this->form_validation->set_rules('attachment', 'Attachment', 'trim|required', [
			'required' => '%s tidak boleh kosong.'
		]);

		if($this->form_validation->run() === TRUE){

            unlink(FCPATH . 'app-data/bukti-realisasi-anggaran/' . $attachment);

            $this->db->where('id', $id);
            $this->db->update('ig_t_j_b_act', [
                'lampiran' => NULL,
                'nama_file' => NULL,
                'ukuran_file' => NULL,
                'ekstensi_file' => NULL,
                'icon_file' => NULL,
            ]);

            $this->session->set_flashdata('alert', [
				'message' => 'Berhasil menghapus lampiran '.$attachment.'.',
				'type'    => 'success',	
				'title'   => ''
			]);
			return redirect(base_url('app/realisasi_anggaran/actbud/' . $this->uri->segment(4) . '/' . $this->uri->segment(5) . '#card-dt_biaya'));

        } else {
            $error = [
				'form_error' => validation_errors_array()
			];
			$this->session->set_flashdata('error_validation', $error);				
			return redirect($_SERVER['HTTP_REFERER'] . '#card-dt_biaya');
        }
    }
    
    public function hapus_lampiran_keu(){
        $id = decrypt($this->input->post('id', true));
        $attachment = decrypt($this->input->post('attachment', true));
        
		$this->form_validation->set_rules('id', 'ID', 'trim|required', [
			'required' => '%s tidak boleh kosong.'
		]);	
        $this->form_validation->set_rules('attachment', 'Attachment', 'trim|required', [
			'required' => '%s tidak boleh kosong.'
		]);

		if($this->form_validation->run() === TRUE){

            unlink(FCPATH . 'app-data/bukti-realisasi-anggaran/' . $attachment);

            $this->db->where('id', $id);
            $this->db->update('ig_t_j_b_act', [
                'lampiran_keu' => NULL,
                'nama_file_keu' => NULL,
                'ukuran_file_keu' => NULL,
                'ekstensi_file_keu' => NULL,
                'icon_file_keu' => NULL,
            ]);

            $this->session->set_flashdata('alert', [
				'message' => 'Berhasil menghapus lampiran '.$attachment.'.',
				'type'    => 'success',	
				'title'   => ''
			]);
			return redirect(base_url('app/realisasi_anggaran/actbud/' . $this->uri->segment(4) . '/' . $this->uri->segment(5) . '#card-dt_biaya'));

        } else {
            $error = [
				'form_error' => validation_errors_array()
			];
			$this->session->set_flashdata('error_validation', $error);				
			return redirect($_SERVER['HTTP_REFERER'] . '#card-dt_biaya');
        }
    }

    public function hapus_catatan_pic(){
        $raw_id = trim(filter_var($this->input->get('id', true), FILTER_SANITIZE_SPECIAL_CHARS));
        $pecah_id = explode('-', $raw_id);
        $id = !decrypt($pecah_id[1]) ? show_404() : decrypt($pecah_id[1]);

        $this->db->where('id', $id);
        $this->db->update('ig_t_j_b_act', [
            'catatan_disetujui' => NULL
        ]);

        $this->session->set_flashdata('alert', [
            'message' => 'Berhasil menghapus catatan.',
            'type'    => 'success',	
            'title'   => ''
        ]);
        return redirect(base_url('app/realisasi_anggaran/actbud/' . $this->uri->segment(4) . '/' . $this->uri->segment(5) . '#card-dt_biaya'));
    }
    
    public function hapus_catatan_keu(){
        $raw_id = trim(filter_var($this->input->get('id', true), FILTER_SANITIZE_SPECIAL_CHARS));
        $pecah_id = explode('-', $raw_id);
        $id = !decrypt($pecah_id[1]) ? show_404() : decrypt($pecah_id[1]);

        $this->db->where('id', $id);
        $this->db->update('ig_t_j_b_act', [
            'catatan_disetujui_keu' => NULL
        ]);

        $this->session->set_flashdata('alert', [
            'message' => 'Berhasil menghapus catatan.',
            'type'    => 'success',	
            'title'   => ''
        ]);
        return redirect(base_url('app/realisasi_anggaran/actbud/' . $this->uri->segment(4) . '/' . $this->uri->segment(5) . '#card-dt_biaya'));
    }
}