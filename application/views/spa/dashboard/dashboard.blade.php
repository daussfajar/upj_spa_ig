<?php
$session = $CI->session->userdata('user_sessions');
$jabatan = $_SESSION['user_sessions']['kode_jabatan'];
$unit = $_SESSION['user_sessions']['nama_unit'];
$kode_unit = $_SESSION['user_sessions']['kode_unit'];
?>
@extends('spa.layouts.user')

@section('title')
    <?= MOD2 ?> Dashboard
@endsection

@section('page-title')
    Dashboard
@endsection

@section('css')
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item active">
        <a href="javascript: void(0);">Dashboard</a>
    </li>
@endsection 
@section('content')

    <?php  
    if($jabatan != "1" && $jabatan != "2" && $jabatan != "3" && $jabatan != "4"){
    ?>
    <div class="col-lg-6 col-xl-3">
        <div class="card widget-box-three">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div class="mx-1">
                        <p class="text-uppercase font-weight-medium mb-2">
                            Status<br>Actbud<br>Yang Diajukan
                        </p>
                        <h2 class="mb-0">
                            <span data-plugin="counterup"><?= $total_actbud_diajukan; ?></span>
                        </h2>
                    </div>
                    <div class="mx-1">
                        <i class="mdi mdi-clipboard-multiple-outline text-primary display-4 m-0"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="float-right">
                    <a href="<?= base_url('app/sim-spa/pencairan-rkat/status-petty-cash'); ?>" target="_blank" class="btn btn-info btn-xs">Lihat <i class="mdi mdi-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-xl-3">
        <div class="card widget-box-three">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div class="mx-1">
                        <p class="text-uppercase font-weight-medium mb-2">
                            Status<br>Petty Cash<br>Yang Diajukan
                        </p>
                        <h2 class="mb-0">
                            <span data-plugin="counterup"><?= $total_petty_cash_diajukan; ?></span>
                        </h2>
                    </div>
                    <div class="mx-1">
                        <i class="mdi mdi-clipboard-multiple-outline text-primary display-4 m-0"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="float-right">
                    <a href="<?= base_url('app/sim-spa/pencairan-rkat/status-actbud'); ?>" target="_blank" class="btn btn-info btn-xs">Lihat <i class="mdi mdi-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="col-lg-6 col-xl-3">
        <div class="card widget-box-three">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div class="mx-1">
                        <p class="text-uppercase font-weight-medium mb-2">
                            Actbud Ditolak
                        </p>
                        <h2 class="mb-0">
                            <span data-plugin="counterup"><?= $total_actbud_ditolak; ?></span>
                        </h2>
                    </div>
                    <div class="mx-1">
                        <i class="mdi mdi-progress-close text-danger display-4 m-0"></i>
                    </div>
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
                <div class="d-flex justify-content-between">
                    <div class="mx-1">
                        <p class="text-uppercase font-weight-medium mb-2">
                            Petty Cash Ditolak
                        </p>
                        <h2 class="mb-0">
                            <span data-plugin="counterup"><?= $total_petty_cash_ditolak; ?></span>
                        </h2>
                    </div>
                    <div class="mx-1">
                        <i class="mdi mdi-progress-close text-danger display-4 m-0"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="float-right">
                    <a href="" class="btn btn-info btn-xs">Lihat <i class="mdi mdi-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div> -->

    <?php
    }

    // Presiden
    if($jabatan == "1"){
    ?>
        <div class="col-lg-6 col-xl-3">
            <div class="card widget-box-three">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="mx-1">
                            <p class="text-uppercase font-weight-medium mb-2">
                                Approval<br>Presiden
                            </p>
                            <h2 class="mb-0">
                                <span data-plugin="counterup"><?= $total_approval_presiden['jumlah'] ?></span>
                            </h2>
                        </div>
                        <div class="mx-1">
                            <i class="mdi mdi-briefcase-outline text-purple display-4 m-0"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="float-right">
                        <a href="<?= base_url('app/sim-spa/approval/presiden') ?>" target="_blank" class="btn btn-info btn-xs">Lihat <i class="mdi mdi-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }

    // Rektor
    if($jabatan == "2"){
    ?>
        <div class="col-lg-6 col-xl-3">
            <div class="card widget-box-three">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="mx-1">
                            <p class="text-uppercase font-weight-medium mb-2">
                                Approval<br>Rektor
                            </p>
                            <h2 class="mb-0">
                                <span data-plugin="counterup"><?= $total_approval_rektor['jumlah'] ?></span>
                            </h2>
                        </div>
                        <div class="mx-1">
                            <i class="mdi mdi-briefcase-outline text-purple display-4 m-0"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="float-right">
                        <a href="<?= base_url('app/sim-spa/approval/rektor') ?>" target="_blank" class="btn btn-info btn-xs">Lihat <i class="mdi mdi-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }
    
    // Warek 1
    if($jabatan == "3"){
    ?>
        <div class="col-lg-6 col-xl-3">
            <div class="card widget-box-three">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="mx-1">
                            <p class="text-uppercase font-weight-medium mb-2">
                                Approval<br>Wakil Rektor 1
                            </p>
                            <h2 class="mb-0">
                                <span data-plugin="counterup"><?= $total_approval_warek1['jumlah'] ?></span>
                            </h2>
                        </div>
                        <div class="mx-1">
                            <i class="mdi mdi-briefcase-outline text-purple display-4 m-0"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="float-right">
                        <a href="<?= base_url('app/sim-spa/approval/warek1') ?>" target="_blank" class="btn btn-info btn-xs">Lihat <i class="mdi mdi-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }

    // Warek 2
    if($jabatan == "4"){
    ?>
        <div class="col-lg-6 col-xl-3">
            <div class="card widget-box-three">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="mx-1">
                            <p class="text-uppercase font-weight-medium mb-2">
                                Approval<br>Wakil Rektor 2
                            </p>
                            <h2 class="mb-0">
                                <span data-plugin="counterup"><?= $total_approval_warek2['jumlah'] ?></span>
                            </h2>
                        </div>
                        <div class="mx-1">
                            <i class="mdi mdi-briefcase-outline text-purple display-4 m-0"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="float-right">
                        <a href="<?= base_url('app/sim-spa/approval/warek2') ?>" target="_blank" class="btn btn-info btn-xs">Lihat <i class="mdi mdi-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }

    // Card Dekan
    if($jabatan == "5"){ 
        if($kode_unit == "017"){
    ?>
                <div class="col-md-3">
                    <div class="card widget-box-three">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div class="mx-1">
                                    <p class="text-uppercase font-weight-medium mb-2">
                                        Approval Anggaran Fakultas FHB
                                    </p>
                                    <h2 class="mb-0">
                                        <span data-plugin="counterup"><?= $get_total_approval_kabag['jumlah'] ?></span>
                                    </h2>
                                </div>
                                <div class="mx-1">
                                    <i class="mdi mdi-briefcase-outline text-purple display-4 m-0"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="float-right">
                                <a href="<?= base_url('app/sim-spa/approval/kepala-unit') ?>" target="_blank" class="btn btn-info btn-xs">Lihat <i class="mdi mdi-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card widget-box-three">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div class="mx-1">
                                    <p class="text-uppercase font-weight-medium mb-2">
                                        Approval Fakultas FHB<br>&nbsp;
                                    </p>
                                    <h2 class="mb-0">
                                        <span data-plugin="counterup"><?= $total_approval_fhb['jumlah'] ?></span>
                                    </h2>
                                </div>
                                <div class="mx-1">
                                    <i class="mdi mdi-briefcase-outline text-purple display-4 m-0"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="float-right">
                                <a href="<?= base_url('app/sim-spa/approval/dekan') ?>" target="_blank" class="btn btn-info btn-xs">Lihat <i class="mdi mdi-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
    <?php
        } else {
    ?>
                <div class="col-md-3">
                    <div class="card widget-box-three">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div class="mx-1">
                                    <p class="text-uppercase font-weight-medium mb-2">
                                        Approval Anggaran Fakultas FTD
                                    </p>
                                    <h2 class="mb-0">
                                        <span data-plugin="counterup"><?= $get_total_approval_kabag['jumlah'] ?></span>
                                    </h2>
                                </div>
                                <div class="mx-1">
                                    <i class="mdi mdi-briefcase-outline text-purple display-4 m-0"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="float-right">
                                <a href="<?= base_url('app/sim-spa/approval/kepala-unit') ?>" target="_blank" class="btn btn-info btn-xs">Lihat <i class="mdi mdi-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card widget-box-three">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div class="mx-1">
                                    <p class="text-uppercase font-weight-medium mb-2">
                                        Approval Fakultas FTD<br>&nbsp;
                                    </p>
                                    <h2 class="mb-0">
                                        <span data-plugin="counterup"><?= $total_approval_ftd['jumlah'] ?></span>
                                    </h2>
                                </div>
                                <div class="ml-1">
                                    <i class="mdi mdi-briefcase-outline text-purple display-4 m-0"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="float-right">
                                <a href="<?= base_url('app/sim-spa/approval/dekan') ?>" target="_blank" class="btn btn-info btn-xs">Lihat <i class="mdi mdi-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
    <?php
        }
    }
    
    if($jabatan != "7"){
    ?>
        <div class="col-md-12">
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
    <?php
    }
    ?>

    {{--
    <div class="col-lg-6 col-xl-4">
        <div class="card widget-box-three">
            <div class="card-body">
                <div class="float-right mt-2">
                    <i class="mdi mdi-note-multiple-outline text-primary display-4 m-0"></i>
                </div>
                <div class="overflow-hidden">
                    <p class="text-uppercase font-weight-medium text-truncate mb-2">
                        Actbud Terkait GA
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
    <div class="col-lg-6 col-xl-4">
        <div class="card widget-box-three">
            <div class="card-body">
                <div class="float-right mt-2">
                    <i class="mdi mdi-note-multiple-outline text-primary display-4 m-0"></i>
                </div>
                <div class="overflow-hidden">
                    <p class="text-uppercase font-weight-medium text-truncate mb-2">
                        Actbud Terkait ICT
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
    <div class="col-lg-6 col-xl-4">
        <div class="card widget-box-three">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div class="">
                        <p class="text-uppercase font-weight-medium mb-2">
                            Actbud Terkait HRD/Perjalanan Dinas
                        </p>
                        <h2 class="mb-0">
                            <span data-plugin="counterup"> </span>
                        </h2>
                    </div>
                    <div class="">
                        <i class="mdi mdi-note-multiple-outline text-primary display-4 m-0"></i>
                    </div>
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
                    <i class="mdi mdi-note-multiple-outline text-primary display-4 m-0"></i>
                </div>
                <div class="overflow-hidden">
                    <p class="text-uppercase font-weight-medium text-truncate mb-2">
                        Actbud Terkait Kemahasiswaan 
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
    <div class="col-lg-6 col-xl-4">
        <div class="card widget-box-three">
            <div class="card-body">
                <div class="float-right mt-2">
                    <i class="mdi mdi-note-multiple-outline text-primary display-4 m-0"></i>
                </div>
                <div class="overflow-hidden">
                    <p class="text-uppercase font-weight-medium text-truncate mb-2">
                        Actbud Terkait P2M/Riset
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
    <div class="col-lg-6 col-xl-4">
        <div class="card widget-box-three">
            <div class="card-body">
                <div class="float-right mt-2">
                    <i class="mdi mdi-clipboard-multiple-outline text-danger display-4 m-0"></i>
                </div>
                <div class="overflow-hidden">
                    <p class="text-uppercase font-weight-medium text-truncate mb-2">
                        Actbud/Petty Cash Terkait Anggaran
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
                    <i class="mdi mdi-note-text-outline text-success display-4 m-0"></i>
                </div>
                <div class="overflow-hidden">
                    <p class="text-uppercase font-weight-medium text-truncate mb-2">
                        Approval Actbud Warek 1
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
                    <i class="mdi mdi-note-text-outline text-success display-4 m-0"></i>
                </div>
                <div class="overflow-hidden">
                    <p class="text-uppercase font-weight-medium text-truncate mb-2">
                        Approval Actbud Reltor
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
                    <i class="mdi mdi-note-text-outline text-success display-4 m-0"></i>
                </div>
                <div class="overflow-hidden">
                    <p class="text-uppercase font-weight-medium text-truncate mb-2">
                        Approval Actbud Presiden
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
    </div> --}}
@endsection
