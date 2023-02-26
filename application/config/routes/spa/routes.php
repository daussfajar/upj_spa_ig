<?php

defined('BASEPATH') or exit('No direct script access allowed');

$route['app/sim-spa/dashboard'] = 'SPA/Dashboard';
$route['app/sim-spa/actbud'] = 'SPA/Actbud';

// PENCAIRAN RKAT
$route['app/sim-spa/pencairan-rkat/input-actbud'] = 'SPA/PencairanRKAT/v_input_actbud';
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
