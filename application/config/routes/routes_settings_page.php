<?php

defined('BASEPATH') OR exit('No direct script access allowed');

$route['app/pengaturan/umum'] = 'Admin/Settings/pengaturan_umum';
$route['app/pengaturan/login_logs'] = 'Admin/Settings/login_logs';
$route['app/pengaturan/login_logs/(:num)'] = 'Admin/Settings/login_logs/$1';

?>