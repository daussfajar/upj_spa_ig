@php
    $unit = $_SESSION['user_sessions']['kode_unit'];
    $jabatan = $_SESSION['user_sessions']['kode_jabatan'];
    error_reporting(0);
@endphp
@extends('ig.layouts.user')

@section('title', 'Realisasi Anggaran Kegiatan')

@section('page-title')
    <a href="{{ base_url('app/realisasi_anggaran') }}"><i class="mdi mdi-arrow-left"></i></a> Realisasi Anggaran
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
</style>
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ base_url('app/realisasi_anggaran') }}"><i class="mdi mdi-briefcase-outline"></i> Realisasi Anggaran</a></li>
<li class="breadcrumb-item active"><a href="javascript:void(0)"><b><i class="mdi mdi-file-document-outline"></i> </a></b></li>
@endsection

@section('content')
<div class="col-md-12">
    <div class="card card-border card-teal">
        <div class="card-header border-teal bg-transparent">
            <div class="float-left">
                <h3 class="card-title mb-0"><i class="mdi mdi-file-document-outline"></i> DETAIL ACTBUD</h3>
            </div>
            <div class="float-right">
                @switch($data->status)
                    @case('cancel')
                        <span class="badge badge-danger p-2">Ditolak</span>
                        @break
                    @case('ongoing')
                        <span class="badge badge-warning p-2">Dalam Perencanaan</span>
                        @break
                    @case('submitted')
                        <span class="badge badge-info p-2">Sedang Berlangsung</span>
                        @break
                    @case('approved')
                        <span class="badge badge-success p-2"><i class="mdi mdi-check-bold"></i> Actbud Disetujui</span>
                        @break
                    @default
                        
                @endswitch
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Nama Kegiatan</label>
                        <p class="form-control-static">
                            <span class="" style="font-size: 14px;">
                                {{ $data->nama_kegiatan }}
                            </span>
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Deskripsi Kegiatan</label>
                        <p class="form-control-static">
                            <span class="" style="font-size: 14px;">
                                {{ $data->deskripsi_kegiatan }}
                            </span>
                        </p>
                    </div>
                </div>                
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">KPI</label>
                        <p class="form-control-static">
                            <span class="" style="font-size: 14px;">
                                {{ $data->kpi }}
                            </span>
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">PIC</label>
                        <p class="form-control-static">
                            <span class="" style="font-size: 14px;">
                                {{ $data->nama_pic . ' ('.$data->pic.')' }}
                            </span>
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Pelaksana</label>
                        <p class="form-control-static">
                            <span class="" style="font-size: 14px;">
                                {{ $data->nama_pelaksana. ' ('.$data->pelaksana.')' }}
                            </span>
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Tanggal Pelaksanaan</label>
                        <p class="form-control-static">
                            <span class="badge bg-secondary p-2">
                                <i class="mdi mdi-calendar"></i> {{ tanggal_indo($data->tgl_mulai) . ' s/d ' . tanggal_indo($data->tgl_selesai) }}
                            </span>
                        </p>
                    </div>
                </div>                
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Periode</label>
                        <p class="form-control-static">
                            <span class="badge bg-warning p-2">
                            @switch($data->periode)
                                @case(1)
                                    Ganjil
                                    @break
                                @case(2)
                                    Genap
                                    @break
                                @default
                                    Menunggu
                            @endswitch
                            </span>
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Total Anggaran</label>
                        <p class="form-control-static">
                            <span class="badge bg-purple p-2">
                                {{ rupiah($data->agr) }}
                            </span>
                        </p>
                    </div>
                </div>                
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Tanggal Pengajuan</label>
                        <p class="form-control-static">
                            @if (!empty($data->tanggal_pembuatan))
                                <span class="badge bg-dark p-2 text-white">
                                    <i class="mdi mdi-clock-check-outline"></i> {{ substr($data->tanggal_pembuatan, 0, 16) }}
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

    <div class="card card-border card-info" id="card-dokumen-pendukung">
        <div class="card-header border-info bg-transparent">
            <h3 class="card-title mb-0"><i class="mdi mdi-file-multiple-outline"></i> DOKUMEN PENDUKUNG</h3>
        </div>
        <div class="card-body">            
            <div class="table-responsive">
                <table class="table table-sm table-bordered table-hover table-striped dataTable">
                    <thead>
                        <tr>
                            <th class="text-center" width=50>No</th>
                            <th>Nama Dokumen</th>
                            <th class="text-center">Deskripsi</th>                            
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tb-dokumen">
                        @foreach ($dokumen_pendukung->result() as $row)
                            <tr>
                                <th class="text-center">{{ $loop->iteration }}</th>
                                <td>
                                    <a href="javascript:void(0)" style="font-size: 14px;">
                                        <i class="mdi mdi-file"></i>
                                        @php
                                            $pecah_nama = explode('_', $row->nama_file);
                                            echo $pecah_nama[1] . ' ('.formatBytes($row->ukuran_file).')';
                                        @endphp
                                    </a>
                                </td>
                                <td>
                                    <span class="" style="font-size: 14px;">
                                        {{ $row->deskripsi }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <a href="{{ base_url('app-data/dokumen-pendukung/' . $row->nama_file) }}" class="btn btn-primary btn-xs" download="{{ $pecah_nama[1] }}">
                                        <i class="mdi mdi-download"></i>
                                    </a>
                                    @if ($data->status == 'ongoing')                                        
                                        <a href="javascript:void(0)" data-id="{{ encrypt($row->id) }}" data-file_name="{{ $row->nama_file }}" class="btn btn-danger btn-xs btn-hapus-dokumen">
                                            <i class="mdi mdi-trash-can"></i>
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {!! form_open('app/realisasi_anggaran/actbud/' . $CI->uri->segment(4) . '/' . $CI->uri->segment(5) . '/buat_pesan', array('id' => 'form-pesan', 'enctype' => 'multipart/form-data', 'class' => 'myForm')) !!}
    <div class="card card-border card-purple" id="card-chat">
        <div class="card-header border-purple bg-transparent">
            <h3 class="card-title mb-0"><i class="mdi mdi-message-text-outline"></i> PESAN</h3>
        </div>
        <div class="card-body">                        
            @if (!empty($messages))                            
                <div class="messages">                
                    <div class="list-group bs-ui-list-group mb-0 mr-2" id="chat-section">                   
                        @foreach ($messages as $item)
                            @php
                                $reply_data = $CI->db->query("SELECT a.id,a.nik,a.pesan,a.datetime_chat,a.attachment,a.attachment_size,a.status,b.nama_lengkap sender FROM ig_tbl_actbud_chat_reply a 
                                INNER JOIN tbl_karyawan b ON a.nik = b.nik WHERE a.id_pesan = '".$item->id."' AND a.status = 'Aktif'")->result();                                
                            @endphp
                            <div class="list-group-item" style="border-left: 2px solid rgba(0,0,0,.125);border-top:none;border-bottom:none;border-right:none;margin-bottom:10px;">
                                <div class="list-group-item-heading font-16 mt-0 mb-1 pb-1 border-bottom">                                    
                                    <span>
                                        <img src="<?= base_url() ?>assets/images/user-icon.png" alt="" srcset="" width="20">
                                        {{ $item->sender }}
                                    </span>                                
                                    <span style="font-size: 13px;float: right;">
                                        <i class="mdi mdi-calendar-clock"></i> {{ $item->datetime_chat }}                                        
                                    </span>
                                </div>                                
                                <p class="list-group-item-text m-0">
                                    {{ $item->pesan }}
                                </p>                  
                                @if (!empty($item->attachment))
                                    @php
                                        $pecah_attachment = explode('_', $item->attachment);                                        
                                    @endphp
                                    <div class="mt-2">
                                        <span style="font-size: 13px;">Attachment:</span>
                                        <div class="d-flex flex-row">
                                            <div style="width: 50px;height:40px;" class="border text-center">
                                                <i class="mdi mdi-file mdi-24px text-primary"></i>
                                            </div>
                                            <div class="ml-2 pt-2">
                                                <span class="text-primary">{{ $pecah_attachment[1] }}</span>
                                                <span style="font-size: 12px;color:black">{{ formatBytes($item->attachment_size) }}</span>
                                                <a href="{{ base_url('app-data/chat-attachment/' . $item->attachment) }}" class="btn btn-info btn-xs" download="{{ $pecah_attachment[1] }}"><i class="mdi mdi-download"></i> Unduh</a>
                                            </div>                    
                                        </div>                                        
                                    </div>        
                                @endif
                                <span style="font-size: 11px;">{{ get_time_ago(strtotime($item->datetime_chat)) }}</span>                                          
                                <br>
                                <span style="font-size: 12px;">
                                    <a href="javascript:void(0)" class="reply-chat" data-id="<?= encrypt($item->id) ?>" 
                                        data-attachment="<?= $item->attachment ?>" data-sender="<?= $item->sender ?>" 
                                        data-time="<?= $item->datetime_chat ?>" data-attachment="<?= $item->attachment ?>" data-pesan="<?= $item->pesan ?>"><i class="mdi mdi-reply"></i> Reply</a>
                                    @if ($item->nik == decrypt($_SESSION['user_sessions']['nik']))                                        
                                        <a href="javascript:void(0)" class="hapus-chat" data-id="<?= encrypt($item->id) ?>" 
                                            data-attachment="<?= $item->attachment ?>" data-sender="<?= $item->sender ?>" 
                                            data-time="<?= $item->datetime_chat ?>" data-attachment="<?= $item->attachment ?>" data-pesan="<?= $item->pesan ?>"><i class="mdi mdi-trash-can"></i> Hapus</a>
                                    @endif
                                </span>

                                @if (!empty($reply_data))
                                    <br>
                                    <a href="#collapse-reply-message-<?= $item->id ?>" class="showReply" data-toggle="collapse" style="font-size: 12px;">Lihat Balasan</a>
                                    <div class="collapse" id="collapse-reply-message-<?= $item->id ?>">
                                        @foreach ($reply_data as $item)
                                        <div class="list-group-item mt-1" style="border-left: none;border-top:none;border-bottom:none;border-right:none;padding-bottom:0;">
                                            <div class="list-group-item-heading font-16 mt-0 mb-1 pb-1 border-bottom">                                    
                                                <span>
                                                    <img src="<?= base_url() ?>assets/images/logo/logo.png" alt="" srcset="" width="20">
                                                    {{ $item->sender }}
                                                </span>                                
                                                <span style="font-size: 13px;float: right;">
                                                    <i class="mdi mdi-calendar-clock"></i> {{ $item->datetime_chat }}                                        
                                                </span>
                                            </div>

                                            <p class="list-group-item-text m-0">
                                                {{ $item->pesan }}
                                            </p>

                                            @if (!empty($item->attachment))
                                                @php
                                                    $pecah_attachment = explode('_', $item->attachment);                                        
                                                @endphp
                                                <div class="mt-2">
                                                    <span style="font-size: 13px;">Attachment:</span>
                                                    <div class="d-flex flex-row">
                                                        <div style="width: 50px;height:40px;" class="border text-center">
                                                            <i class="mdi mdi-file mdi-24px text-primary"></i>
                                                        </div>
                                                        <div class="ml-2 pt-2">
                                                            <span class="text-primary">{{ $pecah_attachment[1] }}</span>
                                                            <span style="font-size: 12px;color:black">{{ formatBytes($item->attachment_size) }}</span>
                                                            <a href="{{ base_url('app-data/chat-attachment/' . $item->attachment) }}" class="btn btn-info btn-xs" download="{{ $pecah_attachment[1] }}"><i class="mdi mdi-download"></i> Unduh</a>
                                                        </div>                    
                                                    </div>                                        
                                                </div>        
                                            @endif
                                            <span style="font-size: 11px;">{{ get_time_ago(strtotime($item->datetime_chat)) }}</span>
                                        </div>                                      
                                        @endforeach
                                    </div>
                                @endif

                            </div>
                        @endforeach
                        <!-- OLD <div class="reply-form d-none mt-3" id="comment-1-reply-form">
                                <textarea placeholder="Balas pesan..." class="form-control" name="reply_pesan" id="reply_pesan" rows="4"></textarea>
                                <button type="submit" name="ReplyPesan" class="btn btn-secondary btn-sm mt-2">Kirim</button>
                                <button type="button" data-toggle="reply-form" class="btn btn-light btn-sm reply-chat mt-2" data-target="comment-<?= $item->id ?>-reply-form">Batal</button>
                        </div>-->
                    </div>
                </div>
            @else
            <div class="alert alert-info">
                <p class="mb-0"><i class="mdi mdi-exclamation"></i> Tidak ada pesan</p>
            </div>
            @endif
        </div>

        <div class="card-footer">
            <div class="list-group-item mb-1 d-none" id="reply-box">
                <div class="list-group-item-heading font-16 mt-0 border-bottom mb-1 pb-1">
                    <img src="<?= base_url() ?>assets/images/logo/logo.png" alt="" srcset="" width="20">
                    <span id="reply-from"></span>
                    <div class="float-right">
                        <a href="javascript:void(0)" id="close-reply"><i class="mdi mdi-close"></i></a>
                    </div>
                </div>
                <p class="list-group-item-text m-0" id="reply-message"></p>                
                <input type="hidden" id="reply_id" name="reply_id">
            </div>
            <div id="detail-attachment" class="mb-2" style="display: none;">
                <div class="d-flex flex-row">
                    <div style="width: 50px;height:40px;" class="border text-center">
                        <i class="mdi mdi-file mdi-24px text-primary"></i>
                    </div>
                    <div class="ml-2 pt-2">
                        <span class="text-primary" id="attachment-file-name"></span>
                        <span id="attachment-file-size" style="font-size: 12px;color:black"></span>
                    </div>                    
                </div>
            </div>
            <div class="input-group" id="input-pesan">                
                <input type="text" id="pesan" name="pesan" class="form-control" placeholder="Ketik pesan disini...">
                <span class="input-group-append">
                    <span class="btn btn-secondary btn-file"><span class="mdi mdi-attachment"></span>
                    <input type="file" name="attachment" id="file-chat-attachment" accept="image/png, image/jpeg, image/jpg, application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint,
                    text/plain, application/pdf, image/webp"/></span>
                </span>
                <span class="input-group-append">                    
                    <button type="submit" class="btn waves-effect waves-light btn-primary"><i class="mdi mdi-send"></i></button>
                </span>
            </div>
        </div>

    </div> 
    {!! form_close() !!}  

    <div class="card card-border card-success" id="card-rincian">
        <div class="card-header border-success bg-transparent">
            <div class="float-left">
                <h3 class="card-title mb-0"><i class="mdi mdi-clipboard-list-outline"></i> DETAIL BIAYA</h3>
            </div>
            <div class="float-right">
                @if ($data->realisasi == 'Y')
                    <span class="badge badge-primary p-2"><i class="mdi mdi-check-bold"></i> Finalisasi</span>
                @endif
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped dataTable" id="card-dt_biaya">
                    <thead>
                        <tr>
                            <th class="text-center" style="vertical-align: middle;" width=50>No</th>
                            <th style="vertical-align: middle;">Nama Kegiatan</th>   
                            <th class="text-center" style="vertical-align: middle;">Anggaran Disetujui</th>
                            <th class="text-center" style="vertical-align: middle;">Realisasi Anggaran</th>
                            <th class="text-center" style="vertical-align: middle;">Catatan PIC</th>
                            <th class="text-center" style="vertical-align: middle;">Catatan Keuangan</th>
                        </tr>
                    </thead>
                    <tbody id="tb-detail-biaya">
                        @foreach ($detail_biaya as $item)
                            <tr>
                                <th class="text-center" style="vertical-align: middle;">{{ $loop->iteration }}</th>
                                <td style="vertical-align: middle;">
                                    <span class="" style="font-size: 14px;">
                                        {{ $item->nama_kegiatan }}
                                    </span>
                                    <hr class="mt-0 mb-0">
                                    <span style="font-size: 12px;">
                                        {{ $item->keterangan }}
                                    </span>
                                    <hr class="mt-2 mb-2">
                                    <span class="badge bg-secondary p-2">
                                        Tanggal buat : <i class="mdi mdi-calendar"></i>
                                        <?php 
                                        $tgl_buat = $item->tanggal_buat;
                                        $ex_tgl_buat = explode(' ', $tgl_buat);
                                        if(!empty($ex_tgl_buat)){
                                            echo tanggal_indo($ex_tgl_buat[0], true) . ', ' . $ex_tgl_buat[1];
                                        }
                                        ?>
                                    </span>
                                </td>                                                          
                                <td style="vertical-align: middle;" class="text-center">
                                    <span class="badge bg-purple p-2">
                                        {{ rupiah($item->total_anggaran) }}
                                    </span>
                                </td>
                                <td style="vertical-align: middle;" class="text-center">
                                    <a href="javascript:void(0)" class="badge bg-primary p-2 {{ $data->realisasi == 'N' ? 'btn-ubah_realisasi_anggaran' : '' }}" 
                                    data-id="{{ encrypt($item->id) }}" data-nama_kegiatan="{{ $item->nama_kegiatan }}" 
                                    data-keterangan="{{ $item->keterangan }}" data-anggaran_disetujui="{{ rupiah($item->total_anggaran) }}" 
                                    data-anggaran_realisasi="{{ rupiah($item->total_anggaran_realisasi) }}">
                                        {{ rupiah($item->total_anggaran_realisasi) }} {!! $data->realisasi == 'N' ? '<i class="mdi mdi-pencil"></i>' : '' !!}
                                    </a>                                    
                                </td>                                
                                <td style="vertical-align: middle;" class="text-left {{ ($item->catatan_disetujui == "" && $data->realisasi == 'Y') ? 'text-center' : '' }}">
                                    @if ((($data->kode_unit == $unit && ($jabatan == 22 || $jabatan == 7))) || $jabatan == 0)                                                                            
                                        @if ($item->catatan_disetujui == "")
                                            @if ($data->realisasi == 'N')                                                                                    
                                            <a href="javascript:void(0)" class="badge bg-info p-2 btn-buat_catatan" 
                                            data-id="{{ encrypt($item->id) }}" data-nama_kegiatan="{{ $item->nama_kegiatan }}" 
                                            data-keterangan="{{ $item->keterangan }}" data-anggaran_disetujui="{{ rupiah($item->total_anggaran) }}" 
                                            data-anggaran_realisasi="{{ rupiah($item->total_anggaran_realisasi) }}">
                                                <i class="mdi mdi-note-plus-outline"></i> Buat Catatan
                                            </a>
                                            @else
                                            -
                                            @endif
                                        @else
                                            @php
                                                $count_lampiran = 0;
                                                $ctn = $item->catatan_disetujui;
                                                $p_ctn = explode(' ', $ctn);
                                                $s_ctn = array_slice($p_ctn, 0, 10);
                                                $r_ctn = array_slice($p_ctn, 10);
                                                $t_ctn = '';
                                                $rd_more = ' <a href="javascript:void(0)" data-message="'.implode(' ', $r_ctn).'" class="btn-rd_more" 
                                                data-sp_class="el-rd_more_'.$item->id.'" data-sp_rd_less="el-rd_less_'.$item->id.'">... Read more</a>
                                                <span class="el-rd_more_'.$item->id.'"></span>
                                                <a href="javascript:void(0)" class="el-rd_less_'.$item->id.'" hidden>Read Less</a>
                                                ';
                                                if(count($p_ctn) > 10){
                                                    $t_ctn .= $rd_more;
                                                }

                                                echo '<span style="font-size:12px;">'.implode(' ', $s_ctn).$t_ctn.'</span>';
                                            @endphp

                                            @if ($data->realisasi == 'N')
                                                <br><br>
                                                <a href="javascript:void(0)" class="badge bg-secondary p-2 btn-ubah_catatan"
                                                data-id="{{ encrypt($item->id) }}" data-nama_kegiatan="{{ $item->nama_kegiatan }}" 
                                                data-keterangan="{{ $item->keterangan }}" data-anggaran_disetujui="{{ rupiah($item->total_anggaran) }}" 
                                                data-anggaran_realisasi="{{ rupiah($item->total_anggaran_realisasi) }}" 
                                                data-catatan_disetujui="{{ $item->catatan_disetujui }}">
                                                    <i class="mdi mdi-pencil"></i> Ubah
                                                </a>

                                                @if ($item->catatan_disetujui != "")                                                
                                                    <a href="{{ base_url('app/realisasi_anggaran/actbud/' . $CI->uri->segment(4) . '/' . $CI->uri->segment(5) . '/hapus_catatan_pic?id=' . encrypt('upj2022') . '-' . encrypt($item->id) . '-' . encrypt('jaya')) }}" class="badge bg-danger p-2" onclick="return confirm('Apakah anda yakin?')">
                                                        <i class="mdi mdi-trash-can"></i> Hapus
                                                    </a>
                                                @endif

                                            @endif                                                                                
                                        @endif

                                        <hr class="mt-1 mb-1">
                                        <span class="" style="font-size: 14px;">
                                            <i class="mdi mdi-attachment"></i> Attachment :
                                        </span>
                                        @if ($item->lampiran != "")
                                            <a href="javascript:void(0)"  class="badge bg-light text-muted">
                                                <i class="{!! $item->icon_file !!}"></i>{{ ucfirst($item->nama_file ) }} ({{ formatBytes($item->ukuran_file) }})
                                            </a>
                                            <br>
                                        @endif
                                        @if ($data->realisasi == 'N')

                                            @if ($item->lampiran != "")
                                            <a href="{{ base_url('app-data/bukti-realisasi-anggaran/' . $item->lampiran) }}" class="badge bg-primary p-2" download="{{ $item->nama_file }}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Klik mengunduh lampiran">
                                                <i class="mdi mdi-download"></i> Unduh
                                            </a>
                                            @endif

                                            <a href="javascript:void(0)" class="badge bg-secondary btn-upload_bukti p-2" 
                                            data-id="{{ encrypt($item->id) }}" data-nama_kegiatan="{{ $item->nama_kegiatan }}" 
                                            data-keterangan="{{ $item->keterangan }}" data-anggaran_disetujui="{{ rupiah($item->total_anggaran) }}" 
                                            data-anggaran_realisasi="{{ rupiah($item->total_anggaran_realisasi) }}" 
                                            data-catatan_disetujui="{{ $item->catatan_disetujui }}"
                                            {!! $item->lampiran == "" ? '' : 'data-lampiran="'.encrypt($item->lampiran).'"' !!}
                                            >
                                                <i class="mdi mdi-{{ $item->lampiran == "" ? 'upload' : 'pencil' }}"></i> 
                                                {{ $item->lampiran == "" ? 'Unggah' : 'Ubah' }}
                                            </a>

                                            @if ($item->lampiran != "")
                                            <a href="javascript:void(0)" data-id="{{ encrypt($item->id) }}" data-file_name="{{ $item->nama_file }}" data-file="{{ encrypt($item->lampiran) }}" class="badge bg-danger p-2 btn-hapus_file_catatan_pic">
                                                <i class="mdi mdi-trash-can"></i> Hapus
                                            </a>
                                            @endif
                                        @endif
                                    @else
                                        @php
                                            $count_lampiran = 0;
                                            $ctn = $item->catatan_disetujui == '' ? 'Belum membuat catatan' : $item->catatan_disetujui;
                                            $p_ctn = explode(' ', $ctn);
                                            $s_ctn = array_slice($p_ctn, 0, 10);
                                            $r_ctn = array_slice($p_ctn, 10);
                                            $t_ctn = '';
                                            $rd_more = ' <a href="javascript:void(0)" data-message="'.implode(' ', $r_ctn).'" class="btn-rd_more" 
                                            data-sp_class="el-rd_more_'.$item->id.'" data-sp_rd_less="el-rd_less_'.$item->id.'">... Read more</a>
                                            <span class="el-rd_more_'.$item->id.'"></span>
                                            <a href="javascript:void(0)" class="el-rd_less_'.$item->id.'" hidden>Read Less</a>
                                            ';
                                            if(count($p_ctn) > 10){
                                                $t_ctn .= $rd_more;
                                            }

                                            echo '<span style="font-size:12px;">'.implode(' ', $s_ctn).$t_ctn.'</span>';
                                        @endphp
                                    @endif
                                </td>
                                <td class="text-left {{ ($item->catatan_disetujui_keu == "" && $data->realisasi == 'Y') ? 'text-center' : '' }}" style="vertical-align: middle;">
                                    @if ($jabatan == 0 || ($unit == '002'))

                                        @if ($item->catatan_disetujui_keu == "")
                                            @if ($data->realisasi == 'N')                                                                                    
                                            <a href="javascript:void(0)" class="badge bg-info p-2 btn-buat_catatan_keu" 
                                            data-id="{{ encrypt($item->id) }}" data-nama_kegiatan="{{ $item->nama_kegiatan }}" 
                                            data-keterangan="{{ $item->keterangan }}" data-anggaran_disetujui="{{ rupiah($item->total_anggaran) }}" 
                                            data-anggaran_realisasi="{{ rupiah($item->total_anggaran_realisasi) }}">
                                                <i class="mdi mdi-note-plus-outline"></i> Buat Catatan
                                            </a>
                                            @else
                                            -
                                            @endif
                                        @else

                                            @php
                                                $count_lampiran_keu = 0;
                                                $ctn_keu = $item->catatan_disetujui_keu;
                                                $p_ctn_keu = explode(' ', $ctn_keu);
                                                $s_ctn_keu = array_slice($p_ctn_keu, 0, 10);
                                                $r_ctn_keu = array_slice($p_ctn_keu, 10);
                                                $t_ctn_keu = '';
                                                $rd_more_keu = ' <a href="javascript:void(0)" data-message="'.implode(' ', $r_ctn_keu).'" class="btn-rd_more_1" 
                                                data-sp_class="el-rd_more_'.($item->id + 1).'" data-sp_rd_less="el-rd_less_'.($item->id + 1).'">... Read more</a>
                                                <span class="el-rd_more_'.($item->id + 1).'"></span>
                                                <a href="javascript:void(0)" class="el-rd_less_'.($item->id + 1).'" hidden>Read Less</a>
                                                ';
                                                if(count($p_ctn_keu) > 10){
                                                    $t_ctn_keu .= $rd_more_keu;
                                                }

                                                echo '<span style="font-size:12px;">'.implode(' ', $s_ctn_keu).$t_ctn_keu.'</span>';
                                            @endphp

                                            @if ($data->realisasi == 'N')                                                                                    
                                                <br>
                                                <a href="javascript:void(0)" class="badge bg-secondary p-2 btn-buat_catatan_keu"
                                                data-id="{{ encrypt($item->id) }}" data-nama_kegiatan="{{ $item->nama_kegiatan }}" 
                                                data-keterangan="{{ $item->keterangan }}" data-anggaran_disetujui="{{ rupiah($item->total_anggaran) }}" 
                                                data-anggaran_realisasi="{{ rupiah($item->total_anggaran_realisasi) }}" 
                                                data-catatan_disetujui="{{ $item->catatan_disetujui_keu }}">
                                                    <i class="mdi mdi-pencil"></i> Ubah
                                                </a>
                                                
                                                @if ($item->catatan_disetujui_keu != "")                                                
                                                    <a href="{{ base_url('app/realisasi_anggaran/actbud/' . $CI->uri->segment(4) . '/' . $CI->uri->segment(5) . '/hapus_catatan_keu?id=' . encrypt('upj2022') . '-' . encrypt($item->id) . '-' . encrypt('jaya')) }}" class="badge bg-danger p-2" onclick="return confirm('Apakah anda yakin?')">
                                                        <i class="mdi mdi-trash-can"></i> Hapus
                                                    </a>
                                                @endif

                                            @endif

                                        @endif

                                        <hr class="mt-1 mb-1">
                                        <span class="" style="font-size: 14px;">
                                            <i class="mdi mdi-attachment"></i> Attachment :
                                        </span>
                                        @if ($item->lampiran_keu != "")
                                            <a href="javascript:void(0)"  class="badge bg-light text-muted">
                                                <i class="{!! $item->icon_file_keu !!}"></i>{{ ucfirst($item->nama_file_keu ) }} ({{ formatBytes($item->ukuran_file_keu) }})
                                            </a>
                                            <br>
                                        @endif
                                        @if ($data->realisasi == 'N')

                                            @if ($item->lampiran_keu != "")
                                            <a href="{{ base_url('app-data/bukti-realisasi-anggaran/' . $item->lampiran_keu) }}" class="badge bg-primary p-2" download="{{ $item->nama_file }}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Klik mengunduh lampiran">
                                                <i class="mdi mdi-download"></i> Unduh
                                            </a>
                                            @endif

                                            <a href="javascript:void(0)" class="badge bg-secondary p-2 btn-upload_bukti_keu" 
                                            data-id="{{ encrypt($item->id) }}" data-nama_kegiatan="{{ $item->nama_kegiatan }}" 
                                            data-keterangan="{{ $item->keterangan }}" data-anggaran_disetujui="{{ rupiah($item->total_anggaran) }}" 
                                            data-anggaran_realisasi="{{ rupiah($item->total_anggaran_realisasi) }}" 
                                            data-catatan_disetujui="{{ $item->catatan_disetujui_keu }}"
                                            {!! $item->lampiran_keu == "" ? '' : 'data-lampiran="'.encrypt($item->lampiran_keu).'"' !!}
                                            >
                                                <i class="mdi mdi-{{ $item->lampiran_keu == "" ? 'upload' : 'pencil' }}"></i> 
                                                {{ $item->lampiran_keu == "" ? 'Unggah' : 'Ubah' }}
                                            </a>

                                            @if ($item->lampiran_keu != "")
                                            <a href="javascript:void(0)" data-id="{{ encrypt($item->id) }}" data-file_name="{{ $item->nama_file_keu }}" data-file="{{ encrypt($item->lampiran_keu) }}" class="badge bg-danger p-2 btn-hapus_file_catatan_keu">
                                                <i class="mdi mdi-trash-can"></i> Hapus
                                            </a>
                                            @endif
                                        @endif
                                        
                                    @else                                    
                                        @php
                                            $count_lampiran_keu = 0;
                                            $ctn_keu = $item->catatan_disetujui_keu == '' ? 'Belum membuat catatan' : $item->catatan_disetujui_keu;
                                            $p_ctn_keu = explode(' ', $ctn_keu);
                                            $s_ctn_keu = array_slice($p_ctn_keu, 0, 10);
                                            $r_ctn_keu = array_slice($p_ctn_keu, 10);
                                            $t_ctn_keu = '';
                                            $rd_more_keu = ' <a href="javascript:void(0)" data-message="'.implode(' ', $r_ctn_keu).'" class="btn-rd_more_1" 
                                            data-sp_class="el-rd_more_'.($item->id + 1).'" data-sp_rd_less="el-rd_less_'.($item->id + 1).'">... Read more</a>
                                            <span class="el-rd_more_'.($item->id + 1).'"></span>
                                            <a href="javascript:void(0)" class="el-rd_less_'.($item->id + 1).'" hidden>Read Less</a>
                                            ';
                                            if(count($p_ctn_keu) > 10){
                                                $t_ctn_keu .= $rd_more_keu;
                                            }

                                            echo '<span style="font-size:12px;">'.implode(' ', $s_ctn_keu).$t_ctn_keu.'</span>';
                                        @endphp
                                    @endif
                                </td>                             
                            </tr>
                        @endforeach
                    </tbody>                    
                    <tfoot>
                        <tr>
                            <th colspan="2" class="text-right" style="vertical-align: middle;">Total :</th>
                            <td style="vertical-align: middle;" class="text-center">
                                <span class="badge bg-purple p-2">
                                    {{ rupiah($anggaran_disetujui->total) }}
                                </span>
                            </td>
                            <td style="vertical-align: middle;" class="text-center">
                                <span class="badge bg-primary p-2">
                                    {{ rupiah($anggaran_realisasi->total) }}                                    
                                </span>                                
                            </td>
                            <td style="vertical-align: middle;"></td>
                            <td style="vertical-align: middle;"></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    
    @if ($data->realisasi == 'N')
    
    @if ($jabatan == 0 || ($unit == '002'))

    <div class="card card-border card-primary" id="card-rincian">
        <div class="card-header border-primary bg-transparent">
            <h3 class="card-title mb-0"><i class="mdi mdi-check-bold"></i> FINALISASI PENYESUAIAN ANGGARAN</h3>
        </div>
        <div class="card-body">
            <div class="alert alert-info">
                <i class="mdi mdi-information-variant"></i> Catatan: Sebelum melakukan finalisasi penyesuaian anggaran, mohon pastikan anggaran anda sudah sesuai dengan realisasi yang berjalan
                dan pastikan anda sudah mengupload <b>lampiran/bukti</b> di setiap kegiatan (Jika ada).
            </div>                     
            <button type="button" data-target="#modal-finalisasi" data-toggle="modal" class="btn btn-primary btn-md col-12"><i class="mdi mdi-lock"></i> Finalisasi Anggaran</button>
        </div>
    </div>

    {!! form_open('app/realisasi_anggaran/actbud/' . $CI->uri->segment(4) . '/' . $CI->uri->segment(5) . '/finalisasi-penyesuaian-anggaran?_r='.uniqid(), array('class' => 'myForm')) !!}
    <div id="modal-finalisasi" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0">Konfirmasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="mb-2 text-justify">Apakah anda yakin ingin melakukan Finalisasi Penyesuaian Anggaran?</p>
                    <div class="alert alert-info">
                        <p class="mb-0"><i class="mdi mdi-information-variant"></i> Setelah submit anda tidak dapat lagi melakukan perubahan.</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="javascript:void(0)" data-dismiss="modal" class="btn btn-danger">Batal</a>
                    <button type="submit" class="btn btn-primary"><i class="mdi mdi-check"></i> Finalisasi</button>
                </div>
            </div>
        </div>
    </div>
    {!! form_close() !!}
    @endif

    @endif
</div>

@if ($data->realisasi == 'N')

{!! form_open('app/realisasi_anggaran/actbud/' . $CI->uri->segment(4) . '/' . $CI->uri->segment(5) . '/buat_catatan', array('class' => 'myForm')) !!}
<div id="modal-buat-catatan" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Buat Catatan Realisasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id" value="">
                <div class="form-group">
                    <label for="">Nama Kegiatan</label>
                    <p class="form-control-static">
                        <span class="nama_kegiatan"></span>                        
                    </p>
                </div>
                <div class="form-group">
                    <label for="">Keterangan</label>
                    <p class="form-control-static">
                        <span class="keterangan"></span>                        
                    </p>
                </div>                
                <div class="form-group">
                    <label for="">Catatan</label>
                    <textarea name="catatan" id="catatan" placeholder="Buat catatan..." cols="4" rows="4" class="form-control" required></textarea>
                </div>
            </div>
            <div class="card-footer">
                <div class="float-right">
                    <a href="javascript:void(0)" data-dismiss="modal" class="btn btn-secondary btn-sm">Tutup</a>
                    <button type="submit" class="btn btn-primary btn-sm">Simpan Catatan</button>
                </div>
            </div>
        </div>
    </div>
</div>
{!! form_close() !!}

@if ($jabatan == 0 || ($unit == '002'))

    {!! form_open('app/realisasi_anggaran/actbud/' . $CI->uri->segment(4) . '/' . $CI->uri->segment(5) . '/buat_catatan_keu', array('class' => 'myForm')) !!}
    <div id="modal-buat-catatan-keu" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0">Buat Catatan Realisasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" value="">
                    <div class="form-group">
                        <label for="">Nama Kegiatan</label>
                        <p class="form-control-static">
                            <span class="nama_kegiatan"></span>                        
                        </p>
                    </div>
                    <div class="form-group">
                        <label for="">Keterangan</label>
                        <p class="form-control-static">
                            <span class="keterangan"></span>                        
                        </p>
                    </div>                
                    <div class="form-group">
                        <label for="">Catatan</label>
                        <textarea name="catatan" id="catatan" placeholder="Buat catatan..." cols="4" rows="4" class="form-control" required></textarea>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="float-right">
                        <a href="javascript:void(0)" data-dismiss="modal" class="btn btn-secondary btn-sm">Tutup</a>
                        <button type="submit" class="btn btn-primary btn-sm">Simpan Catatan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {!! form_close() !!}    

    {!! form_open('app/realisasi_anggaran/actbud/' . $CI->uri->segment(4) . '/' . $CI->uri->segment(5) . '/unggah_bukti_keu', array('enctype' => 'multipart/form-data', 'class' => 'myForm')) !!}
    <div id="modal-unggah-lampiran-keu" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0"><span class="mdl_title"></span> Lampiran/Bukti</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="old_lampiran" value="">
                    <input type="hidden" name="id" value="">
                    <div class="form-group">
                        <label for="">Nama Kegiatan</label>
                        <p class="form-control-static">
                            <span class="nama_kegiatan"></span>                        
                        </p>
                    </div>
                    <div class="form-group">
                        <label for="">Keterangan</label>
                        <p class="form-control-static">
                            <span class="keterangan"></span>                        
                        </p>
                    </div>
                    <div class="form-group">
                        <label for="">Lampiran/Bukti (Max: 5mb)</label>
                        <input type="file" class="filestyle" name="lampiran" id="lampiran" data-size="sm" required>
                        <span class="help-block"><small>Allowed Extension: xlsx,pdf,docx,pptx,image(jpg,jpeg,png,webp)</small></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="float-right">
                        <a href="javascript:void(0)" class="btn btn-secondary btn-sm" data-dismiss="modal">Tutup</a>
                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {!! form_close() !!}

    {!! form_open('app/realisasi_anggaran/actbud/' . $CI->uri->segment(4) . '/' . $CI->uri->segment(5) . '/hapus_lampiran_keu?', array('enctype' => 'multipart/form-data', 'class' => 'myForm')) !!}
    <div id="modal-hapus-file-ct-keu" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0">Hapus Lampiran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="attachment">
                    <input type="hidden" name="id">
                    <p class="mb-0 mt-2">Apakah anda yakin ingin menghapus lampiran <b><span class="nama_lampiran"></span></b>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm waves-effect" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-danger btn-sm waves-effect waves-light">Hapus</button>
                </div>
            </div>            
        </div>        
    </div>    
    {!! form_close() !!}
@endif

{!! form_open('app/realisasi_anggaran/actbud/' . $CI->uri->segment(4) . '/' . $CI->uri->segment(5) . '/buat_realisasi_anggaran', array('class' => 'myForm')) !!}
<div id="modal-realisasi-anggaran" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Realisasi Anggaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id" value="">
                <div class="form-group">
                    <label for="">Nama Kegiatan</label>
                    <p class="form-control-static">
                        <span class="nama_kegiatan"></span>                        
                    </p>
                </div>
                <div class="form-group">
                    <label for="">Keterangan</label>
                    <p class="form-control-static">
                        <span class="keterangan"></span>                        
                    </p>
                </div>
                <div class="form-group">
                    <label for="">Anggaran Disetujui</label>
                    <p class="form-control-static">
                        <span class="anggaran_disetujui badge bg-purple p-2"></span>                        
                    </p>
                </div>
                <div class="form-group">
                    <label for="">Anggaran Realisasi</label>
                    <input type="text" name="anggaran_realisasi" placeholder="Masukan realisasi anggaran" maxlength="30" id="anggaran_realisasi" class="form-control" value="" required>
                </div>                
            </div>
            <div class="card-footer">
                <div class="float-right">
                    <a href="javascript:void(0)" data-dismiss="modal" class="btn btn-secondary btn-sm">Tutup</a>
                    <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</div>
{!! form_close() !!}

{!! form_open('app/realisasi_anggaran/actbud/' . $CI->uri->segment(4) . '/' . $CI->uri->segment(5) . '/unggah_bukti', array('enctype' => 'multipart/form-data', 'class' => 'myForm')) !!}
<div id="modal-unggah-lampiran" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0"><span class="mdl_title"></span> Lampiran/Bukti</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="old_lampiran" value="">
                <input type="hidden" name="id" value="">
                <div class="form-group">
                    <label for="">Nama Kegiatan</label>
                    <p class="form-control-static">
                        <span class="nama_kegiatan"></span>                        
                    </p>
                </div>
                <div class="form-group">
                    <label for="">Keterangan</label>
                    <p class="form-control-static">
                        <span class="keterangan"></span>                        
                    </p>
                </div>
                <div class="form-group">
                    <label for="">Lampiran/Bukti (Max: 5mb)</label>
                    <input type="file" class="filestyle" name="lampiran" id="lampiran" data-size="sm" required>
                    <span class="help-block"><small>Allowed Extension: xlsx,pdf,docx,pptx,image(jpg,jpeg,png,webp)</small></span>
                </div>
            </div>
            <div class="modal-footer">
                <div class="float-right">
                    <a href="javascript:void(0)" class="btn btn-secondary btn-sm" data-dismiss="modal">Tutup</a>
                    <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</div>
{!! form_close() !!}

{!! form_open('app/realisasi_anggaran/actbud/' . $CI->uri->segment(4) . '/' . $CI->uri->segment(5) . '/hapus-pesan', array('class' => 'myForm')) !!}
    <div id="modal-hapus-pesan" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0">Hapus Pesan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="attachment">
                    <input type="hidden" name="id">
                    <div class="list-group bs-ui-list-group mb-0">
                        <div class="list-group-item">
                            <div class="list-group-item-heading font-16 mt-0 mb-1 pb-1 border-bottom">                                
                                <img src="<?= base_url() ?>assets/images/logo/logo.png" alt="" srcset="" width="20">
                                <span id="sender"></span>                                                      
                                <div style="font-size: 13px;float: right;">
                                    <i class="mdi mdi-calendar-clock"></i>  
                                    <span id="time"></span>                                  
                                </div>                                
                            </div>
                            <p class="list-group-item-text m-0" id="pesan"></p>
                        </div>                        
                    </div>
                    <p class="mb-0 mt-2">Apakah anda yakin ingin menghapus pesan ini?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm waves-effect" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-danger btn-sm waves-effect waves-light">Hapus</button>
                </div>
            </div>            
        </div>        
    </div>    
{!! form_close() !!}

{!! form_open('app/realisasi_anggaran/actbud/' . $CI->uri->segment(4) . '/' . $CI->uri->segment(5) . '/hapus_lampiran_pic?', array('enctype' => 'multipart/form-data', 'class' => 'myForm')) !!}
    <div id="modal-hapus-file-ct-pic" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0">Hapus Lampiran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="attachment">
                    <input type="hidden" name="id">
                    <p class="mb-0 mt-2">Apakah anda yakin ingin menghapus lampiran <b><span class="nama_lampiran"></span></b>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm waves-effect" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-danger btn-sm waves-effect waves-light">Hapus</button>
                </div>
            </div>            
        </div>        
    </div>    
{!! form_close() !!}

@endif

@endsection

@section('js')
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<script src="{{ base_url('assets/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ base_url('assets/js/daterangepicker.js') }}"></script>
<script src="{{ base_url('assets/js/select2.min.js') }}"></script>
<script src="{{ base_url('assets/js/bootstrap-select.min.js') }}"></script>

<script src="{{ base_url('assets/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ base_url('assets/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ base_url('assets/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ base_url('assets/js/responsive.bootstrap4.min.js') }}"></script>

<script src="{{ base_url('assets/js/jquery.steps.min.js') }}"></script>
<script src="{{ base_url('assets/js/jquery.validate.min.js') }}"></script>
<script src="{{ base_url('assets/js/form-wizard.init.js') }}"></script>
<script src="{{ base_url('assets/js/bootstrap-filestyle.min.js') }}"></script>

<script src="{{ base_url('assets/js/tooltipster.bundle.min.js') }}"></script>
<script src="{{ base_url('assets/js/tooltipster.init.js') }}"></script>

<script>
    $(document).ready(function(){

        function bytesToSize(bytes) {
            const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB']
            if (bytes === 0) return 'n/a'
                const i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)), 10)
                if (i === 0) return `${bytes} ${sizes[i]})`
                return `${(bytes / (1024 ** i)).toFixed(1)} ${sizes[i]}`
        }

        $('.dataTable').dataTable({
            stateSave: true
        })
        
        $('#tb-detail-biaya').on('click', '.btn-rd_more', function(e){
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

        $('#tb-detail-biaya').on('click', '.btn-rd_more_1', function(e){
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
                $(this).parent().find('.btn-rd_more_1').removeAttr('hidden')
            })
            e.preventDefault()
        })

        @if($unit == '002' || $jabatan == 0)

            $('#tb-detail-biaya').on('click', '.btn-buat_catatan_keu', function(){
                const data = {
                    id: $(this).data('id'),
                    nama_kegiatan: $(this).data('nama_kegiatan'),
                    keterangan: $(this).data('keterangan'),
                    anggaran_disetujui: $(this).data('anggaran_disetujui'),
                    anggaran_realisasi: $(this).data('anggaran_realisasi')
                }

                $('#modal-buat-catatan-keu input[name="id"]').val(data.id)
                $('#modal-buat-catatan-keu span.nama_kegiatan').text(data.nama_kegiatan)
                $('#modal-buat-catatan-keu span.keterangan').text(data.keterangan)
                $('#modal-buat-catatan-keu span.anggaran_disetujui').text(data.anggaran_disetujui)
                $('#modal-buat-catatan-keu span.anggaran_realisasi').text(data.anggaran_realisasi)
                $('#modal-buat-catatan-keu').modal('show')                
            })
            
            $('#tb-detail-biaya').on('click', '.btn-upload_bukti_keu', function(){
                const data = {
                    id: $(this).data('id'),
                    nama_kegiatan: $(this).data('nama_kegiatan'),
                    keterangan: $(this).data('keterangan'),
                    anggaran_disetujui: $(this).data('anggaran_disetujui'),
                    anggaran_realisasi: $(this).data('anggaran_realisasi').slice(0, -3),
                    lampiran: $(this).data('lampiran')
                }

                $('#modal-unggah-lampiran-keu span.mdl_title').text(data.lampiran == 'undefined' ? 'Unggah' : 'Ubah')
                $('#modal-unggah-lampiran-keu input[name="old_lampiran"]').val(data.lampiran)
                $('#modal-unggah-lampiran-keu input[name="id"]').val(data.id)
                $('#modal-unggah-lampiran-keu span.nama_kegiatan').text(data.nama_kegiatan)
                $('#modal-unggah-lampiran-keu span.keterangan').text(data.keterangan)
                $('#modal-unggah-lampiran-keu').modal('show')
            })

            $('#tb-detail-biaya').on('click', '.btn-hapus_file_catatan_keu', function(){
                const data = {
                    id: $(this).data('id'),
                    file_name: $(this).data('file_name'),
                    file: $(this).data('file')
                }
                
                $('#modal-hapus-file-ct-keu input[name="id"]').val(data.id)
                $('#modal-hapus-file-ct-keu input[name="attachment"]').val(data.file)
                $('#modal-hapus-file-ct-keu span.nama_lampiran').text(data.file_name)
                $('#modal-hapus-file-ct-keu').modal('show')
            })

            $('#tb-detail-biaya').on('click', '.btn-ubah_catatan_keu', function(){
                
                const data = {
                    id: $(this).data('id'),
                    nama_kegiatan: $(this).data('nama_kegiatan'),
                    keterangan: $(this).data('keterangan'),
                    anggaran_disetujui: $(this).data('anggaran_disetujui'),
                    anggaran_realisasi: $(this).data('anggaran_realisasi'),
                    catatan_disetujui: $(this).data('catatan_disetujui')
                }

                $('#modal-buat-catatan_keu textarea[name="catatan"]').val(data.catatan_disetujui)
                $('#modal-buat-catatan_keu input[name="id"]').val(data.id)
                $('#modal-buat-catatan_keu span.nama_kegiatan').text(data.nama_kegiatan)
                $('#modal-buat-catatan_keu span.keterangan').text(data.keterangan)
                $('#modal-buat-catatan_keu').modal('show')
            })

            @endif

        @if($data->realisasi == 'N')
        
        $('#tb-detail-biaya').on('click', '.btn-hapus_file_catatan_pic', function(){
            const data = {
                id: $(this).data('id'),
                file_name: $(this).data('file_name'),
                file: $(this).data('file')
            }

            $('#modal-hapus-file-ct-pic input[name="id"]').val(data.id)
            $('#modal-hapus-file-ct-pic input[name="attachment"]').val(data.file)
            $('#modal-hapus-file-ct-pic span.nama_lampiran').text(data.file_name)
            $('#modal-hapus-file-ct-pic').modal('show')
        })

        $('#tb-detail-biaya').on('click', '.btn-upload_bukti', function(){
            const data = {
                id: $(this).data('id'),
                nama_kegiatan: $(this).data('nama_kegiatan'),
                keterangan: $(this).data('keterangan'),
                anggaran_disetujui: $(this).data('anggaran_disetujui'),
                anggaran_realisasi: $(this).data('anggaran_realisasi').slice(0, -3),
                lampiran: $(this).data('lampiran')
            }

            $('#modal-unggah-lampiran span.mdl_title').text(data.lampiran == 'undefined' ? 'Unggah' : 'Ubah')
            $('#modal-unggah-lampiran input[name="old_lampiran"]').val(data.lampiran)
            $('#modal-unggah-lampiran input[name="id"]').val(data.id)
            $('#modal-unggah-lampiran span.nama_kegiatan').text(data.nama_kegiatan)
            $('#modal-unggah-lampiran span.keterangan').text(data.keterangan)
            $('#modal-unggah-lampiran').modal('show')
        })

        $('#tb-detail-biaya').on('click', '.btn-ubah_realisasi_anggaran', function(){
            const data = {
                id: $(this).data('id'),
                nama_kegiatan: $(this).data('nama_kegiatan'),
                keterangan: $(this).data('keterangan'),
                anggaran_disetujui: $(this).data('anggaran_disetujui'),
                anggaran_realisasi: $(this).data('anggaran_realisasi').slice(0, -3)
            }
            
            $('#modal-realisasi-anggaran input[name="id"]').val(data.id)
            $('#modal-realisasi-anggaran span.nama_kegiatan').text(data.nama_kegiatan)
            $('#modal-realisasi-anggaran span.keterangan').text(data.keterangan)
            $('#modal-realisasi-anggaran span.anggaran_disetujui').text(data.anggaran_disetujui)
            $('#modal-realisasi-anggaran input[name="anggaran_realisasi"]').val(data.anggaran_realisasi)
            $('#modal-realisasi-anggaran').modal('show')            
        })

        $('#tb-detail-biaya').on('click', '.btn-buat_catatan', function(){

            const data = {
                id: $(this).data('id'),
                nama_kegiatan: $(this).data('nama_kegiatan'),
                keterangan: $(this).data('keterangan'),
                anggaran_disetujui: $(this).data('anggaran_disetujui'),
                anggaran_realisasi: $(this).data('anggaran_realisasi')
            }

            $('#modal-buat-catatan input[name="id"]').val(data.id)
            $('#modal-buat-catatan span.nama_kegiatan').text(data.nama_kegiatan)
            $('#modal-buat-catatan span.keterangan').text(data.keterangan)
            $('#modal-buat-catatan span.anggaran_disetujui').text(data.anggaran_disetujui)
            $('#modal-buat-catatan span.anggaran_realisasi').text(data.anggaran_realisasi)
            $('#modal-buat-catatan').modal('show')
        })

        $('#tb-detail-biaya').on('click', '.btn-ubah_catatan', function(){

            const data = {
                id: $(this).data('id'),
                nama_kegiatan: $(this).data('nama_kegiatan'),
                keterangan: $(this).data('keterangan'),
                anggaran_disetujui: $(this).data('anggaran_disetujui'),
                anggaran_realisasi: $(this).data('anggaran_realisasi'),
                catatan_disetujui: $(this).data('catatan_disetujui')
            }
            
            $('#modal-buat-catatan textarea[name="catatan"]').val(data.catatan_disetujui)
            $('#modal-buat-catatan input[name="id"]').val(data.id)
            $('#modal-buat-catatan span.nama_kegiatan').text(data.nama_kegiatan)
            $('#modal-buat-catatan span.keterangan').text(data.keterangan)
            $('#modal-buat-catatan').modal('show')
        })

        var rupiah = document.getElementById('anggaran_realisasi');        
        
		rupiah.addEventListener('keyup', function(e){			            
			rupiah.value = formatRupiah(this.value, 'Rp ');            
		});
 		
		function formatRupiah(angka, prefix){
			var number_string = angka.replace(/[^,\d]/g, '').toString(),
			split   		= number_string.split(','),
			sisa     		= split[0].length % 3,
			rupiah     		= split[0].substr(0, sisa),
			ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
 
			if(ribuan){
				separator = sisa ? '.' : '';
				rupiah += separator + ribuan.join('.');
			}
 
			rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
			return prefix == undefined ? rupiah : (rupiah ? 'Rp ' + rupiah : '');
		}

        @endif

        $('.showReply').click(function(e){
            const text = $(this).text() == 'Lihat Balasan' ? 'Sembunyikan Balasan' : 'Lihat Balasan'
            $(this).text(text)
            e.preventDefault()
        })
        
        $('#file-chat-attachment').change(function(e){
            const fileName = e.target.files[0].name    
            const fileSize = e.target.files[0].size            
            $('div#detail-attachment').fadeIn()
            $('div#detail-attachment span#attachment-file-name').text(fileName)
            $('div#detail-attachment span#attachment-file-size').text(bytesToSize(fileSize))
        })

        $('#chat-section').on('click', '.hapus-chat', function(){
            $('#modal-hapus-pesan input[name="attachment"]').val($(this).data('attachment'))
            $('#modal-hapus-pesan input[name="id"]').val($(this).data('id'))
            $('#modal-hapus-pesan span#sender').text($(this).data('sender'))
            $('#modal-hapus-pesan span#time').text($(this).data('time'))
            $('#modal-hapus-pesan p#pesan').text($(this).data('pesan'))
            $('#modal-hapus-pesan').modal('show')
        })        

        $('#chat-section').on('click', '.reply-chat', function(event){
            $('#reply-box').removeClass('d-none')
            $('#reply-box span#reply-from').text($(this).data('sender'))
            $('#reply-box p#reply-message').text($(this).data('pesan'))
            $('#input-pesan input#pesan').attr('placeholder','Balas pesan...')
            $('#input-pesan input#pesan').attr('name','reply_pesan')
            $('#input-pesan input#file-chat-attachment').attr('name','reply_attachment')
            $('input#reply_id').val($(this).data('id'))
        })

        $('#close-reply').click(function(){
            $('#reply-box').addClass('d-none')
            $('#input-pesan input#pesan').attr('placeholder','Ketik pesan disini...')
            $('#input-pesan input#pesan').attr('name','pesan')
            $('#input-pesan input#file-chat-attachment').attr('name', 'attachment')
        })

    })
</script>
@endsection