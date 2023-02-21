

<?php $__env->startSection('title', 'Pengalihan Anggaran'); ?>

<?php $__env->startSection('page-title'); ?>
    Pengalihan Anggaran
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="<?php echo e(base_url('assets/css/responsive.bootstrap4.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(base_url('assets/css/select2.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(base_url('assets/css/bootstrap-select.min.css')); ?>">
<style>
    .m-signature-pad-body{
        border: 1px dashed #ccc;
        border-radius: 5px;
        color: #bbbabb;
        height: 253px;
        width: 100%;
        text-align: center;
        float: right;
        vertical-align: middle;
        top: 73px;
        position: inline-block;
        left: 33px;
    }
    .m-signature-pad-footer{
        bottom: 250px;
        left: 218px;
        position: inline-block;
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item active"><a href="javascript: void(0);">Pengalihan Anggaran</a></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="col-md-12">    
    <div class="float-right">
        <!--<a href="javascript:void(0)" data-toggle="modal" data-target="#modal-upload-saldo" class="btn btn-sm btn-info mr-1"><i class="mdi mdi-upload"></i> Upload</a>-->
        <a href="javascript:void(0)" data-toggle="modal" data-target="#modal-input-pengalihan" class="btn btn-success btn-sm"><i class="mdi mdi-plus"></i> Input Pengalihan Anggaran</a>
    </div>
    <br><br>
    <div class="card card-border card-dark">
        <div class="card-header border-dark bg-transparent">
            <h3 class="card-title text-dark mb-0">Data Pengalihan Anggaran</h3>
        </div>
        <div class="card-body">
            <div class="row mb-3">                    
                <div class="col-md-8 col-sm-8 col-xs-12">
                    <div class="float-right">
                        <a href="javascript:void(0)" onclick="return alert('Coming soon')" class="btn btn-secondary btn-sm"><i class="mdi mdi-filter"></i></a>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <form action="<?php echo e(base_url('app/sim-ig/pengalihan-anggaran')); ?>" method="GET" accept-charset="utf-8" autocomplete="off" class="myForm">
                        <div class="input-group">
                            <input type="search" id="q" value="<?php echo e(!empty($_GET['q']) ? $_GET['q'] : ''); ?>" name="q" class="form-control" placeholder="Cari data...">
                            <span class="input-group-prepend">
                                <button type="submit" class="btn waves-effect waves-light btn-primary btn-sm"><i class="mdi mdi-magnify mdi-18px"></i></button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>

            <?php if(isset($_GET['q']) && $CI->input->get('q', true) !== ""): ?>
                <?php if(empty($data_pengalihan['data'])): ?>
                <div class="col-md-12">
                    <div class="alert alert-info">
                        <p class="mb-0">Pencarian anda <b>- <?php echo e($CI->input->get('q', true)); ?> -</b> tidak ada dalam data.</p>
                        <p class="mb-0">
                            Saran:
                            <ul class="mb-0">
                                <li>Pastikan bahwa semua kata dieja dengan benar.</li>
                                <li>Coba kata kunci yang berbeda.</li>
                                <li>Coba kata kunci yang lebih umum.</li>
                            </ul>
                        </p>
                    </div>
                </div>
                <?php else: ?>
                <div class="col-md-12">
                    <div class="alert alert-info">
                        <p class="mb-0"><i class="mdi mdi-magnify"></i> Hasil pencarian dari: "<b><?php echo e($CI->input->get('q', true)); ?></b>"</p>                    
                    </div>
                </div>
                <?php endif; ?>
            <?php endif; ?>

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="bg-dark text-white">
                        <tr>
                            <th class="text-center" style="vertical-align: middle;" rowspan="2">No</th>
                            <th style="vertical-align: middle;" class="text-center" rowspan="2">Pengaju/PIC</th>
                            <th style="vertical-align: middle;" rowspan="2">Keterangan</th>
                            <th style="vertical-align: middle;" class="text-center" colspan="2">Pengalihan Asal</th>
                            <th style="vertical-align: middle;" class="text-center" colspan="2">Pengalihan Tujuan</th>
                            <th style="vertical-align: middle;" rowspan="2" class="text-center">Nominal Pengalihan</th>
                            <th style="vertical-align: middle;" rowspan="2" class="text-center">Status</th>
                        </tr>
                        <tr>
                            <th style="vertical-align: middle;" class="text-center">Kode Uraian Asal</th>
                            <th style="vertical-align: middle;" class="text-center">Saldo Sebelum Pengalihan</th>
                            <th style="vertical-align: middle;" class="text-center">Kode Uraian Tujuan</th>
                            <th style="vertical-align: middle;" class="text-center">Saldo Sebelum Pengalihan</th>
                        </tr>                        
                    </thead>
                    <tbody>                        
                        <?php if(empty($data_pengalihan['data'])): ?>
                            <tr>
                                <th class="text-center" colspan="9">
                                    Tidak ada data
                                </th>
                            </tr>
                        <?php else: ?>
                        <?php $__currentLoopData = $data_pengalihan['data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rows): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <th class="text-center" style="vertical-align:middle;font-size:14px;">
                                    <?php echo e($loop->iteration); ?>

                                </th>
                                <th style="vertical-align: middle;font-size:14px;"><?php echo e($rows['nama_pengaju']); ?></th>
                                <td style="vertical-align: middle;font-size:14px;"><?php echo e($rows['keterangan']); ?></td>
                                <td style="vertical-align: middle;font-size:14px;" class="text-center">
                                    <b><?php echo e($rows['kode_uraian']); ?></b>
                                    <hr class="mt-1 mb-1">
                                    <b>Periode : </b> <?php echo e($rows['periode']); ?>

                                </td>
                                <td style="vertical-align: middle;font-size:14px;" class="text-center">
                                </td>
                                <td style="vertical-align: middle;font-size:14px;" class="text-center">
                                    <b><?php echo e($rows['kode_uraian_out']); ?></b>
                                    <hr class="mt-1 mb-1">
                                    <b>Periode : </b> <?php echo e($rows['periode_out']); ?>

                                </td>
                                <td style="vertical-align: middle;font-size:14px;" class="text-center">
                                </td>
                                <td style="vertical-align: middle;font-size:14px;" class="text-center">
                                    <span class="badge bg-success p-2">
                                        <?php echo e(rupiah($rows['nominal'])); ?>

                                    </span>
                                </td>
                                <td style="vertical-align: middle;font-size:14px;" class="text-center">
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <span class="badge badge-info p-2">Total Data: <?php echo e($data_pengalihan['total_rows']); ?></span>
		    <?php echo $data_pengalihan['pagination']; ?>

        </div>
    </div>
</div>

<?php echo form_open(base_url('app/sim-ig/pengalihan-anggaran/buat-pengalihan?refId=' . uniqid()), array('class' => 'myForm', 'id' => 'form-pengalihan', 'enctype' => 'multipart/form-data')); ?>

<div id="modal-input-pengalihan" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Form Pengalihan Anggaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">* Kode Pencairan Asal</label>
                            <select name="kode_pencairan_asal" id="kode_pencairan_asal" class="select2 form-control" style="width:100%;" required>
                                <option value="">-- Pilih --</option>
                                <?php $__currentLoopData = $kegiatan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e(encrypt($item->kode_uraian) . '_' . encrypt($item->kode_pencairan)); ?>" data-kode_pencairan="<?php echo e($item->kode_pencairan); ?>" data-periode="<?php echo e($item->periode); ?>" data-saldo="">
                                    <?php echo e($item->kode_uraian . ' ('.$item->periode.')' . ($item->kode_pencairan != "" ? "(" . $item->kode_pencairan . ")" : "")); ?> - <?php echo e($item->nama_lengkap . ' ('.$item->nama_unit.')'); ?> - <?php echo e($item->nama_hibah_sponsorship); ?>

                                </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    <input type="hidden" name="periode" value="">
                    <input type="hidden" name="periode_out" value="">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">* Kode Pencairan Tujuan</label>
                            <select name="kode_pencairan_tujuan" id="kode_pencairan_tujuan" class="select2 form-control" style="width:100%;" required>
                                <option value="">-- Pilih --</option>
                                <?php $__currentLoopData = $kegiatan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e(encrypt($item->kode_uraian) . '_' . encrypt($item->kode_pencairan)); ?>" data-kode_pencairan="<?php echo e($item->kode_pencairan); ?>" data-periode="<?php echo e($item->periode); ?>">
                                    <?php echo e($item->kode_uraian . ' ('.$item->periode.')' . ($item->kode_pencairan != "" ? "(" . $item->kode_pencairan . ")" : "")); ?> - <?php echo e($item->nama_lengkap . ' ('.$item->nama_unit.')'); ?> - <?php echo e($item->nama_hibah_sponsorship); ?>

                                </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">* PIC/Pengaju</label>
                            <select name="pic" id="pic" class="select2 form-control" style="width:100%;" required>
                                <option value="">-- Pilih --</option>
                                <?php $__currentLoopData = $unit; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <optgroup label="<?php echo e($row['nama_unit']); ?>">
                                    <?php $__currentLoopData = $karyawan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($row['kode_unit'] == $kar['kode_unit']): ?>
                                    <option value="<?php echo e($kar['nik']); ?>"><?php echo e($kar['nama_lengkap']); ?> (<?php echo e($kar['nik']); ?>)</option>
                                    <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </optgroup>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">* Alasan</label>
                            <textarea name="alasan" id="alasan" cols="3" rows="3" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">* Anggaran</label>
                            <input type="text" name="anggaran" id="anggaran" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <label>File Pendukung (opsional)</label>
                            <input type="file" class="filestyle" name="file_pendukung" data-badge="true">
                            <span class="help-block"><small>Ketentuan: ekstensi diperbolehkan hanya pdf,docx,xlxs,pptx,png,jpeg,jpg, selain itu maksimal ukuran file adalah 2 mb.</small></span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="" class="control-label">Silakan tanda tangan: *</label>
                        <div class="signature-pad" id="signature-pad">
                            <div class="m-signature-pad">
                            <div class="m-signature-pad-body">
                                <canvas width="560" height="253"></canvas>
                            </div>
                            </div>
                            <div class="m-signature-pad-footer">
                                <button type="button" data-action="clear"  class="btn btn-danger btn-sm mt-2"><i class="mdi mdi-trash-can"></i> Bersihkan</button>                                
                            </div>
                        </div>
                        <input type="hidden" name="signature" required>
                    </div>
                    <div class="col-md-12 mt-2">
                        <div class="alert alert-info">
                            <strong>Note:</strong> (*) kolom wajib diisi, silakan lengkapi form dengan baik.
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm waves-effect" data-dismiss="modal"><i class="mdi mdi-close"></i> Tutup</button>
                <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light"><i class="mdi mdi-check"></i> Simpan</button>
            </div>
        </div>        
    </div>    
</div>
<?php echo form_close(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script src="<?php echo e(base_url('assets/js/select2.min.js')); ?>"></script>
<script src="<?php echo e(base_url('assets/js/bootstrap-select.min.js')); ?>"></script>
<script src="<?php echo e(base_url('assets/js/signature-pad.js')); ?>"></script>
<script src="<?php echo e(base_url('assets/js/bootstrap-filestyle.min.js')); ?>"></script>
<script>
    $(document).ready(function(){
        var rupiah = document.getElementById('anggaran')        

		rupiah.addEventListener('keyup', function(e){			            
			rupiah.value = formatRupiah(this.value, 'Rp. ')
		})

        $('.select2').select2()
        
        $('select[name="kode_pencairan_asal"]').change(function(){
            let selected = $(this).find('option:selected').data('periode')
            $('input[name="periode"]').val(selected)
        })

        $('select[name="kode_pencairan_tujuan"]').change(function(){
            let selected = $(this).find('option:selected').data('periode')
            $('input[name="periode_out"]').val(selected)
        })

        function formatRupiah(angka, prefix){
			var number_string = angka.replace(/[^,\d]/g, '').toString(),
			split   		= number_string.split(','),
			sisa     		= split[0].length % 3,
			rupiah     		= split[0].substr(0, sisa),
			ribuan     		= split[0].substr(sisa).match(/\d{3}/gi)
 
			if(ribuan){
				separator = sisa ? '.' : ''
				rupiah += separator + ribuan.join('.')
			}
 
			rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah
			return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '')
		}

        var wrapper = document.getElementById("signature-pad"),
        clearButton = wrapper.querySelector("[data-action=clear]"),
        saveButton = wrapper.querySelector("[data-action=save]"),
        canvas = wrapper.querySelector("canvas"),
        signaturePad


        function resizeCanvas() {
            var ratio =  window.devicePixelRatio || 1
            canvas.width = canvas.offsetWidth * ratio
            canvas.height = canvas.offsetHeight * ratio
            canvas.getContext("2d").scale(ratio, ratio)
        }

        signaturePad = new SignaturePad(canvas)
        clearButton.addEventListener("click", function (event) {
            signaturePad.clear()
        })

        $('#form-pengalihan').submit(function(){                
            $('#form-pengalihan input[name="signature"]').val(signaturePad.toDataURL())
        })

    })
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('ig.layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp_php_7\htdocs\hibah_upj\application\views/ig/users/pengalihan_anggaran/index.blade.php ENDPATH**/ ?>