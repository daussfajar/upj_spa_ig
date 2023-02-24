<?php

defined('BASEPATH') or exit('No direct script access allowed');

$route['app/sim-spa/dashboard'] = 'SPA/Dashboard';

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

?>