<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notification_model extends CI_Model {    
    
    protected $table = '';
    protected $field = [];

    function __construct(){
        parent::__construct();
        $this->load->model('Global_model');
    }

    public function get_all_notification(){
        $this->table = 'ig_tbl_notifikasi';
        $nik = decrypt($_SESSION['user_sessions']['nik']);
        //SELECT a.id,a.user_name,a.owner_user_id,a.user_id,a.is_seen,a.title,
	    //a.date_created,a.message,a.color, a.icon FROM ig_tbl_notifikasi a WHERE (a.owner_user_id = '$nik' OR a.user_id = '$nik') AND a.status = 'Aktif' ORDER BY a.is_seen DESC, a.date_created DESC
        $data = $this->Global_model->get_data_with_pagination('a.id,a.user_name,a.url,a.owner_user_id,a.user_id,a.is_seen,a.title,a.is_seen,a.message,a.date_created,a.icon', 
        $this->table . " a", "(a.owner_user_id = '$nik' OR a.user_id = '$nik') AND a.status = 'Aktif' ORDER BY a.is_seen,a.date_created DESC", 
        '/' . APP_FOLDER . '/app/sim-ig/data-pemberitahuan', 4,5,4);
        return $data;
    }

}