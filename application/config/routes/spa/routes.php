<?php

defined('BASEPATH') or exit('No direct script access allowed');

$route['app/sim-spa/dashboard'] = 'SPA/Dashboard';
$route['app/sim-spa/actbud'] = 'SPA/Actbud';

// PENCAIRAN RKAT
// Actbud
//$route['app/sim-spa/pencairan-rkat/input-actbud/(:num)/save-actbud']['POST'] = 'SPA/PencairanRKAT/save_input_actbud/$1';
//$route['app/sim-spa/pencairan-rkat/actbud/input-actbud/(:num)/(:num)/buat-rincian-kegiatan']['POST'] = 'SPA/PencairanRKAT/buat_rincian_kegiatan/$1/$2';
// $route['app/sim-spa/pencairan-rkat/view-actbud'] = 'SPA/PencairanRKAT/v_view_actbud';
// $route['app/sim-spa/pencairan-rkat/view-petty-cash'] = 'SPA/PencairanRKAT/v_view_pettycash';

$route['app/sim-spa/pencairan-rkat/input-actbud'] = 'SPA/PencairanRKAT/v_input_actbud';
$route['app/sim-spa/pencairan-rkat/input-actbud/(:num)'] = 'SPA/PencairanRKAT/v_proses_input_actbud/$1';
$route['app/sim-spa/pencairan-rkat/actbud/input-actbud/(:num)/(:num)'] = 'SPA/PencairanRKAT/v_detail_actbud/$1/$2';
$route['app/sim-spa/pencairan-rkat/actbud/input-actbud/(:num)/(:num)/upload-dokumen-pendukung']['POST'] = 'SPA/PencairanRKAT/upload_dokumen_pendukung/$1/$2';
$route['app/sim-spa/pencairan-rkat/actbud/input-actbud/(:num)/(:num)/hapus-dokumen-pendukung']['POST'] = 'SPA/PencairanRKAT/hapus_dokumen_pendukung/$1/$2';

$route['app/sim-spa/pencairan-rkat/actbud/status-actbud/(:num)/(:num)'] = 'SPA/PencairanRKAT/v_detail_actbud/$1/$2';
$route['app/sim-spa/pencairan-rkat/actbud/status-actbud/(:num)/(:num)/upload-dokumen-pendukung']['POST'] = 'SPA/PencairanRKAT/upload_dokumen_pendukung/$1/$2';
$route['app/sim-spa/pencairan-rkat/actbud/status-actbud/(:num)/(:num)/hapus-dokumen-pendukung']['POST'] = 'SPA/PencairanRKAT/hapus_dokumen_pendukung/$1/$2';

$route['app/sim-spa/pencairan-rkat/status-actbud'] = 'SPA/PencairanRKAT/v_status_actbud';
$route['app/sim-spa/pencairan-rkat/status-petty-cash'] = 'SPA/PencairanRKAT/v_status_pettycash';

$route['app/sim-spa/pencairan-rkat/submit_rkat/(:num)/(:num)']['POST'] = 'SPA/PencairanRKAT/v_detail_actbud/$1/$2';

$route['app/sim-spa/pencairan-rkat/input-petty-cash'] = 'SPA/PencairanRKAT/v_input_pettycash';
$route['app/sim-spa/pencairan-rkat/input-petty-cash/(:num)'] = 'SPA/PencairanRKAT/v_proses_input_petty_cash/$1';
$route['app/sim-spa/pencairan-rkat/petty-cash/input-petty-cash/(:num)/(:num)'] = 'SPA/PencairanRKAT/v_detail_actbud/$1/$2';
$route['app/sim-spa/pencairan-rkat/petty-cash/status-petty-cash/(:num)/(:num)'] = 'SPA/PencairanRKAT/v_detail_actbud/$1/$2';
$route['app/sim-spa/pencairan-rkat/petty-cash/status-petty-cash/(:num)/(:num)/upload-dokumen-pendukung']['POST'] = 'SPA/PencairanRKAT/upload_dokumen_pendukung/$1/$2';
$route['app/sim-spa/pencairan-rkat/petty-cash/status-petty-cash/(:num)/(:num)/hapus-dokumen-pendukung']['POST'] = 'SPA/PencairanRKAT/hapus_dokumen_pendukung/$1/$2';

