<?php 
$session = $CI->session->userdata('user_sessions');
$year = date('Y');
?>
@extends('spa.layouts.user')

@section('title')
    Anggaran - Realisasi
@endsection

@section('page-title')
    Realisasi Anggaran <?= $year ?>
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
<li class="breadcrumb-item">Anggaran</li>
<li class="breadcrumb-item active">Realisasi</li>
@endsection

@section('content')

<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">
                Data Realisasi Anggaran <?= $year ?>
            </h5>
        </div>
        <div class="card-body">
            <div class="table-responsive my-4">
                <table class="table table-striped table-bordered table-hover" id="table-realisasi-anggaran" style="width:100%;">
                    <thead>
                        <tr>
                            <th class="v-middle" width="5%">No</th>
                            <th class="v-middle" width="10%"><center>Kode Realisasi</center></th>
                            <th class="v-middle" width="50%"><center>Nama Kegiatan</center></th>
                            <th class="v-middle" width="15%"><center>Anggaran</center></th>
                            <th class="v-middle" width="20%"><center>Kode Pencairan& Jenis Pencairan</center></th>
                            <th class="v-middle" width="5%"></th>
                        </tr>
                    </thead>
                    <tbody id="tbody-table-realisasi-anggaran">
                        <?php
                            if(!empty($actbud_realisasi)){
                                $no=1;
                                foreach($actbud_realisasi as $key){
                                    $classI = $key['status_penyesuaian'] == '' ? 'mdi mdi-lock-open' : 'mdi mdi-lock';
                        ?>
                                    <tr>
                                        <td class="v-middle font-14" align="center"><?= $no++; ?></td>
                                        <td class="v-middle font-14" align="center">
                                            <?php
                                                if($key['jns_aju_agr'] == 'actbud'){
                                            ?>
                                                ACT/<?= $key['kd_act'] ?>
                                            <?php
                                                }else{
                                            ?>
                                                PTY/<?= $key['kd_act'] ?>
                                            <?php
                                                }
                                            ?>
                                        </td>
                                        <td class="v-middle font-14" align="left"><?= $key['nama_kegiatan'] ?></td>
                                        <td class="v-middle" align="right">
                                            <span class="badge bg-success p-2">
                                                <?= rupiah_1($key['fnl_agr']) ?>
                                            </span>
                                        </td>
                                        <td class="v-middle font-14" align="center">
                                            <strong><?php echo $key['kode_pencairan']?></strong>
                                            <br>
                                            <?php echo $key['nama_lengkap']?>
                                        </td>
                                        <td class="v-middle font-14" align="center">
                                            <a class="text-white btn btn-primary" href="<?= base_url('app/sim-spa/anggaran/realisasi/' . $key['kd_act']) ?>">
                                                <i class="<?= $classI ?>"></i>
                                            </a>
                                        </td>
                                    </tr>
                        <?php
                                }
                            }
                        ?>
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

        $("#table-realisasi-anggaran").DataTable({
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
            serverSide: false,
            columnDefs: [
                { "targets": 5, "orderable": false, "searchable": false }
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