

<?php $__env->startSection('title', 'Kredit Saldo - Preview Upload'); ?>

<?php $__env->startSection('page-title'); ?>
   <a href="<?php echo e(base_url('app/kredit_saldo')); ?>"><i class="mdi mdi-arrow-left"></i></a> Upload Excel
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="<?php echo e(base_url('assets/css/dataTables.bootstrap4.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(base_url('assets/css/responsive.bootstrap4.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(base_url('assets/css/jquery-ui.custom-for-signature.css')); ?>">
<link rel="stylesheet" href="<?php echo e(base_url('assets/css/jquery.signature.css')); ?>">
<link rel="stylesheet" href="<?php echo e(base_url('assets/css/select2.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(base_url('assets/css/bootstrap-select.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(base_url('assets/css/daterangepicker.css')); ?>">
<link rel="stylesheet" href="<?php echo e(base_url('assets/css/bootstrap-datepicker.min.css')); ?>">
<style>
    .kbw-signature { width: 300px; height: 300px;}
    #ttd canvas{
        width: 100% !important;
        height: auto;
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item"><a href="javascript: void(0);"><i class="mdi mdi-briefcase-outline"></i> Hibah</a></li>
<li class="breadcrumb-item active"><a href="javascript: void(0);"><i class="mdi mdi-file-upload-outline"></i> Preview Upload</a></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="col-md-12">
        <div class="card-box">            
            <h4 class="header-title"><i class="mdi mdi-microsoft-excel"></i> Preview Data</h4>            
            <div class="alert alert-danger" id='kosong'>
            Terdapat <b><span id='jumlah_kosong'></span></b> baris data yang belum lengkap! Mohon lengkapi data tersebut lalu upload kembali.
            </div>

            <?php echo form_open('app/kredit_saldo/preview_upload/upload', array('autocomplete' => 'off', 'accept-charset' => 'utf-8')); ?>

            <div class="table-responsive mt-3">
                <table class="table table-bordered">
                    <thead class="bg-purple text-white">
                        <tr>
                            <th width=50 style="vertical-align: middle" class="text-center">No</th>
                            <th style="vertical-align: middle">Kode Uraian</th>
                            <th style="vertical-align: middle">Kode Pencairan</th>
                            <th style="vertical-align: middle">Keterangan</th>
                            <th style="vertical-align: middle" class="text-center">Jenis Kredit</th>
                            <th style="vertical-align: middle" class="text-center">Nominal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $numrow = 1;
                            $kosong = 0;
                            $num = 1;
                        ?>
                        <?php $__currentLoopData = $sheet; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $kode_uraian = $row['A'];
                                $kode_pencairan = $row['B'];
                                $keterangan = $row['C'];
                                $jenis_kredit = $row['D'];
                                $nominal = $row['E'];    
                                $numrow++;                            
                            ?>

                            <?php if($numrow > 1): ?>
                                <input type="hidden" name="kode_uraian[]" value="<?php echo e($kode_uraian); ?>">
                                <input type="hidden" name="kode_pencairan[]" value="<?php echo e($kode_pencairan); ?>">
                                <input type="hidden" name="keterangan[]" value="<?php echo e($keterangan); ?>">
                                <input type="hidden" name="jenis_kredit[]" value="<?php echo e($jenis_kredit); ?>">
                                <input type="hidden" name="nominal[]" value="<?php echo e($nominal); ?>">
                                <?php
                                    $td_kode_uraian     = empty($kode_uraian) ? " style='background:#E07171;'" : "style='vertical-align:middle;'";
                                    $td_kode_pencairan  = empty($kode_pencairan) ? " style='background:#E07171;'" : "style='vertical-align:middle;'";
                                    $td_keterangan      = empty($keterangan) ? " style='background:#E07171;'" : "style='vertical-align:middle;'";
                                    $td_jenis_kredit    = empty($jenis_kredit) ? " style='background:#E07171;'" : "style='vertical-align:middle;'";
                                    $td_nominal         = empty($nominal) ? " style='background:#E07171;'" : "style='vertical-align:middle;'";

                                    if($kode_uraian == "" || $kode_pencairan == "" || $keterangan == "" || 
                                    $jenis_kredit == "" || $nominal == ""){
                                        $kosong++;
                                    }
                                ?>

                                <tr>
                                    <th class="text-center" style="vertical-align: middle"><?php echo e($num++); ?></th>
                                    <td <?php echo $td_kode_uraian; ?>><?php echo e($kode_uraian); ?></td>
                                    <td <?php echo $td_kode_pencairan; ?>><?php echo e($kode_pencairan); ?></td>
                                    <td <?php echo $td_keterangan; ?>><?php echo e($keterangan); ?></td>
                                    <td <?php echo $td_jenis_kredit; ?> class="text-center">
                                        <?php if($jenis_kredit == "in"): ?>
                                            <span class="badge bg-info">Saldo Masuk</span>
                                        <?php else: ?>
                                            <span class="badge bg-danger">Saldo Keluar</span>
                                        <?php endif; ?>
                                    </td>
                                    <td <?php echo $td_nominal; ?> class="text-center"><?php echo e(rupiah($nominal)); ?></td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
            
            <?php if($kosong == 0): ?>
                <div class="card-box">    
                    <label for="">Tanda Tangan</label><br />
                    <div id="ttd"></div>
                    <br/>
                    <button id="clear_ttd" class="btn btn-danger btn-sm"><i class="mdi mdi-trash-can-outline"></i> Hapus Tanda Tangan</button>
                    <textarea id="signature64" name="tanda_tangan" style="display: none" required></textarea>
                    <div class="float-right">
                        <a href="<?php echo e(base_url('app/kredit_saldo')); ?>" class="btn btn-danger btn-sm">Batal</a>
                        <button type="submit" class="btn btn-primary btn-sm"><i class="mdi mdi-upload"></i> Upload Data</button>                                
                    </div>                            
                    <br>
                </div>
            <?php endif; ?>

            <?php echo form_close(); ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <script src="<?php echo e(base_url('assets/js/bootstrap-datepicker.min.js')); ?>"></script>
    <script src="<?php echo e(base_url('assets/js/daterangepicker.js')); ?>"></script>
    <script src="<?php echo e(base_url('assets/js/select2.min.js')); ?>"></script>
    <script src="<?php echo e(base_url('assets/js/bootstrap-select.min.js')); ?>"></script>

    <script src="<?php echo e(base_url('assets/js/jquery.signature.min.js')); ?>"></script>
    <script src="<?php echo e(base_url('assets/js/jquery.ui.touch-punch.min.js')); ?>"></script>

    <script src="<?php echo e(base_url('assets/js/jquery.steps.min.js')); ?>"></script>
    <script src="<?php echo e(base_url('assets/js/jquery.validate.min.js')); ?>"></script>
    <script src="<?php echo e(base_url('assets/js/form-wizard.init.js')); ?>"></script>
    <script>
        $(document).ready(function(){
            var sig = $('#ttd').signature({syncField: '#signature64', syncFormat: 'PNG'});
            $('#clear_ttd').click(function(e) {
                e.preventDefault();
                sig.signature('clear');
                $("#signature64").val('');
            });

            $(".select2").select2()
            $('#kosong').hide()

            <?php if($kosong > 0): ?>
                $(document).ready(function(){
                    // Ubah isi dari tag span dengan id jumlah_kosong dengan isi dari variabel kosong
                    $("#jumlah_kosong").html('<?php echo $kosong; ?>');
                    $("#kosong").show(); // Munculkan alert validasi kosong
                });
            <?php endif; ?>
        })
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\hibah_upj\application\views/users/kredit_saldo/preview_upload_kredit.blade.php ENDPATH**/ ?>