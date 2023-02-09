

<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('page-title'); ?>
    Dashboard
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item active"><a href="javascript: void(0);">Dashboard</a></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="<?php echo e(base_url('assets/css/admin.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php 
    $session = $CI->session->userdata('user_sessions');
    ?>    
    
    <div class="col-lg-6 col-xl-3">
        <div class="card widget-box-three">
            <div class="card-body">
                <div class="float-right mt-2">
                    <i class="mdi mdi-hand-heart text-primary display-3 m-0"></i>
                </div>
                <div class="overflow-hidden">
                    <p class="text-uppercase font-weight-medium text-truncate mb-2">MY Hibah</p>
                    <h2 class="mb-0">
                        <span data-plugin="counterup">
                            <?php echo e($total_hibah->total); ?>

                        </span>
                    </h2>
                </div>
            </div>
            <div class="card-footer">
                <div class="float-right">
                    <a href="<?php echo e(base_url('app/hibah/pencairan')); ?>" class="btn btn-info btn-xs">Lihat <i class="mdi mdi-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6 col-xl-3">
        <div class="card widget-box-three">
            <div class="card-body">
                <div class="float-right mt-2">
                    <i class="mdi mdi-bullhorn text-secondary display-3 m-0"></i>
                </div>
                <div class="overflow-hidden">
                    <p class="text-uppercase font-weight-medium text-truncate mb-2">my Sponsorship</p>
                    <h2 class="mb-0">
                        <span data-plugin="counterup">
                            <?php echo e($total_sponsorship->total); ?>

                        </span>
                    </h2>
                </div>
            </div>
            <div class="card-footer">
                <div class="float-right">
                    <a href="<?php echo e(base_url('app/sponsorship/pencairan')); ?>" class="btn btn-info btn-xs">Lihat <i class="mdi mdi-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6 col-xl-3">
        <div class="card widget-box-three">
            <div class="card-body">
                <div class="float-right mt-2">
                    <i class="mdi mdi-file-check text-success display-3 m-0"></i>
                </div>
                <div class="overflow-hidden">
                    <p class="text-uppercase font-weight-medium text-truncate mb-2">Actbud disetujui</p>
                    <h2 class="mb-0">
                        <span data-plugin="counterup">
                            <?php echo e($total_actbud_disetujui->total); ?>

                        </span>
                    </h2>
                </div>
            </div>
            <div class="card-footer">
                <div class="float-right">
                    <a href="<?php echo e(base_url('app/actbud-disetujui')); ?>" class="btn btn-info btn-xs">Lihat <i class="mdi mdi-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-6 col-xl-3">
        <div class="card widget-box-three">
            <div class="card-body">
                <div class="float-right mt-2">
                    <i class="mdi mdi-file-remove text-danger display-3 m-0"></i>
                </div>
                <div class="overflow-hidden">
                    <p class="text-uppercase font-weight-medium text-truncate mb-2">Actbud ditolak</p>
                    <h2 class="mb-0">
                        <span data-plugin="counterup">
                            <?php echo e($total_actbud_ditolak->total); ?>

                        </span>
                    </h2>                    
                </div>
            </div>
            <div class="card-footer">
                <div class="float-right">
                    <a href="<?php echo e(base_url('app/actbud-ditolak')); ?>" class="btn btn-info btn-xs">Lihat <i class="mdi mdi-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
    
    <?php if($jabatan != 7): ?>
        <div class="col-lg-6 col-xl-3">
            <div class="card widget-box-three">
                <div class="card-body">
                    <div class="float-right mt-2">
                        <i class="mdi mdi-folder-open-outline text-primary display-3 m-0"></i>
                    </div>
                    <div class="overflow-hidden">
                        <p class="text-uppercase font-weight-medium text-truncate mb-2">Approval</p>
                        <h2 class="mb-0">
                            <span data-plugin="counterup">
                                <?php echo e($total_approval->total); ?>

                            </span>
                        </h2>                    
                    </div>
                </div>
                <div class="card-footer">
                    <div class="float-right">
                        <a href="<?php echo e(base_url('app/approval')); ?>" class="btn btn-info btn-xs">Lihat <i class="mdi mdi-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <?php if($unit == 002): ?>
            
        <?php endif; ?>
    <?php endif; ?>

    <?php if($jabatan == 0): ?>
        <?php
            $dataHibah = $CI->db->query("SELECT COUNT(a.id) tot_hibah FROM ig_tbl_uraian a WHERE a.status = 'Aktif' 
            AND a.jenis_ig = 'hibah'")->row();
            $dataSponsorship = $CI->db->query("SELECT COUNT(a.id) tot_sponsorship FROM ig_tbl_uraian a WHERE a.status = 'Aktif' 
            AND a.jenis_ig = 'sponsorship'")->row();
        ?>
        <div class="col-xl-12 col-md-12 col-xs-12 col-sm-12">
            <div class="admin-region">
                <div class="container-fluid">
                    <div class="alert alert-purple">
                        <h5 class="m-0 text-white">Blok yang ditempatkan di wilayah ini hanya akan terlihat oleh pengguna admin.</h5>
                    </div>
                    
                    <div class="row">
                        <div class="col-lg-6 col-xl-3">
                            <div class="card widget-box-three">
                                <div class="card-body">
                                    <div class="float-right mt-2">
                                        <i class="mdi mdi-briefcase-check-outline text-primary display-3 m-0"></i>
                                    </div>
                                    <div class="overflow-hidden">
                                        <p class="text-uppercase font-weight-medium text-truncate mb-2">Hibah</p>
                                        <h2 class="mb-0">
                                            <span data-plugin="counterup"><?php echo e($dataHibah->tot_hibah); ?></span>
                                        </h2>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="float-right">
                                        <a href="<?php echo e(base_url('app/hibah')); ?>" class="btn btn-info btn-xs">Lihat <i class="mdi mdi-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-xl-3">
                            <div class="card widget-box-three">
                                <div class="card-body">
                                    <div class="float-right mt-2">
                                        <i class="mdi mdi-briefcase-check-outline text-orange display-3 m-0"></i>
                                    </div>
                                    <div class="overflow-hidden">
                                        <p class="text-uppercase font-weight-medium text-truncate mb-2">Sponsorship</p>
                                        <h2 class="mb-0"><?php echo e($dataSponsorship->tot_sponsorship); ?></h2>                    
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="float-right">
                                        <a href="<?php echo e(base_url('app/sponsorship')); ?>" class="btn btn-info btn-xs">Lihat <i class="mdi mdi-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp_php_7\htdocs\hibah_upj\application\views/users/dashboard/index.blade.php ENDPATH**/ ?>