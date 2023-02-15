@extends('ig.layouts.user')

@section('title', 'Profil Saya')

@section('page-title')
    Profil Saya
@endsection

@section('css')
@endsection

@section('breadcrumb')
<li class="breadcrumb-item active"><a href="javascript: void(0);"><i class="mdi mdi-account-circle"></i> Profil Saya</a></li>
@endsection

@section('content')
    <div class="col-md-12">
        <div>
            <div class="text-center my-5">
                <img src="{{ base_url('assets/images/gif/animate-rocket-color.gif') }}" alt="" height="180">
                <h2 class="home-text text-uppercase text-danger">Site is Under Maintenance</h2>
                <p class="text-muted">We're making the system more awesome.we'll be back shortly.</p>
            </div>
        </div>
    </div>
@endsection