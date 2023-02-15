<?php

defined('BASEPATH') or exit('No direct script access allowed');

$route['app/master-data/karyawan'] = 'IG/Admin/MST_Karyawan';
$route['app/master-data/karyawan/(:any)/set_status'] = 'IG/Admin/MST_Karyawan/set_status';
$route['app/master-data/karyawan/edit/(:any)']['POST'] = 'IG/Admin/MST_Karyawan/edit_karyawan';
$route['app/master-data/karyawan/tambah_karyawan']['POST'] = 'IG/Admin/MST_Karyawan/tambah_karyawan';
$route['app/master-data/karyawan/hapus/(:any)']['POST'] = 'IG/Admin/MST_Karyawan/hapus_karyawan';
$route['app/master-data/karyawan/ubahpass']['POST'] = 'IG/Admin/MST_Karyawan/ubahpass_karyawan';

$route['app/admin/system/backup_db'] = 'IG/Maintenance/Backups/backup_db';

/* APPROVAL */
$route['app/approval'] = 'IG/User/Approval';
$route['app/approval/(:num)'] = 'IG/User/Approval';
$route['app/approval/v_detail/(:any)'] = 'IG/User/Approval/v_detail';
$route['app/approval/v_detail/(:any)/buat_pesan']['POST'] = 'IG/User/Approval/buat_pesan';
$route['app/approval/v_detail/(:any)/hapus_pesan']['POST'] = 'IG/User/Approval/hapus_pesan';
$route['app/approval/v_detail/(:any)/buat_catatan_wr_1']['POST'] = 'IG/User/Approval/buat_catatan_wr_1';
$route['app/approval/v_detail/(:any)/buat_catatan_wr_2']['POST'] = 'IG/User/Approval/buat_catatan_wr_2';
$route['app/approval/v_detail/(:any)/submit_actbud']['POST'] = 'IG/User/Approval/submit_actbud';

$route['app/riwayat_approval/v_detail/(:any)'] = 'IG/User/Approval/v_detail';
/* END APPROVAL */

/* SETTINGS */
$route['app/pengaturan/umum'] = 'IG/Admin/Settings/pengaturan_umum';
$route['app/pengaturan/login_logs'] = 'IG/Admin/Settings/login_logs';
$route['app/pengaturan/login_logs/(:num)'] = 'IG/Admin/Settings/login_logs/$1';
/* END SETTINGS */

$route['app/dashboard'] = 'IG/User/Dashboard';
$route['app/hibah'] = 'IG/User/Hibah';

$route['app/hibah/(:num)'] = 'IG/User/Hibah';
$route['app/hibah/buat_kegiatan'] = 'IG/User/Hibah/v_buat_kegiatan';
$route['app/hibah/buat_kegiatan/submit']['POST'] = 'IG/User/Hibah/submit_buat_kegiatan';
$route['app/hibah/v_detail/(:any)'] = 'IG/User/Hibah/v_detail_hibah';
$route['app/hibah/v_detail/(:any)/edit_hibah']['POST'] = 'IG/User/Hibah/edit_hibah';
$route['app/hibah/v_detail/(:any)/batalkan_kegiatan']['POST'] = 'IG/User/Hibah/batalkan_kegiatan';
$route['app/hibah/v_detail/(:any)/finalisasi']['POST'] = 'IG/User/Hibah/finalisasi';

$route['app/hibah/pencairan/detail_hibah/(:any)'] = 'IG/User/PencairanHibah/detail_hibah';
$route['app/hibah/pencairan'] = 'IG/User/PencairanHibah';
$route['app/hibah/pencairan/(:num)'] = 'IG/User/PencairanHibah';
//$route['app/hibah/pencairan/v_detail/(:any)'] = 'IG/User/PencairanHibah/v_detail';
$route['app/hibah/pencairan/v_detail/(:any)/buat_pencairan'] = 'IG/User/PencairanHibah/buat_pencairan';
$route['app/hibah/pencairan/v_detail/(:any)/buat_pencairan/create']['POST'] = 'IG/User/PencairanHibah/create_pencairan';

