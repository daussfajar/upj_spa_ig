@extends('ig.layouts.user')

@section('title', 'Detail Pemberitahuan')

@section('page-title')
    <a href="{{ $_SERVER['HTTP_REFERER'] }}" class=""><i class="mdi mdi-arrow-left"></i></a> Detail Pemberitahuan
@endsection

@section('breadcrumb')

@endsection

@section('content')
    <?php 
    $id = filter_var($CI->uri->segment(3), FILTER_SANITIZE_NUMBER_INT);
    $session = $CI->session->userdata('user_sessions');
    $nik = decrypt($session['nik']);
    $nama = $_SESSION['user_sessions']['nama_lengkap'];
    $getNotif = $CI->db->query("SELECT a.id,a.user_name,a.url,a.item_id,a.owner_user_id,a.user_id,a.is_seen,a.title,
	a.date_created,a.message,a.color, a.icon FROM ig_tbl_notifikasi a WHERE a.id = '$id' AND (a.owner_user_id = '$nik' OR a.user_id = '$nik') 
    AND a.status = 'Aktif'")->row();;
    if($getNotif->user_name == $nama){
		$getNotif->user_name = 'Anda';
	}
    ?>    
    <div class="col-md-12">
        <div class="card-box">
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th width=250>Notifikasi</th>
                        <td width=30>:</td>
                        <td>{{ $getNotif->title }}</td>
                    </tr>
                    <tr>
                        <th>Pesan</th>
                        <td>:</td>
                        <td>{{ $getNotif->user_name }} {!! $getNotif->message == '' ? '-' : $getNotif->message !!}</td>
                    </tr>
                    <tr>
                        <th>Waktu</th>
                        <td>:</td>
                        <td>
                            @php
                                $waktu = $getNotif->date_created;
                                $tanggal = substr($waktu, 0, 10);
                                $jam = substr($waktu, 10, 9);
                                echo tanggal_indo($tanggal).', '.$jam.' <span class="text-info" style="font-size:12px;">('.get_time_ago(strtotime($waktu)).')</span>';
                            @endphp
                        </td>
                    </tr>                    
                </table>
            </div>
        </div>
    </div>
@endsection