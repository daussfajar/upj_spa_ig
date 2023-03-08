<?php 
$session = $CI->session->userdata('user_sessions');
$year = date('Y');
?>


<?php $__env->startSection('title'); ?>
    Anggaran - Pengalihan
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-title'); ?>
    Pengalihan Anggaran <?= $year ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="<?php echo e(base_url('assets/css/dataTables.bootstrap4.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(base_url('assets/css/responsive.bootstrap4.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(base_url('assets/css/select2.min.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item">Anggaran</li>
<li class="breadcrumb-item active">Pengalihan</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            Data Pengalihan Anggaran <?= $year ?>
        </div>
        <div class="card-body">
            <button data-target="#modal-pengalihan-anggaran" data-toggle="modal" class="btn btn-success"><i class="mdi mdi-plus"></i> Input Pengalihan Anggaran</button>
            <div class="table-responsive my-4">
                <table class="table table-striped table-bordered table-hover" id="table-pengalihan-anggaran" style="width:100%;">
                    <thead>
                        <tr>
                            <th rowspan="2" style="vertical-align:middle;"><center>ID</center></th>
                            <th rowspan="2" style="vertical-align:middle;"><center>Pengaju / PIC</center></th>
                            <th rowspan="2" style="vertical-align:middle;"><center>Alasan</center></th>
                            <th colspan="2" width="4%"><center>Pengalihan Asal</center></th>
                            <th colspan="2" width="4%"><center>Pengalihan Tujuan</center></th>
                            <th rowspan="2" width="4%" style="vertical-align:middle;"><center>Nominal Pengalihan</center></th>
                            <th rowspan="2" width="2%" style="vertical-align:middle;"><center>Status</center></th>
                        </tr>
                        <tr>
                            <th><center>Kode Pencairan Asal</center></th>
                            <th><center>Saldo Sebelum Pengalihan</center></th>
                            <th><center>Kode Pencairan Tujuan</center></th>
                            <th><center>Saldo Sebelum Pengalihan</center></th>
                        </tr>
                    </thead>
                    <tbody id="tbody-table-pengalihan-anggaran">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php echo form_open('app/sim-spa/anggaran/pengalihan/tambah', array('class' => 'myForm')); ?>

    <div id="modal-pengalihan-anggaran" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0">Form Pengalihan Anggaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>                
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Kode Pencairan Asal</label>
                        <select name="kd_uraian_f" id="kode_pencairan_asal" class="form-control select2-kode-pencairan-asal" style="width:100%;" required>
                            <option value=""></option>
                            <?php $__currentLoopData = $uraian; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($key['kode_uraian']); ?>"><?php echo e($key['kode_pencairan']); ?> (Periode: <?php echo e($key['periode']); ?>)</option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Kode Pencairan Tujuan</label>
                        <select name="kd_uraian_t" id="kode_pencairan_tujuan" class="form-control select2-kode-pencairan-tujuan" style="width:100%;" required>
                            <option value=""></option>
                            <?php $__currentLoopData = $uraian; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($key['kode_uraian']); ?>"><?php echo e($key['kode_pencairan']); ?> (Periode: <?php echo e($key['periode']); ?>)</option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">PIC</label>
                        <select name="pengaju_pic" id="pic" class="form-control select2-pic" style="width:100%;" required>
                            <option value=""></option>
                            <?php $__currentLoopData = $karyawan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($kry['nik']); ?>"><?php echo e($kry['nama_lengkap']); ?> / <?php echo e($kry['kode_unit']); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Alasan</label>
                        <textarea class="form-control" placeholder="Silahkan masukkan alasan mengenai anggaran dialihkan..." name="alasan" rows="4" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Nominal Pencairan</label>
                        <input class="form-control" placeholder="Nominal" name="nominal" type="number" min="0" required/>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm waves-effect" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light"><i class="mdi mdi-pencil"></i> Simpan</button>
                </div>
            </div>
        </div>
    </div>
