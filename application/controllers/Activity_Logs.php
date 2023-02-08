<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Activity_Logs extends CI_Controller {

	protected $field = [];

    function __construct(){
        parent::__construct();		
		$this->Global_model->not_logged_in();
        header("X-XSS-Protection: 1; mode=block");	
		$this->load->library('user_agent');
    }	

    

}