<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hibah extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->Global_model->is_logged_in();
		$this->load->model('IG/Hibah_model');
		$this->Global_model->is_finance();
        header("X-XSS-Protection: 1; mode=block");
	}

	public function index()
	{
		$kode_unit = $_SESSION['user_sessions']['kode_unit'];
		$jabatan = $_SESSION['user_sessions']['kode_jabatan'];
		$qry = "";
		$imp_arr = implode("/", $this->uri->segment_array());
		if (!empty($_GET['q']) && $_GET['q'] !== "") {
			$search = trim(filter_var($this->input->get('q', true), FILTER_SANITIZE_STRING));
			$qry .= "AND (a.kode_uraian LIKE '%" . $search . "%' OR a.nama_hibah_sponsorship LIKE '%" . $search . "%' 
			OR a.uraian_kegiatan LIKE '%" . $search . "%' OR b.nama_lengkap LIKE '%".$search."%' OR 
			c.nama_unit LIKE '%".$search."%' OR a.kode_pencairan LIKE '%".$search."%')";
			$this->session->set_userdata('session_where', [
				'url' => base_url() . $imp_arr,
				'value' => $qry
			]);
		} else {
			unset($_SESSION['session_where']);
		}

		$w_karyawan = [
			'status' => 'Aktif'
		];
		$w_unit = [
			1 => 1
		];

		if($jabatan != 0){            
			if(!$kode_unit == 002){
				$w_karyawan['kode_unit'] = $kode_unit;
				$w_unit['kode_unit'] = $kode_unit;
				$qry .= "AND a.kode_unit = " . $kode_unit;
			}
		}

		$data['data'] 		= $this->Hibah_model->get_data_hibah($qry);			
		$data['karyawan']	= $this->db->get_where('tbl_karyawan', $w_karyawan);		
		$data['unit'] 		= $this->db->get_where('tbl_unit', $w_unit);
		//pr($data['data']);
		return view('ig.users.hibah.index', $data);
	}	

	public function v_buat_kegiatan(){
		$kode_uraian 			= $this->Hibah_model->get_kode_uraian_hibah();		
		$data['kode_uraian'] 	= $kode_uraian;	
		$data['karyawan']		= $this->db->get_where('tbl_karyawan', ['status' => 'Aktif']);
		$data['unit']			= $this->db->get('tbl_unit');
		return view('ig.users.hibah.tambah_data', $data);
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
			return view('ig.users.hibah.preview_upload_hibah', $data);
		} else {
			$error = [
				'form_error' => validation_errors_array()
			];
			$this->session->set_flashdata('error_validation', $error);				
			return redirect(base_url('app/sim-ig/hibah'));
		}				
	}

	public function upload_hibah(){
		$this->form_validation->set_rules('nama_hibah[]', 'Nama Hibah', 'trim|required', [
			'required' => '%s tidak boleh kosong.'
		]);
		$this->form_validation->set_rules('uraian[]', 'Uraian', 'trim|required', [
			'required' => '%s tidak boleh kosong.'
		]);
		$this->form_validation->set_rules('jenis_ig[]', 'Jenis IG', 'trim|required', [
			'required' => '%s tidak boleh kosong.'
		]);
		$this->form_validation->set_rules('kpi[]', 'KPI', 'trim|required', [
			'required' => '%s tidak boleh kosong.'
		]);
		$this->form_validation->set_rules('unit[]', 'Unit', 'trim|required|numeric', [
			'required' => '%s tidak boleh kosong.'
		]);
		$this->form_validation->set_rules('cara_ukur[]', 'Cara Ukur', 'trim|required', [
			'required' => '%s tidak boleh kosong.'
		]);
		$this->form_validation->set_rules('base_line[]', 'Base Line', 'trim|required', [
			'required' => '%s tidak boleh kosong.'
		]);
		$this->form_validation->set_rules('target[]', 'Target', 'trim|required', [
			'required' => '%s tidak boleh kosong.'
		]);
		$this->form_validation->set_rules('output[]', 'Output', 'trim|required', [
			'required' => '%s tidak boleh kosong.'
		]);
		$this->form_validation->set_rules('periode[]', 'Periode', 'trim|required|numeric', [
			'required' => '%s tidak boleh kosong.'
		]);
		$this->form_validation->set_rules('kode_pencairan[]', 'Kode Pencairan', 'trim|required', [
			'required' => '%s tidak boleh kosong.'
		]);
        $this->form_validation->set_rules('kode_sub_aktivitas[]', 'Kode Sub Aktivitas', 'trim|required', [
			'required' => '%s tidak boleh kosong.'
		]);
        $this->form_validation->set_rules('indikator_kerja_umum[]', 'Indikator Kerja Umum', 'trim|required', [
			'required' => '%s tidak boleh kosong.'
		]);
		$this->form_validation->set_rules('tahun[]', 'Tahun', 'trim|required|numeric', [
			'required' => '%s tidak boleh kosong.'
		]);
		$this->form_validation->set_rules('total_anggaran[]', 'Total Anggaran', 'trim|required|numeric', [
			'required' => '%s tidak boleh kosong.'
		]);
		$this->form_validation->set_rules('pic[]', 'PIC', 'trim|required', [
			'required' => '%s tidak boleh kosong.'
		]);
		$this->form_validation->set_rules('tanda_tangan', 'Tanda Tangan', 'trim|required', [
			'required' => '%s tidak boleh kosong.'
		]);

		if($this->form_validation->run() === TRUE){
			$nama_hibah             = $this->input->post('nama_hibah', true);
			$uraian                 = $this->input->post('uraian', true);
			$jenis_ig               = $this->input->post('jenis_ig', true);
			$kpi                    = $this->input->post('kpi', true);
			$unit                   = $this->input->post('unit', true);
			$cara_ukur              = $this->input->post('cara_ukur', true);
			$base_line              = $this->input->post('base_line', true);
			$target                 = $this->input->post('target', true);
			$output                 = $this->input->post('output', true);
			$periode                = $this->input->post('periode', true);
			$kode_pencairan         = $this->input->post('kode_pencairan', true);
            $kode_sub_aktivitas     = $this->input->post('kode_sub_aktivitas', true);
            $indikator_kerja_umum   = $this->input->post('indikator_kerja_umum', true);
			$tahun                  = $this->input->post('tahun', true);
			$total_anggaran         = $this->input->post('total_anggaran', true);
			$pic                    = $this->input->post('pic', true);
			
			$image_parts            = explode(";base64,", $_POST['tanda_tangan']);                 
            $image_base64_encode    = $image_parts[1];
			$created_by             = decrypt($_SESSION['user_sessions']['nik']);
			$index                  = 0;
			$data                   = array();
			$this->db->where('ig_tbl_uraian.jenis_ig', 'hibah');
			$this->db->where('ig_tbl_uraian.status', 'Aktif');
			$this->db->select('RIGHT(ig_tbl_uraian.kode_uraian,5) as kode_uraian', FALSE);
			$this->db->order_by('kode_uraian','DESC');    
			$this->db->limit(1);    
			$query = $this->db->get('ig_tbl_uraian');				

			foreach($nama_hibah as $input_data){	
				if($query->num_rows() <> 0){      
					$data_q = $query->row();
					$kode_q = intval($data_q->kode_uraian) + ($index + 1); 
				}
				else{      
					$kode_q = 1;  
				}
	
				$batas      = str_pad($kode_q, 5, "0", STR_PAD_LEFT);    
				$kodetampil = 'HB-'.date('m-Y').'-'.$batas;		

				array_push($data, array(
					'kode_uraian'               => $kodetampil,
					'nama_hibah_sponsorship'    => $nama_hibah[$index],
					'uraian_kegiatan'           => $uraian[$index],
					'jenis_ig'                  => $jenis_ig[$index],
					'kpi'                       => $kpi[$index],
					'cara_ukur'                 => $cara_ukur[$index],
					'base_line'                 => $base_line[$index],
					'target'                    => $target[$index],
					'output'                    => $output[$index],
					'tahun'                     => $tahun[$index],
					'total_agr'                 => $total_anggaran[$index],
					'pic'                       => $pic[$index],
					'kode_pencairan'            => $kode_pencairan[$index],
                    'kode_sub_aktivitas'        => $kode_sub_aktivitas[$index],
                    'indikator_kerja_umum'      => $indikator_kerja_umum[$index],
					'periode'                   => $periode[$index],
					'kode_unit'                 => $unit[$index],
					'finalisasi'                => 'Y',
					'created_by'                => $created_by,
					'ttd_pic'                   => $image_base64_encode
				));

				$index++;
			}			
			
			$this->db->insert_batch('ig_tbl_uraian', $data);

			$this->session->set_flashdata('alert', [
				'message' => 'Selamat anda berhasil upload hibah.',
				'type'    => 'success',	
				'title'   => ''
			]);
			return redirect(base_url('app/sim-ig/hibah'));
			
		} else {
			$error = [
				'form_error' => validation_errors_array()
			];
			$this->session->set_flashdata('error_validation', $error);				
			return redirect(base_url('app/sim-ig/hibah'));
		}
	}

	public function submit_buat_kegiatan(){
		$this->form_validation->set_rules('kode_uraian', 'Kode uraian', 'trim|required|max_length[50]', [
			'required' => '%s tidak boleh kosong.'
		]);
		$this->form_validation->set_rules('nama_hibah', 'Nama Hibah', 'trim|required', [
			'required' => '%s tidak boleh kosong.'
		]);
		$this->form_validation->set_rules('deskripsi_kegiatan', 'Deskripsi Kegiatan', 'trim|required', [
			'required' => '%s tidak boleh kosong.'
		]);
		$this->form_validation->set_rules('kpi', 'KPI', 'trim|required', [
			'required' => '%s tidak boleh kosong.'
		]);
		$this->form_validation->set_rules('base_line', 'Base Line', 'trim|required', [
			'required' => '%s tidak boleh kosong.'
		]);
		$this->form_validation->set_rules('target', 'Target', 'trim|required', [
			'required' => '%s tidak boleh kosong.'
		]);
		$this->form_validation->set_rules('cara_ukur', 'Cara Ukur', 'trim|required', [
			'required' => '%s tidak boleh kosong.'
		]);
		$this->form_validation->set_rules('output', 'Output', 'trim|required', [
			'required' => '%s tidak boleh kosong.'
		]);
		$this->form_validation->set_rules('kode_pencairan', 'Kode Pencairan', 'trim|required', [
			'required' => '%s tidak boleh kosong.'
		]);
		$this->form_validation->set_rules('total_anggaran', 'Total Anggaran', 'trim|required', [
			'required' => '%s tidak boleh kosong.'
		]);
        $this->form_validation->set_rules('kode_sub_aktivitas', 'Kode Sub Aktivitas', 'trim|required', [
			'required' => '%s tidak boleh kosong.'
		]);
        $this->form_validation->set_rules('indikator_kerja_umum', 'Indikator Kerja Umum', 'trim|required', [
			'required' => '%s tidak boleh kosong.'
		]);
		$this->form_validation->set_rules('periode', 'Periode', 'trim|required|numeric', [
			'required' => '%s tidak boleh kosong.'
		]);
		$this->form_validation->set_rules('tanda_tangan', 'Tanda Tangan', 'trim|required', [
			'required' => '%s tidak boleh kosong.'
		]);
		$this->form_validation->set_rules('accept_terms', 'Accept Terms', 'trim|required', [
			'required' => '%s tidak boleh kosong.'
		]);
		$this->form_validation->set_rules('pic', 'PIC', 'trim|required', [
			'required' => '%s tidak boleh kosong.'
		]);
		$this->form_validation->set_rules('unit', 'Unit', 'trim|required', [
			'required' => '%s tidak boleh kosong.'
		]);

		if($this->form_validation->run() === TRUE){
			$created_by = decrypt($_SESSION['user_sessions']['nik']);
			$image_parts = explode(";base64,", $_POST['tanda_tangan']);
            // Source untuk upload TTD
            //$image_type_aux = explode("image/", $image_parts[0]);
            //$image_type = $image_type_aux[1];
            //$image_base64 = base64_decode($image_parts[1]);
            //$file_name_ttd = time() . uniqid() . $image_type;
            //$file = FCPATH . 'app-data/signature/' . $file_name_ttd;      
            // tanpa upload      
            $image_base64_encode = $image_parts[1];

			$total_anggaran = $this->input->post('total_anggaran', true);			
			$total_agr = str_ireplace(".","", substr($total_anggaran, 4));
			if (!is_numeric($total_agr)) return show_error("Total anggaran harus berupa angka!");
			if (is_numeric($total_agr) && $total_agr < 0) return show_error("Total anggaran tidak boleh lebik kecil dari 0");
			
			$data = [
				'kode_uraian'               => $this->input->post('kode_uraian', true),
				'nama_hibah_sponsorship'    => $this->input->post('nama_hibah', true),
				'uraian_kegiatan'           => $this->input->post('deskripsi_kegiatan', true),
				'jenis_ig'                  => 'hibah',
				'kpi'                       => $this->input->post('kpi', true),
				'base_line'                 => $this->input->post('base_line', true),
				'cara_ukur'                 => $this->input->post('cara_ukur', true),
				'target'                    => $this->input->post('target', true),
				'output'                    => $this->input->post('output', true),
				'periode'                   => $this->input->post('periode', true),
				'pic'                       => $this->input->post('pic', true),
				'ttd_pic'                   => $image_base64_encode,
				'kode_unit'                 => $this->input->post('unit', true),
				'kode_pencairan'            => $this->input->post('kode_pencairan', true),
                'kode_sub_aktivitas'        => $this->input->post('kode_sub_aktivitas', true),
                'indikator_kerja_umum'      => $this->input->post('indikator_kerja_umum', true),
				'tahun'                     => date('Y'),
				'total_agr'                 => $total_agr,
				'created_by'                => $created_by,
				'tipe_notif'                => 'success_create_hibah'
			];

			$insert = $this->Hibah_model->insert_kegiatan_hibah($data);
			
			if($insert['success'] === TRUE){

				$this->session->set_flashdata('alert', [
					'message' => 'Selamat anda berhasil membuat kegiatan hibah.',
					'type'    => 'success',	
					'title'   => ''
				]);
				return redirect(base_url('app/sim-ig/hibah'));

			} else {
				$this->session->set_flashdata('alert', [
					'message' => 'Terjadi kesalahan saat melakukan insert data.',
					'type'    => 'error',	
					'title'   => ''
				]);
				return redirect(base_url());
			}

		} else {
			$error = [
				'form_error' => validation_errors_array()
			];
			$this->session->set_flashdata('error_validation', $error);				
			return redirect(base_url('app/sim-ig/hibah/buat_kegiatan'));
		}
	}

	public function v_detail_hibah(string $id){
		$id = !decrypt($id) ? show_404() : decrypt($id);
		$data['data'] = !empty($this->Hibah_model->get_data_hibah_by_id($id, "")) ? $this->Hibah_model->get_data_hibah_by_id($id) : show_404();	
		$data['karyawan']		= $this->db->get_where('tbl_karyawan', ['status' => 'Aktif']);
		$data['unit']			= $this->db->get('tbl_unit');	
		return view('ig.users.hibah.v_detail_hibah', $data);
	}

	public function edit_hibah(){
		$this->form_validation->set_rules('id', 'ID', 'trim|required', [
			'required' => '%s tidak boleh kosong.'
		]);
		$this->form_validation->set_rules('nama_hibah', 'Nama Hibah', 'trim|required', [
			'required' => '%s tidak boleh kosong.'
		]);
		$this->form_validation->set_rules('deskripsi_kegiatan', 'Deskripsi Kegiatan', 'trim|required', [
			'required' => '%s tidak boleh kosong.'
		]);
		$this->form_validation->set_rules('kpi', 'KPI', 'trim|required', [
			'required' => '%s tidak boleh kosong.'
		]);
		$this->form_validation->set_rules('base_line', 'Base Line', 'trim|required', [
			'required' => '%s tidak boleh kosong.'
		]);
		$this->form_validation->set_rules('target', 'Target', 'trim|required', [
			'required' => '%s tidak boleh kosong.'
		]);
		$this->form_validation->set_rules('cara_ukur', 'Cara Ukur', 'trim|required', [
			'required' => '%s tidak boleh kosong.'
		]);
		$this->form_validation->set_rules('output', 'Output', 'trim|required', [
			'required' => '%s tidak boleh kosong.'
		]);
		$this->form_validation->set_rules('kode_pencairan', 'Kode Pencairan', 'trim|required', [
			'required' => '%s tidak boleh kosong.'
		]);
        $this->form_validation->set_rules('kode_sub_aktivitas', 'Kode Sub Aktivitas', 'trim|required', [
			'required' => '%s tidak boleh kosong.'
		]);
        $this->form_validation->set_rules('indikator_kerja_umum', 'Indikator Kerja Umum', 'trim|required', [
			'required' => '%s tidak boleh kosong.'
		]);
		$this->form_validation->set_rules('total_anggaran', 'Total Anggaran', 'trim|required', [
			'required' => '%s tidak boleh kosong.'
		]);		
		$this->form_validation->set_rules('periode', 'Periode', 'trim|required|numeric', [
			'required' => '%s tidak boleh kosong.'
		]);		
		$this->form_validation->set_rules('pic', 'PIC', 'trim|required', [
			'required' => '%s tidak boleh kosong.'
		]);
		$this->form_validation->set_rules('unit', 'Unit', 'trim|required', [
			'required' => '%s tidak boleh kosong.'
		]);

		if($this->form_validation->run() === TRUE){

			$id = !decrypt($this->input->post('id', true)) ? show_404() : decrypt($this->input->post('id', true));
			$total_anggaran = $this->input->post('total_anggaran', true);			
			$total_agr = str_ireplace(".","", substr($total_anggaran, 4));
			if (!is_numeric($total_agr)) return show_error("Total anggaran harus berupa angka!");
			if (is_numeric($total_agr) && $total_agr < 0) return show_error("Total anggaran tidak boleh lebik kecil dari 0");

			$data = [				
				'nama_hibah_sponsorship' => $this->input->post('nama_hibah', true),
				'uraian_kegiatan' => $this->input->post('deskripsi_kegiatan', true),				
				'kpi' => $this->input->post('kpi', true),
				'base_line' => $this->input->post('base_line', true),
				'cara_ukur' => $this->input->post('cara_ukur', true),
				'target' => $this->input->post('target', true),
				'output' => $this->input->post('output', true),
				'periode' => $this->input->post('periode', true),				
				'kode_pencairan' => $this->input->post('kode_pencairan', true),
                'kode_sub_aktivitas' => $this->input->post('kode_sub_aktivitas', true),
                'indikator_kerja_umum' => $this->input->post('indikator_kerja_umum', true),
				'total_agr' => $total_agr,
				'pic' => $this->input->post('pic', true),				
				'kode_unit' => $this->input->post('unit', true),
			];

			if(!$_POST['tanda_tangan'] == ""){
				$image_parts = explode(";base64,", $_POST['tanda_tangan']);				    
				$image_base64_encode = $image_parts[1];
				$data['ttd_pic'] = $image_base64_encode;				
			}
			
			$update = $this->Hibah_model->edit_kegiatan_hibah($id, $data);
			
			if($update['success'] === TRUE){
				$this->session->set_flashdata('alert', [
					'message' => 'Selamat anda berhasil mengubah kegiatan hibah.',
					'type'    => 'success',	
					'title'   => ''
				]);
				return redirect(base_url('app/sim-ig/hibah'));
			} else {
				$this->session->set_flashdata('alert', [
					'message' => 'Terjadi kesalahan saat melakukan insert data.',
					'type'    => 'error',	
					'title'   => ''
				]);
				return redirect(base_url('app/sim-ig/hibah'));
			}

		} else {
			$error = [
				'form_error' => validation_errors_array()
			];
			$this->session->set_flashdata('error_validation', $error);				
			return redirect(base_url('app/sim-ig/hibah'));
		}
	}

	public function batalkan_kegiatan(){		
		$this->form_validation->set_rules('id', 'ID', 'trim|required', [
			'required' => '%s tidak boleh kosong.'
		]);		

		if($this->form_validation->run() === TRUE){

			$this->db->where('id', decrypt($this->input->post('id', true)));
			$this->db->update('ig_tbl_uraian', ['status' => 'Tidak Aktif']);

			$this->session->set_flashdata('alert', [
				'message' => 'Selamat anda berhasil membatalkan kegiatan hibah.',
				'type'    => 'success',	
				'title'   => ''
			]);
			return redirect(base_url('app/sim-ig/hibah'));

		} else {
			$error = [
				'form_error' => validation_errors_array()
			];
			$this->session->set_flashdata('error_validation', $error);				
			return redirect(base_url('app/sim-ig/hibah/v_detail/' . $this->input->post('id', true)));
		}
	}

	public function finalisasi(){
		$this->form_validation->set_rules('id', 'ID', 'trim|required', [
			'required' => '%s tidak boleh kosong.'
		]);		

		if($this->form_validation->run() === TRUE){

			$this->db->where('id', decrypt($this->input->post('id', true)));
			$this->db->update('ig_tbl_uraian', ['finalisasi' => 'Y']);

			$this->session->set_flashdata('alert', [
				'message' => 'Selamat anda berhasil melakukan finalisasi.',
				'type'    => 'success',	
				'title'   => ''
			]);
			return redirect(base_url('app/sim-ig/hibah'));

		} else {
			$error = [
				'form_error' => validation_errors_array()
			];
			$this->session->set_flashdata('error_validation', $error);				
			return redirect(base_url('app/sim-ig/hibah/v_detail/' . $this->input->post('id', true)));
		}
	}
}
