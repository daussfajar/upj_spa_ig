@extends('ig.layouts.user')

@section('title', 'Pencairan Sponsorship')

@section('page-title')
    <i class="mdi mdi-clipboard-list-outline"></i> Pencairan
@endsection

@section('css')
<link rel="stylesheet" href="{{ base_url('assets/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ base_url('assets/css/responsive.bootstrap4.min.css') }}">
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="javascript: void(0);"><i class="mdi mdi-briefcase-outline"></i> Sponsorship</a></li>
<li class="breadcrumb-item active"><a href="javascript: void(0);"><i class="mdi mdi-clipboard-list-outline"></i> Pencairan</a></li>
@endsection

@section('content')
    <!--<div class="col-lg-6 col-xl-3">
        <div class="card widget-box-three">
            <div class="card-body">
                <div class="float-right mt-2">
                    <i class="mdi mdi-cash-register text-info display-3 m-0"></i>
                </div>
                <div class="overflow-hidden">
                    <p class="text-uppercase font-weight-medium text-truncate mb-2">Anggaran</p>
                    <h2 class="mb-0">3</h2>                    
                </div>
            </div>           
        </div>
    </div>-->

    <div class="col-md-12">
        <div class="card-box mt-2">
            <div class="row mb-3">                    
                <div class="col-md-8 col-sm-8 col-xs-12">
                    <div class="float-right">
                        <a href="javascript:void(0)" class="btn btn-secondary btn-sm"><i class="mdi mdi-filter"></i></a>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <form action="{{ base_url('app/sponsorship/pencairan') }}" class="myForm" method="GET" accept-charset="utf-8" autocomplete="off">                        
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
                @else
                    <div class="alert alert-info">
                        <p class="mb-0"><i class="mdi mdi-magnify"></i> Hasil pencarian dari: "<b>{{ $CI->input->get('q', true) }}</b>"</p>                    
                    </div>
                @endif
            @endif
            <div class="table-responsive">
                <table id="tb_data_hibah" class="table table-striped table-bordered dt-responsive nowrap">
                    <thead class="bg-purple text-white">
                        <tr>
                            <th width=50 class="text-center" style="vertical-align: middle;">No</th>
                            <!--<th width=200 style="vertical-align: middle;">Kode Uraian</th>-->
                            <th class="text-center" style="vertical-align: middle;">Kode Pencairan</th>
                            <th class="text-center" style="vertical-align: middle;">PIC</th>
                            <th style="vertical-align: middle;">Nama Sponsorship</th>
                            <th style="vertical-align: middle;">Deskripsi Kegiatan</th>
                            <th class="text-center" style="vertical-align: middle;">Periode</th>
                            <th class="text-center" style="vertical-align: middle;">Anggaran</th>
                            <th class="text-center" style="vertical-align: middle;">Realisasi</th>
                            <th class="text-center" style="vertical-align: middle;">Sisa</th>
                            <!--<th class="text-center" width="250" style="vertical-align: middle;">Tanggal Buat</th>-->
                            <th class="text-center" style="vertical-align: middle;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>                        
                        @if (empty($data['data']))
                            <tr>
                                <th colspan="10" class="text-center">Tidak ada data</th>
                            </tr>
                        @else
                        @php
                            $no = (empty($CI->uri->segment(4)) ? 0 : $CI->uri->segment(4) + 0);
                        @endphp
                            @foreach ($data['data'] as $row)
                                @php
                                    $no++
                                @endphp
                                <tr>
                                    <th class="text-center" style="vertical-align: middle">{{ $no }}</th>
                                    <!--<th style="vertical-align: middle;"><a href="{{ base_url('app/hibah/pencairan/detail_hibah/' . encrypt($row['id'])) }}">{{ $row['kode_uraian'] }}</a></th>-->
                                    <th style="vertical-align: middle;">
                                        <span class="badge bg-secondary">
                                            {{ $row['kode_pencairan'] }}
                                        </span>
                                    </th>
                                    <td style="vertical-align: middle;">
                                        <span class="" style="font-size: 14px;">
                                            {{ $row['nama_karyawan'] }} ({{ $row['pic'] }})
                                        </span>
                                    </td>
                                    <td style="vertical-align: middle;">
                                        <span class="" style="font-size: 14px;">
                                            {{ $row['nama_hibah_sponsorship'] }}
                                        </span>
                                    </td>      
                                    <td style="vertical-align: middle;">
                                        <span style="font-size: 14px;">
                                            {{ $row['uraian_kegiatan'] }}
                                        </span>
                                    </td>                              
                                    <td class="text-center" style="vertical-align: middle;">
                                        <span class="badge bg-warning">
                                            @switch($row['periode'])
                                                @case(1)
                                                    {{ "Ganjil" }}
                                                    @break
                                                @case(2)
                                                    {{ "Genap" }}
                                                    @break
                                                @default
                                                    {{ "Unknown" }}                                            
                                            @endswitch
                                        </span>
                                    </td>
                                    <td class="text-center" style="vertical-align: middle;">
                                        @php
                                            $getSum = $CI->db->query(sprintf("SELECT SUM(a.fnl_agr) digunakan FROM 
                                            ig_tbl_actbud a WHERE a.id_uraian = '%u' 
                                            AND a.status_act = 'send' AND (a.status != 'cancel')", $row['id']))->row();
                                            $getSumIn = $CI->db->query(sprintf("SELECT SUM(b.nominal) saldo_masuk FROM 
                                            ig_tbl_in_out b WHERE b.kode_uraian = '%s' 
                                            AND b.disetujui = 'Y' AND b.jenis_kredit = 'in'", $row['kode_uraian']))->row();
                                            $getSumOut = $CI->db->query(sprintf("SELECT SUM(b.nominal) saldo_keluar FROM 
                                            ig_tbl_in_out b WHERE b.kode_uraian = '%s' 
                                            AND b.disetujui = 'Y' AND b.jenis_kredit = 'out'", $row['kode_uraian']))->row();									
                                            echo '<span class="badge bg-success">'.rupiah($row['total_agr'] + $getSumIn->saldo_masuk - $getSumOut->saldo_keluar).'</span>';
                                        @endphp
                                    </td>
                                    <td class="text-center" style="vertical-align: middle;">
                                        <span class="badge bg-teal">
                                            {{ rupiah($getSum->digunakan) }}
                                        </span>
                                    </td>
                                    <td class="text-center" style="vertical-align: middle;">
                                        @php                                                                                        								
                                            echo '<span class="badge bg-primary">'.rupiah($row['total_agr'] - $getSum->digunakan + $getSumIn->saldo_masuk - $getSumOut->saldo_keluar).'</span>';
                                        @endphp
                                    </td>
                                    <td class="text-center" style="vertical-align: middle;">
                                        <a href="{{ base_url('app/sponsorship/pencairan/v_detail/' . encrypt($row['id']) . '/buat_pencairan') }}" class="badge bg-primary btn-sm">Buat Pencairan <i class="mdi mdi-arrow-right"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            <span class="badge badge-info">Total Data: {{ $data['total_rows'] }}</span>
            {!! $data['pagination'] !!}
        </div>
    </div>
@endsection

@section('js')
<script src="{{ base_url('assets/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ base_url('assets/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ base_url('assets/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ base_url('assets/js/responsive.bootstrap4.min.js') }}"></script>

<script>
    $(document).ready(function(){        
                
    })
</script>
@endsection