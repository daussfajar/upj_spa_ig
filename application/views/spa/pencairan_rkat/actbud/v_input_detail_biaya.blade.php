@php
//pr($data);
@endphp
@extends('spa.layouts.user')

@section('title')
<?= MOD2 ?> Input Detail Biaya
@endsection

@section('page-title')
Input Detail Biaya
@endsection

@section('css')
<link rel="stylesheet" href="{{ base_url('assets/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ base_url('assets/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ base_url('assets/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ base_url('assets/css/bootstrap-select.min.css') }}">
<link rel="stylesheet" href="{{ base_url('assets/css/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ base_url('assets/css/bootstrap-datepicker.min.css') }}">

<link href="{{ base_url('assets/css/tooltipster.css') }}" rel="stylesheet" type="text/css">
<style>
    .messages {
        width: 100%;
        min-height: 200px;
        max-height: 300px;
        overflow-x: hidden;
        overflow-y: auto;
        font-size: 14px;
    }
    .btn-file {
        position: relative;
        overflow: hidden;
    }
    .btn-file input[type=file] {
        position: absolute;
        top: 0;
        right: 0;
        min-width: 100%;
        min-height: 100%;
        /*font-size: 999px;*/
        text-align: right;
        opacity: 0;
        outline: none;
        background: #fff;
        cursor: pointer;
        display: block;
    }
    .d-none{
        display: none;
    }
    .bs4-order-tracking {
		/*margin-bottom: 30px;*/
		overflow: hidden;
		color: #878788;
		padding-left: 0px;
		margin-top: 30px;
	}

	.bs4-order-tracking li {
		list-style-type: none;
		font-size: 13px;
		width: 20%;
		float: left;
		position: relative;
		font-weight: 400;
		color: #878788;
		text-align: center;
	}

	.bs4-order-tracking li:first-child:before {
		margin-left: 15px !important;
		padding-left: 11px !important;
		text-align: left !important;
	}

	.bs4-order-tracking li:last-child:before {
		margin-right: 5px !important;
		padding-right: 11px !important;
		text-align: right !important;
	}

	.bs4-order-tracking li>div {
		color: #fff;
		width: 29px;
		text-align: center;
		line-height: 29px;
		display: block;
		font-size: 12px;
		background: #878788;
		border-radius: 50%;
		margin: auto;
	}

	.bs4-order-tracking li:after {
		content: '';
		width: 150%;
		height: 2px;
		background: #878788;
		position: absolute;
		left: 0%;
		right: 0%;
		top: 15px;
		z-index: -1;
	}

	.bs4-order-tracking li:first-child:after {
		left: 50%;
	}

	.bs4-order-tracking li:last-child:after {
		left: 0% !important;
		width: 0% !important
	}

	.bs4-order-tracking li.active {
		font-weight: bold;
		color: #000;
	}

	.bs4-order-tracking li.active>div {
		background: #28a745;
	}

    .bs4-order-tracking li.active>div:hover {	
        background: red;	        
        cursor: pointer;
        transition: all .2s ease-in-out;        
	}

	.bs4-order-tracking li.active:after {
		background: #28a745;
	}

	.card-timeline {
		background-color: #fff;
		z-index: 0;
	}
    
    .m-signature-pad-body{
        border: 1px dashed #ccc;
        border-radius: 5px;
        color: #bbbabb;
        height: 253px;
        width: 100%;
        text-align: center;
        float: right;
        vertical-align: middle;
        top: 73px;
        position: inline-block;
        left: 33px;
    }
    .m-signature-pad-footer{
        bottom: 250px;
        left: 218px;
        position: inline-block;
    }
</style>
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="javascript: void(0);">Pencairan RKAT</a></li>
<li class="breadcrumb-item"><a href="javascript: void(0);">Actbud</a></li>
<li class="breadcrumb-item active"><a href="javascript: void(0);">#{{ $id_actbud }}</a></li>
@endsection

@section('content')
	<div class="col-md-12">
		<div class="card card-border card-teal">
			<div class="card-header border-teal bg-transparent">
				<div class="float-left">
					<h3 class="card-title mb-0"><i class="mdi mdi-file-document-outline"></i> DETAIL ACTBUD</h3>
				</div>
				<div class="float-right">
					<span class="badge bg-info p-2" style="font-weight:bold;">
						<i class="mdi mdi-file-document"></i> {{ ($data['jns_aju_agr'] == "actbud") ? "ACT" : "PTY" }}/{{ $id_actbud }}
					</span>
				</div>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<label for="">Prodi / Bagian / Unit</label>
							<p class="form-control-static" style="font-size: 14px;">{{ $data['nama_unit'] }}</p>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="">Nama Kegiatan</label>
							<p class="form-control-static" style="font-size: 14px;">{{ $data['deskrip_keg'] }}</p>
						</div>
					</div>                
					<div class="col-md-4">
						<div class="form-group">
							<label for="">KPI</label>
							<p class="form-control-static" style="font-size: 14px;">{{ $data['kpi'] }}</p>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="">PIC</label>
							<p class="form-control-static">
								<span class="" style="font-size: 14px;">
									{{ $data['nama_lengkap'] . ' (' . $data['pic'] . ')' }}
								</span>
							</p>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="">Pelaksana</label>
							<p class="form-control-static">
								<span class="" style="font-size: 14px;">
									{{ $data['nama_pelaksana'] . ' (' . $data['pelaksana'] . ')' }}
								</span>
							</p>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="">Tanggal Pelaksanaan</label>
							<p class="form-control-static">
								<span class="badge bg-secondary p-2">
									<?php 
									$tgl_m = date_create($data['tgl_m']);									
									$tgl_s = date_create($data['tgl_s']);
									?>
									<i class="mdi mdi-calendar"></i> {{ tanggal_indo(date_format($tgl_m, "Y-m-d")) . ' s/d ' . tanggal_indo(date_format($tgl_s, "Y-m-d")) }}
								</span>
							</p>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="">Periode</label>
							<p class="form-control-static">
								<span class="badge bg-warning p-2">
									{{ $data['periode'] }}
								</span>
							</p>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="">Total Anggaran</label>
							<p class="form-control-static">
								<span class="badge bg-purple p-2">
									{{ rupiah_1($data['t_act_agr']) }}
								</span>
							</p>
						</div>
					</div>                
					<div class="col-md-4">
						<div class="form-group">
							<label for="">Tanggal Pengajuan</label>
							<p class="form-control-static">
								@if (!empty($data['tanggal_pembuatan']))
									<?php 
									$ex_tgl_buat = explode(' ', $data['tanggal_pembuatan']);
									?>
									<span class="badge p-2 bg-teal text-white">
										<i class="mdi mdi-clock-check-outline"></i> {{ tanggal_indo($ex_tgl_buat[0]) . ', ' . $ex_tgl_buat[1] }}
									</span>
								@else
									-
								@endif
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection