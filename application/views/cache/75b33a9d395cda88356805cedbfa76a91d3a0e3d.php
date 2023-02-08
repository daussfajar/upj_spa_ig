

<?php $__env->startSection('title', 'Approval'); ?>

<?php $__env->startSection('page-title'); ?>
<i class="mdi mdi-clipboard-file-outline"></i> Approval
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item active"><a href="javascript: void(0);"><i class="mdi mdi-clipboard-file-outline"></i> Approval</a></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="col-md-12">        
        <div class="card-box mt-2">
            <div class="row mb-3">                    
                <div class="col-md-8 col-sm-8 col-xs-12">
                    <div class="float-left">
                        
                    </div>
                    <div class="float-right">                        
                        <a href="javascript:void(0)" class="btn btn-secondary btn-sm"><i class="mdi mdi-filter"></i></a>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <form action="<?php echo e(base_url('app/approval')); ?>" method="GET" accept-charset="utf-8" autocomplete="off">                        
                        <div class="input-group">
                            <input type="search" id="q" value="<?php echo e(!empty($_GET['q']) ? $_GET['q'] : ''); ?>" name="q" class="form-control" placeholder="Cari data...">
                            <span class="input-group-prepend">
                                <button type="submit" class="btn waves-effect waves-light btn-primary btn-sm"><i class="mdi mdi-magnify mdi-18px"></i></button>
                            </span>
                        </div>
                    </form>
                </div>
            </div> 
            <?php if(isset($_GET['q']) && $CI->input->get('q', true) !== ""): ?>
                <?php if(empty($data['data'])): ?>
                    <div class="alert alert-info">
                        <p class="mb-0">Pencarian anda <b>- <?php echo e($CI->input->get('q', true)); ?> -</b> tidak ada dalam data.</p>
                        <p class="mb-0">
                            Saran:
                            <ul class="mb-0">
                                <li>Pastikan bahwa semua kata dieja dengan benar.</li>
                                <li>Coba kata kunci yang berbeda.</li>
                                <li>Coba kata kunci yang lebih umum.</li>
                            </ul>
                        </p>
                    </div>
                <?php else: ?>
                    <div class="alert alert-info">
                        <p class="mb-0"><i class="mdi mdi-magnify"></i> Hasil pencarian dari: "<b><?php echo e($CI->input->get('q', true)); ?></b>"</p>                    
                    </div>
                <?php endif; ?>
            <?php endif; ?>
            
            <div class="table-responsive">
                <table id="tb_approval" class="table table-striped table-bordered dt-responsive nowrap">
                    <thead class="bg-purple text-white">
                        <tr>
                            <th width=50 class="text-center" style="vertical-align: middle;">No</th>
                            <th style="vertical-align: middle;">Kode Actbud</th>
                            <th width=200 style="vertical-align: middle;">Kode Pencairan</th>
                            <th style="vertical-align: middle;">Nama Kegiatan</th> 
                            <th style="vertical-align: middle;" class="text-center">Jenis</th>                            
                            <th class="text-center" style="vertical-align: middle;">Anggaran</th>
                            <th class="text-center" style="vertical-align: middle;">PIC</th>
                            <th class="text-center" style="vertical-align: middle;">Pelaksana</th>
                            <th class="text-center" style="vertical-align: middle;" width=100>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(empty($data['data'])): ?>
                            <tr>
                                <th colspan="9" class="text-center">Tidak ada data</th>
                            </tr>
                        <?php else: ?>
                        <?php
                            $no = (empty($CI->uri->segment(3)) ? 0 : $CI->uri->segment(3) + 0);
                        ?>
                            <?php $__currentLoopData = $data['data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $no++
                                ?>
                                <tr>
                                    <th class="text-center" style="vertical-align: middle;"><?php echo e($no); ?></th>
                                    <th style="vertical-align: middle"><?php echo e($row['kode_uraian']); ?></th>
                                    <th style="vertical-align: middle"><?php echo e($row['kode_pencairan']); ?></th>
                                    <td style="vertical-align: middle"><?php echo e($row['nama_kegiatan']); ?></td>
                                    <td style="vertical-align: middle" class="text-center">
                                        <?php switch($row['jenis_anggaran']):
                                            case ('hibah'): ?>
                                                <span class="badge badge-info">Hibah</span>
                                                <?php break; ?>
                                            <?php case ('sponsorship'): ?>
                                                <span class="badge badge-info">Sponsorship</span>
                                                <?php break; ?>
                                            <?php default: ?>
                                            <span class="badge badge-danger">Unknown</span>
                                        <?php endswitch; ?>
                                    </td>
                                    <td style="vertical-align: middle" class="text-center"><?php echo e(rupiah($row['agr'])); ?></td>
                                    <td style="vertical-align: middle" class="text-center"><?php echo e($row['pic']); ?></td>
                                    <td style="vertical-align: middle" class="text-center"><?php echo e($row['pelaksana']); ?></td>
                                    <td style="vertical-align: middle" class="text-center">
                                        <a href="<?php echo e(base_url('app/approval/v_detail/' . encrypt($row['id']))); ?>" class="btn btn-primary btn-xs">Lihat <i class="mdi mdi-arrow-right"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <span class="badge badge-info">Total Data: <?php echo e($data['total_rows']); ?></span>
            <?php echo $data['pagination']; ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp1\htdocs\hibah_upj\application\views/users/approval/index.blade.php ENDPATH**/ ?>