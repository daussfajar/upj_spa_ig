<?php 
$session = $CI->session->userdata('user_sessions');
?>


<?php $__env->startSection('title'); ?>
    Approval Actbud Keuangan
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-title'); ?>
    Approval Actbud
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="<?php echo e(base_url('assets/css/dataTables.bootstrap4.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(base_url('assets/css/responsive.bootstrap4.min.css')); ?>">
<style>
    .v-middle{
        vertical-align: middle!important;
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item">Approval</li>
<li class="breadcrumb-item active">Keuangan</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            Silahkan Approve Actbud Tersebut
        </div>
        <div class="card-body">
            <div class="table-responsive my-4">
                <table class="table table-striped table-bordered table-hover" id="table-approval-keuangan" width="100%">
                    <thead class="bg-purple text-white">
                        <tr>
                            <th class="v-middle text-center">No.</th>
                            <th class="v-middle text-center">No Dokumen</th>
                            <th class="v-middle text-center">Kode Pencairan</th>
                            <th class="v-middle text-center">Nama Kegiatan</th>
                            <th class="v-middle text-center">Jenis Pencairan</th>
                            <th class="v-middle text-center">Anggaran</th>
                            <th class="v-middle text-center">PIC</th>
                            <th class="v-middle text-center">Pelaksana</th>
                            <th class="v-middle text-center">Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $no = 1;
                            if(!empty($approval_actbud)){
                                foreach($approval_actbud as $key => $value){
                        ?>
                                    <tr>
                                        <td class="v-middle text-center font-14"><?= $no++; ?></td>
                                        <td class="v-middle text-center">
                                            <?php
                                                $no_dokumen = $value['jns_aju_agr'] == 'actbud' ? 'ACT' : 'PTY';
                                                $date_m = date_create($value['tgl_m']);
                                                $date_s = date_create($value['tgl_s']);                                                
                                            ?>
                                            <span class="badge bg-primary p-2">
                                                <?= $no_dokumen . '/' . $value['kd_act'] ?>
                                            </span>
                                        </td>
                                        <td class="v-middle text-center">
                                            <span class="badge bg-purple p-2">
                                                <?= $value['kode_pencairan'] ?>
                                            </span>
                                        </td>
                                        <td class="v-middle font-14">
                                            <?= $value['nama_kegiatan'] ?>
                                            <hr class="mt-1 mb-2">
                                            <span class="badge bg-secondary p-2" style="font-size:12px;">
                                                <i class="mdi mdi-calendar"></i> <?= tanggal_indo(date_format($date_m, 'Y-m-d')) . ' - ' . tanggal_indo(date_format($date_s, 'Y-m-d')) ?>
                                            </span>
                                        </td>
                                        <td class="v-middle text-center">
                                            <span class="badge bg-dark p-2">
                                                <i class="mdi mdi-checkbox-marked-circle-outline"></i> <?= ucwords($value['jns_aju_agr']) ?>
                                            </span>
                                        </td>
                                        <td class="v-middle" align="center">
                                            <span class="badge bg-success p-2">
                                                <?= rupiah_1($value['agr']) ?>
                                            </span>
                                        </td>
                                        <td class="v-middle text-center">
                                            <span class="badge bg-teal p-2">
                                                <?= ucwords($value['nama_pic']) ?>
                                            </span>
                                        </td>
                                        <td class="v-middle text-center">
                                            <span class="badge bg-teal p-2">
                                                <?= ucwords($value['nama_pelaksana']) ?>
                                            </span>
                                        </td>
                                        <td class="v-middle text-center">                                            
                                            <a href="<?= base_url('app/sim-spa/approval/keuangan/detail/') . $value['kd_act']; ?>" class="badge bg-info p-2">
                                                Detail <i class="mdi mdi-arrow-right"></i>
                                            </a>
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
        $("#table-approval-keuangan").DataTable({
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
<?php echo $__env->make('spa.layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp_php_7\htdocs\hibah_upj\application\views/spa/approval/approval-keuangan.blade.php ENDPATH**/ ?>