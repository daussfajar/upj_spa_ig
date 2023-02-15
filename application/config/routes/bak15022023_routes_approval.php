<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
 routes_approval.php
 @Auth Fajar Firdaus <daussfajar28@gmail.com> 
 */

$route['app/approval'] = 'User/Approval';
$route['app/approval/(:num)'] = 'User/Approval';
$route['app/approval/v_detail/(:any)'] = 'User/Approval/v_detail';
$route['app/approval/v_detail/(:any)/buat_pesan']['POST'] = 'User/Approval/buat_pesan';
$route['app/approval/v_detail/(:any)/hapus_pesan']['POST'] = 'User/Approval/hapus_pesan';
$route['app/approval/v_detail/(:any)/buat_catatan_wr_1']['POST'] = 'User/Approval/buat_catatan_wr_1';
$route['app/approval/v_detail/(:any)/buat_catatan_wr_2']['POST'] = 'User/Approval/buat_catatan_wr_2';
$route['app/approval/v_detail/(:any)/submit_actbud']['POST'] = 'User/Approval/submit_actbud';

$route['app/riwayat_approval/v_detail/(:any)'] = 'User/Approval/v_detail';
?>