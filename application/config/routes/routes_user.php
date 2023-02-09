<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
 routes_user.php
 @Auth Fajar Firdaus <daussfajar28@gmail.com> 
*/

$route['auth/login']['POST'] = 'Auth/verify';

$route['app/dashboard'] = 'User/Dashboard';
$route['app/hibah'] = 'User/Hibah';

$route['app/hibah/(:num)'] = 'User/Hibah';
$route['app/hibah/buat_kegiatan'] = 'User/Hibah/v_buat_kegiatan';
$route['app/hibah/buat_kegiatan/submit']['POST'] = 'User/Hibah/submit_buat_kegiatan';
$route['app/hibah/v_detail/(:any)'] = 'User/Hibah/v_detail_hibah';
$route['app/hibah/v_detail/(:any)/edit_hibah']['POST'] = 'User/Hibah/edit_hibah';
$route['app/hibah/v_detail/(:any)/batalkan_kegiatan']['POST'] = 'User/Hibah/batalkan_kegiatan';
$route['app/hibah/v_detail/(:any)/finalisasi']['POST'] = 'User/Hibah/finalisasi';

$route['app/hibah/pencairan/detail_hibah/(:any)'] = 'User/PencairanHibah/detail_hibah';
$route['app/hibah/pencairan'] = 'User/PencairanHibah';
$route['app/hibah/pencairan/(:num)'] = 'User/PencairanHibah';
//$route['app/hibah/pencairan/v_detail/(:any)'] = 'User/PencairanHibah/v_detail';
$route['app/hibah/pencairan/v_detail/(:any)/buat_pencairan'] = 'User/PencairanHibah/buat_pencairan';
$route['app/hibah/pencairan/v_detail/(:any)/buat_pencairan/create']['POST'] = 'User/PencairanHibah/create_pencairan';

$route['app/hibah/pencairan/v_detail/(:any)/actbud/(:any)'] = 'User/PencairanHibah/v_detail_actbud';
$route['app/hibah/pencairan/v_detail/(:any)/actbud/(:any)/ubah-actbud']['POST'] = 'User/PencairanHibah/ubah_actbud';
$route['app/hibah/pencairan/v_detail/(:any)/actbud/(:any)/batalkan-actbud']['POST'] = 'User/PencairanHibah/batalkan_actbud';
$route['app/hibah/pencairan/v_detail/(:any)/actbud/(:any)/hapus-pesan']['POST'] = 'User/PencairanHibah/hapus_pesan';
$route['app/hibah/pencairan/v_detail/(:any)/actbud/(:any)/upload-dokumen-pendukung']['POST'] = 'User/PencairanHibah/upload_dokumen_pendukung';
$route['app/hibah/pencairan/v_detail/(:any)/actbud/(:any)/hapus-dokumen-pendukung']['POST'] = 'User/PencairanHibah/hapus_dokumen_pendukung';
$route['app/hibah/pencairan/v_detail/(:any)/actbud/(:any)/buat-rincian-kegiatan']['POST'] = 'User/PencairanHibah/buat_rincian_kegiatan';
$route['app/hibah/pencairan/v_detail/(:any)/actbud/(:any)/hapus-rincian-kegiatan']['POST'] = 'User/PencairanHibah/hapus_rincian_kegiatan';
$route['app/hibah/pencairan/v_detail/(:any)/actbud/(:any)/submit']['POST'] = 'User/PencairanHibah/submit_actbud/$1/$2';

$route['app/hibah/status_pencairan/v_detail/(:any)/actbud/(:any)'] = 'User/PencairanHibah/v_detail_actbud';
$route['app/realisasi_anggaran/history/v_detail/(:any)/actbud/(:any)'] = 'User/PencairanHibah/v_detail_actbud';

$route['app/hibah/pencairan/v_detail/(:any)/actbud/(:any)/buat_pesan']['POST'] = 'User/PencairanHibah/buat_pesan';
$route['app/hibah/pencairan/v_detail/(:any)/actbud/(:any)/cetak_form_actbud'] = 'User/PencairanHibah/cetak_form_actbud';

$route['app/actbud-disetujui'] = 'User/Actbud/v_actbud_disetujui';
$route['app/actbud-ditolak'] = 'User/Actbud/v_actbud_ditolak';

$route['app/hibah/preview_upload'] = 'User/Hibah/preview_upload';
$route['app/hibah/preview_upload/upload']['POST'] = 'User/Hibah/upload_hibah';

