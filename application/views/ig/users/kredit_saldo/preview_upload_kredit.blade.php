@extends('ig.layouts.user')

@section('title', 'Kredit Saldo - Preview Upload')

@section('page-title')
   <a href="{{ base_url('app/kredit_saldo') }}"><i class="mdi mdi-arrow-left"></i></a> Upload Excel
@endsection

@section('css')
<link rel="stylesheet" href="{{ base_url('assets/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ base_url('assets/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ base_url('assets/css/jquery-ui.custom-for-signature.css') }}">
<link rel="stylesheet" href="{{ base_url('assets/css/jquery.signature.css') }}">
<link rel="stylesheet" href="{{ base_url('assets/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ base_url('assets/css/bootstrap-select.min.css') }}">
<link rel="stylesheet" href="{{ base_url('assets/css/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ base_url('assets/css/bootstrap-datepicker.min.css') }}">
<style>
    .kbw-signature { width: 300px; height: 300px;}
    #ttd canvas{
        width: 100% !important;
        height: auto;
    }
</style>
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="javascript: void(0);"><i class="mdi mdi-briefcase-outline"></i> Hibah</a></li>
<li class="breadcrumb-item active"><a href="javascript: void(0);"><i class="mdi mdi-file-upload-outline"></i> Preview Upload</a></li>
@endsection

@section('content')
    <div class="col-md-12">
        <div class="card-box">            
            <h4 class="header-title"><i class="mdi mdi-microsoft-excel"></i> Preview Data</h4>            
            <div class="alert alert-danger" id='kosong'>
            Terdapat <b><span id='jumlah_kosong'></span></b> baris data yang belum lengkap! Mohon lengkapi data tersebut lalu upload kembali.
            </div>

            {!! form_open('app/kredit_saldo/preview_upload/upload', array('autocomplete' => 'off', 'accept-charset' => 'utf-8', 'class' => 'myForm')) !!}
            <div class="table-responsive mt-3">
                <table class="table table-bordered">
                    <thead class="bg-purple text-white">
                        <tr>
                            <th width=50 style="vertical-align: middle" class="text-center">No</th>
                            <th style="vertical-align: middle">Kode Uraian</th>
                            <th style="vertical-align: middle">Kode Pencairan</th>
                            <th style="vertical-align: middle">Keterangan</th>
                            <th style="vertical-align: middle" class="text-center">Jenis Kredit</th>
                            <th style="vertical-align: middle" class="text-center">Nominal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $numrow = 1;
                            $kosong = 0;
                            $num = 1;
                        @endphp
                        @foreach ($sheet as $row)
                            @php
                                $kode_uraian = $row['A'];
                                $kode_pencairan = $row['B'];
                                $keterangan = $row['C'];
                                $jenis_kredit = $row['D'];
                                $nominal = $row['E'];    
                                $numrow++;                            
                            @endphp

                            @if ($numrow > 1)
                                <input type="hidden" name="kode_uraian[]" value="{{ $kode_uraian }}">
                                <input type="hidden" name="kode_pencairan[]" value="{{ $kode_pencairan }}">
                                <input type="hidden" name="keterangan[]" value="{{ $keterangan }}">
                                <input type="hidden" name="jenis_kredit[]" value="{{ $jenis_kredit }}">
                                <input type="hidden" name="nominal[]" value="{{ $nominal }}">
                                @php
                                    $td_kode_uraian     = empty($kode_uraian) ? " style='background:#E07171;'" : "style='vertical-align:middle;'";
                                    $td_kode_pencairan  = empty($kode_pencairan) ? " style='background:#E07171;'" : "style='vertical-align:middle;'";
                                    $td_keterangan      = empty($keterangan) ? " style='background:#E07171;'" : "style='vertical-align:middle;'";
                                    $td_jenis_kredit    = empty($jenis_kredit) ? " style='background:#E07171;'" : "style='vertical-align:middle;'";
                                    $td_nominal         = empty($nominal) ? " style='background:#E07171;'" : "style='vertical-align:middle;'";

                                    if($kode_uraian == "" || $kode_pencairan == "" || $keterangan == "" || 
                                    $jenis_kredit == "" || $nominal == ""){
                                        $kosong++;
                                    }
                                @endphp

                                <tr>
                                    <th class="text-center" style="vertical-align: middle">{{ $num++ }}</th>
                                    <td {!! $td_kode_uraian !!}>{{ $kode_uraian }}</td>
                                    <td {!! $td_kode_pencairan !!}>{{ $kode_pencairan }}</td>
                                    <td {!! $td_keterangan !!}>{{ $keterangan }}</td>
                                    <td {!! $td_jenis_kredit !!} class="text-center">
                                        @if ($jenis_kredit == "in")
                                            <span class="badge bg-info">Saldo Masuk</span>
                                        @else
                                            <span class="badge bg-danger">Saldo Keluar</span>
                                        @endif
                                    </td>
                                    <td {!! $td_nominal !!} class="text-center">{{ rupiah($nominal) }}</td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            @if ($kosong == 0)
                <div class="card-box">    
                    <label for="">Tanda Tangan</label><br />
                    <div id="ttd"></div>
                    <br/>
                    <button id="clear_ttd" class="btn btn-danger btn-sm"><i class="mdi mdi-trash-can-outline"></i> Hapus Tanda Tangan</button>
                    <textarea id="signature64" name="tanda_tangan" style="display: none" required></textarea>
                    <div class="float-right">
                        <a href="{{ base_url('app/kredit_saldo') }}" class="btn btn-danger btn-sm">Batal</a>
                        <button type="submit" class="btn btn-primary btn-sm"><i class="mdi mdi-upload"></i> Upload Data</button>                                
                    </div>                            
                    <br>
                </div>
            @endif

            {!! form_close() !!}
        </div>
    </div>
@endsection

@section('js')
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <script src="{{ base_url('assets/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ base_url('assets/js/daterangepicker.js') }}"></script>
    <script src="{{ base_url('assets/js/select2.min.js') }}"></script>
    <script src="{{ base_url('assets/js/bootstrap-select.min.js') }}"></script>

    <script src="{{ base_url('assets/js/jquery.signature.min.js') }}"></script>
    <script src="{{ base_url('assets/js/jquery.ui.touch-punch.min.js') }}"></script>

    <script src="{{ base_url('assets/js/jquery.steps.min.js') }}"></script>
    <script src="{{ base_url('assets/js/jquery.validate.min.js') }}"></script>
    <script src="{{ base_url('assets/js/form-wizard.init.js') }}"></script>
    <script>
        $(document).ready(function(){
            var sig = $('#ttd').signature({syncField: '#signature64', syncFormat: 'PNG'});
            $('#clear_ttd').click(function(e) {
                e.preventDefault();
                sig.signature('clear');
                $("#signature64").val('');
            });

            $(".select2").select2()
            $('#kosong').hide()

            @if ($kosong > 0)
                $(document).ready(function(){
                    // Ubah isi dari tag span dengan id jumlah_kosong dengan isi dari variabel kosong
                    $("#jumlah_kosong").html('<?php echo $kosong; ?>');
                    $("#kosong").show(); // Munculkan alert validasi kosong
                });
            @endif
        })
    </script>
@endsection