<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->Global_model->is_logged_in();
        $this->Global_model->is_admin();
        header("X-XSS-Protection: 1; mode=block");
    }

    public function pengaturan_umum(){      
        return view('admin.pengaturan.pengaturan_umum');
    }

    public function login_logs(){
        $data['data_logs'] = $this->Global_model->get_data_with_pagination('a.id,a.ip_address,
        a.platform,a.browser,a.status,a.date,a.user_id,b.nama_lengkap nama_user', 'logs_login a LEFT JOIN tbl_karyawan b 
        ON a.user_id = b.nik', 
        '1=1', '/' . APP_FOLDER . '/app/pengaturan/login_logs', 4, 5,4);
        //pr($data['data_logs']['data']);
        return view('admin.pengaturan.data_login_logs', $data);
    }

}