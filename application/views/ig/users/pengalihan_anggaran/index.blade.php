@extends('ig.layouts.user')

@section('title', 'Pengalihan Anggaran')

@section('page-title')
    Pengalihan Anggaran
@endsection

@section('css')
<link rel="stylesheet" href="{{ base_url('assets/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ base_url('assets/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ base_url('assets/css/bootstrap-select.min.css') }}">
<style>
    .m-signature-pad-body{
        border: 1px dashed #ccc;
        border-radius: 5px;
        color: #bbbabb;
        height: 253px;
        width: 100%;
        text-align: center;
        float: right;
        vertical-align: middle;
        top: 73px;
        position: inline-block;
        left: 33px;
    }
    .m-signature-pad-footer{
        bottom: 250px;
        left: 218px;
        position: inline-block;
    }
</style>
@endsection

@section('breadcrumb')
<li class="breadcrumb-item active"><a href="javascript: void(0);">Pengalihan Anggaran</a></li>
@endsection

@section('content')
<div class="col-md-12">    
    <div class="float-right">
        <!--<a href="javascript:void(0)" data-toggle="modal" data-target="#modal-upload-saldo" class="btn btn-sm btn-info mr-1"><i class="mdi mdi-upload"></i> Upload</a>-->
        <a href="javascript:void(0)" data-toggle="modal" data-target="#modal-input-pengalihan" class="btn btn-success btn-sm"><i class="mdi mdi-plus"></i> Input Pengalihan Anggaran</a>
    </div>
    <br><br>
    <div class="card card-border card-dark">
        <div class="card-header border-dark bg-transparent">
            <h3 class="card-title text-dark mb-0">Data Pengalihan Anggaran</h3>
        </div>
        <div class="card-body">
            <div class="row mb-3">                    
                <div class="col-md-8 col-sm-8 col-xs-12">
                    <div class="float-right">
                        <a href="javascript:void(0)" onclick="return alert('Coming soon')" class="btn btn-secondary btn-sm"><i class="mdi mdi-filter"></i></a>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <form action="{{ base_url('app/sim-ig/pengalihan-anggaran') }}" method="GET" accept-charset="utf-8" autocomplete="off" class="myForm">
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
                @if (empty($data_pengalihan['data']))
                <div class="col-md-12">
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
                </div>
                @else
                <div class="col-md-12">
                    <div class="alert alert-info">
                        <p class="mb-0"><i class="mdi mdi-magnify"></i> Hasil pencarian dari: "<b>{{ $CI->input->get('q', true) }}</b>"</p>                    
                    </div>
                </div>
                @endif
            @endif

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="bg-dark text-white">
                        <tr>
                            <th class="text-center" style="vertical-align: middle;" rowspan="2">No</th>
                            <th style="vertical-align: middle;" class="text-center" rowspan="2">Pengaju/PIC</th>
                            <th style="vertical-align: middle;" rowspan="2">Keterangan</th>
                            <th style="vertical-align: middle;" class="text-center" colspan="2">Pengalihan Asal</th>
                            <th style="vertical-align: middle;" class="text-center" colspan="2">Pengalihan Tujuan</th>
                            <th style="vertical-align: middle;" rowspan="2" class="text-center">Nominal Pengalihan</th>
                            <th style="vertical-align: middle;" rowspan="2" class="text-center">Status</th>
                        </tr>
                        <tr>
                            <th style="vertical-align: middle;" class="text-center">Kode Uraian Asal</th>
                            <th style="vertical-align: middle;" class="text-center">Saldo Sebelum Pengalihan</th>
                            <th style="vertical-align: middle;" class="text-center">Kode Uraian Tujuan</th>
                            <th style="vertical-align: middle;" class="text-center">Saldo Sebelum Pengalihan</th>
                        </tr>                        
                    </thead>
                    <tbody>                        
                        @if (empty($data_pengalihan['data']))
                            <tr>
                                <th class="text-center" colspan="9">
                                    Tidak ada data
                                </th>
                            </tr>
                        @else
                        @foreach ($data_pengalihan['data'] as $rows)
                            <tr>
                                <th class="text-center" style="vertical-align:middle;font-size:14px;">
                                    {{ $loop->iteration }}
                                </th>
                                <th style="vertical-align: middle;font-size:14px;">{{ $rows['nama_pengaju'] }}</th>
                                <td style="vertical-align: middle;font-size:14px;">{{ $rows['keterangan'] }}</td>
                                <td style="vertical-align: middle;font-size:14px;" class="text-center">
                                    <b>{{ $rows['kode_uraian_out'] }}</b>
                                    <hr class="mt-1 mb-1">
                                    <b>Periode : </b> {{ $rows['periode_out'] }}                                    
                                </td>
                                <td style="vertical-align: middle;" class="text-center">
                                    <span class="badge bg-teal p-2">
                                        {{ rupiah($rows['saldo']) }}
                                    </span>
                                </td>
                                <td style="vertical-align: middle;font-size:14px;" class="text-center">
                                    <b>{{ $rows['kode_uraian'] }}</b>
                                    <hr class="mt-1 mb-1">
                                    <b>Periode : </b> {{ $rows['periode'] }}
                                </td>
                                <td style="vertical-align: middle;" class="text-center">
                                    <span class="badge bg-teal p-2">
                                        {{ rupiah($rows['saldo_out']) }}
                                    </span>
                                </td>
                                <td style="vertical-align: middle;" class="text-center">
                                    <span class="badge bg-success p-2">
                                        {{ rupiah($rows['nominal']) }}
                                    </span>
                                </td>
                                <td style="vertical-align: middle;" class="text-center">
                                    @switch($rows['disetujui'])
                                        @case('Y')
                                            <span class="badge bg-primary p-2">
                                                <i class="mdi mdi-check-bold"></i> Sukses
                                            </span>
                                            @break
                                        @case('N')
                                            <span class="badge bg-danger p-2">
                                                Belum Difinalisasi
                                            </span>
                                            @break
                                        @default
                                        <span class="badge bg-danger p-2">
                                            Unknown
                                        </span>
                                    @endswitch
                                </td>
                            </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            <span class="badge badge-info p-2">Total Data: {{ $data_pengalihan['total_rows'] }}</span>
		    {!! $data_pengalihan['pagination'] !!}
        </div>
    </div>
