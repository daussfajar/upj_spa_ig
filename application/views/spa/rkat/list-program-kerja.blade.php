<?php 
$session = $CI->session->userdata('user_sessions');
$tahunRKAT = date('Y', strtotime(date('Y-m-d') . ' -1 year')) . '/' . date('Y');
?>
@extends('spa.layouts.user')

@section('title')
    RKAT <?= $tahunRKAT ?> - List Program Kerja
@endsection

@section('page-title')
    RKAT <?= $tahunRKAT ?>
@endsection

@section('css')
<link rel="stylesheet" href="{{ base_url('assets/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ base_url('assets/css/responsive.bootstrap4.min.css') }}">
@endsection

@section('breadcrumb')
<li class="breadcrumb-item">Program Kerja</li>
<li class="breadcrumb-item active">List</li>
@endsection

@section('content')

<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            LIST RKAT
        </div>
        <div class="card-body">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" href="<?= base_url('app/sim-spa/rkat/list/program-kerja') ?>">Program Kerja</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('app/sim-spa/rkat/list/operasional') ?>">Operasional</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('app/sim-spa/rkat/list/investasi') ?>">Investasi</a>
                </li>
            </ul>
            <div class="table-responsive my-4">
                <table class="table table-striped table-bordered table-hover" id="table-list-rkat-program-kerja" style="wdith:100%;">
                    <thead>
                        <tr>
                            <th>Kode Pencairan</th>
                            <th>Kode Kegiatan</th>
                            <th>Uraian dan Tujuan <br>Kegiatan</th>
                            <th>Kode KPI</th>
                            <th>KPI</th>
                            <th>PIC</th>
                            <th>Tahun Anggaran</th>
                            <th>Periode</th>
                            <th>Total RKAT</th>
                            <th>Pengalihan Masuk</th>
                            <th>Pengalihan Keluar</th>
                            <th>Pencairan</th>
                            <th>Sisa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if(!empty($list_rkat)){
                                foreach($list_rkat as $key => $value){
                        ?>
                                    <tr>
                                        <td><?= $value['kode_pencairan'] ?></td>
                                        <td><?= $value['renstra_prodi'] ?></td>
                                        <td><?= $value['uraian'] ?></td>
                                        <td><?= $value['renstra_univ'] ?></td>
                                        <td><?= $value['kpi'] ?></td>
                                        <td><?= $value['nama_lengkap'] ?></td>
                                        <td><?= $value['tahun'] ?></td>
                                        <td><?= $value['periode'] ?></td>
                                        <td><?= number_format ($value['total_agr_stj'],'0',',','.'); ?></td>
                                        <td><?= number_format ($value['n_in'],'0',',','.'); ?></td>
                                        <td><?= number_format ($value['n_out'],'0',',','.'); ?></td>
                                        <td><?= number_format ($value['t_aju_agr'],'0',',','.'); ?></td>
                                        <td><?= number_format ($value['sisa_agr'],'0',',','.'); ?></td>
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
        $("#table-list-rkat-program-kerja").DataTable({
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
                [1, 'asc']
            ],
        });
    });
</script>
@endsection