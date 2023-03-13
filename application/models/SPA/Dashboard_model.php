<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model {

    function __construct(){
        parent::__construct();
        $this->load->model('Global_model');
    }

    public function get_total_actbud($nik, $year){
        $query = $this->db->query("
                    SELECT
                        (COUNT(CASE WHEN jns_aju_agr = 'actbud' THEN 1 ELSE NULL END)) as jumlah_actbud,
                        (COUNT(CASE WHEN jns_aju_agr = 'petty cash' THEN 1 ELSE NULL END)) as jumlah_petty_cash
                    FROM 
                        tbl_actbud 
                    WHERE 
                        pic = ?
                        AND tahun = ?
                        AND status_act ='send'
                        AND (
                                st_kabag NOT LIKE 'Disetujui'
                                AND st_kabag NOT LIKE 'Ditolak'
                            )
                ", array($nik, $year));
        return $query->row_array();
    }

    public function get_total_actbud_ditolak($nik, $year){
        $query = $this->db->query("
        SELECT 
            (COUNT(CASE WHEN jns_aju_agr = 'actbud' THEN 1 ELSE NULL END)) as jumlah_actbud,
            (COUNT(CASE WHEN jns_aju_agr = 'petty cash' THEN 1 ELSE NULL END)) as jumlah_petty_cash
        FROM 
            tbl_actbud 
        WHERE 
            pic = ?
            AND tahun = ?
            AND status_act ='send'
            AND (
                    st_kabag like 'Ditolak' 
                    OR st_hrd like 'Ditolak HRD' 
                    OR st_umum like 'Ditolak GA' 
                    OR st_hrd like 'Ditolak HRD'
                    OR st_ict like 'Ditolak ICT' 
                    OR st_bkal like 'Ditolak BKAL' 
                    OR st_p2m like 'Ditolak P2M' 
                    OR st_keu like 'Ditolak' 
                    OR st_warek_1 like 'Ditolak Warek 1' 
                    OR st_warek_2 like 'Ditolak Warek 2' 
                    OR st_rek like 'Ditolak' 
                    OR st_pres like 'Ditolak'
                )
                ", array($nik, $year));
        return $query->row_array();
    }
    
    public function get_total_approval_kabag($kode_unit, $year){
        $query = $this->db->query("
                    SELECT
                        count(kd_act) AS jumlah
                    FROM 
                        tbl_actbud 
                    WHERE 
                        kode_unit = ?
                        AND tahun = ?
                        AND status_act ='send'
                        AND (
                                st_kabag NOT LIKE 'Disetujui'
                                AND st_kabag NOT LIKE 'Ditolak'
                            )
                ", array($kode_unit, $year));
        return $query->row_array();
    }
    
    public function get_total_approval_fhb($year){
        $query = $this->db->query("
                    SELECT
                        count( kd_act ) AS jumlah 
                    FROM
                        tbl_actbud 
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
                        AND (st_kabag = '' || st_kabag IS NULL)
                        AND (st_fhb = '' || st_fhb IS NULL)
                        AND (st_keu = '' || st_keu IS NULL)
                        AND tahun = ?
                ", array($year));
        return $query->row_array();
    }

    public function get_total_approval_ftd($year){
        $query = $this->db->query("
                    SELECT
                        count( kd_act ) AS jumlah 
                    FROM
                        tbl_actbud 
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
                        AND (st_kabag = '' || st_kabag IS NULL)
                        AND (st_ftd = '' || st_ftd IS NULL)
                        AND (st_keu = '' || st_keu IS NULL)
                        AND tahun = ?
                ", array($year));
        return $query->row_array();
    }

    public function get_total_approval_warek2($year){
        $query = $this->db->query("
                    SELECT 
                        count(kd_act) AS jumlah 
                    FROM 
                        tbl_actbud 
                    WHERE 
                        tahun = ?
                        AND
                        (
                            (  
                                st_keu ='Disetujui' 
                                AND jns_aju_agr = 'actbud'
                                AND (
                                    (st_warek_2 NOT LIKE 'Disetujui Warek 2') 
                                    AND (st_warek_2 NOT LIKE 'Ditolak Warek 2')
                                )
                            ) 
                            OR (
                                kd_act >= 2510 
                                AND st_keu ='Disetujui' 
                                AND jns_aju_agr = 'petty cash'
                                AND fnl_agr > 500000		
                                AND (
                                    kode_unit = '003' 
                                    OR kode_unit ='005' 
                                    OR kode_unit ='006'
                                ) 
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
                        )
                ", array($year));
        return $query->row_array();
    }

    public function get_total_approval_warek1($year){
        $query = $this->db->query("
                    SELECT 
                        count(kd_act) AS jumlah 
                    FROM 
                        tbl_actbud 
                    WHERE 
                        tahun = ?
                        AND
                        (
                            (  
                                st_keu ='Disetujui' 
                                AND jns_aju_agr = 'actbud'
                                AND (
                                    (st_warek_1 NOT LIKE 'Disetujui Warek 1') 
                                    AND (st_warek_1 NOT LIKE 'Ditolak Warek 1')
                                )
                            ) 
                            OR (
                                kd_act >= 2510 
                                AND st_keu ='Disetujui' 
                                AND jns_aju_agr = 'petty cash'
                                AND fnl_agr > 500000		
                                AND (
                                    kode_unit = '003' 
                                    OR kode_unit ='005' 
                                    OR kode_unit ='006'
                                ) 
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
                        )
                ", array($year));
        return $query->row_array();
    }

    public function get_total_approval_rektor($year){
        $query = $this->db->query("
                    SELECT 
                        count(kd_act) AS jumlah 
                    FROM 
                        tbl_actbud 
                    WHERE 
                        tahun = ?
                        AND
                        (
                            (  
                                jns_aju_agr = 'actbud'
                                AND st_warek_1 ='Disetujui Warek 1'
                                AND st_warek_2 ='Disetujui Warek 2' 
                                AND ((st_rek NOT LIKE 'Disetujui') AND (st_rek NOT LIKE 'Ditolak')) 
                            ) 
                            OR (
                                kd_act >= 2510 
                                AND st_keu ='Disetujui' 
                                AND jns_aju_agr = 'petty cash'
                                AND fnl_agr > 500000		
                                AND (
                                    kode_unit = '003' 
                                    OR kode_unit ='005' 
                                    OR kode_unit ='006'
                                ) 
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
                        )
                ", array($year));
        return $query->row_array();
    }

    public function get_total_approval_presiden($year){
        $query = $this->db->query("
                    SELECT 
                        count(kd_act) AS jumlah 
                    FROM 
                        tbl_actbud 
                    WHERE 
                        tahun = ?
                        AND
                        (
                            (  
                                fnl_agr >= 10000000 
                                AND st_rek ='Disetujui'
                                AND (
                                    (st_pres NOT LIKE 'Disetujui') 
                                    AND (st_pres NOT LIKE 'Ditolak')
                                )
                            ) 
                            OR (
                                kd_act >= 2510 
                                AND st_keu ='Disetujui' 
                                AND jns_aju_agr = 'petty cash'
                                AND fnl_agr > 500000		
                                AND (
                                    kode_unit = '003' 
                                    OR kode_unit ='005' 
                                    OR kode_unit ='006'
                                ) 
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
                        )
                ", array($year));
        return $query->row_array();
    }
}
?>