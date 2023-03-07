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
                                <td align="center" class="v-middle font-14">
                                    <?= $no++; ?>
                                </td>
                                <td class="v-middle font-14">
                                    <?php
                                        if($data_status['jns_aju_agr'] == 'actbud'){
                                    ?>
                                        <a href="<?= base_url('app/sim-spa/admin/rkat/laporan-pencairan/') . $data_status['kd_act']; ?>" target="_blank" class="badge bg-primary p-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Klik untuk melihat detail">
                                            ACT/<?= $data_status['kd_act']; ?>
                                        </a>
                                    <?php
                                        }else{
                                    ?>
                                        <a href="<?= base_url('app/sim-spa/admin/rkat/laporan-pencairan/') . $data_status['kd_act']; ?>" class="badge bg-primary p-2" target="_blank" data-toggle="tooltip" data-placement="top" title="" data-original-title="Klik untuk melihat detail">
                                            PTY/<?= $data_status['kd_act']; ?>
                                        </a>
                                    <?php
                                        }
                                    ?>
                                </td>
                                <td class="v-middle nama_keg">
                                    <?php 
                                    $nama_kegiatan = $data_status['nama_kegiatan'];
                                    $p_ctn = explode(' ', $nama_kegiatan);
                                    $s_ctn = array_slice($p_ctn, 0, 5);
                                    $r_ctn = array_slice($p_ctn, 5);
                                    $t_ctn = '';
                                    $rd_more = ' <a href="javascript:void(0)" data-message="'.implode(' ', $r_ctn).'" class="btn-rd_more" 
                                    data-sp_class="el-rd_more_'.$data_status['kd_act'].'" data-sp_rd_less="el-rd_less_'.$data_status['kd_act'].'">... Read more</a>
                                    <span class="el-rd_more_'.$data_status['kd_act'].'"></span>
                                    <a href="javascript:void(0)" class="el-rd_less_'.$data_status['kd_act'].'" hidden>Read Less</a>
                                    ';
                                    if(count($p_ctn) > 5){
                                        $t_ctn .= $rd_more;
                                    }
                                    echo '<span style="font-size:14px;">'.implode(' ', $s_ctn).$t_ctn.'</span>';
                                    ?>
                                </td>
                                <td class="v-middle font-14 deskrip_keg">
                                    <?php 
                                    $deskripsi_kegiatan = $data_status['deskrip_keg'];
                                    $p_ctn = explode(' ', $deskripsi_kegiatan);
                                    $s_ctn = array_slice($p_ctn, 0, 5);
                                    $r_ctn = array_slice($p_ctn, 5);
                                    $t_ctn = '';
                                    $rd_more = ' <a href="javascript:void(0)" data-message="'.implode(' ', $r_ctn).'" class="btn-rd_more" 
                                    data-sp_class="el-rd_more_'.$data_status['kd_act'].'" data-sp_rd_less="el-rd_less_'.$data_status['kd_act'].'">... Read more</a>
                                    <span class="el-rd_more_'.$data_status['kd_act'].'"></span>
                                    <a href="javascript:void(0)" class="el-rd_less_'.$data_status['kd_act'].'" hidden>Read Less</a>
                                    ';
                                    if(count($p_ctn) > 10){
                                        $t_ctn .= $rd_more;
                                    }
                                    echo '<span style="font-size:14px;">'.implode(' ', $s_ctn).$t_ctn.'</span>';
                                    ?>
                                </td>
                                <td align="right" class="v-middle">
                                    <?php
                                        if($data_status['fnl_agr'] != ""){
                                            // echo number_format($data_status['fnl_agr'],0,',','.');
                                            echo '<span class="badge bg-secondary p-2">
                                                '.rupiah_1($data_status['fnl_agr']).'
                                            </span>';
                                        } else {
                                            echo $data_status['fnl_agr'];
                                        }
                                    ?>
                                </td>
                                <td class="v-middle">
                                    <span class="badge bg-orange p-2">
                                        <?= $data_status['tahun']; ?> (<?= $data_status['periode']; ?>)
                                    </span>
                                </td>
                                <td align="center" class="v-middle">
                                    <span class="badge bg-purple p-2">
                                        <?= $data_status['kode_pencairan']?>
                                    </span>                                    
                                    <span class="badge bg-dark p-2 mt-1">
                                        <i class="mdi mdi-checkbox-marked-circle-outline"></i> <?= ucwords($data_status['jns_aju_agr']) ?>
                                    </span>
                                    <span class="badge bg-teal p-2 mt-1">
                                        <?= ucwords($data_status['nama_lengkap']) ?>
                                    </span>                                    
                                </td>
                                <td class="v-middle text-center">
                                    <?php 
                                    if($data_status['st_kabag'] != ""){
                                        $stamp_kabag = date_create($data_status['stamp_kabag']);
                                        $ex_stamp = explode(' ', $data_status['stamp_kabag']);
                                        switch ($data_status['st_kabag']) {
                                            case 'Disetujui':
                                                echo '
                                                <span class="badge bg-success p-2">
                                                    <i class="mdi mdi-check-bold"></i> '.$data_status['st_kabag'].'
                                                </span>                                                
                                                ';
                                                echo '<br>';
                                                echo '<small>'.tanggal_indo(date_format($stamp_kabag, "Y-m-d")).', '.$ex_stamp[1].'</small>';
                                                break;
                                            case 'Submit':
                                                echo '
                                                <span class="badge bg-info p-2">
                                                    <i class="mdi mdi-check-bold"></i> Menunggu Approval
                                                </span>                                                
                                                ';
                                                echo '<br>';
                                                echo '<small>'.tanggal_indo(date_format($stamp_kabag, "Y-m-d")).', '.$ex_stamp[1].'</small>';
                                                break;
                                            case 'Ditolak':
                                                echo '
                                                <span class="badge bg-danger p-2">
                                                    <i class="mdi mdi-close"></i> '.$data_status['st_kabag'].'
                                                </span>
                                                ';
                                                echo '<br>';
                                                echo '<small>'.tanggal_indo(date_format($stamp_kabag, "Y-m-d")).', '.$ex_stamp[1].'</small>';
                                                break;
                                            default:
                                                echo '<span class="badge bg-danger p-2">
                                                    Unknown
                                                    </span>';
                                                break;
                                        }
                                    } else {
                                        echo "-";
                                    }
                                    ?>
                                </td>
                                <td class="v-middle font-14 text-center">
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
                                <td class="v-middle font-14 text-center">
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
                                <td class="v-middle font-14 text-center">
                                    <center>
                                        <strong>
                                            <?= $data_status['st_keu']; ?>
                                        </strong>
                                        <br>
                                        <?= $data_status['stamp_keu']; ?>
                                    </center>
                                </td>
                                <td class="v-middle font-14 text-center">
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
                                <td class="v-middle font-14 text-center">
                                    <center>
                                        <strong>
                                            <?= $data_status['st_rek']; ?>
                                        </strong>
                                        <br>
                                        <?= $data_status['stamp_rek']; ?>
                                    </center>
                                </td>
                                <td class="v-middle font-14 text-center">
                                    <center>
                                        <strong>
                                            <?= $data_status['st_pres']; ?>
                                        </strong>
                                        <br>
                                        <?= $data_status['stamp_pres']; ?>
                                    </center>
                                </td>
                                <td class="v-middle font-14 text-center">
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

        $('#table-laporan-pencairan-rkat td.nama_keg').on('click', '.btn-rd_more', function(e){
            const data = {
                message: $(this).data('message'),
                el_rd_more: $(this).data('sp_class'),
                el_rd_less: $(this).data('sp_rd_less')
            }

            $(this).attr('hidden', true)
            $('td.nama_keg span.' + data.el_rd_more).text(data.message)
            $('td.nama_keg a.' + data.el_rd_less).removeAttr('hidden')
            $('td.nama_keg a.' + data.el_rd_less).on('click', function(){
                $('td.nama_keg span.' + data.el_rd_more).text('')
                $(this).attr('hidden', true)  
                $(this).parent().find('.btn-rd_more').removeAttr('hidden')
            })
            e.preventDefault()
        })

        $('#table-laporan-pencairan-rkat td.deskrip_keg').on('click', '.btn-rd_more', function(e){
            const data = {
                message: $(this).data('message'),
                el_rd_more: $(this).data('sp_class'),
                el_rd_less: $(this).data('sp_rd_less')
            }

            $(this).attr('hidden', true)
            $('td.deskrip_keg span.' + data.el_rd_more).text(data.message)
            $('td.deskrip_keg a.' + data.el_rd_less).removeAttr('hidden')
            $('td.deskrip_keg a.' + data.el_rd_less).on('click', function(){
                $('td.deskrip_keg span.' + data.el_rd_more).text('')
                $(this).attr('hidden', true)  
                $(this).parent().find('.btn-rd_more').removeAttr('hidden')
            })
            e.preventDefault()
        })
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('spa.layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp_php_7\htdocs\hibah_upj\application\views/spa/admin/rkat/laporan-pencairan.blade.php ENDPATH**/ ?>