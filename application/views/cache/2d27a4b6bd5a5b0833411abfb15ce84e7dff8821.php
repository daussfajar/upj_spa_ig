<?php 
$nama = $_SESSION['user_sessions']['nama_lengkap'];
$last_login = $_SESSION['user_sessions']['last_login'];
$last_login_message = "";

if(!empty($last_login)){
	$ex_last_login = explode(' ', $last_login);
	$last_login_message .= "<span style='font-size:12px;' class='text-primary'> ( Terakhir Login: ".tanggal_indo($ex_last_login[0]).", ".$ex_last_login[1]." )</span>";
}
?>
<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title><?php echo e(APP_NAME); ?> | Modul Aplikasi</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sistem Pencairan Anggaran, Universitas Pembangunan Jaya">
    <meta name="keywords" content="">
    <meta name="author" content="Universitas Pembangunan Jaya">

	<link rel="apple-touch-icon" sizes="76x76" href="<?php echo e(base_url('assets/images/favicon')); ?>/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo e(base_url('assets/images/favicon')); ?>/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo e(base_url('assets/images/favicon')); ?>/favicon-16x16.png">
	<link rel="manifest" href="<?php echo e(base_url('assets/images/favicon')); ?>/site.webmanifest">
	<link rel="mask-icon" href="<?php echo e(base_url('assets/images/favicon')); ?>/safari-pinned-tab.svg" color="#5bbad5">
	<meta name="msapplication-TileColor" content="#da532c">
	<meta name="theme-color" content="#ffffff">
	
	<link rel="stylesheet" type="text/css" href="<?php echo e(base_url('assets/css/gate_new.css')); ?>" />
	<link rel="stylesheet" href="<?php echo e(base_url('assets/css/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(base_url('assets/css/icons.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(base_url('assets/css/app.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(base_url('assets/css/toastr.min.css')); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/6.6.96/css/materialdesignicons.min.css">
</head>

<body class="bg">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-sm-8 col-xs-8 mx-auto pt-5">
				<div class="card xcm ycm">
					<div class="card-header bg-dark header-deck xcm">
						<div class="h-title">
							<div class="h-title-img">
								<img src="<?php echo e(base_url('assets/images/logo/864.jpg')); ?>" alt="" srcset="">
							</div>
							<div class="h-title-name">
								<h3 class="text-white t-title">Sistem Pencairan Anggaran</h3>
								<h2 class="text-white t-comp">Universitas Pembangunan Jaya</h2>
							</div>
						</div>	
						<div class="btn-group" style="height:40px;">
							<button type="button" class="btn btn-light dropdown-toggle waves-effect" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-menu"></i></button>
							<ul class="dropdown-menu">
								<li><a href="#" class="dropdown-item">Halaman Profil</a></li>								
								<li><a href="#" data-toggle="modal" data-target="#modal-logout" class="dropdown-item">Keluar</a></li>
							</ul>
						</div>					
					</div>
					<div class="card-body">
						<p class="mb-0 pb-0">Selamat datang, <strong><?= $nama ?></strong>!<?= $last_login_message ?></p>
						<h6>Pilih Modul:</h6>
						<hr>
						<div class="row">
							<div class="col-md-4">
								<div class="card c-option xcm ycm" onclick="document.location='<?php echo e(base_url('app/sim-spa/dashboard')); ?>'">
									<div class="card-body">
										<img class="card-img-top img-fluid" src="<?php echo e(base_url('assets/images/module/RKAT.png')); ?>" alt="SIM RKAT">										
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="card c-option xcm ycm" onclick="document.location='<?php echo e(base_url('app/sim-ig/dashboard')); ?>'">
									<div class="card-body">
										<img class="card-img-top img-fluid" src="<?php echo e(base_url('assets/images/module/IG.png')); ?>" alt="SIM IG">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<!-- Modal Logout -->
    <?php echo form_open('app/logout', array('class' => 'myForm')); ?>

    <div id="modal-logout" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0">Logout</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">    
                    <p class="pb-0 mb-0">Apakah anda yakin ingin keluar?</p>                
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light btn-sm waves-effect" data-dismiss="modal">Kembali</button>
                    <button type="submit" class="btn btn-danger btn-sm waves-effect waves-light">Keluar <i class="mdi mdi-logout-variant"></i></button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <?php echo form_close(); ?>

    <!-- End Modal Logout -->

	<!-- end page -->
    <script src="https://code.jquery.com/jquery-3.6.0.slim.js" integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY=" crossorigin="anonymous"></script>
    
    <script src="<?php echo e(base_url('assets/js/vendor.min.js')); ?>"></script>    
    <script src="<?php echo e(base_url('assets/js/toastr.min.js')); ?>"></script> 
</body>

</html>
<?php /**PATH C:\xampp_php_7\htdocs\hibah_upj\application\views/gate-menu.blade.php ENDPATH**/ ?>