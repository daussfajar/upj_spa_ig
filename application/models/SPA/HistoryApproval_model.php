<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HistoryApproval_model extends CI_Model {    

    function __construct(){
        parent::__construct();
    }

    public function get_rkat_history_approval_kepala_unit($year, $kode_unit){
        $query = $this->db->query("SELECT
            tbl_actbud.*,
            (SELECT nama_lengkap FROM tbl_karyawan WHERE nik=tbl_actbud.pic) as nama_pic,
            (SELECT nama_lengkap FROM tbl_karyawan WHERE nik=tbl_actbud.pelaksana) as nama_pelaksana
        FROM
            tbl_actbud
            JOIN tbl_uraian ON tbl_actbud.kode_uraian = tbl_uraian.kode_uraian
            JOIN tbl_rkat_master ON tbl_uraian.kode_rkat_master = tbl_rkat_master.kode_rkat_master 
        WHERE
            tbl_actbud.kode_unit = ? 
            AND tbl_actbud.tahun = ?
            AND tbl_rkat_master.na = 'N' 
            AND tbl_actbud.status_act = 'send' AND (tbl_actbud.st_kabag IS NOT NULL AND tbl_actbud.st_kabag != '')
        ORDER BY
            tbl_actbud.kd_act DESC", [$kode_unit, $year]);
        return $query->result_array();
    }

    public function get_rkat_history_approval_umum($year){
        $query = $this->db->query("SELECT
            tbl_actbud.*,
            (SELECT nama_lengkap FROM tbl_karyawan WHERE nik=tbl_actbud.pic) as nama_pic,
            (SELECT nama_lengkap FROM tbl_karyawan WHERE nik=tbl_actbud.pelaksana) as nama_pelaksana
        FROM
            tbl_actbud
            JOIN tbl_uraian ON tbl_actbud.kode_uraian = tbl_uraian.kode_uraian
            JOIN tbl_rkat_master ON tbl_uraian.kode_rkat_master = tbl_rkat_master.kode_rkat_master 
        WHERE
            tbl_rkat_master.na = 'N' 
            AND tbl_actbud.tahun = ?
            AND tbl_actbud.st_kabag ='Disetujui'
            AND tbl_actbud.status_act = 'send' AND (tbl_actbud.st_umum IS NOT NULL AND tbl_actbud.st_umum != '')
        ORDER BY
            tbl_actbud.kd_act DESC", [$year]);
        return $query->result_array();
    }

    public function get_rkat_history_approval_hrd($year){
        $query = $this->db->query("SELECT
            tbl_actbud.*,
            (SELECT nama_lengkap FROM tbl_karyawan WHERE nik=tbl_actbud.pic) as nama_pic,
            (SELECT nama_lengkap FROM tbl_karyawan WHERE nik=tbl_actbud.pelaksana) as nama_pelaksana
        FROM
            tbl_actbud
            JOIN tbl_uraian ON tbl_actbud.kode_uraian = tbl_uraian.kode_uraian
            JOIN tbl_rkat_master ON tbl_uraian.kode_rkat_master = tbl_rkat_master.kode_rkat_master 
        WHERE
            tbl_rkat_master.na = 'N' 
            AND tbl_actbud.tahun = ?
            AND tbl_actbud.st_kabag ='Disetujui'
            AND tbl_actbud.status_act = 'send' AND (tbl_actbud.st_hrd IS NOT NULL AND tbl_actbud.st_hrd != '')
        ORDER BY
            tbl_actbud.kd_act DESC", [$year]);
        return $query->result_array();
    }

    public function get_rkat_history_approval_ict($year){
        $query = $this->db->query("SELECT
            tbl_actbud.*,
            (SELECT nama_lengkap FROM tbl_karyawan WHERE nik=tbl_actbud.pic) as nama_pic,
            (SELECT nama_lengkap FROM tbl_karyawan WHERE nik=tbl_actbud.pelaksana) as nama_pelaksana
        FROM
            tbl_actbud
            JOIN tbl_uraian ON tbl_actbud.kode_uraian = tbl_uraian.kode_uraian
            JOIN tbl_rkat_master ON tbl_uraian.kode_rkat_master = tbl_rkat_master.kode_rkat_master 
        WHERE
            tbl_rkat_master.na = 'N' 
            AND tbl_actbud.tahun = ?
            AND tbl_actbud.st_kabag ='Disetujui'
            AND tbl_actbud.status_act = 'send' AND (tbl_actbud.st_ict IS NOT NULL AND tbl_actbud.st_ict != '')
        ORDER BY
            tbl_actbud.kd_act DESC", [$year]);
        return $query->result_array();
    }

    public function get_rkat_history_approval_bkal($year){
        $query = $this->db->query("SELECT
            tbl_actbud.*,
            (SELECT nama_lengkap FROM tbl_karyawan WHERE nik=tbl_actbud.pic) as nama_pic,
            (SELECT nama_lengkap FROM tbl_karyawan WHERE nik=tbl_actbud.pelaksana) as nama_pelaksana
        FROM
            tbl_actbud
            JOIN tbl_uraian ON tbl_actbud.kode_uraian = tbl_uraian.kode_uraian
            JOIN tbl_rkat_master ON tbl_uraian.kode_rkat_master = tbl_rkat_master.kode_rkat_master 
        WHERE
            tbl_rkat_master.na = 'N' 
            AND tbl_actbud.tahun = ?
            AND tbl_actbud.st_kabag ='Disetujui'
            AND tbl_actbud.status_act = 'send' AND (tbl_actbud.st_bkal IS NOT NULL AND tbl_actbud.st_bkal != '')
        ORDER BY
            tbl_actbud.kd_act DESC", [$year]);
        return $query->result_array();
    }

    public function get_rkat_history_approval_p2m($year){
        $query = $this->db->query("SELECT
            tbl_actbud.*,
            (SELECT nama_lengkap FROM tbl_karyawan WHERE nik=tbl_actbud.pic) as nama_pic,
            (SELECT nama_lengkap FROM tbl_karyawan WHERE nik=tbl_actbud.pelaksana) as nama_pelaksana
        FROM
            tbl_actbud
            JOIN tbl_uraian ON tbl_actbud.kode_uraian = tbl_uraian.kode_uraian
            JOIN tbl_rkat_master ON tbl_uraian.kode_rkat_master = tbl_rkat_master.kode_rkat_master 
        WHERE
            tbl_rkat_master.na = 'N' 
            AND tbl_actbud.tahun = ?
            AND tbl_actbud.st_kabag ='Disetujui'
            AND tbl_actbud.status_act = 'send' AND (tbl_actbud.st_p2m IS NOT NULL AND tbl_actbud.st_p2m != '')
        ORDER BY
            tbl_actbud.kd_act DESC", [$year]);
        return $query->result_array();
    }

    public function get_rkat_history_approval_keuangan($year){
        $query = $this->db->query("SELECT
            tbl_actbud.*,
            (SELECT nama_lengkap FROM tbl_karyawan WHERE nik=tbl_actbud.pic) as nama_pic,
            (SELECT nama_lengkap FROM tbl_karyawan WHERE nik=tbl_actbud.pelaksana) as nama_pelaksana
        FROM
            tbl_actbud
            JOIN tbl_uraian ON tbl_actbud.kode_uraian = tbl_uraian.kode_uraian
            JOIN tbl_rkat_master ON tbl_uraian.kode_rkat_master = tbl_rkat_master.kode_rkat_master 
        WHERE
            tbl_rkat_master.na = 'N'
            AND tbl_actbud.tahun = ?
            AND tbl_actbud.st_kabag ='Disetujui'
            AND tbl_actbud.status_act = 'send' AND (tbl_actbud.st_keu IS NOT NULL AND tbl_actbud.st_keu != '')
        ORDER BY
            tbl_actbud.kd_act DESC", [$year]);
        return $query->result_array();
    }

    public function get_rkat_history_approval_dekan_ftd($year){
        $query = $this->db->query("SELECT
            tbl_actbud.*,
            (SELECT nama_lengkap FROM tbl_karyawan WHERE nik=tbl_actbud.pic) as nama_pic,
            (SELECT nama_lengkap FROM tbl_karyawan WHERE nik=tbl_actbud.pelaksana) as nama_pelaksana
        FROM
            tbl_actbud
            JOIN tbl_uraian ON tbl_actbud.kode_uraian = tbl_uraian.kode_uraian
            JOIN tbl_rkat_master ON tbl_uraian.kode_rkat_master = tbl_rkat_master.kode_rkat_master 
        WHERE
            tbl_rkat_master.na = 'N' 
            AND (kode_unit = 105 or kode_unit = 106 or kode_unit = 107 or kode_unit = 108 or kode_unit = 109 or kode_unit = 110 or kode_unit = 018)
            AND tbl_actbud.tahun = ?
            AND tbl_actbud.st_kabag ='Disetujui'
            AND tbl_actbud.status_act = 'send' AND (tbl_actbud.st_ftd IS NOT NULL AND tbl_actbud.st_ftd != '')
        ORDER BY
            tbl_actbud.kd_act DESC", [$year]);
        return $query->result_array();
    }

    public function get_rkat_history_approval_dekan_fhb($year){
        $query = $this->db->query("SELECT
            tbl_actbud.*,
            (SELECT nama_lengkap FROM tbl_karyawan WHERE nik=tbl_actbud.pic) as nama_pic,
            (SELECT nama_lengkap FROM tbl_karyawan WHERE nik=tbl_actbud.pelaksana) as nama_pelaksana
        FROM
            tbl_actbud
            JOIN tbl_uraian ON tbl_actbud.kode_uraian = tbl_uraian.kode_uraian
            JOIN tbl_rkat_master ON tbl_uraian.kode_rkat_master = tbl_rkat_master.kode_rkat_master 
        WHERE
            tbl_rkat_master.na = 'N' 
            AND (kode_unit = 101 or kode_unit = 102 or kode_unit = 103 or kode_unit = 104 or kode_unit = 019 or kode_unit = 112 or kode_unit = 017)
            AND tbl_actbud.tahun = ?
            AND tbl_actbud.st_kabag ='Disetujui'
            AND tbl_actbud.status_act = 'send' AND (tbl_actbud.st_fhb IS NOT NULL AND tbl_actbud.st_fhb != '')
        ORDER BY
            tbl_actbud.kd_act DESC", [$year]);
        return $query->result_array();
    }

    public function get_rkat_history_approval_warek2($year){
        $query = $this->db->query("SELECT
            tbl_actbud.*,
            (SELECT nama_lengkap FROM tbl_karyawan WHERE nik=tbl_actbud.pic) as nama_pic,
            (SELECT nama_lengkap FROM tbl_karyawan WHERE nik=tbl_actbud.pelaksana) as nama_pelaksana
        FROM
            tbl_actbud
            JOIN tbl_uraian ON tbl_actbud.kode_uraian = tbl_uraian.kode_uraian
            JOIN tbl_rkat_master ON tbl_uraian.kode_rkat_master = tbl_rkat_master.kode_rkat_master 
        WHERE
            tbl_rkat_master.na = 'N'
            AND tbl_actbud.tahun = ?
            AND (tbl_actbud.st_warek_2 IS NOT NULL AND tbl_actbud.st_warek_2 != '')
        ORDER BY
            tbl_actbud.kd_act DESC", [$year]);
        return $query->result_array();
    }

    public function get_rkat_history_approval_warek1($year){
        $query = $this->db->query("SELECT
            tbl_actbud.*,
            (SELECT nama_lengkap FROM tbl_karyawan WHERE nik=tbl_actbud.pic) as nama_pic,
            (SELECT nama_lengkap FROM tbl_karyawan WHERE nik=tbl_actbud.pelaksana) as nama_pelaksana
        FROM
            tbl_actbud
            JOIN tbl_uraian ON tbl_actbud.kode_uraian = tbl_uraian.kode_uraian
            JOIN tbl_rkat_master ON tbl_uraian.kode_rkat_master = tbl_rkat_master.kode_rkat_master 
        WHERE
            tbl_rkat_master.na = 'N'
            AND tbl_actbud.tahun = ?
            AND (tbl_actbud.st_warek_1 IS NOT NULL AND tbl_actbud.st_warek_1 != '')
        ORDER BY
            tbl_actbud.kd_act DESC", [$year]);
        return $query->result_array();
    }

    public function get_rkat_history_approval_rektor($year){
        $query = $this->db->query("SELECT
            tbl_actbud.*,
            (SELECT nama_lengkap FROM tbl_karyawan WHERE nik=tbl_actbud.pic) as nama_pic,
            (SELECT nama_lengkap FROM tbl_karyawan WHERE nik=tbl_actbud.pelaksana) as nama_pelaksana
        FROM
            tbl_actbud
            JOIN tbl_uraian ON tbl_actbud.kode_uraian = tbl_uraian.kode_uraian
            JOIN tbl_rkat_master ON tbl_uraian.kode_rkat_master = tbl_rkat_master.kode_rkat_master 
        WHERE
            tbl_rkat_master.na = 'N'
            AND tbl_actbud.tahun = ?
            AND (tbl_actbud.st_rek IS NOT NULL AND tbl_actbud.st_rek != '')
        ORDER BY
            tbl_actbud.kd_act DESC", [$year]);
        return $query->result_array();
    }

    public function get_rkat_history_approval_presiden($year){
        $query = $this->db->query("SELECT
            tbl_actbud.*,
            (SELECT nama_lengkap FROM tbl_karyawan WHERE nik=tbl_actbud.pic) as nama_pic,
            (SELECT nama_lengkap FROM tbl_karyawan WHERE nik=tbl_actbud.pelaksana) as nama_pelaksana
        FROM
            tbl_actbud
            JOIN tbl_uraian ON tbl_actbud.kode_uraian = tbl_uraian.kode_uraian
            JOIN tbl_rkat_master ON tbl_uraian.kode_rkat_master = tbl_rkat_master.kode_rkat_master 
        WHERE
            tbl_rkat_master.na = 'N'
            AND tbl_actbud.tahun = ?
            AND (tbl_actbud.st_pres IS NOT NULL AND tbl_actbud.st_pres != '')
        ORDER BY
            tbl_actbud.kd_act DESC", [$year]);
        return $query->result_array();
    }

    public function get_actbud($where = null){
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
}
?>