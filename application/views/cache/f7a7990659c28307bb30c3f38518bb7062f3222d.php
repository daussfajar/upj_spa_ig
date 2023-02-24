<?php 
$session = $CI->session->userdata('user_sessions');
?>


<?php $__env->startSection('title'); ?>
    <?= MOD2 ?> Dashboard
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-title'); ?>
    Dashboard
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item active"><a href="javascript: void(0);">Dashboard</a></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>    
    <?php if($session['kode_jabatan'] == 7): ?>
    <div class="col-lg-6 col-xl-4">
        <div class="card widget-box-three">
            <div class="card-body">
                <div class="float-right mt-2">
                    <i class="mdi mdi-clipboard-multiple-outline text-purple display-4 m-0"></i>
                </div>
                <div class="overflow-hidden">
                    <p class="text-uppercase font-weight-medium text-truncate mb-2">Pengajuan Actbud</p>
                    <h2 class="mb-0">
                        <span data-plugin="counterup">
                            
                        </span>
                    </h2>
                </div>
            </div>
            <div class="card-footer">
                <div class="float-right">
                    <a href="" class="btn btn-info btn-xs">Lihat <i class="mdi mdi-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-xl-4">
        <div class="card widget-box-three">
            <div class="card-body">
                <div class="float-right mt-2">
                    <i class="mdi mdi-clipboard-multiple-outline text-primary display-4 m-0"></i>
                </div>
                <div class="overflow-hidden">
                    <p class="text-uppercase font-weight-medium text-truncate mb-2">Pengajuan Petty Cash</p>
                    <h2 class="mb-0">
                        <span data-plugin="counterup">
                            
                        </span>
                    </h2>
                </div>
            </div>
            <div class="card-footer">
                <div class="float-right">
                    <a href="" class="btn btn-info btn-xs">Lihat <i class="mdi mdi-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-xl-4">
        <div class="card widget-box-three">
            <div class="card-body">
                <div class="float-right mt-2">
                    <i class="mdi mdi-progress-close text-danger display-4 m-0"></i>
                </div>
                <div class="overflow-hidden">
                    <p class="text-uppercase font-weight-medium text-truncate mb-2">Actbud Ditolak</p>
                    <h2 class="mb-0">
                        <span data-plugin="counterup">
                            
                        </span>
                    </h2>
                </div>
            </div>
            <div class="card-footer">
                <div class="float-right">
                    <a href="" class="btn btn-info btn-xs">Lihat <i class="mdi mdi-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>    
<?php $__env->stopSection(); ?>
<?php echo $__env->make('spa.layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp_php_7\htdocs\hibah_upj\application\views/spa/dashboard/dashboard.blade.php ENDPATH**/ ?>