</div>

{!! form_open(base_url('app/sim-ig/pengalihan-anggaran/buat-pengalihan?refId=' . uniqid()), array('class' => 'myForm', 'id' => 'form-pengalihan', 'enctype' => 'multipart/form-data')) !!}
<div id="modal-input-pengalihan" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Form Pengalihan Anggaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">* Kode Pencairan Asal</label>
                            <select name="kode_pencairan_asal" id="kode_pencairan_asal" class="select2 form-control" style="width:100%;" required>
                                <option value="">-- Pilih --</option>
                                <?php foreach ($kegiatan as $item){ 
                                    $sisa_agr = (($item->total_agr + $item->agr_masuk) - ($item->agr_keluar + $item->agr_digunakan));
                                    ?>
                                <option value="{{ encrypt($item->kode_uraian) . '_' . encrypt($item->kode_pencairan) }}" data-kode_pencairan="{{ $item->kode_pencairan }}" data-periode="{{ $item->periode }}"{!! $sisa_agr > 0 ? ' data-sisa_agr="'.rupiah_1($sisa_agr).'" data-r_sisa_agr="'.$sisa_agr.'"' : '' !!} data-saldo="{{ $sisa_agr }}"{{ ($sisa_agr == 0 || $sisa_agr < 0) ? ' disabled' : '' }}>
                                    {{ $item->kode_uraian . ' ('.$item->periode.')' . ($item->kode_pencairan != "" ? "(" . $item->kode_pencairan . ")" : "") }} - {{ $item->nama_lengkap . ' ('.$item->nama_unit.')' }} - {{ $item->nama_hibah_sponsorship }}
                                </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <input type="hidden" name="periode" value="">
                    <input type="hidden" name="periode_out" value="">
                    <input type="hidden" name="saldo" value="">
                    <input type="hidden" name="saldo_out" value="">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">* Kode Pencairan Tujuan</label>
                            <select name="kode_pencairan_tujuan" id="kode_pencairan_tujuan" class="select2 form-control" style="width:100%;" required>
                                <option value="">-- Pilih --</option>
                                <?php foreach ($kegiatan as $item){ 
                                    $sisa_agr = (($item->total_agr + $item->agr_masuk) - ($item->agr_keluar + $item->agr_digunakan));
                                    ?>
                                <option value="{{ encrypt($item->kode_uraian) . '_' . encrypt($item->kode_pencairan) }}" data-kode_pencairan="{{ $item->kode_pencairan }}" data-periode="{{ $item->periode }}" data-saldo="{{ $sisa_agr }}">
                                    {{ $item->kode_uraian . ' ('.$item->periode.')' . ($item->kode_pencairan != "" ? "(" . $item->kode_pencairan . ")" : "") }} - {{ $item->nama_lengkap . ' ('.$item->nama_unit.')' }} - {{ $item->nama_hibah_sponsorship }}
                                </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">* PIC/Pengaju</label>
                            <select name="pic" id="pic" class="select2 form-control" style="width:100%;" required>
                                <option value="">-- Pilih --</option>
                                @foreach ($unit as $row)
                                <optgroup label="{{ $row['nama_unit'] }}">
                                    @foreach ($karyawan as $kar)
                                    @if ($row['kode_unit'] == $kar['kode_unit'])
                                    <option value="{{ $kar['nik'] }}">{{ $kar['nama_lengkap'] }} ({{ $kar['nik'] }})</option>
                                    @endif
                                    @endforeach
                                </optgroup>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">* Alasan</label>
                            <textarea name="alasan" id="alasan" cols="3" rows="3" class="form-control" required></textarea>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">* Anggaran</label>
                            <input type="text" name="anggaran" id="anggaran" class="form-control" readonly required>
                            <span class="help-block text-primary" style="font-weight:bold;" id="help-agr"></span>
                        </div>                        
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <label>File Pendukung (opsional)</label>
                            <input type="file" class="filestyle" name="file_pendukung" data-badge="true">
                            <span class="help-block"><small>Ketentuan: ekstensi diperbolehkan hanya pdf,docx,xlxs,pptx,png,jpeg,jpg, selain itu maksimal ukuran file adalah 2 mb.</small></span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="" class="control-label">Silakan tanda tangan: *</label>
                        <div class="signature-pad" id="signature-pad">
                            <div class="m-signature-pad">
                            <div class="m-signature-pad-body">
                                <canvas width="560" height="253"></canvas>
                            </div>
                            </div>
                            <div class="m-signature-pad-footer">
                                <button type="button" data-action="clear"  class="btn btn-danger btn-sm mt-2"><i class="mdi mdi-trash-can"></i> Bersihkan</button>                                
                            </div>
                        </div>
                        <input type="hidden" name="signature" required>
                    </div>
                    <div class="col-md-12 mt-2">
                        <div class="alert alert-info">
                            <strong>Note:</strong> (*) kolom wajib diisi, silakan lengkapi form dengan baik.
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm waves-effect" data-dismiss="modal"><i class="mdi mdi-close"></i> Tutup</button>
                <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light"><i class="mdi mdi-check"></i> Simpan</button>
            </div>
        </div>        
    </div>    
</div>
{!! form_close() !!}
@endsection

@section('js')
<script src="{{ base_url('assets/js/select2.min.js') }}"></script>
<script src="{{ base_url('assets/js/bootstrap-select.min.js') }}"></script>
<script src="{{ base_url('assets/js/signature-pad.js') }}"></script>
<script src="{{ base_url('assets/js/bootstrap-filestyle.min.js') }}"></script>
<script>
    $(document).ready(function(){
        var rupiah = document.getElementById('anggaran')		

        $('#anggaran').on('input propertychange paste', function (e) {
            let val = $(this).val()
            let reg = /^0/gi
            if (val.match(reg)) {
                $(this).val(val.replace(reg, ''))
            }                                     
        })

        $('.select2').select2()
        
        $('select[name="kode_pencairan_asal"]').change(function(){
            const selected = $(this).find('option:selected').data('periode')
            const saldo = $(this).find('option:selected').data('saldo')
            const sisa_agr = $(this).find('option:selected').data('sisa_agr')            
            const r_sisa_agr = $(this).find('option:selected').data('r_sisa_agr')
            $('input[name="periode"]').val(selected)
            $('input[name="saldo"]').val(saldo)
            $('#anggaran').removeAttr('readonly')
            $('#anggaran').val('')
            $('#help-agr').html(`
            <small>Maksimal: ${sisa_agr}</small>
            `)

            rupiah.addEventListener('keyup', function(e){                
                rupiah.value = formatRupiah(this.value, 'Rp. ')
                let real_value = rupiah.value.substr(4).split('.').join('')
                let m_agr = sisa_agr.split(',')                
                if(real_value > r_sisa_agr){
                    //toastr["error"](`Anggaran tidak boleh lebih dari ${m_agr[0]}`, "")
                    $('#anggaran').val(m_agr[0])
                    return false
                }
            })
        })

        $('select[name="kode_pencairan_tujuan"]').change(function(){
            const selected = $(this).find('option:selected').data('periode')
            const saldo = $(this).find('option:selected').data('saldo')
            $('input[name="periode_out"]').val(selected)
            $('input[name="saldo_out"]').val(saldo)
        })

        function formatRupiah(angka, prefix){
			var number_string = angka.replace(/[^,\d]/g, '').toString(),
			split   		= number_string.split(','),
			sisa     		= split[0].length % 3,
			rupiah     		= split[0].substr(0, sisa),
			ribuan     		= split[0].substr(sisa).match(/\d{3}/gi)
 
			if(ribuan){
				separator = sisa ? '.' : ''
				rupiah += separator + ribuan.join('.')
			}
 
			rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah
			return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '')
		}

        var wrapper = document.getElementById("signature-pad"),
        clearButton = wrapper.querySelector("[data-action=clear]"),
        saveButton = wrapper.querySelector("[data-action=save]"),
        canvas = wrapper.querySelector("canvas"),
        signaturePad

        function resizeCanvas() {
            var ratio =  window.devicePixelRatio || 1
            canvas.width = canvas.offsetWidth * ratio
            canvas.height = canvas.offsetHeight * ratio
            canvas.getContext("2d").scale(ratio, ratio)
        }

        signaturePad = new SignaturePad(canvas)
        clearButton.addEventListener("click", function (event) {
            signaturePad.clear()
        })

        $('#form-pengalihan').submit(function(){                
            $('#form-pengalihan input[name="signature"]').val(signaturePad.toDataURL())
        })

    })
</script>
@endsection