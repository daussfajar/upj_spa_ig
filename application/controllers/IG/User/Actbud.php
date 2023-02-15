<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Actbud extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->Global_model->is_logged_in();
        $this->load->model('Actbud_model');
        header("X-XSS-Protection: 1; mode=block");
    }

    public function index(){
        // return true
    }
    
    public function v_actbud_disetujui(){
        $nik = decrypt($_SESSION['user_sessions']['nik']);
        $data['actbud'] = $this->Actbud_model->get_data_actbud_approved($nik);
        return view('ig.users.table.v_actbud_disetujui', $data);
    }

    public function v_actbud_ditolak(){
        $nik = decrypt($_SESSION['user_sessions']['nik']);
        $data['actbud'] = $this->Actbud_model->get_data_actbud_rejected($nik);
        return view('ig.users.table.v_actbud_ditolak', $data);
    }
}

?>