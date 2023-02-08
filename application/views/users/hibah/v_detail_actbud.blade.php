@extends('layouts.user')

@section('title', 'Detail Kegiatan Actbud')

@section('page-title')
<a href="{{ base_url('app/hibah/status_pencairan') }}"><i class="mdi mdi-arrow-left"></i></a> Detail Kegiatan
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
<li class="breadcrumb-item"><a href="{{ base_url('app/hibah') }}"><i class="mdi mdi-briefcase-outline"></i> Hibah</a></li>
<li class="breadcrumb-item"><a href="{{ base_url('app/hibah/pencairan') }}"><i class="mdi mdi-cash-register"></i> Pencairan</a></li>
<li class="breadcrumb-item"><a href="{{ base_url('app/hibah/status_pencairan') }}"><b><i class="mdi mdi-file-document-outline"></i> {{ $data->kode_uraian }}</a></b></li>
<li class="breadcrumb-item active"><a href="javascript:void(0)"><i class="mdi mdi-clipboard-outline"></i> Detail Actbud</li>
@endsection

@section('content')

@if ($data->status !== 'ongoing')
    <div class="col-md-12">
        <h6>Status Approval</h6>
        @include('users.hibah.tracker_status_actbud')
    </div>        
@endif

<div class="col-md-12">
    <div class="card card-border card-teal">
        <div class="card-header border-teal bg-transparent">
            <div class="float-left">
                <h3 class="card-title mb-0"><i class="mdi mdi-file-document-outline"></i> DETAIL ACTBUD</h3>
            </div>
            <div class="float-right">
                @switch($data->status)
                    @case('cancel')
                        <span class="badge badge-danger">Ditolak</span>
                        @break
                    @case('ongoing')
                        <span class="badge badge-warning">Dalam Perencanaan</span>
                        @break
                    @case('submitted')
                        <span class="badge badge-info">Sedang Berlangsung</span>
                        @break
                    @case('approved')
                        <span class="badge badge-success"><i class="mdi mdi-check-bold"></i> Actbud Disetujui</span>
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
                        <p class="form-control-static" style="font-size: 14px;">{{ $data->nama_kegiatan }}</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Deskripsi Kegiatan</label>
                        <p class="form-control-static" style="font-size: 14px;">{{ $data->deskripsi_kegiatan }}</p>
                    </div>
                </div>                
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">KPI</label>
                        <p class="form-control-static" style="font-size: 14px;">{{ $data->kpi }}</p>
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
                            <span class="badge bg-secondary">
                                <i class="mdi mdi-calendar"></i> {{ tanggal_indo($data->tgl_mulai) . ' s/d ' . tanggal_indo($data->tgl_selesai) }}
                            </span>
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Periode</label>
                        <p class="form-control-static">
                            <span class="badge bg-warning">
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
                            <span class="badge bg-purple">
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
                                <span class="badge bg-light text-muted">
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
        @if ($data->status == 'approved')
            <div class="card-footer">
                <div class="float-right">                    
                    <a href="javascript:void(0)" onclick="window.open('{{ base_url('app/hibah/pencairan/v_detail/' . $CI->uri->segment(5) . '/actbud/' . $CI->uri->segment(7) . '/cetak_form_actbud?pdf=true') }}')" class="btn btn-primary btn-sm"><i class="mdi mdi-printer"></i></a>
                </div>
            </div>
        @endif
        <!--<div class="card-footer">
            <div class="float-right">
                <a href="javascript:void(0)" data-toggle="modal" data-target="#modal-batalkan-actbud" class="btn btn-danger btn-sm"><i class="mdi mdi-trash-can"></i> Batalkan</a>
                <a href="javascript:void(0)" data-toggle="modal" data-target="#modal-ubah-actbud" class="btn btn-secondary btn-sm"><i class="mdi mdi-pencil"></i> Ubah</a>
                <a href="" class="btn btn-primary btn-sm"><i class="mdi mdi-content-save"></i> Submit Kegiatan</a>
            </div>
        </div>-->
    </div>    

    <div class="card card-border card-success" id="card-rincian">
        <div class="card-header border-success bg-transparent">
            <h3 class="card-title mb-0"><i class="mdi mdi-clipboard-list-outline"></i> DETAIL BIAYA</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped dataTable">
                    <thead>
                        <tr>
                            <th class="text-center" width=50>No</th>
                            <th>Nama Kegiatan</th>
                            <th class="text-center">Keterangan</th>
                            <th class="text-center">Total Anggaran</th>
                            @if ($data->status == 'ongoing')
                                <th class="text-center">Aksi</th>
                            @endif

                            @if ($data->status == 'submitted' || $data->status == 'approved')
                                <th class="text-center">Catatan Pimpinan</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody id="tb-rincian-kegiatan">
                        @foreach ($rincian_kegiatan->result() as $item)
                            <tr>
                                <th class="text-center" style="vertical-align: middle;">{{ $loop->iteration }}</th>
                                <td style="vertical-align: middle;">
                                    <span class="" style="font-size: 14px;">
                                        {{ $item->nama_kegiatan }}
                                    </span>
                                </td>
                                <td style="vertical-align: middle;">
                                    <span class="" style="font-size: 14px;">
                                        {{ $item->keterangan }}
                                    </span>
                                </td>
                                <td class="text-center" style="vertical-align: middle;">
                                    <span class="badge bg-purple">
                                        {{ rupiah($item->total_anggaran) }}
                                    </span>
                                </td>
                                @if ($data->status == 'ongoing')
                                    <td class="text-center" style="vertical-align: middle;">
                                        <a href="javascript:void(0)" data-id="{{ encrypt($item->id) }}" 
                                        data-nama_kegiatan="{{ $item->nama_kegiatan }}" class="btn btn-danger btn-sm btn-hapus"><i class="mdi mdi-trash-can"></i></a>
                                    </td>
                                @endif
                                
                                @if ($data->status == 'submitted' || $data->status == 'approved')
                                    <td style="vertical-align: middle;">
                                        <ul style="list-style: none;padding-inline-start:0;" class="mb-0">
                                            <li>
                                                <span style="font-size: 14px;">Warek 1: </span>
                                                <span style="font-size: 14px;">{{ $item->catatan_wr_1 }}</span>
                                            </li>
                                            <li>
                                                <span style="font-size: 14px;">Warek 2: </span>
                                                <span style="font-size: 14px;">{{ $item->catatan_wr_2 }}</span>
                                            </li>
                                        </ul>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <th></th>
                        <th class="text-right" colspan="2">Total Anggaran : </th>
                        <td class="text-center">
                            <span class="badge bg-primary">
                                {{ rupiah($sisa->digunakan) }}
                            </span>
                        </td>
                        @if ($data->status == 'ongoing')
                            <td></td>
                        @endif                        
                        @if ($data->status == 'submitted' || $data->status == 'approved')
                            <td></td>
                        @endif
                    </tfoot>
                </table>
            </div>
        </div>
        @if ($data->status == 'ongoing')                
            <div class="card-footer">
                <div class="float-right">
                    <a href="javascript:void(0)" data-toggle="modal" data-target="#modal-buat-kegiatan" class="btn btn-primary btn-sm"><i class="mdi mdi-plus"></i> Buat Kegiatan</a>
                </div>
            </div>
        @endif
    </div>
    
    <div class="card card-border card-info" id="card-dokumen-pendukung">
        <div class="card-header border-info bg-transparent">
            <h3 class="card-title mb-0"><i class="mdi mdi-file-multiple-outline"></i> DOKUMEN PENDUKUNG</h3>
        </div>
        <div class="card-body">            
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped dataTable">
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
                                    <a href="javascript:void(0)">
                                        <i class="mdi mdi-file"></i>
                                        @php
                                            $pecah_nama = explode('_', $row->nama_file);
                                            echo $pecah_nama[1] . ' ('.formatBytes($row->ukuran_file).')';
                                        @endphp
                                    </a>
                                </td>
                                <td>
                                    {{ $row->deskripsi }}
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
        @if ($data->status == 'ongoing')
            <div class="card-footer">
                <div class="float-right">
                    <a href="javascript:void(0)" data-toggle="modal" data-target="#modal-upload-dokumen-pendukung" class="btn btn-teal btn-sm"><i class="mdi mdi-upload"></i> Upload Dokumen</a>
                </div>
            </div>
        @endif
    </div>
    
    {!! form_open('app/hibah/pencairan/v_detail/' . $CI->uri->segment(5) . '/actbud/' . $CI->uri->segment(7) . '/buat_pesan', array('id' => 'form-pesan', 'enctype' => 'multipart/form-data')) !!}
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
                            <div class="list-group-item" style="border-left: 2px solid rgba(0,0,0,.125);/*border-top:none;border-bottom:none;border-right:none;*/margin-bottom:10px;">
                                <div class="list-group-item-heading font-16 mt-0 mb-1 pb-1 border-bottom">                                    
                                    <span style="font-weight: bold;">
                                        <img src="<?= base_url() ?>assets/images/user-icon.png" alt="" srcset="" width="20" style="margin-bottom: 5px;">
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

        @if ($data->status !== 'cancel' && $data->status !== 'approved')
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
        @endif
    </div> 
    {!! form_close() !!}    
    
    @if ($data->status == 'ongoing')
        @if (empty($rincian_kegiatan->result()))
            <div class="card-box">
                <div class="alert alert-info">
                    <p class="mb-0"><i class="mdi mdi-information-variant"></i> Sebelum submit, pastikan anda sudah mengisi detail biaya dengan benar.</p>
                </div>        
                <div class="float-right">
                    <button type="submit" class="btn btn-primary btn-sm" disabled>Submit <i class="mdi mdi-send"></i></button>
                </div>
                <br>
            </div>
        @else
            {!! form_open('app/hibah/pencairan/v_detail/' . $CI->uri->segment(5) . '/actbud/' . $CI->uri->segment(7) . '/submit', array('id' => 'form-pesan', 'enctype' => 'multipart/form-data')) !!}
                <div class="card-box">
                    <div class="alert alert-info">
                        <p class="mb-0"><i class="mdi mdi-information-variant"></i> Sebelum submit, pastikan anda sudah mengisi detail biaya dengan benar.</p>                        
                    </div>                            
                    <div class="float-right">
                        <a href="javasript:void(0)" id="btn-submit-actbud" class="btn btn-primary btn-sm">Submit <i class="mdi mdi-send"></i></a>
                    </div>
                    <br>
                </div>

                <div id="modal-submit-actbud" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title mt-0">Submit Actbud</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="">Pre-Approval</label>
                                    <select name="pre_approval" id="pre_approval" class="form-control">
                                        <option value="">Pilih Pre-Approval</option>                            
                                        <option value="006">HRD</option>
                                        <option value="004">ICT</option>
                                        <option value="003">GA</option>
                                        <option value="013">BKAL</option>
                                        <option value="016">P2M</option>
                                    </select>
                                    <span class="help-block">
                                        <small>
                                            Tentukan pre-approval (jika dibutuhkan):
                                            <br>
                                            <ul>
                                                <li>Permohonan Perjalanan Dinas (BPDS) harus melalui persetujuan HRD.</li>
                                                <li>Permohonan Pengadaan Perangkat Lunak harus melalui persetujuan ICT.</li>
                                                <li>Permohonan Pengadaan Sarana Prasarana harus melalui persetujuan GA.</li>
                                                <li>Permohonan Kemahasiswaan harus melalui persetujuan BKAL.</li>
                                                <li>Permohonan P2M harus melalui persetujuan P2M.</li>
                                            </ul>
                                        </small>
                                    </span>
                                </div>
                                @if ($anggaran_tersisa > 0)
                                    <div class="alert alert-info">
                                        <p class="mb-0">
                                            Anggaran masih tersisa <b>{{ rupiah($anggaran_tersisa) }}</b>, apakah anda yakin ingin tetap melakukan submit?                                                                                        
                                        </p>               
                                    </div>
                                    <b>Catatan</b>: setelah submit anda sudah tidak dapat lagi melakukan perubahan. 
                                @else
                                <div class="alert alert-info">
                                    <p class="mb-0 pb-0">
                                        Apakah anda yakin?
                                    </p>               
                                </div>                                
                                <b>Catatan</b>: setelah submit anda sudah tidak dapat lagi melakukan perubahan. 
                                @endif
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary btn-sm waves-effect" data-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light">Submit <i class="mdi mdi-send"></i></button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
            {!! form_close() !!}
        @endif
    @endif
