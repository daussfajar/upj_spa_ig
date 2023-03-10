<?php
$session = $CI->session->userdata('user_sessions'); ?>
 
<?php $__env->startSection('title'); ?> RKAT - ACTBUD <?php $__env->stopSection(); ?>
<?php $__env->startSection('page-title'); ?> Actbud <?php $__env->stopSection(); ?> <?php $__env->startSection('css'); ?> <?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item ">
	<a href="javascript: void(0);">Actbud</a>
</li>
<li class="breadcrumb-item active"><a href="<?php echo e(base_url('app/sim-spa/actbud')); ?>"> View Actbud</a></li>
<?php $__env->stopSection(); ?> <?php $__env->startSection('css'); ?>
<link
	rel="stylesheet"
	href="<?php echo e(base_url('assets/css/dataTables.bootstrap4.min.css')); ?>"
/>
<link
	rel="stylesheet"
	href="<?php echo e(base_url('assets/css/responsive.bootstrap4.min.css')); ?>"
/>
<link rel="stylesheet" href="<?php echo e(base_url('assets/css/select2.min.css')); ?>" />
<link
	rel="stylesheet"
	href="<?php echo e(base_url('assets/css/bootstrap-select.min.css')); ?>"
/>
<?php $__env->stopSection(); ?> <?php $__env->startSection('content'); ?>
<div class="col-md-12">
	<div class="card-box mt-2">
        <div class="col-md-4 col-sm-4 col-xs-12">				
            <form action="<?php echo e(base_url('app/sim-ig/hibah')); ?>" method="GET" accept-charset="utf-8" autocomplete="off" class="myForm">
                <div class="input-group">
                    <input type="search" id="q" value="" name="q" class="form-control" placeholder="Cari data...">
                    <span class="input-group-prepend">
                        <button type="submit" class="btn waves-effect waves-light btn-primary btn-sm">
                            <i class="mdi mdi-magnify mdi-18px"></i>
                        </button>
                    </span>
                </div>
            </form>				
        </div>			
		<div class="table-responsive mt-1">
			<table
				id="tb_data_actbud"
				class="table table-striped table-bordered dt-responsive nowrap"
			>
				<thead class="bg-purple text-white text-center">
					<tr>
						<th width="50" style="vertical-align: middle">No</th>
						<th style="vertical-align: middle">Uraian</th>
						<th style="vertical-align: middle">Jenis Biaya</th>
						<th style="vertical-align: middle">No Borang</th>
						<th class="text-center" style="vertical-align: middle">
							Kode Pencarian
						</th>
						<th width="200" style="vertical-align: middle">PIC</th>
					</tr>
				</thead>
				<tbody id="tb-actbud"></tbody>
			</table>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?> 

<?php $__env->startSection('js'); ?>
<script src="<?php echo e(base_url('assets/js/bootstrap-select.min.js')); ?>"></script>
<script src="<?php echo e(base_url('assets/js/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(base_url('assets/js/dataTables.bootstrap4.min.js')); ?>"></script>
<script src="<?php echo e(base_url('assets/js/dataTables.responsive.min.js')); ?>"></script>
<script src="<?php echo e(base_url('assets/js/responsive.bootstrap4.min.js')); ?>"></script>

<script>
	$(document).ready(function () {
		$("#tb_data_actbud").DataTable();
	});
    $('table').dataTable({searching: false, paging: false, info: false});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('spa.layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\upj_spa_ig\application\views/spa/actbud/index.blade.php ENDPATH**/ ?>