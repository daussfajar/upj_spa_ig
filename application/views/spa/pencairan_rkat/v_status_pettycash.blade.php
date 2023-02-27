<?php
$session = $CI->session->userdata('user_sessions'); ?>
@extends('spa.layouts.user')

@section('title')
    <?= MOD2 ?> Pencairan RKAT - Status Petty Cash
@endsection

@section('page-title')
    Status Persetujuan Petty Cash
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="javascript: void(0);">Pencairan RKAT</a></li>
    <li class="breadcrumb-item active"><a href="javascript: void(0);">Status Petty Cash</a></li>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ base_url('assets/css/dataTables.bootstrap4.min.css') }}" />
    <link rel="stylesheet" href="{{ base_url('assets/css/responsive.bootstrap4.min.css') }}" />
    <link rel="stylesheet" href="{{ base_url('assets/css/select2.min.css') }}" />
    <link rel="stylesheet" href="{{ base_url('assets/css/bootstrap-select.min.css') }}" />
@endsection

@section('content')
    <div class="col-md-12">
        <div class="card mt-2">
            <div class="card-header">
                PIC:
            </div>
            <div class="row my-3 px-4">
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
            <div class="table-responsive px-4">
                <table id="tb_data_petty_cash" class="table table-striped table-bordered dt-responsive nowrap">
                    <thead class="bg-purple text-white text-center">
                        <tr>
                            <th width="50" style="vertical-align: middle">No</th>
                            <th style="vertical-align: middle">No Dokumen</th>
                            <th style="vertical-align: middle">Kode Pencairan</th>
                            <th style="vertical-align: middle">Nama Kegiatan</th>
                            <th class="text-center" style="vertical-align: middle">
                                Anggaran
                            </th>
                            <th style="vertical-align: middle">Status Approval</th>
                            <th style="vertical-align: middle">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tb-petty-cash"></tbody>
                </table>
            </div>
        </div>
    </div>
@section('js')
@endsection
@endsection