<?php 
$session = $CI->session->userdata('user_sessions');
$kode_unit = $session['kode_unit'];
$jabatan = $session['kode_jabatan'];
$agr_tersisa = ($data['t_act_agr'] - $data['s_tjb_act_agr']);
$uri4 = $CI->uri->segment(4);
$uri5 = $CI->uri->segment(5);
?>


<?php $__env->startSection('title'); ?>
    History Approval - Detail Actbud
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-title'); ?>
    Detail History Approval
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="<?php echo e(base_url('assets/css/dataTables.bootstrap4.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(base_url('assets/css/responsive.bootstrap4.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(base_url('assets/css/select2.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(base_url('assets/css/bootstrap-select.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(base_url('assets/css/daterangepicker.css')); ?>">
<link rel="stylesheet" href="<?php echo e(base_url('assets/css/bootstrap-datepicker.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(base_url('assets/css/tooltipster.css')); ?>">
<link rel="stylesheet" href="<?php echo e(base_url('assets/css/custom.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item">History Approval</li>
<li class="breadcrumb-item">Detail</li>
<li class="breadcrumb-item active"><i class="mdi mdi-file-document"></i> <?php echo e(($data['jns_aju_agr'] == "actbud") ? "ACT" : "PTY"); ?>-<?php echo e($id_actbud); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<div class="col-md-12">
		<?php if($data['status_act'] != null): ?>
		<?php echo $__env->make('spa.approval.detail.status-approval', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<?php endif; ?>
		<div class="card card-border card-teal">
			<div class="card-header border-teal bg-transparent">
				<div class="float-left">
					<h3 class="card-title mb-0"><i class="mdi mdi-file-document-outline"></i> DETAIL RKAT</h3>
				</div>
				<div class="float-right">
					<?php if($data['jns_aju_agr'] == 'actbud') { ?>
					<span class="badge bg-dark p-2" style="font-weight:bold;">
						<i class="mdi mdi-checkbox-marked-circle-outline"></i> Actbud
					</span>
					<?php } else if($data['jns_aju_agr'] == 'petty cash'){ ?>
					<span class="badge bg-dark p-2" style="font-weight:bold;">
						<i class="mdi mdi-checkbox-marked-circle-outline"></i> Petty Cash
					</span>
					<?php } ?>
					<span class="badge bg-primary p-2" style="font-weight:bold;">
						<i class="mdi mdi-file-document"></i> <?php echo e($data['kode_pencairan']); ?>

					</span>
					<span class="badge bg-info p-2" style="font-weight:bold;">
						<i class="mdi mdi-clipboard-check"></i> <?php echo e(($data['jns_aju_agr'] == "actbud") ? "ACT" : "PTY"); ?>/<?php echo e($id_actbud); ?>

					</span>
					<?php switch($data['status_act']):
					case ('send'): ?>
						<span class="badge bg-success p-2">
							<i class="mdi mdi-send-check"></i> Terkirim
						</span>
						<?php break; ?>
					<?php case ('belum dikirim'): ?>
					<span class="badge bg-warning p-2">
						<i class="mdi mdi-progress-wrench"></i> Dalam Perencanaan
					</span>
					<?php break; ?>
					<?php case ('waiting_for_approval'): ?>
					<span class="badge bg-orange p-2">
						<i class="mdi mdi-progress-clock"></i> Menunggu Approval
					</span>
					<?php break; ?>
					<?php default: ?>
					<span class="badge bg-danger p-2">
						Unknown
					</span>
					<?php endswitch; ?>					
				</div>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<label for="">Prodi / Bagian / Unit</label>
							<p class="form-control-static" style="font-size: 14px;"><?php echo e($data['nama_unit']); ?></p>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="">Nama Kegiatan</label>
							<p class="form-control-static" style="font-size: 14px;"><?php echo e($data['deskrip_keg']); ?></p>
						</div>
					</div>                
					<div class="col-md-4">
						<div class="form-group">
							<label for="">KPI</label>
							<p class="form-control-static" style="font-size: 14px;"><?php echo e($data['kpi']); ?></p>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="">PIC</label>
							<p class="form-control-static">
								<span class="" style="font-size: 14px;">
									<?php echo e($data['nama_lengkap'] . ' (' . $data['pic'] . ')'); ?>

								</span>
							</p>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="">Pelaksana</label>
							<p class="form-control-static">
								<span class="" style="font-size: 14px;">
									<?php echo e($data['nama_pelaksana'] . ' (' . $data['pelaksana'] . ')'); ?>

								</span>
							</p>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="">Tanggal Pelaksanaan</label>
							<p class="form-control-static">
								<span class="badge bg-secondary p-2">
									<?php 
									$tgl_m = date_create($data['tgl_m']);									
									$tgl_s = date_create($data['tgl_s']);
									?>
									<i class="mdi mdi-calendar"></i> <?php echo e(tanggal_indo(date_format($tgl_m, "Y-m-d")) . ' s/d ' . tanggal_indo(date_format($tgl_s, "Y-m-d"))); ?>

								</span>
							</p>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="">Periode</label>
							<p class="form-control-static">
								<span class="badge bg-warning p-2">
									<?php echo e($data['periode']); ?>

								</span>
							</p>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="">Total Anggaran</label>
							<p class="form-control-static">
								<span class="badge bg-purple p-2">
									<?php echo e(rupiah_1($data['t_act_agr'])); ?>

								</span>
							</p>
						</div>
					</div>                
					<div class="col-md-4">
						<div class="form-group">
							<label for="">Tanggal Pengajuan</label>
							<p class="form-control-static">
								<?php if(!empty($data['tanggal_pembuatan'])): ?>
									<?php 
									$ex_tgl_buat = explode(' ', $data['tanggal_pembuatan']);
									?>
									<span class="badge p-2 bg-teal text-white">
										<i class="mdi mdi-clock-check-outline"></i> <?php echo e(tanggal_indo($ex_tgl_buat[0]) . ', ' . $ex_tgl_buat[1]); ?>

									</span>
								<?php else: ?>
									-
								<?php endif; ?>
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-md-12">
		<div class="card card-border card-success" id="card-rincian">
			<div class="card-header border-success bg-transparent">
				<h3 class="card-title mb-0"><i class="mdi mdi-clipboard-list-outline"></i> DETAIL BIAYA</h3>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered table-hover table-striped dataTable">
						<thead>
							<tr>
								<th class="text-center" width=50>No</th>
								<th>Nama Kegiatan</th>
								<th class="text-center">Keterangan</th>
								<th class="text-center">Total Anggaran</th>
                                <th class="text-center">Catatan Pimpinan</th>
							</tr>
						</thead>
						<tbody id="tb-rincian-kegiatan">
						<?php $__currentLoopData = $rincian_kegiatan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <th class="text-center" style="vertical-align: middle;"><?php echo e($loop->iteration); ?></th>
                                <td style="vertical-align: middle;">
                                    <span class="" style="font-size: 14px;">
                                        <?php echo e($item->jns_b); ?>

                                    </span>
                                </td>
                                <td style="vertical-align: middle;">
                                    <span class="" style="font-size: 14px;">
                                        <?php echo e($item->ket); ?>

                                    </span>
                                </td>
                                <td class="text-center" style="vertical-align: middle;">
                                    <span class="badge bg-purple p-2">
                                        <?php echo e(rupiah_1($item->aju_agr)); ?>

                                    </span>
                                </td>
                                <td style="vertical-align: middle;">
                                    <ul style="list-style: none;padding-inline-start:0;" class="mb-0">
                                        <li>
                                            <span style="font-size: 14px;">Warek 1: </span>
                                            <span style="font-size: 14px;"><?php echo e($item->c_jns_b_wr1); ?></span>
                                        </li>
                                        <li>
                                            <span style="font-size: 14px;">Warek 2: </span>
                                            <span style="font-size: 14px;"><?php echo e($item->c_jns_b_wr2); ?></span>
                                        </li>
                                        <li>
                                            <span style="font-size: 14px;">Rektor: </span>
                                            <span style="font-size: 14px;"><?php echo e($item->c_jns_b_rk); ?></span>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</tbody>
						<tfoot>
							<th></th>
							<th class="text-right" colspan="2">Total Anggaran : </th>
							<td class="text-center">
								<span class="badge bg-primary p-2">
									<?php echo e(rupiah_1($data['s_tjb_act_agr'])); ?>

								</span>
							</td>
							<td></td>
						</tfoot>
					</table>
				</div>
			</div>
		</div>

		<div class="card card-border card-info" id="card-dokumen-pendukung">
			<div class="card-header border-info bg-transparent">
				<h3 class="card-title mb-0"><i class="mdi mdi-file-multiple-outline"></i> DOKUMEN PENDUKUNG</h3>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered table-hover table-striped dataTable">
						<thead>
							<tr>
								<th class="text-center" width=50>No</th>
								<th>Nama Dokumen</th>
								<th class="text-center">Deskripsi</th>                            
								<th class="text-center">Aksi</th>
							</tr>
						</thead>
						<tbody id="tb-dokumen">
						<?php $__currentLoopData = $dokumen_pendukung; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <th class="text-center"><?php echo e($loop->iteration); ?></th>
                                <td>
                                    <a href="javascript:void(0)">
                                        <i class="mdi mdi-file"></i>
                                        <?php                                            
											echo $row->nama_file . ' ('.formatBytes($row->ukuran_file).')';;
                                        ?>
                                    </a>
                                </td>
                                <td>
                                    <?php echo e($row->deskripsi); ?>

                                </td>
                                <td class="text-center">
                                    <a href="<?php echo e(base_url('app-data/dokumen-pendukung/' . $row->nama_file)); ?>" class="btn btn-primary btn-xs" download="<?php echo e($row->nama_file); ?>">
                                        <i class="mdi mdi-download"></i>
                                    </a>
                                    <?php if($data['status_act'] == 'belum dikirim'): ?>
                                        <a href="javascript:void(0)" data-id="<?php echo e(encrypt($row->id)); ?>" data-file_name="<?php echo e($row->nama_file); ?>" class="btn btn-danger btn-xs btn-hapus-dokumen">
                                            <i class="mdi mdi-trash-can"></i>
                                        </a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</tbody>
					</table>
				</div>
			</div>
			<?php if($data['status_act'] == 'belum dikirim'): ?>
            <div class="card-footer">
                <div class="float-right">
                    <a href="javascript:void(0)" data-toggle="modal" data-target="#modal-upload-dokumen-pendukung" class="btn btn-teal btn-sm"><i class="mdi mdi-upload"></i> Upload Dokumen</a>
                </div>
            </div>
        	<?php endif; ?>
		</div>
		
		<?php echo form_open('app/sim-spa/history-approval/detail/' . $id_actbud, array('id' => 'form-pesan', 'enctype' => 'multipart/form-data', 'class' => 'myForm')); ?>		
		<div class="card card-border card-purple" id="card-chat">
			<div class="card-header border-purple bg-transparent">
				<h3 class="card-title mb-0"><i class="mdi mdi-message-text-outline"></i> PESAN</h3>
			</div>
			<div class="card-body">
				<?php if(!empty($messages)): ?>
				<div class="messages">                
                    <div class="list-group bs-ui-list-group mb-0 mr-2" id="chat-section">                   
                        <?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $reply_data = $CI->db->query("SELECT a.id_chat as id,a.nik,a.pesan,a.datetime_chat,a.attachment,a.attachment_size,b.nama_lengkap sender FROM tbl_chat_reply a 
                                INNER JOIN tbl_karyawan b ON a.nik = b.nik WHERE a.id_chat = '".$item->id_chat."' AND a.status = 'Aktif'")->result();
                            ?>
                            <div class="list-group-item" style="border-left: 2px solid rgba(0,0,0,.125);/*border-top:none;border-bottom:none;border-right:none;*/margin-bottom:10px;">
                                <div class="list-group-item-heading font-16 mt-0 mb-1 pb-1 border-bottom">
                                    <span style="font-weight: bold;">
                                        <img src="<?= base_url() ?>assets/images/user-icon.png" alt="" srcset="" width="20" style="margin-bottom: 5px;">
                                        <?php echo e($item->sender); ?>

                                    </span>                                
                                    <span style="font-size: 13px;float: right;">
                                        <i class="mdi mdi-calendar-clock"></i> <?php echo e($item->datetime_chat); ?>                                        
                                    </span>
                                </div>                                
                                <p class="list-group-item-text m-0">
                                    <?php echo e($item->pesan); ?>

                                </p>                  
                                <?php if(!empty($item->attachment)): ?>
                                    <?php
                                        $pecah_attachment = explode('_', $item->attachment);                                        
                                    ?>
                                    <div class="mt-2">
                                        <span style="font-size: 13px;">Attachment:</span>
                                        <div class="d-flex flex-row">
                                            <div style="width: 50px;height:40px;" class="border text-center">
                                                <i class="mdi mdi-file mdi-24px text-primary"></i>
                                            </div>
                                            <div class="ml-2 pt-2">
                                                <span class="text-primary"><?php echo e($pecah_attachment[1]); ?></span>
                                                <span style="font-size: 12px;color:black"><?php echo e(formatBytes($item->attachment_size)); ?></span>
                                                <a href="<?php echo e(base_url('app-data/chat-attachment/' . $item->attachment)); ?>" class="btn btn-info btn-xs" download="<?php echo e($pecah_attachment[1]); ?>"><i class="mdi mdi-download"></i> Unduh</a>
                                            </div>                    
                                        </div>                                        
                                    </div>        
                                <?php endif; ?>
                                <span style="font-size: 11px;"><?php echo e(get_time_ago(strtotime($item->datetime_chat))); ?></span>                                          
                                <br>
                                <span style="font-size: 12px;">
                                    <a href="javascript:void(0)" class="reply-chat" data-id="<?= encrypt($item->id_chat) ?>" 
                                        data-attachment="<?= $item->attachment ?>" data-sender="<?= $item->sender ?>" 
                                        data-time="<?= $item->datetime_chat ?>" data-attachment="<?= $item->attachment ?>" data-pesan="<?= $item->pesan ?>"><i class="mdi mdi-reply"></i> Reply</a>
                                    <?php if($item->nik == decrypt($_SESSION['user_sessions']['nik'])): ?>                                        
                                        <a href="javascript:void(0)" class="hapus-chat" data-id="<?= encrypt($item->id_chat) ?>" 
                                            data-attachment="<?= $item->attachment ?>" data-sender="<?= $item->sender ?>" 
                                            data-time="<?= $item->datetime_chat ?>" data-attachment="<?= $item->attachment ?>" data-pesan="<?= $item->pesan ?>"><i class="mdi mdi-trash-can"></i> Hapus</a>
                                    <?php endif; ?>
                                </span>

                                <?php if(!empty($reply_data)): ?>
                                    <br>
                                    <a href="#collapse-reply-message-<?= $item->id_chat ?>" class="showReply" data-toggle="collapse" style="font-size: 12px;">Lihat Balasan</a>
                                    <div class="collapse" id="collapse-reply-message-<?= $item->id_chat ?>">
                                        <?php $__currentLoopData = $reply_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="list-group-item mt-1" style="border-left: none;border-top:none;border-bottom:none;border-right:none;padding-bottom:0;">
                                            <div class="list-group-item-heading font-16 mt-0 mb-1 pb-1 border-bottom">                                    
                                                <span>
                                                    <img src="<?= base_url() ?>assets/images/logo/logo.png" alt="" srcset="" width="20">
                                                    <?php echo e($item->sender); ?>

                                                </span>                                
                                                <span style="font-size: 13px;float: right;">
                                                    <i class="mdi mdi-calendar-clock"></i> <?php echo e($item->datetime_chat); ?>                                        
                                                </span>
                                            </div>

                                            <p class="list-group-item-text m-0">
                                                <?php echo e($item->pesan); ?>

                                            </p>

                                            <?php if(!empty($item->attachment)): ?>
                                                <?php
                                                    $pecah_attachment = explode('_', $item->attachment);                                        
                                                ?>
                                                <div class="mt-2">
                                                    <span style="font-size: 13px;">Attachment:</span>
                                                    <div class="d-flex flex-row">
                                                        <div style="width: 50px;height:40px;" class="border text-center">
                                                            <i class="mdi mdi-file mdi-24px text-primary"></i>
                                                        </div>
                                                        <div class="ml-2 pt-2">
                                                            <span class="text-primary"><?php echo e($pecah_attachment[1]); ?></span>
                                                            <span style="font-size: 12px;color:black"><?php echo e(formatBytes($item->attachment_size)); ?></span>
                                                            <a href="<?php echo e(base_url('app-data/chat-attachment/' . $item->attachment)); ?>" class="btn btn-info btn-xs" download="<?php echo e($pecah_attachment[1]); ?>"><i class="mdi mdi-download"></i> Unduh</a>
                                                        </div>                    
                                                    </div>                                        
                                                </div>        
                                            <?php endif; ?>
                                            <span style="font-size: 11px;"><?php echo e(get_time_ago(strtotime($item->datetime_chat))); ?></span>
                                            <?php if($item->nik == decrypt($_SESSION['user_sessions']['nik'])): ?>
                                            <br>
                                            <a href="javascript:void(0)" class="hapus-chat-reply" data-id="<?= encrypt($item->id) ?>" 
                                                data-attachment="<?= $item->attachment ?>" data-sender="<?= $item->sender ?>" 
                                                data-time="<?= $item->datetime_chat ?>" data-attachment="<?= $item->attachment ?>" data-pesan="<?= $item->pesan ?>"><i class="mdi mdi-trash-can"></i> Hapus</a>
                                            <?php endif; ?>
                                        </div>                                      
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                <?php endif; ?>

                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                        
                    </div>
                </div>
				<?php else: ?>
				<div class="alert alert-info">
					<p class="mb-0"><i class="mdi mdi-exclamation"></i> Tidak ada pesan</p>
				</div>
				<?php endif; ?>
			</div>

			<input type="hidden" name="act" value="send_message">
			<div class="card-footer">
				<div class="list-group-item mb-1 d-none" id="reply-box">
					<div class="list-group-item-heading font-16 mt-0 border-bottom mb-1 pb-1">
						<img src="<?= base_url() ?>assets/images/logo/logo.png" alt="" srcset="" width="20">
						<span id="reply-from"></span>
						<div class="float-right">
							<a href="javascript:void(0)" id="close-reply"><i class="mdi mdi-close"></i></a>
						</div>
					</div>
					<p class="list-group-item-text m-0" id="reply-message"></p>                
					<input type="hidden" id="reply_id" name="reply_id">
				</div>
				<div id="detail-attachment" class="mb-2" style="display: none;">
					<div class="d-flex flex-row">
						<div style="width: 50px;height:40px;" class="border text-center">
							<i class="mdi mdi-file mdi-24px text-primary"></i>
						</div>
						<div class="ml-2 pt-2">
							<span class="text-primary" id="attachment-file-name"></span>
							<span id="attachment-file-size" style="font-size: 12px;color:black"></span>
						</div>                    
					</div>
				</div>
				<div class="input-group" id="input-pesan">                
					<input type="text" id="pesan" name="pesan" class="form-control" placeholder="Ketik pesan disini..." required>
					<span class="input-group-append">
						<span class="btn btn-secondary btn-file"><span class="mdi mdi-attachment"></span>
						<input type="file" name="attachment" id="file-chat-attachment" accept="image/png, image/jpeg, image/jpg, application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint,
						text/plain, application/pdf, image/webp"/></span>
					</span>
					<span class="input-group-append">                    
						<button type="submit" name="kirim_pesan" class="btn waves-effect waves-light btn-primary"><i class="mdi mdi-send"></i></button>
					</span>
				</div>
			</div>			
		</div>
		<?php echo form_close(); ?>

	</div>
	
	<?php echo form_open('app/sim-spa/history-approval/detail/' . $id_actbud, array('id' => 'form-pesan', 'enctype' => 'multipart/form-data', 'class' => 'myForm')); ?>	
    <!-- modal hapus pesan -->
	<input type="hidden" name="act" value="hapus_pesan">
    <div id="modal-hapus-pesan" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0">Hapus Pesan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="attachment">
                    <input type="hidden" name="id">
                    <div class="list-group bs-ui-list-group mb-0">
                        <div class="list-group-item">
                            <div class="list-group-item-heading font-16 mt-0 mb-1 pb-1 border-bottom">                                
                                <img src="<?= base_url() ?>assets/images/logo/logo.png" alt="" srcset="" width="20">
                                <span id="sender"></span>                                                      
                                <div style="font-size: 13px;float: right;">
                                    <i class="mdi mdi-calendar-clock"></i>  
                                    <span id="time"></span>                                  
                                </div>                                
                            </div>
                            <p class="list-group-item-text m-0" id="pesan"></p>
                        </div>                        
                    </div>
                    <p class="mb-0 mt-2">Apakah anda yakin ingin menghapus pesan ini?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm waves-effect" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-danger btn-sm waves-effect waves-light">Hapus</button>
                </div>
            </div>            
        </div>        
    </div>    
	<?php echo form_close(); ?>

		
	<?php echo form_open('app/sim-spa/history-approval/detail/' . $id_actbud, array('id' => 'form-pesan', 'enctype' => 'multipart/form-data', 'class' => 'myForm')); ?>	
    <!-- modal hapus pesan -->
    <div id="modal-hapus-pesan-reply" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0">Hapus Pesan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="attachment">
                    <input type="hidden" name="id">
					<input type="hidden" name="act" value="hapus_pesan_reply">
                    <div class="list-group bs-ui-list-group mb-0">
                        <div class="list-group-item">
                            <div class="list-group-item-heading font-16 mt-0 mb-1 pb-1 border-bottom">                                
                                <img src="<?= base_url() ?>assets/images/logo/logo.png" alt="" srcset="" width="20">
                                <span id="sender"></span>                                                      
                                <div style="font-size: 13px;float: right;">
                                    <i class="mdi mdi-calendar-clock"></i>  
                                    <span id="time"></span>                                  
                                </div>                                
                            </div>
                            <p class="list-group-item-text m-0" id="pesan"></p>
                        </div>                        
                    </div>
                    <p class="mb-0 mt-2">Apakah anda yakin ingin menghapus pesan ini?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm waves-effect" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-danger btn-sm waves-effect waves-light">Hapus</button>
                </div>
            </div>            
        </div>        
    </div>    
	<?php echo form_close(); ?>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script src="<?php echo e(base_url('assets/js/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(base_url('assets/js/dataTables.bootstrap4.min.js')); ?>"></script>
<script src="<?php echo e(base_url('assets/js/dataTables.responsive.min.js')); ?>"></script>
<script src="<?php echo e(base_url('assets/js/responsive.bootstrap4.min.js')); ?>"></script>
<script src="<?php echo e(base_url('assets/js/bootstrap-filestyle.min.js')); ?>"></script>
<script src="<?php echo e(base_url('assets/js/signature-pad.js')); ?>"></script>
<script>
	$(document).ready(function(){
		$('.dataTable').dataTable();

		$('#chat-section').on('click', '.reply-chat', function(event){
            $('#reply-box').removeClass('d-none')
            $('#reply-box span#reply-from').text($(this).data('sender'))
            $('#reply-box p#reply-message').text($(this).data('pesan'))
            $('#input-pesan input#pesan').attr('placeholder','Balas pesan...')
            $('#input-pesan input#pesan').attr('name','reply_pesan')
            $('#input-pesan input#file-chat-attachment').attr('name','reply_attachment')
            $('input#reply_id').val($(this).data('id'))
        })

        $('#close-reply').click(function(){
            $('#reply-box').addClass('d-none')
            $('#input-pesan input#pesan').attr('placeholder','Ketik pesan disini...')
            $('#input-pesan input#pesan').attr('name','pesan')
            $('#input-pesan input#file-chat-attachment').attr('name', 'attachment')
        })

		$('#chat-section').on('click', '.hapus-chat', function(){
            $('#modal-hapus-pesan input[name="attachment"]').val($(this).data('attachment'))
            $('#modal-hapus-pesan input[name="id"]').val($(this).data('id'))
            $('#modal-hapus-pesan span#sender').text($(this).data('sender'))
            $('#modal-hapus-pesan span#time').text($(this).data('time'))
            $('#modal-hapus-pesan p#pesan').text($(this).data('pesan'))
            $('#modal-hapus-pesan').modal('show')
        })

        $('#chat-section').on('click', '.hapus-chat-reply', function(){
            $('#modal-hapus-pesan-reply input[name="attachment"]').val($(this).data('attachment'))
            $('#modal-hapus-pesan-reply input[name="id"]').val($(this).data('id'))
            $('#modal-hapus-pesan-reply span#sender').text($(this).data('sender'))
            $('#modal-hapus-pesan-reply span#time').text($(this).data('time'))
            $('#modal-hapus-pesan-reply p#pesan').text($(this).data('pesan'))
            $('#modal-hapus-pesan-reply').modal('show')
        })

		function formatRupiah(angka, prefix){
			var number_string = angka.replace(/[^,\d]/g, '').toString(),
			split   		= number_string.split(','),
			sisa     		= split[0].length % 3,
			rupiah     		= split[0].substr(0, sisa),
			ribuan     		= split[0].substr(sisa).match(/\d{3}/gi)
 
			if(ribuan){
				separator = sisa ? '.' : ''
				rupiah += separator + ribuan.join('.')
			}
 
			rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah
			return prefix == undefined ? rupiah : (rupiah ? '' + rupiah : '')
		}

		function bytesToSize(bytes) {
            const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB']
            if (bytes === 0) return 'n/a'
                const i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)), 10)
                if (i === 0) return `${bytes} ${sizes[i]})`
                return `${(bytes / (1024 ** i)).toFixed(1)} ${sizes[i]}`
        }

		$('#file-chat-attachment').change(function(e){
            const fileName = e.target.files[0].name    
            const fileSize = e.target.files[0].size            
            $('div#detail-attachment').fadeIn()
            $('div#detail-attachment span#attachment-file-name').text(fileName)
            $('div#detail-attachment span#attachment-file-size').text(bytesToSize(fileSize))
        })
	})
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('spa.layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\upj_spa_ig\application\views/spa/approval/detail/detail-history-approval.blade.php ENDPATH**/ ?>