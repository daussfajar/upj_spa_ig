<?php 
$session = $CI->session->userdata('user_sessions');
?>


<?php $__env->startSection('title'); ?>
    RKAT - Ubah PIC Pada RKAT Investasi
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-title'); ?>
    Perubahan PIC Pada RKAT
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="<?php echo e(base_url('assets/css/dataTables.bootstrap4.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(base_url('assets/css/responsive.bootstrap4.min.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item">Investasi</li>
<li class="breadcrumb-item active">Ubah PIC</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            PIC RKAT
        </div>
        <div class="card-body">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('app/sim-spa/rkat/pic/program-kerja') ?>">Program Kerja</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('app/sim-spa/rkat/pic/operasional') ?>">Operasional</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="<?= base_url('app/sim-spa/rkat/pic/investasi') ?>">Investasi</a>
                </li>
            </ul>
            <div class="table-responsive my-4">
                <table class="table table-striped table-bordered table-hover" id="table-pic-rkat-investasi">
                    <thead>
                        <tr>
                            <th>Kode Pencairan</th>
                            <th>Uraian dan Tujuan Kegiatan</th>
                            <th>PIC</th>
                            <th>Periode</th>
                            <th>Sisa Anggaran</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tbody-pic-rkat-investasi">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php echo form_open('app/sim-spa/rkat/ubah-pic', array('class' => 'myForm')); ?>

    <div id="modal-ubah-pic" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0">Perubahan PIC Pada RKAT</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>                
                <div class="modal-body">
                    <input type="hidden" name="kode" value="">
                    <div class="form-group">
                        <label for="">PIC</label>
                        <select name="pic" id="pic" class="form-control" required>
                            <?php $__currentLoopData = $karyawan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($kry['nik']); ?>"><?php echo e($kry['nama_lengkap']); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
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
<script src="<?php echo e(base_url('assets/js/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(base_url('assets/js/dataTables.bootstrap4.min.js')); ?>"></script>
<script src="<?php echo e(base_url('assets/js/dataTables.responsive.min.js')); ?>"></script>
<script src="<?php echo e(base_url('assets/js/responsive.bootstrap4.min.js')); ?>"></script>
<script>
    $(document).ready(function(){
        $('#tbody-pic-rkat-investasi').on('click', '.btn-edit', function(){
            var kode_uraian = $(this).data('kode-uraian');
            var pic = $(this).data('pic');
            $('#modal-ubah-pic input[name="kode"]').val(kode_uraian);
            $('#modal-ubah-pic select[name="pic"]').val(pic).trigger('change');
            $('#modal-ubah-pic').modal('show');
        });

        $("#table-pic-rkat-investasi").DataTable({
            initComplete: function() {
                var api = this.api();
                $('#table-pic-rkat-investasi_filter input')
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
                "url": "<?php echo base_url('SPA/RKAT/get_pic_rkat_investasi') ?>",
                "type": "POST",
                "dataType" : "json",
                "data" : {
                    'kode-rkat': '<?= $kode_rkat_master ?>',
                    'periode': '<?= $periode ?>'
                },
            },
            columns: [
                {
                    "data": "kode_pencairan"
                },
                {
                    "data": "uraian"
                },
                {
                    "data": "nama_lengkap"
                },
                {
                    "data": "periode"
                },
                {
                    "data": "sisa_anggaran",
                    "class" : "text-center",
                    "render": function(data, type, row) {
                        return formatRupiah(data, 'Rp. ');
                    }
                },
                {
                    "data": "kode_uraian",
                    "class" : "text-center",
                    "render": function(data, type, row) {
                            return `<div class="btn-group text-center" >
                                        <button class="text-white btn btn-primary btn-xs btn-edit"
                                            data-kode-uraian="${ row.kode_uraian }" 
                                            data-pic="${ row.pic }"> Ubah PIC 
                                        </button>
                                    </div>`;
                    }
                },
            ],
            order: [
                [0, 'desc']
            ],
            columnDefs: [
                { "targets": 0, "searchable": true },
                { "targets": 1, "searchable": true },
                { "targets": 2, "searchable": true },
                { "targets": 3, "searchable": false },
                { "targets": 4, "searchable": false },
                { "targets": 5, "orderable": false, "searchable": false }
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
<?php echo $__env->make('spa.layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp_php_7\htdocs\hibah_upj\application\views/spa/rkat/ubah-pic-investasi.blade.php ENDPATH**/ ?>