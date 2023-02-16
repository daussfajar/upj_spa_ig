@php
$unit_selected = $CI->input->post('unit_prodi', true);
$karyawan = $CI->db->query("SELECT a.nik,a.nama_lengkap,a.kode_unit FROM tbl_karyawan AS a 
WHERE a.status = 'Aktif' ORDER BY a.nama_lengkap ASC")->result();
$unit = $CI->db->get_where('tbl_unit', ['kode_unit' => $unit_selected])->row();
$unit_all = $CI->db->get('tbl_unit')->result();
@endphp

@extends('ig.layouts.user')

@section('title', 'Sponsorship - Preview Upload')

@section('page-title')
   <a href="{{ base_url('app/sim-ig/sponsorship') }}"><i class="mdi mdi-arrow-left"></i></a> Upload Excel
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
            <div class="form-group mt-3">
                <label for="">Unit :</label>
                <span class="badge bg-info">{{ $unit->nama_unit }}</span>
            </div>
            {!! form_open('app/sim-ig/sponsorship/preview_upload/upload', array('autocomplete' => 'off', 'accept-charset' => 'utf-8', 'class' => 'myForm')) !!}
            <div class="table-responsive mt-3">
                <table class="table table-bordered">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th width=50 style="vertical-align: middle">No</th>
                            <th style="vertical-align: middle">Nama Hibah/Sponsorship</th>
                            <th style="vertical-align: middle">Uraian Kegiatan</th>
                            <th class="texxt-center" style="vertical-align: middle">Jenis Income</th>
                            <th style="vertical-align: middle">KPI</th>
                            <th style="vertical-align: middle">Cara Ukur</th>
                            <th style="vertical-align: middle">Base Line</th>
                            <th style="vertical-align: middle">Target</th>
                            <th style="vertical-align: middle">Output</th>                            
                            <th class="text-center" style="vertical-align: middle">Periode</th>
                            <th class="text-center" style="vertical-align: middle">Kode Pencairan</th>
                            <th class="text-center" style="vertical-align: middle">Tahun</th>
                            <th class="text-center" style="vertical-align: middle">Total Anggaran</th>
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
                                $nama_hibah_sponsorship = $row['A'];
                                $uraian = $row['B'];
                                $jenis_ig = $row['C'];
                                $kpi = $row['D'];
                                $cara_ukur = $row['E'];
                                $base_line = $row['F'];
                                $target = $row['G'];
                                $output = $row['H'];
                                //$unit_prodi = $row['I'];
                                $periode = $row['I'];
                                $kode_pencairan = $row['J'];
                                $tahun = $row['K'];
                                $total_anggaran = $row['L'];
                                $numrow++;
                            @endphp

                            @if ($numrow > 1)
                                <input type="hidden" name="nama_hibah[]" value="{{ $nama_hibah_sponsorship }}">
                                <input type="hidden" name="uraian[]" value="{{ $uraian }}">
                                <input type="hidden" name="jenis_ig[]" value="{{ $jenis_ig }}">
                                <input type="hidden" name="kpi[]" value="{{ $kpi }}">
                                <input type="hidden" name="unit[]" value="{{ $unit_selected }}">
                                <input type="hidden" name="cara_ukur[]" value="{{ $cara_ukur }}">
                                <input type="hidden" name="base_line[]" value="{{ $base_line }}">
                                <input type="hidden" name="target[]" value="{{ $target }}">
                                <input type="hidden" name="output[]" value="{{ $output }}">
                                <input type="hidden" name="periode[]" value="{{ $periode }}">
                                <input type="hidden" name="kode_pencairan[]" value="{{ $kode_pencairan }}">
                                <input type="hidden" name="tahun[]" value="{{ $tahun }}">
                                <input type="hidden" name="total_anggaran[]" value="{{ $total_anggaran }}">
                                @php
                                    $td_nama_hibah_sponsorship = empty($nama_hibah_sponsorship) ? " style='background:#E07171;'" : "style='vertical-align:middle;'";
                                    $td_uraian = empty($uraian) ? " style='background:#E07171;'" : "style='vertical-align:middle;'";
                                    $td_jenis_ig = empty($jenis_ig) ? " style='background:#E07171;'" : "style='vertical-align:middle;'";
                                    $td_kpi = empty($kpi) ? " style='background:#E07171;'" : "style='vertical-align:middle;'";
                                    $td_cara_ukur = empty($cara_ukur) ? " style='background:#E07171;'" : "style='vertical-align:middle;'";
                                    $td_base_line = empty($base_line) ? " style='background:#E07171;'" : "style='vertical-align:middle;'";
                                    $td_target = empty($target) ? " style='background:#E07171;'" : "style='vertical-align:middle;'";
                                    $td_output = empty($output) ? " style='background:#E07171;'" : "style='vertical-align:middle;'";
                                    $td_periode = empty($periode) ? " style='background:#E07171;'" : "style='vertical-align:middle;'";
                                    $td_kode_pencairan = empty($kode_pencairan) ? " style='background:#E07171;'" : "style='vertical-align:middle;'";
                                    $td_tahun = empty($tahun) ? " style='background:#E07171;'" : "style='vertical-align:middle;'";
                                    $td_total_anggaran = empty($total_anggaran) ? " style='background:#E07171;'" : "style='vertical-align:middle;'";                                    

                                    if($nama_hibah_sponsorship == "" || $uraian == "" || $jenis_ig == "" || $kpi == "" || 
                                    $cara_ukur == "" || $base_line == "" || $target == "" || $output == "" || $periode == "" || 
                                    $kode_pencairan == "" || $tahun == "" || $total_anggaran == ""){
                                        // increment nilai kosong
                                        $kosong++;
                                    }
                                @endphp

                                <tr>
                                    <th class="text-center" style="vertical-align: middle">{{ $num++ }}</th>
                                    <td {!! $td_nama_hibah_sponsorship !!}>{{ $nama_hibah_sponsorship }}</td>
                                    <td {!! $td_uraian !!}>{{ $uraian }}</td>
                                    <td class="text-center" {!! $td_jenis_ig !!}>
                                        @switch($jenis_ig)
                                            @case('hibah')
                                                <span class="badge bg-info">Hibah</span>
                                                @break
                                            @case('sponsorship')
                                                <span class="badge bg-warning">Sponsorship</span>
                                                @break
                                            @default                                                
                                        @endswitch
                                    </td>
                                    <td {!! $td_kpi !!}>
                                        {{ $kpi }}
                                    </td>
                                    <td {!! $td_cara_ukur !!}>
                                        {{ $cara_ukur }}
                                    </td>
                                    <td {!! $td_base_line !!}>
                                        {{ $base_line }}
                                    </td>
                                    <td {!! $td_target !!}>
                                        {{ $target }}
                                    </td>
                                    <td {!! $td_output !!}>
                                        {{ $output }}
                                    </td>                                    
                                    <td class="text-center" {!! $td_periode !!}>
                                        @switch($periode)
                                            @case(1)
                                                <span class="badge bg-success">Ganjil</span>
                                                @break
                                            @case(2)
                                                <span class="badge bg-success">Genap</span>
                                                @break
                                            @default                                                
                                        @endswitch
                                    </td>
                                    <td class="text-center" {!! $td_kode_pencairan !!}>
                                        {{ $kode_pencairan }}
                                    </td>
                                    <td class="text-center" {!! $td_tahun !!}>
                                        {{ $tahun }}
                                    </td>
                                    <td class="text-center" {!! $td_total_anggaran !!}>
                                        {{ rupiah($total_anggaran) }}
                                    </td>
                                </tr>
                                <tr>
                                    <th colspan="2" class="text-right" style="vertical-align: middle;">PIC :</th>
                                    <td colspan="4" style="vertical-align: middle;">
                                        <select class="form-control select2" name="pic[]" required>
                                            <option value="">Pilih PIC</option> 
                                            @foreach ($unit_all as $item)
                                                <optgroup label="{{ $item->nama_unit }}">
                                                    @foreach ($karyawan as $kry)
                                                        @if ($item->kode_unit == $kry->kode_unit)                                                            
                                                            <option value="{{ $kry->nik }}">{{ $kry->nama_lengkap }}</option>
                                                        @endif
                                                    @endforeach
                                                </optgroup>
                                            @endforeach                                                                                     
                                        </select>
                                    </td>                                    
                                    <td colspan="7" style="vertical-align: middle;">
                                        
                                    </td>
                                </tr>
                            @endif

                        @endforeach
                    </tbody>
                </table>                    
            </div>            
        </div>

        @if ($kosong == 0)
            <div class="card-box">    
                <label for="">Tanda Tangan</label><br />
                <div id="ttd"></div>
                <br/>
                <button id="clear_ttd" class="btn btn-danger btn-sm"><i class="mdi mdi-trash-can-outline"></i> Hapus Tanda Tangan</button>
                <textarea id="signature64" name="tanda_tangan" style="display: none" required></textarea>
                <div class="float-right">
                    <a href="{{ base_url('app/sim-ig/hibah') }}" class="btn btn-danger btn-sm">Batal</a>
                    <button type="submit" class="btn btn-primary btn-sm"><i class="mdi mdi-upload"></i> Upload Data</button>                                
                </div>                            
                <br>
            </div>
        @endif
        {!! form_close() !!}

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