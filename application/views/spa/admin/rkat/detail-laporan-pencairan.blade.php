<?php 
$session = $CI->session->userdata('user_sessions');
$year = date('Y');
$noDokumen = $actbud[0]['jns_aju_agr'] == 'actbud' ? "ACT-". $actbud[0]['kd_act'] : "PTY-". $actbud[0]['kd_act'];
?>
@extends('spa.layouts.user')

@section('title')
    RKAT - Detail Laporan Pencairan RKAT - 
@endsection

@section('page-title')
    Detail Laporan Pencairan RKAT
@endsection

@section('css')
<link rel="stylesheet" href="{{ base_url('assets/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ base_url('assets/css/responsive.bootstrap4.min.css') }}">
<style>
    .chat{
        margin: 0;
        padding: 0;
        list-style: none;
    }
    .chat li{
        margin-bottom: 10px;
        padding-bottom: 5px;
        border-bottom: 1px dotted #999;
    }

    .chat li.left .chat-body{
        margin-left: 60px;
    }
</style>
@endsection

@section('breadcrumb')
<li class="breadcrumb-item">RKAT</li>
<li class="breadcrumb-item">Laporan Pencairan</li>
<li class="breadcrumb-item active">
    <?= $noDokumen; ?>
</li>


@endsection

@section('content')

