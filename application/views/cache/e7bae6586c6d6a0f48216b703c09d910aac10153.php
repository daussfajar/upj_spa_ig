

<?php $__env->startSection('title', 'Profil Saya'); ?>

<?php $__env->startSection('page-title'); ?>
    Profil Saya
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item active"><a href="javascript: void(0);"><i class="mdi mdi-account-circle"></i> Profil Saya</a></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="col-md-12">
        <div>
            <div class="text-center my-5">
                <img src="<?php echo e(base_url('assets/images/gif/animate-rocket-color.gif')); ?>" alt="" height="180">
                <h2 class="home-text text-uppercase text-danger">Site is Under Maintenance</h2>
                <p class="text-muted">We're making the system more awesome.we'll be back shortly.</p>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\hibah_upj\application\views/users/profil/profil_saya.blade.php ENDPATH**/ ?>