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

    public function get_pic_rkat_admin($kode_pencairan, $year){
        $this->datatables->select("
            a1.kode_pencairan as kode_pencairan, 
            a1.kode_uraian as kode_uraian,
            a1.uraian,
            a1.kpi,
            a1.pic,
            a1.rp_ganjil,
            a1.rp_genap,
            a3.nama_lengkap,
            a4.nama_unit,
        ");
        $this->datatables->from('tbl_uraian as a1');
        $this->datatables->join('tbl_rkat_master as a2', 'a2.kode_rkat_master = a1.kode_rkat_master', 'LEFT');
        $this->datatables->join('tbl_karyawan as a3', 'a3.nik = a1.pic', 'LEFT');
        $this->datatables->join('tbl_unit as a4', 'a4.kode_unit = a3.kode_unit', 'LEFT');
        $this->datatables->like('a1.kode_pencairan', $kode_pencairan);
        $this->datatables->where('a2.tahun_berlaku', $year);
        $this->datatables->group_by('a1.kode_uraian');
        $this->datatables->get_num_rows();
        return $this->datatables->generate();
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
        $this->datatables->get_num_rows();
        return $this->datatables->generate();
    }

    public function get_where_pic_rkat($kode_rkat_master, $periode, $where = null)
    {
        $this->datatables->select("
            a1.kode_pencairan as kode_pencairan, 
            a1.kode_uraian as kode_uraian,
            a1.uraian,
            a1.pic,
            a5.nama_lengkap,
            a1.rp_ganjil,
            a1.rp_genap,
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
        if($where != null){
            $this->datatables->where($where);
        }

        $this->datatables->group_by('a1.kode_uraian');
        $this->datatables->get_num_rows();
        return $this->datatables->generate();
    }

    public function get_detail_uraian($kode_rkat_master, $periode, $where = null)
    {
        $sql = $this->db->select("
            a1.kode_uraian,
            a7.kd_act,
            a1.kode_rkat_master,
            a1.tahun,
            a1.kode_pencairan as kode_pencairan, 
            a1.kode_uraian as kode_uraian,
            a1.nama_isu,
            a1.uraian,
            a7.deskrip_keg,
            a7.jns_aju_agr,
            a1.renstra_prodi,
            a1.renstra_univ,
            a1.pic,
            a7.pelaksana,
            a1.no_borang,
            a1.kpi,
            a1.cara_ukur,
            a1.base_line,
            a1.target,
            a1.output,
            a5.nama_lengkap,
            a8.nama_lengkap as nama_pelaksana,
            a6.kode_unit,
            a6.nama_unit,
            a7.tgl_m,
            a7.tgl_s,
            a7.tanggal_pembuatan,
            IF (a1.periode='1', 'Ganjil', 'Genap') AS periode,            
            ifnull( a1.rp_ganjil ,'0') AS rp_ganjil,
            ifnull( a1.rp_genap ,'0') AS rp_genap,
            ifnull( a1.total_agr ,'0') AS total_agr,            
            ifnull( a1.total_agr_stj ,'0') AS total_agr_stj,
            sum(ifnull( a2.t_aju_agr ,'0')) AS  t_aju_agr,
            sum(ifnull( a2.t_pyn_agr ,'0')) AS  t_pyn_agr,
            ifnull( a3.n_in ,'0') AS n_in,
            ifnull( a4.n_out ,'0') AS n_out,
            ((ifnull( a1.total_agr ,'0') + ifnull( a3.n_in ,'0')) - (sum(ifnull( a2.t_pyn_agr ,'0')) + ifnull( a4.n_out ,'0'))) AS sisa_anggaran,
            a7.agr as t_act_agr,
        ")
        ->from('tbl_uraian as a1')
        ->join('total_kdact as a2', 'a2.kode_uraian = a1.kode_uraian', 'LEFT')
        ->join('tbl_actbud as a7',  'a1.kode_uraian = a7.kode_uraian', 'LEFT')
        ->join('p_in as a3', 'a3.id_uraian_t = a1.kode_uraian', 'LEFT')
        ->join('p_out as a4', 'a4.id_uraian_f = a1.kode_uraian', 'LEFT')
        ->join('tbl_karyawan as a5', 'a5.nik = a1.pic')
        ->join('tbl_unit as a6', 'a5.kode_unit = a6.kode_unit', 'LEFT')
        ->join('tbl_karyawan as a8', 'a7.pelaksana = a8.nik', 'LEFT')
        ->where($where)
        ->group_by('a1.kode_uraian')
        ->get()
        ->row_array();
        
        return $sql;
    }

    public function get_list_rkat($kode_rkat_master, $periode, $kode_pencairan){
        $this->db->select("
            a1.kode_pencairan as kode_pencairan, 
            a1.kode_uraian as kode_uraian,
            a1.uraian,
            a1.kpi,
            a1.renstra_prodi,
            a1.renstra_univ,
            a1.pic,
            a1.tahun,
            a1.total_agr_stj,
            a5.nama_lengkap,
            IF (a1.periode='1', 'Ganjil', 'Genap') AS periode,
            ifnull( a1.total_agr ,'0') AS total_agr,
            sum(ifnull( a2.t_aju_agr ,'0')) AS  t_aju_agr,
            sum(ifnull( a2.t_pyn_agr ,'0')) AS  t_pyn_agr,
            ifnull( a3.n_in ,'0') AS n_in,
            ifnull( a4.n_out ,'0') AS n_out,
            ((ifnull( a1.total_agr ,'0') + ifnull( a3.n_in ,'0')) - (sum(ifnull( a2.t_pyn_agr ,'0')) + ifnull( a4.n_out ,'0'))) AS sisa_agr
        ");
        $this->db->from('tbl_uraian as a1');
        $this->db->join('total_kdact as a2', 'a2.kode_uraian = a1.kode_uraian', 'LEFT');
        $this->db->join('p_in as a3', 'a3.id_uraian_t = a1.kode_uraian', 'LEFT');
        $this->db->join('p_out as a4', 'a4.id_uraian_f = a1.kode_uraian', 'LEFT');
        $this->db->join('tbl_karyawan as a5', 'a5.nik = a1.pic', 'LEFT');
        $this->db->where('a1.kode_rkat_master', $kode_rkat_master);
        $this->db->where('a1.periode', $periode);
        $this->db->like('a1.kode_pencairan', $kode_pencairan);
        $this->db->group_by('a1.kode_uraian');
        return $this->db->get()->result_array();
    }

    public function get_list_rkat_admin($kode_pencairan, $year){
        $this->db->select("
            a1.kode_pencairan as kode_pencairan, 
            a1.kode_uraian as kode_uraian,
            a1.uraian,
            a1.kpi,
            a1.renstra_prodi,
            a1.renstra_univ,
            a1.pic,
            a1.tahun,
            a1.total_agr_stj,
            a5.nama_lengkap,
            a6.nama_unit,
            IF (a1.periode='1', 'Ganjil', 'Genap') AS periode,
            ifnull( a1.total_agr ,'0') AS total_agr,
            sum(ifnull( a2.t_aju_agr ,'0')) AS  t_aju_agr,
            sum(ifnull( a2.t_pyn_agr ,'0')) AS  t_pyn_agr,
            ifnull( a3.n_in ,'0') AS n_in,
            ifnull( a4.n_out ,'0') AS n_out,
            ((ifnull( a1.total_agr ,'0') + ifnull( a3.n_in ,'0')) - (sum(ifnull( a2.t_pyn_agr ,'0')) + ifnull( a4.n_out ,'0'))) AS sisa_agr
        ");
        $this->db->from('tbl_uraian as a1');
        $this->db->join('total_kdact as a2', 'a2.kode_uraian = a1.kode_uraian', 'LEFT');
        $this->db->join('p_in as a3', 'a3.id_uraian_t = a1.kode_uraian', 'LEFT');
        $this->db->join('p_out as a4', 'a4.id_uraian_f = a1.kode_uraian', 'LEFT');
        $this->db->join('tbl_karyawan as a5', 'a5.nik = a1.pic', 'LEFT');
        $this->db->join('tbl_unit as a6', 'a6.kode_unit = a5.kode_unit', 'LEFT');
        $this->db->where('a1.tahun', $year);
        $this->db->like('a1.kode_pencairan', $kode_pencairan);
        $this->db->group_by('a1.kode_uraian');
        return $this->db->get()->result_array();
    }
    
}
?>