<?php echo form_close(); ?>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script src="<?php echo e(base_url('assets/js/select2.min.js')); ?>"></script>
<script src="<?php echo e(base_url('assets/js/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(base_url('assets/js/dataTables.bootstrap4.min.js')); ?>"></script>
<script src="<?php echo e(base_url('assets/js/dataTables.responsive.min.js')); ?>"></script>
<script src="<?php echo e(base_url('assets/js/responsive.bootstrap4.min.js')); ?>"></script>
<script>
    $(document).ready(function(){
        
        $(".select2-pic").select2({
            placeholder: "--Tentukan PIC--"
        })
        
        $(".select2-kode-pencairan-asal").select2({
            placeholder: "--Tentukan Kode Pencairan Asal--"
        })
        
        $(".select2-kode-pencairan-tujuan").select2({
            placeholder: "--Tentukan Kode Pencairan Tujuan--"
        })

        $("#table-pengalihan-anggaran").DataTable({
            initComplete: function() {
                var api = this.api();
                $('#table-pengalihan-anggaran_filter input')
                    .off('.DT')
                    .on('input.DT', function() {
                        api.search(this.value).draw();
                    });
            },
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
            serverSide: true,
            ajax: {
                "url": "<?php echo base_url('SPA/Anggaran/get_pengalihan_anggaran') ?>",
                "type": "POST",
                "dataType" : "json",
                "data" : {},
            },
            columns: [
                {
                    "data": "id"
                },
                {
                    "data": "nama_lengkap"
                },
                {
                    "data": "alasan"
                },
                {
                    "data": "kd_pencairan_f",
                    "class" : "text-center",
                    "render": function(data, type, row) {
                        return data + "<br>" + "<strong>Periode: " + row.periode_f + "</strong>";
                    }
                },
                {
                    "data": "saldo_f",
                    "class" : "text-center",
                    "render": function(data, type, row) {
                        return formatRupiah(data, 'Rp. ');
                    }
                },
                {
                    "data": "kd_pencairan_t",
                    "class" : "text-center",
                    "render": function(data, type, row) {
                        return data + "<br>" + "<strong>Periode: " + row.periode_t + "</strong>";
                    }
                },
                {
                    "data": "saldo_t",
                    "class" : "text-center",
                    "render": function(data, type, row) {
                        return formatRupiah(data, 'Rp. ');
                    }
                },
                {
                    "data": "nominal",
                    "class" : "text-center",
                    "render": function(data, type, row) {
                        return formatRupiah(data, 'Rp. ');
                    }
                },
                {
                    "data": "status",
                    "class" : "text-center",
                    "render": function(data, type, row) {
                        if (data == 'sukses'){
                            return `<span class="mdi mdi-check text-success" aria-hidden="true">Sukses</span>`;
                        } else if (data == 'Ditolak'){
                            return `<span class="mdi mdi-close text-danger">Ditolak</span>`;
                        } else {
                            return `<a class="text-white btn btn-primary btn-xs" href="<?= base_url('app/sim-spa/anggaran/pengalihan/') ?>${row.id}">
                                        Proses
                                    </a>`;
                        }
                    }
                },
            ],
            order: [
                [0, 'desc']
            ],
            columnDefs: [
                { "targets": 8, "orderable": false, "searchable": false }
            ],
            rowCallback: function(row, data, iDisplayIndex) {
                $('td:eq(0)', row).html();
            }
        });
    });

    /* Fungsi formatRupiah */
    function formatRupiah(angka, prefix){
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split   		= number_string.split(','),
        sisa     		= split[0].length % 3,
        rupiah     		= split[0].substr(0, sisa),
        ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if(ribuan){
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('spa.layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp_php_7\htdocs\hibah_upj\application\views/spa/anggaran/pengalihan-anggaran.blade.php ENDPATH**/ ?>