$route['app/hibah/pencairan/v_detail/(:any)/actbud/(:any)'] = 'IG/User/PencairanHibah/v_detail_actbud';
$route['app/hibah/pencairan/v_detail/(:any)/actbud/(:any)/ubah-actbud']['POST'] = 'IG/User/PencairanHibah/ubah_actbud';
$route['app/hibah/pencairan/v_detail/(:any)/actbud/(:any)/batalkan-actbud']['POST'] = 'IG/User/PencairanHibah/batalkan_actbud';
$route['app/hibah/pencairan/v_detail/(:any)/actbud/(:any)/hapus-pesan']['POST'] = 'IG/User/PencairanHibah/hapus_pesan';
$route['app/hibah/pencairan/v_detail/(:any)/actbud/(:any)/upload-dokumen-pendukung']['POST'] = 'IG/User/PencairanHibah/upload_dokumen_pendukung';
$route['app/hibah/pencairan/v_detail/(:any)/actbud/(:any)/hapus-dokumen-pendukung']['POST'] = 'IG/User/PencairanHibah/hapus_dokumen_pendukung';
$route['app/hibah/pencairan/v_detail/(:any)/actbud/(:any)/buat-rincian-kegiatan']['POST'] = 'IG/User/PencairanHibah/buat_rincian_kegiatan';
$route['app/hibah/pencairan/v_detail/(:any)/actbud/(:any)/hapus-rincian-kegiatan']['POST'] = 'IG/User/PencairanHibah/hapus_rincian_kegiatan';
$route['app/hibah/pencairan/v_detail/(:any)/actbud/(:any)/submit']['POST'] = 'IG/User/PencairanHibah/submit_actbud/$1/$2';

$route['app/hibah/status_pencairan/v_detail/(:any)/actbud/(:any)'] = 'IG/User/PencairanHibah/v_detail_actbud';
$route['app/realisasi_anggaran/history/v_detail/(:any)/actbud/(:any)'] = 'IG/User/PencairanHibah/v_detail_actbud';

$route['app/hibah/pencairan/v_detail/(:any)/actbud/(:any)/buat_pesan']['POST'] = 'IG/User/PencairanHibah/buat_pesan';
$route['app/hibah/pencairan/v_detail/(:any)/actbud/(:any)/cetak_form_actbud'] = 'IG/User/PencairanHibah/cetak_form_actbud';

$route['app/actbud-disetujui'] = 'IG/User/Actbud/v_actbud_disetujui';
$route['app/actbud-ditolak'] = 'IG/User/Actbud/v_actbud_ditolak';

$route['app/hibah/preview_upload'] = 'IG/User/Hibah/preview_upload';
$route['app/hibah/preview_upload/upload']['POST'] = 'IG/User/Hibah/upload_hibah';

$route['app/hibah/status_pencairan'] = 'IG/User/StatusPencairanHibah';
$route['app/hibah/status_pencairan/(:num)'] = 'IG/User/StatusPencairanHibah';
// HISTORY APPROVAL
$route['app/riwayat_approval'] = 'IG/User/HistoryApproval';
$route['app/riwayat_approval/(:num)'] = 'IG/User/HistoryApproval';

// SPONSORSHIP
$route['app/sponsorship/pencairan/detail_sponsorship/(:any)'] = 'IG/User/PencairanSponsorship/detail_sponsorship';
$route['app/sponsorship'] = 'IG/User/Sponsorship';
$route['app/sponsorship/(:num)'] = 'IG/User/Sponsorship';
$route['app/sponsorship/buat_kegiatan'] = 'IG/User/Sponsorship/v_buat_kegiatan';
$route['app/sponsorship/buat_kegiatan/submit']['POST'] = 'IG/User/Sponsorship/submit_buat_kegiatan';

$route['app/sponsorship/v_detail/(:any)'] = 'IG/User/Sponsorship/v_detail_sponsorship';
$route['app/sponsorship/v_detail/(:any)/edit_sponsorship']['POST'] = 'IG/User/Sponsorship/edit_sponsorship';
$route['app/sponsorship/v_detail/(:any)/batalkan_kegiatan']['POST'] = 'IG/User/Sponsorship/batalkan_kegiatan';
$route['app/sponsorship/v_detail/(:any)/finalisasi']['POST'] = 'IG/User/Sponsorship/finalisasi';

