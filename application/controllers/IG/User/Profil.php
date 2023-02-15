<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->Global_model->is_logged_in();
	}

    public function profil_saya(){
        return view('ig.users.profil.profil_saya');
    }

}