<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Anggaran_model extends CI_Model {

    function __construct(){
        parent::__construct();
        $this->load->model('Global_model');
    }
    
    public function get_pengalihan_anggaran($year){
        $this->datatables->select("
            a.id,
            b.nama_lengkap,
            a.alasan alasan,
            a.kd_pencairan_f,
            a.periode_f,
            a.saldo_f,
            a.kd_pencairan_t,
            a.saldo_t,
            a.periode_t,
            a.nominal,
            a.status,
            a.tahun
        ");
        $this->datatables->from('tbl_pengalihan a');
        $this->datatables->join('tbl_karyawan b', 'b.nik = a.pengaju_pic', 'LEFT');
        $this->datatables->where('a.tahun', $year);
        $this->datatables->get_num_rows();
        return $this->datatables->generate();
    }

    public function get_data_uraian($where = null){
        $this->db->select("*");
        $this->db->from('tbl_uraian');
        if($where != null){
            $this->db->where($where);
        }
        $this->db->order_by('kode_pencairan', 'ASC');
        return $this->db->get()->result_array();
    }
}
?>