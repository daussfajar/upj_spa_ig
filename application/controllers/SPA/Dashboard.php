<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller{

    function __construct(){
        parent::__construct();
        header("X-XSS-Protection: 1; mode=block");
    }

    public function index(){
        return view('spa.dashboard.dashboard');
    }
}
