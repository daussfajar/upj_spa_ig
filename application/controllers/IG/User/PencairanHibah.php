<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PencairanHibah extends CI_Controller {		

	function __construct(){
		parent::__construct();
		$this->Global_model->is_logged_in();
		$this->load->model('IG/Hibah_model');
		$this->load->model('IG/Actbud_model');
        header("X-XSS-Protection: 1; mode=block");
	}

    public function index($qry = ""){
		$imp_arr = implode("/", $this->uri->segment_array());
		if (!empty($_GET['q']) && $_GET['q'] !== "") {
			$search = trim(filter_var($this->input->get('q', true), FILTER_SANITIZE_STRING));
			$qry .= "AND (a.kode_uraian LIKE '%".$search."%' OR a.nama_hibah_sponsorship LIKE '%".$search."%' 
			OR a.uraian_kegiatan LIKE '%".$search."%' OR a.kode_pencairan LIKE '%".$search."%' 
            OR b.nama_lengkap LIKE '%".$search."%')";
			$this->session->set_userdata('session_where', [
				'url' => base_url() . $imp_arr,
				'value' => $qry
			]);
		} else {
			unset($_SESSION['session_where']);
		}
        
		$data['data'] = $this->Hibah_model->get_data_hibah_finalisasi($qry);
		
        return view('ig.users.hibah.v_data_pencairan', $data);
    }

	public function detail_hibah(){
		$id = !decrypt($this->uri->segment(5)) ? show_404() : decrypt($this->uri->segment(5));
		$data['data'] = !empty($this->Hibah_model->get_data_hibah_by_id($id, "")) ? $this->Hibah_model->get_data_hibah_by_id($id) : show_404();
		$data['karyawan']		= $this->db->get_where('tbl_karyawan', ['status' => 'Aktif']);
		$data['unit']			= $this->db->get('tbl_unit');	
		return view('ig.users.hibah.v_detail_hibah', $data);
	}

	public function v_detail(){
		$id = !decrypt($this->uri->segment(6)) ? show_404() : decrypt($this->uri->segment(6));
		$data['data'] = !$this->Hibah_model->get_data_hibah_by_id($id) ? show_404() : $this->Hibah_model->get_data_hibah_by_id($id);			
		$data['data_pencairan'] = $this->Hibah_model->get_data_pencairan($id);
		$agr = $this->Hibah_model->cek_anggaran_digunakan_sementara($id);        
		$data['sisa'] = (int) $data['data']->total_agr - $agr->digunakan;
		$data['total_anggaran_yang_digunakan'] = $agr->digunakan;
		$data['total_anggaran_yang_digunakan_final'] = $this->Hibah_model->cek_anggaran_digunakan_final($id);		
		
		return view('ig.users.hibah.v_detail_pencairan', $data);
	}

	public function buat_pencairan(string $id){					
		$id = !decrypt($id) ? show_404() : decrypt($id);
		$agr = $this->Hibah_model->cek_anggaran_digunakan_sementara($id);				
		$data['data'] = !$this->Hibah_model->get_data_hibah_by_id($id) ? show_error("Error", 403) : $this->Hibah_model->get_data_hibah_by_id($id);
		$agr_in_out = $this->Actbud_model->get_agr_in_out($data['data']->kode_uraian);
		$saldo_masuk = $agr_in_out['saldo_masuk'];
		$saldo_keluar = $agr_in_out['saldo_keluar'];
		$data['sisa'] = (int) ($data['data']->total_agr + ($saldo_masuk - $saldo_keluar)) - $agr->digunakan;
		$kode_unit = $data['data']->kode_unit;
		$data['karyawan'] = $this->db->get_where('tbl_karyawan', ['status' => 'Aktif', 'kode_unit' => $kode_unit]);
		$data['pelaksana'] = $this->db->get_where('tbl_karyawan', ['status' => 'Aktif']);
		$data['unit'] = $this->db->get('tbl_unit');
		$data['id_uraian'] = encrypt($id);
        // pr($data['id_uraian']);
		return view('ig.users.hibah.buat_pencairan', $data);
	}

	public function create_pencairan(){
		$this->form_validation->set_rules('kode_uraian', 'Kode Uraian', 'trim|required', [
			'required' => '%s tidak boleh kosong.'
		]);
		$this->form_validation->set_rules('kode_pencairan', 'Kode Pencairan', 'trim|required', [
			'required' => '%s tidak boleh kosong.'
		]);
		$this->form_validation->set_rules('nama_kegiatan', 'Nama Kegiatan', 'trim|required', [
			'required' => '%s tidak boleh kosong.'
		]);
		$this->form_validation->set_rules('deskripsi_kegiatan', 'Deskripsi Kegiatan', 'trim|required', [
			'required' => '%s tidak boleh kosong.'
		]);
		$this->form_validation->set_rules('kpi', 'KPI', 'trim|required', [
			'required' => '%s tidak boleh kosong.'
		]);
		$this->form_validation->set_rules('pelaksana', 'Pelaksana', 'trim|required', [
			'required' => '%s tidak boleh kosong.'
		]);
		$this->form_validation->set_rules('tgl_mulai', 'Tanggal Mulai', 'trim|required', [
			'required' => '%s tidak boleh kosong.'
		]);
		$this->form_validation->set_rules('tgl_selesai', 'Tanggal Selesai', 'trim|required', [
			'required' => '%s tidak boleh kosong.'
		]);
		$this->form_validation->set_rules('periode', 'Periode', 'trim|required', [
			'required' => '%s tidak boleh kosong.'
		]);
		$this->form_validation->set_rules('total_anggaran', 'Total Anggaran', 'trim|required', [
			'required' => '%s tidak boleh kosong.'
		]);
		// $this->form_validation->set_rules('tanda_tangan', 'Tanda Tangan', 'trim|required', [
		// 	'required' => '%s tidak boleh kosong.'
		// ]);
		$this->form_validation->set_rules('accept_terms', 'Accept Terms', 'trim|required', [
			'required' => '%s tidak boleh kosong.'
		]);

		if($this->form_validation->run() === TRUE){            
			$id = filter_var($this->input->get('id', true), FILTER_SANITIZE_STRING);
			$decrypted_id = !decrypt($id) ? show_404() : decrypt($id);
			$hibah = $this->Hibah_model->get_data_hibah_by_id($decrypted_id);		
			$agr = $this->Hibah_model->cek_anggaran_digunakan_sementara($decrypted_id);			
			// $image_parts = explode(";base64,", $_POST['tanda_tangan']);               
            // $image_base64_encode = $image_parts[1];
			// OLD $kode_unit = $_SESSION['user_sessions']['kode_unit'];
            $kode_unit = $hibah->kode_unit;
                        
			$total_anggaran = $this->input->post('total_anggaran', true);			
			$total_agr = str_ireplace(".","", substr($total_anggaran, 4));
			$pic = decrypt($_SESSION['user_sessions']['nik']);
			if (!is_numeric($total_agr)) return show_error("Total anggaran harus berupa angka!");
			if (is_numeric($total_agr) && $total_agr < 0) return show_error("Total anggaran tidak boleh lebik kecil dari 0");
			
			// OLD
			// $agr_in_out = $this->Actbud_model->get_agr_in_out($hibah->kode_uraian);
			// $saldo_masuk = $agr_in_out['saldo_masuk'];
			// $saldo_keluar = $agr_in_out['saldo_keluar'];
			// $batas = ($hibah->total_agr + ($saldo_masuk - $saldo_keluar)) - (int) (empty($agr->digunakan) ? 0 : $agr->digunakan);
			$agr_in_out = $this->Global_model->get_detail_anggaran($hibah->kode_uraian);
			$saldo_masuk = $agr_in_out->agr_masuk;
			$saldo_keluar = $agr_in_out->agr_keluar;
			$batas = ($hibah->total_agr + ($saldo_masuk - $saldo_keluar)) - (int) (empty($agr->digunakan) ? 0 : $agr->digunakan);
			
			if($batas == 0){
				$this->session->set_flashdata('alert', [
					'message' => 'Maaf anggaran anda sudah habis.',
					'type'    => 'error',	
					'title'   => 'Anggaran Habis'
				]);
				return redirect($_SERVER['HTTP_REFERER']);
			}

			if($total_agr > $batas){
				$this->session->set_flashdata('alert', [
					'message' => 'Maksimal anggaran adalah ' . rupiah($batas),
					'type'    => 'error',	
					'title'   => 'Anggaran Lewat Batas'
				]);
				return redirect($_SERVER['HTTP_REFERER']);
			} else {
				$periode = !decrypt($this->input->post('periode', true)) ? show_error("Unauthorized!") : decrypt($this->input->post('periode', true));
				$data = [
					'id_uraian' => $decrypted_id,
					'kode_uraian' => $this->input->post('kode_uraian', true),
					'kode_pencairan' => $this->input->post('kode_pencairan', true),
					'kode_unit' => $kode_unit,
					'nama_kegiatan' => $this->input->post('nama_kegiatan', true),
					'deskripsi_kegiatan' => $this->input->post('deskripsi_kegiatan', true),
					'kpi' => $this->input->post('kpi', true),
					/* OLD 'pic' => $pic,*/
                    'pic' => $hibah->pic,
					'pelaksana' => $this->input->post('pelaksana', true),
					'jenis_anggaran' => 'hibah',
					'tgl_mulai' => $this->input->post('tgl_mulai', true),
					'tgl_selesai' => $this->input->post('tgl_selesai', true),
					'periode' => $periode,
					'tahun' => date('Y'),
					'tanggal_pembuatan' => date('Y-m-d H:i:s'),
					'agr' => $total_agr,
                    'fnl_agr' => $total_agr,
					'status_act' => 'send'
				];
		
				$insert = $this->Hibah_model->create_pencairan($data);
		
				if($insert['success'] === TRUE){
		
					$this->session->set_flashdata('alert', [
						'message' => 'Selamat anda berhasil membuat pencairan hibah.',
						'type'    => 'success',	
						'title'   => ''
					]);
					return redirect(base_url('app/sim-ig/hibah/status_pencairan/v_detail/' . $this->uri->segment(6) . '/actbud/' . encrypt($this->db->insert_id())));
		
				} else {
					$this->session->set_flashdata('alert', [
						'message' => 'Terjadi kesalahan saat melakukan insert data.',
						'type'    => 'error',	
						'title'   => ''
					]);
					return redirect($_SERVER['HTTP_REFERER']);
				}
			}

		} else {
			$error = [
				'form_error' => validation_errors_array()
			];
			$this->session->set_flashdata('error_validation', $error);				
			return redirect($_SERVER['HTTP_REFERER']);
		}
	}

	public function v_detail_actbud(string $id_uraian, string $id_actbud){
		$id_uraian = !decrypt($id_uraian) ? show_404() : decrypt($id_uraian);
		$id_actbud = !decrypt($id_actbud) ? show_404() : decrypt($id_actbud);
		$data['data'] = $this->Hibah_model->get_detail_actbud($id_uraian, $id_actbud);
		if(empty($data['data'])) return show_404();
		
		$kode_unit = $data['data']->kode_unit;
		$data['karyawan'] = $this->db->get_where('tbl_karyawan', ['status' => 'Aktif', 'kode_unit' => $kode_unit]);
		$data['messages'] = $this->Hibah_model->get_data_chat_actbud($id_actbud);        
		$data['dokumen_pendukung'] = $this->db->get_where('ig_tbl_actbud_upload', ['id_act' => $id_actbud, 'status' => 'Aktif']);
		$data['rincian_kegiatan'] = $this->db->get_where('ig_t_j_b_act', ['id_actbud' => $id_actbud, 'status' => 'Aktif']);
		$data['sisa'] = $this->Hibah_model->cek_anggaran_rincian_kegiatan($id_actbud);        
		//$data['unit'] = $this->db->get('tbl_unit')->result();
		$data['anggaran_tersisa'] = (int) ($data['data']->agr - $data['sisa']->digunakan);        
		$data['id_uraian'] = encrypt($id_uraian);
		$data['id_actbud'] = encrypt($id_actbud);
		return view('ig.users.hibah.v_detail_actbud', $data);
	}

	public function batalkan_actbud(){
		$id_actbud = !decrypt($this->uri->segment(7)) ? show_404() : decrypt($this->uri->segment(7));
		$this->db->where('id', $id_actbud);
		$this->db->update('ig_tbl_actbud', [
			'status' => 'cancel'
		]);

		$this->session->set_flashdata('alert', [
			'message' => 'Selamat anda berhasil membatalkan kegiatan.',
			'type'    => 'success',	
			'title'   => ''
		]);
		return redirect($_SERVER['HTTP_REFERER']);
	}

	public function ubah_actbud(){		
		$this->form_validation->set_rules('nama_kegiatan', 'Nama Kegiatan', 'trim|required', [
			'required' => '%s tidak boleh kosong.'
		]);
		$this->form_validation->set_rules('deskripsi_kegiatan', 'Deskripsi Kegiatan', 'trim|required', [
			'required' => '%s tidak boleh kosong.'
		]);
		$this->form_validation->set_rules('kpi', 'KPI', 'trim|required', [
			'required' => '%s tidak boleh kosong.'
		]);
		$this->form_validation->set_rules('pelaksana', 'Pelaksana', 'trim|required', [
			'required' => '%s tidak boleh kosong.'
		]);
		$this->form_validation->set_rules('tgl_mulai', 'Tanggal Mulai', 'trim|required', [
			'required' => '%s tidak boleh kosong.'
		]);
		$this->form_validation->set_rules('tgl_selesai', 'Tanggal Selesai', 'trim|required', [
			'required' => '%s tidak boleh kosong.'
		]);
		$this->form_validation->set_rules('periode', 'Periode', 'trim|required', [
			'required' => '%s tidak boleh kosong.'
		]);
		$this->form_validation->set_rules('total_anggaran', 'Total Anggaran', 'trim|required', [
			'required' => '%s tidak boleh kosong.'
		]);	

		if($this->form_validation->run() === TRUE){
			$id = decrypt($this->uri->segment(7));
			$id_uraian = decrypt($this->uri->segment(5));
			$hibah = $this->Hibah_model->get_data_hibah_by_id($id_uraian);		
			$agr = $this->Hibah_model->cek_anggaran_digunakan_sementara($id_uraian);
			$sisa_anggaran = ($hibah->total_agr - $agr->digunakan);			
			$total_anggaran = $this->input->post('total_anggaran', true);			
			$total_agr = str_ireplace(".","", substr($total_anggaran, 4));
			if(!is_numeric($total_agr)) return show_error("Total anggaran harus berupa angka!");
			if(is_numeric($total_agr) && $total_agr < 0) return show_error("Total anggaran tidak boleh lebik kecil dari 0");
			
			//pr(($sisa_anggaran + $_REQUEST['old_anggaran']) - $total_agr);
			if((($sisa_anggaran + $this->input->post('old_anggaran', true)) - $total_agr) < 0) {
				$this->session->set_flashdata('alert', [
					'message' => 'Total anggaran melebihi batas.',
					'type'    => 'error',	
					'title'   => ''
				]);
				return redirect($_SERVER['HTTP_REFERER']);
			} else {
				$data = [			
					'nama_kegiatan' => $this->input->post('nama_kegiatan', true),
					'deskripsi_kegiatan' => $this->input->post('deskripsi_kegiatan', true),
					'kpi' => $this->input->post('kpi', true),
					'pelaksana' => $this->input->post('pelaksana', true),
					'tgl_mulai' => $this->input->post('tgl_mulai', true),
					'tgl_selesai' => $this->input->post('tgl_selesai', true),
					'periode' => $this->input->post('periode', true),
					'agr' => $total_agr,
				];
	
				$this->db->where('id', $id);
				$this->db->update('ig_tbl_actbud', $data);
	
				$this->session->set_flashdata('alert', [
					'message' => 'Selamat anda berhasil mengubah actbud.',
					'type'    => 'success',	
					'title'   => ''
				]);
				return redirect($_SERVER['HTTP_REFERER']);
			}			

		} else {
			$error = [
				'form_error' => validation_errors_array()
			];
			$this->session->set_flashdata('error_validation', $error);				
			return redirect($_SERVER['HTTP_REFERER']);
		}
	}

	public function buat_pesan(string $id_uraian, string $id_actbud){
		$id_actbud = decrypt($id_actbud);
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

						return redirect($_SERVER['HTTP_REFERER'] . '#card-chat');
	
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

					return redirect($_SERVER['HTTP_REFERER'] . '#card-chat');
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

						return redirect($_SERVER['HTTP_REFERER'] . '#card-chat');
	
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

					return redirect($_SERVER['HTTP_REFERER'] . '#card-chat');
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

	public function hapus_pesan(string $id_uraian, string $id_actbud){
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

			$this->db->where('id_pesan', $id);
			$this->db->update('ig_tbl_actbud_chat_reply', [
				'status' => 'Tidak Aktif'
			]);

			$this->session->set_flashdata('alert', [
				'message' => 'Pesan berhasil dihapus.',
				'type'    => 'success',	
				'title'   => ''
			]);
			return redirect($_SERVER['HTTP_REFERER'] . '#card-chat');
		} else {
			$error = [
				'form_error' => validation_errors_array()
			];
			$this->session->set_flashdata('error_validation', $error);				
			return redirect($_SERVER['HTTP_REFERER'] . '#card-chat');
		}
	}

	public function hapus_pesan_reply(string $id_uraian, string $id_actbud)
	{
		$id = decrypt($this->input->post('id', true));
		$this->form_validation->set_rules('id', 'ID', 'trim|required', [
			'required' => '%s tidak boleh kosong.'
		]);

		if ($this->form_validation->run() === TRUE) {

			$file_name = $this->input->post('attachment', true);

			if ($file_name != "") {
				unlink(FCPATH . 'app-data/chat-attachment/' . $file_name);
			}

			$this->db->where('id', $id);
			$this->db->update('ig_tbl_actbud_chat_reply', [
				'status' => 'Tidak Aktif'
			]);

			$this->session->set_flashdata('alert', [
				'message' => 'Pesan berhasil dihapus.',
				'type'    => 'success',
				'title'   => ''
			]);
			return redirect($_SERVER['HTTP_REFERER'] . '#card-chat');
		} else {
			$error = [
				'form_error' => validation_errors_array()
			];
			$this->session->set_flashdata('error_validation', $error);
			return redirect($_SERVER['HTTP_REFERER'] . '#card-chat');
		}
	}

	public function upload_dokumen_pendukung(string $id_uraian, string $id_actbud){
		$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'trim|required', [
			'required' => '%s tidak boleh kosong.'
		]);	

		if(empty($_FILES['dokumen']['name'])){
			$this->form_validation->set_rules('dokumen', 'Dokumen', 'trim|required', [
				'required' => '%s tidak boleh kosong.'
			]);	
		}

		if($this->form_validation->run() === TRUE){

			$id_actbud = decrypt($id_actbud);
			$pic = decrypt($_SESSION['user_sessions']['nik']);
			
			$path = FCPATH . 'app-data/dokumen-pendukung';
			$config['upload_path'] 		= $path;
			$config['allowed_types'] 	= 'jpg|jpeg|png|docx|xlsx|pptx|vsdx|webp|pdf';
			$config['file_name'] 		= uniqid() . time() . '_' . $_FILES['dokumen']['name'];
			$config['max_size'] 		= 10000;
			$config['max_width']  		= 1024;
			$config['max_height']  		= 768;
			$config['encrypt_name'] 	= false;
			$config['detect_mime'] 		= true;
			$config['remove_spaces'] 	= true;
			$config['mod_mime_fix'] 	= true;
			$this->load->library('upload', $config);			

			if(!$this->upload->do_upload('dokumen')){
				return show_error($this->upload->display_errors(), 402, "Error");
			} else {
				$upload_data = $this->upload->data();
				$file_size = $_FILES['dokumen']['size'];

				$data = [
					'id_act' => $id_actbud,					
					'nama_file' => $upload_data['file_name'],
					'ukuran_file' => $file_size,
					'deskripsi' => $this->input->post('deskripsi', true),
					'user_created' => $pic
				];

				$this->db->insert('ig_tbl_actbud_upload', $data);

				$this->session->set_flashdata('alert', [
					'message' => 'Selamat anda berhasil membuat dokumen pendukung.',
					'type'    => 'success',	
					'title'   => ''
				]);

				return redirect($_SERVER['HTTP_REFERER'] . '#card-dokumen-pendukung');

			}

		} else {
			$error = [
				'form_error' => validation_errors_array()
			];
			$this->session->set_flashdata('error_validation', $error);				
			return redirect($_SERVER['HTTP_REFERER']);
		}
	}

	public function hapus_dokumen_pendukung(string $id_uraian, string $id_actbud){
		$this->form_validation->set_rules('id', 'ID', 'trim|required', [
			'required' => '%s tidak boleh kosong.'
		]);	
		$this->form_validation->set_rules('file_name', 'File', 'trim|required', [
			'required' => '%s tidak boleh kosong.'
		]);			

		if($this->form_validation->run() === TRUE){
			$id = decrypt($this->input->post('id', true));
			$file_name = $this->input->post('file_name', true);

			if($file_name != ""){
				unlink(FCPATH . 'app-data/dokumen-pendukung/' . $file_name);
			} 
			
			$this->db->where('id', $id);
			$update = $this->db->update('ig_tbl_actbud_upload', [
				'status' => 'Tidak Aktif'
			]);			

			if($update) {
				$this->session->set_flashdata('alert', [
					'message' => 'Dokumen pendukung berhasil dihapus.',
					'type'    => 'success',
					'title'   => ''
				]);
				return redirect($_SERVER['HTTP_REFERER'] . '#card-dokumen-pendukung');
			} else {
				$this->session->set_flashdata('alert', [
					'message' => 'Dokumen pendukung gagal dihapus.',
					'type'    => 'success',
					'title'   => ''
				]);
				return redirect($_SERVER['HTTP_REFERER'] . '#card-dokumen-pendukung');
			}

		} else {
			$error = [
				'form_error' => validation_errors_array()
			];
			$this->session->set_flashdata('error_validation', $error);				
			return redirect($_SERVER['HTTP_REFERER']);
		}
	}

	public function buat_rincian_kegiatan(string $id_uraian, string $id_actbud){
		$this->form_validation->set_rules('nama_kegiatan', 'Nama kegiatan', 'trim|required', [
			'required' => '%s tidak boleh kosong.'
		]);
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required', [
			'required' => '%s tidak boleh kosong.'
		]);
		$this->form_validation->set_rules('total_anggaran', 'Total Anggaran', 'trim|required', [
			'required' => '%s tidak boleh kosong.'
		]);		

		if($this->form_validation->run() === TRUE){
			$id_uraian = !decrypt($id_uraian) ? show_404() : decrypt($id_uraian);		
			$id_actbud = !decrypt($id_actbud) ? show_404() : decrypt($id_actbud);
			$data['data'] = $this->Hibah_model->get_detail_actbud($id_uraian, $id_actbud);
			$data['sisa'] = $this->Hibah_model->cek_anggaran_rincian_kegiatan($id_actbud);			
			$batas = (int) ($data['data']->agr - $data['sisa']->digunakan);		
			
			$total_anggaran = $this->input->post('total_anggaran', true);			
			$total_agr = str_ireplace(".","", substr($total_anggaran, 4));
			if (!is_numeric($total_agr)) return show_error("Total anggaran harus berupa angka!");
			if (is_numeric($total_agr) && $total_agr < 0) return show_error("Total anggaran tidak boleh lebik kecil dari 0");
			
			if((($data['sisa']->digunakan != "") && ($total_agr > $batas)) || ($total_agr > $batas)){

				if($batas == 0){
					$this->session->set_flashdata('alert', [
						'message' => 'Maaf anggaran sudah habis',
						'type'    => 'error',	
						'title'   => 'Anggaran Habis'
					]);
				} else {
					$this->session->set_flashdata('alert', [
						'message' => 'Maksimal anggaran adalah ' . rupiah($batas),
						'type'    => 'error',	
						'title'   => 'Anggaran Lewat Batas'
					]);
				}

				return redirect($_SERVER['HTTP_REFERER'] . '#card-rincian');
			} else {
				$data = [
					'id_actbud' => $id_actbud,
					'nama_kegiatan' => $this->input->post('nama_kegiatan', true),
					'keterangan' => $this->input->post('keterangan', true),
                    'total_anggaran_realisasi' => $total_agr,
					'total_anggaran' => $total_agr,
				];
	
				$insert = $this->db->insert('ig_t_j_b_act', $data);
				
				if($insert === true){
					$this->session->set_flashdata('alert', [
						'message' => 'Berhasil membuat kegiatan',
						'type'    => 'success',
						'title'   => ''
					]);
					return redirect($_SERVER['HTTP_REFERER'] . '#card-rincian');
				} else {
					$this->session->set_flashdata('alert', [
						'message' => 'Gagal membuat kegiatan',
						'type'    => 'success',
						'title'   => ''
					]);
					return redirect($_SERVER['HTTP_REFERER'] . '#card-rincian');
				}
			}
															
		} else {
			$error = [
				'form_error' => validation_errors_array()
			];
			$this->session->set_flashdata('error_validation', $error);				
			return redirect($_SERVER['HTTP_REFERER']);
		}
	}

	public function hapus_rincian_kegiatan(string $id_uraian, string $id_actbud){
		$this->form_validation->set_rules('id', 'ID', 'trim|required', [
			'required' => '%s tidak boleh kosong.'
		]);
		
		if($this->form_validation->run() === TRUE){

			$id = decrypt($this->input->post('id', true));
			$this->db->where('id', $id);
			$this->db->update('ig_t_j_b_act', [
				'status' => 'Tidak Aktif'
			]);

			$this->session->set_flashdata('alert', [
				'message' => 'Berhasil menghapus kegiatan',
				'type'    => 'success',	
				'title'   => ''
			]);
			return redirect($_SERVER['HTTP_REFERER'] . '#card-rincian');

		} else {
			$error = [
				'form_error' => validation_errors_array()
			];
			$this->session->set_flashdata('error_validation', $error);				
			return redirect($_SERVER['HTTP_REFERER']);
		}
	}

	public function submit_actbud(string $id_uraian, string $id_actbud){
		$id = !decrypt($id_actbud) ? show_404() : decrypt($id_actbud);
		$id_uraian = !decrypt($id_uraian) ? show_404() : decrypt($id_uraian);
		$pre_approval = $this->input->post('pre_approval', true);

		$this->form_validation->set_rules('signature', 'Tanda Tangan', 'trim|required', [
			'required' => '%s tidak boleh kosong.'
		]);
		
		if($_REQUEST['pre_approval'] != ""){
			$this->form_validation->set_rules('pre_approval', 'Pre-Approval', 'trim|required|numeric', [
				'required' => '%s tidak boleh kosong.'
			]);
		}

		if ($this->form_validation->run() === TRUE) {			
			// ttd
			$signature = $this->input->post('signature');
			
			// if(substr($signature, -5) == "CYII=") {
			// 	$this->session->set_flashdata('alert', [
			// 		'message' => 'Tanda tangan tidak boleh kosong.',
			// 		'type'    => 'error',
			// 		'title'   => ''
			// 	]);
			// 	return redirect($_SERVER['HTTP_REFERER']);
			// }

			if (check_base64_image($signature) === false) {
				return show_error("Tanda tangan invalid!");
			}

			$signature = str_replace('data:image/png;base64,', '', $signature);
			$signature = str_replace(' ', '+', $signature);
			
			// OLD $kode_unit = $_SESSION['user_sessions']['kode_unit'];
			$this->db->where('id', $id);
			$update = $this->db->update('ig_tbl_actbud', [
				'status' => 'submitted',
				'lock_editing' => 'Y',
				'sign' => $pre_approval,
				'ttd_pic' => $signature
			]);

			if ($update === true) {
				$this->session->set_flashdata('alert', [
					'message' => 'Berhasil submit kegiatan',
					'type'    => 'success',
					'title'   => ''
				]);

				return redirect($_SERVER['HTTP_REFERER']);
			} else {
				$this->session->set_flashdata('alert', [
					'message' => 'Gagal submit kegiatan',
					'type'    => 'success',
					'title'   => ''
				]);

				return redirect($_SERVER['HTTP_REFERER']);
			}
		} else {
			$error = [
				'form_error' => validation_errors_array()
			];
			$this->session->set_flashdata('error_validation', $error);
			return redirect($_SERVER['HTTP_REFERER']);
		}
	}

	public function cetak_form_actbud(string $id_uraian, string $id_actbud){
		$this->load->library('pdf');
		$id_uraian = !decrypt($id_uraian) ? show_404() : decrypt($id_uraian);
		$id_actbud = !decrypt($id_actbud) ? show_404() : decrypt($id_actbud);
		$data['data'] = $this->Hibah_model->get_detail_actbud($id_uraian, $id_actbud);
		$data['rincian_kegiatan'] = $this->db->get_where('ig_t_j_b_act', ['id_actbud' => $id_actbud, 'status' => 'Aktif']);
		$data['sisa'] = $this->Hibah_model->cek_anggaran_rincian_kegiatan($id_actbud);
		$html = $this->load->view('ig/users/hibah/cetak_form_actbud', $data, true);
        
		$filename = $data['data']->kode_uraian . ' - ' . $data['data']->nama_kegiatan;
		$this->pdf->generate($html, $filename, true, 'A4', 'portrait');
	}
}
?>