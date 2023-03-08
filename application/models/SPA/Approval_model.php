<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Approval_model extends CI_Model {    

    function __construct(){
        parent::__construct();
    }

    public function get_rkat_approval_kepala_unit($year, $kode_unit){
        $query = $this->db->query("SELECT
            tbl_actbud.*,
            c.nama_lengkap AS nama_pic,
            d.nama_lengkap AS nama_pelaksana 
        FROM
            tbl_actbud
            JOIN tbl_uraian ON tbl_actbud.kode_uraian = tbl_uraian.kode_uraian
            JOIN tbl_rkat_master ON tbl_uraian.kode_rkat_master = tbl_rkat_master.kode_rkat_master 
            JOIN tbl_karyawan AS c ON tbl_actbud.pic = c.nik
            JOIN tbl_karyawan AS d ON tbl_actbud.pelaksana = d.nik
        WHERE
            tbl_actbud.kode_unit = ? 
            AND tbl_rkat_master.na = 'N' 
            AND tbl_actbud.tahun = ?
            AND ((
                    (tbl_actbud.status_act = 'send' OR tbl_actbud.status_act = 'waiting_for_approval')
                    AND tbl_actbud.st_kabag NOT LIKE 'Disetujui' 
                    ) 
            AND ( tbl_actbud.st_kabag NOT LIKE 'Ditolak' )) 
        ORDER BY
            tbl_actbud.kd_act DESC", [$kode_unit, $year]);
        return $query->result_array();
    }

    public function get_actbud_approval_keuangan($year){
        $query = $this->db->query("
                                    SELECT 
                                        *,
                                        (SELECT nama_lengkap FROM tbl_karyawan WHERE nik=tbl_actbud.pic) as nama_pic,
                                        (SELECT nama_lengkap FROM tbl_karyawan WHERE nik=tbl_actbud.pelaksana) as nama_pelaksana
                                    FROM tbl_actbud
                                    WHERE
                                        st_kabag ='Disetujui' 
                                        AND (st_hrd = 'Disetujui HRD' OR st_umum = 'Disetujui GA' OR st_ict = 'Disetujui ICT' OR st_bkal = 'Disetujui BKAL'OR st_p2m = 'Disetujui P2M') 
                                        AND ((st_keu NOT LIKE 'Disetujui') AND (st_keu NOT LIKE 'Ditolak'))
                                        OR 
                                        (
                                            sign ='' 
                                            AND st_kabag='Disetujui'
                                            AND (kode_unit = 001 or kode_unit = 002 or kode_unit = 003 or kode_unit = 004 or kode_unit = 005
                                                or kode_unit = 006 or kode_unit = 007 or kode_unit = 008 or kode_unit = 009 or kode_unit = 010
                                                or kode_unit = 011 or kode_unit = 012 or kode_unit = 013 or kode_unit = 014 or kode_unit = 015
                                                or kode_unit = 016 or kode_unit = 017 or kode_unit = 018 or kode_unit = 020 or kode_unit = 021 or kode_unit = 022 or kode_unit = 023)
                                            AND ((st_keu NOT LIKE 'Disetujui') AND (st_keu NOT LIKE 'Ditolak'))
                                        )
                                        OR 
                                        (
                                            sign ='' 
                                            AND st_kabag ='Disetujui' 
                                            AND (kode_unit = 101 or kode_unit = 102 or kode_unit = 103 or kode_unit = 104 or kode_unit = 105 or 
                                                kode_unit = 106 or kode_unit = 107 or kode_unit = 108 or kode_unit = 109 or kode_unit = 110  or kode_unit = 019 or kode_unit = 112) 
                                            AND (st_ftd='Disetujui FTD' OR st_fhb='Disetujui FHB')
                                            AND ((st_keu NOT LIKE 'Disetujui') AND (st_keu NOT LIKE 'Ditolak'))
                                        )
                                        AND tahun = ?
                                    ORDER BY kd_act desc
                            ", array($year));
        return $query->result_array();
    }

    public function get_actbud_approval_dekan_ftd($year){
        $query = $this->db->query("
                                    SELECT 
                                        *,
                                        (SELECT nama_lengkap FROM tbl_karyawan WHERE nik=tbl_actbud.pic) as nama_pic,
                                        (SELECT nama_lengkap FROM tbl_karyawan WHERE nik=tbl_actbud.pelaksana) as nama_pelaksana
                                    FROM tbl_actbud
                                    WHERE
                                        (kode_unit = 105 or kode_unit = 106 or kode_unit = 107 or kode_unit = 108 or kode_unit = 109 or kode_unit = 110 or kode_unit = 018 or kode_unit = 020)
                                        AND st_kabag ='Disetujui' 
                                        AND ((st_ftd NOT LIKE 'Disetujui ftd') AND (st_ftd NOT LIKE 'Ditolak ftd'))
                                        AND st_keu = ''
                                        AND tahun = ?
                                    ORDER BY kd_act desc
                            ", array($year));
        return $query->result_array();
    }

    public function get_actbud_approval_dekan_fhb($year){
        $query = $this->db->query("
                                    SELECT 
                                        *,
                                        (SELECT nama_lengkap FROM tbl_karyawan WHERE nik=tbl_actbud.pic) as nama_pic,
                                        (SELECT nama_lengkap FROM tbl_karyawan WHERE nik=tbl_actbud.pelaksana) as nama_pelaksana
                                    FROM tbl_actbud
                                    WHERE
                                        (
                                            kode_unit = 101 
                                            OR kode_unit = 102 
                                            OR kode_unit = 103 
                                            OR kode_unit = 104 
                                            OR kode_unit = 019 
                                            OR kode_unit = 112 
                                            OR kode_unit = 017
                                        )
                                        AND st_kabag ='Disetujui' 
                                        AND ((st_fhb NOT LIKE 'Disetujui fhb') AND (st_fhb NOT LIKE 'Ditolak fhb'))
                                        AND st_keu = ''
                                        AND tahun = ?
                                    ORDER BY kd_act desc
                            ", array($year));
        return $query->result_array();
    }

    public function get_actbud_approval_dekan($year){
        $query = $this->db->query("
                                    SELECT 
                                        *,
                                        (SELECT nama_lengkap FROM tbl_karyawan WHERE nik=tbl_actbud.pic) as nama_pic,
                                        (SELECT nama_lengkap FROM tbl_karyawan WHERE nik=tbl_actbud.pelaksana) as nama_pelaksana
                                    FROM tbl_actbud
                                    WHERE
                                        (
                                            kode_unit = 101 
                                            OR kode_unit = 102 
                                            OR kode_unit = 103 
                                            OR kode_unit = 104 
                                            OR kode_unit = 019 
                                            OR kode_unit = 112 
                                            OR kode_unit = 017
                                            OR kode_unit = 101 
                                            OR kode_unit = 102 
                                            OR kode_unit = 103 
                                            OR kode_unit = 104 
                                            OR kode_unit = 019 
                                            OR kode_unit = 112 
                                            OR kode_unit = 017
                                        )
                                        AND st_kabag ='Disetujui' 
                                        AND ((st_ftd NOT LIKE 'Disetujui ftd') AND (st_ftd NOT LIKE 'Ditolak ftd'))
                                        AND ((st_fhb NOT LIKE 'Disetujui fhb') AND (st_fhb NOT LIKE 'Ditolak fhb'))
                                        AND st_keu = ''
                                        AND tahun = ?
                                    ORDER BY kd_act desc
                            ", array($year));
        return $query->result_array();
    }

    public function get_actbud_approval_warek1($year){
        $query = $this->db->query("
                                    SELECT 
                                        *,
                                        (SELECT nama_lengkap FROM tbl_karyawan WHERE nik=tbl_actbud.pic) as nama_pic,
                                        (SELECT nama_lengkap FROM tbl_karyawan WHERE nik=tbl_actbud.pelaksana) as nama_pelaksana
                                    FROM tbl_actbud
                                    WHERE
                                        tahun = ? AND 
                                        (
                                            (
                                                st_keu ='Disetujui' AND jns_aju_agr = 'actbud' AND 
                                                (
                                                    (st_warek_1 NOT LIKE 'Disetujui Warek 1') AND 
                                                    (st_warek_1 NOT LIKE 'Ditolak Warek 1')
                                                )
                                            ) OR
                                            (
                                                kd_act >= 2510 AND 
                                                fnl_agr > 500000 AND 
                                                st_keu ='Disetujui' AND 
                                                jns_aju_agr = 'petty cash' AND 
                                                (kode_unit = '003' OR kode_unit ='005' OR kode_unit ='006') AND 
                                                (
                                                    (st_warek_1 NOT LIKE 'Disetujui Warek 1') AND 
                                                    (st_warek_1 NOT LIKE 'Ditolak Warek 1') AND 
                                                    (st_warek_2 NOT LIKE 'Disetujui Warek 2') AND 
                                                    (st_warek_2 NOT LIKE 'Ditolak Warek 2') AND 
                                                    (st_rek NOT LIKE 'Disetujui') AND 
                                                    (st_rek NOT LIKE 'Ditolak') AND 
                                                    (st_pres NOT LIKE 'Disetujui') AND 
                                                    (st_pres NOT LIKE 'Ditolak')
                                                ) 
                                            )
                                        )
                                    ORDER BY kd_act desc
                            ", array($year));
        return $query->result_array();
    }

    public function get_actbud_approval_warek2($year){
        $query = $this->db->query("
                                    SELECT 
                                        *,
                                        (SELECT nama_lengkap FROM tbl_karyawan WHERE nik=tbl_actbud.pic) as nama_pic,
                                        (SELECT nama_lengkap FROM tbl_karyawan WHERE nik=tbl_actbud.pelaksana) as nama_pelaksana
                                    FROM tbl_actbud
                                    WHERE
                                        tahun = ? AND 
                                        (
                                            (
                                                st_keu ='Disetujui' AND jns_aju_agr = 'actbud' AND 
                                                (
                                                    (st_warek_2 NOT LIKE 'Disetujui Warek 2') AND 
                                                    (st_warek_2 NOT LIKE 'Ditolak Warek 2')
                                                )
                                            ) OR
                                            (
                                                kd_act >= 2510 AND 
                                                fnl_agr > 500000 AND 
                                                st_keu ='Disetujui' AND 
                                                jns_aju_agr = 'petty cash' AND 
                                                (kode_unit = '003' OR kode_unit ='005' OR kode_unit ='006') AND 
                                                (
                                                    (st_warek_1 NOT LIKE 'Disetujui Warek 1') AND 
                                                    (st_warek_1 NOT LIKE 'Ditolak Warek 1') AND 
                                                    (st_warek_2 NOT LIKE 'Disetujui Warek 2') AND 
                                                    (st_warek_2 NOT LIKE 'Ditolak Warek 2') AND 
                                                    (st_rek NOT LIKE 'Disetujui') AND 
                                                    (st_rek NOT LIKE 'Ditolak') AND 
                                                    (st_pres NOT LIKE 'Disetujui') AND 
                                                    (st_pres NOT LIKE 'Ditolak')
                                                ) 
                                            )
                                        )
                                    ORDER BY kd_act desc
                            ", array($year));
        return $query->result_array();
    }

    public function get_actbud_approval_rektor($year){
        $query = $this->db->query("
                                    SELECT 
                                        *,
                                        (SELECT nama_lengkap FROM tbl_karyawan WHERE nik=tbl_actbud.pic) as nama_pic,
                                        (SELECT nama_lengkap FROM tbl_karyawan WHERE nik=tbl_actbud.pelaksana) as nama_pelaksana
                                    FROM tbl_actbud
                                    WHERE
                                        tahun = ? AND 
                                        (   st_warek_1 ='Disetujui Warek 1'
                                            AND st_warek_2 ='Disetujui Warek 2' 
                                            AND ((st_rek NOT LIKE 'Disetujui') AND (st_rek NOT LIKE 'Ditolak'))
                                        ) OR 
                                        (
                                            kd_act >= 2510
                                            AND fnl_agr > 500000
                                            AND st_keu ='Disetujui' 
                                            AND jns_aju_agr = 'petty cash' 
                                            AND (kode_unit = '003' OR kode_unit ='005' OR kode_unit ='006') 
                                            AND 
                                            (
                                                (st_warek_1 NOT LIKE 'Disetujui Warek 1') 
                                                AND (st_warek_1 NOT LIKE 'Ditolak Warek 1') 
                                                AND (st_warek_2 NOT LIKE 'Disetujui Warek 2') 
                                                AND (st_warek_2 NOT LIKE 'Ditolak Warek 2') 
                                                AND (st_rek NOT LIKE 'Disetujui') 
                                                AND (st_rek NOT LIKE 'Ditolak') 
                                                AND (st_pres NOT LIKE 'Disetujui') 
                                                AND (st_pres NOT LIKE 'Ditolak')
                                            ) 
                                        )
                                    ORDER BY kd_act desc
                            ", array($year));
        return $query->result_array();
    }

    public function get_actbud_approval_presiden($year){
        $query = $this->db->query("
                                    SELECT 
                                        *,
                                        (SELECT nama_lengkap FROM tbl_karyawan WHERE nik=tbl_actbud.pic) as nama_pic,
                                        (SELECT nama_lengkap FROM tbl_karyawan WHERE nik=tbl_actbud.pelaksana) as nama_pelaksana
                                    FROM tbl_actbud
                                    WHERE
                                        tahun = ? AND 
                                        (   
                                            fnl_agr >= 10000000 
                                            AND st_rek ='Disetujui'
                                            AND ((st_pres NOT LIKE 'Disetujui') AND (st_pres NOT LIKE 'Ditolak'))
                                        ) OR 
                                        ( 
                                            kd_act >= 2510
                                            AND fnl_agr > 500000
                                            AND st_keu ='Disetujui' 
                                            AND jns_aju_agr = 'petty cash' 
                                            AND (kode_unit = '003' OR kode_unit ='005' OR kode_unit ='006') 
                                            AND (
                                                (st_warek_1 NOT LIKE 'Disetujui Warek 1')
                                                AND (st_warek_1 NOT LIKE 'Ditolak Warek 1') 
                                                AND (st_warek_2 NOT LIKE 'Disetujui Warek 2')
                                                AND (st_warek_2 NOT LIKE 'Ditolak Warek 2') 
                                                AND (st_rek NOT LIKE 'Disetujui')
                                                AND (st_rek NOT LIKE 'Ditolak') 
                                                AND (st_pres NOT LIKE 'Disetujui')
                                                AND (st_pres NOT LIKE 'Ditolak')
                                            ) 
                                        )
                                    ORDER BY kd_act desc
                            ", array($year));
        return $query->result_array();
    }

    public function get_rkat_approval_sign($year, $kode_unit){
        $query = $this->db->query("SELECT
                tbl_actbud.*,
                c.nama_lengkap AS nama_pic,
                d.nama_lengkap AS nama_pelaksana  
            FROM
                tbl_actbud
                JOIN tbl_karyawan AS c ON tbl_actbud.pic = c.nik
                JOIN tbl_karyawan AS d ON tbl_actbud.pelaksana = d.nik
            WHERE
                tbl_actbud.tahun = ?
                AND
                (
                    sign = '$kode_unit' 
                    AND st_kabag = 'Disetujui' 
                    AND (
                        tbl_actbud.kode_unit = 001 
                        OR tbl_actbud.kode_unit = 002 
                        OR tbl_actbud.kode_unit = 003 
                        OR tbl_actbud.kode_unit = 004 
                        OR tbl_actbud.kode_unit = 005 
                        OR tbl_actbud.kode_unit = 006 
                        OR tbl_actbud.kode_unit = 007 
                        OR tbl_actbud.kode_unit = 008 
                        OR tbl_actbud.kode_unit = 009 
                        OR tbl_actbud.kode_unit = 010 
                        OR tbl_actbud.kode_unit = 011 
                        OR tbl_actbud.kode_unit = 012 
                        OR tbl_actbud.kode_unit = 013 
                        OR tbl_actbud.kode_unit = 014 
                        OR tbl_actbud.kode_unit = 015 
                        OR tbl_actbud.kode_unit = 016 
                        OR tbl_actbud.kode_unit = 017 
                        OR tbl_actbud.kode_unit = 018 
                        OR tbl_actbud.kode_unit = 020 
                        OR tbl_actbud.kode_unit = 021 
                        OR tbl_actbud.kode_unit = 022 
                        OR tbl_actbud.kode_unit = 023 
                    ) 
                    AND ((
                            st_ict NOT LIKE 'Disetujui ICT' 
                            ) 
                    AND ( st_ict NOT LIKE 'Ditolak ICT' )) 
                ) 
                OR (
                    sign = '$kode_unit' 
                    AND st_kabag = 'Disetujui' 
                    AND (
                        tbl_actbud.kode_unit = 101 
                        OR tbl_actbud.kode_unit = 102 
                        OR tbl_actbud.kode_unit = 103 
                        OR tbl_actbud.kode_unit = 104 
                        OR tbl_actbud.kode_unit = 105 
                        OR tbl_actbud.kode_unit = 106 
                        OR tbl_actbud.kode_unit = 107 
                        OR tbl_actbud.kode_unit = 108 
                        OR tbl_actbud.kode_unit = 109 
                        OR tbl_actbud.kode_unit = 110 
                        OR tbl_actbud.kode_unit = 019 
                        OR tbl_actbud.kode_unit = 112 
                    ) 
                    AND ( st_ftd = 'Disetujui FTD' OR st_fhb = 'Disetujui FHB' ) 
                    AND ((
                            st_ict NOT LIKE 'Disetujui ICT' 
                            ) 
                    AND ( st_ict NOT LIKE 'Ditolak ICT' )) 
                ) 
            ORDER BY
                kd_act DESC", array($year));
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