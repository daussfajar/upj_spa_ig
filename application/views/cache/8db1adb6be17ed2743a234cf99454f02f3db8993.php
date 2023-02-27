<?php
$session = $CI->session->userdata('user_sessions'); ?>


<?php $__env->startSection('title'); ?>
    <?= MOD2 ?> Pencairan RKAT - View Petty Cash
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-title'); ?>
    View Petty Cash
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="javascript: void(0);">Pencairan RKAT</a></li>
    <li class="breadcrumb-item active"><a href="javascript: void(0);">View Petty Cash</a></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(base_url('assets/css/dataTables.bootstrap4.min.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(base_url('assets/css/responsive.bootstrap4.min.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(base_url('assets/css/select2.min.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(base_url('assets/css/bootstrap-select.min.css')); ?>" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="col-md-12">
        <div class="card-box mt-2">
            <div class="row mb-3">
                <div class="col-md-8 col-sm-8 col-xs-12">
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <form action="" method="" accept-charset="utf-8" autocomplete="off" class="myForm">
                        <div class="input-group">
                            <input type="search" id="" value="" name="" class="form-control"
                                placeholder="Cari data...">
                            <span class="input-group-prepend">
                                <button type="submit" class="btn waves-effect waves-light btn-primary btn-sm">
                                    <i class="mdi mdi-magnify mdi-18px"></i>
                                </button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
            <div class="table-responsive">
                <table id="tb_data_petty_cash" class="table table-striped table-bordered dt-responsive nowrap">
                    <thead class="bg-purple text-white text-center">
                        <tr>
                            <th width="50" style="vertical-align: middle">No</th>
                            <th style="vertical-align: middle">Uraian</th>
                            <th style="vertical-align: middle">Jenis Biaya</th>
                            <th style="vertical-align: middle">No Borang</th>
                            <th class="text-center" style="vertical-align: middle">
                                KPI
                            </th>
                            <th width="200" style="vertical-align: middle">Kode Pencairan</th>
                        </tr>
                    </thead>
                    <tbody id="tb-petty-cash"></tbody>
                </table>
            </div>
        </div>
    </div>
<?php $__env->startSection('js'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('spa.layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\upj_spa_ig\application\views/spa/pencairan_rkat/v_view_pettycash.blade.php ENDPATH**/ ?>