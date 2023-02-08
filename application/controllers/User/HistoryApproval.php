<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HistoryApproval extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->Global_model->is_logged_in();		
        $this->load->model('Approval_model');
		$this->Global_model->is_finance();
		header("X-XSS-Protection: 1; mode=block");
	}

    public function index(){
        $where = '';
        $kode_unit = $_SESSION['user_sessions']['kode_unit'];
		$jabatan = $_SESSION['user_sessions']['kode_jabatan'];        
						
        /*if(($jabatan == 22 && ($kode_unit != 002 || $kode_unit == "006" 
        || $kode_unit == "003" || $kode_unit == "004" || $kode_unit == "013" 
        || $kode_unit == "016"))){
			$where .= "AND (a.st_kabag = 'Y')";
		} else if(($jabatan == 22 && ($kode_unit != 002 || $kode_unit != "006" 
        || $kode_unit != "003" || $kode_unit != "004" || $kode_unit != "013" 
        || $kode_unit != "016"))){
            // Kaprodi atau Ka. Unit
            $where .= "AND (a.st_kabag = 'Y')";
        } else if($jabatan == 22 && $kode_unit == 002){
            // Keuangan
            $where .= "AND (a.st_kabag = 'Y' AND a.st_sign = 'Y') OR (a.st_kabag = 'Y' AND a.st_sign IS NULL)";
        } else if($jabatan == 3){
            // Warek 1
			$where .= "AND (a.st_warek_1 = 'Y')";
		} else if($jabatan == 4){
            // Warek 2
			$where .= "AND (a.st_warek_2 = 'Y')";
		}*/

        // Sign (Pre-Approval)
		if(($jabatan == 22 && ($kode_unit != 002 || $kode_unit == "006" 
        || $kode_unit == "003" || $kode_unit == "004" || $kode_unit == "013" 
        || $kode_unit == "016"))){
			$where .= "AND (a.st_sign = 'Y')";
		} else if(($jabatan == 6 && ($kode_unit != 002 || $kode_unit != "006" 
        || $kode_unit != "003" || $kode_unit != "004" || $kode_unit != "013" 
        || $kode_unit != "016"))){
            // Kaprodi atau Ka. Unit
            $where .= "AND (a.st_kabag = 'Y')";
        } else if($jabatan == 22 && $kode_unit == 002){
            // Keuangan
            $where .= "AND (a.st_keu = 'Y')";
        } else if($jabatan == 3){
			$where .= "AND (a.st_warek_1 = 'Y')";
		} else if($jabatan == 4){
			$where .= "AND (a.st_warek_2 = 'Y')";
		} else if($jabatan == 0){
			$where .= "";
		}
        
        //pr($where);
        $qry = "";		
        $imp_arr = implode("/", $this->uri->segment_array());
		if (!empty($_GET['q']) && $_GET['q'] !== "") {
			$search = trim(filter_var($this->input->get('q', true), FILTER_SANITIZE_STRING));
			$qry .= "AND (a.kode_uraian LIKE '%" . $search . "%' OR a.kode_pencairan LIKE '%" . $search . "%' 
			OR a.nama_kegiatan LIKE '%" . $search . "%' OR a.jenis_anggaran LIKE '%" . $search . "%' 
			OR b.nama_lengkap LIKE '%" . $search . "%' OR d.nama_lengkap LIKE '%" . $search . "%' 
			OR c.nama_unit LIKE '%" . $search . "%' OR a.agr LIKE '%" . $search . "%' 
            OR a.pic LIKE '%".$search."%' OR a.pelaksana LIKE '%".$search."%')";
			$this->session->set_userdata('session_where', [
				'url' => base_url() . $imp_arr,
				'value' => $qry
			]);
		} else {
			unset($_SESSION['session_where']);
		}

        $data['data'] = $this->Approval_model->get_data_history_approval($kode_unit, $where . ' ' . $qry . '');        
        //pr($data);
        return view('users.history_approval.index', $data);
    }
}