$route['app/hibah/status_pencairan'] = 'User/StatusPencairanHibah';
$route['app/hibah/status_pencairan/(:num)'] = 'User/StatusPencairanHibah';
// HISTORY APPROVAL
$route['app/riwayat_approval'] = 'User/HistoryApproval';
$route['app/riwayat_approval/(:num)'] = 'User/HistoryApproval';

// SPONSORSHIP
$route['app/sponsorship/pencairan/detail_sponsorship/(:any)'] = 'User/PencairanSponsorship/detail_sponsorship';
$route['app/sponsorship'] = 'User/Sponsorship';
$route['app/sponsorship/(:num)'] = 'User/Sponsorship';
$route['app/sponsorship/buat_kegiatan'] = 'User/Sponsorship/v_buat_kegiatan';
$route['app/sponsorship/buat_kegiatan/submit']['POST'] = 'User/Sponsorship/submit_buat_kegiatan';

$route['app/sponsorship/v_detail/(:any)'] = 'User/Sponsorship/v_detail_sponsorship';
$route['app/sponsorship/v_detail/(:any)/edit_sponsorship']['POST'] = 'User/Sponsorship/edit_sponsorship';
$route['app/sponsorship/v_detail/(:any)/batalkan_kegiatan']['POST'] = 'User/Sponsorship/batalkan_kegiatan';
$route['app/sponsorship/v_detail/(:any)/finalisasi']['POST'] = 'User/Sponsorship/finalisasi';

$route['app/sponsorship/pencairan'] = 'User/PencairanSponsorship';
$route['app/sponsorship/pencairan/(:num)'] = 'User/PencairanSponsorship';
//$route['app/sponsorship/pencairan/v_detail/(:any)'] = 'User/PencairanSponsorship/v_detail';
$route['app/sponsorship/pencairan/v_detail/(:any)/buat_pencairan'] = 'User/PencairanSponsorship/buat_pencairan';
$route['app/sponsorship/pencairan/v_detail/(:any)/buat_pencairan/create']['POST'] = 'User/PencairanSponsorship/create_pencairan';

$route['app/sponsorship/pencairan/v_detail/(:any)/actbud/(:any)'] = 'User/PencairanSponsorship/v_detail_actbud';
$route['app/sponsorship/pencairan/v_detail/(:any)/actbud/(:any)/ubah-actbud']['POST'] = 'User/PencairanSponsorship/ubah_actbud';
$route['app/sponsorship/pencairan/v_detail/(:any)/actbud/(:any)/batalkan-actbud']['POST'] = 'User/PencairanSponsorship/batalkan_actbud';
$route['app/sponsorship/pencairan/v_detail/(:any)/actbud/(:any)/hapus-pesan']['POST'] = 'User/PencairanSponsorship/hapus_pesan';
$route['app/sponsorship/pencairan/v_detail/(:any)/actbud/(:any)/upload-dokumen-pendukung']['POST'] = 'User/PencairanSponsorship/upload_dokumen_pendukung';
$route['app/sponsorship/pencairan/v_detail/(:any)/actbud/(:any)/hapus-dokumen-pendukung']['POST'] = 'User/PencairanSponsorship/hapus_dokumen_pendukung';
$route['app/sponsorship/pencairan/v_detail/(:any)/actbud/(:any)/buat-rincian-kegiatan']['POST'] = 'User/PencairanSponsorship/buat_rincian_kegiatan';
$route['app/sponsorship/pencairan/v_detail/(:any)/actbud/(:any)/hapus-rincian-kegiatan']['POST'] = 'User/PencairanSponsorship/hapus_rincian_kegiatan';
$route['app/sponsorship/pencairan/v_detail/(:any)/actbud/(:any)/submit']['POST'] = 'User/PencairanSponsorship/submit_actbud';

$route['app/sponsorship/pencairan/v_detail/(:any)/actbud/(:any)/buat_pesan']['POST'] = 'User/PencairanSponsorship/buat_pesan';
$route['app/sponsorship/pencairan/v_detail/(:any)/actbud/(:any)/cetak_form_actbud'] = 'User/PencairanSponsorship/cetak_form_actbud';

$route['app/sponsorship/preview_upload'] = 'User/Sponsorship/preview_upload';
$route['app/sponsorship/preview_upload/upload']['POST'] = 'User/Sponsorship/upload_sponsorship';

$route['app/sponsorship/status_pencairan'] = 'User/StatusPencairanSponsorship';
$route['app/sponsorship/status_pencairan/(:num)'] = 'User/StatusPencairanSponsorship';
$route['app/sponsorship/status_pencairan/v_detail/(:any)/actbud/(:any)'] = 'User/PencairanSponsorship/v_detail_actbud';

