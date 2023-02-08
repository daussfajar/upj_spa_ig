

<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('page-title'); ?>
    Dashboard
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item active"><a href="javascript: void(0);">Dashboard</a></li>
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
                    <h2 class="mb-0"><?php echo e($total_hibah->total); ?></h2>                    
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
                    <h2 class="mb-0"><?php echo e($total_sponsorship->total); ?></h2>                    
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
                    <h2 class="mb-0"><?php echo e($total_actbud_disetujui->total); ?></h2>                    
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
                    <h2 class="mb-0"><?php echo e($total_actbud_ditolak->total); ?></h2>                    
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
                        <i class="mdi mdi-folder-open text-primary display-3 m-0"></i>
                    </div>
                    <div class="overflow-hidden">
                        <p class="text-uppercase font-weight-medium text-truncate mb-2">Approval</p>
                        <h2 class="mb-0"><?php echo e($total_approval->total); ?></h2>                    
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp1\htdocs\hibah_upj\application\views/users/dashboard/index.blade.php ENDPATH**/ ?>