<?php

require_once 'Notification.php';

defined('BASEPATH') OR exit('No direct script access allowed');

class PengalihanAnggaran extends CI_Controller {    

	function __construct(){
        parent::__construct();
        $this->Global_model->is_logged_in();
        $this->load->model('IG/Hibah_model');
        $this->Global_model->is_finance();
        header("X-XSS-Protection: 1; mode=block");
    }

    public function index(){
        return view('ig.users.pengalihan_anggaran.index');
    }

}