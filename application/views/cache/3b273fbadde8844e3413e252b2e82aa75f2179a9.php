
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
	<title><?php echo e(APP_NAME); ?> | 404 Halaman tidak ditemukan </title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta content="Sistem Informasi Uji Kompetensi Universitas Pembangunan Jaya" name="description" />
	<meta content="Universitas Pembangunan Jaya" name="author" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<!-- App favicon -->
	<link rel="apple-touch-icon" sizes="76x76" href="<?php echo e(base_url('assets/images/favicon')); ?>/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo e(base_url('assets/images/favicon')); ?>/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo e(base_url('assets/images/favicon')); ?>/favicon-16x16.png">
    <link rel="manifest" href="<?php echo e(base_url('assets/images/favicon')); ?>/site.webmanifest">
    <link rel="mask-icon" href="<?php echo e(base_url('assets/images/favicon')); ?>/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
		integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	<style type="text/css">
		* {
			-webkit-box-sizing: border-box;
			box-sizing: border-box;
		}

		body {
			padding: 0;
			margin: 0;
		}

		.notfound-wrapper {
			width: 650px;
			height: 350px;
			position: absolute;
			top: 50%;
			left: 50%;
			transform: translate(-50%, -50%);
			text-align: center;
			/* border: 1px solid red; */
		}

		.notfound-content {
			display: flex;
			align-items: center;
			justify-content: center;
			height: 280px;
		}

		.notfound-title h1 {
			font-size: 128px;
			font-family: 'Montserrat', sans-serif;
		}

		.notfound-description {
			text-align: left !important;
			font-family: 'Montserrat', sans-serif;
			position: relative;
			top: 10px;

		}

		.notfound-description h2 {
			font-size: 48px;
			margin: 0 0 7px 0;
		}

		.notfound-description p {
			font-size: 18px;
			margin: 0;
		}

		.four {
			color: #F15A29;
		}

		.zero {
			margin: 0 10px;
		}

		.vl {
			border-left: 3px solid black;
			height: 170px;
			margin: 0 15px;
		}

		.btn-home {
			display: inline-block;
			margin-top: 10px;
			padding: 10px 20px;
			background-color: #003e7d;
			color: rgba(255, 255, 255, 0.9);
			text-decoration: none;
			border: 2px solid #003e7d;
			border-radius: 6px;
			position: relative;
			top: 5px;
			transition: 0.3s;
		}

		.btn-home:hover {
			opacity: 0.75;
		}

		.logo-funnelspro {
			width: 300px;
			display: inline-block;
			margin: 0 auto;
		}

	</style>
</head>

<body>
	<div class="notfound-wrapper">		
		<div class="notfound-content">
			<div class="notfound-title">
				<h1><span style="color:#0082c8;">4</span><span style="color:#077b48;">0</span><span style="color:#ee1c24;">4</span></h1>
			</div>			
			<div class="notfound-description" style="margin-left:20px;">
				<h2>Oppss!</h2>
				<p>Maaf, halaman yang anda cari tidak ditemukan.</p>
				<a href="<?= !empty($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : base_url() ?>" class="btn-home"><i class="fa fa-arrow-circle-left"></i> Kembali</a>
			</div>
		</div>
	</div>
</body>

</html>
<?php /**PATH C:\xampp_php_7\htdocs\hibah_upj\application\views/404.blade.php ENDPATH**/ ?>