<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'Auth';
$route['404_override'] = 'Errors/error_404';
$route['translate_uri_dashes'] = FALSE;

$route['lupa-password'] = 'User/ForgotPassword';

include_once 'routes/routes_user.php';
include_once 'routes/routes_approval.php';
include_once 'routes/routes_settings_page.php';
include_once 'routes/routes_admin.php';
