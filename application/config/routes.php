<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'Auth';
$route['404_override'] = 'Errors/error_404';
$route['translate_uri_dashes'] = FALSE;

$route['auth/login']['POST'] = 'Auth/verify';
$route['lupa-password'] = 'ForgotPassword';
$route['app/logout']['POST'] = 'Logout/logout';

$route['app/menu'] = 'Gate/Menu';

include_once 'routes/ig/routes.php';
include_once 'routes/spa/routes.php';
