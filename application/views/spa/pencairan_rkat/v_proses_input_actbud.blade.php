<?php
$session = $CI->session->userdata('user_sessions');
?>
@extends('spa.layouts.user')

@section('title')
    <?= MOD2 ?> Pencairan RKAT - Input Acbud - {{ $data['uraian'] }}
@endsection

@section('page-title')
    <a href="{{ !empty($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : base_url('app/sim-spa/pencairan-rkat/input-actbud') }}"><i class="mdi mdi-arrow-left"></i></a> Input Actbud
@endsection

@section('css')
<link rel="stylesheet" href="{{ base_url('assets/css/select2.min.css') }}">
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="javascript: void(0);">Pencairan RKAT</a></li>
<li class="breadcrumb-item"><a href="javascript: void(0);">Input Actbud</a></li>
<li class="breadcrumb-item active"><a href="javascript: void(0);">{{ $data['kode_pencairan'] }}</a></li>
@endsection

@section('content')
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
                                <span class="badge bg-primary p-2">
                                    <?= rupiah_1($data['sisa_anggaran']) ?>
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
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Nama Kegiatan :</label>
                            <textarea name="" id="" cols="3" rows="3" class="form-control" required></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Pelaksana Kegiatan :</label>
                            <select name="" id="" class="form-control select2" required>
                                <option value=""></option>
                                @foreach ($karyawan as $item)
                                <option value="{{ encrypt($item['nik']) }}">{{ $item['nama_lengkap'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-transparent">
                <button type="submit" class="btn btn-primary btn-block" style="font-weight:bold;"><i class="mdi mdi-file-plus"></i> Input Actbud</button>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script src="{{ base_url('assets/js/select2.min.js') }}"></script>
<script>
    $(document).ready(function(){
        $('.select2').select2({
            placeholder: "Cari pelaksana ..."
        })
    })
</script>
@endsection