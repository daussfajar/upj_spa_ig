@extends('layouts.user')

@section('title', 'Riwayat Approval')

@section('page-title')
    Riwayat Approval
@endsection

@section('css')
<link rel="stylesheet" href="{{ base_url('assets/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ base_url('assets/css/responsive.bootstrap4.min.css') }}">
@endsection

@section('breadcrumb')
<li class="breadcrumb-item active"><a href="javascript: void(0);"><i class="mdi mdi-briefcase-outline"></i> Riwayat Approval</a></li>
@endsection

@section('content')
<div class="col-md-12">        
    <div class="card-box mt-2">
        <div class="row mb-3">                    
            <div class="col-md-8 col-sm-8 col-xs-12">
                <div class="float-left">
                    
                </div>
                <div class="float-right">                        
                    <a href="javascript:void(0)" class="btn btn-secondary btn-sm"><i class="mdi mdi-filter"></i></a>
                </div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <form action="{{ base_url('app/riwayat_approval') }}" method="GET" accept-charset="utf-8" autocomplete="off">
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
            <table id="tb_approval" class="table table-striped table-bordered dt-responsive nowrap">
                <thead class="bg-purple text-white">
                    <tr>
                        <th width=50 class="text-center" style="vertical-align: middle;">No</th>
                        <th style="vertical-align: middle;">Kode Actbud</th>
                        <th width=200 style="vertical-align: middle;">Kode Pencairan</th>
                        <th style="vertical-align: middle;">Nama Kegiatan</th> 
                        <th style="vertical-align: middle;" class="text-center">Jenis</th>                            
                        <th class="text-center" style="vertical-align: middle;">Anggaran</th>
                        <th class="text-center" style="vertical-align: middle;">PIC</th>
                        <th class="text-center" style="vertical-align: middle;">Pelaksana</th>
                        <th class="text-center" style="vertical-align: middle;" width=100>Aksi</th>
                    </tr>
                </thead>
                <tbody id="tb-approval">
                    @if (empty($data['data']))
                            <tr>
                                <th colspan="9" class="text-center">Tidak ada data</th>
                            </tr>
                        @else
                        @php
                            $no = (empty($CI->uri->segment(3)) ? 0 : $CI->uri->segment(3) + 0);
                        @endphp
                            @foreach ($data['data'] as $row)
                                @php
                                    $no++
                                @endphp
                                <tr>
                                    <th class="text-center" style="vertical-align: middle;">{{ $no }}</th>
                                    <th style="vertical-align: middle">
                                        <span class="badge bg-purple">
                                            {{ $row['kode_uraian'] }}
                                        </span>
                                    </th>
                                    <th style="vertical-align: middle">
                                        <span class="badge bg-primary">
                                            {{ $row['kode_pencairan'] }}
                                        </span>
                                    </th>
                                    <td style="vertical-align: middle">
                                        @php
                                            $nama_kegiatan = $row['nama_kegiatan'];
                                            $p_ctn = explode(' ', $nama_kegiatan);
                                            $s_ctn = array_slice($p_ctn, 0, 20);
                                            $r_ctn = array_slice($p_ctn, 20);
                                            $t_ctn = '';
                                            $rd_more = ' <a href="javascript:void(0)" data-message="'.implode(' ', $r_ctn).'" class="btn-rd_more" 
                                            data-sp_class="el-rd_more_'.$row['id'].'" data-sp_rd_less="el-rd_less_'.$row['id'].'">... Read more</a>
                                            <span class="el-rd_more_'.$row['id'].'"></span>
                                            <a href="javascript:void(0)" class="el-rd_less_'.$row['id'].'" hidden>Read Less</a>
                                            ';
                                            if(count($p_ctn) > 20){
                                                $t_ctn .= $rd_more;
                                            }

                                            echo '<span style="font-size:14px;">'.implode(' ', $s_ctn).$t_ctn.'</span>';
                                        @endphp
                                    </td>
                                    <td style="vertical-align: middle" class="text-center">
                                        @switch($row['jenis_anggaran'])
                                            @case('hibah')
                                                <span class="badge badge-info">Hibah</span>
                                                @break
                                            @case('sponsorship')
                                                <span class="badge badge-info">Sponsorship</span>
                                                @break
                                            @default
                                            <span class="badge badge-danger">Unknown</span>
                                        @endswitch
                                    </td>
                                    <td style="vertical-align: middle" class="text-center">
                                        <span class="badge bg-success">
                                            {{ rupiah($row['agr'])}}
                                        </span>
                                    </td>
                                    <td style="vertical-align: middle" class="text-center">
                                        <span class="" style="font-size: 14px;">
                                            {{ $row['nama_pic'] . ' ('.$row['pic'].')' }}
                                        </span>
                                    </td>
                                    <td style="vertical-align: middle" class="text-center">
                                        <span class="" style="font-size: 14px;">
                                            {{ $row['nama_pelaksana'] . ' ('.$row['pelaksana'].')' }}
                                        </span>
                                    </td>
                                    <td style="vertical-align: middle" class="text-center">
                                        <a href="{{ base_url('app/riwayat_approval/v_detail/' . encrypt($row['id'])) }}" class="btn btn-primary col-12 btn-xs">Lihat <i class="mdi mdi-arrow-right"></i></a>
                                        @if ($row['st_warek_2'] == 'Y')
                                            <a href="javascript:void(0)" onclick="window.open('{{ base_url('app/hibah/pencairan/v_detail/'.encrypt($row['id_uraian']).'/actbud/'.encrypt($row['id']).'/cetak_form_actbud?pdf=true') }}', 'MsgWindow', 'width=800,height=800')" class="btn btn-info col-12 btn-xs mt-1"><i class="mdi mdi-printer"></i> Cetak</a>                                        
                                        @endif                                        
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
        
        $('#tb-approval').on('click', '.btn-rd_more', function(e){
            const data = {
                message: $(this).data('message'),
                el_rd_more: $(this).data('sp_class'),
                el_rd_less: $(this).data('sp_rd_less')
            }

            $(this).attr('hidden', true)
            $('span.' + data.el_rd_more).text(data.message)
            $('a.' + data.el_rd_less).removeAttr('hidden')
            $('a.' + data.el_rd_less).on('click', function(){
                $('span.' + data.el_rd_more).text('')
                $(this).attr('hidden', true)  
                $(this).parent().find('.btn-rd_more').removeAttr('hidden')
            })
            e.preventDefault()
        })

    })

</script>

@endsection