</div>

@if ($data->status !== 'cancel' && $data->status !== 'approved')
{!! form_open('app/hibah/pencairan/v_detail/' . $CI->uri->segment(5) . '/actbud/' . $CI->uri->segment(7) . '/hapus-pesan') !!}
    <!-- modal hapus pesan -->
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
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
{!! form_close() !!}
@endif

@if ($data->status == 'ongoing')
    <!--  Modal buat kegiatan -->
{!! form_open('app/hibah/pencairan/v_detail/' . $CI->uri->segment(5) . '/actbud/' . $CI->uri->segment(7) . '/buat-rincian-kegiatan') !!}
<div class="modal fade" id="modal-buat-kegiatan" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Buat Rincian Kegiatan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="">Nama Kegiatan</label>
                    <input type="text" name="nama_kegiatan" id="nama_kegiatan" class="form-control" required>
                    <span class="help-block"><small>Masukan nama kegiatan.</small></span>
                </div>
                <div class="form-group">
                    <label for="">Keterangan Kegiatan</label>
                    <textarea name="keterangan" id="keterangan" cols="3" rows="3" class="form-control" required></textarea>
                    <span class="help-block"><small>Masukan keterangan kegiatan.</small></span>
                </div>
                <div class="form-group">
                    <label for="">Total Anggaran</label>
                    <input type="text" name="total_anggaran" id="total_anggaran" class="form-control" required>
                    <span class="help-block"><small>Masukan total anggaran kegiatan.</small></span>
                </div>                 
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-danger btn-sm">Batal</button>
                <button type="submit" class="btn btn-primary btn-sm">Buat Kegiatan</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
{!! form_close() !!}

