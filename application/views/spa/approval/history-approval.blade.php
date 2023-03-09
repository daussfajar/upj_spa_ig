<?php 
$session = $CI->session->userdata('user_sessions');
?>
@extends('spa.layouts.user')

@section('title')
    History Approval Actbud
@endsection

@section('page-title')
    History Approval Actbud
@endsection

@section('css')
<link rel="stylesheet" href="{{ base_url('assets/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ base_url('assets/css/responsive.bootstrap4.min.css') }}">
@endsection

@section('breadcrumb')
<li class="breadcrumb-item">History Approval</li>
@endsection

@section('content')

<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            Data History Approval
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="table-history-approval" width="100%">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="5%"><center>Tahun</center></th>
                            <th width="15%"><center>No. Dokumen</center></th>
                            <th width="15%"><center>Kode Pencairan & Jenis Pencairan</center></th>
                            <th width="40%"><center>Nama Kegiatan</center></th>
                            <th width="10%"><center>Anggaran</center></th>
                            <th width="10%"><center>Approval</center></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $no = 1;
                        if(!empty($approval_actbud)){
                            foreach($approval_actbud as $key => $value){
                                $ketApproval = "";
                                if($as == "kepala-unit"){
                                    $ketApproval = '<td class="v-middle text-center"><strong>' . $value['st_kabag'] . '</strong><br>' . $value['stamp_kabag'] . '</td>';
                                } else if($as == "umum"){
                                    $ketApproval = '<td class="v-middle text-center"><strong>' . $value['st_umum'] . '</strong><br>' . $value['stamp_umum'] . '</td>';
                                } else if($as == "hrd"){
                                    $ketApproval = '<td class="v-middle text-center"><strong>' . $value['st_hrd'] . '</strong><br>' . $value['stamp_hrd'] . '</td>';
                                } else if($as == "ict"){
                                    $ketApproval = '<td class="v-middle text-center"><strong>' . $value['st_ict'] . '</strong><br>' . $value['stamp_ict'] . '</td>';
                                } else if($as == "bkal"){
                                    $ketApproval = '<td class="v-middle text-center"><strong>' . $value['st_bkal'] . '</strong><br>' . $value['st_bkal'] . '</td>';
                                } else if($as == "p2m"){
                                    $ketApproval = '<td class="v-middle text-center"><strong>' . $value['st_p2m'] . '</strong><br>' . $value['st_p2m'] . '</td>';
                                } else if($as == "keuangan"){
                                    $ketApproval = '<td class="v-middle text-center"><strong>' . $value['st_keu'] . '</strong><br>' . $value['stamp_keu'] . '</td>';
                                } else if($as == "dekan-ftd"){
                                    $ketApproval = '<td class="v-middle text-center"><strong>' . $value['st_ftd'] . '</strong><br>' . $value['stamp_ftd'] . '</td>';
                                } else if($as == "dekan-fhb"){
                                    $ketApproval = '<td class="v-middle text-center"><strong>' . $value['st_fhb'] . '</strong><br>' . $value['stamp_fhb'] . '</td>';
                                } else if($as == "warek1"){
                                    $ketApproval = '<td class="v-middle text-center"><strong>' . $value['st_warek_1'] . '</strong><br>' . $value['stamp_warek1'] . '</td>';
                                } else if($as == "warek2"){
                                    $ketApproval = '<td class="v-middle text-center"><strong>' . $value['st_warek_2'] . '</strong><br>' . $value['stamp_warek2'] . '</td>';
                                } else if($as == "rektor"){
                                    $ketApproval = '<td class="v-middle text-center"><strong>' . $value['st_rek'] . '</strong><br>' . $value['stamp_rek'] . '</td>';
                                } else if($as == "presiden"){
                                    $ketApproval = '<td class="v-middle text-center"><strong>' . $value['st_pres'] . '</strong><br>' . $value['stamp_pres'] . '</td>';
                                }

                    ?>
                                <tr>
                                    <td class="v-middle text-center font-14"><?= $no++; ?></td>
                                    <td class="v-middle" align="center">
                                            <?= $value['tahun'] ?>
                                    </td>
                                    <td class="v-middle text-center">
                                        <?php
                                            $no_dokumen = $value['jns_aju_agr'] == 'actbud' ? 'ACT' : 'PTY';                                            
                                        ?>
                                        <span class="badge bg-primary p-2">
                                            <?= $no_dokumen . '/' . $value['kd_act'] ?>
                                        </span>
                                    </td>
                                    <td class="v-middle text-center">
                                        <span class="badge bg-purple p-2">
                                            <?= $value['kode_pencairan'] ?>
                                        </span>
                                        <br>
                                        <span class="badge bg-dark p-2 mt-2">
                                            <i class="mdi mdi-checkbox-marked-circle-outline"></i> <?= ucwords($value['jns_aju_agr']) ?>
                                        </span>
                                    </td>
                                    <td class="v-middle font-14">
                                        <a href="<?= base_url('app/sim-spa/history-approval/'. $as .'/detail/') . $value['kd_act']; ?>">
                                            <?= $value['nama_kegiatan'] ?>
                                        </a>
                                        <hr class="mt-1 mb-2">
                                        <span class="badge bg-secondary p-2" style="font-size:12px;">
                                            <i class="mdi mdi-calendar"></i> <?= tanggal_indo(date('Y-m-d', strtotime($value['tgl_m']))) . ' - ' . tanggal_indo(date('Y-m-d', strtotime($value['tgl_s']))) ?>
                                        </span>
                                    </td>
                                    <td class="v-middle" align="center">
                                        <span class="badge bg-success p-2">
                                            <?= rupiah_1($value['agr']) ?>
                                        </span>
                                    </td>
                                    <?= $ketApproval ?>
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
        $("#table-history-approval").DataTable({
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