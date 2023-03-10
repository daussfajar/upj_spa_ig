<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->Global_model->is_logged_in();
        header("X-XSS-Protection: 1; mode=block");
    }

    public function index()
    {
        $session = $this->session->userdata('user_sessions');
        $nik = decrypt($session['nik']);
        $kode_unit = $session['kode_unit'];

        $count_actbud = $this->db->query("SELECT COUNT(*) as tot_actbud FROM tbl_actbud WHERE pic = ?", [$nik]);
        return view('spa.dashboard.dashboard');
    }
}
