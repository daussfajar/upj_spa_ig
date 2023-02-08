

<?php $__env->startSection('title', 'Kredit Saldo'); ?>

<?php $__env->startSection('page-title'); ?>
    Kredit Saldo
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="<?php echo e(base_url('assets/css/dataTables.bootstrap4.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(base_url('assets/css/responsive.bootstrap4.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(base_url('assets/css/jquery-ui.custom-for-signature.css')); ?>">
<link rel="stylesheet" href="<?php echo e(base_url('assets/css/jquery.signature.css')); ?>">
<link rel="stylesheet" href="<?php echo e(base_url('assets/css/select2.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(base_url('assets/css/bootstrap-select.min.css')); ?>">
<style>
    .kbw-signature { width: 300px; height: 300px;}
    #ttd canvas{
        width: 100% !important;
        height: auto;
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item active"><a href="javascript: void(0);">Kredit Saldo</a></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="col-md-12">
    <div class="float-right">
        <a href="javascript:void(0)" data-toggle="modal" data-target="#modal-upload-saldo" class="btn btn-sm btn-info mr-1"><i class="mdi mdi-upload"></i> Upload</a>
        <a href="<?php echo e(base_url('app/kredit_saldo/buat_kredit')); ?>" class="btn btn-success btn-sm"><i class="mdi mdi-plus"></i> Buat Kredit Saldo</a>
    </div>
    <div class="card card-border card-primary mt-5">
        <div class="card-header border-primary bg-transparent">
            <h3 class="card-title text-primary mb-0">Data Kredit Saldo</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered dataTable">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th class="text-center" style="vertical-align: middle;">No</th>
                            <th style="vertical-align: middle;">PIC</th>
                            <th style="vertical-align: middle;">Kode Uraian</th>
                            <th style="vertical-align: middle;">Nama Kegiatan</th>
                            <th style="vertical-align: middle;" class="text-center">Jenis Kredit</th>
                            <th style="vertical-align: middle;" class="text-center">Nominal</th>
                            <th style="vertical-align: middle;" class="text-center">File Pendukung</th>
                            <th style="vertical-align: middle;">Keterangan</th>
                            <th style="vertical-align: middle;" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tb-kredit">
                        <?php $__currentLoopData = $kegiatan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <th style="vertical-align: middle;" class="text-center"><?php echo e($loop->iteration); ?></th>
                                <th style="vertical-align: middle;">
                                    <a href="javascript:void(0)" class="badge bg-info text-white">
                                        <?php echo e($item->nama_lengkap == '' ? 'Belum ditentukan' : $item->nama_lengkap); ?> <?php echo e($item->nama_unit == '' ? '' : '('.$item->nama_unit.')'); ?>

                                    </a>
                                </th>
                                <td style="vertical-align: middle;">
                                    <span class="badge bg-purple">
                                        <?php echo e($item->kode_uraian); ?>

                                    </span>
                                </td>
                                <td style="vertical-align: middle;">
                                    <span style="font-size: 14px;">
                                        <b><?php echo e($item->nama_hibah_sponsorship); ?></b>
                                        <hr class="mt-1 mb-1">
                                        <?php echo e($item->uraian_kegiatan); ?>

                                    </span>
                                </td>
                                <td style="vertical-align: middle;" class="text-center">
                                    <?php if($item->jenis_kredit == 'in'): ?>
                                        <a href="javascript:void(0)" class="badge bg-success text-white">Saldo Masuk</a>
                                    <?php else: ?>
                                        <a href="javascript:void(0)" class="badge bg-warning text-white">Saldo Keluar</a>
                                    <?php endif; ?>
                                </td>
                                <td style="vertical-align: middle;" class="text-center">
                                    <span class="badge bg-primary">
                                        <?php echo e(rupiah($item->nominal)); ?>

                                    </span>
                                </td>
                                <td style="vertical-align: middle;" class="text-center">
                                    <?php if($item->file_pendukung != ""): ?>
                                        <a href="<?php echo e(base_url('app-data/kredit-saldo/attachment/' . $item->file_pendukung)); ?>" download="<?php echo e($item->kode_uraian . ' - ' . $item->nama_hibah_sponsorship . ' ' . $item->nama_lengkap); ?>" class="btn btn-xs btn-secondary"><i class="mdi mdi-download"></i> Download</a>
                                    <?php else: ?>
                                        -
                                    <?php endif; ?>
                                </td>
                                <td style="vertical-align: middle;">
                                    <span style="font-size: 14px;">
                                        <?php echo e($item->keterangan); ?>

                                    </span>
                                </td>
                                <td style="vertical-align: middle;" class="text-center">
                                    <?php if($item->disetujui == 'N'): ?>
                                        <a href="javascript:void(0)" data-id="<?php echo e(encrypt($item->id)); ?>" 
                                            data-kode_uraian="<?php echo e($item->kode_uraian); ?>" data-nama_kegiatan="<?php echo e($item->nama_hibah_sponsorship); ?>" 
                                            class="btn btn-xs btn-danger btn-hapus col-12">Hapus</a>
                                        <a href="javascript:void(0)" data-id="<?php echo e(encrypt($item->id)); ?>" 
                                            data-kode_uraian="<?php echo e($item->kode_uraian); ?>" data-nama_kegiatan="<?php echo e($item->nama_hibah_sponsorship); ?>" 
                                            class="btn btn-xs btn-primary mt-1 btn-finalisasi col-12">Finalisasi</a>
                                    <?php else: ?>
                                        <a href="javascript:void(0)" title="Disetujui: <?php echo e($item->disetujui_stamp); ?>" class="btn btn-xs btn-success"><i class="mdi mdi-check"></i></a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php echo form_open('app/kredit_saldo/batalkan_kredit'); ?>

