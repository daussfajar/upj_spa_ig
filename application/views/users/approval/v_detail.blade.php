@extends('layouts.user')

@section('title', 'Detail Approval')

@section('page-title')
<a href="{{ $_SERVER['HTTP_REFERER'] }}" class=""><i class="mdi mdi-arrow-left"></i></a> <i class="mdi mdi-file-document-outline"></i> Detail Actbud
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="javascript: void(0);"><i class="mdi mdi-clipboard-file-outline"></i> Approval</a>
</li>
<li class="breadcrumb-item active"><a href="javascript: void(0);"><b><i class="mdi mdi-file-document-outline"></i>
			{{ $data->kode_uraian }}</a></b></li>
@endsection

@section('css')
<link rel="stylesheet" href="{{ base_url('assets/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ base_url('assets/css/responsive.bootstrap4.min.css') }}">
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

@section('content')
@php
$kode_jabatan = $_SESSION['user_sessions']['kode_jabatan'];
$approvalOpen = false;
$kode_unit = $_SESSION['user_sessions']['kode_unit'];

if($kode_jabatan == 6 && $data->st_kabag == ""){
    $approvalOpen = true;
} else if($kode_jabatan == 22 && $data->st_kabag == ""){
    $approvalOpen = true;
} else if($kode_jabatan == 22 && $data->st_sign == "" && $data->sign == $kode_unit){
    $approvalOpen = true;
} else if($kode_jabatan == 22 && $kode_unit == 002 && $data->st_keu == ""){
    $approvalOpen = true;
} else if($kode_jabatan == 3 && $data->st_warek_1 == ""){
    $approvalOpen = true;
} else if($kode_jabatan == 4 && $data->st_warek_2 == ""){
    $approvalOpen = true;
} else if($kode_jabatan == 0){
    $approvalOpen = true;
}
@endphp
<div class="col-md-12">
    <h6>Status Approval</h6>
	@include('users.hibah.tracker_status_actbud')
</div>
<div class="col-md-12">
	<div class="card-box">
		<div class="row">
			<div class="col-md-3">
				<div class="form-group">
					<label for="">Kode Uraian</label>
					<p class="form-control-static">
                        <span class="badge bg-purple">
                            {{ $data->kode_uraian }}
                        </span>
                    </p>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label for="">Nama Hibah/Sponsorship</label>
					<p class="form-control-static" style="font-size: 14px;">
                        {{ $data->nama_kegiatan }}
                    </p>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label for="">Total Anggaran</label>
					<p class="form-control-static">
						<span class="badge bg-success">
                            {{ rupiah($data->agr) }}
                        </span>
					</p>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label for="">Jenis</label>
					<p class="form-control-static" style="font-size: 14px;">
						@switch($data->jenis_anggaran)
						@case('hibah')
						<span class="badge badge-info">Hibah</span>
						@break
						@case('sponsorship')
						<span class="badge badge-info">Sponsorship</span>
						@break
						@default
						<span class="badge badge-danger">Unknown</span>
						@endswitch
					</p>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label for="">KPI</label>
					<p class="form-control-static" style="font-size: 14px;">{{ $data->kpi }}</p>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label for="">PIC</label>
					<p class="form-control-static" style="font-size: 14px;">
                        {{ $data->pic }}
                    </p>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label for="">Pelaksana</label>
					<p class="form-control-static" style="font-size: 14px;">
                        {{ $data->pelaksana }}
                    </p>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label for="">Tanggal Pelaksaan</label>
					<p class="form-control-static" style="font-size:14px;">
						<i class="mdi mdi-calendar"></i> {{ tanggal_indo($data->tgl_mulai) }} s/d
						{{ tanggal_indo($data->tgl_selesai) }}
					</p>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label for="">Periode</label>
					<p class="form-control-static" style="font-size: 14px;">
						@switch($data->periode)
						@case(1)
						<span class="badge badge-warning">Ganjil</span>
						@break
						@case(2)
						<span class="badge badge-warning">Genap</span>
						@break
						@default
						<span class="badge badge-danger">Unknown</span>
						@endswitch
					</p>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label for="">Deskripsi Kegiatan</label>
					<p class="form-control-static" style="font-size: 14px;">
						{{ $data->deskripsi_kegiatan }}
					</p>
				</div>
			</div>
		</div>

	</div>
