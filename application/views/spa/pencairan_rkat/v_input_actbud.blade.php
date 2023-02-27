<?php
$session = $CI->session->userdata('user_sessions');
?>
@extends('spa.layouts.user')

@section('title')
    <?= MOD2 ?> Pencairan RKAT - Input Acbud
@endsection

@section('page-title')
    Input Actbud
@endsection

@section('css')
    
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="javascript: void(0);">Pencairan RKAT</a></li>
    <li class="breadcrumb-item active"><a href="javascript: void(0);">Input Actbud</a></li>
@endsection

@section('content')    
    @if ($session['kode_jabatan'] == 7)
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
    @endif    
@endsection
