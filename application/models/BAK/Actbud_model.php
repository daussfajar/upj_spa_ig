<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Actbud_model extends CI_Model {    
    
    protected $table = '';
    protected $field = [];

    function __construct(){
        parent::__construct();
    }
    
    public function get_data_actbud_approved(String $nik){
        $query = sprintf("SELECT * FROM ig_tbl_actbud a WHERE a.pic = '%s' AND a.status = 'approved'", $nik);
        $result = $this->db->query($query)->result();
        return $result;
    }

    public function get_data_actbud_rejected(String $nik){
        $query = sprintf("SELECT * FROM ig_tbl_actbud a WHERE a.pic = '%s' AND a.status = 'cancel'", $nik);
        $result = $this->db->query($query)->result();
        return $result;
    }

    public function get_actbud_count_rejected(String $nik){
        $query  = sprintf("SELECT COUNT(a.id) total FROM ig_tbl_actbud a WHERE a.pic = '%s' AND a.status = 'cancel'", $nik);
        $result = $this->db->query($query)->row();
        return $result;
    }

    public function get_actbud_count_approved(String $nik){
        $query  = sprintf("SELECT COUNT(a.id) total FROM ig_tbl_actbud a WHERE a.pic = '%s' AND a.status = 'approved'", $nik);
        $result = $this->db->query($query)->row();
        return $result;
    }

    public function get_agr_in_out(String $kode_uraian){
        $getSumIn = $this->db->query(sprintf("SELECT SUM(b.nominal) saldo_masuk FROM ig_tbl_in_out b WHERE b.kode_uraian = '%s' AND b.disetujui = 'Y' AND b.jenis_kredit = 'in'", $kode_uraian))->row();
        $getSumOut = $this->db->query(sprintf("SELECT SUM(b.nominal) saldo_keluar FROM ig_tbl_in_out b WHERE b.kode_uraian = '%s' AND b.disetujui = 'Y' AND b.jenis_kredit = 'out'", $kode_uraian))->row();
        $data = [
            'saldo_masuk' => $getSumIn->saldo_masuk,
            'saldo_keluar' => $getSumOut->saldo_keluar
        ];
        return $data;
    }

}