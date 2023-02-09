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
    <style>
        .separator {
            display: flex;
            align-items: center;
            text-align: center;
        }

        .separator::before,
        .separator::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid rgba(0,0,0,.1);
        }

        .separator:not(:empty)::before {
            margin-right: .25em;
        }

        .separator:not(:empty)::after {
            margin-left: .25em;
        }
        .body-spa_ig{
            background: linear-gradient(180deg, rgba(100, 192, 239, 0.32) 0%, rgb(0 0 0 / 54%) 53.6%, #00000082 100%), url('<?= site_url('assets/images/bg/upj4.jpg') ?>') !important;
            background-size: cover!important;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }
        .mb-logo{
            padding-left: 3.5rem;
        }
        .mb-text{
            text-align: left!important;
        }
        @media  only screen and (max-width: 600px) {
            .mb-text{
                text-align: center!important;
            }
            .mb-logo{
                padding-left: 0;
            }
        }
    </style>
</head>

<body class="body-spa_ig" g_id="<?php echo e(encrypt('gfjhui')); ?>">
	<div class="account-pages mt-5 mb-5">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-8 col-lg-6 col-xl-5">                    
					<div class="card">                        
						<div class="mb-text bg-white mb-logo">
							<div class="mt-4">
								<a href="<?php echo e(base_url()); ?>" class="text-success">
									<span><img src="<?php echo e(base_url('assets/images/logo/upjlogo.png')); ?>" alt="" height="80"></span>                                    
								</a>
							</div>
						</div>

						<div class="card-body" style="
                        padding-top:1rem;
                        padding-left:3.5rem;
                        padding-right:3.5rem;
                        padding-bottom:2.5rem;
                        ">
                            <?php 
                            $redirect_url = $CI->input->get('redirect_url', true);
                            $ex_act = "";
                            if($redirect_url !== ""){
                                $ex_act .= "&redirect_url=".$redirect_url;
                            }

                            ?>
							
                            <?php echo form_open('auth/login?_g_id=' . generateRandomString(32) . '&gl=' . encrypt('gl') . $ex_act, array('autocomplete' => 'on', 'id' => 'loginForm')); ?>

								<h4 class="text-left mb-1" style="width:100%;"><span class="text-purple">Welcome</span> to SPA-IG</h4>
								<p class="text-left" style="font-size: 14px;">Silakan masukkan email dan password anda untuk login.</p>
								<label class="pure-material-textfield-outlined"
									style="font-family: inherit;width:100%;">
									<input type="email" placeholder=" " id="email" name="email"
										value=""
										autofocus required />
									<span style="font-weight: 400;">Email</span>
								</label>
                                
								<label class="pure-material-textfield-outlined"
									style="font-family: inherit;width:100%;">
									<input placeholder=" " type="password" id="password" name="password"
										required />
									<span style="font-weight: 400;">Password</span>
									<div class="right-icon">
										<span class="mdi mdi-eye mdi-24px" id="togglePassword"
											style="color: rgb(117, 116, 117);cursor: pointer;"></span>
									</div>
								</label>

								<div class="form-group text-left pt-2">									
									<a href="javascript:void(0)" onclick="window.open('https://helpdesk.upj.ac.id/')"><i
									class="mdi mdi-lock"></i>
									Lupa password?
                                    </a>
								</div>

								<div class="form-group text-center mt-2 mb-0">									
									<button class="btn col-12 btn-primary btn-rounded waves-effect waves-light"
									type="submit" name="LogIn">Log In <i class="mdi mdi-login-variant"></i></button>
								</div>
							<?php echo form_close(); ?>

                            <div class="separator mt-3 mb-3">Or</div>
                            <a href="javascript:void(0)" id="btnSignWithMicrosoft"
                            class="btn col-12 btn-secondary btn-rounded waves-effect waves-light"><i class="mdi mdi-microsoft"></i> Sign in with Microsoft</a>
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

        $('#btnSignWithMicrosoft').click(function(){
            toastr["info"]("Fitur belum tersedia, Nantikan pembaruan lainnya disini! Terima kasih", "")					
			return false
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
<?php /**PATH C:\xampp_php_7\htdocs\hibah_upj\application\views/users/front/login.blade.php ENDPATH**/ ?>