<?php
$session = $CI->session->userdata('user_sessions');
?>
@extends('spa.layouts.user')

@section('title')
    <?= MOD2 ?> Pencairan RKAT - Input Acbud
@endsection

@section('page-title')
    Input Actbud
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

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="javascript: void(0);">Pencairan RKAT</a></li>
    <li class="breadcrumb-item active"><a href="javascript: void(0);">Input Actbud</a></li>
@endsection

@section('content')    
<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">
                Data Actbud
            </h5>
        </div>
        <div class="card-body">    
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="table-actbud">
                    <thead class="bg-purple text-white">
                        <tr>
                            <th style="vertical-align:middle;" class="text-center">No</th>
                            <th style="vertical-align:middle;">Uraian</th>
                            <th style="vertical-align:middle;" class="text-center">Kode Pencairan</th>
                            <th style="vertical-align:middle;" class="text-center">Ganjil</th>
                            <th style="vertical-align:middle;" class="text-center">Genap</th>
                            <th style="vertical-align:middle;" class="text-center">Sisa</th>
                            <th style="vertical-align:middle;" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tbody-table-actbud">
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
            /*responsive: true,*/
            ajax: {
                "url": "<?php echo base_url('SPA/PencairanRKAT/get_actbud') ?>",
                "type": "POST",
                "dataType" : "json",
                "data" : {
                    'kode-rkat': '<?= $kode_rkat_master ?>',
                    'periode': '<?= $periode ?>'
                },
            }, 
            columns: [
                {
                    "data": "kode_uraian",
                    "class": "text-center v-middle font-14",
                    "sortable": false, 
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }  
                },
                {
                    "data": "uraian",
                    "class": "v-middle font-14",
                },
                {
                    "data": "kode_pencairan",
                    "class": "v-middle",
                    "render": function(data, type, row){
                        return '<span class="badge bg-purple p-2">'+data+'</span>'
                    }
                },
                {
                    "data": "rp_ganjil",
                    "class": "text-center v-middle",                    
                    "render": function (data, type, row) {
                        if(data == ""){
                            return '-'
                        } else {
                            return '<span class="badge bg-success p-2">'+formatRupiah(data, 'Rp. ')+'</span>'
                        }
                    }
                },
                {
                    "data": "rp_genap",
                    "class": "text-center v-middle",
                    "render": function (data, type, row) {                        
                        if(data == ""){
                            return '-'
                        } else {
                            return '<span class="badge bg-teal p-2">'+formatRupiah(data, 'Rp. ')+'</span>'
                        }
                    }
                },
                {
                    "data": "sisa_anggaran",
                    "class": "text-center v-middle",
                    "render": function (data, type, row) {
                        return '<span class="badge bg-secondary p-2">'+formatRupiah(data, 'Rp. ')+'</span>'
                    }
                },
                {
                    "data": "kode_uraian",
                    "class": "text-center v-middle",
                    "render": function(data, type, row, meta){
                        let url = base_url + "app/sim-spa/pencairan-rkat/input-actbud/" + data
                        return '<a href="'+url+'" class="badge bg-primary p-2">Input Actbud</a>'
                    }
                }
            ],
            order: [
                [1, 'desc']
            ],
            columnDefs: [
                { "targets": 0, "searchable": false },
                { "targets": 1, "searchable": true },
                { "targets": 2, "searchable": true },
                { "targets": 3, "searchable": true },
                { "targets": 4, "searchable": true },
                { "targets": 5, "searchable": false },
                { "targets": 6, "orderable": false, "searchable": false }
            ],
            rowCallback: function(row, data, iDisplayIndex) {
                $('td:eq(0)', row).html()
            }
        })
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