$route['app/sponsorship/pencairan'] = 'IG/User/PencairanSponsorship';
$route['app/sponsorship/pencairan/(:num)'] = 'IG/User/PencairanSponsorship';
//$route['app/sponsorship/pencairan/v_detail/(:any)'] = 'IG/User/PencairanSponsorship/v_detail';
$route['app/sponsorship/pencairan/v_detail/(:any)/buat_pencairan'] = 'IG/User/PencairanSponsorship/buat_pencairan';
$route['app/sponsorship/pencairan/v_detail/(:any)/buat_pencairan/create']['POST'] = 'IG/User/PencairanSponsorship/create_pencairan';

$route['app/sponsorship/pencairan/v_detail/(:any)/actbud/(:any)'] = 'IG/User/PencairanSponsorship/v_detail_actbud';
$route['app/sponsorship/pencairan/v_detail/(:any)/actbud/(:any)/ubah-actbud']['POST'] = 'IG/User/PencairanSponsorship/ubah_actbud';
$route['app/sponsorship/pencairan/v_detail/(:any)/actbud/(:any)/batalkan-actbud']['POST'] = 'IG/User/PencairanSponsorship/batalkan_actbud';
$route['app/sponsorship/pencairan/v_detail/(:any)/actbud/(:any)/hapus-pesan']['POST'] = 'IG/User/PencairanSponsorship/hapus_pesan';
$route['app/sponsorship/pencairan/v_detail/(:any)/actbud/(:any)/upload-dokumen-pendukung']['POST'] = 'IG/User/PencairanSponsorship/upload_dokumen_pendukung';
$route['app/sponsorship/pencairan/v_detail/(:any)/actbud/(:any)/hapus-dokumen-pendukung']['POST'] = 'IG/User/PencairanSponsorship/hapus_dokumen_pendukung';
$route['app/sponsorship/pencairan/v_detail/(:any)/actbud/(:any)/buat-rincian-kegiatan']['POST'] = 'IG/User/PencairanSponsorship/buat_rincian_kegiatan';
$route['app/sponsorship/pencairan/v_detail/(:any)/actbud/(:any)/hapus-rincian-kegiatan']['POST'] = 'IG/User/PencairanSponsorship/hapus_rincian_kegiatan';
$route['app/sponsorship/pencairan/v_detail/(:any)/actbud/(:any)/submit']['POST'] = 'IG/User/PencairanSponsorship/submit_actbud';

$route['app/sponsorship/pencairan/v_detail/(:any)/actbud/(:any)/buat_pesan']['POST'] = 'IG/User/PencairanSponsorship/buat_pesan';
$route['app/sponsorship/pencairan/v_detail/(:any)/actbud/(:any)/cetak_form_actbud'] = 'IG/User/PencairanSponsorship/cetak_form_actbud';

$route['app/sponsorship/preview_upload'] = 'IG/User/Sponsorship/preview_upload';
$route['app/sponsorship/preview_upload/upload']['POST'] = 'IG/User/Sponsorship/upload_sponsorship';

$route['app/sponsorship/status_pencairan'] = 'IG/User/StatusPencairanSponsorship';
$route['app/sponsorship/status_pencairan/(:num)'] = 'IG/User/StatusPencairanSponsorship';
$route['app/sponsorship/status_pencairan/v_detail/(:any)/actbud/(:any)'] = 'IG/User/PencairanSponsorship/v_detail_actbud';

// KREDIT SALDO
$route['app/kredit_saldo'] = 'IG/User/KreditSaldo';
$route['app/kredit_saldo/buat_kredit'] = 'IG/User/KreditSaldo/buat_kredit';
$route['app/kredit_saldo/buat_kredit/save']['POST'] = 'IG/User/KreditSaldo/submit_kredit';
$route['app/kredit_saldo/batalkan_kredit']['POST'] = 'IG/User/KreditSaldo/batalkan_kredit';
$route['app/kredit_saldo/finalisasi_kredit']['POST'] = 'IG/User/KreditSaldo/finalisasi_kredit';
$route['app/kredit_saldo/preview_upload'] = 'IG/User/KreditSaldo/preview_upload';
$route['app/kredit_saldo/preview_upload/upload']['POST'] = 'IG/User/KreditSaldo/upload_kredit';