<!-- Modal ubah actbud -->
<!--{!! form_open('app/hibah/pencairan/v_detail/' . $CI->uri->segment(5) . '/actbud/' . $CI->uri->segment(7) . '/ubah-actbud') !!}
<div id="modal-ubah-actbud" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Ubah</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="">Nama Kegiatan</label>
                    <textarea name="nama_kegiatan" id="nama_kegiatan" cols="2" rows="2" class="form-control" required>{{ $data->nama_kegiatan }}</textarea>
                </div>
                <div class="form-group">
                    <label for="">Deskripsi Kegiatan</label>
                    <textarea name="deskripsi_kegiatan" id="deskripsi_kegiatan" cols="2" rows="2" class="form-control" required>{{ $data->deskripsi_kegiatan }}</textarea>
                </div>
                <div class="form-group">
                    <label for="">KPI</label>
                    <textarea name="kpi" id="kpi" cols="2" rows="2" class="form-control" required>{{ $data->kpi }}</textarea>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">PIC</label>
                            <select name="pelaksana" id="pelaksana" class="form-control select2" style="width:100%;" required>
                                <option value="">Pilih Pelaksana Kegiatan</option>
                                @foreach ($karyawan->result() as $ky)
                                    <option value="{{ $ky->nik }}" <?= $ky->nik == $data->pelaksana ? 'selected' : '' ?>>{{ $ky->nama_lengkap }}</option>
                                @endforeach                                
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Tanggal Pelaksanaan</label>
                            <div>
                                <div class="input-daterange input-group date-range">
                                    <input type="text" class="form-control" name="tgl_mulai" value="{{ $data->tgl_mulai }}" required />
                                    <div class="input-group-append">
                                        <span class="input-group-text bg-primary text-white b-0">s/d</span>
                                    </div>

                                    <input type="text" class="form-control" name="tgl_selesai" value="{{ $data->tgl_selesai }}" required />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Periode</label>
                            <br>
                            <div class="ml-1">
                                <div class="radio radio-info form-check-inline">
                                    <input type="radio" id="periode1" value="1" name="periode" <?= $data->periode == 1 ? "checked" : "" ?> required>
                                    <label for="periode1"> Ganjil </label>
                                </div>
                                <div class="radio form-check-inline">
                                    <input type="radio" id="periode2" value="2" name="periode" <?= $data->periode == 2 ? "checked" : "" ?> required>
                                    <label for="periode2"> Genap </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="old_anggaran" value="{{ $data->agr }}">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Total Anggaran *</label>                            
                            <input type="text" name="total_anggaran" value="{{ $data->agr }}" id="total_anggaran" class="form-control" required>                                
                            <span class="help-block"><small>Tentukan total anggaran kegiatan.</small></span>                            
                        </div>
                    </div>                    
                </div>                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm waves-effect" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light">Simpan Perubahan</button>
            </div>
        </div>        
    </div>    
