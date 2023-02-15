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

<div class="left-side-menu">
    <div class="slimscroll-menu">        
        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul class="metismenu" id="side-menu">

                <li class="menu-title">Navigation</li>

                <li class="<?= menu_active(3, 'dashboard', 'mm-active') ?>">
                    <a href="{{ base_url('app/sim-ig/dashboard') }}" class="waves-effect waves-light <?= menu_active(3, 'dashboard', 'active') ?>">
                        <i class="mdi mdi-view-dashboard"></i>                                    
                        <span>  Dashboard  </span>
                    </a>                              
                </li>                
                
                <li class="<?= menu_active(3, 'hibah', 'mm-active') ?><?= menu_active(3, 'sponsorship', 'mm-active') ?>">
                    <a href="javascript:void(0)" class="waves-effect waves-light <?= menu_active(3, 'hibah', 'active') ?><?= menu_active(3, 'sponsorship', 'active') ?>">
                        <i class="mdi mdi-folder-outline"></i>
                        <span>  IG  </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li class="<?= menu_active(3, 'hibah', 'mm-active') ?>">
                            <a href="javascript:void(0)" class="waves-effect waves-light <?= menu_active(3, 'hibah', 'active') ?>">                                
                                <span>  Hibah  </span>
                                <span class="menu-arrow"></span>
                            </a>                                  
                            <ul class="nav-second-level" aria-expanded="false">
                                @if ($unit == 'Bagian Keuangan' || $jabatan == 0 || $jabatan == 22 || $jabatan == 6)
                                    <li class="<?= $CI->uri->segment(2) == 'hibah' && $CI->uri->segment(3) == 'buat_kegiatan' ? 'mm-active' : '' ?>">
                                        <a href="{{ base_url('app/sim-ig/hibah') }}" class="<?= menu_active(4, 'buat_kegiatan', 'active') ?>">Kegiatan</a>
                                    </li>
                                @endif                       
        
                                <li class="<?= $CI->uri->segment(2) == 'hibah' && $CI->uri->segment(3) == 'pencairan' ? 'mm-active' : '' ?>">
                                    <a href="{{ base_url('app/sim-ig/hibah/pencairan') }}" class="<?= menu_active(4, 'pencairan', 'active') ?>">                                        
                                        <span>Pencairan</span>
                                    </a>
                                </li>                                
                                <li class="<?= $CI->uri->segment(2) == 'hibah' && $CI->uri->segment(3) == 'status_pencairan' ? 'mm-active' : '' ?>">
                                    <a href="{{ base_url('app/sim-ig/hibah/status_pencairan') }}" class="<?= menu_active(4, 'status_pencairan', 'active') ?>">
                                        <!--<span class="badge badge-info badge-pill float-right">2</span>-->
                                        <span>Status Pencairan</span>
                                    </a>
                                </li>
                            </ul>      
                        </li>

                        <li class="<?= menu_active(3, 'sponsorship', 'mm-active') ?>">
                            <a href="javascript:void(0)" class="waves-effect waves-light <?= menu_active(3, 'sponsorship', 'active') ?>">                                
                                <span>  Sponsorship  </span>
                                <span class="menu-arrow"></span>
                            </a>                                  
                            <ul class="nav-second-level" aria-expanded="false">
                                @if ($unit == 'Bagian Keuangan' || $jabatan == 0)
                                <li class="<?= $CI->uri->segment(2) == 'sponsorship' && $CI->uri->segment(3) == 'buat_kegiatan' ? 'mm-active' : '' ?>">
                                    <a href="{{ base_url('app/sim-ig/sponsorship') }}" class="<?= menu_active(4, 'buat_kegiatan', 'active') ?>">Kegiatan</a>
                                </li>
                                @endif
                                <li class="<?= $CI->uri->segment(2) == 'sponsorship' && $CI->uri->segment(3) == 'pencairan' ? 'mm-active' : '' ?>">
                                    <a href="{{ base_url('app/sim-ig/sponsorship/pencairan') }}" class="">Pencairan</a>
                                </li>
                                <li class="<?= $CI->uri->segment(2) == 'sponsorship' && $CI->uri->segment(3) == 'status_pencairan' ? 'mm-active' : '' ?>">
                                    <a href="{{ base_url('app/sim-ig/sponsorship/status_pencairan') }}" class="<?= menu_active(4, 'status_pencairan', 'active') ?>">Status Pencairan</a>
                                </li>
                            </ul>      
                        </li>

                        @if ($unit == 'Bagian Keuangan' || $jabatan == 0 || $jabatan == 22 || $jabatan == 6)
                            <li class="<?= menu_active(3, 'kredit_saldo', 'mm-active') ?>">
                                <a href="{{ base_url('app/sim-ig/kredit_saldo') }}" class="waves-effect waves-light <?= menu_active(3, 'kredit_saldo', 'active') ?>"> 
                                    <span>  Debet/Kredit Saldo  </span>                                
                                </a>
                            </li>
                        @endif

                        <li class="<?= menu_active(3, 'realisasi_anggaran', 'mm-active') ?>">
                            <a href="{{ base_url('app/sim-ig/realisasi_anggaran') }}" class="waves-effect waves-light <?= menu_active(3, 'realisasi_anggaran', 'active') ?>">                                
                                <span>  Realisasi Anggaran  </span>
                            </a>                              
                        </li>
                    </ul>
                </li>                                

                @if ($jabatan != 7)
                    <li class="<?= menu_active(3, 'approval', 'mm-active') ?>">
                        <a href="{{ base_url('app/sim-ig/approval') }}" class="waves-effect waves-light <?= menu_active(3, 'approval', 'active') ?>">
                            <i class="mdi mdi-clipboard-file-outline"></i>                                    
                            <span>  Approval  </span>
                        </a>                              
                    </li>
                    <li class="<?= menu_active(3, 'riwayat_approval', 'mm-active') ?>">
                        <a href="{{ base_url('app/sim-ig/riwayat_approval') }}" class="waves-effect waves-light <?= menu_active(3, 'riwayat_approval', 'active') ?>">
                            <i class="mdi mdi-history"></i>                                    
                            <span>  Riwayat Approval  </span>
                        </a>                              
                    </li>
                @endif

                @if ($jabatan == 0)
                    <li class="<?= menu_active(3, 'master-data', 'mm-active') ?>">
                        <a href="javascript:void(0)" class="waves-effect waves-light <?= menu_active(3, 'master-data', 'active') ?>">
                            <i class="mdi mdi-folder-open"></i>
                            <span>  Master Data  </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li>
                                <a href="{{ base_url('app/sim-ig/master-data/karyawan') }}" class="waves-effect waves-light <?= menu_active(4, 'karyawan', 'active') ?>">
                                    <span>  Karyawan  </span>                                 
                                </a>
                            </li>
                            <li>
                                <a href="{{ base_url('app/sim-ig/master-data/unit') }}" class="waves-effect waves-light <?= menu_active(4, 'unit', 'active') ?>">
                                    <span>  Unit/Bagian  </span>                                 
                                </a>
                            </li>
                            <li>
                                <a href="{{ base_url('app/sim-ig/master-data/jabatan') }}" class="waves-effect waves-light <?= menu_active(4, 'jabatan', 'active') ?>">
                                    <span>  Jabatan  </span>                                 
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="<?= menu_active(3, 'pengaturan', 'mm-active') ?>">
                        <a href="javascript:void(0)" class="waves-effect waves-light <?= menu_active(3, 'pengaturan', 'active') ?>">
                            <i class="mdi mdi-cogs"></i>
                            <span>  Pengaturan  </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li>
                                <a href="{{ base_url('app/sim-ig/pengaturan/umum') }}" class="waves-effect waves-light <?= menu_active(4, 'umum', 'active') ?>">
                                    <span>  Umum  </span>                                 
                                </a>
                            </li>
                            <li>
                                <a href="{{ base_url('app/sim-ig/pengaturan/login_logs') }}" class="waves-effect waves-light <?= menu_active(4, 'login_logs', 'active') ?>">
                                    <span>  Login Logs  </span>                                 
                                </a>
                            </li>
                            <li>
                                <a href="{{ base_url('app/sim-ig/pengaturan/banned_ip') }}" class="waves-effect waves-light <?= menu_active(4, 'banned_ip', 'active') ?>">
                                    <span>  Banned IP  </span>                                 
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>                            
        </div>
    </div>
    <!-- Sidebar -left -->
</div>