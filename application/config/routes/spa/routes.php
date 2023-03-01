<?php

defined('BASEPATH') or exit('No direct script access allowed');

$route['app/sim-spa/dashboard'] = 'SPA/Dashboard';
$route['app/sim-spa/actbud'] = 'SPA/Actbud';

// PENCAIRAN RKAT
// Actbud
$route['app/sim-spa/pencairan-rkat/input-actbud'] = 'SPA/PencairanRKAT/v_input_actbud';
$route['app/sim-spa/pencairan-rkat/input-actbud/(:num)'] = 'SPA/PencairanRKAT/v_proses_input_actbud/$1';
//$route['app/sim-spa/pencairan-rkat/input-actbud/(:num)/save-actbud']['POST'] = 'SPA/PencairanRKAT/save_input_actbud/$1';
$route['app/sim-spa/pencairan-rkat/input-actbud/detail/(:num)/(:num)'] = 'SPA/PencairanRKAT/v_detail_actbud/$1/$2';
// END PENCAIRAN RKAT

$route['app/sim-spa/pencairan-rkat/view-actbud'] = 'SPA/PencairanRKAT/v_view_actbud';
$route['app/sim-spa/pencairan-rkat/status-actbud'] = 'SPA/PencairanRKAT/v_status_actbud';
$route['app/sim-spa/pencairan-rkat/input-petty-cash'] = 'SPA/PencairanRKAT/v_input_pettycash';
$route['app/sim-spa/pencairan-rkat/view-petty-cash'] = 'SPA/PencairanRKAT/v_view_pettycash';
$route['app/sim-spa/pencairan-rkat/status-petty-cash'] = 'SPA/PencairanRKAT/v_status_pettycash';
// START RKAT
// pic
$route['app/sim-spa/rkat/pic/program-kerja'] = 'SPA/RKAT/pic_rkat_program_kerja';
$route['app/sim-spa/rkat/pic/operasional'] = 'SPA/RKAT/pic_rkat_operasional';
$route['app/sim-spa/rkat/pic/investasi'] = 'SPA/RKAT/pic_rkat_investasi';
$route['app/sim-spa/rkat/ubah-pic'] = 'SPA/RKAT/ubah_pic';

// list
$route['app/sim-spa/rkat/list/program-kerja'] = 'SPA/RKAT/list_rkat_program_kerja';
$route['app/sim-spa/rkat/list/operasional'] = 'SPA/RKAT/list_rkat_operasional';
$route['app/sim-spa/rkat/list/investasi'] = 'SPA/RKAT/list_rkat_investasi';
// END RKAT

// START ANGGARAN
    // PENGALIHAN
        $route['app/sim-spa/anggaran/pengalihan'] = 'SPA/Anggaran/pengalihan';
        $route['app/sim-spa/anggaran/pengalihan/(:num)'] = 'SPA/Anggaran/pengalihan/$1';
        $route['app/sim-spa/anggaran/pengalihan/tambah'] = 'SPA/Anggaran/tambah_pengalihan';
        $route['app/sim-spa/anggaran/pengalihan/proses/(:num)'] = 'SPA/Anggaran/proses_pengalihan/$1';
        $route['app/sim-spa/anggaran/realisasi'] = 'SPA/Anggaran/realisasi';
        $route['app/sim-spa/anggaran/realisasi/(:num)'] = 'SPA/Anggaran/realisasi/$1';
        $route['app/sim-spa/anggaran/realisasi/(:num)/penyesuaian-biaya'] = 'SPA/Anggaran/penyesuaian_biaya/$1';
        $route['app/sim-spa/anggaran/realisasi/(:num)/finalisasi-penyesuaian-anggaran'] = 'SPA/Anggaran/finalisasi_penyesuaian_anggaran/$1';
    // REALISASI
// END ANGGARAN

// ADMIN
    // START RKAT
        // pic
        $route['app/sim-spa/admin/rkat/pic/program-kerja'] = 'SPA/Admin/RKAT/pic_rkat_program_kerja';
        $route['app/sim-spa/admin/rkat/pic/operasional'] = 'SPA/Admin/RKAT/pic_rkat_operasional';
        $route['app/sim-spa/admin/rkat/pic/investasi'] = 'SPA/Admin/RKAT/pic_rkat_investasi';
        $route['app/sim-spa/admin/rkat/ubah-pic'] = 'SPA/Admin/RKAT/ubah_pic';

        // list
        $route['app/sim-spa/admin/rkat/list/program-kerja'] = 'SPA/Admin/RKAT/list_rkat_program_kerja';
        $route['app/sim-spa/admin/rkat/list/operasional'] = 'SPA/Admin/RKAT/list_rkat_operasional';
        $route['app/sim-spa/admin/rkat/list/investasi'] = 'SPA/Admin/RKAT/list_rkat_investasi';
    // END RKAT
// END ADMIN
