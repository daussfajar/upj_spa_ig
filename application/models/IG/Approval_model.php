<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Approval_model extends CI_Model {

    private $table = '';

    function __construct(){
		parent::__construct();
	}
    
    public function get_data_approval(String $kode_unit = '', String $where = ''){
        $_SESSION['session_where']['value'] = '';
        $jabatan = $_SESSION['user_sessions']['kode_jabatan'];
        $extend_query = "AND (a.kode_unit = '$kode_unit' OR a.sign = '$kode_unit')";
        // jika unit rektorat atau keuangan maka approval akan terlihat semua dari semua unit
        if($kode_unit == 007 || $kode_unit == 002 || $jabatan == 0){
            $extend_query = '';
        }
        
        if($jabatan == 0){
            $where .= " ORDER BY a.id DESC";
        } else {
            $where .= " ORDER BY a.id DESC";
        }

        if($where != '') {            
            $_SESSION['session_where']['value'] = $_SESSION['session_where']['value'] . " " . $where;
        } else {
            unset($_SESSION['session_where']);
        }

        $this->table = 'ig_tbl_actbud';
        $nik = decrypt($_SESSION['user_sessions']['nik']);
        $data = $this->Global_model->get_data_with_pagination('a.id,a.id_uraian,a.kode_uraian,a.kode_pencairan,a.nama_kegiatan,a.jenis_anggaran,a.agr,a.tgl_mulai,a.tgl_selesai,a.tahun,b.nama_lengkap nama_pic,d.nama_lengkap nama_pelaksana,
        a.pic,a.pelaksana', 
        $this->table . " a INNER JOIN tbl_karyawan b ON a.pic = b.nik INNER JOIN tbl_karyawan d ON a.pelaksana = d.nik INNER JOIN 
        tbl_unit c ON a.kode_unit = c.kode_unit","(a.status = 'submitted' OR (a.status = 'approved' AND a.st_warek_1 IS NULL)) " . $extend_query . '', 
        '/' . APP_FOLDER . '/app/approval', 4,10,4); 
                       
        return $data;
    }

    public function get_data_history_approval(String $kode_unit = '', String $where = ''){
        $_SESSION['session_where']['value'] = '';
        $jabatan = $_SESSION['user_sessions']['kode_jabatan'];
        $extend_query = '';

        // jika unit rektorat atau keuangan maka approval akan terlihat semua dari semua unit
        if($kode_unit == 007 || $kode_unit == 002 && $jabatan != 0){
            $extend_query .= '';
        } else {
            $extend_query .= "AND (a.kode_unit = '$kode_unit' OR a.sign = '$kode_unit')";
        }

        if($jabatan == 0){
            $where .= " ORDER BY a.id DESC";
        } else {
            $where .= " ORDER BY a.id DESC";
        }

        if($where != '') {            
            $_SESSION['session_where']['value'] = $_SESSION['session_where']['value'] . " " . $where;
        } else {
            unset($_SESSION['session_where']);
        }
        
        $this->table = 'ig_tbl_actbud';
        $nik = decrypt($_SESSION['user_sessions']['nik']);
        $data = $this->Global_model->get_data_with_pagination('a.id,a.id_uraian,a.kode_uraian,a.kode_pencairan,a.nama_kegiatan,a.jenis_anggaran,a.agr,a.tgl_mulai,a.tgl_selesai,a.tahun,b.nama_lengkap nama_pic,d.nama_lengkap nama_pelaksana,
        a.st_kabag,a.st_sign,a.st_keu,a.st_warek_1,a.st_warek_2,a.pic,a.pelaksana', 
        $this->table . " a INNER JOIN tbl_karyawan b ON a.pic = b.nik INNER JOIN tbl_karyawan d ON a.pelaksana = d.nik INNER JOIN 
        tbl_unit c ON a.kode_unit = c.kode_unit","(a.status = 'approved' OR a.status = 'submitted') " . $extend_query . '', 
        '/' . APP_FOLDER . '/app/sim-ig/riwayat_approval', 4,5,4); 
                       
        return $data;
    }
    
    public function get_count_approval(String $kode_unit = '', String $where = ''){
        $jabatan = $_SESSION['user_sessions']['kode_jabatan'];
        $extend_query = "AND (a.kode_unit = '$kode_unit' OR a.sign = '$kode_unit')";
        // jika unit rektorat atau keuangan maka approval akan terlihat semua dari semua unit
        if($kode_unit == 007 || $kode_unit == 002 || $jabatan == 0){
            $extend_query = '';
        }
        
        $nik = decrypt($_SESSION['user_sessions']['nik']);
        $sql = $this->db->query("SELECT COUNT(a.id) total FROM ig_tbl_actbud a WHERE a.status = 'submitted' ". $extend_query ." " . $where);
        $result = $sql->row();
        return $result;
    }

    public function get_approval_by_id(int $id){
        $this->table = 'ig_tbl_actbud';
        $query = sprintf("SELECT a.id,a.id_uraian,a.kode_uraian,a.kode_unit,a.kode_pencairan,a.nama_kegiatan,a.jenis_anggaran,a.agr,a.tgl_mulai,a.tgl_selesai,a.tahun,b.nama_lengkap pic,d.nama_lengkap pelaksana,
        a.deskripsi_kegiatan,a.kpi,a.periode,a.st_kabag,a.c_kabag,a.stamp_kabag,a.st_sign,a.c_sign,a.stamp_sign,a.st_keu,a.c_keu,a.stamp_keu,e.nama_unit unit_pre_approval,
        a.st_warek_1,a.c_warek1,a.stamp_warek1,a.st_warek_2,a.c_warek2,a.stamp_warek2,a.sign,a.nama_kabag,a.nama_sign,a.nama_keu,a.nama_warek_1,a.nama_warek_2 
        FROM ".$this->table." a INNER JOIN tbl_karyawan b ON a.pic = b.nik INNER JOIN tbl_karyawan d ON a.pelaksana = d.nik INNER JOIN 
        tbl_unit c ON a.kode_unit = c.kode_unit LEFT JOIN tbl_unit e ON a.sign = e.kode_unit WHERE a.id = '%u'", $id);
        $sql = $this->db->query($query);
        $data = $sql->row();
        return $data;
    }
}