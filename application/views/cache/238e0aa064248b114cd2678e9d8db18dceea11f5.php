<?php 
$session = $CI->session->userdata('user_sessions');
$year = date('Y');
?>


<?php $__env->startSection('title'); ?>
    RKAT - Laporan Pencairan RKAT (ACTBUD / Petty Cash)
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-title'); ?>
    Laporan Pencairan RKAT (ACTBUD / Petty Cash) <?= $year; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="<?php echo e(base_url('assets/css/dataTables.bootstrap4.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(base_url('assets/css/responsive.bootstrap4.min.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item">RKAT</li>
<li class="breadcrumb-item active">Laporan Pencairan</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            Data Laporan Pencairan RKAT
        </div>
        <div class="card-body">
            <div class="table-responsive my-4">
                <table class="table table-striped table-bordered table-hover" id="table-approval-warek-1" width="100%">
                    <thead>
                        <tr>
                            <th><center>No.</center></th>
                            <th><center>No Dokumen</center></th>
                            <th><center>Kode Pencairan</center></th>
                            <th><center>Nama Kegiatan</center></th>
                            <th><center>Jenis Pencairan</center></th>
                            <th><center>Anggaran</center></th>
                            <th><center>PIC</center></th>
                            <th><center>Pelaksana</center></th>
                            <th><center>Detail</center></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $no = 1;
                            if(!empty($approval_actbud)){
                                foreach($approval_actbud as $key => $value){
                        ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td>
                                            <?php
                                                if($value['jns_aju_agr'] == 'actbud'){
                                                    echo 'ACT/' . $value['kd_act'];
                                                }else{
                                                    echo 'PTY/' . $value['kd_act'];
                                                }
                                            ?>
                                        </td>
                                        <td><?= $value['kode_pencairan']; ?></td>
                                        <td>
                                            <textarea cols="20" readonly rows="3"><?= $value['deskrip_keg'];?></textarea>
                                        </td>
                                        <td><?= $value['jns_aju_agr']; ?></td>
                                        <td align="right"><?= number_format($value['fnl_agr'],'0','.','.'); ?></td>
                                        <td><?= $value['nama_pic']; ?></td>
                                        <td><?= $value['nama_pelaksana']; ?></td>
                                    </tr>
                        <?php
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </div>
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
        $("#table-approval-warek-1").DataTable({
            oLanguage: {
                sProcessing: "Loading..."
            },
            lengthMenu: [
                [10, 25, 50, 100],
                [10, 25, 50, 100],
            ],
            pageLength: 10,
            scrollX: true,
            processing: true,
            serverSide: false,
            order: [
                [0, 'asc']
            ],
            rowCallback: function(row, data, iDisplayIndex) {
                $('td:eq(0)', row).html();
            }
        });
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('spa.layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\upj_spa_ig\application\views/spa/approval/approval_warek1.blade.php ENDPATH**/ ?>