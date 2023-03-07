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
                <table class="table table-striped table-bordered table-hover" id="table-laporan-pencairan-rkat" style="width:100%;">
                    <thead>
                        <tr>
                            <th style="vertical-align:middle;">No</th>
                            <th style="vertical-align:middle;"><center>No Dokumen</center></th>
                            <th style="vertical-align:middle;"><center>Uraian Kegiatan</center></th>
                            <th style="vertical-align:middle;"><center>Nama Kegiatan</center></th>
                            <th style="vertical-align:middle;"><center>Anggaran</center></th>
                            <th style="vertical-align:middle;"><center>TA</center></th>
                            <th><center>Kode Pencairan & Jenis Pencairan</center></th>
                            <th style="vertical-align:middle;"><center>KA. Prodi/Unit</center></th>
                            <th style="vertical-align:middle;"><center>Dekan</center></th>
                            <th style="vertical-align:middle;"><center>Pre-Approval</center></th>
                            <th style="vertical-align:middle;"><center>Keuangan</center></th>
                            <th style="vertical-align:middle;"><center>Wakil Rektor</center></th>
                            <th style="vertical-align:middle;"><center>Rektor</center></th>
                            <th style="vertical-align:middle;"><center>Presiden</center></th>
                            <th><center></center></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(!empty($laporan_pencairan)){
                        $no=1;
                        foreach($laporan_pencairan as $data_status){
                    ?>
                            <tr class="odd gradeX">
                                <td align="center">
                                    <?= $no++; ?>
                                </td>
                                <td>
                                    <?php
                                        if($data_status['jns_aju_agr'] == 'actbud'){
                                    ?>
                                            ACT/<?= $data_status['kd_act']; ?>
                                    <?php
                                        }else{
                                    ?>
                                            PTY/<?= $data_status['kd_act']; ?>
                                    <?php
                                        }
                                    ?>
                                </td>
                                <td>
                                    <?= $data_status['nama_kegiatan']; ?>
                                </td>
                                <td>
                                    <a href="<?= base_url('app/sim-spa/admin/rkat/laporan-pencairan/') . $data_status['kd_act']; ?>" target="_blank">
                                        <?= $data_status['deskrip_keg']; ?>
                                    </a>
                                </td>
                                <td align="right">
                                    <?php
                                        if($data_status['fnl_agr'] != ""){
                                            echo number_format($data_status['fnl_agr'],0,',','.');
                                        } else {
                                            echo $data_status['fnl_agr'];
                                        }
                                    ?>
                                </td>
                                <td>
                                    <?= $data_status['tahun']; ?> (<?= $data_status['periode']; ?>)
                                </td>
                                <td align="center">
                                    <strong>
                                        <?= $data_status['kode_pencairan']?>
                                    </strong>
                                    <br>
                                    <?= $data_status['jns_aju_agr']?>
                                    <br>
                                    <?= $data_status['nama_lengkap']?>
                                </td>
                                <td>
                                    <center>
                                        <strong>
                                            <?= $data_status['st_kabag']; ?>
                                        </strong>
                                        <br>
                                        <?= $data_status['stamp_kabag']; ?>
                                    </center>
                                </td>
                                <td>
                                    <center>
                                        <strong>
                                            <?= $data_status['st_ftd']; ?>
                                        </strong> 
                                        <br>
                                        <?= $data_status['stamp_ftd']; ?>
                                        <br>
                                        <strong>
                                            <?= $data_status['st_fhb']; ?>
                                        </strong>
                                        <br>
                                        <?= $data_status['stamp_fhb']; ?> 
                                    </center>        
                                </td>
                                <td>
                                    <center>
                                        <strong>
                                            <?= $data_status['st_hrd'];?> 
                                            <?= $data_status['st_umum'];?>
                                            <?= $data_status['st_ict'];?>
                                            <?= $data_status['st_bkal'];?>
                                            <?= $data_status['st_p2m'];?>
                                        </strong>
                                        <br>
                                        <?= $data_status['stamp_hrd']; ?>
                                        <?= $data_status['stamp_umum']; ?>
                                        <?= $data_status['stamp_ict']; ?>
                                        <?= $data_status['stamp_bkal']; ?>
                                        <?= $data_status['stamp_p2m']; ?>
                                    </center>
                                </td>
                                <td>
                                    <center>
                                        <strong>
                                            <?= $data_status['st_keu']; ?>
                                        </strong>
                                        <br>
                                        <?= $data_status['stamp_keu']; ?>
                                    </center>
                                </td>
                                <td>
                                    <center>
                                        <strong>
                                            <?= $data_status['st_warek_1']; ?>
                                        </strong>
                                        <br>
                                        <?= $data_status['stamp_warek1'];?>
                                        <br>
                                        <strong>
                                            <?= $data_status['st_warek_2']; ?>
                                        </strong>
                                        <br>
                                        <?= $data_status['stamp_warek2']; ?>
                                    </center>
                                </td>
                                <td>
                                    <center>
                                        <strong>
                                            <?= $data_status['st_rek']; ?>
                                        </strong>
                                        <br>
                                        <?= $data_status['stamp_rek']; ?>
                                    </center>
                                </td>
                                <td>
                                    <center>
                                        <strong>
                                            <?= $data_status['st_pres']; ?>
                                        </strong>
                                        <br>
                                        <?= $data_status['stamp_pres']; ?>
                                    </center>
                                </td>
                                <td>
                                    <center>
                                    <?php
                                        if (($data_status['st_rek'] == 'Disetujui' AND $data_status['fnl_agr'] < 10000000) OR ($data_status['st_rek'] == 'Disetujui' AND $data_status['st_pres'] == 'Disetujui')){
                                    ?>
                                            <a target="_blank" href="<?= base_url('app/sim-spa/admin/rkat/laporan-pencairan/cetak-actbud/') . $data_status['kd_act']; ?>">Cetak</a>
                                    <?php
                                        } else if (($data_status['jns_aju_agr'] == 'petty cash' AND $data_status['st_keu'] == 'Disetujui')){
                                    ?>
                                            <a target="_blank" href="<?= base_url('app/sim-spa/admin/rkat/laporan-pencairan/cetak-petty-cash/') . $data_status['kd_act']; ?>">Cetak</a>
                                    <?php 
                                        }
                                    ?>
                                    </center>
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
        $("#table-laporan-pencairan-rkat").DataTable({
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
<?php echo $__env->make('spa.layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\upj_spa_ig\application\views/spa/admin/rkat/laporan-pencairan.blade.php ENDPATH**/ ?>