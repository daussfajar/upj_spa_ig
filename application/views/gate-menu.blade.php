<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ base_url('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ base_url('assets/css/bootstrap-theme.min.css') }}">
    <link rel="stylesheet" href="{{ base_url('assets/css/gate.css') }}">
    <link rel="stylesheet" href="{{ base_url('assets/css/icons.min.css') }}">
    <link rel="stylesheet" href="https://kit.fontawesome.com/954440fa22.css" crossorigin="anonymous">
    
    <title>Menu</title>
</head>
<body class="">
    {{-- <p class="">
        Silakan pilih aplikasi:
        <br>
        <a href="{{ base_url('app/sim-spa/dashboard') }}" class="">
            SPA
        </a>
        <br>
        <a href="{{ base_url('app/sim-ig/dashboard') }}">
            IG
        </a>
    </p> --}}
<div class="bg">
    <div class="container-fluid">
        <div class="cont-header">
            <div class="head d-flex bg-light col-lg-10 col-md-12 col-sm-12  flex-column rounded-lg">
                <div class="head-banner p-2 col d-flex align-items-center justify-content-around rounded-top">
                    <div class="d-flex align-items-center col-lg col-md-12 col-sm-12">
                    <img src="{{ base_url('assets/images/logo/logo.png') }}" class="mr-4" alt="">
                        <div class="title-text d-flex flex-column text-white">
                            <p>SPA-IG</p>            
                            <p>UNIVERSITAS PEMBANGUNAN JAYA</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <button class="btn btn-sm btn-secondary"><i class="mdi mdi-account-circle mr-2"></i>Halaman Profile</button>     
                        <button class="btn btn-sm btn-secondary"><i class="mdi mdi-logout mr-2"></i>Logout</button>     
                    </div>
                </div>
                <div class="d-flex flex-column body-card pb-5 justify-content-around">
                    <h5 class="mt-4">MODULE</h5>  
                    <div id="cards_landscape_wrap-2" class=""> 
                        <div class="row ms-5 d-flex justify-content-around">    
                                                    
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                                <a href="#">
                                    <div class="card-flyer">
                                        <div class="text-box">
                                            <div class="image-box">
                                                <img src="{{ base_url('assets/images/gedung-upj.png') }}" alt="" />
                                            </div>
                                            <div class="text-container">
                                                <h6>SPA</h6>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                                <a href="{{ base_url('app/sim-ig/dashboard') }}">
                                    <div class="card-flyer">
                                        <div class="text-box">
                                            <div class="image-box"> 
                                                <img src="{{ base_url('assets/images/bg/upj4.jpg') }}" alt="" />
                                            </div>
                                            <div class="text-container">
                                                <h6>IG</h6>                                                
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                           
                            <div class="card-right col-xs-12 col-sm-6 col-md-6 col-lg-3 mt-5 rounded-lg">
                                <div class="card">
                                  <div class="card-content">
                                    <div class="card-body">
                                      <div class="media d-flex">
                                        <div class="media-body text-left">
                                          <h6 class="success">USERNAME</h6>
                                          <span>admin</span>
                                        </div>
                                        <div class="align-self-center">
                                          <h2 class="mdi mdi-login"></h2>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            
                        </div>
                    </div>      
                </div>
                </div>
            </div>
        </div>
    </div>


    <script src="{{ base_url('assets/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ base_url('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ base_url('assets/js/script.js') }}"></script>
</body>
</html>
