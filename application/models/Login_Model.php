<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_Model extends CI_Model {

	function __construct(){
        parent::__construct();
    }

    public function cek_login(String $email, String $password){
        $query = $this->db->query("SELECT a.nik,a.nama_lengkap,a.email,a.password,a.kode_unit,a.status,a.foto,b.nama_unit,c.keterangan_tingkatan,b.prodi_id singkatan_unit,a.kode_tingkatan FROM 
        tbl_karyawan a INNER JOIN tbl_unit b ON a.kode_unit = b.kode_unit INNER JOIN tbl_tingkatan c ON a.kode_tingkatan = c.kode_tingkatan 
        WHERE a.email = " . $this->db->escape($email) . " AND a.password = " . $this->db->escape($password) . " AND a.status = 'Aktif'");
        return $query->row();
    }
}
