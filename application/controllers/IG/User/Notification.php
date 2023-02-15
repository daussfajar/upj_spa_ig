<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Notification extends CI_Controller {

    /*
        @auth Fajar Firdaus <daussfajar28@gmail.com>
    */
    private static $table   = 'ig_tbl_notifikasi';
    private static $field   = [];

    function __construct(){
        parent::__construct();
        header("X-XSS-Protection: 1; mode=block");
    }

    public static function insert(Array $data){    
        $CI =& get_instance();
        $insert = $CI->db->insert('ig_tbl_notifikasi', $data);
        return $insert;
    }
}

?>