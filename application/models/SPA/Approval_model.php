<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Approval_model extends CI_Model {    

    function __construct(){
        parent::__construct();
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