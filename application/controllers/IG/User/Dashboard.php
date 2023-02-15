<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->Global_model->is_logged_in();
		$this->load->model('Hibah_model');
		$this->load->model('Sponsorship_model');
		$this->load->model('Actbud_model');
		$this->load->model('Approval_model');
        header("X-XSS-Protection: 1; mode=block");
	}

	public function index()
	{			
		$nik = decrypt($_SESSION['user_sessions']['nik']);
		$jabatan = $_SESSION['user_sessions']['kode_jabatan'];
		$unit = $_SESSION['user_sessions']['kode_unit'];
		$data['jabatan'] = $jabatan;
		$data['unit'] = $unit;
		$where = "";
        		
		$data['total_hibah'] = $this->Hibah_model->get_count_hibah($nik);
		$data['total_sponsorship'] = $this->Sponsorship_model->get_count_sponsorship($nik);
		$data['total_actbud_ditolak'] = $this->Actbud_model->get_actbud_count_rejected($nik);
		$data['total_actbud_disetujui'] = $this->Actbud_model->get_actbud_count_approved($nik);
		
		// Sign (Pre-Approval)
		if(($jabatan == 22 && ($unit != 002 || $unit == "006" 
        || $unit == "003" || $unit == "004" || $unit == "013" 
        || $unit == "016"))){
			$where .= "AND (a.st_kabag = 'Y' AND a.st_sign IS NULL)";
		} else if(($jabatan == 6 && ($unit != 002 || $unit != "006" 
        || $unit != "003" || $unit != "004" || $unit != "013" 
        || $unit != "016"))){
            // Kaprodi atau Ka. Unit
            $where .= "AND (a.st_kabag IS NULL)";
        } else if($jabatan == 22 && $unit == 002){
            // Keuangan
            $where .= "AND (a.st_kabag = 'Y' AND a.st_keu IS NULL AND ((a.sign != '' AND a.st_sign = 'Y') OR (a.sign = '' AND a.st_sign IS NULL)) AND a.st_warek_1 IS NULL AND a.st_warek_2 IS NULL)";
        } else if($jabatan == 3){
			$where .= "AND (a.st_keu = 'Y' AND a.st_warek_1 IS NULL)";
		} else if($jabatan == 4){
			$where .= "AND (a.st_keu = 'Y' AND a.st_warek_2 IS NULL)";
		}
        
		$data['total_approval'] = $this->Approval_model->get_count_approval($unit, $where);		
        
		//pr($data['total_approval']);
		return view('ig.users.dashboard.index', $data);
	}
}
