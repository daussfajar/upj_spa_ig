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

    <div class="col-md-12">
        <div class="card-box mt-2">
            <div class="row mb-3">
                <div class="col-md-8 col-sm-8 col-xs-12">
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <form action="" method="" accept-charset="utf-8" autocomplete="off" class="myForm">
                        <div class="input-group">
                            <input type="search" id="" value="" name="" class="form-control"
                                placeholder="Cari data...">
                            <span class="input-group-prepend">
                                <button type="submit" class="btn waves-effect waves-light btn-primary btn-sm">
                                    <i class="mdi mdi-magnify mdi-18px"></i>
                                </button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
            <div class="table-responsive">
                <table id="tb_data_actbud" class="table table-striped table-bordered dt-responsive nowrap">
                    <thead class="bg-purple text-white text-center">
                        <tr>
                            <th width="50" style="vertical-align: middle">No</th>
                            <th style="vertical-align: middle">Uraian</th>
                            <th style="vertical-align: middle">Kode Pencairan</th>
                            <th style="vertical-align: middle">Ganjil</th>
                            <th class="text-center" style="vertical-align: middle">Genap</th>
                            <th width="200" style="vertical-align: middle">Sisa</th>
                            <th width="200" style="vertical-align: middle">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tb-actbud"></tbody>
                </table>
            </div>
        </div>
    </div>
    </div>

@section('js')
    <script src="{{ base_url('assets/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ base_url('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ base_url('assets/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ base_url('assets/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ base_url('assets/js/responsive.bootstrap4.min.js') }}"></script>

    
@endsection
@endsection