// HIBAH DAN SPONSORSHIP
$route['app/set_pic/(:any)/save']['POST'] = 'IG/User/PIC/set_pic';

// PROFIL
$route['app/profil_saya'] = 'IG/User/Profil/profil_saya';

// NOTIFIKASI
$route['app/detail-pemberitahuan/(:num)'] = 'IG/User/Pemberitahuan/detail_pemberitahuan';
$route['app/data-pemberitahuan'] = 'IG/User/Pemberitahuan';
$route['app/data-pemberitahuan/(:num)'] = 'IG/User/Pemberitahuan';
$route['app/hapus-semua-pemberitahuan'] = 'IG/User/Pemberitahuan/hapus_semua_pemberitahuan';
$route['app/set-sudah-dibaca-semua-pemberitahuan'] = 'IG/User/Pemberitahuan/set_sudah_dibaca_semua_pemberitahuan';
$route['app/data-pemberitahuan/hapus_data/(:any)'] = 'IG/User/Pemberitahuan/hapus_pemberitahuan';

// Realisasi Anggaran
$route['app/realisasi_anggaran'] = 'IG/User/Realisasi_Anggaran';
$route['app/realisasi_anggaran/(:num)'] = 'IG/User/Realisasi_Anggaran';
// uri segment 4: id actbud, 5: id uraian
$route['app/realisasi_anggaran/actbud/(:any)/(:any)'] = 'IG/User/Realisasi_Anggaran/v_detail/$1';
$route['app/realisasi_anggaran/actbud/(:any)/(:any)/buat_catatan']['POST'] = 'IG/User/Realisasi_Anggaran/buat_catatan';
$route['app/realisasi_anggaran/actbud/(:any)/(:any)/buat_catatan_keu']['POST'] = 'IG/User/Realisasi_Anggaran/buat_catatan_keu';
$route['app/realisasi_anggaran/actbud/(:any)/(:any)/buat_realisasi_anggaran']['POST'] = 'IG/User/Realisasi_Anggaran/buat_realisasi_anggaran';
$route['app/realisasi_anggaran/actbud/(:any)/(:any)/unggah_bukti']['POST'] = 'IG/User/Realisasi_Anggaran/unggah_bukti';
$route['app/realisasi_anggaran/actbud/(:any)/(:any)/unggah_bukti_keu']['POST'] = 'IG/User/Realisasi_Anggaran/unggah_bukti_keu';
$route['app/realisasi_anggaran/actbud/(:any)/(:any)/finalisasi-penyesuaian-anggaran']['POST'] = 'IG/User/Realisasi_Anggaran/finalisasi_anggaran';
$route['app/realisasi_anggaran/actbud/(:any)/(:any)/hapus_lampiran_pic']['POST'] = 'IG/User/Realisasi_Anggaran/hapus_lampiran_pic';
$route['app/realisasi_anggaran/actbud/(:any)/(:any)/hapus_lampiran_keu']['POST'] = 'IG/User/Realisasi_Anggaran/hapus_lampiran_keu';
$route['app/realisasi_anggaran/actbud/(:any)/(:any)/hapus_catatan_pic'] = 'IG/User/Realisasi_Anggaran/hapus_catatan_pic';
$route['app/realisasi_anggaran/actbud/(:any)/(:any)/hapus_catatan_keu'] = 'IG/User/Realisasi_Anggaran/hapus_catatan_keu';

$route['app/realisasi_anggaran/actbud/(:any)/(:any)/buat_pesan']['POST'] = 'IG/User/Realisasi_Anggaran/buat_pesan';
$route['app/realisasi_anggaran/actbud/(:any)/(:any)/hapus-pesan']['POST'] = 'IG/User/Realisasi_Anggaran/hapus_pesan';

$route['app/logout']['POST'] = 'IG/User/Logout/logout';