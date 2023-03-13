<?php 
$session = $CI->session->userdata('user_sessions');
$jabatan = $_SESSION['user_sessions']['kode_jabatan'];
$unit = $_SESSION['user_sessions']['nama_unit'];
$kode_unit = $_SESSION['user_sessions']['kode_unit'];
?>


<?php $__env->startSection('title'); ?>
    History Approval Actbud
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-title'); ?>
    History Approval Actbud
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
<li class="breadcrumb-item">History Approval</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            Data History Approval
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="table-history-approval" width="100%">
                    <thead>
                        <tr>
                            <th class="v-middle" width="5%">No</th>
                            <th class="v-middle" width="5%"><center>Tahun</center></th>
                            <th class="v-middle" width="15%"><center>No. Dokumen</center></th>
                            <th class="v-middle" width="15%"><center>Kode Pencairan & Jenis Pencairan</center></th>
                            <th class="v-middle" width="40%"><center>Nama Kegiatan</center></th>
                            <th class="v-middle" width="10%"><center>Anggaran</center></th>
                            <th class="v-middle" width="10%"><center>Approval</center></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $no = 1;
                        if(!empty($approval_actbud)){
                            foreach($approval_actbud as $key => $value){
                                $ketApproval = "";
                                if($kode_unit == "003"){
                                    $ketApproval = '<td class="v-middle text-center font-14"><strong>' . $value['st_umum'] . '</strong><br><small>' . $value['stamp_umum'] . '</small></td>';
                                } else if($kode_unit == "006"){
                                    $ketApproval = '<td class="v-middle text-center font-14"><strong>' . $value['st_hrd'] . '</strong><br><small>' . $value['stamp_hrd'] . '</small></td>';
                                } else if($kode_unit == "004"){
                                    $ketApproval = '<td class="v-middle text-center font-14"><strong>' . $value['st_ict'] . '</strong><br><small>' . $value['stamp_ict'] . '</small></td>';
                                } else if($kode_unit == "013"){
                                    $ketApproval = '<td class="v-middle text-center font-14"><strong>' . $value['st_bkal'] . '</strong><br><small>' . $value['st_bkal'] . '</small></td>';
                                } else if($kode_unit == "016"){
                                    $ketApproval = '<td class="v-middle text-center font-14"><strong>' . $value['st_p2m'] . '</strong><br><small>' . $value['st_p2m'] . '</small></td>';
                                } else if($kode_unit == "002"){
                                    $ketApproval = '<td class="v-middle text-center font-14"><strong>' . $value['st_keu'] . '</strong><br><small>' . $value['stamp_keu'] . '</small></td>';
                                } else if($kode_unit == "018"){
                                    $ketApproval = '<td class="v-middle text-center font-14"><strong>' . $value['st_ftd'] . '</strong><br><small>' . $value['stamp_ftd'] . '</small></td>';
                                } else if($kode_unit == "017"){
                                    $ketApproval = '<td class="v-middle text-center font-14"><strong>' . $value['st_fhb'] . '</strong><br><small>' . $value['stamp_fhb'] . '</small></td>';
                                } else if($kode_unit == "007" && $jabatan == 3){
                                    $ketApproval = '<td class="v-middle text-center font-14"><strong>' . $value['st_warek_1'] . '</strong><br><small>' . $value['stamp_warek1'] . '</small></td>';
                                } else if($kode_unit == "007" && $jabatan == 4){
                                    $ketApproval = '<td class="v-middle text-center font-14"><strong>' . $value['st_warek_2'] . '</strong><br><small>' . $value['stamp_warek2'] . '</small></td>';
                                } else if($kode_unit == "007" && $jabatan == 2){
                                    $ketApproval = '<td class="v-middle text-center font-14"><strong>' . $value['st_rek'] . '</strong><br><small>' . $value['stamp_rek'] . '</small></td>';
                                } else if($kode_unit == "007" && $jabatan == 1){
                                    $ketApproval = '<td class="v-middle text-center font-14"><strong>' . $value['st_pres'] . '</strong><br><small>' . $value['stamp_pres'] . '</small></td>';
                                } else {
                                    $ketApproval = '<td class="v-middle text-center font-14"><strong>' . $value['st_kabag'] . '</strong><br><small>' . $value['stamp_kabag'] . '</small></td>';
                                }

                    ?>
                                <tr>
                                    <td class="v-middle text-center font-14"><?= $no++; ?></td>
                                    <td class="v-middle" align="center">
                                            <?= $value['tahun'] ?>
                                    </td>
                                    <td class="v-middle text-center">
                                        <?php
                                            $no_dokumen = $value['jns_aju_agr'] == 'actbud' ? 'ACT' : 'PTY';                                            
                                        ?>
                                        <span class="badge bg-primary p-2">
                                            <?= $no_dokumen . '/' . $value['kd_act'] ?>
                                        </span>
                                    </td>
                                    <td class="v-middle text-center">
                                        <span class="badge bg-purple p-2">
                                            <?= $value['kode_pencairan'] ?>
                                        </span>
                                        <br>
                                        <span class="badge bg-dark p-2 mt-1">
                                            <i class="mdi mdi-checkbox-marked-circle-outline"></i> <?= ucwords($value['jns_aju_agr']) ?>
                                        </span>
                                    </td>
                                    <td class="v-middle font-14">
                                        <a href="<?= base_url('app/sim-spa/history-approval/detail/') . $value['kd_act']; ?>">
                                            <?= $value['nama_kegiatan'] ?>
                                        </a>
                                        <hr class="mt-1 mb-2">
                                        <span class="badge bg-secondary p-2" style="font-size:12px;">
                                            <i class="mdi mdi-calendar"></i> <?= tanggal_indo(date('Y-m-d', strtotime($value['tgl_m']))) . ' - ' . tanggal_indo(date('Y-m-d', strtotime($value['tgl_s']))) ?>
                                        </span>
                                    </td>
                                    <td class="v-middle" align="center">
                                        <span class="badge bg-success p-2">
                                            <?= rupiah_1($value['agr']) ?>
                                        </span>
                                    </td>
                                    <?= $ketApproval ?>
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
        $("#table-history-approval").DataTable({
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
<?php echo $__env->make('spa.layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\upj_spa_ig\application\views/spa/approval/history-approval.blade.php ENDPATH**/ ?>