

<?php $__env->startSection('title', 'Actbud Disetujui'); ?>

<?php $__env->startSection('page-title'); ?>
    <i class="mdi mdi-table"></i> Actbud Disetujui
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="<?php echo e(base_url('assets/css/dataTables.bootstrap4.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(base_url('assets/css/responsive.bootstrap4.min.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item active"><a href="javascript: void(0);"><i class="mdi mdi-table"></i> Actbud Disetujui</a></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="col-md-12">
        <div class="card-box">
            <div class="table-responsive">
                <table class="table table-striped table-bordered dataTable">
                    <thead class="bg-purple text-white">
                        <tr>
                            <th class="text-center" width=30>No</th>
                            <th>Kode Uraian</th>
                            <th>Kode Pencairan</th>
                            <th class="text-center">Nama Kegiatan</th>
                            <th class="text-center">Tanggal Pelaksanaan</th>
                            <th class="text-center">Jenis</th>
                            <th class="text-center">Anggaran</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $actbud; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <th class="text-center" style="vertical-align: middle;"><?php echo e($loop->iteration); ?></th>
                                <td style="vertical-align: middle;">
                                    <span class="badge bg-primary p-2">
                                        <?php echo e($item->kode_uraian); ?>

                                    </span>
                                </td>
                                <td style="vertical-align: middle;">
                                    <span class="badge bg-secondary p-2">
                                        <?php echo e($item->kode_pencairan); ?>

                                    </span>
                                </td>
                                <td style="vertical-align: middle;font-size:14px;">
                                    <a href="javascript:void(0)" onclick="window.open('<?php echo e(base_url('app/' . $item->jenis_anggaran . '/pencairan/v_detail/' . encrypt($item->id_uraian) . '/actbud/' . encrypt($item->id))); ?>')"><?php echo $item->nama_kegiatan; ?></a>
                                </td>
                                <td style="vertical-align: middle;">
                                    <span class="badge bg-dark text-white p-2">
                                        <?php echo e(tanggal_indo($item->tgl_mulai)); ?> s/d <?php echo e(tanggal_indo($item->tgl_selesai)); ?>

                                    </span>
                                </td>
                                <td style="vertical-align: middle;" class="text-center">
                                    <?php switch($item->jenis_anggaran):
                                        case ('hibah'): ?>
                                            <span class="badge badge-warning p-2">Hibah</span>
                                            <?php break; ?>
                                        <?php case ('sponsorship'): ?>
                                            <span class="badge badge-warning p-2">Sponsorship</span>
                                            <?php break; ?>
                                        <?php default: ?>
                                            
                                    <?php endswitch; ?>
                                </td>
                                <td style="vertical-align: middle;" class="text-center">
                                    <span class="badge bg-purple p-2">
                                        <?php echo e(rupiah($item->agr)); ?>

                                    </span>
                                </td>
                                <td style="vertical-align: middle;" class="text-center">
                                    <span class="badge badge-success p-2"><i class="mdi mdi-check-bold"></i> Disetujui</span>                                    
                                </td>
                                <th class="text-center" style="vertical-align: middle">
                                    <a href="javascript:void(0)" onclick="window.open('<?php echo e(base_url('app/' . $item->jenis_anggaran . '/pencairan/v_detail/' . encrypt($item->id_uraian) . '/actbud/' . encrypt($item->id) . '/cetak_form_actbud?pdf=true')); ?>', 'MsgWindow', 'width=800,height=800')" class="btn btn-primary btn-sm"><i class="mdi mdi-printer"></i></a>
                                </th>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script src="<?php echo e(base_url('assets/js/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(base_url('assets/js/dataTables.bootstrap4.min.js')); ?>"></script>
<script src="<?php echo e(base_url('assets/js/dataTables.responsive.min.js')); ?>"></script>
<script src="<?php echo e(base_url('assets/js/responsive.bootstrap4.min.js')); ?>"></script>  
<script>
    $(document).ready(function(){
        $('.dataTable').dataTable({
            stateSave: true
        })
    })
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp_php_7\htdocs\hibah_upj\application\views/users/table/v_actbud_disetujui.blade.php ENDPATH**/ ?>