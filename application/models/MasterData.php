<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MasterData extends CI_Model {    
    
    protected $table = '';
    protected $field = [];

    function __construct(){
        parent::__construct();
    }

    public function get_karyawan(){
        $query  = "SELECT a.nik,a.nama_lengkap,a.email,a.kode_unit,a.kode_tingkatan,a.terakhir_login,a.status,
        a.foto,b.nama_unit,c.keterangan_tingkatan FROM tbl_karyawan a JOIN tbl_unit b ON a.kode_unit = b.kode_unit JOIN tbl_tingkatan c ON 
        a.kode_tingkatan = c.kode_tingkatan";
        $sql    = $this->db->query($query);
        return  $sql->result();
    }

}