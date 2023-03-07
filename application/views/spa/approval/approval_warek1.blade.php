<?php 
$session = $CI->session->userdata('user_sessions');
$year = date('Y');
?>
@extends('spa.layouts.user')

@section('title')
    RKAT - Laporan Pencairan RKAT (ACTBUD / Petty Cash)
@endsection

@section('page-title')
    Laporan Pencairan RKAT (ACTBUD / Petty Cash) <?= $year; ?>
@endsection

@section('css')
<link rel="stylesheet" href="{{ base_url('assets/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ base_url('assets/css/responsive.bootstrap4.min.css') }}">
@endsection

@section('breadcrumb')
<li class="breadcrumb-item">RKAT</li>
<li class="breadcrumb-item active">Laporan Pencairan</li>
@endsection

@section('content')

<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            Data Laporan Pencairan RKAT
        </div>
        <div class="card-body">
            <div class="table-responsive my-4">
                <table class="table table-striped table-bordered table-hover" id="table-approval-warek-1" width="100%">
                    <thead>
                        <tr>
                            <th><center>No.</center></th>
                            <th><center>No Dokumen</center></th>
                            <th><center>Kode Pencairan</center></th>
                            <th><center>Nama Kegiatan</center></th>
                            <th><center>Jenis Pencairan</center></th>
                            <th><center>Anggaran</center></th>
                            <th><center>PIC</center></th>
                            <th><center>Pelaksana</center></th>
                            <th><center>Detail</center></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if(!empty($approval_actbud)){
                                foreach($approval_actbud as $key => $value){
                        ?>
                                    <tr>
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
        $("#table-approval-warek-1").DataTable({
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