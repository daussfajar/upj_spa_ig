<?php
$session = $CI->session->userdata('user_sessions');
$nama_lengkap = $session['nama_lengkap'];
?>


<?php $__env->startSection('title'); ?>
    <?= MOD2 ?> Pencairan RKAT - Input Acbud
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-title'); ?>
    Input Actbud
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
    <li class="breadcrumb-item"><a href="javascript: void(0);">Pencairan RKAT</a></li>
    <li class="breadcrumb-item"><a href="javascript: void(0);">Actbud</a></li>
    <li class="breadcrumb-item active"><a href="javascript: void(0);">Input Actbud</a></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>    
<div class="col-lg-12">
    <div class="card">
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
                    <thead class="">
                        <tr>
                            <th class="text-center v-middle">No</th>
                            <th class="v-middle">Uraian</th>
                            <th class="text-center v-middle">Kode Pencairan</th>
                            <th class="text-center v-middle font-14">Ganjil</th>
                            <th class="text-center v-middle font-14">Genap</th>
                            <th class="text-center v-middle font-14">Sisa</th>
                            <th class="text-center v-middle font-14">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tbody-table-actbud">
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
                "url": "<?php echo base_url('SPA/PencairanRKAT/get_uraian_by_nik') ?>",
                "type": "POST",
                "dataType" : "json",
                "data" : {
                    'kode-rkat': '<?= $kode_rkat_master ?>',
                    'periode': '<?= $periode ?>'
                },
            }, 
            columns: [
                {
                    "data": "kode_uraian",
                    "class": "text-center v-middle font-14",
                    "sortable": false, 
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }  
                },
                {
                    "data": "uraian",
                    "class": "v-middle font-14",
                },
                {
                    "data": "kode_pencairan",
                    "class": "v-middle font-14 text-center",
                    "render": function(data, type, row){
                        return data
                    }
                },
                {
                    "data": "rp_ganjil",
                    "class": "text-center v-middle",                    
                    "render": function (data, type, row) {
                        if(data == ""){
                            return '-'
                        } else {
                            return '<span class="badge bg-success p-2">'+formatRupiah(data, 'Rp. ')+'</span>'
                        }
                    }
                },
                {
                    "data": "rp_genap",
                    "class": "text-center v-middle",
                    "render": function (data, type, row) {                        
                        if(data == ""){
                            return '-'
                        } else {
                            return '<span class="badge bg-teal p-2">'+formatRupiah(data, 'Rp. ')+'</span>'
                        }
                    }
                },
                {
                    "data": "sisa_anggaran",
                    "class": "text-center v-middle",
                    "render": function (data, type, row) {
                        let sisa = (row.sisa_anggaran - row.agr_digunakan)   
                        if(sisa < 0){
                            sisa = 0
                        }
                        
                        return '<span class="badge bg-secondary p-2">'+formatRupiah(sisa.toString(), 'Rp. ')+'</span>'
                    }
                },
                {
                    "data": "kode_uraian",
                    "class": "text-center v-middle",
                    "render": function(data, type, row, meta){
                        let url = base_url + "app/sim-spa/pencairan-rkat/input-actbud/" + data
                        return '<a href="'+url+'" class="badge bg-primary p-2"><i class="mdi mdi-file-plus"></i> Input Actbud</a>'
                    }
                }
            ],
            order: [
                [1, 'desc']
            ],
            columnDefs: [
                { "targets": 0, "searchable": false },
                { "targets": 1, "searchable": true },
                { "targets": 2, "searchable": true },
                { "targets": 3, "searchable": true },
                { "targets": 4, "searchable": true },
                { "targets": 5, "searchable": false },
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

<?php echo $__env->make('spa.layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp_php_7\htdocs\hibah_upj\application\views/spa/pencairan_rkat/actbud/v_input_actbud.blade.php ENDPATH**/ ?>