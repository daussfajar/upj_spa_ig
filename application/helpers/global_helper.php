<?php 

if (!defined("BASEPATH")) exit("No direct script access allowed");

if(!function_exists('get_time_ago')){
    function get_time_ago($time){
        $time_difference = time() - $time;

        if (
            $time_difference < 1
        ) {
            return 'less than 1 second ago';
        }
        $condition = array(
            12 * 30 * 24 * 60 * 60 =>   'tahun',
            30 * 24 * 60 * 60       =>  'bulan',
            24 * 60 * 60            =>  'hari',
            60 * 60                 =>  'jam',
            60                      =>  'menit',
            1                       =>  'detik'
        );

        foreach ($condition as $secs => $str) {
            $d = $time_difference / $secs;

            if ($d >= 1) {
                $t = round($d);
                return 'Sekitar ' . $t . ' ' . $str . ($t > 1 ? '' : '') . ' yang lalu';
            }
        }
    }
}

if(!function_exists('generateRandomString')){
	function generateRandomString($length)
	{
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
}

if (!function_exists('formatBytes')) {
	function formatBytes($size, $precision = 2)
	{
		$base = log($size, 1024);
		$suffixes = array('', 'Kb', 'Mb', 'Gb', 'Tb');

		return round(pow(1024, $base - floor($base)), $precision) . ' ' . $suffixes[floor($base)];
	}
}

if (!function_exists('rupiah')) {
	function rupiah($angka){
		$hasil_rupiah = "Rp " . number_format($angka, 2, ',', '.');
		return $hasil_rupiah;
	}
}

if (!function_exists('rupiah_1')) {
    function rupiah_1($angka)
    {
        $hasil_rupiah = "Rp. " . number_format($angka, 2, ',', '.');
        return $hasil_rupiah;
    }
}

if (!function_exists('pr')) {
	function pr($data, $type = null){
		echo '<pre>';
		$type == null ? print_r($data) : "";
		$type == 'print' ? print_r($data) : "";
		$type == 'dump' ? var_dump($data) : "";
		echo '</pre>';
		return exit;
	}
}

if(!function_exists('tanggal_indo')){
    function tanggal_indo($tanggal, $cetak_hari = false){
        $hari = array ( 1 =>    'Senin',
                    'Selasa',
                    'Rabu',
                    'Kamis',
                    'Jumat',
                    'Sabtu',
                    'Minggu'
                );
                
        $bulan = array (1 =>   'Januari',
                    'Februari',
                    'Maret',
                    'April',
                    'Mei',
                    'Juni',
                    'Juli',
                    'Agustus',
                    'September',
                    'Oktober',
                    'November',
                    'Desember'
                );
        $split 	  = explode('-', $tanggal);
        $tgl_indo = $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
        
        if ($cetak_hari) {
            $num = date('N', strtotime($tanggal));
            return $hari[$num] . ', ' . $tgl_indo;
        }
        return $tgl_indo;
    }
}

if(!function_exists('tanggal_indo_singkat')){
    function tanggal_indo_singkat($tanggal, $cetak_hari = false){
        $hari = array ( 1 =>    'Senin',
                    'Sel',
                    'Rab',
                    'Kam',
                    'Jum',
                    'Sab',
                    'Min'
                );
                
        $bulan = array (1 =>   'Januari',
                    'Feb',
                    'Mar',
                    'Apr',
                    'Mei',
                    'Jun',
                    'Jul',
                    'Agu',
                    'Sep',
                    'Okt',
                    'Nov',
                    'Des'
                );
        $split 	  = explode('-', $tanggal);
        $tgl_indo = $split[2] . '-' . $bulan[ (int)$split[1] ] . '-' . substr($split[0], 2);
        
        if ($cetak_hari) {
            $num = date('N', strtotime($tanggal));
            return $hari[$num] . ', ' . $tgl_indo;
        }
        return $tgl_indo;
    }
}

if(!function_exists('get_client_ip')){
    function get_client_ip() {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
           $ipaddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }
}

if (!function_exists('check_base64_image')) {
    function check_base64_image($data)
    {
        try {
            $binary = base64_decode(explode(',', $data)[1]);
            $data = getimagesizefromstring($binary);
        } catch (\Exception $e) {
            return false;
        }

        $allowed = ['image/jpeg', 'image/png', 'image/jpg'];

        if (!$data) {
            return false;
        }

        $extension = explode('/', $data['mime']);

        if (!empty($data[0]) && !empty($data[0]) && !empty($data['mime'])) {
            if (in_array($data['mime'], $allowed)) {
                return true;
            }
        }

        return false;
    }
}

?>