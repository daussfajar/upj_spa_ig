<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StatusPencairanSponsorship extends CI_Controller {		

	function __construct(){
		parent::__construct();
		$this->Global_model->is_logged_in();
		$this->load->model('IG/Sponsorship_model');
        header("X-XSS-Protection: 1; mode=block");
	}

    public function index(){
        $unit 	= $_SESSION['user_sessions']['kode_unit'];
		$nik	= decrypt($_SESSION['user_sessions']['nik']);		
		$qry = "";
		$imp_arr = implode("/", $this->uri->segment_array());
		if (!empty($_GET['q']) && $_GET['q'] !== "") {
			$search = trim(filter_var($this->input->get('q', true), FILTER_SANITIZE_STRING));
			$qry .= "AND (c.kode_uraian LIKE '%".$search."%' OR a.nama_kegiatan LIKE '%".$search."%' 
			OR a.kode_pencairan LIKE '%".$search."%' OR a.deskripsi_kegiatan LIKE '%".$search."%')";
			$this->session->set_userdata('session_where', [
				'url' => base_url() . $imp_arr,
				'value' => $qry
			]);
		} else {
			unset($_SESSION['session_where']);
		}
		
		$data['data'] = $this->Sponsorship_model->get_data_pencairan_all($nik, $qry);
        return view('ig.users.sponsorship.v_status_pencairan', $data);
    }

}

?>