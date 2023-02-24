<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sponsorship_Model extends CI_Model {    
    
    protected $table = '';
    protected $field = [];

    function __construct(){
        parent::__construct();
        $this->load->model('Global_model');
    }

    public function get_data_sponsorship(String $where = ""){
        $_SESSION['session_where']['value'] = '';
        $this->table = 'ig_tbl_uraian';
        $jabatan = $_SESSION['user_sessions']['kode_jabatan'];
        $nik = decrypt($_SESSION['user_sessions']['nik']);
        $kode_unit = $_SESSION['user_sessions']['kode_unit'];

        if($jabatan == 0 || ($kode_unit == 002)){
            $where .= " ORDER BY a.id DESC";
        } else {
            $where .= "AND a.pic = '$nik' ORDER BY a.id DESC";
        }

        if($where != '') {            
            $_SESSION['session_where']['value'] = $_SESSION['session_where']['value'] . " " . $where;
        } else {
            unset($_SESSION['session_where']);
        }

        $data = $this->Global_model->get_data_with_pagination('a.id,a.kode_uraian,a.kode_pencairan,b.nama_lengkap,a.kpi,
        c.nama_unit,a.nama_hibah_sponsorship,a.cara_ukur,a.kode_unit,a.pic,a.kode_sub_aktivitas,a.indikator_kerja_umum,
        a.target,a.total_agr,a.ttd_pic,a.output,a.base_line,a.uraian_kegiatan,a.periode,a.tanggal_buat,a.status,a.finalisasi', 
        $this->table . " a LEFT JOIN tbl_karyawan b ON a.pic = b.nik INNER JOIN tbl_unit c ON a.kode_unit = c.kode_unit","a.jenis_ig = 'sponsorship' AND a.status = 'Aktif' ", 
        '/' . APP_FOLDER . '/app/sim-ig/sponsorship', 4,5,4);
        return $data;
    }

    public function get_count_sponsorship(String $nik){
        $query = sprintf("SELECT COUNT(a.id) total FROM ig_tbl_uraian a WHERE a.pic = '%s' AND a.jenis_ig = 'sponsorship' AND a.status = 'Aktif'", $nik);
        $result = $this->db->query($query)->row();
        return $result;
    }

    public function get_kode_uraian_sponsorship(){
        $this->db->where('ig_tbl_uraian.jenis_ig', 'sponsorship');
        $this->db->where('ig_tbl_uraian.status', 'Aktif');
        $this->db->select('RIGHT(ig_tbl_uraian.kode_uraian,5) as kode_uraian', FALSE);
        $this->db->order_by('kode_uraian','DESC');    
        $this->db->limit(1);    
        $query = $this->db->get('ig_tbl_uraian');
            if($query->num_rows() <> 0){      
                 $data = $query->row();
                 $kode = intval($data->kode_uraian) + 1; 
            }
            else{      
                 $kode = 1;  
            }
        $batas = str_pad($kode, 5, "0", STR_PAD_LEFT);    
        $kodetampil = 'SP-'.date('m-Y').'-'.$batas;
        return $kodetampil;
    }

    public function insert_kegiatan_sponsorship(Array $data){
        $insert = $this->db->insert('ig_tbl_uraian', $data);
        if($insert === true){
            $result['success'] = true;
        } else {
            $result['success'] = false;
        }

        return $result;
    }

    public function get_data_sponsorship_by_id(int $id, string $where = ''){
        $this->table = 'ig_tbl_uraian';
        $nik = decrypt($_SESSION['user_sessions']['nik']);
        $query = sprintf("SELECT a.id,a.kode_uraian,a.kode_unit,a.nama_hibah_sponsorship,a.uraian_kegiatan,
        a.periode,a.tanggal_buat,a.kpi,a.pic,a.output,a.target,a.cara_ukur,a.base_line,a.kode_pencairan,a.total_agr,a.jenis_ig jenis_anggaran,
        a.ttd_pic,a.status,b.nama_lengkap nama_karyawan,c.nama_unit FROM ".$this->table." a INNER JOIN tbl_karyawan b ON a.pic = b.nik 
        INNER JOIN tbl_unit c ON a.kode_unit = c.kode_unit WHERE a.id = %u AND a.jenis_ig = 'sponsorship' AND a.status = 'Aktif' ".$where, $this->db->escape($id));
        $result = $this->db->query($query)->row();
        return $result;
    }

    public function edit_kegiatan_sponsorship(int $id, Array $data){
        $this->table = 'ig_tbl_uraian';
        $this->db->where('id', $id);
        $update = $this->db->update($this->table, $data);
        if($update === true){
            $result['success'] = true;
        } else {
            $result['success'] = false;
        }

        return $result;
    }

    // get data sponsorship yang sudah difinalisasi
    public function get_data_sponsorship_finalisasi(String $where = ''){
        $_SESSION['session_where']['value'] = '';
        $this->table = 'ig_tbl_uraian';        
        $nik = decrypt($_SESSION['user_sessions']['nik']);
        $jabatan = $_SESSION['user_sessions']['kode_jabatan'];
        $kode_unit = $_SESSION['user_sessions']['kode_unit'];
        if($jabatan == 0){
            $where .= " ORDER BY a.id DESC";
        } else {
            $where .= "AND a.pic = '$nik' ORDER BY a.id DESC";
        }

        if($where != '') {            
            $_SESSION['session_where']['value'] = $_SESSION['session_where']['value'] . " " . $where;
        } else {
            unset($_SESSION['session_where']);
        }
        
        $data = $this->Global_model->get_data_with_pagination(
            "a.id,
            a.kode_uraian,
            c.nama_unit,
            a.nama_hibah_sponsorship,
            b.nama_lengkap,
            a.uraian_kegiatan,
            a.jenis_ig,
            a.total_agr,
            a.pic,
            b.nama_lengkap AS nama_karyawan,
            a.kode_pencairan, IF( a.periode = 1, 'Ganjil', 'Genap' ) AS periode,
            IFNULL( ( SELECT SUM( nominal ) FROM ig_tbl_pengalihan WHERE kode_uraian = a.kode_uraian ), 0 ) agr_masuk,
            IFNULL( ( SELECT SUM( nominal ) FROM ig_tbl_pengalihan WHERE kode_uraian_out = a.kode_uraian ), 0 ) agr_keluar,
            IFNULL( ( SELECT SUM( fnl_agr ) FROM ig_tbl_actbud WHERE kode_uraian = a.kode_uraian AND STATUS != 'cancel' ), 0 )
            agr_digunakan", 
            $this->table . " a INNER JOIN tbl_karyawan b ON a.pic = b.nik JOIN tbl_unit c ON b.kode_unit = c.kode_unit",
            "a.status = 'Aktif' AND (a.jenis_ig = 'sponsorship' AND a.finalisasi = 'Y') ", 
            '/' . APP_FOLDER . '/app/sim-ig/sponsorship/pencairan', 5,5,4);
        return $data;
    }

    public function get_data_pencairan(int $id){
        $this->table = 'ig_tbl_actbud';
        $nik = decrypt($_SESSION['user_sessions']['nik']);
        $query = sprintf("SELECT a.id,a.nama_kegiatan,b.nama_lengkap nama_pelaksana,a.deskripsi_kegiatan,a.pelaksana,a.pic,a.tgl_mulai,a.tgl_selesai,a.periode,
        a.tanggal_pembuatan,a.agr,a.fnl_agr,a.status FROM ig_tbl_actbud a INNER JOIN tbl_karyawan b ON a.pelaksana = b.nik WHERE a.pic = '%s' AND a.id_uraian = '%s'", $nik, $id);
        $result = $this->db->query($query)->result();
        return $result;
    }

    function cek_anggaran_digunakan_sementara(int $id_uraian){
        $query = sprintf("SELECT SUM(a.fnl_agr) digunakan FROM ig_tbl_actbud a WHERE a.id_uraian = '%u' AND a.status_act = 'send' 
        AND (a.status != 'cancel')", $id_uraian);
        $result = $this->db->query($query)->row();
        return $result;
    }

    function cek_anggaran_digunakan_final(int $id_uraian){
        $query = sprintf("SELECT SUM(a.fnl_agr) digunakan FROM ig_tbl_actbud a WHERE a.id_uraian = '%u' AND a.status_act = 'send' 
        AND (a.status = 'approved')", $id_uraian);
        $result = $this->db->query($query)->row();
        return $result;
    }

    public function create_pencairan(Array $data){
        $insert = $this->db->insert('ig_tbl_actbud', $data);
        if($insert === true){
            $result['success'] = true;
        } else {
            $result['success'] = false;
        }

        return $result;
    }

    public function get_data_rincian_pencairan($pic, $unit, $where = ""){
        $data = $this->Global_model->get_data_with_pagination('a.id,a.id_actbud,a.nama_kegiatan,a.total_anggaran,a.keterangan,a.tanggal_buat,a.catatan_wr_1,
        a.catatan_wr_2,a.status,b.kode_pencairan,a.keterangan,c.id id_hibah,b.status status_actbud,a.tgl_mulai,a.tgl_selesai', 
        "ig_t_j_b_act a INNER JOIN ig_tbl_actbud b ON a.id_actbud = b.id 
        INNER JOIN ig_tbl_uraian c ON b.id_uraian = c.id","c.jenis_ig = 'sponsorship' AND b.pic = '$pic' AND b.kode_unit = '$unit' AND a.status = 'Aktif' " . $where, 
        '/' . APP_FOLDER . '/app/sim-ig/sponsorship/status_pencairan', 5,5,4);        
        return $data;
    }

    public function get_data_pencairan_all($pic, String $where = ""){
        $_SESSION['session_where']['value'] = '';
        $jabatan = $_SESSION['user_sessions']['kode_jabatan'];        

        if($jabatan == 0){
            $where .= " ORDER BY a.id DESC";
        } else {
            $where .= "AND a.pic = '$pic' ORDER BY a.id DESC";
        }

        if($where != '') {            
            $_SESSION['session_where']['value'] = $_SESSION['session_where']['value'] . " " . $where;
        } else {
            unset($_SESSION['session_where']);
        }
        
        $data = $this->Global_model->get_data_with_pagination("a.id id_actbud,IF(a.jenis_anggaran = 'sponsorship', 'SP', 'HB') jns_agr,a.nama_kegiatan,
        b.nama_lengkap nama_pelaksana,a.deskripsi_kegiatan,
        a.pelaksana,a.pic,a.tgl_mulai,a.tgl_selesai,a.periode,
        a.tanggal_pembuatan,a.kode_pencairan,
        a.agr,a.fnl_agr,a.status status_actbud,a.agr,c.id id_hibah", 
        "ig_tbl_actbud a INNER JOIN tbl_karyawan b ON a.pelaksana = b.nik INNER JOIN ig_tbl_uraian c ON a.id_uraian = c.id","c.jenis_ig = 'sponsorship'", 
        '/' . APP_FOLDER . '/app/sim-ig/sponsorship/status_pencairan', 5,5,4);        
        return $data;
    }

    public function get_data_chat_actbud(int $id){
        $query = sprintf("SELECT a.id,a.nik,a.pesan,a.datetime_chat,a.status,b.nama_lengkap sender,a.attachment,a.attachment_size FROM ig_tbl_actbud_chat a 
        INNER JOIN tbl_karyawan b ON a.nik = b.nik WHERE a.id_act = '%s' AND a.status = 'Aktif'", $id);
        $result = $this->db->query($query)->result();
        return $result;
    }

    public function get_detail_actbud(int $id_uraian, int $id){
        $this->table = 'ig_tbl_actbud';
        /*$nik = decrypt($_SESSION['user_sessions']['nik']);
        $kode_unit = $_SESSION['user_sessions']['kode_unit'];
        $jabatan = $_SESSION['user_sessions']['kode_jabatan'];
        $w_1 = "";

        if($jabatan == 0 || $kode_unit == 002){
            $w_1 .= "";            
        } else {
            $w_1 .= "a.pic = '".$nik."' AND";
        }*/
        
        $query = sprintf("SELECT a.id,IF(a.jenis_anggaran = 'hibah', 'HB', 'SP') jns_agr,a.kode_uraian,g.nama_hibah_sponsorship,g.jenis_ig,g.uraian_kegiatan,a.kode_unit,f.nama_unit,a.kode_pencairan,a.nama_kegiatan,e.nama_lengkap nama_pic,b.nama_lengkap nama_pelaksana,a.deskripsi_kegiatan,
        a.kpi,a.pic,a.pelaksana,a.tgl_mulai,a.tgl_selesai,a.periode,a.tahun,a.tanggal_pembuatan,a.agr,a.fnl_agr,a.lock_editing,a.last_update,a.sign,a.status,d.nama_unit unit_pre_approval,
        a.st_kabag,a.c_kabag,a.stamp_kabag,a.st_sign,a.c_sign,a.stamp_sign,a.st_keu,a.c_keu,a.stamp_keu,a.st_warek_1,a.c_warek1,a.stamp_warek1,a.st_warek_2,a.c_warek2,a.stamp_warek2,a.nama_kabag,a.nama_sign,a.nama_keu,a.nama_warek_1,a.nama_warek_2 
        FROM ".$this->table." a INNER JOIN tbl_karyawan b ON a.pelaksana = b.nik LEFT JOIN tbl_unit d ON a.sign = d.kode_unit 
        INNER JOIN tbl_karyawan e ON a.pic = e.nik 
        INNER JOIN tbl_unit f ON a.kode_unit = f.kode_unit 
        INNER JOIN ig_tbl_uraian g ON a.kode_uraian = g.kode_uraian WHERE a.id_uraian = '%s' AND a.id = '%s'", $id_uraian, $id);
        $result = $this->db->query($query)->row();
        return $result;
    }

    public function cek_anggaran_rincian_kegiatan(int $id){
        $query = sprintf("SELECT SUM(a.total_anggaran) digunakan FROM ig_t_j_b_act a WHERE a.id_actbud = '%u' AND 
        a.status = 'Aktif'", $id);
        $result = $this->db->query($query)->row();
        return $result;
    }
}
?>