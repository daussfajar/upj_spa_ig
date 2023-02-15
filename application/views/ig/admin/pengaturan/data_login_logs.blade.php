@extends('ig.layouts.user')

@section('title', 'Pengaturan - Umum')

@section('page-title')
    Login Logs
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="javascript: void(0);"><i class="mdi mdi-cogs"></i> Pengaturan</a></li>
<li class="breadcrumb-item active"><a href="javascript: void(0);">Login Logs</a></li>
@endsection

@section('content')
    <div class="col-md-12">
        <div class="card card-border card-purple">
            <div class="card-header border-purple bg-transparent">
                <h3 class="card-title text-purple mb-0">Data Informasi Login User</h3>
            </div>
            <div class="card-body">
                <div class="float-right">
                    <a href="" class="btn btn-light"><i class="mdi mdi-refresh"></i>Refresh</a>
                </div>
                <div class="table-responsive">
                    <table class="table mt-3">
                        <thead>
                            <tr>
                                <th class="text-center" width="50">No</th>
                                <th>User</th>
                                <th>IP Address</th>
                                <th>Browser</th>
                                <th>Platform</th>
                                <th class="text-center">Date</th>
                                <th class="text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $no = (empty($CI->uri->segment(4)) ? 0 : $CI->uri->segment(4) + 0);
                            ?>
                            @foreach ($data_logs['data'] as $item)
                                <?php $no++; ?>
                                <tr class="{{ $item['nama_user'] == "" ? 'bg-danger text-white' : '' }}">
                                    <th class="text-center">{{ $no }}</th>
                                    <td>
                                        <span class="" style="font-size: 14px;">
                                            {{ $item['nama_user'] == "" ? 'Unknown user' : $item['nama_user'] }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="" style="font-size: 14px;">
                                            {{ $item['ip_address'] }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="" style="font-size: 14px;">
                                            {{ $item['browser'] }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="" style="font-size: 14px;">
                                            {{ $item['platform'] }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span class="" style="font-size: 14px;">
                                            {{ tanggal_indo(substr($item['date'], 0, 10), true).', '.substr($item['date'], 10, 6) }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        @switch($item['status'])
                                            @case('success')
                                                <span class="badge badge-success">
                                                    <i class="mdi mdi-check"></i> Success
                                                </span>
                                                @break
                                            @case('failed')
                                                <span class="badge badge-danger">
                                                    <i class="mdi mdi-close"></i> Failed
                                                </span>
                                                @break
                                            @default
                                                Unknown
                                        @endswitch
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <span class="badge badge-info">Total Data: {{ $data_logs['total_rows'] }}</span>
		        {!! $data_logs['pagination'] !!}
            </div>
        </div>
    </div>
@endsection