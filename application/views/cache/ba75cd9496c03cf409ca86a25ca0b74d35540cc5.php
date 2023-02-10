

<?php $__env->startSection('title', 'Pengaturan - Umum'); ?>

<?php $__env->startSection('page-title'); ?>
    Pengaturan Umum
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item"><a href="javascript: void(0);"><i class="mdi mdi-cogs"></i> Pengaturan</a></li>
<li class="breadcrumb-item active"><a href="javascript: void(0);">Umum</a></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="col-md-12">
        <?php echo form_open(); ?>

        <div class="card-box">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="col-md-4 control-label">Judul Situs Web</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" value="" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 control-label">Email Pengelola Web</label>
                        <div class="col-md-8">
                            <input type="email" class="form-control" value="" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-10 offset-2">
                    <button type="submit" class="btn btn-primary btn-xs"><i class="mdi mdi-content-save"></i> Simpan</button>
                </div>
            </div>
        </div>
        <?php echo form_close(); ?>


        <div class="card-box">
            <h5 class="mt-0 mb-3">
                <i class="mdi mdi-database"></i> Database
            </h5>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="" class="col-md-4 control-label">Backup</label>
                        <div class="col-md-8">
                            <a href="<?php echo e(base_url('app/admin/system/backup_db')); ?>" class="btn btn-primary btn-xs">
                                <i class="mdi mdi-database-export"></i> Backup Database
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp_php_7\htdocs\hibah_upj\application\views/admin/pengaturan/pengaturan_umum.blade.php ENDPATH**/ ?>