<?php 
$session = $CI->session->userdata('user_sessions');
?>
@extends('spa.layouts.user')

@section('title')
    Approval - Dekan
@endsection

@section('page-title')
    Approval - Dekan
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
<li class="breadcrumb-item">Approval</li>
<li class="breadcrumb-item active">Dekan</li>
@endsection

@section('content')

<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">
                Silakan Lakukan Approval
            </h5>
        </div>
        <div class="card-body">
            <div class="table-responsive my-4">
                <table class="table table-striped table-bordered table-hover" id="table-approval-dekan" width="100%">
                    <thead class="bg-purple text-white">
                        <tr>
                            <th class="v-middle text-center">No.</th>
                            <th class="v-middle text-center">No Dokumen</th>
                            <th class="v-middle text-center">Kode Pencairan</th>
                            <th class="v-middle">Nama Kegiatan</th>
                            <th class="v-middle text-center">Jenis Pencairan</th>
                            <th class="v-middle text-center">Anggaran</th>
                            <th class="v-middle text-center">PIC</th>
                            <th class="v-middle text-center">Pelaksana</th>
                            <th class="v-middle text-center">Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $no = 1;
                            if(!empty($approval_actbud)){
                                foreach($approval_actbud as $key => $value){
                                    $date_m = date_create($value['tgl_m']);
                                    $date_s = date_create($value['tgl_s']);
                        ?>
                                    <tr>
                                        <td class="v-middle text-center font-14"><?= $no++; ?></td>
                                        <td class="v-middle text-center font-14">
                                            <?php
                                                if($value['jns_aju_agr'] == 'actbud'){
                                                    echo 'ACT/' . $value['kd_act'];
                                                }else{
                                                    echo 'PTY/' . $value['kd_act'];
                                                }
                                            ?>
                                        </td>
                                        <td class="v-middle text-center font-14"><?= $value['kode_pencairan']; ?></td>
                                        <td class="v-middle font-14">
                                            <?= $value['nama_kegiatan'] ?>
                                            <hr class="mt-1 mb-2">
                                            <span class="badge bg-secondary p-2" style="font-size:12px;">
                                                <i class="mdi mdi-calendar"></i> <?= tanggal_indo(date_format($date_m, 'Y-m-d')) . ' - ' . tanggal_indo(date_format($date_s, 'Y-m-d')) ?>
                                            </span>
                                        </td>
                                        <td class="v-middle text-center">
                                            <span class="badge bg-dark p-2">
                                                <i class="mdi mdi-checkbox-marked-circle-outline"></i> <?= ucwords($value['jns_aju_agr']) ?>
                                            </span>
                                        </td>
                                        <td class="v-middle text-center">
                                            <?php 
                                            $color = "";
                                            if($value['agr'] < 10000000){
                                                $color .= "teal";
                                            } else if($value['agr'] >= 10000000 && $value['agr'] < 20000000){
                                                $color .= "secondary";
                                            } else if($value['agr'] >= 20000000 && $value['agr'] < 50000000){
                                                $color .= "dark";
                                            } else if($value['agr'] >= 50000000){
                                                $color .= "danger";
                                            }
                                            ?>
                                            <span class="badge bg-<?= $color ?> p-2">
                                                <?= rupiah_1($value['agr']) ?>
                                            </span>
                                        </td>
                                        <td class="v-middle text-center font-14"><?= $value['nama_pic']; ?></td>
                                        <td class="v-middle text-center font-14"><?= $value['nama_pelaksana']; ?></td>
                                        <td class="v-middle text-center">                                            
                                            <a href="<?= base_url('app/sim-spa/approval/dekan/detail/') . $value['kd_act']; ?>" class="badge bg-info p-2">
                                                Detail <i class="mdi mdi-arrow-right"></i>
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
        $("#table-approval-dekan").DataTable({
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
            order: [
                [0, 'asc']
            ],
            rowCallback: function(row, data, iDisplayIndex) {
                $('td:eq(0)', row).html();
            }
        });
    });
</script>
@endsection