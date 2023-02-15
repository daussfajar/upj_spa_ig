<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title><?php echo e(APP_NAME); ?> | <?php echo $__env->yieldContent('title'); ?></title>    
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo e(base_url('assets/images/favicon')); ?>/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo e(base_url('assets/images/favicon')); ?>/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo e(base_url('assets/images/favicon')); ?>/favicon-16x16.png">
    <link rel="manifest" href="<?php echo e(base_url('assets/images/favicon')); ?>/site.webmanifest">
    <link rel="mask-icon" href="<?php echo e(base_url('assets/images/favicon')); ?>/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">    

    <!-- CSS -->
    <link rel="stylesheet" href="<?php echo e(base_url('assets/css/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(base_url('assets/css/icons.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(base_url('assets/css/app.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(base_url('assets/css/toastr.min.css')); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/6.6.96/css/materialdesignicons.min.css">
    <?php echo $__env->yieldContent('css'); ?>
    <style>
        .left-side-menu-light .navbar-custom .topnav-menu .nav-link {
            padding: 0 15px;
            color: rgba(255,255,255,1);
        }        
    </style>
</head>
<body class="left-side-menu-light">
    <!-- Begin page -->
    <div id="wrapper">
        
        <!-- Topbar Start -->
        <div class="navbar-custom">
            <ul class="list-unstyled topnav-menu float-right mb-0">

                <?php echo $__env->make('layouts.user_notification', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>                

                <li class="dropdown notification-list">
                    <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <img src="<?php echo e(base_url('assets/images/logo/logo.png')); ?>" alt="user-image" class="rounded-circle">
                        <span class="d-none d-sm-inline-block ml-1" style="font-weight: bold;"><?php echo e(strtoupper($CI->session->userdata('user_sessions')['nama_lengkap'])); ?></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right profile-dropdown ">                                           
                        <!-- item-->
                        <a href="<?php echo e(base_url('app/profil_saya')); ?>" class="dropdown-item notify-item">
                            <i class="mdi mdi-account-circle"></i>
                            <span>Profil Saya</span>
                        </a>
                        <a href="<?php echo e(base_url('app/menu')); ?>" class="dropdown-item notify-item">
                            <i class="mdi mdi-menu"></i>
                            <span>Menu</span>
                        </a>
                        <a href="javascript:void(0);" data-toggle="modal" data-target="#modal-logout" class="dropdown-item notify-item">
                            <i class="mdi mdi-logout-variant"></i>
                            <span>Logout</span>
                        </a>

                    </div>
                </li>               

            </ul>

            <!-- LOGO -->
            <div class="logo-box">
                <a href="<?php echo e(base_url('app/dashboard')); ?>" class="logo text-center">
                    <span class="logo-lg">
                        <img src="<?php echo e(base_url('assets/images/logo/upj-logo-text-white.png')); ?>" alt="" class="mt-1" height="45">
                        <!-- <span class="logo-lg-text-light">SPA-IG</span> -->
                    </span>
                    <span class="logo-sm">
                        <!-- <span class="logo-sm-text-dark">S</span> -->
                        <img src="<?php echo e(base_url('assets/images/logo/upj-logo-text-white.png')); ?>" alt="" height="24">
                    </span>
                </a>
            </div>

            <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
                <li>
                    <button class="button-menu-mobile waves-effect">
                        <i class="mdi mdi-menu"></i>
                    </button>
                </li>                                    
            </ul>
        </div>
        <!-- end Topbar --> 
        
        <!-- ========== Left Sidebar Start ========== -->
        <?php echo $__env->make('layouts.user_sidebar_menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page">
            <div class="content">

                <!-- Start Content-->
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><b>IG</b></a></li>                                        
                                        <?php echo $__env->yieldContent('breadcrumb'); ?>
                                    </ol>
                                </div>
                                <h4 class="page-title"><?php echo $__env->yieldContent('page-title'); ?></h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <?php echo $__env->yieldContent('content'); ?>
                    </div>
                    <!-- end row -->

                </div>
                <!-- end container-fluid -->

            </div>
            <!-- end content -->
            
            <!-- Footer Start -->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <?= date('Y') ?> &copy; <b>ICT</b> - Universitas Pembangunan Jaya.
                        </div>
                    </div>
                </div>
            </footer>
            <!-- end Footer -->

        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->

    </div>
    <!-- END wrapper -->    

    <!-- Modal Logout -->
    <?php echo form_open('app/logout'); ?>

    <div id="modal-logout" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0">Logout</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">    
                    <p class="pb-0 mb-0">Apakah anda yakin ingin keluar?</p>                
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light btn-sm waves-effect" data-dismiss="modal">Kembali</button>
                    <button type="submit" class="btn btn-danger btn-sm waves-effect waves-light">Logout <i class="mdi mdi-logout-variant"></i></button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <?php echo form_close(); ?>

    <!-- End Modal Logout -->

    <!-- end page -->
    <script src="https://code.jquery.com/jquery-3.6.0.slim.js" integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY=" crossorigin="anonymous"></script>
    
    <script src="<?php echo e(base_url('assets/js/vendor.min.js')); ?>"></script>    
    <script src="<?php echo e(base_url('assets/js/toastr.min.js')); ?>"></script>    
    <script>
        $(document).ready(function(){
            <?php if($CI->session->flashdata('alert')): ?>
                toastr["<?php echo e($CI->session->flashdata('alert')['type']); ?>"]("<?php echo e($CI->session->flashdata('alert')['message']); ?>", "<?php echo e($CI->session->flashdata('alert')['title']); ?>")                		
            <?php endif; ?>

            <?php if($CI->session->flashdata('error_validation')): ?>
                <?php $__currentLoopData = $CI->session->flashdata('error_validation')['form_error']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>            
                    toastr["error"]("<?= $r ?>", "")                
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>        		
            <?php endif; ?>

            $('form.myForm').submit(function(){
                $('button[type="submit"]')
                .attr('disabled', true)
                .addClass('disabled')
                .html('<i class="mdi mdi-spin mdi-loading"></i>')
            })
        })
    </script>

    <script src="<?php echo e(base_url('assets/js/app.min.js')); ?>"></script>   
    <?php echo $__env->yieldContent('js'); ?> 
</body>
</html><?php /**PATH C:\xampp_php_7\htdocs\hibah_upj\application\views/layouts/user.blade.php ENDPATH**/ ?>