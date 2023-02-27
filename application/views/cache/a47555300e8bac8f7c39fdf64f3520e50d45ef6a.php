<?php
$session = $CI->session->userdata('user_sessions');
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="javascript: void(0);">Pencairan RKAT</a></li>
    <li class="breadcrumb-item active"><a href="javascript: void(0);">Input Actbud</a></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>    
<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">
                Data Actbud
            </h5>
        </div>
        <div class="card-body">
            <div class="table-responsive my-4">
                <table class="table table-striped table-bordered table-hover" id="table-actbud">
                    <thead>
                        <tr>
                            <th class="text-center" style="vertical-align:middle;">No</th>
                            <th style="vertical-align:middle;">Kode Pencairan</th>
                            <th style="vertical-align:middle;">Uraian</th>                            
                            <th style="vertical-align:middle;" class="text-center">Kode Pencairan</th>
                            <th style="vertical-align:middle;" class="text-center">Ganjil</th>
                            <th style="vertical-align:middle;" class="text-center">Genap</th>
                            <th style="vertical-align:middle;" class="text-center">Sisa</th>
                            <th style="vertical-align:middle;" class="text-center">Aksi</th>
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
        $("#table-actbud").DataTable({
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
        })
    })
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('spa.layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp_php_7\htdocs\hibah_upj\application\views/spa/pencairan_rkat/v_input_actbud.blade.php ENDPATH**/ ?>