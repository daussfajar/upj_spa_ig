<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    var $year = 2022;

    function __construct()
    {
        parent::__construct();
        $this->Global_model->is_logged_in();
        $this->load->model('SPA/Dashboard_model', 'm_dashboard');
        header("X-XSS-Protection: 1; mode=block");
    }

    public function index()
    {
        $session                = $this->session->userdata('user_sessions');
        $nik                    = decrypt($session['nik']);
        $kode_unit              = $session['kode_unit'];

        $getTotalActbud                     = $this->m_dashboard->get_total_actbud(decrypt($session['nik']), $this->year);
        $data['total_actbud_diajukan']      = $getTotalActbud['jumlah_actbud'];
        $data['total_petty_cash_diajukan']  = $getTotalActbud['jumlah_petty_cash'];

        $getTotalActbudDitolak              = $this->m_dashboard->get_total_actbud_ditolak(decrypt($session['nik']), $this->year);
        $data['total_actbud_ditolak']       = $getTotalActbudDitolak['jumlah_actbud'];
        $data['total_petty_cash_ditolak']   = $getTotalActbudDitolak['jumlah_petty_cash'];

        if($session['kode_jabatan'] == "1"){
            $data['total_approval_presiden']   = $this->m_dashboard->get_total_approval_presiden($this->year);
        } else if($session['kode_jabatan'] == "2"){
            $data['total_approval_rektor']     = $this->m_dashboard->get_total_approval_rektor($this->year);
        } else if($session['kode_jabatan'] == "3"){
            $data['total_approval_warek1']     = $this->m_dashboard->get_total_approval_warek1($this->year);
        } else if($session['kode_jabatan'] == "4"){
            $data['total_approval_warek2']     = $this->m_dashboard->get_total_approval_warek2($this->year);
        } else if($session['kode_jabatan'] == "5"){
            $data['total_approval_kabag']   = $this->m_dashboard->get_total_approval_kabag($session['kode_unit'], $this->year);
            if($kode_unit == "017"){
                $data['total_approval_fhb']     = $this->m_dashboard->get_total_approval_fhb($this->year);
            } else {
                $data['total_approval_ftd']     = $this->m_dashboard->get_total_approval_ftd($this->year);
            }
        } else if ($session['kode_jabatan'] == "6" || $session['kode_jabatan'] == "22"){
            $data['total_approval_kabag']   = $this->m_dashboard->get_total_approval_kabag($session['kode_unit'], $this->year);

            if($kode_unit == "002"){
                $data['total_approval_keuangan']            = $this->m_dashboard->get_total_approval_keuangan($this->year);
                $data['total_approval_pengalihan_anggaran'] = $this->m_dashboard->get_total_pengalihan_anggaran($this->year);
            }
            if($kode_unit == "003"){
                $data['total_approval_umum'] = $this->m_dashboard->get_total_approval_umum($this->year);
            }
            if($kode_unit == "004"){
                $data['total_approval_ict'] = $this->m_dashboard->get_total_approval_ict($this->year);
            }
            if($kode_unit == "006"){
                $data['total_approval_hrd'] = $this->m_dashboard->get_total_approval_hrd($this->year);
            }
            if($kode_unit == "013"){
                $data['total_approval_bkal'] = $this->m_dashboard->get_total_approval_bkal($this->year);
            }
            if($kode_unit == "016"){
                $data['total_approval_p2m'] = $this->m_dashboard->get_total_approval_p2m($this->year);
            }
        }

        if($kode_unit == "002" && $session['kode_jabatan'] == "7"){
            $data['total_approval_keuangan']            = $this->m_dashboard->get_total_approval_keuangan($this->year);
            $data['total_approval_pengalihan_anggaran'] = $this->m_dashboard->get_total_pengalihan_anggaran($this->year);
        }

        return view('spa.dashboard.dashboard', $data);
    }
}
