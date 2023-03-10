<?php
$session = $CI->session->userdata('user_sessions'); 
$nama_lengkap = $session['nama_lengkap'];
$nik = decrypt($session['nik']);
?>
@extends('spa.layouts.user')

@section('title')
    <?= MOD2 ?> Pencairan RKAT - Status Actbud
@endsection

@section('page-title')
    Status Persetujuan Actbud
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="javascript: void(0);">Pencairan RKAT</a></li>
    <li class="breadcrumb-item"><a href="javascript: void(0);">Actbud</a></li>
    <li class="breadcrumb-item active"><a href="javascript: void(0);">Status Actbud</a></li>
@endsection

@section('css')
<link rel="stylesheet" href="{{ base_url('assets/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ base_url('assets/css/responsive.bootstrap4.min.css') }}">
<style>
    .v-middle{
        vertical-align: middle!important;
    }
    .font-14{
        font-size: 14px!important;
    }
</style>
@endsection

@section('content')
    <div class="col-md-12">
        <div class="card mt-2">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <b>
                        PIC :
                        <span class="badge bg-info p-2">
                            <i class="mdi mdi-account"></i> <?= $nama_lengkap ?>
                        </span>
                    </b>
                </h5>
            </div>            
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="table-actbud" style="width:100% !important;">
                        <thead class="">
                            <tr>
                                <th width="50" class="v-middle text-center">No</th>
                                <th class="v-middle text-center">No Dokumen</th>
                                <th class="v-middle text-center">Kode Pencairan</th>
                                <th class="v-middle">Nama Kegiatan</th>
                                <th class="v-middle text-center">
                                    Anggaran
                                </th>
                                <th class="v-middle text-center">Status Approval</th>
                                <th class="v-middle text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tbody-table-actbud">
                            <?php 
                            $no = 1;
                            foreach ($data_actbud as $item){
                                $date_m = date_create($item['tgl_m']);
                                $date_s = date_create($item['tgl_s']);
                                ?>
                                <tr>
                                    <th class="text-center v-middle font-14">{{ $no++ }}</th>
                                    <td class="v-middle font-14 text-center">
                                        ACT/<?= $item['kd_act'] ?>                                        
                                    </td>
                                    <td class="v-middle font-14 text-center">
                                        <?= $item['kode_pencairan'] ?>                                        
                                    </td>
                                    <td class="v-middle font-14">
                                        <?= $item['nama_kegiatan'] ?>
                                        <hr class="mt-1 mb-2">
                                        <span class="badge bg-secondary p-2" style="font-size:12px;">
                                            <i class="mdi mdi-calendar"></i> <?= tanggal_indo(date_format($date_m, 'Y-m-d')) . ' - ' . tanggal_indo(date_format($date_s, 'Y-m-d')) ?>
                                        </span>
                                    </td>
                                    <td class="v-middle text-center">
                                        <?php 
                                        $color = "";
                                        if($item['agr'] < 10000000){
                                            $color .= "teal";
                                        } else if($item['agr'] >= 10000000 && $item['agr'] < 20000000){
                                            $color .= "secondary";
                                        } else if($item['agr'] >= 20000000 && $item['agr'] < 50000000){
                                            $color .= "dark";
                                        } else if($item['agr'] >= 50000000){
                                            $color .= "danger";
                                        }
                                        ?>
                                        <span class="badge bg-<?= $color ?> p-2">
                                            <?= rupiah_1($item['agr']) ?>
                                        </span>
                                    </td>
                                    <td class="v-middle text-center">
                                        <a href="<?= base_url('app/sim-spa/pencairan-rkat/actbud/status-actbud/' . $item['kode_uraian'] . '/' . $item['kd_act']) ?>" class="badge bg-info p-2">Lihat</a>
                                    </td>
                                    <td class="v-middle"></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script src="{{ base_url('assets/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ base_url('assets/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ base_url('assets/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ base_url('assets/js/responsive.bootstrap4.min.js') }}"></script>
<script>
    $(document).ready(function(){
        let base_url = "<?= base_url() ?>"
        $("#table-actbud").DataTable({
            oLanguage: {
                sProcessing: "Loading..."
            },
            pageLength: 10,
            scrollX: true,
            serverSide: false,
            processing: true,
        })
        /*$("#table-actbud").DataTable({
            initComplete: function() {
                var api = this.api();
                $('#table-actbud_filter input')
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
            // responsive: true,
            ajax: {
                "url": "<?php echo base_url('SPA/PencairanRKAT/get_actbud_by_nik') ?>",
                "type": "POST",
                "dataType" : "json",
                "data" : {
                    'pic': '<?= $nik ?>',
                    'jenis': 'actbud'
                },
            },
            columns: [
                {
                    "data": "kd_act",
                    "class": "text-center v-middle font-14",
                    "sortable": false, 
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }  
                },
                {
                    "data": "kd_act",
                    "class": "v-middle",
                    render: function(data, type, row){
                        return '<span class="badge bg-primary p-2">' + 'ACT/' + data + '</span>'
                    }
                },
                {
                    "data": "kode_pencairan",
                    "class": "v-middle",
                    render: function(data, type, row){
                        return '<span class="badge bg-purple p-2">'+ data + '</span>'
                    }
                },
                {
                    "data": "nama_kegiatan",
                    "class": "v-middle font-14",
                    "render": function (data, type, row) {
                        return row.nama_kegiatan + `
                        <hr class="mt-1 mb-2">
                        <span class="badge bg-secondary p-2" style="font-size:12px;">
                            <i class="mdi mdi-calendar"></i>  `+row.tgl_m+` s/d `+row.tgl_s+`
                        </span>
                        `
                    }
                },
                {
                    "data": "agr",
                    "class": "v-middle",
                    "render": function (data, type, row) {
                        return '<span class="badge bg-success p-2">'+formatRupiah(data, 'Rp. ')+'</span>'
                    }
                },
                {
                    "data": "kode_uraian",
                    "class": "v-middle text-center",
                    "render": function (data, type, row) {
                        return '<a href="'+base_url+'app/sim-spa/pencairan-rkat/actbud/status-actbud/'+row.kode_uraian+'/'+row.kd_act+'" class="badge bg-info p-2">Lihat</a>'
                    }
                },
                {
                    "data": "kd_act",
                    "class": "v-middle text-center",
                    render: function (data, type, row) {
                        return ''
                    }
                },
            ],
            order: [
                [1, 'desc']
            ],
            columnDefs: [
                { "targets": 0, "searchable": false },
                { "targets": 1, "searchable": true },
                { "targets": 2, "searchable": true },
                { "targets": 3, "searchable": true },
                { "targets": 4, "searchable": false },
                { "targets": 5, "searchable": false, "sortable": false },
                { "targets": 6, "orderable": false, "searchable": false }
            ],
            rowCallback: function(row, data, iDisplayIndex) {
                $('td:eq(0)', row).html()
            }
        })*/
    })

    /* Fungsi formatRupiah */
    function formatRupiah(angka, prefix){
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split   		= number_string.split(','),
        sisa     		= split[0].length % 3,
        rupiah     		= split[0].substr(0, sisa),
        ribuan     		= split[0].substr(sisa).match(/\d{3}/gi)

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if(ribuan){
            separator = sisa ? '.' : ''
            rupiah += separator + ribuan.join('.')
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '')
    }
</script>
@endsection