</div>
{!! form_close() !!}-->

{!! form_open('app/hibah/pencairan/v_detail/' . $CI->uri->segment(5) . '/actbud/' . $CI->uri->segment(7) . '/upload-dokumen-pendukung', array('enctype' => 'multipart/form-data')) !!}
    <!-- modal upload dokumen pendukung -->
    <div id="modal-upload-dokumen-pendukung" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0"> Upload Dokumen Pendukung</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Dokumen</label>
                        <input type="file" name="dokumen" id="dokumen" class="filestyle" required>
                        <span class="help-block"><small>Silakan upload dokumen pendukung.</small></span>
                    </div>
                    <div class="form-group">
                        <label for="">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" class="form-control" cols="3" rows="3" required></textarea>
                        <span class="help-block"><small>Tuliskan deskripsi dokumen.</small></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm waves-effect" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light"><i class="mdi mdi-upload"></i> Upload Dokumen</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
{!! form_close() !!}

{!! form_open('app/hibah/pencairan/v_detail/' . $CI->uri->segment(5) . '/actbud/' . $CI->uri->segment(7) . '/batalkan-actbud') !!}
    <!-- modal batalkan actbud -->
    <div id="modal-batalkan-actbud" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0">Batalkan Actbud</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="mb-0">Apakah anda yakin ingin membatalkan kegiatan ini?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm waves-effect" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-danger btn-sm waves-effect waves-light">Ya, batalkan!</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
{!! form_close() !!}

