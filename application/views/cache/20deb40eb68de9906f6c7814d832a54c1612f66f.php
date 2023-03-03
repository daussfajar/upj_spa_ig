<?php
$session = $CI->session->userdata('user_sessions'); 
$nama_lengkap = $session['nama_lengkap'];
$nik = decrypt($session['nik']);
?>


<?php $__env->startSection('title'); ?>
    <?= MOD2 ?> Pencairan RKAT - Status Petty Cash
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-title'); ?>
    Status Persetujuan Petty Cash
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="javascript: void(0);">Pencairan RKAT</a></li>
    <li class="breadcrumb-item"><a href="javascript: void(0);">Petty Cash</a></li>
    <li class="breadcrumb-item active"><a href="javascript: void(0);">Status Petty Cash</a></li>
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

<?php $__env->startSection('content'); ?>
    <div class="col-md-12">
        <div class="card mt-2">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <b>
                        PIC :
                        <span class="badge bg-info p-2">
                            <i class="mdi mdi-account"></i> <?= $nama_lengkap ?>
                        </span>
                    </b>
                </h5>
            </div>            
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="table-actbud">
                        <thead class="bg-purple text-white text-center">
                            <tr>
                                <th width="50" style="vertical-align: middle">No</th>
                                <th style="vertical-align: middle">No Dokumen</th>
                                <th style="vertical-align: middle">Kode Pencairan</th>
                                <th style="vertical-align: middle">Nama Kegiatan</th>
                                <th class="text-center" style="vertical-align: middle">
                                    Anggaran
                                </th>
                                <th style="vertical-align: middle">Status Approval</th>
                                <th style="vertical-align: middle">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tbody-table-actbud"></tbody>
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
        let base_url = "<?= base_url() ?>"
        $("#table-actbud").DataTable({
            initComplete: function() {
                var api = this.api();
                $('#table-actbud_filter input')
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
            // responsive: true,
            ajax: {
                "url": "<?php echo base_url('SPA/PencairanRKAT/get_actbud_by_nik') ?>",
                "type": "POST",
                "dataType" : "json",
                "data" : {
                    'pic': '<?= $nik ?>',
                    'jenis': 'petty cash'
                },
            },
            columns: [
                {
                    "data": "kd_act",
                    "class": "text-center v-middle font-14",
                    "sortable": false, 
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }  
                },
                {
                    "data": "kd_act",
                    "class": "v-middle",
                    render: function(data, type, row){
                        return '<span class="badge bg-primary p-2">' + 'ACT/' + data + '</span>'
                    }
                },
                {
                    "data": "kode_pencairan",
                    "class": "v-middle",
                    render: function(data, type, row){
                        return '<span class="badge bg-purple p-2">'+ data + '</span>'
                    }
                },
                {
                    "data": "nama_kegiatan",
                    "class": "v-middle font-14",
                    "render": function (data, type, row) {
                        return row.nama_kegiatan + `
                        <hr class="mt-1 mb-2">
                        <span class="badge bg-secondary p-2" style="font-size:12px;">
                            <i class="mdi mdi-calendar"></i>  `+row.tgl_m+` s/d `+row.tgl_s+`
                        </span>
                        `
                    }
                },
                {
                    "data": "agr",
                    "class": "v-middle",
                    "render": function (data, type, row) {
                        return '<span class="badge bg-success p-2">'+formatRupiah(data, 'Rp. ')+'</span>'
                    }
                },
                {
                    "data": "kode_uraian",
                    "class": "v-middle text-center",
                    "render": function (data, type, row) {
                        return '<a href="'+base_url+'app/sim-spa/pencairan-rkat/petty-cash/status-petty-cash/'+row.kode_uraian+'/'+row.kd_act+'" class="badge bg-info p-2">Lihat</a>'
                    }
                },
                {
                    "data": "kd_act",
                    "class": "v-middle text-center",
                    render: function (data, type, row) {
                        return ''
                    }
                },
            ],
            order: [
                [1, 'desc']
            ],
            columnDefs: [
                { "targets": 0, "searchable": false },
                { "targets": 1, "searchable": true },
                { "targets": 2, "searchable": true },
                { "targets": 3, "searchable": true },
                { "targets": 4, "searchable": false },
                { "targets": 5, "searchable": false, "sortable": false },
                { "targets": 6, "orderable": false, "searchable": false }
            ],
            rowCallback: function(row, data, iDisplayIndex) {
                $('td:eq(0)', row).html()
            }
        })
    })

    /* Fungsi formatRupiah */
    function formatRupiah(angka, prefix){
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split   		= number_string.split(','),
        sisa     		= split[0].length % 3,
        rupiah     		= split[0].substr(0, sisa),
        ribuan     		= split[0].substr(sisa).match(/\d{3}/gi)

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if(ribuan){
            separator = sisa ? '.' : ''
            rupiah += separator + ribuan.join('.')
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '')
    }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('spa.layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp_php_7\htdocs\hibah_upj\application\views/spa/pencairan_rkat/petty_cash/v_status_pettycash.blade.php ENDPATH**/ ?>