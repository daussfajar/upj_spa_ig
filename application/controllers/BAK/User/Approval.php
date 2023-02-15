<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Approval extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->Global_model->is_logged_in();
        $this->load->model('Approval_model');
        $this->load->model('Hibah_model');
		$this->Global_model->is_finance();
		header("X-XSS-Protection: 1; mode=block");
	}

    public function index(){
		$where = '';
        $kode_unit = $_SESSION['user_sessions']['kode_unit'];
		$jabatan = $_SESSION['user_sessions']['kode_jabatan'];        
		
        // Kaprodi atau Ka. Unit
		if(($jabatan == 6 && ($kode_unit != 002 || $kode_unit != "006" 
            || $kode_unit != "003" || $kode_unit != "004" || $kode_unit != "013" 
            || $kode_unit != "016"))){            
            $where .= "AND (a.st_kabag IS NULL)";
        } else if(($jabatan == 22 && ($kode_unit != 002 || $kode_unit == "006" 
            || $kode_unit == "003" || $kode_unit == "004" || $kode_unit == "013" 
            || $kode_unit == "016"))){
            // Sign (Pre-Approval)
			$where .= "AND (a.st_sign IS NULL AND a.st_kabag = 'Y')";
		} else if(( $jabatan == 22) && $kode_unit == 002){
            // Keuangan
            $where .= "AND (a.st_kabag = 'Y' AND (a.st_keu IS NULL  OR a.st_keu='' )
			AND ((a.sign != '' AND a.st_sign = 'Y') OR (a.sign = '' AND a.st_sign IS NULL)) 
			AND a.st_warek_1 IS NULL 
			AND a.st_warek_2 IS NULL)";
		} else if($jabatan == 3){
			$where .= "AND (a.st_kabag = 'Y' AND a.st_keu = 'Y' AND a.st_warek_1 IS NULL)";
		} else if($jabatan == 4){
			$where .= "AND (a.st_kabag = 'Y' AND a.st_keu = 'Y' AND a.st_warek_2 IS NULL)";
		} else if($jabatan == 0){
			$where .= "";
		}
       
		$qry = "";
		$imp_arr = implode("/", $this->uri->segment_array());
		if (!empty($_GET['q']) && $_GET['q'] !== "") {
			$search = trim(filter_var($this->input->get('q', true), FILTER_SANITIZE_STRING));
			$qry .= "AND (a.kode_uraian LIKE '%" . $search . "%' OR a.kode_pencairan LIKE '%" . $search . "%' 
			OR a.nama_kegiatan LIKE '%" . $search . "%' OR a.jenis_anggaran LIKE '%" . $search . "%' 
			OR b.nama_lengkap LIKE '%" . $search . "%' OR d.nama_lengkap LIKE '%" . $search . "%' 
			OR c.nama_unit LIKE '%" . $search . "%' OR a.agr LIKE '%" . $search . "%' OR a.pic LIKE '%".$search."%' 
            OR a.pelaksana LIKE '%".$search."%')";
			$this->session->set_userdata('session_where', [
				'url' => base_url() . $imp_arr,
				'value' => $qry
			]);
		} else {
			unset($_SESSION['session_where']);
		}
		
		$data['data'] = $this->Approval_model->get_data_approval($kode_unit, $where . ' ' . $qry . ' ');
        return view('users.approval.index', $data);
    }

    public function v_detail(){			
		$id = !decrypt($this->uri->segment(4)) ? show_404() : decrypt($this->uri->segment(4));
        $data['data'] = !empty($this->Approval_model->get_approval_by_id($id)) ? $this->Approval_model->get_approval_by_id($id) : redirect(base_url('app/approval'));
        $data['detail_biaya'] = $this->db->get_where('ig_t_j_b_act', ['id_actbud' => $data['data']->id, 'status' => 'Aktif']);
        $data['messages'] = $this->Hibah_model->get_data_chat_actbud($data['data']->id);
		$data['dokumen_pendukung'] = $this->db->get_where('ig_tbl_actbud_upload', ['id_act' => $data['data']->id, 'status' => 'Aktif']);
        //pr($data['data']);		
        return view('users.approval.v_detail', $data);
    }

    public function buat_catatan_wr_1(){
        $id = decrypt($this->input->post('id', true));
        $id_actbud = decrypt($this->uri->segment(4));

        $this->form_validation->set_rules('id', 'ID', 'trim|required', [
            'required' => '%s tidak boleh kosong.'
        ]);	

        if($this->form_validation->run() === TRUE){

            $this->db->where('id', $id);
            $this->db->update('ig_t_j_b_act', [
                'catatan_wr_1' => $this->input->post('catatan', true)
            ]);

            $this->session->set_flashdata('alert', [
                'message' => 'Berhasil membuat catatan.',
                'type'    => 'success',	
                'title'   => ''
            ]);

            return redirect(base_url('app/approval/v_detail/' . $this->uri->segment(4)));

        } else {
            $error = [
                'form_error' => validation_errors_array()
            ];
            $this->session->set_flashdata('error_validation', $error);				
            return redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function buat_catatan_wr_2(){
        $id = decrypt($this->input->post('id', true));
        $id_actbud = decrypt($this->uri->segment(4));

        $this->form_validation->set_rules('id', 'ID', 'trim|required', [
            'required' => '%s tidak boleh kosong.'
        ]);	

        if($this->form_validation->run() === TRUE){

            $this->db->where('id', $id);
            $this->db->update('ig_t_j_b_act', [
                'catatan_wr_2' => $this->input->post('catatan', true)
            ]);

            $this->session->set_flashdata('alert', [
                'message' => 'Berhasil membuat catatan.',
                'type'    => 'success',	
                'title'   => ''
            ]);

            return redirect(base_url('app/approval/v_detail/' . $this->uri->segment(4)));

        } else {
            $error = [
                'form_error' => validation_errors_array()
            ];
            $this->session->set_flashdata('error_validation', $error);				
            return redirect($_SERVER['HTTP_REFERER']);
        }
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
		
						return redirect(base_url('app/approval/v_detail/' . $this->uri->segment(4)));
	
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
	
					return redirect(base_url('app/approval/v_detail/' . $this->uri->segment(4)));					
				}

			} else {
				$error = [
					'form_error' => validation_errors_array()
				];
				$this->session->set_flashdata('error_validation', $error);				
				return redirect($_SERVER['HTTP_REFERER']);
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
		
						return redirect(base_url('app/approval/v_detail/' . $this->uri->segment(4)));
	
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
	
					return redirect(base_url('app/approval/v_detail/' . $this->uri->segment(4)));
				}						
							
			} else {
				$error = [
					'form_error' => validation_errors_array()
				];
				$this->session->set_flashdata('error_validation', $error);				
				return redirect($_SERVER['HTTP_REFERER']);
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
			return redirect(base_url('app/approval/v_detail/' . $this->uri->segment(4)));
		} else {
			$error = [
				'form_error' => validation_errors_array()
			];
			$this->session->set_flashdata('error_validation', $error);				
			return redirect($_SERVER['HTTP_REFERER']);
		}
    }

    public function submit_actbud(){
        $kode_jabatan = $_SESSION['user_sessions']['kode_jabatan'];
        $id_actbud = decrypt($this->uri->segment(4));
		$kode_unit = $_SESSION['user_sessions']['kode_unit'];
		$sign = $this->input->post('sign', true);
		$nik = decrypt($_SESSION['user_sessions']['nik']);
		$pre_kode_unit = $this->input->post('kode_unit', true);
		$nama = $_SESSION['user_sessions']['nama_lengkap'];
		$approval = $this->input->post('approval', true);

        $this->form_validation->set_rules('approval', 'Approval', 'trim|required', [
			'required' => '%s tidak boleh kosong.'
		]);

		if($this->form_validation->run() === TRUE){						

            $this->db->where('id', $id_actbud);
			$data = [];						

            if($kode_jabatan == 6){
				// KABAG
				$data = [
                    'st_kabag' => $approval,
                    'c_kabag' => $this->input->post('catatan', true),
                    'stamp_kabag' => date('Y-m-d H:i:s'),					
					'nama_kabag' => $nama
                ];

            } else if($kode_jabatan == 3){

				// WAREK 1
				$data = [
                    'st_warek_1' => $approval,
                    'c_warek1' => $this->input->post('catatan', true),
                    'stamp_warek1' => date('Y-m-d H:i:s'),					
					'nama_warek_1' => $nama
                ];

            } else  if($kode_jabatan == 4){
				// WAREK 2 (masih manual)
				$data = [
                    'st_warek_2' => $approval,
                    'c_warek2' => $this->input->post('catatan', true),
                    'stamp_warek2' => date('Y-m-d H:i:s'),		
					'nama_warek_2' => $nama
                ];

            } else  if($kode_jabatan == 22 && $kode_unit == 002){
				// KEUANGAN
				$data = [
                    'st_keu' => $approval,
                    'c_keu' => $this->input->post('catatan', true),
                    'stamp_keu' => date('Y-m-d H:i:s'),					
					'nama_keu' => $nama
                ];

            } else if(($sign == $pre_kode_unit && $pre_kode_unit == $kode_unit) && $kode_jabatan == 22){
				// SIGN (BEBAS ISINYA BISA ICT,UMUM,P2M,BKAL,HRD, BOLEH JUGA KOSONG)
				// KONDISI JIKA SIGN NYA UNITNYA SENDIRI
				$data = [
                    'st_sign' => $approval,
                    'c_sign' => $this->input->post('catatan', true),
                    'stamp_sign' => date('Y-m-d H:i:s'),					
					'st_kabag' => $approval,
                    'c_kabag' => $this->input->post('catatan', true),
                    'stamp_kabag' => date('Y-m-d H:i:s'),					
					'nama_kabag' => $nama,
					'nama_sign' => $nama
                ];

			} else if($kode_unit == $pre_kode_unit && $kode_jabatan == 22){
				$data = [                    
					'st_kabag' => $approval,
					'c_kabag' => $this->input->post('catatan', true),
					'stamp_kabag' => date('Y-m-d H:i:s'),
					'nama_kabag' => $nama,					
				];

				if($sign == ''){
					$data['st_sign'] = $approval;					
				}								

			} else if($kode_unit != $pre_kode_unit && $kode_jabatan == 22){
				$data = [                    
					'st_sign' => $approval,
					'c_sign' => $this->input->post('catatan', true),
					'stamp_sign' => date('Y-m-d H:i:s'),
					'nama_sign' => $nama,					
				];				
			} else if($kode_jabatan == 0){
				$approval_as = $this->input->post('approval_as', true);
				switch($approval_as){
					case 'kaprodi':
						$data = [
							'st_kabag' => $approval,
							'c_kabag' => $this->input->post('catatan', true),
							'stamp_kabag' => date('Y-m-d H:i:s'),					
							'nama_kabag' => $nama
						];
						break;
					case 'sign':
						$data = [                    
							'st_sign' => $approval,
							'c_sign' => $this->input->post('catatan', true),
							'stamp_sign' => date('Y-m-d H:i:s'),
							'nama_sign' => $nama,					
						];
						break;
					case 'keuangan':
						$data = [
							'st_keu' => $approval,
							'c_keu' => $this->input->post('catatan', true),
							'stamp_keu' => date('Y-m-d H:i:s'),					
							'nama_keu' => $nama
						];
						break;
					case 'warek1':
						$data = [
							'st_warek_1' => $approval,
							'c_warek1' => $this->input->post('catatan', true),
							'stamp_warek1' => date('Y-m-d H:i:s'),					
							'nama_warek_1' => $nama
						];
						break;
					case 'warek2':
						$data = [
							'st_warek_2' => $approval,
							'c_warek2' => $this->input->post('catatan', true),
							'stamp_warek2' => date('Y-m-d H:i:s'),					
							'status' => 'approved',
							'nama_warek_2' => $nama
						];
						break;
					case 'all':
						$data = [
							'st_kabag' => $approval,
							'c_kabag' => $this->input->post('catatan', true),
							'stamp_kabag' => date('Y-m-d H:i:s'),					
							'nama_kabag' => $nama,
							'st_sign' => $approval,
							'c_sign' => $this->input->post('catatan', true),
							'stamp_sign' => date('Y-m-d H:i:s'),
							'nama_sign' => $nama,
							'st_keu' => $approval,
							'c_keu' => $this->input->post('catatan', true),
							'stamp_keu' => date('Y-m-d H:i:s'),					
							'nama_keu' => $nama,
							'st_warek_1' => $approval,
							'c_warek1' => $this->input->post('catatan', true),
							'stamp_warek1' => date('Y-m-d H:i:s'),					
							'nama_warek_1' => $nama,
							'st_warek_2' => $approval,
							'c_warek2' => $this->input->post('catatan', true),
							'stamp_warek2' => date('Y-m-d H:i:s'),					
							'status' => 'approved',
							'nama_warek_2' => $nama
						];
						break;
					default:
					show_error("Not in option!");
				}				
			}

			if($approval == 'N'){
				$data['status'] = 'cancel';
			}
			
			$this->db->update('ig_tbl_actbud', $data);
			
			// NEW
			$actbud_data = $this->db->query("SELECT a.st_warek_1,a.st_warek_2 FROM ig_tbl_actbud a 
			WHERE a.id = '$id_actbud'")->row_array();

			if($actbud_data['st_warek_1'] == 'Y' && $actbud_data['st_warek_2'] == 'Y'){
				$this->db->where('id', $id_actbud);
				$this->db->update('ig_tbl_actbud', [
					'status' => 'approved'
				]);
			}
			
            $this->session->set_flashdata('alert', [
				'message' => 'Actbud berhasil disetujui.',
				'type'    => 'success',	
				'title'   => ''
			]);

			if($data['status'] == 'approved'){
				return redirect(base_url('app/approval'));
			} else {
				return redirect(base_url('app/approval/v_detail/' . $this->uri->segment(4)));
			}			
            
        } else {
            $error = [
				'form_error' => validation_errors_array()
			];
			$this->session->set_flashdata('error_validation', $error);				
			return redirect($_SERVER['HTTP_REFERER']);
        }
    }

}