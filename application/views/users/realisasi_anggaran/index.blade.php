@extends('layouts.user')

@section('title', 'Realisasi Anggaran Kegiatan')

@section('page-title')
<i class="mdi mdi-briefcase-outline"></i> Realisasi Anggaran
@endsection

@section('css')
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="javascript: void(0);"><i class="mdi mdi-briefcase-outline"></i> Realisasi Anggaran</a></li>
@endsection

@section('content')
    <div class="col-md-12">
        @if ($count_belum_realisasi->total > 0)                    
            <div class="alert alert-info">
                <p class="mb-0"><i class="mdi mdi-information-variant"></i><b>Informasi</b> : Ada <span style="font-weight: bold;">{{ $count_belum_realisasi->total }}</span> kegiatan yang belum di finalisasi.</p>
            </div>
        @endif

        <div class="card-box mt-2">
            <div class="row mb-3">                    
                <div class="col-md-8 col-sm-8 col-xs-12">
                    <div class="float-right">
                        <a href="javascript:void(0)" onclick="return alert('Coming soon')" class="btn btn-secondary btn-sm"><i class="mdi mdi-filter"></i></a>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <form action="{{ base_url('app/realisasi_anggaran') }}" method="GET" accept-charset="utf-8" autocomplete="off">                        
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
                <table id="tb_data_realisasi" class="table table-striped table-bordered dt-responsive nowrap">
                    <thead class="bg-purple text-white">
                        <tr>
                            <th width=50 class="text-center" style="vertical-align: middle;">No</th>
                            <th style="vertical-align: middle;">Kode Actbud</th>
                            <th width=200 style="vertical-align: middle;">Nama Kegiatan</th>
                            <th class="text-center" style="vertical-align: middle;">Anggaran</th>                      
                            <th class="text-center" style="vertical-align: middle;">Kode Pencairan</th>
                            <th class="text-center" style="vertical-align: middle;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (empty($data['data']))
                            <tr>
                                <th colspan="6" class="text-center">Tidak ada data</th>
                            </tr>
                        @else
                        @php                            
                            $no = (empty($CI->uri->segment(3)) ? 0 : $CI->uri->segment(3) + 0);                            
                        @endphp
                        @foreach ($data['data'] as $row)
                            @php
                                $jabatan = $_SESSION['user_sessions']['kode_jabatan'];
                                $no++;                                
                            @endphp
                            <tr>
                                <th class="text-center" style="vertical-align: middle;">{{ $no }}</th>
                                <th style="vertical-align: middle;font-weight:bold;" title="Tanggal Pembuatan: {{ $row['tanggal_pembuatan'] }}">
                                    <a href="{{ base_url('app/realisasi_anggaran/history/v_detail/' . encrypt($row['id_uraian']) . '/actbud/' . encrypt($row['id'])) }}" class="badge bg-primary p-2">
                                        <i class="mdi mdi-file"></i> {{ $row['jenis_actbud'] . '/' . $row['id'] }}
                                    </a>
                                </th>
                                <td style="vertical-align: middle;">
                                    <span style="font-size: 14px;font-weight:bold;">
                                        {!! $row['nama_kegiatan'] !!}
                                    </span>
                                    <hr class="mt-0 mb-0">
                                    <span style="font-size:12px;line-height:5px;">
                                        @php
                                        $ex_ket = explode(' ', $row['deskripsi_kegiatan']);
                                        $potong = array_splice($ex_ket, 0, 10);
                                        $extnds = '';
                                        if(count($ex_ket) > 10){
                                        $extnds .= '...';
                                        }
                                        echo implode(' ', $potong) . $extnds;
                                        @endphp
                                    </span>
                                    
                                    <span class="badge bg-secondary p-2">
                                        <i class="mdi mdi-calendar"></i> {{ tanggal_indo($row['tgl_mulai']) . ' s/d ' . tanggal_indo($row['tgl_selesai']) }}
                                    </span>
                                </td>
                                <td class="text-center" style="vertical-align: middle;">
                                    <span style="font-weight:bold;font-size:13px;">Diajukan : </span>
                                    <span class="badge bg-success p-2">
                                        {{ rupiah($row['agr']) }}
                                    </span>
                                    <hr class="mt-1 mb-1">
                                    <span style="font-weight:bold;font-size:13px;">Realisasi : </span>
                                    @php
                                        $agr_realisasi = $CI->db->query("SELECT SUM(a.total_anggaran_realisasi) total FROM ig_t_j_b_act a 
                                        WHERE a.id_actbud = '$row[id]' AND a.status = 'Aktif'")->row();
                                    @endphp
                                    <span class="badge {{ $row['realisasi'] == 'Y' ? 'bg-primary' : 'bg-danger' }} p-2">
                                        {{ rupiah($agr_realisasi->total) }} {{ $row['realisasi'] == 'Y' ? '' : '(Belum Finalisasi)' }}
                                    </span>
                                </td>
                                <th class="text-center" style="vertical-align: middle;">
                                    <span class="badge bg-purple p-2">
                                        {{ $row['kode_pencairan'] }}
                                    </span>
                                    <hr class="mt-1 mb-0">
                                    <span class="" style="font-size: 12px;">                                        
                                        {!! ucfirst($row['nama_pic']).' <br>('.$row['nama_unit_pic'].')' !!}                                        
                                    </span>
                                </th>
                                <td class="text-center" style="vertical-align:middle;">
                                    <a href="{{ base_url('app/realisasi_anggaran/actbud/' . encrypt($row['id']) . '/' . encrypt($row['id_uraian'])) }}" class="">
                                        <i class="mdi {{ $row['realisasi'] == 'N' ? 'mdi-lock-open-variant' : 'mdi-lock' }}"></i>
                                    </a>
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
    
<script>
    $(document).ready(function(){
        
    })
</script>
@endsection