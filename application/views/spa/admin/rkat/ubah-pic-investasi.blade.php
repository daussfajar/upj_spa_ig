<?php 
$session = $CI->session->userdata('user_sessions');
?>
@extends('spa.layouts.user')

@section('title')
    RKAT - Ubah PIC Pada RKAT Investasi
@endsection

@section('page-title')
    Perubahan PIC Pada RKAT
@endsection

@section('css')
<link rel="stylesheet" href="{{ base_url('assets/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ base_url('assets/css/responsive.bootstrap4.min.css') }}">
@endsection

@section('breadcrumb')
<li class="breadcrumb-item">Investasi</li>
<li class="breadcrumb-item active">Ubah PIC</li>
@endsection

@section('content')

<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            PIC RKAT
        </div>
        <div class="card-body">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('app/sim-spa/admin/rkat/pic/program-kerja') ?>">Program Kerja</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('app/sim-spa/admin/rkat/pic/operasional') ?>">Operasional</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="<?= base_url('app/sim-spa/admin/rkat/pic/investasi') ?>">Investasi</a>
                </li>
            </ul>
            <div class="table-responsive my-4">
                <table class="table table-striped table-bordered table-hover" id="table-pic-rkat-investasi" style="width:100%;">
                    <thead>
                        <tr>
                            <th>Prodi/Unit</th>
                            <th>Kode Pencairan</th>
                            <th>Uraian dan Tujuan <br>Kegiatan</th>
                            <th>KPI</th>
                            <th>PIC</th>
                            <th>Rp. Ganjil</th>
                            <th>Rp. Genap</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tbody-pic-rkat-investasi">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{!! form_open('app/sim-spa/admin/rkat/ubah-pic', array('class' => 'myForm')) !!}
    <div id="modal-ubah-pic" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0">Perubahan PIC Pada RKAT</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>                
                <div class="modal-body">
                    <input type="hidden" name="kode" value="">
                    <div class="form-group">
                        <label for="">PIC</label>
                        <select name="pic" id="pic" class="form-control" required>
                            @foreach ($karyawan as $kry)
                                <option value="{{ $kry['nik'] }}">{{ $kry['nama_lengkap'] }} / {{ $kry['kode_unit'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm waves-effect" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light"><i class="mdi mdi-pencil"></i> Simpan</button>
                </div>
            </div>
        </div>
    </div>
{!! form_close() !!}

@endsection

@section('js')
<script src="{{ base_url('assets/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ base_url('assets/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ base_url('assets/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ base_url('assets/js/responsive.bootstrap4.min.js') }}"></script>
<script>
    $(document).ready(function(){
        $('#tbody-pic-rkat-investasi').on('click', '.btn-edit', function(){
            var kode_uraian = $(this).data('kode-uraian');
            var pic = $(this).data('pic');
            $('#modal-ubah-pic input[name="kode"]').val(kode_uraian);
            $('#modal-ubah-pic select[name="pic"]').val(pic).trigger('change');
            $('#modal-ubah-pic').modal('show');
        });

        $("#table-pic-rkat-investasi").DataTable({
            initComplete: function() {
                var api = this.api();
                $('#table-pic-rkat-investasi_filter input')
                    .off('.DT')
                    .on('input.DT', function() {
                        api.search(this.value).draw();
                    });
            },
            oLanguage: {
                sProcessing: "Loading..."
            },
            lengthMenu: [
                [10, 25, 50, 100],
                [10, 25, 50, 100],
            ],
            pageLength: 10,
            scrollX: true,
            processing: true,
            serverSide: true,
            ajax: {
                "url": "<?php echo base_url('SPA/Admin/RKAT/get_pic_rkat_investasi') ?>",
                "type": "POST",
                "dataType" : "json",
                "data" : { },
            },
            columns: [
                {
                    "data": "nama_unit"
                },
                {
                    "data": "kode_pencairan"
                },
                {
                    "data": "uraian"
                },
                {
                    "data": "kpi"
                },
                {
                    "data": "nama_lengkap"
                },
                {
                    "data": "rp_ganjil",
                    "class" : "text-center",
                    "render": function(data, type, row) {
                        return formatRupiah(data, 'Rp. ');
                    }
                },
                {
                    "data": "rp_genap",
                    "class" : "text-center",
                    "render": function(data, type, row) {
                        return formatRupiah(data, 'Rp. ');
                    }
                },
                {
                    "data": "kode_uraian",
                    "class" : "text-center",
                    "render": function(data, type, row) {
                            return `<div class="btn-group text-center" >
                                        <button class="text-white btn btn-primary btn-xs btn-edit"
                                            data-kode-uraian="${ row.kode_uraian }" 
                                            data-pic="${ row.pic }"> Ubah PIC 
                                        </button>
                                    </div>`;
                    }
                },
            ],
            order: [
                [1, 'desc']
            ],
            columnDefs: [
                { "targets": 7, "orderable": false, "searchable": false }
            ],
            rowCallback: function(row, data, iDisplayIndex) {
                $('td:eq(0)', row).html();
            }
        });
    });

    /* Fungsi formatRupiah */
    function formatRupiah(angka, prefix){
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split   		= number_string.split(','),
        sisa     		= split[0].length % 3,
        rupiah     		= split[0].substr(0, sisa),
        ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if(ribuan){
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }
</script>
@endsection