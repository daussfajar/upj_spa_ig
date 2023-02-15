<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pemberitahuan extends CI_Controller {

    function __construct(){
		parent::__construct();
		$this->Global_model->is_logged_in();	
        $this->load->model('Notification_model');
        header("X-XSS-Protection: 1; mode=block");
	}

    public function index(){
        $data['data'] = $this->Notification_model->get_all_notification();        
        return view('users.pemberitahuan.index', $data);
    }

    public function detail_pemberitahuan(){
        error_reporting(0);
        $id = $this->uri->segment(3);
        $this->db->where('id', $id);
        $this->db->update('ig_tbl_notifikasi', [
            'is_seen' => 'yes'
        ]);
        
        return view('users.pemberitahuan.detail');
    }

    public function set_sudah_dibaca_semua_pemberitahuan(){
        $user_id    = decrypt($_SESSION['user_sessions']['nik']);        
        $this->db->query("UPDATE ig_tbl_notifikasi SET is_seen = 'yes' 
        WHERE user_id = '$user_id' OR owner_user_id = '$user_id'");
        $this->session->set_flashdata('alert', [
            'message' => 'Berhasil menyetel sudah dibaca pada semua pemberitahuan.',
            'type'    => 'success',	
            'title'   => ''
        ]);

        return redirect($_SERVER['HTTP_REFERER']);
    }

    public function hapus_semua_pemberitahuan(){
        $user_id    = decrypt($_SESSION['user_sessions']['nik']);        
        $this->db->query("UPDATE ig_tbl_notifikasi SET status = 'Tidak Aktif' 
        WHERE user_id = '$user_id' OR owner_user_id = '$user_id'");
        $this->session->set_flashdata('alert', [
            'message' => 'Berhasil menghapus semua pemberitahuan.',
            'type'    => 'success',	
            'title'   => ''
        ]);

        return redirect($_SERVER['HTTP_REFERER']);
    }

    public function hapus_pemberitahuan(){
        $user_id    = decrypt($_SESSION['user_sessions']['nik']);  
        $id         = decrypt($this->uri->segment(4));
        $this->db->query("UPDATE ig_tbl_notifikasi SET status = 'Tidak Aktif' 
        WHERE user_id = '$user_id' OR owner_user_id = '$user_id'");
        $this->session->set_flashdata('alert', [
            'message' => 'Berhasil menghapus semua pemberitahuan.',
            'type'    => 'success',	
            'title'   => ''
        ]);

        return redirect($_SERVER['HTTP_REFERER']);
    }

}