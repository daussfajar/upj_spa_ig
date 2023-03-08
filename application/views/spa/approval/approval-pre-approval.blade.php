<?php 
$session = $CI->session->userdata('user_sessions');
$kode_unit = $session['kode_unit'];
$jabatan = $session['kode_jabatan'];
$nama_unit = $_SESSION['user_sessions']['nama_unit'];
?>
@extends('spa.layouts.user')

@section('title')
    <?= MOD2 ?> Approval Terkait <?= $nama_unit ?>
@endsection

@section('page-title')
    Approval Terkait <?= $nama_unit ?>
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
    <li class="breadcrumb-item active"><a href="javascript: void(0);">Approval Terkait <?= $nama_unit ?></a></li>
@endsection

@section('content')
    <div class="col-lg-12">
        <div class="card card-border">
            <div class="card-header bg-transparent">
                <h3 class="card-title text-muted mb-0">Data</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped dataTable">
                        <thead class="bg-purple text-white">
                            <tr>
                                <th class="v-middle text-center">No</th>
                                <th class="v-middle">No Dokumen</th>
                                <th class="v-middle">Kode Pencairan</th>
                                <th class="v-middle">Nama Kegiatan</th>
                                <th class="v-middle text-center">Jenis Kegiatan</th>
                                <th class="v-middle text-center">Anggaran</th>
                                <th class="v-middle text-center">PIC</th>
                                <th class="v-middle text-center">Pelaksana</th>
                                <th class="v-middle text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($approval_actbud as $item)
                                <?php 
                                $no_dokumen = $item['jns_aju_agr'] == 'actbud' ? 'ACT' : 'PTY';
                                $date_m = date_create($item['tgl_m']);
                                $date_s = date_create($item['tgl_s']);
                                ?>
                                <tr>
                                    <th class="text-center v-middle">{{ $loop->iteration }}</th>
                                    <td class="v-middle">
                                        <span class="badge bg-primary p-2">
                                            <?= $no_dokumen . '/' . $item['kd_act'] ?>
                                        </span>
                                    </td>
                                    <td class="v-middle">
                                        <span class="badge bg-purple p-2">
                                            <?= $item['kode_pencairan'] ?>
                                        </span>
                                    </td>
                                    <td class="v-middle font-14">
                                        <?= $item['nama_kegiatan'] ?>
                                        <hr class="mt-1 mb-2">
                                        <span class="badge bg-secondary p-2" style="font-size:12px;">
                                            <i class="mdi mdi-calendar"></i> <?= tanggal_indo(date_format($date_m, 'Y-m-d')) . ' - ' . tanggal_indo(date_format($date_s, 'Y-m-d')) ?>
                                        </span>
                                    </td>
                                    <td class="v-middle text-center">
                                        <span class="badge bg-dark p-2">
                                            <i class="mdi mdi-checkbox-marked-circle-outline"></i> <?= ucwords($item['jns_aju_agr']) ?>
                                        </span>
                                    </td>
                                    <td class="v-middle text-center">
                                        <span class="badge bg-success p-2">
                                            <?= rupiah_1($item['agr']) ?>
                                        </span>
                                    </td>
                                    <td class="v-middle text-center">
                                        <span class="badge bg-teal p-2">
                                            <?= $item['nama_pic'] ?>
                                        </span>
                                    </td>
                                    <td class="v-middle text-center">
                                        <span class="badge bg-teal p-2">
                                            <?= $item['nama_pelaksana'] ?>
                                        </span>
                                    </td>
                                    <td class="v-middle text-center">
                                        <a href="<?= base_url('app/sim-spa/approval/pre-approval/detail/' . $item['kd_act']) ?>" class="badge bg-info p-2">
                                            Detail <i class="mdi mdi-arrow-right"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
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
        $(".dataTable").DataTable({
            oLanguage: {
                sProcessing: "Loading..."
            },
            pageLength: 10,            
            serverSide: false,
            processing: true,
        })
    })
</script>
@endsection