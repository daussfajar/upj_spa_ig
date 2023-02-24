<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Actbud extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->Global_model->is_logged_in();
        $this->load->model('Actbud_model');
        header("X-XSS-Protection: 1; mode=block");
    }

    public function index()
    {
        return view('spa.actbud.index');
    }
}
