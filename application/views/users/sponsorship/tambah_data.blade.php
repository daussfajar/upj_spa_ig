@extends('layouts.user')

@section('title', 'Sponsorship - Create')

@section('page-title')
    <a href="{{ base_url('app/sponsorship') }}"><i class="mdi mdi-arrow-left"></i></a> Create Sponsorship
@endsection

@section('css')
<link rel="stylesheet" href="{{ base_url('assets/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ base_url('assets/css/responsive.bootstrap4.min.css') }}">
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
<li class="breadcrumb-item"><a href="javascript: void(0);"><i class="mdi mdi-briefcase-outline"></i> Sponsorship</a></li>
<li class="breadcrumb-item active"><a href="javascript: void(0);"><i class="mdi mdi-plus"></i> Create Sponsorship</a></li>
@endsection

@section('content')
    <div class="col-md-12">
        <div class="card-box">
            <h4 class="header-title"><i class="mdi mdi-file-document-outline"></i> Buat Kegiatan Sponsorship</h4>
            <p class="sub-header">
                Silakan lengkapi form dibawah ini untuk membuat kegiatan Sponsorship.
            </p>

            {!! form_open('app/sponsorship/buat_kegiatan/submit', array('id' => 'wizard-validation-form')) !!}
                <div>
                    <h3>Step 1</h3>
                    <section>
                        <div class="form-group row">
                            <label class="col-lg-2 control-label " for="userName2">Kode Uraian </label>
                            <div class="col-lg-10">
                                <input class="form-control" id="kode_uraian" name="kode_uraian" type="text" value="{{ ($kode_uraian) }}" readonly required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 control-label " for="password2"> Nama Sponsorship *</label>
                            <div class="col-lg-10">
                                <textarea name="nama_sponsorship" id="nama_sponsorship" class="form-control" cols="3" rows="3" required></textarea>
                                <span class="help-block"><small>Masukan nama kegiatan sponsorship.</small></span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-2 control-label " for="confirm2">Deskripsi Kegiatan *</label>
                            <div class="col-lg-10">
                                <textarea name="deskripsi_kegiatan" id="deskripsi_kegiatan" class="form-control" cols="3" rows="3" required></textarea>
                                <span class="help-block"><small>Deskripsikan rincian kegiatan sponsorship.</small></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-12 control-label ">(*) Wajib diisi</label>
                        </div>
                    </section>
                    <h3>Step 2</h3>
                    <section>

                        <div class="form-group row">
                            <label class="col-lg-2 control-label" for=""> Kode Sub Aktivitas *</label>
                            <div class="col-lg-10">
                                <input type="text" name="kode_sub_aktivitas" id="kode_sub_aktivitas" class="form-control" required>
                                <span class="help-block"><small>Masukan Kode Sub Aktivitas.</small></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 control-label" for=""> Indikator Kerja Umum *</label>
                            <div class="col-lg-10">
                                <input type="text" name="indikator_kerja_umum" id="indikator_kerja_umum" class="form-control" required>
                                <span class="help-block"><small>Masukan Indikator Kerja Umum.</small></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 control-label" for=""> KPI *</label>
                            <div class="col-lg-10">
                                <textarea name="kpi" id="kpi" class="form-control" cols="3" rows="3" required></textarea>
                                <span class="help-block"><small>Masukan KPI.</small></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 control-label " for="sur"> Base Line *</label>
                            <div class="col-lg-10">
                                <textarea name="base_line" id="base_line" class="form-control" cols="3" rows="3" required></textarea>
                                <span class="help-block"><small>Tentukan base line kegiatan.</small></span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-2 control-label " for="email2">Target *</label>
                            <div class="col-lg-10">
                                <textarea name="target" id="target" class="form-control" cols="3" rows="3" required></textarea>
                                <span class="help-block"><small>Tentukan target kegiatan.</small></span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-2 control-label " for="address2">Cara Ukur *</label>
                            <div class="col-lg-10">
                                <textarea name="cara_ukur" id="cara_ukur" class="form-control" cols="3" rows="3" required></textarea>
                                <span class="help-block"><small>Tentukan cara ukur kegiatan.</small></span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-12 control-label ">(*) Wajib diisi</label>
                        </div>

                    </section>
                    <h3>Step 3</h3>
                    <section>
                        <div class="form-group row">
                            <label class="col-lg-2 control-label " for="address2">Output *</label>
                            <div class="col-lg-10">
                                <textarea name="output" id="output" class="form-control" cols="3" rows="3" required></textarea>
                                <span class="help-block"><small>Tentukan output kegiatan.</small></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 control-label " for="address2">Kode Pencairan *</label>
                            <div class="col-lg-10">
                                <input type="text" name="kode_pencairan" id="kode_pencairan" class="form-control" required>
                                <span class="help-block"><small>Masukan kode pencairan anggaran.</small></span>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label class="col-lg-2 control-label " for="address2">Total Anggaran *</label>
                            <div class="col-lg-10">
                                <input type="text" name="total_anggaran" id="total_anggaran" class="form-control" required>                                
                                <span class="help-block"><small>Tentukan total anggaran kegiatan.</small></span>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label class="col-lg-2 control-label" for="address2">PIC *</label>
                            <div class="col-lg-10">
                                <select name="pic" id="pic" class="form-control select2" style="width:100%;" required>
                                    <option value="">Pilih PIC Kegiatan</option>                                    
                                    @foreach ($unit->result() as $item)
                                        <optgroup label="{{ $item->nama_unit }}">
                                            @foreach ($karyawan->result() as $ky)
                                                @if ($ky->kode_unit == $item->kode_unit)
                                                    <option value="{{ $ky->nik }}">{{ $ky->nama_lengkap }}</option>
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
                                    <option value="">Pilih Unit Kegiatan</option>
                                    @foreach ($unit->result() as $item)
                                        <option value="{{ $item->kode_unit }}">{{ $item->nama_unit }}</option>
                                    @endforeach
                                </select>
                                <span class="help-block"><small>Tentukan unit.</small></span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-2 control-label " for="address2">Periode *</label>
                            <div class="col-lg-10">
                                <div class="radio radio-info form-check-inline">
                                    <input type="radio" id="periode1" value="1" name="periode" required>
                                    <label for="periode1"> Ganjil </label>
                                </div>
                                <div class="radio form-check-inline">
                                    <input type="radio" id="periode2" value="2" name="periode" required>
                                    <label for="periode2"> Genap </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-12 control-label ">(*) Wajib diisi</label>
                        </div>
                    </section>
                    <h3>Step Final</h3>
                    <section>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="">Tanda Tangan</label><br />
                                <div id="ttd"></div>
                                <br/>
                                <button id="clear_ttd" class="btn btn-danger btn-sm"><i class="mdi mdi-trash-can-outline"></i> Hapus Tanda Tangan</button>
                                <textarea id="signature64" name="tanda_tangan" style="display: none" required></textarea>
                            </div>
                            <div class="col-lg-12 mt-4">
                                <input id="acceptTerms" name="accept_terms" type="checkbox" class="required">
                                <label for="acceptTerms">Saya setuju dengan Syarat dan Ketentuan.</label>
                            </div>
                        </div>

                    </section>
                </div>
            {!! form_close() !!}
        </div>                
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

        var sig = $('#ttd').signature({syncField: '#signature64', syncFormat: 'PNG'});
        $('#clear_ttd').click(function(e) {
            e.preventDefault();
            sig.signature('clear');
            $("#signature64").val('');
        });

        var rupiah = document.getElementById('total_anggaran');
        var final_anggaran = document.getElementById('final_anggaran')

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