<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            Detail Actbud
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-2">
                    <label for="">Prodi / Bagian / Unit:</label>
                </div>
                <div class="col-md-4">
                    <input type="text" class="form-control" value="<?= $unit['nama_unit'] ?>" readonly>
                </div>
                <div class="col-md-1">
                    <label for="">PIC:</label>
                </div>
                <div class="col-md-5">
                    <input type="text" class="form-control" value="<?= $actbud[0]['nama_lengkap'] ?>" readonly>
                </div>
            </div>
            <div class="row my-4">
                <div class="col-md-2">
                    <label for="">Pelaksana:</label>
                </div>
                <div class="col-md-4">
                    <input type="text" class="form-control" value="<?= $nm['nama_lengkap'] ?>" readonly>
                </div>
            </div>
            <div class="row my-4">
                <div class="col-md-2">
                    <label for="">Nama Kegiatan:</label>
                </div>
                <div class="col-md-10">
                    <textarea class="form-control" rows="4" readonly><?= $actbud[0]['nama_kegiatan'] ?></textarea>
                </div>
            </div>
            <div class="row my-4">
                <div class="col-md-2">
                    <label for="">KPI yang Dicapai:</label>
                </div>
                <div class="col-md-10">
                    <textarea class="form-control" rows="4" readonly><?= $actbud[0]['kpi'] ?></textarea>
                </div>
            </div>
            <div class="row my-4">
                <div class="col-md-2">
                    <label for="">No.Dokumen:</label>
                </div>
                <div class="col-md-4">
                    <input type="text" class="form-control" value="<?= $noDokumen ?>" readonly>
                </div>
                <div class="col-md-2">
                    <label for="">Kode Pencairan:</label>
                </div>
                <div class="col-md-4">
                    <input type="text" class="form-control" value="<?= $actbud[0]['kode_pencairan'] ?>" readonly>
                </div>
            </div>
            <div class="row my-4">
                <div class="col-md-2">
                    <label for="">Anggaran:</label>
                </div>
                <div class="col-md-4">
                    <input type="text" class="form-control" value="<?= number_format($actbud[0]['agr'],'0','.','.'); ?>" readonly>
                </div>
                <div class="col-md-2">
                    <label for="">Borang:</label>
                </div>
                <div class="col-md-4">
                    <input type="text" class="form-control" value="<?= $actbud[0]['no_borang'] ?>" readonly>
                </div>
            </div>
            <div class="row my-4">
                <div class="col-md-2">
                    <label for="">Tanggal Pelaksanaan:</label>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Mulai:</label>
                        <input type="text" class="form-control" value="<?= $actbud[0]['tgl_m']; ?>" readonly>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Selesai:</label>
                        <input type="text" class="form-control" value="<?= $actbud[0]['tgl_s']; ?>" readonly>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            Detail Biaya
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" border="1" width="100%" align="center" id="table-detail-biaya">
                    <thead>
                        <tr>
                            <th><center>No </center></th>
                            <th width="40%"><center>Jenis Biaya</center></th>
                            <th width="35%"><center>Keterangan</center></th>
                            <th><center>Anggaran Yang Diajukan</center></th>
                            <th><center>Catatan Pimpinan</center></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $totalTJBActbud = 0;
                        $no =1;
                        if(!empty($t_j_b_act)){
                            foreach($t_j_b_act as $data_t_j_b_act){
                                $totalTJBActbud += $data_t_j_b_act['aju_agr'];
                    ?>
                                <tr>
                                    <td width="5%" align="left" valign="top"><center><?= $no;?></center></td>
                                    <td width="25%" align="left" valign="top"><?= $data_t_j_b_act['jns_b'];?></td>
                                    <td width="30%" align="left" valign="top"><?= $data_t_j_b_act['ket'];?></td>
                                    <td width="20%" align="right" valign="top"><?= number_format($data_t_j_b_act['aju_agr'],'0','.','.'); ?></td>
                                    <td width="20%" align="right" valign="top">
                                        <?php 
                                            echo '<strong>Warek 1: </strong>'.  $data_t_j_b_act['c_jns_b_wr1'];
                                            echo '<br><strong>Warek 2: </strong>'. $data_t_j_b_act['c_jns_b_wr2'];
                                            echo '<br><strong>Rektor: </strong>'. $data_t_j_b_act['c_jns_b_rk'];
                                        ?>
                                    </td>
                                </tr>
                    <?php
                                $no++;
                            }
                        }else{
                    ?>
                            <tr>
                                <td colspan="4">Data Kosong</td>
                            </tr>
                    <?php
                        }
                    ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3"><center><strong>Total Yang Diajukan</strong></center></td>
                            <td  align="right"> 
                                <?= number_format($totalTJBActbud,'0','.','.'); ?>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            History Approval
        </div>
        <div class="card-body">
            <div class="dataTable_wrapper">
                <table class="table table-striped table-bordered table-hover" >
                    <thead>
                        <tr>
                            <th width="10%"><center>KA. Prodi/Unit</center></th>
                            <th width="10%"><center>Dekan</center></th>
                            <th width="10%"><center>Pre- Approval</center></th>
                            <th width="10%"><center>Keuangan</center></th>
                            <th width="10%"><center>Warek</center></th>
                            <th width="10%"><center>Rektor</center></th>
                            <th width="10%"><center>Presiden</center></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="odd gradeX">
                            <td>
                                <center>
                                    <strong><?= $actbud[0]['st_kabag'];?></strong>
                                    <br><?= $actbud[0]['c_kabag']; ?>
                                    <br><?= $actbud[0]['stamp_kabag']; ?>
                                </center>
                            </td>
                            <td>
                                <center>
                                    <strong>
                                        <?= $actbud[0]['st_ftd'];?>
                                        <?= $actbud[0]['st_fhb'];?>
                                    </strong>
                                    <br>
                                    <?= $actbud[0]['c_ftd']; ?>
                                    <?= $actbud[0]['c_fhb']; ?>
                                    <br>
                                    <?= $actbud[0]['stamp_ftd']; ?>
                                    <?= $actbud[0]['stamp_fhb']; ?>
                                </center>
                            </td>
                            <td>
                                <center>
                                    <strong>
                                        <?= $actbud[0]['st_hrd'];?> 
                                        <?= $actbud[0]['st_umum'];?>
                                        <?= $actbud[0]['st_ict'];?>
                                        <?= $actbud[0]['st_bkal'];?>
                                        <?= $actbud[0]['st_p2m'];?>
                                    </strong>
                                    <br>
                                    <?= $actbud[0]['c_hrd']; ?>
                                    <?= $actbud[0]['c_umum']; ?>
                                    <?= $actbud[0]['c_ict']; ?>
                                    <?= $actbud[0]['c_bkal']; ?>
                                    <?= $actbud[0]['c_p2m']; ?>
                                    <br>
                                    <?= $actbud[0]['stamp_hrd']; ?>
                                    <?= $actbud[0]['stamp_umum']; ?>
                                    <?= $actbud[0]['stamp_ict']; ?>
                                    <?= $actbud[0]['stamp_bkal']; ?>
                                    <?= $actbud[0]['stamp_p2m']; ?>
                                </center>
                            </td>
                            <td>
                                <center>
                                    <strong><?= $actbud[0]['st_keu'];?></strong>
                                    <br>
                                    <?= $actbud[0]['c_keu']; ?>
                                    <br>
                                    <?= $actbud[0]['stamp_keu']; ?>
                                </center>
                            </td>
                            <td>
                                <center>
                                    <strong><?= $actbud[0]['st_warek_1'];?></strong> 
                                    <br>
                                    <?= $actbud[0]['c_warek1']; ?>
                                    <br>
                                    <?= $actbud[0]['stamp_warek1'];?>
                                    <br>
                                    <strong><?= $actbud[0]['st_warek_2'];?></strong>
                                    <br>
                                    <?= $actbud[0]['c_warek2']; ?>
                                    <br>
                                    <?= $actbud[0]['stamp_warek2']; ?>
                                </center>
                            </td>
                            <td>
                                <center>
                                    <strong><?= $actbud[0]['st_rek'];?></strong>
                                    <br>
                                    <?= $actbud[0]['c_rek']; ?>
                                    <br>
                                    <?= $actbud[0]['stamp_rek']; ?>
                                </center>
                            </td>
                            <td>
                                <center>
                                    <strong><?= $actbud[0]['st_pres'];?></strong>
                                    <br>
                                    <?= $actbud[0]['c_pres']; ?>
                                    <br>
                                    <?= $actbud[0]['stamp_pres']; ?>
                                </center>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            Dokumen Pendukung
        </div>
        <div class="card-body">
            <div class="dataTable_wrapper">
                <table class="table table-striped table-bordered table-hover" >
                    <thead>
                        <tr>
                            <th><center>No</center></th>
                            <th><center>nm Dokumen</center></th>
                            <th colspan="1"><center>Aksi</center></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $no =1;
                        if(!empty($upload_act)){
                            foreach($upload_act as $data_upload){
                    ?>
                                <tr>
                                    <td>
                                        <center><?= $no; ?></center>
                                    </td>
                                    <td>
                                        <center><?= $data_upload['nama_file']; ?></center>
                                    </td>
                                    <td>
                                        <center><a href="<?= $data_upload['file']; ?>" target="_blank">Lihat</a></center>
                                    </td>
                                </tr>
                    <?php
                                $no++;
                            }
                        }else{
                    ?>
                            <tr>
                                <td colspan="3">Data Kosong</td>
                            </tr>
                    <?php
                        }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-12">
    {!! form_open('app/sim-spa/admin/rkat/laporan-pencairan/kirim-pesan/' . encrypt($kd_act), array('class' => 'myForm')) !!}
        <div class="card">
            <div class="card-header">
                <span class="mdi mdi-comment"></span> Pesan
            </div>
            <div class="card-body">
                <ul class="chat">
                    <?php
                    if(!empty($chat)){
                        foreach($chat as $data_chat){
                    ?>
                            <li class="left clearfix">
                                <span class="chat-img float-left"></span>
                                <div class="chat-body clearfix">
                                    <div class="header">
                                        <strong class="primary-font"><?= $data_chat['nama_lengkap'];?></strong> <small class="float-right text-muted">
                                            <span class="mdi mdi-clock"></span><?= $data_chat['datetime_chat'];?></small>
                                    </div>
                                    <p>
                                        <?= $data_chat['pesan'];?>
                                    </p>
                                </div>
                            </li>
                    <?php
                        }
                    } else {
                    ?>
                        <li class="left clearfix">
                            <span class="chat-img float-left"></span>
                            <div class="chat-body clearfix">
                                <div class="header">
                                    <strong class="primary-font"></strong> <small class="float-right text-muted">
                                        <span class="mdi mdi-clock"></span></small>
                                </div>
                            </div>
                    </li>
                    <?php
                    }
                    ?>
                </ul>
            </div>
            <div class="card-footer">
                <div class="form-group">
                    <textarea placeholder="Type a message ..." name="pesan" class="form-control" rows="3"></textarea>
                    <input hidden name="nik" value="<?= $CI->session->userdata('user_sessions')['nik']; ?>">
                </div>
                <div class="form-group">
                    <button class="btn btn-primary" id="btn-chat"><i class="mdi mdi-send"></i> Kirim</button>
                </div>
            </div>
        </div>
    {!! form_close() !!}
</div>

@endsection

@section('js')
<script src="{{ base_url('assets/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ base_url('assets/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ base_url('assets/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ base_url('assets/js/responsive.bootstrap4.min.js') }}"></script>
<script>
    $(document).ready(function(){
        $("#table-detail-biaya").DataTable({
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