</div>

<div class="col-md-12">
	<div class="card-box">
		<ul class="nav nav-tabs tabs-bordered nav-justified" role="tablist">
			<li class="nav-item">
				<a class="nav-link active" id="detail-biaya-tab" data-toggle="tab" href="#detail-biaya" role="tab"
					aria-controls="home-b2" aria-selected="false">
					<span class="d-block d-sm-none"><i class="mdi mdi-clipboard-list-outline"></i></span>
					<span class="d-none d-sm-block"><i class="mdi mdi-clipboard-text"></i> Detail Biaya</span>
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" id="pesan-tab" data-toggle="tab" href="#pesan" role="tab" aria-controls="profile-b2"
					aria-selected="true">
					<span class="d-block d-sm-none"><i class="mdi mdi-message-text-outline"></i></span>
					<span class="d-none d-sm-block"><i class="mdi mdi-message"></i> Pesan</span>
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" id="dokumen-pendukung-tab" data-toggle="tab" href="#dokumen-pendukung" role="tab"
					aria-controls="message-b2" aria-selected="false">
					<span class="d-block d-sm-none"><i class="mdi mdi-file-document-outline"></i></span>
					<span class="d-none d-sm-block"><i class="mdi mdi-file"></i> Dokumen Pendukung</span>
				</a>
			</li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane show active" id="detail-biaya" role="tabpanel" aria-labelledby="detail-biaya-tab">
				<div class="table-responsive">
					<table class="table table-striped table-bordered dataTable">
						<thead>
							<tr>
								<th class="text-center" style="vertical-align: middle" width=50>No</th>
								<th style="vertical-align: middle">Nama Kegiatan</th>
								<th class="text-center" style="vertical-align: middle">Keterangan</th>
								<th class="text-center" style="vertical-align: middle">Total Anggaran</th>
								<th class="text-center" style="vertical-align: middle">Catatan Per Detail Biaya</th>
							</tr>
						</thead>
						<tbody id="tb-biaya">
							@foreach ($detail_biaya->result() as $item)
							<tr>
								<th class="text-center" style="vertical-align: middle">{{ $loop->iteration }}</th>
								<td style="vertical-align: middle">
                                    <span class="" style="font-size: 14px;">
                                        {{ $item->nama_kegiatan }}
                                    </span>
                                </td>
								<td style="vertical-align: middle">
                                    <span class="" style="font-size: 14px;">
                                        {{ $item->keterangan }}
                                    </span>
                                </td>
								<td class="text-center" style="vertical-align: middle" width=100>
                                    <span class="badge bg-success">
									    {{ rupiah($item->total_anggaran) }}
                                    </span>
								</td>
								<td width=100>
									<ul style="padding-inline-start: 0px;list-style:none;">
										<li>
											<span> Warek 1:</span>
											@if ($item->catatan_wr_1 !== "")
											<span style="font-size:14px;">{{ $item->catatan_wr_1 }}</span>
											@else
											@if ($kode_jabatan == 3 || $kode_jabatan == 0 )
											<br>
											<a href="javascript:void(0)" data-id="{{ encrypt($item->id) }}"
												data-nama_kegiatan="{{ $item->nama_kegiatan }}"
												class="btnBuatCatatanWr1" style="font-size: 14px;">Buat catatan</a>
											@endif
											@endif
										</li>
										<li>
											<span> Warek 2:</span>
											@if ($item->catatan_wr_2 !== "")
											<span style="font-size:14px;">{{ $item->catatan_wr_2 }}</span>
											@else
											@if ($kode_jabatan == 4 || $kode_jabatan == 0)
											<br>
											<a href="javascript:void(0)" data-id="{{ encrypt($item->id) }}"
												data-nama_kegiatan="{{ $item->nama_kegiatan }}"
												class="btnBuatCatatanWr2" style="font-size: 14px;">Buat catatan</a>
											@endif
											@endif
										</li>
									</ul>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>

			<div class="tab-pane" id="pesan" role="tabpanel" aria-labelledby="pesan-tab">
				{!! form_open('app/approval/v_detail/' . $CI->uri->segment(4) . '/buat_pesan', array('id' =>
				'form-pesan', 'enctype' => 'multipart/form-data')) !!}
				@if (!empty($messages))
				<div class="messages">
					<div class="list-group bs-ui-list-group mb-0 mr-2" id="chat-section">
						@foreach ($messages as $item)
						@php
						$reply_data = $CI->db->query("SELECT
						a.id,a.nik,a.pesan,a.datetime_chat,a.attachment,a.attachment_size,a.status,b.nama_lengkap sender
						FROM ig_tbl_actbud_chat_reply a
						INNER JOIN tbl_karyawan b ON a.nik = b.nik WHERE a.id_pesan = '".$item->id."' AND a.status =
						'Aktif'")->result();
						@endphp
						<div class="list-group-item"
							style="border-left:none;border-top:none;border-bottom:none;border-right:none;margin-bottom:10px;padding-top:0;padding-left:0;padding-right:0;">
							<div class="list-group-item-heading mt-0 mb-1 pb-1 border-bottom">
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
										<span
											style="font-size: 12px;color:black">{{ formatBytes($item->attachment_size) }}</span>
										<a href="{{ base_url('app-data/chat-attachment/' . $item->attachment) }}"
											class="btn btn-info btn-xs" download="{{ $pecah_attachment[1] }}"><i
												class="mdi mdi-download"></i> Unduh</a>
									</div>
								</div>
							</div>
							@endif
							<span style="font-size: 11px;">{{ get_time_ago(strtotime($item->datetime_chat)) }}</span>
							<br>
							<span style="font-size: 12px;">
								<a href="javascript:void(0)" class="reply-chat" data-id="<?= encrypt($item->id) ?>"
									data-attachment="<?= $item->attachment ?>" data-sender="<?= $item->sender ?>"
									data-time="<?= $item->datetime_chat ?>" data-attachment="<?= $item->attachment ?>"
									data-pesan="<?= $item->pesan ?>"><i class="mdi mdi-reply"></i> Reply</a>
								@if ($item->nik == decrypt($_SESSION['user_sessions']['nik']))
								<a href="javascript:void(0)" class="hapus-chat" data-id="<?= encrypt($item->id) ?>"
									data-attachment="<?= $item->attachment ?>" data-sender="<?= $item->sender ?>"
									data-time="<?= $item->datetime_chat ?>" data-attachment="<?= $item->attachment ?>"
									data-pesan="<?= $item->pesan ?>"><i class="mdi mdi-trash-can"></i> Hapus</a>
								@endif
							</span>

							@if (!empty($reply_data))
							<br>
							<a href="#collapse-reply-message-<?= $item->id ?>" class="showReply" data-toggle="collapse"
								style="font-size: 12px;">Lihat Balasan</a>
							<div class="collapse" id="collapse-reply-message-<?= $item->id ?>">
								@foreach ($reply_data as $item)
								<div class="list-group-item mt-1"
									style="border-left: none;border-top:none;border-bottom:none;border-right:none;padding-bottom:0;">
									<div class="list-group-item-heading font-18 mt-0 mb-1 pb-1 border-bottom">
										<span>
											<img src="<?= base_url() ?>assets/images/logo/logo.png" alt="" srcset=""
												width="20">
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
												<span
													style="font-size: 12px;color:black">{{ formatBytes($item->attachment_size) }}</span>
												<a href="{{ base_url('app-data/chat-attachment/' . $item->attachment) }}"
													class="btn btn-info btn-xs" download="{{ $pecah_attachment[1] }}"><i
														class="mdi mdi-download"></i> Unduh</a>
											</div>
										</div>
									</div>
									@endif
									<span
										style="font-size: 11px;">{{ get_time_ago(strtotime($item->datetime_chat)) }}</span>
								</div>
								@endforeach
							</div>
							@endif

						</div>
						@endforeach
					</div>
				</div>
				@else
				<div class="alert alert-info">
					<p class="mb-0"><i class="mdi mdi-exclamation"></i> Belum ada pesan, silakan buat pesan</p>
				</div>
				@endif

				<div class="list-group-item mb-1 d-none" id="reply-box">
					<div class="list-group-item-heading font-18 mt-0 border-bottom mb-1 pb-1">
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
                            text/plain, application/pdf, image/webp" /></span>
					</span>
					<span class="input-group-append">
						<button type="submit" class="btn waves-effect waves-light btn-primary"><i
								class="mdi mdi-send"></i></button>
					</span>
				</div>
				{!! form_close() !!}
			</div>
			<div class="tab-pane" id="dokumen-pendukung" role="tabpanel" aria-labelledby="dokumen-pendukung-tab">
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
									<a href="{{ base_url('app-data/dokumen-pendukung/' . $row->nama_file) }}"
										class="btn btn-info btn-xs" download="{{ $pecah_nama[1] }}" title="Download">
										<i class="mdi mdi-download"></i> Unduh
									</a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

{!! form_open('app/approval/v_detail/' . $CI->uri->segment(4) . '/hapus_pesan') !!}
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
						<div class="list-group-item-heading font-18 mt-0 mb-1 pb-1 border-bottom">
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

@if ($kode_jabatan == 3 || $kode_jabatan == 0)
{!! form_open('app/approval/v_detail/' . $CI->uri->segment(4) . '/buat_catatan_wr_1') !!}
<!-- modal buat catatan wr 1 -->
<div id="modal-buat-catatan-wr-1" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title mt-0">Buat Catatan</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<input type="hidden" name="id">
				<div class="form-group">
					<label for="">Nama Kegiatan</label>
					<p id="detail" class="form-control-static p-0 m-0"></p>
				</div>
				<div class="form-group">
					<label for="">Catatan</label>
					<textarea name="catatan" id="catatan" cols="3" rows="3" class="form-control" required></textarea>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary btn-sm waves-effect" data-dismiss="modal">Tutup</button>
				<button type="submit" class="btn btn-primary btn-sm waves-effect waves-light">Simpan</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
{!! form_close() !!}
@endif

@if ($kode_jabatan == 4 || $kode_jabatan == 0)
{!! form_open('app/approval/v_detail/' . $CI->uri->segment(4) . '/buat_catatan_wr_2') !!}
<!-- modal buat catatan wr 1 -->
<div id="modal-buat-catatan-wr-2" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title mt-0">Buat Catatan</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<input type="hidden" name="id">
				<div class="form-group">
					<label for="">Nama Kegiatan</label>
					<p id="detail" class="form-control-static p-0 m-0"></p>
				</div>
				<div class="form-group">
					<label for="">Catatan</label>
					<textarea name="catatan" id="catatan" cols="3" rows="3" class="form-control" required></textarea>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary btn-sm waves-effect" data-dismiss="modal">Tutup</button>
				<button type="submit" class="btn btn-primary btn-sm waves-effect waves-light">Simpan</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
{!! form_close() !!}
@endif

@if ($approvalOpen == true)
<div class="col-md-12">
	{!! form_open('app/approval/v_detail/' . $CI->uri->segment(4) . '/submit_actbud', array('id' => 'form-persetujuan')) !!}
	<input type="hidden" name="sign" value="{{ $data->sign }}">
	<input type="hidden" name="kode_unit" value="{{ $data->kode_unit }}">
	<div class="card">
		<div class="card-header bg-transparent">
			<h5 class="card-title mb-0">FORM PERSETUJUAN</h5>
		</div>
		<div class="card-body">
			<div class="alert alert-info">
				<p class="mb-0"><i class="mdi mdi-information-variant"></i> Note: Sebelum submit, pastikan anda sudah
					membaca dan mengetahui kegiatan ini.</p>
			</div>
			<div class="form-group row">
				<label class="col-md-3 control-label">Apakah actbud ini disetujui?</label>
				<div class="col-md-9">
					<div class="radio radio-success form-check-inline">
						<input type="radio" id="chk-setuju" value="Y" name="approval" required>
						<label for="chk-setuju"> Ya, Setuju </label>
					</div>
					<div class="radio radio-danger form-check-inline">
						<input type="radio" id="chk-tidak-setuju" value="N" name="approval" required>
						<label for="chk-tidak-setuju"> Tidak Setuju </label>
					</div>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-3 control-label">Catatan (jika ada)</label>
				<div class="col-md-9">
					<textarea name="catatan" id="catatan" placeholder="Buat catatan disini..." cols="3" rows="3"
						class="form-control"></textarea>
				</div>
			</div>
		</div>
		<div class="card-footer">
			<button type="button" id="btn-submit-actbud" class="btn btn-md btn-primary btn-block">Submit</button>
		</div>
	</div>

	 <!-- modal persetujuan -->
	 <div id="modal-persetujuan" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title mt-0">Konfirmasi</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="note"></div>
					<p class="mb-0">Apakah anda yakin ingin <span class="detail" style="font-weight: bold"></span> actbud ini?</p>			
					@if ($kode_jabatan == 0)
						<div class="form-group">
							<label for="">Anda sebagai <b>admin</b>, silakan pilih approval sebagai:</label>
							<select name="approval_as" id="approval_as" class="form-control" required>
								<option value="">Pilih Approval</option>
								<option value="kaprodi">Ka. Prodi/Unit</option>
								<option value="sign">Sign</option>
								<option value="keuangan">Keuangan</option>
								<option value="warek1">Warek 1</option>
								<option value="warek2">Warek 2</option>
								<option value="all">Semua</option>
							</select>
						</div>
					@endif					
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary waves-effect btn-sm" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary waves-effect waves-light btn-sm">Submit</button>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- /.modal -->
	{!! form_close() !!}
</div>
@endif

@endsection

@section('js')
<script src="{{ base_url('assets/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ base_url('assets/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ base_url('assets/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ base_url('assets/js/responsive.bootstrap4.min.js') }}"></script>
<script>
	$(document).ready(function () {
		
		$('#form-persetujuan').on('click', '#btn-submit-actbud', function(){			
			if($('#form-persetujuan input[type="radio"][name="approval"]').is(':checked')){				
				$('#modal-persetujuan').modal('show')				

				const approval = $('#form-persetujuan input[type="radio"][name="approval"]:checked').val()
				if(approval == 'Y'){
					$('#modal-persetujuan .detail').text('menyetujui')
				} else if(approval == 'N') {
					$('#modal-persetujuan .detail').text('menolak')
				}

				if($('#form-persetujuan textarea[name="catatan"]').val() === ""){
					$('#modal-persetujuan .note').html('<div class="alert alert-info"><p class="mb-0"><b>Note: </b>catatan masih kosong, buat catatan bila diperlukan.</p></div>')
				} else {
					$('#modal-persetujuan .note').html('')
				}

			} else {
				toastr["error"]("Anda harus memilih setuju atau tidak setuju!", "Error")
				return false
			}
		})

		@if($kode_jabatan == 3 || $kode_jabatan == 0)
		$('#tb-biaya').on('click', '.btnBuatCatatanWr1', function () {
			$('#modal-buat-catatan-wr-1').modal('show')
			$('#modal-buat-catatan-wr-1 input[name="id"]').val($(this).data('id'))
			$('#modal-buat-catatan-wr-1 p#detail').text($(this).data('nama_kegiatan'))
		})
		@endif

		@if($kode_jabatan == 4 || $kode_jabatan == 0)
		$('#tb-biaya').on('click', '.btnBuatCatatanWr2', function () {
			$('#modal-buat-catatan-wr-2').modal('show')
			$('#modal-buat-catatan-wr-2 input[name="id"]').val($(this).data('id'))
			$('#modal-buat-catatan-wr-2 p#detail').text($(this).data('nama_kegiatan'))
		})
		@endif

		$('#approval_tracking').on('click', '.appvd', function(){
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
        })

		$('.dataTable').dataTable({
			stateSave: true
		})

		$('.showReply').click(function (e) {
			const text = $(this).text() == 'Lihat Balasan' ? 'Sembunyikan Balasan' : 'Lihat Balasan'
			$(this).text(text)
			e.preventDefault()
		})

		function bytesToSize(bytes) {
			const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB']
			if (bytes === 0) return 'n/a'
			const i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)), 10)
			if (i === 0) return `${bytes} ${sizes[i]})`
			return `${(bytes / (1024 ** i)).toFixed(1)} ${sizes[i]}`
		}

		$('#file-chat-attachment').change(function (e) {
			const fileName = e.target.files[0].name
			const fileSize = e.target.files[0].size
			$('div#detail-attachment').fadeIn()
			$('div#detail-attachment span#attachment-file-name').text(fileName)
			$('div#detail-attachment span#attachment-file-size').text(bytesToSize(fileSize))
		})

		$('#chat-section').on('click', '.hapus-chat', function () {
			$('#modal-hapus-pesan input[name="attachment"]').val($(this).data('attachment'))
			$('#modal-hapus-pesan input[name="id"]').val($(this).data('id'))
			$('#modal-hapus-pesan span#sender').text($(this).data('sender'))
			$('#modal-hapus-pesan span#time').text($(this).data('time'))
			$('#modal-hapus-pesan p#pesan').text($(this).data('pesan'))
			$('#modal-hapus-pesan').modal('show')
		})

		$('#chat-section').on('click', '.reply-chat', function (event) {
			$('#reply-box').removeClass('d-none')
			$('#reply-box span#reply-from').text($(this).data('sender'))
			$('#reply-box p#reply-message').text($(this).data('pesan'))
			$('#input-pesan input#pesan').attr('placeholder', 'Balas pesan...')
			$('#input-pesan input#pesan').attr('name', 'reply_pesan')
			$('#input-pesan input#file-chat-attachment').attr('name', 'reply_attachment')
			$('input#reply_id').val($(this).data('id'))
		})

		$('#close-reply').click(function () {
			$('#reply-box').addClass('d-none')
			$('#input-pesan input#pesan').attr('placeholder', 'Ketik pesan disini...')
			$('#input-pesan input#pesan').attr('name', 'pesan')
			$('#input-pesan input#file-chat-attachment').attr('name', 'attachment')
		})

		toastr.options = {
			"closeButton": true,
			"debug": false,
			"newestOnTop": false,
			"progressBar": false,
			"positionClass": "toast-top-right",
			"preventDuplicates": true,
			"onclick": null,
			"showDuration": "300",
			"hideDuration": "1000",
			"timeOut": "5000",
			"extendedTimeOut": "1000",
			"showEasing": "swing",
			"hideEasing": "linear",
			"showMethod": "fadeIn",
			"hideMethod": "fadeOut"
		}
	})

</script>
@endsection
