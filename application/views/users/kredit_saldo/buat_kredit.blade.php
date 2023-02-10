@extends('layouts.user')

@section('title', 'Buat Kredit Saldo')

@section('page-title')
   <a href="{{ base_url('app/kredit_saldo') }}" class=""><i class="mdi mdi-arrow-left"></i></a> Buat Kredit Saldo
@endsection

@section('css')
<link rel="stylesheet" href="{{ base_url('assets/css/jquery-ui.custom-for-signature.css') }}">
<link rel="stylesheet" href="{{ base_url('assets/css/jquery.signature.css') }}">
<link rel="stylesheet" href="{{ base_url('assets/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ base_url('assets/css/bootstrap-select.min.css') }}">
<style>
    .kbw-signature { width: 300px; height: 300px;}
    #ttd canvas{
        width: 100% !important;
        height: auto;
    }
</style>
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="javascript: void(0);">Kredit Saldo</a></li>
<li class="breadcrumb-item active"><a href="javascript: void(0);">Buat Kredit Saldo</a></li>
@endsection

@section('content')
<div class="col-md-12">    
    {!! form_open('app/kredit_saldo/buat_kredit/save', array('enctype' => 'multipart/form-data', 'class' => 'myForm')) !!}
	<div class="card card-border card-primary">
        <div class="card-header border-primary bg-transparent">
            <h3 class="card-title text-primary mb-0">Form Kredit Saldo</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">                    
                    <div class="form-group row">
                        <label for="" class="col-4">Saldo Asal</label>
                        <select name="saldo_asal" id="saldo_asal" class="form-control select2 col-7" required>
                            <option value="">Pilih Kegiatan</option>
                            @foreach ($kegiatan as $item)
                                <option value="{{ $item->kode_uraian }}" data-kode_pencairan="{{ $item->kode_pencairan }}">
                                    {{ $item->kode_uraian }} - {{ $item->nama_lengkap . ' ('.$item->nama_unit.')' }} - {{ $item->nama_hibah_sponsorship }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-4">Saldo Tujuan</label>
                        <select name="saldo_tujuan" id="saldo_tujuan" class="form-control select2 col-7" required>
                            <option value="">Pilih Kegiatan</option>
                            @foreach ($kegiatan as $item)
                                <option value="{{ $item->kode_uraian }}" data-kode_pencairan="{{ $item->kode_pencairan }}">
                                    {{ $item->kode_uraian }} - {{ $item->nama_lengkap . ' ('.$item->nama_unit.')' }} - {{ $item->nama_hibah_sponsorship }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-4">Kode Pencairan</label>
                        <input type="text" name="kode_pencairan" id="kode_pencairan" class="form-control col-7" readonly required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="" class="col-4">Nominal</label>
                        <input type="text" name="nominal" id="nominal" class="form-control col-7" required>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-4">File Pendukung</label>
                        <input type="file" name="file_pendukung" id="file_pendukung" required>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-4">Keterangan</label>
                        <textarea name="keterangan" id="keterangan" cols="3" rows="3" class="form-control col-7" required></textarea>
                    </div>
                </div>            
            </div>
        </div>
        <div class="card-footer">
            <div class="float-right">
                <button type="submit" class="btn btn-primary btn-sm"> Submit <i class="mdi mdi-send"></i></button>
            </div>
        </div>
    </div>
    {!! form_close() !!}
</div>
@endsection

@section('js')
<script src="{{ base_url('assets/js/select2.min.js') }}"></script>
<script src="{{ base_url('assets/js/bootstrap-select.min.js') }}"></script>

<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="{{ base_url('assets/js/jquery.signature.min.js') }}"></script>
<script src="{{ base_url('assets/js/jquery.ui.touch-punch.min.js') }}"></script>

<script src="{{ base_url('assets/js/jquery.steps.min.js') }}"></script>
<script src="{{ base_url('assets/js/jquery.validate.min.js') }}"></script>
<script src="{{ base_url('assets/js/form-wizard.init.js') }}"></script>
<script>
    $(document).ready(function(){

        $(".select2").select2()   
        
        var rupiah = document.getElementById('nominal')

		rupiah.addEventListener('keyup', function(e){			            
			rupiah.value = formatRupiah(this.value, 'Rp. ')
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
 
			rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
			return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
		}

        $('select[name="kegiatan"]').change(function(e){
            const kode_pencairan = $(this).find(':selected').data('kode_pencairan')
            $('input[name="kode_pencairan"]').val(kode_pencairan)
        })
    })
</script>
@endsection