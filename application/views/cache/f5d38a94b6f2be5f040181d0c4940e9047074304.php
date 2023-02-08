<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>SPA-IG | Login</title>
    <!-- CSS -->
    <link rel="stylesheet" href="<?php echo e(base_url('assets/css/app.min.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(base_url('assets/css/inputs.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(base_url('assets/css/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(base_url('assets/css/toastr.min.css')); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/6.6.96/css/materialdesignicons.min.css">
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo e(base_url('assets/images/favicon')); ?>/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo e(base_url('assets/images/favicon')); ?>/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo e(base_url('assets/images/favicon')); ?>/favicon-16x16.png">
    <link rel="manifest" href="<?php echo e(base_url('assets/images/favicon')); ?>/site.webmanifest">
    <link rel="mask-icon" href="<?php echo e(base_url('assets/images/favicon')); ?>/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">    
</head>

<body>        
	<div class="account-pages mt-5 mb-5">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-8 col-lg-6 col-xl-5">                    
					<div class="card">                        
						<div class="text-center account-logo-box bg-white">
							<div class="mt-2">
								<a href="<?php echo e(base_url()); ?>" class="text-success">
									<span><img src="<?php echo e(base_url('assets/images/logo/upjlogo.png')); ?>" alt="" height="80"></span>                                    
								</a>
							</div>
						</div>

						<div class="card-body">

							<form method="POST" accept-charset="UTF-8" id="loginForm">
                                <input type="hidden" name="<?= $CI->security->get_csrf_token_name() ?>" value="<?= $CI->security->get_csrf_hash() ?>">
								<h4 class="text-left" style="width:100%;">Sign in</h4>
								<p class="text-left">Silakan masukkan email dan password anda untuk login.</p>
								<label class="pure-material-textfield-outlined"
									style="font-family: inherit;width:100%;">
									<input type="email" placeholder=" " id="email" name="email"
										value=""
										autofocus />
									<span style="font-weight: 400;">Email</span>
								</label>

								<label class="pure-material-textfield-outlined"
									style="font-family: inherit;width:100%;">
									<input placeholder=" " type="password" id="password" name="password"
										 />
									<span style="font-weight: 400;">Password</span>
									<div class="right-icon">
										<span class="mdi mdi-eye mdi-24px" id="togglePassword"
											style="color: rgb(117, 116, 117);cursor: pointer;"></span>
									</div>
								</label>

								<div class="form-group text-center pt-2">
									<div class="col-sm-12">
										<a href="javascript:void(0)" class="text-muted" onclick="window.open('http://portal.upj.ac.id:8855/helpme/')"><i
												class="mdi mdi-lock mr-1"></i>
											Lupa password?</a>
									</div>
								</div>

								<div class="form-group account-btn text-center mt-2">
									<div class="col-12">
										<button class="btn width-md btn-bordered btn-primary waves-effect waves-light"
											type="submit" name="LogIn">Log In <i class="mdi mdi-login-variant"></i></button>
									</div>
								</div>
							</form>

						</div>
						<!-- end card-body -->
					</div>
					<!-- end card -->
				</div>
				<!-- end col -->
			</div>
			<!-- end row -->
		</div>
		<!-- end container -->
	</div>
	<!-- end page -->
    <script src="https://code.jquery.com/jquery-3.6.0.slim.js" integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY=" crossorigin="anonymous"></script>
    
    <script src="<?php echo e(base_url('assets/js/vendor.min.js')); ?>"></script>
    <script src="<?php echo e(base_url('assets/js/app.min.js')); ?>"></script>
    <script src="<?php echo e(base_url('assets/js/toastr.min.js')); ?>"></script>
    <script>
		const togglePassword = document.querySelector('#togglePassword')
		const password = document.querySelector('#password')

		togglePassword.addEventListener('click', function (e) {
			const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
			password.setAttribute('type', type)

			this.classList.toggle('mdi-eye-off')
		})

        $('button[name="LogIn"]').click(function(){ 			
            setTimeout((e) => {
				//$('#loginForm').submit()
				let email = $('input[name="email"]').val()
				let password = $('input[name="password"]').val()
				//const captchaResponse = window.grecaptcha.getResponse()

				if(email == ""){
					toastr["error"]("Email tidak boleh kosong", "")
					$('#email').focus()
					return false
				} 								
															
				if(password == ""){
					toastr["error"]("Password tidak boleh kosong", "");
					$('#password').focus()					
					return false
				} 
				$('#loginForm').submit()
			}, 200)
        })
        
        <?php if($CI->session->flashdata('error_validation')): ?>
            <?php $__currentLoopData = $CI->session->flashdata('error_validation')['form_error']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>            
                toastr["error"]("<?= $r ?>", "")                
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>        		
        <?php endif; ?>
                        
        <?php if($CI->session->flashdata('alert')): ?>
            toastr["<?php echo e($CI->session->flashdata('alert')['type']); ?>"]("<?php echo e($CI->session->flashdata('alert')['message']); ?>", "<?php echo e($CI->session->flashdata('alert')['title']); ?>")                		
        <?php endif; ?>
    </script>
</body>

</html>
<?php /**PATH D:\xampp1\htdocs\hibah_upj\application\views/users/front/login.blade.php ENDPATH**/ ?>