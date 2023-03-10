<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pemberitahuan extends CI_Controller {

    function __construct(){
		parent::__construct();
		$this->Global_model->is_logged_in();	
        $this->load->model('IG/Notification_model');
        header("X-XSS-Protection: 1; mode=block");
	}

    public function index(){
        $qry = "";
        $imp_arr = implode("/", $this->uri->segment_array());
        if (!empty($_GET['q']) && $_GET['q'] !== "") {
            $search = trim(filter_var($this->input->get('q', true), FILTER_SANITIZE_STRING));
            $qry .= "";
            $this->session->set_userdata('session_where', [
                'url' => base_url() . $imp_arr,
                'value' => $qry
            ]);
        } else {
            unset($_SESSION['session_where']);
        }        
        $data['data'] = $this->Notification_model->get_all_notification();        
        return view('ig.users.pemberitahuan.index', $data);
    }

    public function detail_pemberitahuan(){
        error_reporting(0);
        $id = $this->uri->segment(3);
        $this->db->where('id', $id);
        $this->db->update('ig_tbl_notifikasi', [
            'is_seen' => 'yes'
        ]);
        
        return view('ig.users.pemberitahuan.detail');
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

        return redirect(base_url('app/sim-ig/data-pemberitahuan'));
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