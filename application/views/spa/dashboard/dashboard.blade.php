<?php
$session = $CI->session->userdata('user_sessions');
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
    @endsection @section('content')
    @if ($session['kode_jabatan'] == 7)
        <div class="col-lg-6 col-xl-4">
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
        <div class="col-lg-6 col-xl-4">
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
        <div class="col-lg-6 col-xl-4">
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
    @endif


    <div class="col-lg-6 col-xl-3">
        <div class="card widget-box-three">
            <div class="card-body">
                <div class="float-right mt-2">
                    <i class="mdi mdi-clipboard-multiple-outline text-purple display-4 m-0"></i>
                </div>
                <div class="overflow-hidden">
                    <p class="text-uppercase font-weight-medium text-truncate mb-2">
                        Permohonan Actbud Terkait ICT
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
                        Permohonan Approval Actbud oleh Unit
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
                    <i class="mdi mdi-list-status text-primary display-4 m-0"></i>
                </div>
                <div class="overflow-hidden">
                    <p class="text-uppercase font-weight-medium text-truncate mb-2">
                        Status Actbud Yang Diajukan
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


    {{-- admin --}}


    {{-- <div class="col-lg-6 col-xl-6">
        <div class="card widget-box-three">
            <div class="card-body">
                <div class="float-right mt-2">
                    <i class="mdi mdi-briefcase-outline text-purple display-4 m-0"></i>
                </div>
                <div class="overflow-hidden">
                    <p class="text-uppercase font-weight-medium text-truncate mb-2">
                        Jumlah Permohonan Approval FHB
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
    <div class="col-lg-6 col-xl-6">
        <div class="card widget-box-three">
            <div class="card-body">
                <div class="float-right mt-2">
                    <i class="mdi mdi-briefcase-outline text-purple display-4 m-0"></i>
                </div>
                <div class="overflow-hidden">
                    <p class="text-uppercase font-weight-medium text-truncate mb-2">
                        Jumlah Permohonan Approval FTD
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
                <div class="float-right mt-2">
                    <i class="mdi mdi-note-multiple-outline text-primary display-4 m-0"></i>
                </div>
                <div class="overflow-hidden">
                    <p class="text-uppercase font-weight-medium text-truncate mb-2">
                        Actbud Terkait HRD/Perjalanan Dinas
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
                        Approval Actbud Warek 2
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
