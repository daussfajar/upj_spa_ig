<?php
$session = $CI->session->userdata('user_sessions');
//pr($data);
?>


<?php $__env->startSection('title'); ?>
    <?= MOD2 ?> Pencairan RKAT - Input Acbud - <?php echo e($data['uraian']); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-title'); ?>
    <a href="<?php echo e(base_url('app/sim-spa/pencairan-rkat/input-actbud')); ?>"><i class="mdi mdi-arrow-left"></i></a> Input Actbud
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="<?php echo e(base_url('assets/css/select2.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(base_url('assets/css/daterangepicker.css')); ?>">
<link rel="stylesheet" href="<?php echo e(base_url('assets/css/bootstrap-datepicker.min.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item"><a href="javascript: void(0);">Pencairan RKAT</a></li>
<li class="breadcrumb-item"><a href="javascript: void(0);">Actbud</a></li>
<li class="breadcrumb-item"><a href="javascript: void(0);">Input Actbud</a></li>
<li class="breadcrumb-item active"><a href="javascript: void(0);"><?php echo e($data['kode_pencairan']); ?></a></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php if($data['sisa_anggaran'] != 0){ ?>
    <?php echo form_open(base_url('app/sim-spa/pencairan-rkat/input-actbud/' . $id), array('class' => 'myForm')); ?>

    <?php } ?>    
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="card-title mb-0">Rincian RKAT</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Prodi / Bagian / Unit :</label>
                            <p class="form-control-static">
                                <span class="badge bg-teal p-2">
                                    <?php echo e($data['nama_unit']); ?>

                                </span>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">PIC :</label>
                            <p class="form-control-static">
                                <span class="badge bg-info p-2">
                                    <?php echo e($data['nama_lengkap']); ?>

                                </span>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Kode Pencairan :</label>
                            <p class="form-control-static">
                                <?php if($data['kpi'] == "") { 
                                    echo '-';
                                } else { ?>
                                <span class="badge bg-dark p-2">
                                    <?= $data['kode_pencairan'] ?>
                                </span>
                                <?php } ?>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Sisa Anggaran :</label>
                            <p class="form-control-static">
                                <span class="badge bg-primary p-2">
                                    <?= rupiah_1($data['sisa_anggaran']) ?>
                                </span>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">No Borang Kegiatan :</label>
                            <p class="form-control-static">
                                <?php if($data['no_borang'] == "") { 
                                    echo '-';
                                    ?>
                                <?php } else { ?>
                                <span class="badge bg-teal p-2">
                                    <?php echo e($data['no_borang']); ?>

                                </span>
                                <?php } ?>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Uraian Kegiatan RKAT :</label>
                            <p class="form-control-static" style="font-size:14px;"><?php echo e($data['uraian']); ?></p>
                        </div>                    
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">KPI yang Dicapai :</label>
                            <p class="form-control-static" style="font-size:14px;">
                                <?php if($data['kpi'] == "") { 
                                    echo '-';
                                } else {
                                    echo $data['kpi'];
                                } ?>
                            </p>
                        </div>                    
                    </div>                        
                </div>
                <?php if($data['sisa_anggaran'] != 0){ ?>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Nama Kegiatan :</label>
                            <textarea name="deskripsi_kegiatan" id="deskripsi_kegiatan" cols="3" rows="3" class="form-control" required></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Pelaksana Kegiatan :</label>
                            <select name="pelaksana_kegiatan" id="pelaksana_kegiatan" class="form-control select2" required>
                                <option value=""></option>
                                <?php $__currentLoopData = $karyawan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e(encrypt($item['nik'])); ?>"><?php echo e($item['nama_lengkap']); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group row">
                            <label class="col-lg-2 control-label " for="address2">Tanggal Kegiatan *</label>
                            <div class="col-lg-10">
                                <span class="help-block"><small>Tentukan tanggal pelaksanaan kegiatan.</small></span>
                                <div>
                                    <div class="input-daterange input-group date-range">
                                        <input type="text" class="form-control" name="tgl_mulai" autocomplete="off" required />
                                        <div class="input-group-append">
                                            <span class="input-group-text bg-primary text-white b-0">s/d</span>
                                        </div>
                                        <input type="text" class="form-control" name="tgl_selesai" autocomplete="off" required />
                                    </div>                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
            <div class="card-footer bg-transparent">
                <button type="<?= $data['sisa_anggaran'] == 0 ? 'button' : 'submit' ?>" class="btn btn-primary btn-block" style="font-weight:bold;"<?= $data['sisa_anggaran'] == 0 ? ' disabled title="Maaf anggaran sudah habis"' : '' ?>><i class="mdi mdi-file-plus"></i> Input Actbud</button>
            </div>
        </div>
    </div>
    <?php if($data['sisa_anggaran'] != 0){ ?>
    <?php echo form_close(); ?>

    <?php } ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script src="<?php echo e(base_url('assets/js/select2.min.js')); ?>"></script>
<script src="<?php echo e(base_url('assets/js/bootstrap-datepicker.min.js')); ?>"></script>
<script src="<?php echo e(base_url('assets/js/daterangepicker.js')); ?>"></script>
<script>
    $(document).ready(function(){
        $('.date-range').datepicker({
            toggleActive:!0,
            format: 'dd-mm-yyyy',
            startDate: "<?= date('d-m-Y') ?>",
        })

        $('.select2').select2({
            placeholder: "Cari pelaksana ..."
        })
    })
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('spa.layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp_php_7\htdocs\hibah_upj\application\views/spa/pencairan_rkat/actbud/v_proses_input_actbud.blade.php ENDPATH**/ ?>