<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Approval_model extends CI_Model {    

    function __construct(){
        parent::__construct();
    }

    public function get_rkat_approval_warek1($year){
        $query = $this->db->query("
                                    SELECT 
                                        *,
                                        (SELECT nama_lengkap FROM tbl_karyawan WHERE nik=tbl_actbud.pic) as pic,
                                        (SELECT nama_lengkap FROM tbl_karyawan WHERE nik=tbl_actbud.pelaksana) as pelaksana
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
}
?>