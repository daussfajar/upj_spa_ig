

<?php $__env->startSection('title', 'Pengaturan - Umum'); ?>

<?php $__env->startSection('page-title'); ?>
    Login Logs
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item"><a href="javascript: void(0);"><i class="mdi mdi-cogs"></i> Pengaturan</a></li>
<li class="breadcrumb-item active"><a href="javascript: void(0);">Login Logs</a></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="col-md-12">
        <div class="card card-border card-purple">
            <div class="card-header border-purple bg-transparent">
                <h3 class="card-title text-purple mb-0">Data Informasi Login User</h3>
            </div>
            <div class="card-body">
                <div class="float-right">
                    <a href="" class="btn btn-light"><i class="mdi mdi-refresh"></i>Refresh</a>
                </div>
                <div class="table-responsive">
                    <table class="table mt-3">
                        <thead>
                            <tr>
                                <th class="text-center" width="50">No</th>
                                <th>User</th>
                                <th>IP Address</th>
                                <th>Browser</th>
                                <th>Platform</th>
                                <th class="text-center">Date</th>
                                <th class="text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $no = (empty($CI->uri->segment(4)) ? 0 : $CI->uri->segment(4) + 0);
                            ?>
                            <?php $__currentLoopData = $data_logs['data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php $no++; ?>
                                <tr class="<?php echo e($item['nama_user'] == "" ? 'bg-danger text-white' : ''); ?>">
                                    <th class="text-center"><?php echo e($no); ?></th>
                                    <td>
                                        <span class="" style="font-size: 14px;">
                                            <?php echo e($item['nama_user'] == "" ? 'Unknown user' : $item['nama_user']); ?>

                                        </span>
                                    </td>
                                    <td>
                                        <span class="" style="font-size: 14px;">
                                            <?php echo e($item['ip_address']); ?>

                                        </span>
                                    </td>
                                    <td>
                                        <span class="" style="font-size: 14px;">
                                            <?php echo e($item['browser']); ?>

                                        </span>
                                    </td>
                                    <td>
                                        <span class="" style="font-size: 14px;">
                                            <?php echo e($item['platform']); ?>

                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span class="" style="font-size: 14px;">
                                            <?php echo e(tanggal_indo(substr($item['date'], 0, 10), true).', '.substr($item['date'], 10, 6)); ?>

                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <?php switch($item['status']):
                                            case ('success'): ?>
                                                <span class="badge badge-success">
                                                    <i class="mdi mdi-check"></i> Success
                                                </span>
                                                <?php break; ?>
                                            <?php case ('failed'): ?>
                                                <span class="badge badge-danger">
                                                    <i class="mdi mdi-close"></i> Failed
                                                </span>
                                                <?php break; ?>
                                            <?php default: ?>
                                                Unknown
                                        <?php endswitch; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
                <span class="badge badge-info">Total Data: <?php echo e($data_logs['total_rows']); ?></span>
		        <?php echo $data_logs['pagination']; ?>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp_php_7\htdocs\hibah_upj\application\views/admin/pengaturan/data_login_logs.blade.php ENDPATH**/ ?>