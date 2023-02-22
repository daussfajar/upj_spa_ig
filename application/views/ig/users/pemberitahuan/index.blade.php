@extends('ig.layouts.user')

@section('title', 'Data Pemberitahuan')

@section('page-title')
    <a href="<?= !empty($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : base_url('app/sim-ig/dashboard') ?>" class=""><i class="mdi mdi-arrow-left"></i></a> Data Pemberitahuan
@endsection

@section('breadcrumb')
<li class="breadcrumb-item active"><a href="javascript: void(0);">Data Pemberitahuan</a></li>
@endsection

@section('content')
<div class="col-md-12">
    <div class="card-box">
        <div class="float-right">
            <a href="{{ base_url('app/sim-ig/data-pemberitahuan/set-sudah-dibaca-semua-pemberitahuan') }}" onclick="return confirm('Apakah anda yakin ingin set sudah dibaca pada semua notifikasi?')" class="btn btn-warning btn-sm"><i class="mdi mdi-check-bold"></i> Set Sudah Lihat Semua</a>
        </div>
        <br><br>
        <div class="table-responsive mt-3">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th class="text-center" width=50>No</th>
                        <th>Judul</th>
                        <th>Pesan</th>
                        <th>Tanggal Masuk</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if (empty($data['data']))
                        <tr>
                            <th colspan="5" class="text-center">Tidak ada pemberitahuan</th>
                        </tr>
					@else
                        @php
                        $no = (empty($CI->uri->segment(4)) ? 0 : $CI->uri->segment(4) + 0);
                        @endphp
                        @foreach ($data['data'] as $row)
                            @php
                                $no++
                            @endphp
                            <tr {!! $row['is_seen'] == 'no' ? 'style="background:#fcf8e3;"' : '' !!}>
                                <th class="text-center">{{ $no }}</th>
                                <td>{{ $row['title'] }}</td>
                                <td>{{ $row['message'] }}</td>
                                <td>
                                    {{ tanggal_indo(substr($row['date_created'],0,10), true).', '.substr($row['date_created'], 10,6) }}
                                </td>
                                <td class="text-center">
                                    <a href="{{ base_url($row['url'] . $row['id']) }}" class="btn btn-info btn-xs">
                                        <i class="mdi mdi-eye"></i>
                                    </a>
                                    <a href="{{ base_url('app/sim-ig/data-pemberitahuan/hapus_data/' . encrypt($row['id'])) }}" class="btn btn-danger btn-xs" onclick="return confirm('Apakah anda yakin?')">
                                        <i class="mdi mdi-trash-can"></i>
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