// KREDIT SALDO
$route['app/kredit_saldo'] = 'User/KreditSaldo';
$route['app/kredit_saldo/buat_kredit'] = 'User/KreditSaldo/buat_kredit';
$route['app/kredit_saldo/buat_kredit/save']['POST'] = 'User/KreditSaldo/submit_kredit';
$route['app/kredit_saldo/batalkan_kredit']['POST'] = 'User/KreditSaldo/batalkan_kredit';
$route['app/kredit_saldo/finalisasi_kredit']['POST'] = 'User/KreditSaldo/finalisasi_kredit';
$route['app/kredit_saldo/preview_upload'] = 'User/KreditSaldo/preview_upload';
$route['app/kredit_saldo/preview_upload/upload']['POST'] = 'User/KreditSaldo/upload_kredit';

// HIBAH DAN SPONSORSHIP
$route['app/set_pic/(:any)/save']['POST'] = 'User/PIC/set_pic';

// PROFIL
$route['app/profil_saya'] = 'User/Profil/profil_saya';

// NOTIFIKASI
$route['app/detail-pemberitahuan/(:num)'] = 'User/Pemberitahuan/detail_pemberitahuan';
$route['app/data-pemberitahuan'] = 'User/Pemberitahuan';
$route['app/data-pemberitahuan/(:num)'] = 'User/Pemberitahuan';
$route['app/hapus-semua-pemberitahuan'] = 'User/Pemberitahuan/hapus_semua_pemberitahuan';
$route['app/set-sudah-dibaca-semua-pemberitahuan'] = 'User/Pemberitahuan/set_sudah_dibaca_semua_pemberitahuan';
$route['app/data-pemberitahuan/hapus_data/(:any)'] = 'User/Pemberitahuan/hapus_pemberitahuan';

// Realisasi Anggaran
$route['app/realisasi_anggaran'] = 'User/Realisasi_Anggaran';
$route['app/realisasi_anggaran/(:num)'] = 'User/Realisasi_Anggaran';
// uri segment 4: id actbud, 5: id uraian
$route['app/realisasi_anggaran/actbud/(:any)/(:any)'] = 'User/Realisasi_Anggaran/v_detail/$1';
$route['app/realisasi_anggaran/actbud/(:any)/(:any)/buat_catatan']['POST'] = 'User/Realisasi_Anggaran/buat_catatan';
$route['app/realisasi_anggaran/actbud/(:any)/(:any)/buat_catatan_keu']['POST'] = 'User/Realisasi_Anggaran/buat_catatan_keu';
$route['app/realisasi_anggaran/actbud/(:any)/(:any)/buat_realisasi_anggaran']['POST'] = 'User/Realisasi_Anggaran/buat_realisasi_anggaran';
$route['app/realisasi_anggaran/actbud/(:any)/(:any)/unggah_bukti']['POST'] = 'User/Realisasi_Anggaran/unggah_bukti';
$route['app/realisasi_anggaran/actbud/(:any)/(:any)/unggah_bukti_keu']['POST'] = 'User/Realisasi_Anggaran/unggah_bukti_keu';
$route['app/realisasi_anggaran/actbud/(:any)/(:any)/finalisasi-penyesuaian-anggaran']['POST'] = 'User/Realisasi_Anggaran/finalisasi_anggaran';
$route['app/realisasi_anggaran/actbud/(:any)/(:any)/hapus_lampiran_pic']['POST'] = 'User/Realisasi_Anggaran/hapus_lampiran_pic';
$route['app/realisasi_anggaran/actbud/(:any)/(:any)/hapus_lampiran_keu']['POST'] = 'User/Realisasi_Anggaran/hapus_lampiran_keu';
$route['app/realisasi_anggaran/actbud/(:any)/(:any)/hapus_catatan_pic'] = 'User/Realisasi_Anggaran/hapus_catatan_pic';
$route['app/realisasi_anggaran/actbud/(:any)/(:any)/hapus_catatan_keu'] = 'User/Realisasi_Anggaran/hapus_catatan_keu';

$route['app/realisasi_anggaran/actbud/(:any)/(:any)/buat_pesan']['POST'] = 'User/Realisasi_Anggaran/buat_pesan';
$route['app/realisasi_anggaran/actbud/(:any)/(:any)/hapus-pesan']['POST'] = 'User/Realisasi_Anggaran/hapus_pesan';

$route['app/logout']['POST'] = 'User/Logout/logout';
?>