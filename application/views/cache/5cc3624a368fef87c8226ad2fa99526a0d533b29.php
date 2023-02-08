

<?php $__env->startSection('title', 'Detail Pemberitahuan'); ?>

<?php $__env->startSection('page-title'); ?>
    <a href="<?php echo e($_SERVER['HTTP_REFERER']); ?>" class=""><i class="mdi mdi-arrow-left"></i></a> Detail Pemberitahuan
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
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
                        <td><?php echo e($getNotif->title); ?></td>
                    </tr>
                    <tr>
                        <th>Pesan</th>
                        <td>:</td>
                        <td><?php echo e($getNotif->user_name); ?> <?php echo $getNotif->message == '' ? '-' : $getNotif->message; ?></td>
                    </tr>
                    <tr>
                        <th>Waktu</th>
                        <td>:</td>
                        <td>
                            <?php
                                $waktu = $getNotif->date_created;
                                $tanggal = substr($waktu, 0, 10);
                                $jam = substr($waktu, 10, 9);
                                echo tanggal_indo($tanggal).', '.$jam.' <span class="text-info" style="font-size:12px;">('.get_time_ago(strtotime($waktu)).')</span>';
                            ?>
                        </td>
                    </tr>                    
                </table>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\hibah_upj\application\views/users/pemberitahuan/detail.blade.php ENDPATH**/ ?>