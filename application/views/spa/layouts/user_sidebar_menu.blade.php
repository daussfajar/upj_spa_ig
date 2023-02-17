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
                                        
            </ul>                            
        </div>
    </div>
    <!-- Sidebar -left -->
</div>