{!! form_open('app/hibah/pencairan/v_detail/' . $CI->uri->segment(5) . '/actbud/' . $CI->uri->segment(7) . '/hapus-dokumen-pendukung') !!}
    <!-- modal hapus dokumen pendukung -->
    <div id="modal-hapus-dokumen-pendukung" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0">Hapus Dokumen Pendukung</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">        
                    <input type="hidden" name="id">            
                    <input type="hidden" name="file_name">
                    <p class="mb-0 mt-0">Apakah anda yakin ingin menghapus dokumen ini? <span id="detail" style="font-weight: bold;"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm waves-effect" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-danger btn-sm waves-effect waves-light">Hapus</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
{!! form_close() !!}

{!! form_open('app/hibah/pencairan/v_detail/' . $CI->uri->segment(5) . '/actbud/' . $CI->uri->segment(7) . '/hapus-rincian-kegiatan') !!}
    <!-- modal hapus dokumen pendukung -->
    <div id="modal-hapus-rincian-kegiatan" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0">Hapus Kegiatan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">        
                    <input type="hidden" name="id">                                
                    <p class="mb-0 mt-0">Apakah anda yakin ingin kegiatan ini? <span id="detail" style="font-weight: bold;"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm waves-effect" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-danger btn-sm waves-effect waves-light">Hapus</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
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

        @if ($data->status !== 'ongoing')
            $('#approval_tracking').on('click', '.appvd', function(){
                let data = {
                    st: $(this).data('st'),
                    approval: $(this).data('approval'),
                    catatan: $(this).data('catatan'),
                    stamp: $(this).data('stamp'),
                    penyetuju: $(this).data('penyetuju')
                }
                $('#modal-detail-approved #modal-detail-approved-title').text(data.approval)
                $('#modal-detail-approved #tgl_disetujui').text(': ' + data.stamp)
                $('#modal-detail-approved #catatan').text(': ' + data.catatan)
                $('#modal-detail-approved #penyetuju').text(data.penyetuju)
                if(data.st == 'Y'){
                    $('#modal-detail-approved #status').addClass('badge badge-success').html('<i class="mdi mdi-check-bold"></i> Disetujui')
                } else {
                    $('#modal-detail-approved #status').addClass('badge badge-danger').html('<i class="mdi mdi-close-thick"></i> Ditolak')
                }
                $('#modal-detail-approved').modal('show')
            })
        @endif

        $('#btn-submit-actbud').click(function(){
            $('#modal-submit-actbud').modal('show')
        })

        $('#tb-rincian-kegiatan').on('click', '.btn-hapus', function(){
            const data = {
                id: $(this).data('id'),
                nama_kegiatan: $(this).data('nama_kegiatan')
            }

            $('#modal-hapus-rincian-kegiatan').modal('show')
            $('#modal-hapus-rincian-kegiatan input[name="id"]').val(data.id)
            $('#modal-hapus-rincian-kegiatan span#detail').text(data.nama_kegiatan)
        })

        $('#tb-dokumen').on('click', '.btn-hapus-dokumen', function(){
            $('#modal-hapus-dokumen-pendukung input[name="file_name"]').val($(this).data('file_name'))
            $('#modal-hapus-dokumen-pendukung input[name="id"]').val($(this).data('id'))
            $('#modal-hapus-dokumen-pendukung').modal('show')
        })        

        function bytesToSize(bytes) {
            const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB']
            if (bytes === 0) return 'n/a'
                const i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)), 10)
                if (i === 0) return `${bytes} ${sizes[i]})`
                return `${(bytes / (1024 ** i)).toFixed(1)} ${sizes[i]}`
        }
        @if ($data->status !== 'cancel' && $data->status !== 'approved')
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

        /*$('#chat-section').on('click', '.reply-chat', function(event){
            var target = event.target           
            var replyForm
            if (target.matches("[data-toggle='reply-form']")) {
                replyForm = document.getElementById(target.getAttribute("data-target"))             
                replyForm.classList.toggle("d-none")
            }            
        })*/

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
        @endif

        $('.dataTable').dataTable({
            stateSave: true
        })
        $('.date-range').datepicker({
            toggleActive:!0,
            format: 'yyyy-mm-dd',
            startDate: "<?= date('Y-m-d') ?>",
        })

        $(".select2").select2()
      
        const data_agr = "{{ $data->agr }}";
        //$('#total_anggaran').val(formatRupiah(data_agr, "Rp. "))

        var rupiah = document.getElementById('total_anggaran');        
        
		rupiah.addEventListener('keyup', function(e){			            
			rupiah.value = formatRupiah(this.value, 'Rp. ');            
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
			return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
		}
    })
</script>
@endsection