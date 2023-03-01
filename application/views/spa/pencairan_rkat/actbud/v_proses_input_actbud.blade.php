<?php
$session = $CI->session->userdata('user_sessions');
$sisa_agr = ($data['sisa_anggaran'] - $data['s_act_agr']);
?>
@extends('spa.layouts.user')

@section('title')
    <?= MOD2 ?> Pencairan RKAT - Input Acbud - {{ $data['uraian'] }}
@endsection

@section('page-title')
    <a href="{{ base_url('app/sim-spa/pencairan-rkat/input-actbud') }}"><i class="mdi mdi-arrow-left"></i></a> Input Actbud
@endsection

@section('css')
<link rel="stylesheet" href="{{ base_url('assets/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ base_url('assets/css/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ base_url('assets/css/bootstrap-datepicker.min.css') }}">
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="javascript: void(0);">Pencairan RKAT</a></li>
<li class="breadcrumb-item"><a href="javascript: void(0);">Actbud</a></li>
<li class="breadcrumb-item"><a href="javascript: void(0);">Input Actbud</a></li>
<li class="breadcrumb-item active"><a href="javascript: void(0);">{{ $data['kode_pencairan'] }}</a></li>
@endsection

@section('content')
    <?php if($sisa_agr > 0){ ?>
    {!! form_open(base_url('app/sim-spa/pencairan-rkat/input-actbud/' . $id), array('class' => 'myForm')) !!}
    <?php } ?>    
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="card-title mb-0">Rincian RKAT</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Prodi / Bagian / Unit :</label>
                            <p class="form-control-static">
                                <span class="badge bg-teal p-2">
                                    {{ $data['nama_unit'] }}
                                </span>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">PIC :</label>
                            <p class="form-control-static">
                                <span class="badge bg-info p-2">
                                    {{ $data['nama_lengkap'] }}
                                </span>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Kode Pencairan :</label>
                            <p class="form-control-static">
                                <?php if($data['kpi'] == "") { 
                                    echo '-';
                                } else { ?>
                                <span class="badge bg-dark p-2">
                                    <?= $data['kode_pencairan'] ?>
                                </span>
                                <?php } ?>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Sisa Anggaran :</label>
                            <p class="form-control-static">
                                <span class="badge bg-<?= $sisa_agr > 0 ? 'primary' : 'danger' ?> p-2">
                                    <?= rupiah_1($sisa_agr) ?>
                                </span>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">No Borang Kegiatan :</label>
                            <p class="form-control-static">
                                <?php if($data['no_borang'] == "") { 
                                    echo '-';
                                    ?>
                                <?php } else { ?>
                                <span class="badge bg-teal p-2">
                                    {{ $data['no_borang'] }}
                                </span>
                                <?php } ?>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Uraian Kegiatan RKAT :</label>
                            <p class="form-control-static" style="font-size:14px;">{{ $data['uraian'] }}</p>
                        </div>                    
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">KPI yang Dicapai :</label>
                            <p class="form-control-static" style="font-size:14px;">
                                <?php if($data['kpi'] == "") { 
                                    echo '-';
                                } else {
                                    echo $data['kpi'];
                                } ?>
                            </p>
                        </div>                    
                    </div>                        
                </div>
                <?php if($sisa_agr > 0){ ?>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Nama Kegiatan :</label>
                            <textarea name="deskripsi_kegiatan" id="deskripsi_kegiatan" cols="4" rows="4" class="form-control" required></textarea>
                        </div>                        
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Pelaksana Kegiatan :</label>
                            <select name="pelaksana_kegiatan" id="pelaksana_kegiatan" class="form-control select2" required>
                                <option value=""></option>
                                @foreach ($karyawan as $item)
                                <option value="{{ encrypt($item['nik']) }}">{{ $item['nama_lengkap'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class=" control-label " for="address2">Tanggal Kegiatan *</label>
                            <div class="">                                
                                <div>
                                    <div class="input-daterange input-group date-range">
                                        <input type="text" class="form-control" name="tgl_mulai" autocomplete="off" required />
                                        <div class="input-group-append">
                                            <span class="input-group-text bg-primary text-white b-0">s/d</span>
                                        </div>
                                        <input type="text" class="form-control" name="tgl_selesai" autocomplete="off" required />
                                    </div>                                    
                                </div>
                            </div>
                        </div>
                    </div>                    
                </div>
                <?php } ?>
            </div>
            <div class="card-footer bg-transparent">
                <button type="<?= $sisa_agr > 0 ? 'submit' : 'button' ?>" class="btn btn-primary btn-block" style="font-weight:bold;"<?= $data['sisa_anggaran'] == 0 ? ' disabled title="Maaf anggaran sudah habis"' : '' ?><?= $sisa_agr > 0 ? '' : ' disabled' ?>><i class="mdi mdi-file-plus"></i> Input Actbud</button>
            </div>
        </div>
    </div>
    <?php if($sisa_agr > 0){ ?>
    {!! form_close() !!}
    <?php } ?>
@endsection

@section('js')
<script src="{{ base_url('assets/js/select2.min.js') }}"></script>
<script src="{{ base_url('assets/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ base_url('assets/js/daterangepicker.js') }}"></script>
<script>
    $(document).ready(function(){
        $('.date-range').datepicker({
            toggleActive:!0,
            format: 'dd-mm-yyyy',
            startDate: "<?= date('d-m-Y') ?>",
        })

        $('.select2').select2({
            placeholder: "Cari pelaksana ..."
        })
    })
</script>
@endsection