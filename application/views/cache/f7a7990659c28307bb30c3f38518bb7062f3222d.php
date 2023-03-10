<?php
$session = $CI->session->userdata('user_sessions');
$jabatan = $_SESSION['user_sessions']['kode_jabatan'];
$unit = $_SESSION['user_sessions']['nama_unit'];
$kode_unit = $_SESSION['user_sessions']['kode_unit'];
?>


<?php $__env->startSection('title'); ?>
    <?= MOD2 ?> Dashboard
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-title'); ?>
    Dashboard
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item active">
        <a href="javascript: void(0);">Dashboard</a>
    </li>
<?php $__env->stopSection(); ?> 
<?php $__env->startSection('content'); ?>
    <?php if($session['kode_jabatan'] == 7): ?>
        <div class="col-lg-6 col-xl-3">
            <div class="card widget-box-three">
                <div class="card-body">
                    <div class="float-right mt-2">
                        <i class="mdi mdi-clipboard-multiple-outline text-purple display-4 m-0"></i>
                    </div>
                    <div class="overflow-hidden">
                        <p class="text-uppercase font-weight-medium text-truncate mb-2">
                            Pengajuan Actbud
                        </p>
                        <h2 class="mb-0">
                            <span data-plugin="counterup"> </span>
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
        <div class="col-lg-6 col-xl-3">
            <div class="card widget-box-three">
                <div class="card-body">
                    <div class="float-right mt-2">
                        <i class="mdi mdi-clipboard-multiple-outline text-primary display-4 m-0"></i>
                    </div>
                    <div class="overflow-hidden">
                        <p class="text-uppercase font-weight-medium text-truncate mb-2">
                            Pengajuan Petty Cash
                        </p>
                        <h2 class="mb-0">
                            <span data-plugin="counterup"> </span>
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
        <div class="col-lg-6 col-xl-3">
            <div class="card widget-box-three">
                <div class="card-body">
                    <div class="float-right mt-2">
                        <i class="mdi mdi-progress-close text-danger display-4 m-0"></i>
                    </div>
                    <div class="overflow-hidden">
                        <p class="text-uppercase font-weight-medium text-truncate mb-2">
                            Actbud Ditolak
                        </p>
                        <h2 class="mb-0">
                            <span data-plugin="counterup"> </span>
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
        <div class="col-lg-6 col-xl-3">
            <div class="card widget-box-three">
                <div class="card-body">
                    <div class="float-right mt-2">
                        <i class="mdi mdi-progress-close text-danger display-4 m-0"></i>
                    </div>
                    <div class="overflow-hidden">
                        <p class="text-uppercase font-weight-medium text-truncate mb-2">
                            Petty Cash Ditolak
                        </p>
                        <h2 class="mb-0">
                            <span data-plugin="counterup"> </span>
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
    
    <?php if($jabatan != 7){ ?>
    <div class="col">
        <div class="card text-center">
            <div class="card-header">PERHATIAN</div>
            <div class="card-body">
                <h4 class="card-text">Kami Informasikan, bahwa untuk dapat melakukan pencairan ACTBUD / PETTY CASH
                    diharapkan segera mengisi PIC pada RKAT</h4>
                <a href="#" class="btn btn-primary my-4">Klik Disini</a>
                <p class="card-text">Atas Perhatiannya Kami Ucapkan Terima Kasih.</p>
            </div>
            <div class="card-footer">
                <h6>ICT-UPJ</h6>
            </div>
        </div>
    </div>
    <?php } ?>

    


    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('spa.layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp_php_7\htdocs\hibah_upj\application\views/spa/dashboard/dashboard.blade.php ENDPATH**/ ?>