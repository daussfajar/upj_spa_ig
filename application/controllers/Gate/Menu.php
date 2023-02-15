<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller {

    function __construct(){
        parent::__construct();
        header("X-XSS-Protection: 1; mode=block");
    }

    public function index(){
        return view('gate-menu');
    }
}