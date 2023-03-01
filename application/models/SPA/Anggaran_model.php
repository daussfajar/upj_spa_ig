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
    
    public function get_realisasi_anggaran($year){
        $this->db->select("
            a.kd_act,
            a.jns_aju_agr,
            a.nama_kegiatan,
            a.fnl_agr,
            a.kode_pencairan,
            a.status_penyesuaian,
            b.nama_lengkap
        ");
        $this->db->from('tbl_actbud as a');
        $this->db->join('tbl_karyawan as b', 'b.nik = a.pic', 'LEFT');
        $this->db->where('a.tahun', $year);
        $this->db->where('a.status_act', 'send');
        $this->db->group_start();
        $this->db->like('a.st_rek', 'Disetujui');
        $this->db->or_like('a.st_pres', 'Disetujui');
        $this->db->group_end();
        $this->db->or_group_start();
        $this->db->like('a.jns_aju_agr', 'petty cash');
        $this->db->like('a.st_kabag', 'Disetujui');
        $this->db->like('a.st_keu', 'Disetujui');
        $this->db->group_end();
        $this->db->order_by('a.kd_act', 'DESC');
        return $this->db->get()->result_array();
    }
}
?>