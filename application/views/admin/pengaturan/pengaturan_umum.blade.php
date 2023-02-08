@extends('layouts.user')

@section('title', 'Pengaturan - Umum')

@section('page-title')
    Pengaturan Umum
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="javascript: void(0);"><i class="mdi mdi-cogs"></i> Pengaturan</a></li>
<li class="breadcrumb-item active"><a href="javascript: void(0);">Umum</a></li>
@endsection

@section('content')
    <div class="col-md-12">
        {!! form_open() !!}
        <div class="card-box">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="col-md-4 control-label">Judul Situs Web</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" value="" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 control-label">Email Pengelola Web</label>
                        <div class="col-md-8">
                            <input type="email" class="form-control" value="" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-10 offset-2">
                    <button type="submit" class="btn btn-primary btn-xs"><i class="mdi mdi-content-save"></i> Simpan</button>
                </div>
            </div>
        </div>
        {!! form_close() !!}

        <div class="card-box">
            <h5 class="mt-0 mb-3">
                <i class="mdi mdi-database"></i> Database
            </h5>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="" class="col-md-4 control-label">Backup</label>
                        <div class="col-md-8">
                            <a href="{{ base_url('app/admin/system/backup_db') }}" class="btn btn-primary btn-xs">
                                <i class="mdi mdi-database-export"></i> Backup Database
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection