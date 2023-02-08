

<?php $__env->startSection('title', 'Data Pemberitahuan'); ?>

<?php $__env->startSection('page-title'); ?>
    <a href="<?php echo e(base_url('app/dashboard')); ?>" class=""><i class="mdi mdi-arrow-left"></i></a> Data Pemberitahuan
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item active"><a href="javascript: void(0);">Data Pemberitahuan</a></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="col-md-12">
    <div class="card-box">
        <div class="float-right">
            <a href="<?php echo e(base_url('app/set-sudah-dibaca-semua-pemberitahuan')); ?>" onclick="return confirm('Apakah anda yakin ingin set sudah dibaca pada semua notifikasi?')" class="btn btn-warning btn-sm"><i class="mdi mdi-check-bold"></i> Set Sudah Lihat Semua</a>
        </div>
        <br><br>
        <div class="table-responsive mt-3">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th class="text-center" width=50>No</th>
                        <th>Judul</th>
                        <th>Pesan</th>
                        <th>Tanggal Masuk</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(empty($data['data'])): ?>
                        <tr>
                            <th colspan="5" class="text-center">Tidak ada pemberitahuan</th>
                        </tr>
					<?php else: ?>
                        <?php
                        $no = (empty($CI->uri->segment(3)) ? 0 : $CI->uri->segment(3) + 0);
                        ?>
                        <?php $__currentLoopData = $data['data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $no++
                            ?>
                            <tr <?php echo $row['is_seen'] == 'no' ? 'style="background:#fcf8e3;"' : ''; ?>>
                                <th class="text-center"><?php echo e($no); ?></th>
                                <td><?php echo e($row['title']); ?></td>
                                <td><?php echo e($row['message']); ?></td>
                                <td>
                                    <?php echo e(tanggal_indo(substr($row['date_created'],0,10), true).', '.substr($row['date_created'], 10,6)); ?>

                                </td>
                                <td class="text-center">
                                    <a href="<?php echo e(base_url($row['url'] . $row['id'])); ?>" class="btn btn-info btn-xs">
                                        <i class="mdi mdi-eye"></i>
                                    </a>
                                    <a href="<?php echo e(base_url('app/data-pemberitahuan/hapus_data/' . encrypt($row['id']))); ?>" class="btn btn-danger btn-xs" onclick="return confirm('Apakah anda yakin?')">
                                        <i class="mdi mdi-trash-can"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <span class="badge badge-info">Total Data: <?php echo e($data['total_rows']); ?></span>
		<?php echo $data['pagination']; ?>

    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\hibah_upj\application\views/users/pemberitahuan/index.blade.php ENDPATH**/ ?>