<div id="modal-hapus-kredit" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Batalkan Kredit Saldo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">   
                <input type="hidden" name="id">
                <input type="hidden" name="kode_uraian">
                <input type="hidden" name="nama_hibah_sponsorship">
                <p class="mb-0">Apakah anda yakin ingin membatalkan kredit saldo <b><span class="detail"></span></b>?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm waves-effect" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-danger btn-sm waves-effect waves-light">Ya, Hapus & Batalkan</button>
            </div>
        </div>        
    </div>    
</div>
<?php echo form_close(); ?>


<?php echo form_open('app/kredit_saldo/finalisasi_kredit'); ?>

<div id="modal-finalisasi-kredit" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Finalisasi Kredit Saldo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">   
                <input type="hidden" name="id">
                <input type="hidden" name="kode_uraian">
                <input type="hidden" name="nama_hibah_sponsorship">
                <p class="mb-0">Apakah anda yakin ingin melakukan Finalisasi kredit saldo <b><span class="detail"></span></b>?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm waves-effect" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light">Ya, Finalisasikan Kredit</button>
            </div>
        </div>        
    </div>    
</div>
<?php echo form_close(); ?>


<?php echo form_open('app/kredit_saldo/preview_upload', array('enctype' => 'multipart/form-data')); ?>

<div id="modal-upload-saldo" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Upload Kredit Saldo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">   
                <div class="alert alert-info mb-2">
					<p class="mb-0">Sebelum upload, mohon periksa terlebih dahulu dan pastikan bahwa anda sudah
						mengikuti format excel yang sudah ditentukan.</p>
				</div>
				<a href="<?= base_url('app-data/template-excel/Template upload kredit saldo (Hibah & Sponsorship) - Final.xlsx') ?>"
					download="Template upload kredit saldo (Hibah & Sponsorship) - Final" class="btn btn-success btn-sm"><i
						class="mdi mdi-download"></i> Download Template</a>
				<input type="hidden" name="file_upload" value="file_upload_excel">
                <div class="form-group mb-0 mt-3">
					<label for="">File</label>
					<input type="file" name="file" id="file" class="filestyle" required>
					<span class="help-block"><small>Allowed extension: .xlsx</small></span>
				</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm waves-effect" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light">Upload</button>
            </div>
        </div>        
    </div>    
</div>
<?php echo form_close(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script src="<?php echo e(base_url('assets/js/select2.min.js')); ?>"></script>
<script src="<?php echo e(base_url('assets/js/bootstrap-select.min.js')); ?>"></script>

<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="<?php echo e(base_url('assets/js/jquery.signature.min.js')); ?>"></script>
<script src="<?php echo e(base_url('assets/js/jquery.ui.touch-punch.min.js')); ?>"></script>

<script src="<?php echo e(base_url('assets/js/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(base_url('assets/js/dataTables.bootstrap4.min.js')); ?>"></script>
<script src="<?php echo e(base_url('assets/js/dataTables.responsive.min.js')); ?>"></script>
<script src="<?php echo e(base_url('assets/js/responsive.bootstrap4.min.js')); ?>"></script>

<script src="<?php echo e(base_url('assets/js/jquery.steps.min.js')); ?>"></script>
<script src="<?php echo e(base_url('assets/js/jquery.validate.min.js')); ?>"></script>
<script src="<?php echo e(base_url('assets/js/form-wizard.init.js')); ?>"></script>
<script src="<?php echo e(base_url('assets/js/bootstrap-filestyle.min.js')); ?>"></script>
<script>
    $(document).ready(function(){
        $('.dataTable').dataTable({
            stateSave: true
        })

        $('#tb-kredit').on('click', '.btn-hapus', function(){
            const data = {
                id: $(this).data('id'),
                nama_hibah_sponsorship: $(this).data('nama_kegiatan'),
                kode_uraian: $(this).data('kode_uraian')
            }
            $('#modal-hapus-kredit input[name="id"]').val(data.id)
            $('#modal-hapus-kredit input[name="nama_hibah_sponsorship"]').val(data.nama_hibah_sponsorship)
            $('#modal-hapus-kredit input[name="kode_uraian"]').val(data.kode_uraian)
            $('#modal-hapus-kredit span.detail').text(data.kode_uraian + ' - ' + data.nama_hibah_sponsorship)
            $('#modal-hapus-kredit').modal('show')
        })

        $('#tb-kredit').on('click', '.btn-finalisasi', function(){
            const data = {
                id: $(this).data('id'),
                nama_hibah_sponsorship: $(this).data('nama_kegiatan'),
                kode_uraian: $(this).data('kode_uraian')
            }
            $('#modal-finalisasi-kredit input[name="id"]').val(data.id)
            $('#modal-finalisasi-kredit input[name="nama_hibah_sponsorship"]').val(data.nama_hibah_sponsorship)
            $('#modal-finalisasi-kredit input[name="kode_uraian"]').val(data.kode_uraian)
            $('#modal-finalisasi-kredit span.detail').text(data.kode_uraian + ' - ' + data.nama_hibah_sponsorship)
            $('#modal-finalisasi-kredit').modal('show')
        })
    })
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\hibah_upj\application\views/users/kredit_saldo/index.blade.php ENDPATH**/ ?>