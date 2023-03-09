<?php
$session = $CI->session->userdata('user_sessions'); 
$nama_lengkap = $session['nama_lengkap'];
$nik = decrypt($session['nik']);
?>
@extends('spa.layouts.user')

@section('title')
    <?= MOD2 ?> Pencairan RKAT - Status Petty Cash
@endsection

@section('page-title')
    Status Persetujuan Petty Cash
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="javascript: void(0);">Pencairan RKAT</a></li>
    <li class="breadcrumb-item"><a href="javascript: void(0);">Petty Cash</a></li>
    <li class="breadcrumb-item active"><a href="javascript: void(0);">Status Petty Cash</a></li>
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
                    <table class="table table-striped table-bordered table-hover" id="table-actbud">
                        <thead class="">
                            <tr>
                                <th width="50" style="vertical-align: middle">No</th>
                                <th style="vertical-align: middle">No Dokumen</th>
                                <th style="vertical-align: middle">Kode Pencairan</th>
                                <th style="vertical-align: middle">Nama Kegiatan</th>
                                <th class="text-center" style="vertical-align: middle">
                                    Anggaran
                                </th>
                                <th style="vertical-align: middle">Status Approval</th>
                                <th style="vertical-align: middle">Aksi</th>
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
