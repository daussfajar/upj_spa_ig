<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Errors extends CI_Controller {

    function __construct(){
        parent::__construct();
        header("X-XSS-Protection: 1; mode=block");
    }

    public function error_404(){
        return view('404');
    }
}

?>