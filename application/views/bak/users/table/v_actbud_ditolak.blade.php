@extends('layouts.user')

@section('title', 'Actbud Disetujui')

@section('page-title')
    <i class="mdi mdi-table"></i> Actbud Ditolak
@endsection

@section('css')
<link rel="stylesheet" href="{{ base_url('assets/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ base_url('assets/css/responsive.bootstrap4.min.css') }}">
@endsection

@section('breadcrumb')
<li class="breadcrumb-item active"><a href="javascript: void(0);"><i class="mdi mdi-table"></i> Actbud Ditolak</a></li>
@endsection

@section('content')
    <div class="col-md-12">
        <div class="card-box">
            <div class="table-responsive">
                <table class="table table-striped table-bordered dataTable">
                    <thead class="bg-purple text-white">
                        <tr>
                            <th class="text-center" width=30>No</th>
                            <th>Kode Uraian</th>
                            <th>Kode Pencairan</th>
                            <th class="text-center">Nama Kegiatan</th>
                            <th class="text-center">Tanggal Pelaksanaan</th>
                            <th class="text-center">Jenis</th>
                            <th class="text-center">Anggaran</th>
                            <th class="text-center">Status</th>                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($actbud as $item)
                            <tr>
                                <th class="text-center" style="vertical-align: middle;">{{ $loop->iteration }}</th>
                                <td style="vertical-align: middle;">
                                    <span class="badge bg-primary p-2">
                                        {{ $item->kode_uraian }}
                                    </span>
                                </td>
                                <td style="vertical-align: middle;">
                                    <span class="badge bg-secondary p-2">
                                        {{ $item->kode_pencairan }}
                                    </span>
                                </td>
                                <td style="vertical-align: middle;font-size:14px;">
                                    <a href="javascript:void(0)" onclick="window.open('{{ base_url('app/' . $item->jenis_anggaran . '/pencairan/v_detail/' . encrypt($item->id_uraian) . '/actbud/' . encrypt($item->id)) }}', 'MsgWindow', 'width=800,height=800')">{!! $item->nama_kegiatan !!}</a>
                                </td>
                                <td style="vertical-align: middle;">
                                    <span class="badge bg-dark text-white p-2">
                                        {{ tanggal_indo($item->tgl_mulai) }} s/d {{ tanggal_indo($item->tgl_selesai) }}
                                    </span>
                                </td>
                                <td style="vertical-align: middle;" class="text-center">
                                    @switch($item->jenis_anggaran)
                                        @case('hibah')
                                            <span class="badge badge-warning p-2">Hibah</span>
                                            @break
                                        @case('sponsorship')
                                            <span class="badge badge-warning p-2">Sponsorship</span>
                                            @break
                                        @default
                                            
                                    @endswitch
                                </td>
                                <td style="vertical-align: middle;" class="text-center">
                                    <span class="badge bg-purple p-2">
                                        {{ rupiah($item->agr) }}
                                    </span>
                                </td>
                                <td style="vertical-align: middle;" class="text-center">
                                    <span class="badge badge-danger"><i class="mdi mdi-close"></i> Ditolak</span>                                    
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
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
        $('.dataTable').dataTable({
            stateSave: true
        })
    })
</script>
@endsection