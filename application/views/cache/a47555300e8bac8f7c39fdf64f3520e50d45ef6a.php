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
<<<<<<< HEAD
<link rel="stylesheet" href="<?php echo e(base_url('assets/css/dataTables.bootstrap4.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(base_url('assets/css/responsive.bootstrap4.min.css')); ?>">
=======
>>>>>>> e519d44fca553c0a4dec0f5b15228829dbd12fb8
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="javascript: void(0);">Pencairan RKAT</a></li>
    <li class="breadcrumb-item active"><a href="javascript: void(0);">Input Actbud</a></li>
<?php $__env->stopSection(); ?>

<<<<<<< HEAD
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
=======
<?php $__env->startSection('content'); ?>
    <?php if($session['kode_jabatan'] == 7): ?>
        <div class="col-lg-6 col-xl-4">
            <div class="card widget-box-three">
                <div class="card-body">
                    <div class="float-right mt-2">
                        <i class="mdi mdi-clipboard-multiple-outline text-purple display-4 m-0"></i>
                    </div>
                    <div class="overflow-hidden">
                        <p class="text-uppercase font-weight-medium text-truncate mb-2">Pengajuan Actbud</p>
                        <h2 class="mb-0">
                            <span data-plugin="counterup">

                            </span>
                        </h2>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="float-right">
                        <a href="" class="btn btn-info btn-xs">Lihat <i class="mdi mdi-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xl-4">
            <div class="card widget-box-three">
                <div class="card-body">
                    <div class="float-right mt-2">
                        <i class="mdi mdi-clipboard-multiple-outline text-primary display-4 m-0"></i>
                    </div>
                    <div class="overflow-hidden">
                        <p class="text-uppercase font-weight-medium text-truncate mb-2">Pengajuan Petty Cash</p>
                        <h2 class="mb-0">
                            <span data-plugin="counterup">

                            </span>
                        </h2>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="float-right">
                        <a href="" class="btn btn-info btn-xs">Lihat <i class="mdi mdi-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xl-4">
            <div class="card widget-box-three">
                <div class="card-body">
                    <div class="float-right mt-2">
                        <i class="mdi mdi-progress-close text-danger display-4 m-0"></i>
                    </div>
                    <div class="overflow-hidden">
                        <p class="text-uppercase font-weight-medium text-truncate mb-2">Actbud Ditolak</p>
                        <h2 class="mb-0">
                            <span data-plugin="counterup">

                            </span>
                        </h2>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="float-right">
                        <a href="" class="btn btn-info btn-xs">Lihat <i class="mdi mdi-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div class="col-md-12">
        <div class="card-box mt-2">
            <div class="row mb-3">
                <div class="col-md-8 col-sm-8 col-xs-12">
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <form action="" method="" accept-charset="utf-8" autocomplete="off" class="myForm">
                        <div class="input-group">
                            <input type="search" id="" value="" name="" class="form-control"
                                placeholder="Cari data...">
                            <span class="input-group-prepend">
                                <button type="submit" class="btn waves-effect waves-light btn-primary btn-sm">
                                    <i class="mdi mdi-magnify mdi-18px"></i>
                                </button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
            <div class="table-responsive">
                <table id="tb_data_actbud" class="table table-striped table-bordered dt-responsive nowrap">
                    <thead class="bg-purple text-white text-center">
                        <tr>
                            <th width="50" style="vertical-align: middle">No</th>
                            <th style="vertical-align: middle">Uraian</th>
                            <th style="vertical-align: middle">Kode Pencairan</th>
                            <th style="vertical-align: middle">Ganjil</th>
                            <th class="text-center" style="vertical-align: middle">Genap</th>
                            <th width="200" style="vertical-align: middle">Sisa</th>
                            <th width="200" style="vertical-align: middle">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tb-actbud"></tbody>
                </table>
            </div>
        </div>
    </div>
    </div>

<?php $__env->startSection('js'); ?>
    <script src="<?php echo e(base_url('assets/js/bootstrap-select.min.js')); ?>"></script>
    <script src="<?php echo e(base_url('assets/js/jquery.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(base_url('assets/js/dataTables.bootstrap4.min.js')); ?>"></script>
    <script src="<?php echo e(base_url('assets/js/dataTables.responsive.min.js')); ?>"></script>
    <script src="<?php echo e(base_url('assets/js/responsive.bootstrap4.min.js')); ?>"></script>

    
<?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>
>>>>>>> e519d44fca553c0a4dec0f5b15228829dbd12fb8

<?php echo $__env->make('spa.layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp_php_7\htdocs\hibah_upj\application\views/spa/pencairan_rkat/v_input_actbud.blade.php ENDPATH**/ ?>