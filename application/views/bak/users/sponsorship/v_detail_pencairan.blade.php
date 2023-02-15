@extends('layouts.user')

@section('title', 'Sponsorship - Detail Kegiatan')

@section('page-title')
    <a href="{{ base_url('app/sponsorship/pencairan') }}"><i class="mdi mdi-arrow-left"></i></a> Pencairan
@endsection

@section('css')
<link rel="stylesheet" href="{{ base_url('assets/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ base_url('assets/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ base_url('assets/css/jquery-ui.custom-for-signature.css') }}">
<link rel="stylesheet" href="{{ base_url('assets/css/jquery.signature.css') }}">
<style>
    .kbw-signature { width: 300px; height: 300px;}
    #ttd canvas{
        width: 100% !important;
        height: auto;
    }
</style>
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ base_url('app/sponsorship') }}"><i class="mdi mdi-briefcase-outline"></i> Sponsorship</a></li>
<li class="breadcrumb-item"><a href="{{ base_url('app/sponsorship/pencairan') }}"><i class="mdi mdi-cash-register"></i> Pencairan</a></li>
<li class="breadcrumb-item active"><a href="{{ base_url('app/sponsorship/pencairan/v_detail/' . $CI->uri->segment(5)) }}"><b><i class="mdi mdi-file-document-outline"></i> {{ $data->kode_uraian }}</a></b></li>
@endsection