// END PENCAIRAN RKAT

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

        // laporan pencairan
        $route['app/sim-spa/admin/rkat/laporan-pencairan'] = 'SPA/Admin/RKAT/laporan_pencairan';
        $route['app/sim-spa/admin/rkat/laporan-pencairan/(:num)'] = 'SPA/Admin/RKAT/laporan_pencairan/$1';
        $route['app/sim-spa/admin/rkat/laporan-pencairan/cetak-actbud/(:num)'] = 'SPA/Admin/RKAT/cetak_actbud_laporan_pencairan/$1';
        $route['app/sim-spa/admin/rkat/laporan-pencairan/cetak-petty-cash/(:num)'] = 'SPA/Admin/RKAT/cetak_petty_laporan_pencairan/$1';
        $route['app/sim-spa/admin/rkat/laporan-pencairan/kirim-pesan/(:any)'] = 'SPA/Admin/RKAT/kirim_pesan_laporan_pencairan/$1';
    // END RKAT
// END ADMIN

// START APPROVAL

    // Approval Kepala Unit
    $route['app/sim-spa/approval/kepala-unit'] = 'SPA/Approval/v_kepala_unit';
    $route['app/sim-spa/approval/kepala-unit/detail/(:num)'] = 'SPA/Approval/v_detail/$1';
    $route['app/sim-spa/approval/kepala-unit/kirim-persetujuan/(:any)'] = 'SPA/Approval/kirim_persetujuan_kepala_unit/$1';

    // Approval Dekan
    $route['app/sim-spa/approval/dekan'] = 'SPA/Approval/approval_dekan';
    $route['app/sim-spa/approval/dekan/detail/(:num)'] = 'SPA/Approval/v_detail/$1';
    $route['app/sim-spa/approval/dekan/kirim-persetujuan-fhb/(:any)'] = 'SPA/Approval/kirim_persetujuan_dekan_fhb/$1';
    $route['app/sim-spa/approval/dekan/kirim-persetujuan-ftd/(:any)'] = 'SPA/Approval/kirim_persetujuan_dekan_ftd/$1';

    // Approval Warek 1
    $route['app/sim-spa/approval/warek1'] = 'SPA/Approval/approval_warek_1';
    $route['app/sim-spa/approval/warek1/detail/(:num)'] = 'SPA/Approval/v_detail/$1';
    $route['app/sim-spa/approval/warek1/kirim-catatan'] = 'SPA/Approval/kirim_catatan_warek_1';
    $route['app/sim-spa/approval/warek1/kirim-persetujuan/(:any)'] = 'SPA/Approval/kirim_persetujuan_warek_1/$1';    

    // Approval Warek 2
    $route['app/sim-spa/approval/warek2'] = 'SPA/Approval/approval_warek_2';
    $route['app/sim-spa/approval/warek2/detail/(:num)'] = 'SPA/Approval/v_detail/$1';
    $route['app/sim-spa/approval/warek2/kirim-catatan'] = 'SPA/Approval/kirim_catatan_warek_2';
    $route['app/sim-spa/approval/warek2/kirim-persetujuan/(:any)'] = 'SPA/Approval/kirim_persetujuan_warek_2/$1';    

    // Approval Rektor
    $route['app/sim-spa/approval/rektor'] = 'SPA/Approval/approval_rektor';
    $route['app/sim-spa/approval/rektor/detail/(:num)'] = 'SPA/Approval/v_detail/$1';
    $route['app/sim-spa/approval/rektor/kirim-catatan'] = 'SPA/Approval/kirim_catatan_rektor';
    $route['app/sim-spa/approval/rektor/kirim-persetujuan/(:any)'] = 'SPA/Approval/kirim_persetujuan_rektor/$1';    

    // Approval Presiden
    $route['app/sim-spa/approval/presiden'] = 'SPA/Approval/approval_presiden';
    $route['app/sim-spa/approval/presiden/detail/(:num)'] = 'SPA/Approval/v_detail/$1';
    $route['app/sim-spa/approval/presiden/kirim-persetujuan/(:any)'] = 'SPA/Approval/kirim_persetujuan_presiden/$1';    
// END APPROVAL
