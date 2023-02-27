<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>{{ APP_NAME1 }} @yield('title')</title>    
    <link rel="apple-touch-icon" sizes="76x76" href="{{ base_url('assets/images/favicon') }}/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ base_url('assets/images/favicon') }}/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ base_url('assets/images/favicon') }}/favicon-16x16.png">
    <link rel="manifest" href="{{ base_url('assets/images/favicon') }}/site.webmanifest">
    <link rel="mask-icon" href="{{ base_url('assets/images/favicon') }}/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">    

    <!-- CSS -->
    <link rel="stylesheet" href="{{ base_url('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ base_url('assets/css/icons.min.css') }}">
    <link rel="stylesheet" href="{{ base_url('assets/css/app.min.css') }}">
    <link rel="stylesheet" href="{{ base_url('assets/css/toastr.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/6.6.96/css/materialdesignicons.min.css">
    @yield('css')
    <style>
        .left-side-menu-light .navbar-custom .topnav-menu .nav-link {
            padding: 0 15px;
            color: #797979;
        }        
    </style>
</head>
<body class="left-side-menu-light">
    <!-- Begin page -->
    <div id="wrapper">
        
        <!-- Topbar Start -->
        <div class="navbar-custom bg-white">
            <ul class="list-unstyled topnav-menu float-right mb-0">

                @include('ig.layouts.user_notification')                

                <li class="dropdown notification-list">
                    <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <img src="{{ base_url('assets/images/logo/logo.png') }}" alt="user-image" class="rounded-circle">
                        <span class="d-none d-sm-inline-block ml-1" style="font-weight: bold;">{{ strtoupper($CI->session->userdata('user_sessions')['nama_lengkap']) }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right profile-dropdown ">                                           
                        <!-- item-->
                        <a href="{{ base_url('app/profil_saya') }}" class="dropdown-item notify-item">
                            <i class="mdi mdi-account-circle"></i>
                            <span>Profil Saya</span>
                        </a>
                        <a href="{{ base_url('app/menu') }}" class="dropdown-item notify-item">
                            <i class="mdi mdi-menu"></i>
                            <span>Menu</span>
                        </a>
                        <a href="javascript:void(0);" data-toggle="modal" data-target="#modal-logout" class="dropdown-item notify-item">
                            <i class="mdi mdi-logout-variant"></i>
                            <span>Logout</span>
                        </a>

                    </div>
                </li>               

            </ul>

            <!-- LOGO -->
            <div class="logo-box bg-white">
                <a href="{{ base_url('app/sim-ig/dashboard') }}" class="logo text-center">
                    <span class="logo-lg">
                        <img src="{{ base_url('assets/images/logo/logo_modul_ig_bg_white_text_black.png') }}" alt="" height="50">
                        <!-- <span class="logo-lg-text-light">SPA-IG</span> -->
                    </span>
                    <span class="logo-sm">
                        <!-- <span class="logo-sm-text-dark">S</span> -->
                        <img src="{{ base_url('assets/images/logo/logo_spa_small_bg_white.png') }}" alt="" height="34">
                    </span>
                </a>
            </div>

            <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
                <li>
                    <button class="button-menu-mobile waves-effect">
                        <i class="mdi mdi-menu" style="color:#797979;"></i>
                    </button>
                </li>                                    
            </ul>
        </div>
        <!-- end Topbar --> 
        
        <!-- ========== Left Sidebar Start ========== -->
        @include('ig.layouts.user_sidebar_menu')
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page">
            <div class="content">

                <!-- Start Content-->
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><b>IG</b></a></li>                                        
                                        @yield('breadcrumb')
                                    </ol>
                                </div>
                                <h4 class="page-title">@yield('page-title')</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        @yield('content')
                    </div>
                    <!-- end row -->

                </div>
                <!-- end container-fluid -->

            </div>
            <!-- end content -->
            
            <!-- Footer Start -->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <?= date('Y') ?> &copy; <b>ICT</b> - Universitas Pembangunan Jaya.
                        </div>
                    </div>
                </div>
            </footer>
            <!-- end Footer -->

        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->

    </div>
    <!-- END wrapper -->    

    <!-- Modal Logout -->
    {!! form_open('app/logout', array('class' => 'myForm')) !!}
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
                    <button type="submit" class="btn btn-danger btn-sm waves-effect waves-light">keluar <i class="mdi mdi-logout-variant"></i></button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    {!! form_close() !!}
    <!-- End Modal Logout -->

    <!-- end page -->
    <script src="{{ base_url('assets/js/jquery-3.6.0.slim.js') }}"></script>
    
    <script src="{{ base_url('assets/js/vendor.min.js') }}"></script>    
    <script src="{{ base_url('assets/js/toastr.min.js') }}"></script>    
    <script>
        $(document).ready(function(){
            @if ($CI->session->flashdata('alert'))
                toastr["{{ $CI->session->flashdata('alert')['type'] }}"]("{{ $CI->session->flashdata('alert')['message'] }}", "{{ $CI->session->flashdata('alert')['title'] }}")                		
            @endif

            @if ($CI->session->flashdata('error_validation'))
                @foreach ($CI->session->flashdata('error_validation')['form_error'] as $r)            
                    toastr["error"]("<?= $r ?>", "")
                @endforeach        		
            @endif

            $('form.myForm').submit(function(){
                $('button[type="submit"]')
                .attr('disabled', true)
                .addClass('disabled')
                .html('<i class="mdi mdi-spin mdi-loading"></i>')
            })
        })
    </script>

    <script src="{{ base_url('assets/js/app.min.js') }}"></script>   
    @yield('js') 
</body>
</html>