<?php 
$session = $CI->session->userdata('user_sessions');
$pengalihanNominal = $pengalihan['nominal'] != "" && $pengalihan != null ? $pengalihan['nominal'] : 0;
?>
@extends('spa.layouts.user')

@section('title')
    Anggaran - Pengalihan
@endsection

@section('page-title')
    Pengalihan Anggaran <?= $year ?>
@endsection

@section('css')
<link rel="stylesheet" href="{{ base_url('assets/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ base_url('assets/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ base_url('assets/css/select2.min.css') }}">
@endsection

@section('breadcrumb')
<li class="breadcrumb-item">Anggaran</li>
<li class="breadcrumb-item active">Pengalihan</li>
@endsection

@section('content')

<div class="col-lg-12">
    <a href="<?= base_url('app/sim-spa/anggaran/pengalihan') ?>" class="btn btn-secondary text-white btn-sm"><i class="mdi mdi-arrow-left"></i> Kembali</a>
    <div class="card mt-3">
        <div class="card-header">
            Proses Pengalihan Anggaran
        </div>
        <div class="card-body">
            {!! form_open('app/sim-spa/anggaran/pengalihan/proses/' . $id, array('class' => 'myForm')) !!}
                <div class="row">
                    <input hidden name="saldo_f" value="<?= $saldo_f ?>">
                    <input hidden name="saldo_t" value="<?= $saldo_t ?>">
                    <div class="col-md-6 form-group">
                        <label for="">Kode Pencairan Asal</label>
                        <input class="form-control" name="kode_pencairan_asal" value="<?= $pengalihan['kd_pencairan_f']; ?>" type="text" required readonly/>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="">Saldo</label>
                        <input class="form-control" name="saldo_asal" type="text" value="Rp. <?= number_format($saldo_f,0,',','.'); ?>" required readonly/>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="">Kode Pencairan Tujuan</label>
                        <input class="form-control" name="kode_pencairan_asal" value="<?= $pengalihan['kd_pencairan_t']; ?>" type="text" required readonly/>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="">Saldo</label>
                        <input class="form-control" name="saldo_tujuan" type="text" value="Rp. <?= number_format($saldo_t,0,',','.'); ?>" required readonly/>
                    </div>
                    <div class="col-md-12">
                        <p><strong>Saldo Yang Dialihkan: Rp. <?= number_format($pengalihanNominal,0,',','.'); ?></strong></p>
                    </div>
                    <div class="col-md-6 form-group">
                        <input type="submit" name="proses" class="btn btn-success btn-block" value="Proses"/>
                    </div>
                    <div class="col-md-6 form-group">
                        <input type="submit" name="tolak" class="btn btn-danger btn-block" value="Tolak"/>
                    </div>
                </div>    
            {!! form_close() !!}
        </div>
    </div>
</div>

@endsection

@section('js')
@endsection