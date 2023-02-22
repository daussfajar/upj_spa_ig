<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PengalihanAnggaran_model extends CI_Model {    

    public function get_all_pengalihan(){
        $nik = decrypt($_SESSION['user_sessions']['nik']);
        $table = "ig_tbl_pengalihan AS a JOIN tbl_karyawan AS b ON a.pic = b.nik";
        $field = "a.id,a.pic,b.nama_lengkap AS nama_pengaju, a.kode_uraian,
        a.kode_uraian_out,a.kode_pencairan,
        a.kode_pencairan_out,a.pic,a.nominal,a.file_pendukung,
        a.keterangan,a.disetujui, a.periode, a.periode_out";
        $where = "a.status = 'Aktif'";
        $path_uri = '/' . APP_FOLDER . '/app/sim-ig/pengalihan-anggaran';
        $data = $this->Global_model->get_data_with_pagination(
            $field,
            $table,
            $where,
            $path_uri,
            4,
            5,
            4
        );
        return $data;
    }
}