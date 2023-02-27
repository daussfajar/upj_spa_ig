<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PencairanRKAT extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->Global_model->is_logged_in();
        header("X-XSS-Protection: 1; mode=block");
    }

    public function v_input_actbud()
    {
        return view('spa.pencairan_rkat.v_input_actbud');
    }

    public function v_view_actbud()
    {
        return view('spa.pencairan_rkat.v_view_actbud');
    }

    public function v_status_actbud()
    {
        return view('spa.pencairan_rkat.v_status_actbud');
    }

    public function v_input_pettycash()
    {
        return view('spa.pencairan_rkat.v_input_pettycash');
    }

    public function v_view_pettycash()
    {
        return view('spa.pencairan_rkat.v_view_pettycash');
    }

    public function v_status_pettycash()
    {
        return view('spa.pencairan_rkat.v_status_pettycash');
    }
}
