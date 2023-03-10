<?php     
    function menu_active($uri, $uri_check, $class) {   
        $CI =& get_instance();     
        if($CI->uri->segment($uri) == $uri_check){
            return $class;
        }
    }
    $jabatan = $_SESSION['user_sessions']['kode_jabatan'];
    $unit = $_SESSION['user_sessions']['nama_unit'];
    $kode_unit = $_SESSION['user_sessions']['kode_unit'];
    $uri3 = $CI->uri->segment(3);
    $uri4 = $CI->uri->segment(4);
    $uri5 = $CI->uri->segment(5);
?>

<div class="left-side-menu" >
    <div class="slimscroll-menu">        
        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul class="metismenu" id="side-menu">

                <li class="menu-title">Navigation</li>

                <li class="<?= menu_active(3, 'dashboard', 'mm-active') ?>">
                    <a href="<?php echo e(base_url('app/sim-spa/dashboard')); ?>" class="waves-effect waves-light <?= menu_active(2, 'dashboard', 'active') ?>">
                        <i class="mdi mdi-view-dashboard"></i>
                        <span>  Dashboard  </span>
                    </a>
                </li>
                
                <li class="<?= menu_active(3, 'rkat', 'mm-active') ?>">
                    <a href="javascript: void(0);" class="waves-effect waves-light<?= menu_active(3, 'rkat', ' active') ?>">
                        <i class="mdi mdi-folder-outline"></i>
                        <span> RKAT </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <?php if($jabatan == 22 && $kode_unit == 002): ?>
                        <li><a href="javascript:void(0)">Input RKAT</a></li>
                        <?php endif; ?>
                        <?php if($jabatan == 22 || $jabatan == 6): ?>
                        <li <?= ($uri3 == "rkat" && $uri4 == "pic") ? 'class="mm-active"' : ''?>><a href="<?php echo e(base_url('app/sim-spa/rkat/pic/program-kerja')); ?>">Ubah PIC</a></li>
                        <?php endif; ?>
                        <li <?= ($uri3 == "rkat" && $uri4 == "list") ? 'class="mm-active"' : ''?>><a href="<?php echo e(base_url('app/sim-spa/rkat/list/program-kerja')); ?>">List RKAT</a></li>
                    </ul>
                </li>

                <li class="<?= menu_active(3, 'pencairan-rkat', 'mm-active') ?>">
                    <a href="javascript:void(0)" class="waves-effect waves-light<?= menu_active(3, 'pencairan-rkat', ' active') ?>">
                        <i class="mdi mdi-file-document-edit-outline"></i>
                        <span>  Pencairan RKAT  </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li class="<?= ($uri3 == "pencairan-rkat" && ($uri4 == "actbud" || $uri4 == "input-actbud")) ? 'mm-active' : '' ?>">
                            <a href="javascript:void(0)" class="waves-effect waves-light">
                                <span>  Actbud  </span>
                                <span class="menu-arrow"></span>
                            </a>                                  
                            <ul class="nav-second-level" aria-expanded="false">
                                <li class="<?= (($uri3 == "pencairan-rkat" && $uri4 == "input-actbud") || ($uri4 == "actbud" && $uri5 == "input-actbud")) ? 'mm-active' : '' ?>">
                                    <a href="<?php echo e(base_url('app/sim-spa/pencairan-rkat/input-actbud')); ?>" class="">Input Actbud</a>
                                </li>                                
                                <li class="<?= ($uri4 == "actbud" && $uri5 == "status-actbud") ? 'mm-active' : '' ?>">
                                    <a href="<?php echo e(base_url('app/sim-spa/pencairan-rkat/status-actbud')); ?>" class="">Status Actbud</a>
                                </li>
                            </ul>
                        </li>
                        <li class="<?= ($uri3 == "pencairan-rkat" && ($uri4 == "petty-cash" || $uri4 == "input-petty-cash")) ? 'mm-active' : '' ?>">
                            <a href="javascript:void(0)" class="waves-effect waves-light">
                                <span>  Petty Cash  </span>
                                <span class="menu-arrow"></span>
                            </a>                                  
                            <ul class="nav-second-level" aria-expanded="false">
                                <li class="<?= (($uri3 == "pencairan-rkat" && $uri4 == "input-petty-cash") || ($uri4 == "petty-cash" && $uri5 == "input-petty-cash")) ? 'mm-active' : '' ?>">
                                    <a href="<?php echo e(base_url('app/sim-spa/pencairan-rkat/input-petty-cash')); ?>" class="">Input Petty Cash</a>
                                </li>                                
                                <li class="<?= ($uri4 == "petty-cash" && $uri5 == "status-petty-cash") ? 'mm-active' : '' ?>">
                                    <a href="<?php echo e(base_url('app/sim-spa/pencairan-rkat/status-petty-cash')); ?>" class="">Status Petty Cash</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <?php if($jabatan == 0){ ?>
                <li class="">
                    <a href="javascript: void(0);" class="waves-effect waves-light<?= menu_active(3, 'rkat', ' active') ?>">
                        <i class="mdi mdi-folder-open-outline"></i>
                        <span> Approval </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="<?php echo e(base_url('app/sim-spa/approval/')); ?>">Approval Ka.Unit/Prodi</a></li>
                        <!-- level 2 -->
                        <li><a href="javascript:void(0)">Approval Ka. Umum</a></li>
                        <li><a href="javascript:void(0)">Approval Ka.HRD</a></li>
                        <li><a href="javascript:void(0)">Approval Ka.ICT</a></li>
                        <li><a href="javascript:void(0)">Approval Ka.BKAL</a></li>
                        <li><a href="javascript:void(0)">Approval Ka.P2M</a></li>
                        <!-- level 3 -->
                        <li><a href="javascript:void(0)">Approval Ka.Keuangan</a></li> 
                        <!-- level 4 -->
                        <li><a href="javascript:void(0)">Approval Dekan</a></li>
                        <li><a href="javascript:void(0)">Approval Wakil Rektor 1</a></li>
                        <li><a href="javascript:void(0)">Approval Wakil Rektor 2</a></li>
                        <li><a href="javascript:void(0)">Approval  Rektor</a></li>
                        <li><a href="javascript:void(0)">Approval  Presiden</a></li>
                    </ul>
                </li>
                <?php } ?>
                <li class="<?= menu_active(4, 'kepala-unit', 'mm-active') ?>">
                    <a href="<?php echo e(base_url('app/sim-spa/approval/kepala-unit')); ?>" class="waves-effect waves-light <?= menu_active(4, 'kepala-unit', 'active') ?>">
                        <i class="mdi mdi-folder-outline"></i>
                        <span>Approval Kepala Unit</span>
                    </a>
                </li>
                <?php if(($jabatan == 6 || $jabatan == 22) && ($kode_unit == 006 || $kode_unit == 004 || $kode_unit == 003 || $kode_unit == 013 || $kode_unit == 016)): ?>
                <li class="<?= menu_active(4, 'pre-approval', 'mm-active') ?>">
                    <a href="<?php echo e(base_url('app/sim-spa/approval/pre-approval')); ?>" class="waves-effect waves-light <?= menu_active(4, 'pre-approval', 'active') ?>">
                        <i class="mdi mdi-folder-open-outline"></i>
                        <span>Approval Terkait <?= $unit ?></span>
                    </a>
                </li>
                <li class="<?= menu_active(3, 'history-approval', 'mm-active') ?>">
                    <a href="<?php echo e(base_url('app/sim-spa/history-approval')); ?>" class="waves-effect waves-light <?= menu_active(3, 'history-approval', 'active') ?>">
                        <i class="mdi mdi-history"></i>
                        <span>History Approval</span>
                    </a>
                </li>
                <?php endif; ?>
                <?php if($jabatan == 22 && $kode_unit == 002): ?>
                <li class="<?= menu_active(4, 'keuangan', 'mm-active') ?>">
                    <a href="<?php echo e(base_url('app/sim-spa/approval/keuangan')); ?>" class="waves-effect waves-light <?= menu_active(4, 'keuangan', 'active') ?>">
                        <i class="mdi mdi-folder-outline"></i>
                        <span>  Approval Terkait Anggaran  </span>
                    </a>
                </li>
                <li class="">
                    <a href="<?php echo e(base_url('app/sim-spa/anggaran/pengalihan')); ?>" class="waves-effect waves-light">
                        <i class="mdi mdi-cash-plus"></i>
                        <span>  Pengalihan Anggaran  </span>
                    </a>
                </li>
                <li class="">
                    <a href="<?php echo e(base_url('app/sim-spa/anggaran/realisasi')); ?>" class="waves-effect waves-light">
                        <i class="mdi mdi-cash-register"></i>
                        <span>  Realisasi Anggaran  </span>
                    </a>
                </li>
                <li class="">
                    <a href="<?php echo e(base_url('app/sim-spa/admin/rkat/laporan-pencairan')); ?>" class="waves-effect waves-light">
                        <i class="mdi mdi-file-document-outline"></i>
                        <span>  Laporan Pencairan RKAT  </span>
                    </a>
                </li>
                <?php endif; ?>
            </ul>                            
        </div>
    </div>
    <!-- Sidebar -left -->
</div><?php /**PATH C:\xampp_php_7\htdocs\hibah_upj\application\views/spa/layouts/user_sidebar_menu.blade.php ENDPATH**/ ?>