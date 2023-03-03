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
            ifnull(a7.status_act, 'belum dikirim') as status_act,
            if (a1.periode='1', 'Ganjil', 'Genap') as periode,
            ifnull( a1.rp_ganjil ,'0') as rp_ganjil,
            ifnull( a1.rp_genap ,'0') as rp_genap,
            ifnull( a1.total_agr ,'0') as total_agr,            
            ifnull( a1.total_agr_stj ,'0') as total_agr_stj,
            sum(ifnull( a2.t_aju_agr ,'0')) as  t_aju_agr,
            sum(ifnull( a2.t_pyn_agr ,'0')) as  t_pyn_agr,
            ifnull( a3.n_in ,'0') as n_in,
            ifnull( a4.n_out ,'0') as n_out,
            ((ifnull( a1.total_agr ,'0') + ifnull( a3.n_in ,'0')) - (sum(ifnull( a2.t_pyn_agr ,'0')) + ifnull( a4.n_out ,'0'))) AS sisa_anggaran,
            a7.agr as t_act_agr,
            (select sum(fnl_agr) from tbl_actbud where kode_uraian = a1.kode_uraian and st_kabag != 'Ditolak' group by kode_uraian) as s_act_agr,
            (select sum(pra_pyn) from t_j_b_act where kd_act = a7.kd_act group by kd_act) as s_tjb_act_agr
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

    public function get_act_dokumen_pendukung(int $kd_act){
        $query = "select * from tbl_upload_act where kd_act = ?";
        $sql = $this->db->query($query, [$kd_act]);
        return $sql->result();
    }

    public function get_data_chat_actbud(int $id){
        $query = sprintf("SELECT a.id_chat,a.nik,a.pesan,a.datetime_chat,b.nama_lengkap sender,a.attachment,a.attachment_size FROM tbl_chat a 
        INNER JOIN tbl_karyawan b ON a.nik = b.nik WHERE a.kd_act = '%s'", $id);
        $result = $this->db->query($query)->result();
        return $result;
    }

    public function get_tjb_act(int $kd_act){
        $query = "select * from t_j_b_act where kd_act = ?";
        $sql = $this->db->query($query, [$kd_act]);
        return $sql->result();
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
    
    public function get_laporan_pencairan($where = null){
        $this->db->select("
            a.*,
            b.nama_lengkap
        ");
        $this->db->from('tbl_actbud as a');
        $this->db->join('tbl_karyawan as b', 'b.nik = a.pic', 'LEFT');
        if($where != null){
            $this->db->where($where);
        }
        $this->db->where('a.status_act', 'send');
        $this->db->order_by('a.kd_act', 'DESC');
        return $this->db->get()->result_array();
    }

    public function get_data_actbud_where_pic($nik = "", $jenis = "", $where = null){
        // $query = "SELECT a.kd_act, a.kode_uraian, a.kode_pencairan, a.jns_aju_agr, a.kode_unit, a.pic, a.no_borang, 
        // a.tgl_m, a.tgl_s, a.nama_kegiatan, a.kpi, IF(a.periode = 'ganjil', 'Ganjil', 'Genap') AS periode,
        // a.tahun, a.agr, a.fnl_agr, a.deskrip_keg, a.pelaksana, IFNULL(a7.status_act, 'belum dikirim') AS status_act,
        // a.status_penyesuaian, b.nama_lengkap AS nama_pelaksana, a.sign, a.st_kabag, a.c_kabag, a.stamp_kabag, 
        // a.st_fhb, a.c_fhb, a.stamp_fhb, a.st_ftd, a.c_ftd, a.stamp_ftd, a.st_hrd, a.c_hrd, a.stamp_hrd, a.st_umum, a.c_umum,
        // a.stamp_umum, a.st_ict, a.c_ict, a.stamp_ict, a.st_bkal, a.c_bkal, a.stamp_bkal, a.st_p2m, a.c_p2m, a.stamp_p2m,
        // a.st_keu, a.c_keu, a.stamp_keu, a.st_dekan, a.c_dekan, a.stamp_dekan, a.st_warek_1, a.c_warek_1, a.stamp_warek_1,
        // a.st_warek_2, a.c_warek2, a.stamp_warek2, a.st_rek, a.c_rek, a.stamp_rek, a.st_pres, a.c_pres, a.stamp_pres
        // FROM tbl_actbud AS a JOIN tbl_karyawan AS b 
        // ON a.pelaksana = b.nik WHERE";
        $this->datatables->select("
            a.*, b.nama_lengkap AS nama_pelaksana
        ");
        $this->datatables->from('tbl_actbud AS a');
        $this->datatables->join('tbl_karyawan AS b', 'a.pelaksana = b.nik');        
        $this->datatables->where('a.pic', $nik);
        $this->datatables->where('a.jns_aju_agr', $jenis);
        if ($where != null) {
            $this->datatables->where($where);
        }                        
                
        $this->datatables->get_num_rows();
        return $this->datatables->generate();
    }
}
?>