<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Realisasi_Anggaran_Model extends CI_Model {    
    
    protected $table = '';
    protected $field = [];

    function __construct(){
        parent::__construct();
        $this->load->model('Global_model');
    }

    public function get_data(String $p1 = ''){
        $where = "";
        $kode_jabatan   = $_SESSION['user_sessions']['kode_jabatan'];
        $kode_unit      = $_SESSION['user_sessions']['kode_unit'];
        $pic            = decrypt($_SESSION['user_sessions']['nik']);

        if($kode_jabatan == 0){
            $where .= "";
        } else {
            if($kode_unit == '002'){
                $where .= "";
            } else {
                $where .= "AND a.pic = '$pic'";
            }
        }

        // nanti disini kasih where, masih ada kondisi lagi
        $data = $this->Global_model->get_data_with_pagination("a.id,IF(a.jenis_anggaran = 'hibah', 'HB', 'SP') jenis_actbud,
        a.id_uraian,a.kode_uraian,a.kode_pencairan,a.kode_unit,a.nama_kegiatan,a.deskripsi_kegiatan,
        a.pic,a.pelaksana,a.tgl_mulai,a.tgl_selesai,a.periode,a.tanggal_pembuatan,a.agr,b.nama_lengkap nama_pic,
        c.nama_unit nama_unit_pic,a.realisasi", "ig_tbl_actbud a 
        JOIN tbl_karyawan b ON a.pic = b.nik JOIN tbl_unit c ON b.kode_unit = c.kode_unit", "a.status = 'approved' " . $where . $p1 . "", '/' . APP_FOLDER . '/app/sim-ig/realisasi_anggaran', 4,5,4);
        return $data;
    }

    public function get_detail_actbud(int $id_actbud, String $where = ''){
        $kode_jabatan   = $_SESSION['user_sessions']['kode_jabatan'];
        $kode_unit      = $_SESSION['user_sessions']['kode_unit'];
        $pic            = decrypt($_SESSION['user_sessions']['nik']);

        /*if($kode_jabatan != 0){
            $where .= "AND a.pic = '$pic' ";
        }*/
        $where .= "";

        $sql = "SELECT a.id,IF(a.jenis_anggaran = 'hibah', 'HB', 'SP') jenis_actbud,
        a.id_uraian,a.kode_uraian,a.kode_pencairan,a.kode_unit,a.nama_kegiatan,a.deskripsi_kegiatan,a.kpi,
        a.pic,a.pelaksana,a.tgl_mulai,a.tgl_selesai,a.periode,a.tanggal_pembuatan,a.agr,b.nama_lengkap nama_pic,d.nama_lengkap nama_pelaksana,
        e.nama_unit nama_unit_pelaksana,a.status,a.realisasi,
        c.nama_unit nama_unit_pic FROM ig_tbl_actbud a JOIN tbl_karyawan b ON a.pic = b.nik JOIN tbl_unit c ON b.kode_unit = c.kode_unit 
        JOIN tbl_karyawan d ON a.pelaksana = d.nik JOIN tbl_unit e ON d.kode_unit = e.kode_unit
        WHERE a.id = '$id_actbud' AND a.status = 'approved' ".$where;

        $query  = $this->db->query($sql);
        $result = $query->row();

        return $result;
    }

    public function get_detail_biaya(int $id_actbud, String $where = ''){
        $kode_jabatan   = $_SESSION['user_sessions']['kode_jabatan'];
        $kode_unit      = $_SESSION['user_sessions']['kode_unit'];
        $pic            = decrypt($_SESSION['user_sessions']['nik']);

        $sql = "SELECT * FROM ig_t_j_b_act a WHERE a.id_actbud = ".$this->db->escape($id_actbud)." AND a.status = 'Aktif'";
        $query = $this->db->query($sql);
        $result = $query->result();

        return $result;
    }

    public function get_total_anggaran_realisasi(int $id){
        $query = sprintf("SELECT SUM(a.total_anggaran_realisasi) total FROM ig_t_j_b_act a WHERE a.id_actbud = '%u' AND 
        a.status = 'Aktif'", $id);
        $result = $this->db->query($query)->row();
        return $result;
    }

    public function get_total_anggaran_disetujui(int $id){
        $query = sprintf("SELECT SUM(a.total_anggaran) total FROM ig_t_j_b_act a WHERE a.id_actbud = '%u' AND 
        a.status = 'Aktif'", $id);
        $result = $this->db->query($query)->row();
        return $result;
    }

    public function get_total_belum_finalisasi(String $where = ''){
        $kode_jabatan   = $_SESSION['user_sessions']['kode_jabatan'];
        $kode_unit      = $_SESSION['user_sessions']['kode_unit'];
        $pic            = decrypt($_SESSION['user_sessions']['nik']);

        if($kode_jabatan == 0){
            $where .= "";
        } else {
            if($kode_unit == '002'){
                $where .= "";
            } else {
                $where .= "AND a.pic = '$pic'";
            }
        }

        $query = sprintf("SELECT COUNT(a.id) total FROM ig_tbl_actbud a WHERE 
        a.status = '%s' AND a.realisasi = 'N' " . $where, 'approved');
        $result = $this->db->query($query)->row();
        return $result;
    }
}