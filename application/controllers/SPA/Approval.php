<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Approval extends CI_Controller{

    function __construct(){
        parent::__construct();
        $this->load->model('SPA/Approval_model', 'm_approval');
        $this->Global_model->is_logged_in();
        header("X-XSS-Protection: 1; mode=block");
    }

    public function index(){
        return show_404();
    }

    public function approval_warek_1(){
        $session = $this->session->userdata('user_sessions');
        $year = date('Y');
        $year = 2022;
        $data['approval_actbud'] = $this->m_approval->get_actbud_approval_warek1($year);

        return view('spa.approval.approval_warek1', $data);
    }
}
?>