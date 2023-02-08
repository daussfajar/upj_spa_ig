@php
	$nik = decrypt($_SESSION['user_sessions']['nik']);
	$nama = $_SESSION['user_sessions']['nama_lengkap'];
	$getNotif = $CI->db->query("SELECT a.id,a.user_name,a.owner_user_id,a.user_id,a.is_seen,a.title,
	a.date_created,a.message,a.color, a.icon FROM ig_tbl_notifikasi a WHERE (a.owner_user_id = '$nik' OR a.user_id = '$nik') AND a.status = 'Aktif' ORDER BY a.is_seen DESC, a.date_created DESC")->result();
	$countNotif = $CI->db->query("SELECT COUNT(a.id) total FROM ig_tbl_notifikasi a WHERE a.is_seen = 'no' AND (a.owner_user_id = '$nik' OR a.user_id = '$nik') AND a.status = 'Aktif'")->row_array();
@endphp
<li class="dropdown notification-list">
	<a class="nav-link dropdown-toggle  waves-effect" data-toggle="dropdown" href="#" role="button"
		aria-haspopup="false" aria-expanded="false">
		<i class="mdi mdi-bell noti-icon"></i>
		<span class="badge badge-success rounded-circle noti-icon-badge">{{ $countNotif['total'] > 99 ? '99+' : $countNotif['total'] }}</span>
	</a>
	<div class="dropdown-menu dropdown-menu-right dropdown-lg">

		<!-- item-->
		<div class="dropdown-item noti-title">
			<h5 class="font-16 m-0">
				<span class="float-right">
					<a href="{{ base_url('app/hapus-semua-pemberitahuan') }}" class="text-dark">
						<small>Hapus Semua</small>
					</a>
				</span>Pemberitahuan
			</h5>
		</div>
		<style>
			.bg-unseen_notif{
				background: #fcf8e3;
			}
		</style>
		<div class="slimscroll noti-scroll">
			@foreach (array_slice($getNotif, 0, 5) as $item)
				@php
					$waktu = $item->date_created;
					$tanggal = substr($waktu, 0, 10);
					$jam = substr($waktu, 10, 9);
					if($item->user_name == $nama){
						$item->user_name = 'Anda';
					}

				@endphp
				<a href="{{ base_url('app/detail-pemberitahuan/' . $item->id) }}" class="dropdown-item notify-item {{ $item->is_seen == 'no' ? 'bg-unseen_notif' : '' }}">
					<div class="notify-icon bg-{{ $item->color }}">
						<i class="mdi {{ $item->icon }}"></i>
					</div>
					<p class="notify-details">{{ $item->title }}
						<small class="text-muted">{!! $item->message .'<span style="font-size:11px">'.tanggal_indo($tanggal).', '.$jam.'</span>'  !!}</small>
					</p>
				</a>
			@endforeach
		</div>

		<!-- All-->
		<a href="{{ base_url('app/data-pemberitahuan') }}" class="dropdown-item text-center text-primary notify-item notify-all">
			Lihat Semua Pemberitahuan
			<i class="fi-arrow-right"></i>
		</a>

	</div>
</li>
