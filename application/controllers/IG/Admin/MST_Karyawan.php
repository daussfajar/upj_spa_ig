<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MST_Karyawan extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->Global_model->is_logged_in();
        $this->Global_model->is_admin();
        $this->load->model('IG/MasterData');
        header("X-XSS-Protection: 1; mode=block");
    }

    public function index(){
        $data['data'] = $this->MasterData->get_karyawan();
        $data['unit'] = $this->db->get_where('tbl_unit', ['status' => 'Aktif'])->result();
        $data['jabatan'] = $this->db->get_where('tbl_tingkatan', ['status' => 'Aktif'])->result();
        //pr($data);
        return view('ig.admin.master_data.karyawan', $data);
    }

    public function set_status(){
        $raw_nik    = $this->uri->segment(4);
        $nik        = !decrypt($raw_nik) ? show_404() : decrypt($raw_nik);
        $status     = htmlspecialchars(trim($this->input->get('status', true)));
        $data       = [];
        $nama       = htmlspecialchars(trim($this->input->get('nama_lengkap', true)));
        $msg        = "";

        switch($status){
            case (String) $status === 'Tidak Aktif';  
                $msg .= "mengaktifkan";
                $data['status'] = 'Aktif';
                break;
            case (String) $status === 'Aktif';  
                $msg .= "non-aktifkan";
                $data['status'] = 'Tidak Aktif';
                break;
        }
        
        $this->session->set_flashdata('alert', [
            'message' => 'Berhasil '.$msg.' akun '.$nama.'!',
            'type'    => 'success',	
            'title'   => ''
        ]);

        $this->db->where('nik', $nik);
        $this->db->update('tbl_karyawan', $data);

        return redirect(base_url('app/master-data/karyawan'));
    }

    public function edit_karyawan(){
        $email = trim($this->input->post('email', true));
        $nik = trim($this->input->post('nik', true));
        $original_value = $this->db->query("SELECT email FROM tbl_karyawan WHERE nik = ".$this->db->escape($nik))->row();
        $is_unique = '';

        if($email != $original_value->email){
            $is_unique .= '|is_unique[tbl_karyawan.email]';
        } else {
            $is_unique .= '';
        }
        
        $this->form_validation->set_rules('nik', 'NIK', 'trim|required', [
			'required' => '%s tidak boleh kosong'
		]);
        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'trim|required', [
			'required' => '%s tidak boleh kosong'
		]);
        $this->form_validation->set_rules('email', 'Email address', 'trim|required|valid_email|valid_emails|max_length[55]' . $is_unique, [
			'required'  => '%s tidak boleh kosong',
            'is_unique' => '%s sudah digunakan'
		]);
        $this->form_validation->set_rules('unit', 'Unit', 'trim|required', [
			'required' => '%s tidak boleh kosong'
		]);
        $this->form_validation->set_rules('jabatan', 'Jabatan', 'trim|required', [
			'required' => '%s tidak boleh kosong'
		]);
		
		if($this->form_validation->run() === TRUE){
            
            $raw_nik    = $this->uri->segment(5);
            $e_nik      = !decrypt($raw_nik) ? show_404() : decrypt($raw_nik);
            
            $this->db->where('nik', $e_nik);
            $this->db->update('tbl_karyawan', [
                'email' => $email,
                'kode_unit' => $this->input->post('unit', true),
                'kode_tingkatan' => $this->input->post('jabatan', true),
                'nama_lengkap' => $this->input->post('nama_lengkap', true)
            ]);

            $this->session->set_flashdata('alert', [
                'message' => 'Berhasil mengubah data karyawan',
                'type'    => 'success',	
                'title'   => ''
            ]);

            return redirect(base_url('app/master-data/karyawan'));

        } else {
            $error = [
				'form_error' => validation_errors_array()
			];
			$this->session->set_flashdata('error_validation', $error);				
			return redirect(base_url('app/master-data/karyawan'));
        }
    }

    public function tambah_karyawan(){
        $this->form_validation->set_rules('nik', 'NIK', 'trim|required|is_unique[tbl_karyawan.nik]', [
			'required' => '%s tidak boleh kosong',
            'is_unique' => '%s sudah digunakan'
		]);
        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'trim|required', [
			'required' => '%s tidak boleh kosong'
		]);
        $this->form_validation->set_rules('email', 'Email address', 'trim|required|valid_email|valid_emails|max_length[55]|is_unique[tbl_karyawan.email]', [
			'required'  => '%s tidak boleh kosong',
            'is_unique' => '%s sudah digunakan'
		]);
        $this->form_validation->set_rules('unit', 'Unit', 'trim|required', [
			'required' => '%s tidak boleh kosong'
		]);
        $this->form_validation->set_rules('jabatan', 'Jabatan', 'trim|required', [
			'required' => '%s tidak boleh kosong'
		]);

        if($this->form_validation->run() === TRUE){
            
            $this->db->insert('tbl_karyawan', [
                'nik' => $this->input->post('nik', true),
                'email' => $this->input->post('email', true),
                'kode_unit' => $this->input->post('unit', true),
                'kode_tingkatan' => $this->input->post('jabatan', true),
                'nama_lengkap' => $this->input->post('nama_lengkap', true),
                'status' => 'Aktif'
            ]);

            $this->session->set_flashdata('alert', [
                'message' => 'Berhasil menambah data karyawan',
                'type'    => 'success',	
                'title'   => ''
            ]);

            return redirect(base_url('app/master-data/karyawan'));
            
        } else {
            $error = [
				'form_error' => validation_errors_array()
			];
			$this->session->set_flashdata('error_validation', $error);				
			return redirect(base_url('app/master-data/karyawan'));
        }
    }


    public function hapus_karyawan(){
        $this->form_validation->set_rules('nik', 'NIK', 'trim|required', [
			'required' => '%s tidak boleh kosong'
		]);

        if($this->form_validation->run() === TRUE){
            $nik = trim($this->input->post('nik', true));

            $this->db->where('nik', $nik);
            $this->db->delete('tbl_karyawan');

            $this->session->set_flashdata('alert', [
                'message' => 'Berhasil menghapus data karyawan',
                'type'    => 'success',	
                'title'   => ''
            ]);

            return redirect(base_url('app/master-data/karyawan'));

        } else {
            $error = [
				'form_error' => validation_errors_array()
			];
			$this->session->set_flashdata('error_validation', $error);				
			return redirect(base_url('app/master-data/karyawan'));
        }
    }

    public function ubahpass_karyawan(){
        $this->form_validation->set_rules('nik', 'NIK', 'trim|required', [
			'required' => '%s tidak boleh kosong'
		]);

        if($this->form_validation->run() === TRUE){
            $nik = trim($this->input->post('nik', true));
            $password = trim($this->input->post('password', true));
            $encrypted_password = hash('sha1', md5($password));

            $this->db->where('nik', $nik);
            $this->db->update('tbl_karyawan', [
                'password' => $encrypted_password
            ]);

            $this->session->set_flashdata('alert', [
                'message' => 'Berhasil mengubah password karyawan',
                'type'    => 'success',	
                'title'   => ''
            ]);

            return redirect(base_url('app/master-data/karyawan'));
        } else {
            $error = [
				'form_error' => validation_errors_array()
			];
			$this->session->set_flashdata('error_validation', $error);				
			return redirect(base_url('app/master-data/karyawan'));
        }
    }

}