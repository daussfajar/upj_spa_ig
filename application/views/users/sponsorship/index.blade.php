@extends('layouts.user')

@section('title', 'Sponsorship')

@section('page-title')
    <i class="mdi mdi-briefcase-outline"></i> Data Sponsorship
@endsection

@section('css')
<link rel="stylesheet" href="{{ base_url('assets/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ base_url('assets/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ base_url('assets/css/jquery-ui.custom-for-signature.css') }}">
<link rel="stylesheet" href="{{ base_url('assets/css/jquery.signature.css') }}">
<link rel="stylesheet" href="{{ base_url('assets/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ base_url('assets/css/bootstrap-select.min.css') }}">
<style>
	.kbw-signature {
		width: 300px;
		height: 300px;
	}

	#ttd canvas {
		width: 100% !important;
		height: auto;
	}

</style>
@endsection

@section('breadcrumb')
<li class="breadcrumb-item active"><a href="javascript: void(0);"><i class="mdi mdi-briefcase-outline"></i> Sponsorship</a></li>
@endsection

@section('content')
    <div class="col-md-12">        
        <div class="card-box mt-2">
            <div class="row mb-3">                    
                <div class="col-md-8 col-sm-8 col-xs-12">
                    <div class="float-left">
                        <a href="{{ base_url('app/sponsorship/buat_kegiatan') }}" class="btn btn-success btn-sm"><i class="mdi mdi-plus"></i> Tambah Data</a>
                    </div>
                    <div class="float-right">                        
                        <a href="javascript:void(0)" id="btn-upload" class="btn btn-info btn-sm"><i class="mdi mdi-upload"></i> Upload</a>
                        <a href="javascript:void(0)" class="btn btn-secondary btn-sm"><i class="mdi mdi-filter"></i></a>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <form action="{{ base_url('app/sponsorship') }}" method="GET" accept-charset="utf-8" autocomplete="off">                        
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
                            <th style="vertical-align: middle;">Kode Uraian</th>
                            <th style="vertical-align: middle;">Kode Pencairan</th>                            
                            <th style="vertical-align: middle;">Nama Sponsorship</th>
                            <th class="text-center" style="vertical-align: middle;">Deskripsi Kegiatan</th>
                            <th width=200 style="vertical-align: middle;">PIC</th>
                            <th class="text-center" style="vertical-align: middle;">Periode</th>                            
                            <!--<th class="text-center" width="250" style="vertical-align: middle;">Tanggal Buat</th>-->
                            <th class="text-center" style="vertical-align: middle;">Sisa Anggaran</th>
                        </tr>
                    </thead>
                    <tbody id="tb-hibah">
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
                                    <th class="text-center" style="vertical-align: middle">{{ $no }}</th>
                                    <th style="vertical-align: middle;">
                                        <a href="{{ base_url('app/sponsorship/v_detail/'.encrypt($row['id'])) }}" class="badge bg-purple">{{ $row['kode_uraian'] }}</a>
                                    </th>
                                    <th style="vertical-align: middle;">
                                        <span class="badge bg-primary">
                                            {{ $row['kode_pencairan'] }}
                                        </span>
                                    </th>                                    
                                    <td style="vertical-align: middle;">
                                        <span class="" style="font-size: 14px;">
                                            {{ $row['nama_hibah_sponsorship'] }}
                                        </span>
                                    </td>                                    
                                    <td style="vertical-align: middle;">
                                        <span class="" style="font-size: 14px;">
                                            @php
                                            $deskripsi_kegiatan = $row['uraian_kegiatan'];
                                            $pecah = explode(' ', $deskripsi_kegiatan);
                                            $potong = array_slice($pecah, 0, 20);
                                            if(count($pecah) > 20){
                                                echo implode(' ', $potong) . '...';
                                            } else {
                                                echo implode(' ', $potong);
                                            }
                                        @endphp
                                        </span>
                                    </td>
                                    <td style="vertical-align: middle;">
                                        <span class="" style="font-size: 14px;">
                                            {{ $row['nama_lengkap'] }} ({{ $row['pic'] }})
                                        </span>
                                        <hr class="mt-1 mb-0">
                                        <a href="javascript:void(0)" data-id="{{ encrypt($row['id']) }}" 
							                data-kode_uraian="{{ $row['kode_uraian'] }}" data-pic="{{ $row['pic'] }}" 
							                data-kode_pencairan="{{ $row['kode_pencairan'] }}" 
							                data-nama_hibah="{{ $row['nama_hibah_sponsorship'] }}" class="badge bg-secondary text-white btn-set_pic">{{ $row['nama_lengkap'] == '' ? 'Tentukan' : 'Ubah' }} PIC</a>
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
                                    <!--<td class="text-center" style="vertical-align: middle;">{{ substr($row['tanggal_buat'], 0, 16) }}</td>
                                    <td class="text-center" style="vertical-align: middle;">
                                        {{ rupiah($row['total_agr']) }}
                                    </td>-->
                                    <td class="text-center" style="vertical-align: middle;">
                                        @if ($row['finalisasi'] == 'N')
                                            <a href="javascript:void(0)" data-id="{{ encrypt($row['id']) }}" data-kode_uraian="{{ $row['kode_uraian'] }}" class="badge bg-danger batalkan-data col-12"><i
                                                    class="mdi mdi-trash-can"></i> Batalkan</a>
                                            <a href="javascript:void(0)" data-id="{{ encrypt($row['id']) }}"
                                                data-nama_hibah="{{ $row['nama_hibah_sponsorship'] }}"
                                                data-deskripsi="{{ $row['uraian_kegiatan'] }}" data-kpi="{{ $row['kpi'] }}"
                                                data-cara_ukur="{{ $row['cara_ukur'] }}" data-base_line="{{ $row['base_line'] }}"
                                                data-target="{{ $row['target'] }}" data-output="{{ $row['output'] }}"
                                                data-periode="{{ $row['periode'] }}" data-unit="{{ $row['kode_unit'] }}" data-pic="{{ $row['pic'] }}" data-kode_pencairan="{{ $row['kode_pencairan'] }}"
                                                data-total_anggaran="{{ $row['total_agr'] }}" data-ttd_pic="{{ $row['ttd_pic'] }}"
                                                data-kode_sub_aktivitas="{{ $row['kode_sub_aktivitas'] }}" data-indikator_kerja_umum="{{ $row['indikator_kerja_umum'] }}"
                                                class="badge bg-secondary ubah-data col-12"><i class="mdi mdi-pencil"></i> Ubah</a>
                                            <a href="javascript:void(0)" data-kode_uraian="{{ $row['kode_uraian'] }}" data-id="{{ encrypt($row['id']) }}"
                                                class="badge bg-primary col-12 finalisasi"><i class="mdi mdi-content-save"></i> Finalisasi</a>
                                        @elseif($row['finalisasi'] == 'Y')
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
                                                echo '<span class="badge bg-primary">'.rupiah($row['total_agr'] - $getSum->digunakan + $getSumIn->saldo_masuk - $getSumOut->saldo_keluar).'</span>';
                                            @endphp
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

    {!! form_open('', array('id' => 'form-set_pic', 'class' => 'myForm')) !!}
    <div id="modal-set_pic" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="set_pic_title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" value="">					
                    <div class="form-group row">						
						<label class="col-lg-4 control-label" for="">Kode Uraian</label>
						<p class="col-lg-8 form-control-static" style="font-weight: bold;">
                            <span class="kode_uraian badge bg-purple"></span>
                        </p>
						<label class="col-lg-4 control-label" for="">Kode Pencairan</label>
						<p class="col-lg-8 form-control-static" style="font-weight: bold;">
                            <span class="kode_pencairan badge bg-primary"></span>
                        </p>
						<label class="col-lg-4 control-label" for="">Nama Hibah</label>
						<p class="col-lg-8 form-control-static nama_hibah_sponsorship" style="font-size:14px;"></p>
						<label class="col-lg-2 control-label" for="address2">PIC *</label>
						<div class="col-lg-10">
							<select name="pic" id="pic3" class="form-control select2" style="width:100%;" required>
								<option value="">Pilih</option>
								@foreach ($unit->result() as $item)
									<optgroup label="{{ $item->nama_unit }}">
										@foreach ($karyawan->result() as $ky)
											@if ($item->kode_unit == $ky->kode_unit)
												<option value="{{ $ky->nik }}">{{ $ky->nama_lengkap }}</option>
											@endif
										@endforeach
									</optgroup>
								@endforeach								
							</select>							
						</div>
					</div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm waves-effect" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light" id="btn-set-pic"><i class="mdi mdi-file-lock-outline"></i></button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    {!! form_close() !!}
    
    {!! form_open('app/sponsorship/preview_upload', array('enctype' => 'multipart/form-data', 'class' => 'myForm')) !!}
    <div id="modal-upload" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0"><i class="mdi mdi-file-excel"></i> Upload Excel</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">                        
                    <div class="alert alert-info mb-2">
                        <p class="mb-0">Sebelum upload, mohon periksa terlebih dahulu dan pastikan bahwa anda sudah mengikuti format excel yang sudah ditentukan.</p>
                    </div>
                    <a href="<?= base_url('app-data/template-excel/Template upload uraian (IG  & Sponsorship).xlsx') ?>" download="Template upload uraian (IG  & Sponsorship)" class="btn btn-success btn-sm"><i class="mdi mdi-download"></i> Download Template</a>
                    <input type="hidden" name="file_upload" value="file_upload_excel">
                    <div class="form-group mt-3">
                        <label for="">Unit/Prodi</label>
                        <select name="unit_prodi" id="unit_prodi" class="form-control pl-0" required>
                            <option value="">Pilih Unit/Prodi</option>
                            @foreach ($unit->result() as $item)
                                <option value="{{ $item->kode_unit }}">{{ $item->nama_unit }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-0 mt-3">
                        <label for="">File</label>
                        <input type="file" name="file" id="file" class="filestyle">
                        <span class="help-block"><small>Allowed extension: .xlsx</small></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light btn-sm waves-effect" data-dismiss="modal">Kembali</button>
                    <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light">Upload <i class="mdi mdi-upload"></i></button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    {!! form_close() !!}

    {!! form_open('', array('id' => 'form-batalkan', 'class' => 'myForm')) !!}
    <div id="modal-batalkan" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0">Batalkan Kegiatan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" value="">
                    <p class="mb-0 pb-0">Apakah anda yakin ingin membatalkan kegiatan <span id="detail" style="font-weight: bold;"></span> ini?</p>
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

<!--  Modal edit -->
{!! form_open('', array('id' => 'form-ubah', 'class' => 'myForm')) !!}
<div class="modal fade bs-example-modal-lg" id="modal-edit" tabindex="-1" role="dialog" aria-hidden="true"
	style="display: none;">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title mt-0">Ubah Data</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<input type="hidden" name="id" value="">
				<div class="form-group">
					<label for="">Nama Hibah</label>
					<input type="text" name="nama_sponsorship" id="nama_sponsorship" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="">Deskripsi Kegiatan</label>
					<textarea name="deskripsi_kegiatan" id="deskripsi_kegiatan" class="form-control" cols="4" rows="4"
						required></textarea>
				</div>
                <div class="form-group">
					<label for="">Kode Sub Aktivitas</label>
					<input type="text" name="kode_sub_aktivitas" id="kode_sub_aktivitas" class="form-control" required>
				</div>
                <div class="form-group">
					<label for="">Indikator Kerja Umum</label>
					<input type="text" name="indikator_kerja_umum" id="indikator_kerja_umum" class="form-control" required>
				</div>
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<label for="">KPI</label>
							<textarea name="kpi" id="kpi" class="form-control" cols="4" rows="4" required></textarea>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="">Cara Ukur</label>
							<textarea name="cara_ukur" id="cara_ukur" class="form-control" cols="4" rows="4"
								required></textarea>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="">Base Line</label>
							<textarea name="base_line" id="base_line" class="form-control" cols="4" rows="4"
								required></textarea>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="">Target</label>
							<textarea name="target" id="target" class="form-control" cols="4" rows="4"
								required></textarea>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="">Output</label>
							<textarea name="output" id="output" class="form-control" cols="4" rows="4"
								required></textarea>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="">Kode Pencairan</label>
					<input type="text" name="kode_pencairan" id="kode_pencairan" class="form-control" required>
				</div>
				<div class="form-group">
					<label class="control-label " for="address2">Periode</label>
					<div class="ml-1">
						<div class="radio radio-info form-check-inline">
							<input type="radio" id="periode1" value="1" name="periode">
							<label for="periode1"> Ganjil </label>
						</div>
						<div class="radio form-check-inline">
							<input type="radio" id="periode2" value="2" name="periode">
							<label for="periode2"> Genap </label>
						</div>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-lg-2 control-label " for="address2">Ubah Anggaran *</label>
					<div class="col-lg-10">
						<input type="text" name="total_anggaran" id="total_anggaran" class="form-control" required>
						<span class="help-block"><small>Tentukan total anggaran kegiatan.</small></span>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-lg-2 control-label" for="address2">PIC *</label>
					<div class="col-lg-10">
						<select name="pic" id="pic" class="form-control select2" style="width:100%;" required>
                            <option value="" id="ubah-pic">Pilih PIC Kegiatan</option>
							@foreach ($unit->result() as $item)
							<optgroup label="{{ $item->nama_unit }}">
								@foreach ($karyawan->result() as $ky)
								@if ($ky->kode_unit == $item->kode_unit)
								<option value="{{ $ky->nik }}" data-nama_lengkap="{{ $ky->nama_lengkap }}">
									{{ $ky->nama_lengkap }}</option>
								@endif
								@endforeach
							</optgroup>
							@endforeach
						</select>
						<span class="help-block"><small>Tentukan pic.</small></span>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-lg-2 control-label" for="address2">Unit *</label>
					<div class="col-lg-10">
						<select name="unit" id="unit" class="form-control select2" style="width:100%;" required>
                            <option value="" id="ubah-unit">Pilih PIC Kegiatan</option>
							@foreach ($unit->result() as $item)
							<option value="{{ $item->kode_unit }}" data-nama_unit="{{ $item->nama_unit }}">
								{{ $item->nama_unit }}
							</option>
							@endforeach
						</select>
						<span class="help-block"><small>Tentukan unit.</small></span>
					</div>
				</div>

				<div class="form-group row">
					<div class="col-md-6">
						<label for="">Tanda Tangan Sebelumnya:</label>
						<img src="" alt="TTD Sebelumnya" srcset="" id="ttd_old">
					</div>
					<div class="col-md-6">
						<label for="">Ubah Menjadi:</label><br />
						<div id="ttd"></div>
						<br />
						<button id="clear_ttd" class="btn btn-danger btn-sm"><i class="mdi mdi-trash-can-outline"></i>
							Hapus Tanda Tangan</button>
						<textarea id="signature64" name="tanda_tangan" style="display: none"></textarea>
					</div>
				</div>
			</div>
			<div class="card-footer">
				<button type="submit" class="btn btn-primary btn-sm float-right"><i class="mdi mdi-content-save"></i>
					Simpan Perubahan</button>
				<a href="#" data-dismiss="modal" class="btn btn-light btn-sm float-right mr-2">Batal</a>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
{!! form_close() !!}

{!! form_open('', array('id' => 'form-finalisasi', 'class' => 'myForm')) !!}
    <div id="modal-finalisasi" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0">Finalisasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" value="">                    
                    <div class="alert alert-info">
                        <p class="mb-0"><b>Note:</b> Pastikan anda sudah mengisi data dengan benar, setelah difinalisasi anda tidak dapat lagi mengubah data.</p>
                    </div>
                    <p class="mb-0 pb-0">Apakah anda yakin ingin melakukan finalisasi dengan kode uraian <span id="detail" style="font-weight: bold;"></span>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm waves-effect" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light"><i class="mdi mdi-file-lock-outline"></i> Finalisasi</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
{!! form_close() !!}
@endsection

@section('js')
<script src="{{ base_url('assets/js/select2.min.js') }}"></script>
<script src="{{ base_url('assets/js/bootstrap-select.min.js') }}"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="{{ base_url('assets/js/jquery.signature.min.js') }}"></script>
<script src="{{ base_url('assets/js/jquery.ui.touch-punch.min.js') }}"></script>
<script src="{{ base_url('assets/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ base_url('assets/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ base_url('assets/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ base_url('assets/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ base_url('assets/js/bootstrap-filestyle.min.js') }}"></script>

<script>
    $(document).ready(function(){        
        $(".select2").select2()
        $("#pic3").select2()

		var sig = $('#ttd').signature({
			syncField: '#signature64',
			syncFormat: 'PNG'
		});
		$('#clear_ttd').click(function (e) {
			e.preventDefault();
			sig.signature('clear');
			$("#signature64").val('');
		});

		$('#btn-upload').click(function () {
			$('#modal-upload').modal('show')
		})

		var rupiah = document.getElementById('total_anggaran');
		var final_anggaran = document.getElementById('final_anggaran')

		rupiah.addEventListener('keyup', function (e) {
			rupiah.value = formatRupiah(this.value, 'Rp. ');
		});

		function formatRupiah(angka, prefix) {
			var number_string = angka.replace(/[^,\d]/g, '').toString(),
				split = number_string.split(','),
				sisa = split[0].length % 3,
				rupiah = split[0].substr(0, sisa),
				ribuan = split[0].substr(sisa).match(/\d{3}/gi);

			if (ribuan) {
				separator = sisa ? '.' : '';
				rupiah += separator + ribuan.join('.');
			}

			rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
			return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
		}

        $('#tb-hibah').on('click', '.btn-set_pic', function () {
			const base_url = "<?= base_url() ?>"
			const data = {
				id: $(this).data('id'),
				nama_hibah: $(this).data('nama_hibah'),
				kode_uraian: $(this).data('kode_uraian'),
				kode_pencairan: $(this).data('kode_pencairan'),
				pic: $(this).data('pic')
			}
			$('#form-set_pic').attr('action', '' + base_url + 'app/set_pic/' + data.id + '/save')
			$('#modal-set_pic #set_pic_title').text(data.pic == '' ? 'Pemilihan PIC' : 'Ubah PIC')
			$('#modal-set_pic #btn-set-pic').text(data.pic == '' ? 'Simpan' : 'Ubah PIC')
			$('#modal-set_pic .kode_uraian').text(data.kode_uraian)
			$('#modal-set_pic .nama_hibah_sponsorship').text(data.nama_hibah)
			$('#modal-set_pic .kode_pencairan').text(data.kode_pencairan)
			$('#modal-set_pic input[type="hidden"][name="id"]').val(data.id)
			$('#modal-set_pic').modal('show')
		})

		$('#tb-hibah').on('click', '.batalkan-data', function () {
			const data = {
				id: $(this).data('id'),
				kode_uraian: $(this).data('kode_uraian')
			}
			const base_url = "<?= base_url() ?>"
			
			$('#form-batalkan').attr('action', '' + base_url + 'app/sponsorship/v_detail/' + data.id + '/batalkan_kegiatan')
			$('#modal-batalkan span#detail').text(data.kode_uraian)
			$('#modal-batalkan input[name="id"]').val(data.id)
			$('#modal-batalkan').modal('show')
		})

		$('#tb-hibah').on('click', '.finalisasi', function () {
			const data = {
				id: $(this).data('id'),
				kode_uraian: $(this).data('kode_uraian')
			}
			const base_url = "<?= base_url() ?>"
			
			$('#form-finalisasi').attr('action', '' + base_url + 'app/sponsorship/v_detail/' + data.id + '/finalisasi')
			$('#modal-finalisasi span#detail').text(data.kode_uraian)
			$('#modal-finalisasi input[name="id"]').val(data.id)
			$('#modal-finalisasi').modal('show')
		})

		$('#tb-hibah').on('click', '.ubah-data', function () {
			const data = {
				id: $(this).data('id'),
				nama_hibah: $(this).data('nama_hibah'),
				deskripsi: $(this).data('deskripsi'),
				kpi: $(this).data('kpi'),
				cara_ukur: $(this).data('cara_ukur'),
				base_line: $(this).data('base_line'),
				target: $(this).data('target'),
				output: $(this).data('output'),
				periode: $(this).data('periode'),
				kode_pencairan: $(this).data('kode_pencairan'),
				total_anggaran: $(this).data('total_anggaran'),
				ttd_pic: $(this).data('ttd_pic'),
                unit: $(this).data('unit'),
                pic: $(this).data('pic'),
                kode_sub_aktivitas: $(this).data('kode_sub_aktivitas'),
                indikator_kerja_umum: $(this).data('indikator_kerja_umum')
			}
            const base_url = "<?= base_url() ?>"
            //$('#form-ubah').attr('action', '')
            console.log(data.id)
			//app/hibah/v_detail/' . $CI->uri->segment(4) . '/edit_hibah'
			$('#form-ubah').attr('action', '' + base_url + 'app/sponsorship/v_detail/' + data.id + '/edit_sponsorship')
			$('#modal-edit').modal('show')
			$('#modal-edit input[type="hidden"][name="id"]').val(data.id)
			$('#modal-edit input[name="nama_sponsorship"]').val(data.nama_hibah)
			$('#modal-edit input[name="kode_pencairan"]').val(data.kode_pencairan)
			$('#modal-edit #ttd_old').attr('src', 'data:image/png;base64, ' + data.ttd_pic)
			$('#modal-edit textarea[name="deskripsi_kegiatan"]').val(data.deskripsi)
			$('#modal-edit textarea[name="kpi"]').val(data.kpi)
			$('#modal-edit textarea[name="cara_ukur"]').val(data.cara_ukur)
			$('#modal-edit textarea[name="base_line"]').val(data.base_line)
			$('#modal-edit textarea[name="target"]').val(data.target)
			$('#modal-edit textarea[name="output"]').val(data.output)
            $('#modal-edit input[name="kode_sub_aktivitas"]').val(data.kode_sub_aktivitas)
            $('#modal-edit input[name="indikator_kerja_umum"]').val(data.indikator_kerja_umum)
            $('#modal-edit select[name="pic"] option[value="'+data.pic+'"]').attr('selected', true)
            let nama = $('#modal-edit select[name="pic"] :selected').data('nama_lengkap')
            $('#select2-pic-container').text(nama)
            $('#modal-edit select[name="unit"] option[value="'+data.unit+'"]').attr('selected', true)
            let nama_unit = $('#modal-edit select[name="unit"] :selected').data('nama_unit')
            $('#select2-unit-container').text(nama_unit)
			$('#modal-edit input[type="radio"][name="periode"][value="' + data.periode + '"]').attr(
				'checked', true)
			$('#modal-edit input[name="total_anggaran"]').val(formatRupiah(data.total_anggaran.toString(),
				'Rp. '))
            
		})  


    })
</script>
@endsection