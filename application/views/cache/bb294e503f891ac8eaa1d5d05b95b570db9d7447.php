<?php 
$agr_tersisa = ($data['t_act_agr'] - $data['s_tjb_act_agr']);
$uri4 = $CI->uri->segment(4);
$uri5 = $CI->uri->segment(5);
?>


<?php $__env->startSection('title'); ?>
<?= MOD2 ?> <?= ($uri5 == 'input-actbud' || $uri5 == 'input-petty-cash') ? 'Input Detail Biaya' : 'Status RKAT'; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-title'); ?>
<?= ($uri5 == 'input-actbud' || $uri5 == 'input-petty-cash') ? 'Input Detail Biaya' : 'Status RKAT'; ?>
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
<li class="breadcrumb-item"><a href="javascript: void(0);">Pencairan RKAT</a></li>
<?php if($uri4 == "petty-cash"){ ?>
<li class="breadcrumb-item"><a href="javascript: void(0);">Petty Cash</a></li>
<?php if($uri5 == "status-petty-cash"): ?>
<li class="breadcrumb-item"><a href="javascript: void(0);">Status Petty Cash</a></li>
<?php endif; ?>
<?php } else if($uri4 == "actbud"){ ?>
<li class="breadcrumb-item"><a href="javascript: void(0);">Actbud</a></li>
<?php if($uri5 == "status-actbud"): ?>
<li class="breadcrumb-item"><a href="javascript: void(0);">Status Actbud</a></li>
<?php endif; ?>
<?php } ?>
<li class="breadcrumb-item active"><a href="javascript: void(0);" style="color:blueviolet;"><i class="mdi mdi-file-document"></i><?php echo e($id_actbud); ?></a></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<div class="col-md-12">
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
						
						<?php break; ?>
					<?php case ('belum dikirim'): ?>
					<span class="badge bg-warning p-2">
						<i class="mdi mdi-progress-wrench"></i> Dalam Perencanaan
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
								<?php if($data['status_act'] == 'belum dikirim'): ?>
									<th class="text-center">Aksi</th>
								<?php endif; ?>

								<?php if($data['status_act'] == 'send'): ?>
									<th class="text-center">Catatan Pimpinan</th>
								<?php endif; ?>
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
                                <?php if($data['status_act'] == 'belum dikirim'): ?>
                                    <td class="text-center" style="vertical-align: middle;">
                                        <a href="javascript:void(0)" data-id="<?php echo e(encrypt($item->id)); ?>" 
                                        data-nama_kegiatan="<?php echo e($item->jns_b); ?>" class="btn btn-danger btn-sm btn-hapus"><i class="mdi mdi-trash-can"></i></a>
                                    </td>
                                <?php endif; ?>
                                
                                <?php if($data['status_act'] == 'send'): ?>
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
                                <?php endif; ?>
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
							<?php if($data['status_act'] == 'belum dikirim'): ?>
								<td></td>
							<?php endif; ?>                        
							<?php if($data['status_act'] == 'send'): ?>
								<td></td>
							<?php endif; ?>
						</tfoot>
					</table>
				</div>
			</div>
			<?php if($data['status_act'] == 'belum dikirim'): ?>                
            <div class="card-footer">
                <div class="float-right">
                    <a href="javascript:void(0)" data-toggle="modal" data-target="#modal-buat-kegiatan" class="btn btn-primary btn-sm"><i class="mdi mdi-plus"></i> Buat Kegiatan</a>
                </div>
            </div>
        	<?php endif; ?>
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

		<?php echo form_open('app/sim-spa/pencairan-rkat/actbud/input-actbud/' . $id_uraian . '/' . $id_actbud, array('id' => 'form-pesan', 'enctype' => 'multipart/form-data', 'class' => 'myForm')); ?>

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
			<?php if($data['status_act'] == 'belum dikirim'): ?>
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
			<?php endif; ?>
		</div>
		<?php echo form_close(); ?>


		<?php 
		if ($data['status_act'] == 'belum dikirim'){
			if (empty($rincian_kegiatan)){ ?>
		<div class="card-box">
			<div class="alert alert-info">
				<p class="mb-0"><i class="mdi mdi-information-variant"></i> Sebelum submit, pastikan anda sudah mengisi detail biaya dengan benar.</p>
			</div>        
			<div class="float-right">
				<button type="submit" class="btn btn-primary btn-sm" disabled>Submit <i class="mdi mdi-send"></i></button>
			</div>
			<br>
		</div>
        <?php } else { ?>
		<?php echo form_open('app/sim-spa/pencairan-rkat/submit_rkat/' . $id_uraian . '/' . $id_actbud, array('id' => 'form-submit-actbud', 'enctype' => 'multipart/form-data')); ?>

			<div class="card-box">        
				<div class="alert alert-info">
					<p class="mb-0"><i class="mdi mdi-information-variant"></i> Sebelum submit, pastikan anda sudah mengisi detail biaya dengan benar.</p>                        
				</div>
				<div class="float-right">
					<a href="javasript:void(0)" id="btn-submit-actbud" class="btn btn-primary btn-sm btn-blo">Submit <i class="mdi mdi-send"></i></a>
				</div>
				<br>
			</div>

			<div id="modal-submit-actbud" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title mt-0">Menentukan Pre-Approval</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="form-group">
								<label for="">Pre-Approval</label>
								<select name="pre_approval" id="pre_approval" class="form-control">
									<option value="">Pilih Pre-Approval</option>                            
									<option value="006">HRD</option>
									<option value="004">ICT</option>
									<option value="003">GA</option>
									<option value="013">BKAL</option>
									<option value="016">P2M</option>
								</select>
								<span class="help-block">
									<small>
										Tentukan pre-approval (jika dibutuhkan):
										<br>
										<ul>
											<li>Permohonan Perjalanan Dinas (BPDS) harus melalui persetujuan HRD.</li>
											<li>Permohonan Pengadaan Perangkat Lunak harus melalui persetujuan ICT.</li>
											<li>Permohonan Pengadaan Sarana Prasarana harus melalui persetujuan GA.</li>
											<li>Permohonan Kemahasiswaan harus melalui persetujuan BKAL.</li>
											<li>Permohonan P2M harus melalui persetujuan P2M.</li>
										</ul>
									</small>
								</span>
							</div>
							<?php if($agr_tersisa > 0): ?>
								<div class="alert alert-info">
									<p class="mb-0">
										Anggaran masih tersisa <b><?php echo e(rupiah_1($agr_tersisa)); ?></b>, apakah anda yakin ingin tetap melakukan submit?                                                                                        
									</p>               
								</div>                                    
							<?php else: ?>                                
							<b>Catatan</b>: setelah submit anda sudah tidak dapat lagi melakukan perubahan. 
							<?php endif; ?>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary btn-sm waves-effect" data-dismiss="modal">Tutup</button>
							<button type="button" data-dismiss="modal" data-toggle="modal" data-target="#modal-submit-final" class="btn btn-primary btn-sm waves-effect waves-light">Submit <i class="mdi mdi-send"></i></button>
						</div>
					</div>                        
				</div>                    
			</div>

			<div id="modal-submit-final" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title mt-0">Submit Actbud</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<b>Catatan</b>: setelah submit anda sudah tidak dapat lagi melakukan perubahan. 
							<br><br>
							<div class="form-group">
								<label for="">Silakan Tanda Tangan dibawah ini:</label>
								<div class="signature-pad" id="signature-pad">
									<div class="m-signature-pad">
										<div class="m-signature-pad-body">
											<canvas width="560" height="253"></canvas>
										</div>
									</div>
									<div class="m-signature-pad-footer">
										<button type="button" data-action="clear" class="btn btn-danger btn-sm mt-2"><i class="mdi mdi-trash-can"></i>
											Bersihkan</button>
									</div>
								</div>
							</div>
						</div>
						<input type="hidden" name="act" value="submit_rkat">
						<input type="hidden" name="signature">
						<div class="modal-footer">
							<button type="button" data-dismiss="modal" class="btn btn-secondary btn-sm waves-light waves-effect">
								Batal
							</button>
							<button type="submit" class="btn btn-primary btn-sm waves-light waves-effect">
								Submit <i class="mdi mdi-send"></i>
							</button>
						</div>
					</div>
				</div>
			</div>
		<?php echo form_close(); ?>

		<?php 
			}
		}
		?>

	</div>

	<?php if($data['status_act'] == 'belum dikirim'): ?>
	<?php echo form_open(base_url('app/sim-spa/pencairan-rkat/actbud/input-actbud/' . $id_uraian . '/' . $id_actbud . '/upload-dokumen-pendukung'), array('enctype' => 'multipart/form-data', 'class' => 'myForm')); ?>

	<div id="modal-upload-dokumen-pendukung" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0"> Upload Dokumen Pendukung</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Dokumen</label>
                        <input type="file" name="dokumen" id="dokumen" class="filestyle" required>
                        <span class="help-block"><small>Silakan upload dokumen pendukung.</small></span>
                    </div>
                    <div class="form-group">
                        <label for="">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" class="form-control" cols="3" rows="3" required></textarea>
                        <span class="help-block"><small>Tuliskan deskripsi dokumen.</small></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm waves-effect" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light"><i class="mdi mdi-upload"></i> Upload Dokumen</button>
                </div>
            </div>        
        </div>        
    </div>
	<?php echo form_close(); ?>


	<?php echo form_open('app/sim-spa/pencairan-rkat/actbud/input-actbud/' . $id_uraian . '/' . $id_actbud . '/hapus-dokumen-pendukung', array('class' => 'myForm')); ?>

	<div id="modal-hapus-dokumen-pendukung" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0">Hapus Dokumen Pendukung</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">        
                    <input type="hidden" name="id">            
                    <input type="hidden" name="file_name">
                    <p class="mb-0 mt-0">Apakah anda yakin ingin menghapus dokumen ini? <span id="detail" style="font-weight: bold;"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm waves-effect" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-danger btn-sm waves-effect waves-light">Hapus</button>
                </div>
            </div>            
        </div>        
    </div>
	<?php echo form_close(); ?>


	<?php echo form_open('app/sim-spa/pencairan-rkat/actbud/input-actbud/' . $id_uraian . '/' . $id_actbud, array('class' => 'myForm', 'autocomplete' => 'off')); ?>

	<div class="modal fade" id="modal-buat-kegiatan" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title mt-0">Buat Rincian Kegiatan</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<input type="hidden" name="act" value="buat_rincian_kegiatan">
					<div class="form-group">
						<label for="">Nama Kegiatan</label>
						<input type="text" name="nama_kegiatan" id="nama_kegiatan" class="form-control" required>
						<span class="help-block"><small>Masukan nama kegiatan.</small></span>
					</div>
					<div class="form-group">
						<label for="">Keterangan Kegiatan</label>
						<textarea name="keterangan" id="keterangan" cols="3" rows="3" class="form-control" required></textarea>
						<span class="help-block"><small>Masukan keterangan kegiatan.</small></span>
					</div>
					<label for="">Total Anggaran</label>
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text">Rp. </span>
						</div>
						<input type="text" id="total_anggaran" name="total_anggaran" class="form-control" placeholder="" required>
					</div>
					<span class="help-block"><small>Masukan total anggaran kegiatan (tersisa: <?= rupiah_1($agr_tersisa) ?>).</small></span>
				</div>
				<div class="modal-footer">
					<button type="button" data-dismiss="modal" class="btn btn-danger btn-sm">Batal</button>
					<button type="submit" name="buat_rincian_kegiatan" class="btn btn-primary btn-sm">Buat Kegiatan</button>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- /.modal -->
	<?php echo form_close(); ?>


	<?php echo form_open('app/sim-spa/pencairan-rkat/actbud/input-actbud/' . $id_uraian . '/' . $id_actbud, array('class' => 'myForm')); ?>

    <div id="modal-hapus-rincian-kegiatan" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0">Hapus Kegiatan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
					<input type="hidden" name="act" value="delete_rincian_kegiatan">
                    <input type="hidden" name="id">                                
                    <p class="mb-0 mt-0">Apakah anda yakin ingin kegiatan ini? <span id="detail" style="font-weight: bold;"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm waves-effect" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-danger btn-sm waves-effect waves-light">Hapus</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
	<?php echo form_close(); ?>


	<?php echo form_open('app/sim-spa/pencairan-rkat/actbud/input-actbud/' . $id_uraian . '/' . $id_actbud, array('class' => 'myForm')); ?>

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


	<?php echo form_open('app/sim-spa/pencairan-rkat/actbud/input-actbud/' . $id_uraian . '/' . $id_actbud, array('class' => 'myForm')); ?>

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


	<?php endif; ?>
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
		$('.dataTable').dataTable()
		
		<?php if($data['status_act'] == 'belum dikirim'): ?>

		var wrapper = document.getElementById("signature-pad"),
        clearButton = wrapper.querySelector("[data-action=clear]"),
        saveButton = wrapper.querySelector("[data-action=save]"),
        canvas = wrapper.querySelector("canvas"),
        signaturePad


        function resizeCanvas() {
            var ratio =  window.devicePixelRatio || 1
            canvas.width = canvas.offsetWidth * ratio
            canvas.height = canvas.offsetHeight * ratio
            canvas.getContext("2d").scale(ratio, ratio)
        }

        signaturePad = new SignaturePad(canvas)
        clearButton.addEventListener("click", function (event) {
            signaturePad.clear()
        })

		$('form#form-submit-actbud').submit(function(){
            let inp_sig = $('input[type="hidden"][name="signature"]').val(signaturePad.toDataURL())
            $('button[type="submit"]')
            .attr('disabled', true)
            .addClass('disabled')
            .html('<i class="mdi mdi-spin mdi-loading"></i>')
        })

		$('#tb-dokumen').on('click', '.btn-hapus-dokumen', function(){
            $('#modal-hapus-dokumen-pendukung input[name="file_name"]').val($(this).data('file_name'))
            $('#modal-hapus-dokumen-pendukung input[name="id"]').val($(this).data('id'))
            $('#modal-hapus-dokumen-pendukung').modal('show')
        })

		var rupiah = document.getElementById('total_anggaran');        
        
		rupiah.addEventListener('keyup', function(e){			            
			rupiah.value = formatRupiah(this.value, '')
		})
		
		$('#total_anggaran').on('input propertychange paste', function (e) {
            let val = $(this).val()
            let reg = /^0/gi
            if (val.match(reg)) {
                $(this).val(val.replace(reg, ''))
            }                                     
        })
		
		$('#tb-rincian-kegiatan').on('click', '.btn-hapus', function(){
            const data = {
                id: $(this).data('id'),
                nama_kegiatan: $(this).data('nama_kegiatan')
            }

            $('#modal-hapus-rincian-kegiatan').modal('show')
            $('#modal-hapus-rincian-kegiatan input[name="id"]').val(data.id)
            $('#modal-hapus-rincian-kegiatan span#detail').text(data.nama_kegiatan)
        })

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

		$('#btn-submit-actbud').click(function(){
            $('#modal-submit-actbud').modal('show')
        })
		<?php endif; ?>

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
<?php echo $__env->make('spa.layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp_php_7\htdocs\hibah_upj\application\views/spa/pencairan_rkat/detail/v_detail_actbud_petty_cash.blade.php ENDPATH**/ ?>