<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller {

    private $data = [];

	function __construct(){
        parent::__construct();
        $this->Global_model->is_logged_in();
        header("X-XSS-Protection: 1; mode=block");
    }

    public function logout(){
        $session            = $this->session->userdata('user_sessions');
        $this->data['nama'] = $session['nama_lengkap'];
        $nik = decrypt($session['nik']);
        
        if(!empty($session)){        
            $this->db->where('nik', $nik);
            $update = $this->db->update('tbl_karyawan', [
                'terakhir_login' => date('Y-m-d H:i:s'),
            ]);
        }

        $this->session->unset_userdata('user_sessions');
        
        $this->session->set_flashdata('alert', [
            'message'   => 'Anda berhasil keluar ' . $this->data['nama'] . '!',
            'type'      => 'success',
            'title'     => 'Logout Sukses'
        ]);        
        return redirect(base_url());
    }
}
