<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RKAT_model extends CI_Model {    

    function __construct(){
        parent::__construct();
    }

    public function get_master_data_karyawan($where = null){
        if($where != null){
            return $this->db->select('*')->from('tbl_karyawan')->where('status', 'Aktif')->where($where)->order_by('nama_lengkap')->get()->result_array();
        } else {
            return $this->db->select('*')->from('tbl_karyawan')->where('status', 'Aktif')->order_by('nama_lengkap')->get()->result_array();
        }
    }

    public function get_rkat_master($where = null){
        if($where != null){
            return $this->db->select('*')->from('tbl_rkat_master')->where('NA', 'N')->where($where)->get();
        } else {
            return $this->db->select('*')->from('tbl_rkat_master')->where('NA', 'N')->get();
        }
    }

    public function get_pic_rkat($kode_rkat_master, $periode, $kode_pencairan){
        $this->datatables->select("
            a1.kode_pencairan as kode_pencairan, 
            a1.kode_uraian as kode_uraian,
            a1.uraian,
            a1.pic,
            a5.nama_lengkap,
            IF (a1.periode='1', 'Ganjil', 'Genap') AS periode,
            ((ifnull( a1.total_agr ,'0') + ifnull( a3.n_in ,'0')) - (sum(ifnull( a2.t_pyn_agr ,'0')) + ifnull( a4.n_out ,'0'))) AS sisa_anggaran
        ");
        $this->datatables->from('tbl_uraian as a1');
        $this->datatables->join('total_kdact as a2', 'a2.kode_uraian = a1.kode_uraian', 'LEFT');
        $this->datatables->join('p_in as a3', 'a3.id_uraian_t = a1.kode_uraian', 'LEFT');
        $this->datatables->join('p_out as a4', 'a4.id_uraian_f = a1.kode_uraian', 'LEFT');
        $this->datatables->join('tbl_karyawan as a5', 'a5.nik = a1.pic', 'LEFT');
        $this->datatables->where('a1.kode_rkat_master', $kode_rkat_master);
        $this->datatables->where('a1.periode', $periode);
        $this->datatables->like('a1.kode_pencairan', $kode_pencairan);
        $this->datatables->group_by('a1.kode_uraian');
        $this->datatables->order_by('a1.kode_pencairan');
        $this->datatables->get_num_rows();
        return $this->datatables->generate();
    }
    
}
?>