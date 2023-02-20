@extends('ig.layouts.user')

@section('title', 'Pengalihan Anggaran')

@section('page-title')
    Pengalihan Anggaran
@endsection

@section('css')
<link rel="stylesheet" href="{{ base_url('assets/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ base_url('assets/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ base_url('assets/css/bootstrap-select.min.css') }}">
<style>
    .kbw-signature { width: 300px; height: 300px;}
    #ttd canvas{
        width: 100% !important;
        height: auto;
    }
</style>
@endsection

@section('breadcrumb')
<li class="breadcrumb-item active"><a href="javascript: void(0);">Pengalihan Anggaran</a></li>
@endsection

@section('content')
<div class="col-md-12">    
    <div class="float-right">
        <a href="javascript:void(0)" data-toggle="modal" data-target="#modal-upload-saldo" class="btn btn-sm btn-info mr-1"><i class="mdi mdi-upload"></i> Upload</a>
        <a href="{{ base_url('app/sim-ig/pengalihan-anggaran/buat') }}" class="btn btn-success btn-sm"><i class="mdi mdi-plus"></i> Buat Pengalihan Anggaran</a>
    </div>
    <br><br>
    <div class="card card-border card-dark">
        <div class="card-header border-dark bg-transparent">
            <h3 class="card-title text-dark mb-0">Data Pengalihan Anggaran</h3>
        </div>
        <div class="card-body">
            <div class="row mb-3">                    
                <div class="col-md-8 col-sm-8 col-xs-12">
                    <div class="float-right">
                        <a href="javascript:void(0)" onclick="return alert('Coming soon')" class="btn btn-secondary btn-sm"><i class="mdi mdi-filter"></i></a>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <form action="{{ base_url('app/sim-ig/pengalihan-anggaran') }}" method="GET" accept-charset="utf-8" autocomplete="off" class="myForm">
                        <div class="input-group">
                            <input type="search" id="q" value="{{ !empty($_GET['q']) ? $_GET['q'] : '' }}" name="q" class="form-control" placeholder="Cari data...">
                            <span class="input-group-prepend">
                                <button type="submit" class="btn waves-effect waves-light btn-primary btn-sm"><i class="mdi mdi-magnify mdi-18px"></i></button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>

            @if (isset($_GET['q']) && $CI->input->get('q', true) !== "")
                @if (empty($data['data']))
                <div class="col-md-12">
                    <div class="alert alert-info">
                        <p class="mb-0">Pencarian anda <b>- {{ $CI->input->get('q', true) }} -</b> tidak ada dalam data.</p>
                        <p class="mb-0">
                            Saran:
                            <ul class="mb-0">
                                <li>Pastikan bahwa semua kata dieja dengan benar.</li>
                                <li>Coba kata kunci yang berbeda.</li>
                                <li>Coba kata kunci yang lebih umum.</li>
                            </ul>
                        </p>
                    </div>
                </div>
                @else
                <div class="col-md-12">
                    <div class="alert alert-info">
                        <p class="mb-0"><i class="mdi mdi-magnify"></i> Hasil pencarian dari: "<b>{{ $CI->input->get('q', true) }}</b>"</p>                    
                    </div>
                </div>
                @endif
            @endif

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="bg-dark text-white">
                        <tr>
                            <th class="text-center" style="vertical-align: middle;" rowspan="2">No</th>
                            <th style="vertical-align: middle;" class="text-center" rowspan="2">Pengaju/PIC</th>
                            <th style="vertical-align: middle;" rowspan="2">Keterangan</th>
                            <th style="vertical-align: middle;" class="text-center" colspan="2">Pengalihan Asal</th>
                            <th style="vertical-align: middle;" class="text-center" colspan="2">Pengalihan Tujuan</th>
                            <th style="vertical-align: middle;" rowspan="2" class="text-center">Nominal Pengalihan</th>
                            <th style="vertical-align: middle;" rowspan="2" class="text-center">Status</th>
                        </tr>
                        <tr>
                            <th style="vertical-align: middle;" class="text-center">Kode Pencairan Asal</th>
                            <th style="vertical-align: middle;" class="text-center">Saldo Sebelum Pengalihan</th>
                            <th style="vertical-align: middle;" class="text-center">Kode Pencairan Tujuan</th>
                            <th style="vertical-align: middle;" class="text-center">Saldo Sebelum Pengalihan</th>
                        </tr>                        
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{ base_url('assets/js/select2.min.js') }}"></script>
<script src="{{ base_url('assets/js/bootstrap-select.min.js') }}"></script>
<script src="{{ base_url('assets/js/bootstrap-filestyle.min.js') }}"></script>
<script>
    $(document).ready(function(){
        $('.dataTable').dataTable({
            stateSave: true
        })
    })
</script>
@endsection