<div class="card card-timeline px-2 border-none">
    <ul class="bs4-order-tracking" id="approval_tracking">
        <li class="step <?php 
            if($data->st_kabag == 'Y' || $data->st_kabag == 'N'){
                echo 'active';
            }
            ?>">
            <div <?php echo $data->st_kabag == 'Y' || $data->st_kabag == 'N' ? 'data-penyetuju="'.$data->nama_kabag.'" data-st="'.$data->st_kabag.'" data-approval="Approval Ka. Prodi/Unit" data-catatan="'.$data->c_kabag.'" data-stamp="'.substr($data->stamp_kabag, 0, 19).'" data-toggle="tooltip" data-placement="top" title="" data-original-title="Klik untuk melihat detail" class="appvd"' : ''; ?>>
                <i class="<?php 
                    if($data->st_kabag == ''){
                        echo 'mdi mdi-check-bold';
                    } else if($data->st_kabag !== '' && $data->st_kabag == 'Y'){
                        echo 'mdi mdi-check-bold';
                    } else if($data->st_kabag !== '' && $data->st_kabag == 'N'){
                        echo 'mdi mdi-close-thick';
                    }
                    ?>"></i>
            </div> Ka. Prodi/Unit
            <?php if($data->st_kabag !== ''): ?>
                <br>
                <span style="font-size: 11px;color:">
                <?php switch($data->st_kabag):
                    case ('Y'): ?>
                        <i class="mdi mdi-check"></i> Disetujui <br> <i class="mdi mdi-calendar-check"></i> <?php echo e(substr($data->stamp_kabag, 0, 19)); ?>

                        <?php break; ?>
                    <?php case ('N'): ?>
                        Ditolak
                        <br><i class="mdi mdi-calendar"></i> <?php echo e(substr($data->stamp_kabag, 0, 19)); ?>

                        <?php break; ?>
                    <?php default: ?>
                        Menunggu
                <?php endswitch; ?>
                </span>
            <?php endif; ?>
        </li>
        <li class="step <?php 
        if($data->sign != "" && $data->st_sign == "Y"){
            echo "active";
        } else if($data->sign == "" && ($data->st_sign == "Y" || $data->st_sign == "N")){
            echo "active";
        } else if($data->sign != "" && $data->st_sign == "N"){
            echo "active";
        } else if($data->sign == "" && $data->st_keu != "N"){
            echo "active";
        }
        ?>">
            <div <?php 
            if($data->sign != "" && $data->st_sign == "Y" || $data->st_sign == "N"){
                echo 'data-penyetuju="'.$data->nama_sign.'" data-st="'.$data->st_sign.'" data-approval="Pre-Approval ('.$data->unit_pre_approval.')" data-catatan="'.$data->c_sign.'" data-stamp="'.$data->stamp_sign.'" data-toggle="tooltip" data-placement="top" title="" data-original-title="Klik untuk melihat detail" class="appvd"';
            }?>>
                <i class="<?php 
                    if($data->st_sign == ''){
                        echo 'mdi mdi-check-bold';
                    } else if($data->st_sign !== '' && $data->st_sign == 'Y'){
                        echo 'mdi mdi-check-bold';
                    } else if($data->st_sign !== '' && $data->st_sign == 'N'){
                        echo 'mdi mdi-close-thick';
                    }
                    ?>"></i>
            </div> 
            Pre-Approval <?php echo $data->sign != "" ? '('.$data->unit_pre_approval.')' : ''; ?>

            <?php if($data->st_sign !== ''): ?>
                <br>
                <span style="font-size: 11px;color:">
                <?php switch($data->st_sign):
                    case ('Y'): ?>
                        <?php echo $data->sign != "" ? '<i class="mdi mdi-check"></i> Disetujui <br><i class="mdi mdi-calendar-check"></i> ' . substr($data->stamp_sign, 0, 19) : '(Tidak ada Pre-Approval)'; ?>

                        <?php break; ?>
                    <?php case ('N'): ?>
                        <?php echo $data->sign != "" ? 'Ditolak<br><i class="mdi mdi-calendar"></i> ' . substr($data->stamp_sign, 0, 19) : '(Tidak ada Pre-Approval)'; ?>							
                        <?php break; ?>
                    <?php default: ?>
                         <?php echo $data->sign != "" ? "Menunggu" : "(Tidak ada Pre-Approval)"; ?>

                <?php endswitch; ?>
                </span>
            <?php endif; ?>
        </li>
        <li class="step <?php 
            if($data->st_keu == 'Y' || $data->st_keu == 'N'){
                echo 'active';
            }
            ?>">
            <div <?php echo $data->st_keu == 'Y' || $data->st_keu == 'N' ? 'data-penyetuju="'.$data->nama_keu.'" data-st="'.$data->st_keu.'" data-approval="Approval Keuangan" data-catatan="'.$data->c_keu.'" data-stamp="'.$data->stamp_keu.'" data-toggle="tooltip" data-placement="top" title="" data-original-title="Klik untuk melihat detail" class="appvd"' : ''; ?>>
                <i class="<?php 
                    if($data->st_keu == ''){
                        echo 'mdi mdi-check-bold';
                    } else if($data->st_keu !== '' && $data->st_keu == 'Y'){
                        echo 'mdi mdi-check-bold';
                    } else if($data->st_keu !== '' && $data->st_keu == 'N'){
                        echo 'mdi mdi-close-thick';
                    }
                    ?>"></i>
            </div> Keuangan 
            <?php if($data->st_keu !== ''): ?>
                <br>
                <span style="font-size: 11px;color:">
                <?php switch($data->st_keu):
                    case ('Y'): ?>
                        <i class="mdi mdi-check"></i> Disetujui <br><i class="mdi mdi-calendar-check"></i> <?php echo e(substr($data->stamp_keu, 0, 19)); ?>

                        <?php break; ?>
                    <?php case ('N'): ?>
                        Ditolak
                        <br><i class="mdi mdi-calendar"></i> <?php echo e(substr($data->stamp_keu, 0, 19)); ?>

                        <?php break; ?>
                    <?php default: ?>
                        Menunggu
                <?php endswitch; ?>
                </span>
            <?php endif; ?>
        </li>
        <li class="step <?php 
            if($data->st_warek_1 == 'Y' || $data->st_warek_1 == 'N'){
                echo 'active';
            }
            ?>">
            <div <?php echo $data->st_warek_1 == 'Y' || $data->st_warek_1 == 'N' ? 'data-penyetuju="'.$data->nama_warek_1.'" data-st="'.$data->st_warek_1.'" data-approval="Approval Warek 1" data-catatan="'.$data->c_warek1.'" data-stamp="'.$data->stamp_warek1.'" data-toggle="tooltip" data-placement="top" title="" data-original-title="Klik untuk melihat detail" class="appvd"' : ''; ?>>
                <i class="<?php 
                    if($data->st_warek_1 == ''){
                        echo 'mdi mdi-check-bold';
                    } else if($data->st_warek_1 !== '' && $data->st_warek_1 == 'Y'){
                        echo 'mdi mdi-check-bold';
                    } else if($data->st_warek_1 !== '' && $data->st_warek_1 == 'N'){
                        echo 'mdi mdi-close-thick';
                    }
                    ?>"></i>
            </div> Warek 1 
            <?php if($data->st_warek_1 !== ''): ?>
                <br>
                <span style="font-size: 11px;color:">
                <?php switch($data->st_warek_1):
                    case ('Y'): ?>
                        <i class="mdi mdi-check"></i> Disetujui <br><i class="mdi mdi-calendar-check"></i> <?php echo e(substr($data->stamp_warek1, 0, 19)); ?>

                        <?php break; ?>
                    <?php case ('N'): ?>
                        Ditolak
                        <br><i class="mdi mdi-calendar"></i> <?php echo e(substr($data->stamp_warek1, 0, 19)); ?>

                        <?php break; ?>
                    <?php default: ?>
                        Menunggu
                <?php endswitch; ?>
                </span>
            <?php endif; ?>
        </li>
        <li class="step <?php 
            if($data->st_warek_2 == 'Y' || $data->st_warek_2 == 'N'){
                echo 'active';
            }
            ?>">
            <div <?php echo $data->st_warek_2 == 'Y' ? 'data-penyetuju="'.$data->nama_warek_2.'" data-st="'.$data->st_warek_2.'" data-approval="Approval Warek 2" data-catatan="'.$data->c_warek2.'" data-stamp="'.$data->stamp_warek2.'" data-toggle="tooltip" data-placement="top" title="" data-original-title="Klik untuk melihat detail" class="appvd"' : ''; ?>>
                <i class="<?php 
                    if($data->st_warek_2 == ''){
                        echo 'mdi mdi-check-bold';
                    } else if($data->st_warek_2 !== '' && $data->st_warek_2 == 'Y'){
                        echo 'mdi mdi-check-bold';
                    } else if($data->st_warek_2 !== '' && $data->st_warek_2 == 'N'){
                        echo 'mdi mdi-close-thick';
                    }
                    ?>"></i>
            </div> Warek 2 
            <?php if($data->st_warek_2 !== ''): ?>
                <br>
                <span style="font-size: 11px;color:">
                <?php switch($data->st_warek_2):
                    case ('Y'): ?>
                        <i class="mdi mdi-check"></i> Disetujui <br><i class="mdi mdi-calendar-check"></i> <?php echo e(substr($data->stamp_warek2, 0, 19)); ?>

                        <?php break; ?>
                    <?php case ('N'): ?>
                        Ditolak
                        <br><i class="mdi mdi-calendar"></i> <?php echo e(substr($data->stamp_warek2, 0, 19)); ?>

                        <?php break; ?>
                    <?php default: ?>
                        Menunggu
                <?php endswitch; ?>
                </span>
            <?php endif; ?>
        </li>
    </ul>	        
</div>

<!-- modal detail approval -->
<div id="modal-detail-approved" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title mt-0" id="modal-detail-approved-title"></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="form-group mb-0 row">
					<label for="" class="col-md-2">Assign</label>
					<p class="form-control-static col-md-10 mb-0 pb-0" id="">
						: <span class="badge badge-info"><span class="" id="penyetuju"></span></span>
					</p>
				</div>
				<div class="form-group row mb-0">
					<label for="" class="col-md-2">Status</label>
					<p class="form-control-static col-md-10 mb-0 pb-0" id="">
						: <span class="" id="status"></span>
					</p>
				</div>
				<div class="form-group mb-0 row">
					<label for="" class="col-md-2">Tanggal</label>
					<p class="form-control-static col-md-10 mb-0 pb-0" id="tgl_disetujui"></p>
				</div>
				<div class="form-group row">
					<label for="" class="col-md-2">Catatan</label>
					<p class="form-control-static col-md-10 mb-0 pb-0" id="catatan"></p>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary btn-sm waves-effect" data-dismiss="modal">Tutup</button>                    
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal --><?php /**PATH C:\xampp\htdocs\hibah_upj\application\views/users/hibah/tracker_status_actbud.blade.php ENDPATH**/ ?>