@section('content')
<div class="col-lg-12">
    <div class="card mb-3">
        <div class="card-header">
            <div class="card-widgets">                
                <a data-toggle="collapse" class="collapsed" href="#card-detail-actbud" role="button" aria-expanded="false" aria-controls=""><i class="mdi mdi-minus"></i></a>                
            </div>            
            <h5 class="card-title mb-0">DETAIL ACTBUD</h5>
        </div>
        <div class="card-body collapse" id="card-detail-actbud">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Kode Uraian</label>
                        <p class="form-control-static"><b><i class="mdi mdi-file-document-outline"></i> {{ $data->kode_uraian }}</b></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Kode Pencairan</label>
                        <p class="form-control-static"><b><i class="mdi mdi-file-document-outline"></i> {{ $data->kode_pencairan }}</b></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">PIC</label>
                        <p class="form-control-static">{{ $data->nama_karyawan . ' ('.$data->nama_unit.')' }}</p>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Nama Kegiatan</label>
                        <p class="form-control-static">{{ $data->nama_hibah_sponsorship }}</p>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Deskripsi Kegiatan</label>
                        <p class="form-control-static">{{ $data->uraian_kegiatan }}</p>
                    </div>
                </div>                
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Periode</label>
                        <p class="form-control-static">
                            @switch($data->periode)
                                @case(1)
                                    Ganjil
                                    @break
                                @case(2)
                                    Genap
                                    @break
                                @default
                                    Unknown
                            @endswitch
                        </p>
                    </div>
                </div>                
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">KPI</label>
                        <p class="form-control-static">{{ $data->kpi }}</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Base Line</label>
                        <p class="form-control-static">{{ $data->base_line }}</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Cara Ukur</label>
                        <p class="form-control-static">{{ $data->cara_ukur }}</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Target</label>
                        <p class="form-control-static">{{ $data->target }}</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Output</label>
                        <p class="form-control-static">{{ $data->output }}</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Tanggal Buat</label>
                        <p class="form-control-static"><i class="mdi mdi-calendar"></i> {{ substr($data->tanggal_buat, 0, 16) }}</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Total Anggaran</label>
                        <p class="form-control-static"><i class="mdi mdi-calendar"></i> {{ rupiah($data->total_agr) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-xl-12">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">DETAIL BIAYA</h5>
        </div>
        <div class="card-body">                      
            <div class="row">
                <div class="col-lg-6 col-xl-4">
                    <div class="card widget-box-three">
                        <div class="card-body">
                            <div class="float-right mt-2">
                                <i class="mdi mdi-cash text-info display-3 m-0"></i>
                            </div>
                            <div class="overflow-hidden">
                                <p class="text-uppercase font-weight-medium text-truncate mb-2">Total Anggaran</p>
                                <h4 class="mb-0">{{ rupiah($data->total_agr) }}</span></h4>                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-4">
                    <div class="card widget-box-three">
                        <div class="card-body">
                            <div class="float-right mt-2">
                                <i class="mdi mdi-cash-refund text-warning display-3 m-0"></i>
                            </div>
                            <div class="overflow-hidden">
                                <p class="text-uppercase font-weight-medium text-truncate mb-2">Sisa anggaran</p>
                                <h4 class="mb-0">{{ rupiah($data->total_agr - $total_anggaran_yang_digunakan) }}</h4>                
                            </div>
                        </div>
                    </div>
                </div>                
                <div class="col-lg-6 col-xl-4">
                    <div class="card widget-box-three">
                        <div class="card-body">
                            <div class="float-right mt-2">
                                <i class="mdi mdi-cash-minus text-danger display-3 m-0"></i>
                            </div>
                            <div class="overflow-hidden">
                                <p class="text-uppercase font-weight-medium text-truncate mb-2">anggaran digunakan</p>
                                <h4 class="mb-0">{{ rupiah($total_anggaran_yang_digunakan) }}</h4>                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="float-right mb-3">
                <a href="{{ base_url('app/sponsorship/pencairan/v_detail/' . $CI->uri->segment(5) . '/buat_pencairan') }}" class="btn btn-success btn-sm">+ Buat Pencairan</a>
            </div>  
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover dataTable">
                    <thead>
                        <tr>
                            <th style="vertical-align: middle;" class="text-center" width="50">No.</th>
                            <th style="vertical-align: middle;" class="text-center">Pic</th>
                            <th style="vertical-align: middle;">Nama Kegiatan</th>
                            <th style="vertical-align: middle;">Deskripsi</th>                        
                            <th style="vertical-align: middle;" class="text-center">Anggaran</th>                            
                            <th style="vertical-align: middle;" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_pencairan as $item)
                            <tr>
                                <th style="vertical-align: middle;" class="text-center" width="50">{{ $loop->iteration }}</th>
                                <th style="vertical-align: middle;">{{ $item->nama_pelaksana }}</th>
                                <th style="vertical-align: middle;">
                                    {{ $item->nama_kegiatan }}
                                    <hr class="mt-1 mb-1">
                                    <span class="badge bg-secondary">
                                        <i class="mdi mdi-calendar"></i> 
                                        {{ tanggal_indo($item->tgl_mulai) . ' s/d ' . tanggal_indo($item->tgl_selesai) }}
                                    </span>
                                </th>
                                <td style="vertical-align: middle;">
                                    @php
                                        $deskripsi_kegiatan = $item->deskripsi_kegiatan;
                                        $pecah = explode(' ', $deskripsi_kegiatan);
                                        $potong = array_slice($pecah, 0, 20);
                                        if(count($pecah) > 20){
                                            echo implode(' ', $potong) . '...';
                                        } else {
                                            echo implode(' ', $potong);
                                        }
                                    @endphp
                                </td>                            
                                <th style="vertical-align: middle;" class="text-center">
                                    {{ rupiah($item->agr) }}
                                </th>                              
                                <th style="vertical-align: middle;" class="text-center">                                
                                    <a href="{{ base_url('app/hibah/pencairan/v_detail/' . $CI->uri->segment(5) . '/actbud/' . encrypt($item->id)) }}" class="btn btn-primary btn-sm col-md-12"><i class="mdi mdi-arrow-right"></i></a>
                                </th>
                            </tr>
                        @endforeach
                    </tbody>
                    <!--<tfoot>
                        <tr>
                            <td></td>
                            <th colspan="3" style="vertical-align: middle;text-align:right;">Total Anggaran Yang Diajukan :</th>
                            <th style="vertical-align: middle" class="text-center">{{ rupiah($total_anggaran_yang_digunakan) }}</th>
                            <td></td>
                            <td></td>
                        </tr>
                    </tfoot>-->
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade bs-example-modal-lg" id="modal-buat-pencairan" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Buat Pencairan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="{{ base_url('assets/js/jquery.signature.min.js') }}"></script>
<script src="{{ base_url('assets/js/jquery.ui.touch-punch.min.js') }}"></script>

<script src="{{ base_url('assets/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ base_url('assets/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ base_url('assets/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ base_url('assets/js/responsive.bootstrap4.min.js') }}"></script>

<script src="{{ base_url('assets/js/jquery.steps.min.js') }}"></script>
<script src="{{ base_url('assets/js/jquery.validate.min.js') }}"></script>
<script src="{{ base_url('assets/js/form-wizard.init.js') }}"></script>
<script>
    $(document).ready(function(){

        $('.dataTable').dataTable({
            stateSave: true
        })

    })
</script>
@endsection