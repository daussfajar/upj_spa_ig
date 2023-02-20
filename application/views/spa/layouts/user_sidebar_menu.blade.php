<?php     
    function menu_active($uri, $uri_check, $class) {   
        $CI =& get_instance();     
        if($CI->uri->segment($uri) == $uri_check){
            return $class;
        }
    }
    $jabatan = $_SESSION['user_sessions']['kode_jabatan'];
    $unit = $_SESSION['user_sessions']['nama_unit'];
?>

<div class="left-side-menu" >
    <div class="slimscroll-menu">        
        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul class="metismenu" id="side-menu">

                <li class="menu-title">Navigation</li>

                <li class="<?= menu_active(3, 'dashboard', 'mm-active') ?>">
                    <a href="{{ base_url('app/sim-spa/dashboard') }}" class="waves-effect waves-light <?= menu_active(2, 'dashboard', 'active') ?>">
                        <i class="mdi mdi-view-dashboard"></i>                                    
                        <span>  Dashboard  </span>
                    </a>                              
                </li>                
                
                <li>
                    <a href="javascript: void(0);" class="waves-effect waves-light">
                        <i class="mdi mdi-folder-outline"></i>
                        <span> RKAT </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="javascript:void(0)">List RKAT</a></li>
                    </ul>
                </li>

                <li class="">
                    <a href="javascript:void(0)" class="waves-effect waves-light">
                        <i class="mdi mdi-file-document-edit-outline"></i>
                        <span>  Pencairan RKAT  </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li class="">
                            <a href="javascript:void(0)" class="waves-effect waves-light">
                                <span>  Actbud  </span>
                                <span class="menu-arrow"></span>
                            </a>                                  
                            <ul class="nav-second-level" aria-expanded="false">
                                <li class="">
                                    <a href="javascript:void(0)" class="">Input Actbud</a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0)" class="">View Actbud</a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0)" class="">Status Actbud</a>
                                </li>
                            </ul>
                        </li>
                        <li class="">
                            <a href="javascript:void(0)" class="waves-effect waves-light">
                                <span>  Petty Cash  </span>
                                <span class="menu-arrow"></span>
                            </a>                                  
                            <ul class="nav-second-level" aria-expanded="false">
                                <li class="">
                                    <a href="javascript:void(0)" class="">Input Petty Cash</a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0)" class="">View Petty Cash</a>
                                </li>
                                <li class="">
                                    <a href="javascript:void(0)" class="">Status Petty Cash</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>                            
        </div>
    </div>
    <!-- Sidebar -left -->
</div>