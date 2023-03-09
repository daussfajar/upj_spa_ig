<?php 
$session = $CI->session->userdata('user_sessions');
$tahunRKAT = date('Y', strtotime(date('Y-m-d') . ' -1 year')) . '/' . date('Y');
?>


<?php $__env->startSection('title'); ?>
    RKAT <?= $tahunRKAT ?> - List Investasi
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-title'); ?>
    RKAT <?= $tahunRKAT ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="<?php echo e(base_url('assets/css/dataTables.bootstrap4.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(base_url('assets/css/responsive.bootstrap4.min.css')); ?>">
<style>
    .v-middle{
        vertical-align: middle!important;
    }
    .font-14{
        font-size: 14px!important;
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item">Investasi</li>
<li class="breadcrumb-item active">List</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            LIST RKAT
        </div>
        <div class="card-body">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('app/sim-spa/rkat/list/program-kerja') ?>">Program Kerja</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('app/sim-spa/rkat/list/operasional') ?>">Operasional</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="<?= base_url('app/sim-spa/rkat/list/investasi') ?>">Investasi</a>
                </li>
            </ul>
            <div class="table-responsive my-4">
                <table class="table table-striped table-bordered table-hover" id="table-list-rkat-investasi" style="width:100%;">
                    <thead>
                        <tr>
                            <th class="text-center v-middle">No</th>
                            <th class="text-center v-middle">Kode Pencairan</th>
                            <th class="text-center v-middle">Kode Kegiatan</th>
                            <th class="text-center v-middle">Uraian dan Tujuan <br>Kegiatan</th>
                            <th class="text-center v-middle">Kode KPI</th>
                            <th class="text-center v-middle">KPI</th>
                            <th class="text-center v-middle">PIC</th>
                            <th class="text-center v-middle">Tahun Anggaran</th>
                            <th class="text-center v-middle">Periode</th>
                            <th class="text-center v-middle">Total RKAT</th>
                            <th class="text-center v-middle">Pengalihan Masuk</th>
                            <th class="text-center v-middle">Pengalihan Keluar</th>
                            <th class="text-center v-middle">Pencairan</th>
                            <th class="text-center v-middle">Sisa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if(!empty($list_rkat)){
                                $no = 1;
                                foreach($list_rkat as $key => $value){
                        ?>
                                <tr>
                                    <th class="text-center v-middle font-14"><?= $no++ ?></th>
                                    <td class="text-center v-middle font-14"><?= $value['kode_pencairan'] ?></td>
                                    <td class="text-center v-middle font-14"><?= $value['renstra_prodi'] ?></td>
                                    <td class="v-middle font-14"><?= $value['uraian'] ?></td>
                                    <td class="text-center v-middle font-14"><?= $value['renstra_univ'] ?></td>
                                    <td class="text-center v-middle font-14"><?= $value['kpi'] ?></td>
                                    <td class="text-center v-middle font-14"><?= $value['nama_lengkap'] ?></td>
                                    <td class="text-center v-middle font-14"><?= $value['tahun'] ?></td>
                                    <td class="text-center v-middle font-14"><?= $value['periode'] ?></td>
                                    <td class="text-center v-middle">
                                        <span class="badge bg-success p-2">
                                            <?= rupiah_1($value['total_agr_stj']) ?>
                                        </span>
                                    </td>
                                    <td class="text-center v-middle">                                            
                                        <span class="badge bg-success p-2">
                                            <?= rupiah_1($value['n_in']) ?>
                                        </span>
                                    <td class="text-center v-middle">                                            
                                        <span class="badge bg-success p-2">
                                            <?= rupiah_1($value['n_out']) ?>
                                        </span>
                                    </td>
                                    <td class="text-center v-middle">                                            
                                        <span class="badge bg-success p-2">
                                            <?= rupiah_1($value['t_aju_agr']) ?>
                                        </span>
                                    </td>
                                    <td class="text-center v-middle">                                            
                                        <span class="badge bg-success p-2">
                                            <?= rupiah_1($value['sisa_agr']) ?>
                                        </span>
                                    </td>
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
        $("#table-list-rkat-investasi").DataTable({
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
        });
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('spa.layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp_php_7\htdocs\hibah_upj\application\views/spa/rkat/list-investasi.blade.php ENDPATH**/ ?>