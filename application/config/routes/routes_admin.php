<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

$route['app/master-data/karyawan'] = 'Admin/MST_Karyawan';
$route['app/master-data/karyawan/(:any)/set_status'] = 'Admin/MST_Karyawan/set_status';
$route['app/master-data/karyawan/edit/(:any)']['POST'] = 'Admin/MST_Karyawan/edit_karyawan';
$route['app/master-data/karyawan/tambah_karyawan']['POST'] = 'Admin/MST_Karyawan/tambah_karyawan';
$route['app/master-data/karyawan/hapus/(:any)']['POST'] = 'Admin/MST_Karyawan/hapus_karyawan';
$route['app/master-data/karyawan/ubahpass']['POST'] = 'Admin/MST_Karyawan/ubahpass_karyawan';

$route['app/admin/system/backup_db'] = 'Maintenance/Backups/backup_db';

?>