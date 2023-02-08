

<?php $__env->startSection('title', 'Realisasi Anggaran Kegiatan'); ?>

<?php $__env->startSection('page-title'); ?>
    <a href="<?php echo e(base_url('app/realisasi_anggaran')); ?>"><i class="mdi mdi-arrow-left"></i></a> Realisasi Anggaran
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="<?php echo e(base_url('assets/css/dataTables.bootstrap4.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(base_url('assets/css/responsive.bootstrap4.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(base_url('assets/css/select2.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(base_url('assets/css/bootstrap-select.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(base_url('assets/css/daterangepicker.css')); ?>">
<link rel="stylesheet" href="<?php echo e(base_url('assets/css/bootstrap-datepicker.min.css')); ?>">

<link href="<?php echo e(base_url('assets/css/tooltipster.css')); ?>" rel="stylesheet" type="text/css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item"><a href="<?php echo e(base_url('app/realisasi_anggaran')); ?>"><i class="mdi mdi-briefcase-outline"></i> Realisasi Anggaran</a></li>
<li class="breadcrumb-item active"><a href="javascript:void(0)"><b><i class="mdi mdi-file-document-outline"></i> </a></b></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="col-md-12">
    <div class="card card-border card-teal">
        <div class="card-header border-teal bg-transparent">
            <div class="float-left">
                <h3 class="card-title mb-0"><i class="mdi mdi-file-document-outline"></i> DETAIL ACTBUD</h3>
            </div>
            <div class="float-right">
                <?php switch($data->status):
                    case ('cancel'): ?>
                        <span class="badge badge-danger">Ditolak</span>
                        <?php break; ?>
                    <?php case ('ongoing'): ?>
                        <span class="badge badge-warning">Dalam Perencanaan</span>
                        <?php break; ?>
                    <?php case ('submitted'): ?>
                        <span class="badge badge-info">Sedang Berlangsung</span>
                        <?php break; ?>
                    <?php case ('approved'): ?>
                        <span class="badge badge-success"><i class="mdi mdi-check-bold"></i> Actbud Disetujui</span>
                        <?php break; ?>
                    <?php default: ?>
                        
                <?php endswitch; ?>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Nama Kegiatan</label>
                        <p class="form-control-static">
                            <span class="" style="font-size: 14px;">
                                <?php echo e($data->nama_kegiatan); ?>

                            </span>
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Deskripsi Kegiatan</label>
                        <p class="form-control-static">
                            <span class="" style="font-size: 14px;">
                                <?php echo e($data->deskripsi_kegiatan); ?>

                            </span>
                        </p>
                    </div>
                </div>                
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">KPI</label>
                        <p class="form-control-static">
                            <span class="" style="font-size: 14px;">
                                <?php echo e($data->kpi); ?>

                            </span>
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">PIC</label>
                        <p class="form-control-static">
                            <span class="" style="font-size: 14px;">
                                <?php echo e($data->nama_pic . ' ('.$data->pic.')'); ?>

                            </span>
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Pelaksana</label>
                        <p class="form-control-static">
                            <span class="" style="font-size: 14px;">
                                <?php echo e($data->nama_pelaksana. ' ('.$data->pelaksana.')'); ?>

                            </span>
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Tanggal Pelaksanaan</label>
                        <p class="form-control-static">
                            <span class="badge bg-secondary">
                                <i class="mdi mdi-calendar"></i> <?php echo e(tanggal_indo($data->tgl_mulai) . ' s/d ' . tanggal_indo($data->tgl_selesai)); ?>

                            </span>
                        </p>
                    </div>
                </div>                
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Periode</label>
                        <p class="form-control-static">
                            <span class="badge bg-warning">
                            <?php switch($data->periode):
                                case (1): ?>
                                    Ganjil
                                    <?php break; ?>
                                <?php case (2): ?>
                                    Genap
                                    <?php break; ?>
                                <?php default: ?>
                                    Menunggu
                            <?php endswitch; ?>
                            </span>
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Total Anggaran</label>
                        <p class="form-control-static">
                            <span class="badge bg-purple">
                                <?php echo e(rupiah($data->agr)); ?>

                            </span>
                        </p>
                    </div>
                </div>                
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Tanggal Pengajuan</label>
                        <p class="form-control-static">
                            <?php if(!empty($data->tanggal_pembuatan)): ?>
                                <span class="badge bg-light text-muted">
                                    <i class="mdi mdi-clock-check-outline"></i> <?php echo e(substr($data->tanggal_pembuatan, 0, 16)); ?>

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

    <div class="card card-border card-success" id="card-rincian">
        <div class="card-header border-success bg-transparent">
            <div class="float-left">
                <h3 class="card-title mb-0"><i class="mdi mdi-clipboard-list-outline"></i> DETAIL BIAYA</h3>
            </div>
            <div class="float-right">
                <?php if($data->realisasi == 'Y'): ?>
                    <span class="badge badge-primary"><i class="mdi mdi-check-bold"></i> Finalisasi</span>
                <?php endif; ?>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped dataTable">
                    <thead>
                        <tr>
                            <th class="text-center" style="vertical-align: middle;" width=50>No</th>
                            <th style="vertical-align: middle;">Nama Kegiatan</th>                            
                            <th class="text-center" style="vertical-align: middle;">Anggaran Disetujui</th>
                            <th class="text-center" style="vertical-align: middle;">Realisasi Anggaran</th>
                            <th class="text-center" style="vertical-align: middle;">Catatan Realisasi</th> 
                            <th class="text-center" style="vertical-align: middle;">Lampiran/Bukti</th>                            
                        </tr>
                    </thead>
                    <tbody id="tb-detail-biaya">
                        <?php $__currentLoopData = $detail_biaya; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <th class="text-center" style="vertical-align: middle;"><?php echo e($loop->iteration); ?></th>
                                <td style="vertical-align: middle;">
                                    <span class="" style="font-size: 14px;">
                                        <?php echo e($item->nama_kegiatan); ?>

                                    </span>
                                    <hr class="mt-0 mb-0">
                                    <span style="font-size: 11px;">
                                        <?php echo e($item->keterangan); ?>

                                    </span>
                                    <br>
                                    <span class="badge bg-secondary">
                                        <i class="mdi mdi-calendar"></i> <?php echo e($item->tanggal_buat); ?>

                                    </span>
                                </td>                                                          
                                <td style="vertical-align: middle;" class="text-center">
                                    <span class="badge bg-purple">
                                        <?php echo e(rupiah($item->total_anggaran)); ?>

                                    </span>
                                </td>
                                <td style="vertical-align: middle;" class="text-center">
                                    <a href="javascript:void(0)" class="badge bg-primary <?php echo e($data->realisasi == 'N' ? 'btn-ubah_realisasi_anggaran' : ''); ?>" 
                                    data-id="<?php echo e(encrypt($item->id)); ?>" data-nama_kegiatan="<?php echo e($item->nama_kegiatan); ?>" 
                                    data-keterangan="<?php echo e($item->keterangan); ?>" data-anggaran_disetujui="<?php echo e(rupiah($item->total_anggaran)); ?>" 
                                    data-anggaran_realisasi="<?php echo e(rupiah($item->total_anggaran_realisasi)); ?>">
                                        <?php echo e(rupiah($item->total_anggaran_realisasi)); ?> <?php echo $data->realisasi == 'N' ? '<i class="mdi mdi-pencil"></i>' : ''; ?>

                                    </a>                                    
                                </td>                                
                                <td style="vertical-align: middle;" class="text-justify <?php echo e(($item->catatan_disetujui == "" && $data->realisasi == 'Y') ? 'text-center' : ''); ?>">
                                    <?php if($item->catatan_disetujui == ""): ?>
                                        <?php if($data->realisasi == 'N'): ?>                                                                                    
                                        <a href="javascript:void(0)" class="badge bg-info btn-buat_catatan" 
                                        data-id="<?php echo e(encrypt($item->id)); ?>" data-nama_kegiatan="<?php echo e($item->nama_kegiatan); ?>" 
                                        data-keterangan="<?php echo e($item->keterangan); ?>" data-anggaran_disetujui="<?php echo e(rupiah($item->total_anggaran)); ?>" 
                                        data-anggaran_realisasi="<?php echo e(rupiah($item->total_anggaran_realisasi)); ?>">
                                            <i class="mdi mdi-note-plus-outline"></i> Buat Catatan
                                        </a>
                                        <?php else: ?>
                                        -
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <?php
                                            $count_lampiran = 0;
                                            $ctn = $item->catatan_disetujui;
                                            $p_ctn = explode(' ', $ctn);
                                            $s_ctn = array_slice($p_ctn, 0, 10);
                                            $r_ctn = array_slice($p_ctn, 10);
                                            $t_ctn = '';
                                            $rd_more = ' <a href="javascript:void(0)" data-message="'.implode(' ', $r_ctn).'" class="btn-rd_more" 
                                            data-sp_class="el-rd_more_'.$item->id.'" data-sp_rd_less="el-rd_less_'.$item->id.'">... Read more</a>
                                            <span class="el-rd_more_'.$item->id.'"></span>
                                            <a href="javascript:void(0)" class="el-rd_less_'.$item->id.'" hidden>Read Less</a>
                                            ';
                                            if(count($p_ctn) > 10){
                                                $t_ctn .= $rd_more;
                                            }

                                            echo '<span style="font-size:12px;">'.implode(' ', $s_ctn).$t_ctn.'</span>';
                                        ?>

                                        <?php if($data->realisasi == 'N'): ?>                                                                                    
                                        <br>
                                        <a href="javascript:void(0)" class="badge bg-warning btn-ubah_catatan"
                                        data-id="<?php echo e(encrypt($item->id)); ?>" data-nama_kegiatan="<?php echo e($item->nama_kegiatan); ?>" 
                                        data-keterangan="<?php echo e($item->keterangan); ?>" data-anggaran_disetujui="<?php echo e(rupiah($item->total_anggaran)); ?>" 
                                        data-anggaran_realisasi="<?php echo e(rupiah($item->total_anggaran_realisasi)); ?>" 
                                        data-catatan_disetujui="<?php echo e($item->catatan_disetujui); ?>">
                                            <i class="mdi mdi-pencil"></i> Ubah Catatan
                                        </a>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center" style="vertical-align: middle;">
                                    <?php if($item->lampiran != ""): ?>
                                        <a href="<?php echo e(base_url('app-data/bukti-realisasi-anggaran/' . $item->lampiran)); ?>"  class="badge bg-light text-muted" title="Klik untuk mengunduh" download="<?php echo e($item->nama_file); ?>">
                                           <i class="<?php echo $item->icon_file; ?>"></i><?php echo e(ucfirst($item->nama_file )); ?> (<?php echo e(formatBytes($item->ukuran_file)); ?>)
                                        </a>
                                        <br>
                                    <?php endif; ?>

                                    <?php if($data->realisasi == 'N'): ?>                                                                        
                                    <a href="javascript:void(0)" class="badge bg-success btn-upload_bukti" 
                                    data-id="<?php echo e(encrypt($item->id)); ?>" data-nama_kegiatan="<?php echo e($item->nama_kegiatan); ?>" 
                                    data-keterangan="<?php echo e($item->keterangan); ?>" data-anggaran_disetujui="<?php echo e(rupiah($item->total_anggaran)); ?>" 
                                    data-anggaran_realisasi="<?php echo e(rupiah($item->total_anggaran_realisasi)); ?>" 
                                    data-catatan_disetujui="<?php echo e($item->catatan_disetujui); ?>"
                                    <?php echo $item->lampiran == "" ? '' : 'data-lampiran="'.encrypt($item->lampiran).'"'; ?>

                                    >
                                        <i class="mdi mdi-<?php echo e($item->lampiran == "" ? 'upload' : 'pencil'); ?>"></i> 
                                        <?php echo e($item->lampiran == "" ? 'Unggah' : 'Ubah'); ?>

                                    </a>
                                    <?php endif; ?>
                                </td>                             
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>                    
                    <tfoot>
                        <tr>
                            <th colspan="2" class="text-right" style="vertical-align: middle;">Total :</th>
                            <td style="vertical-align: middle;" class="text-center">
                                <span class="badge bg-purple">
                                    <?php echo e(rupiah($anggaran_disetujui->total)); ?>

                                </span>
                            </td>
                            <td style="vertical-align: middle;" class="text-center">
                                <span class="badge bg-primary">
                                    <?php echo e(rupiah($anggaran_realisasi->total)); ?>                                    
                                </span>                                
                            </td>
                            <td style="vertical-align: middle;"></td>
                            <td style="vertical-align: middle;"></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    
    <?php if($data->realisasi == 'N'): ?>            
    <div class="card card-border card-primary" id="card-rincian">
        <div class="card-header border-primary bg-transparent">
            <h3 class="card-title mb-0"><i class="mdi mdi-check-bold"></i> FINALISASI PENYESUAIAN ANGGARAN</h3>
        </div>
        <div class="card-body">
            <div class="alert alert-info">
                <i class="mdi mdi-information-variant"></i> Catatan: Sebelum melakukan finalisasi penyesuaian anggaran, mohon pastikan anggaran anda sudah sesuai dengan realisasi yang berjalan
                dan pastikan anda sudah mengupload <b>lampiran/bukti</b> di setiap kegiatan (Jika ada).
            </div>                     
            <button type="button" data-target="#modal-finalisasi" data-toggle="modal" class="btn btn-primary btn-md col-12"><i class="mdi mdi-lock"></i> Finalisasi Anggaran</button>
        </div>
    </div>

    <?php echo form_open('app/realisasi_anggaran/actbud/' . $CI->uri->segment(4) . '/' . $CI->uri->segment(5) . '/finalisasi-penyesuaian-anggaran?_r='.uniqid()); ?>

    <div id="modal-finalisasi" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0">Konfirmasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="mb-2 text-justify">Apakah anda yakin ingin melakukan Finalisasi Penyesuaian Anggaran?</p>
                    <div class="alert alert-info">
                        <p class="mb-0"><i class="mdi mdi-information-variant"></i> Setelah submit anda tidak dapat lagi melakukan perubahan.</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="javascript:void(0)" data-dismiss="modal" class="btn btn-danger">Batal</a>
                    <button type="submit" class="btn btn-primary"><i class="mdi mdi-check"></i> Finalisasi</button>
                </div>
            </div>
        </div>
    </div>
    <?php echo form_close(); ?>

    <?php endif; ?>
</div>

<?php if($data->realisasi == 'N'): ?>

<?php echo form_open('app/realisasi_anggaran/actbud/' . $CI->uri->segment(4) . '/' . $CI->uri->segment(5) . '/buat_catatan'); ?>

<div id="modal-buat-catatan" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Buat Catatan Realisasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id" value="">
                <div class="form-group">
                    <label for="">Nama Kegiatan</label>
                    <p class="form-control-static">
                        <span class="nama_kegiatan"></span>                        
                    </p>
                </div>
                <div class="form-group">
                    <label for="">Keterangan</label>
                    <p class="form-control-static">
                        <span class="keterangan"></span>                        
                    </p>
                </div>                
                <div class="form-group">
                    <label for="">Catatan</label>
                    <textarea name="catatan" id="catatan" placeholder="Buat catatan..." cols="4" rows="4" class="form-control" required></textarea>
                </div>
            </div>
            <div class="card-footer">
                <div class="float-right">
                    <a href="javascript:void(0)" data-dismiss="modal" class="btn btn-danger btn-xs">Tutup</a>
                    <button type="submit" class="btn btn-primary btn-xs">Simpan Catatan</button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo form_close(); ?>


<?php echo form_open('app/realisasi_anggaran/actbud/' . $CI->uri->segment(4) . '/' . $CI->uri->segment(5) . '/buat_realisasi_anggaran'); ?>

<div id="modal-realisasi-anggaran" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Realisasi Anggaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id" value="">
                <div class="form-group">
                    <label for="">Nama Kegiatan</label>
                    <p class="form-control-static">
                        <span class="nama_kegiatan"></span>                        
                    </p>
                </div>
                <div class="form-group">
                    <label for="">Keterangan</label>
                    <p class="form-control-static">
                        <span class="keterangan"></span>                        
                    </p>
                </div>
                <div class="form-group">
                    <label for="">Anggaran Disetujui</label>
                    <p class="form-control-static">
                        <span class="anggaran_disetujui badge bg-purple"></span>                        
                    </p>
                </div>
                <div class="form-group">
                    <label for="">Anggaran Realisasi</label>
                    <input type="text" name="anggaran_realisasi" placeholder="Masukan realisasi anggaran" maxlength="30" id="anggaran_realisasi" class="form-control" value="" required>
                </div>                
            </div>
            <div class="card-footer">
                <div class="float-right">
                    <a href="javascript:void(0)" data-dismiss="modal" class="btn btn-danger btn-xs">Tutup</a>
                    <button type="submit" class="btn btn-primary btn-xs">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo form_close(); ?>


<?php echo form_open('app/realisasi_anggaran/actbud/' . $CI->uri->segment(4) . '/' . $CI->uri->segment(5) . '/unggah_bukti', array('enctype' => 'multipart/form-data')); ?>

<div id="modal-unggah-lampiran" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0"><span class="mdl_title"></span> Lampiran/Bukti</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="old_lampiran" value="">
                <input type="hidden" name="id" value="">
                <div class="form-group">
                    <label for="">Nama Kegiatan</label>
                    <p class="form-control-static">
                        <span class="nama_kegiatan"></span>                        
                    </p>
                </div>
                <div class="form-group">
                    <label for="">Keterangan</label>
                    <p class="form-control-static">
                        <span class="keterangan"></span>                        
                    </p>
                </div>
                <div class="form-group">
                    <label for="">Lampiran/Bukti (Max: 5mb)</label>
                    <input type="file" class="filestyle" name="lampiran" id="lampiran" data-size="sm" required>
                    <span class="help-block"><small>Allowed Extension: xlsx,pdf,docx,pptx,image(jpg,jpeg,png,webp)</small></span>
                </div>
            </div>
            <div class="modal-footer">
                <div class="float-right">
                    <a href="javascript:void(0)" class="btn btn-danger btn-xs" data-dismiss="modal">Tutup</a>
                    <button type="submit" class="btn btn-primary btn-xs">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo form_close(); ?>


<?php endif; ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<script src="<?php echo e(base_url('assets/js/bootstrap-datepicker.min.js')); ?>"></script>
<script src="<?php echo e(base_url('assets/js/daterangepicker.js')); ?>"></script>
<script src="<?php echo e(base_url('assets/js/select2.min.js')); ?>"></script>
<script src="<?php echo e(base_url('assets/js/bootstrap-select.min.js')); ?>"></script>

<script src="<?php echo e(base_url('assets/js/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(base_url('assets/js/dataTables.bootstrap4.min.js')); ?>"></script>
<script src="<?php echo e(base_url('assets/js/dataTables.responsive.min.js')); ?>"></script>
<script src="<?php echo e(base_url('assets/js/responsive.bootstrap4.min.js')); ?>"></script>

<script src="<?php echo e(base_url('assets/js/jquery.steps.min.js')); ?>"></script>
<script src="<?php echo e(base_url('assets/js/jquery.validate.min.js')); ?>"></script>
<script src="<?php echo e(base_url('assets/js/form-wizard.init.js')); ?>"></script>
<script src="<?php echo e(base_url('assets/js/bootstrap-filestyle.min.js')); ?>"></script>

<script src="<?php echo e(base_url('assets/js/tooltipster.bundle.min.js')); ?>"></script>
<script src="<?php echo e(base_url('assets/js/tooltipster.init.js')); ?>"></script>

<script>
    $(document).ready(function(){
        $('.dataTable').dataTable({
            stateSave: true
        })
        
        $('#tb-detail-biaya').on('click', '.btn-rd_more', function(e){
            const data = {
                message: $(this).data('message'),
                el_rd_more: $(this).data('sp_class'),
                el_rd_less: $(this).data('sp_rd_less')
            }

            $(this).attr('hidden', true)
            $('span.' + data.el_rd_more).text(data.message)
            $('a.' + data.el_rd_less).removeAttr('hidden')
            $('a.' + data.el_rd_less).on('click', function(){
                $('span.' + data.el_rd_more).text('')
                $(this).attr('hidden', true)  
                $(this).parent().find('.btn-rd_more').removeAttr('hidden')
            })
            e.preventDefault()
        })

        <?php if($data->realisasi == 'N'): ?>

        $('#tb-detail-biaya').on('click', '.btn-upload_bukti', function(){
            const data = {
                id: $(this).data('id'),
                nama_kegiatan: $(this).data('nama_kegiatan'),
                keterangan: $(this).data('keterangan'),
                anggaran_disetujui: $(this).data('anggaran_disetujui'),
                anggaran_realisasi: $(this).data('anggaran_realisasi').slice(0, -3),
                lampiran: $(this).data('lampiran')
            }

            $('#modal-unggah-lampiran span.mdl_title').text(data.lampiran == 'undefined' ? 'Unggah' : 'Ubah')
            $('#modal-unggah-lampiran input[name="old_lampiran"]').val(data.lampiran)
            $('#modal-unggah-lampiran input[name="id"]').val(data.id)
            $('#modal-unggah-lampiran span.nama_kegiatan').text(data.nama_kegiatan)
            $('#modal-unggah-lampiran span.keterangan').text(data.keterangan)
            $('#modal-unggah-lampiran').modal('show')
        })

        $('#tb-detail-biaya').on('click', '.btn-ubah_realisasi_anggaran', function(){
            const data = {
                id: $(this).data('id'),
                nama_kegiatan: $(this).data('nama_kegiatan'),
                keterangan: $(this).data('keterangan'),
                anggaran_disetujui: $(this).data('anggaran_disetujui'),
                anggaran_realisasi: $(this).data('anggaran_realisasi').slice(0, -3)
            }
            
            $('#modal-realisasi-anggaran input[name="id"]').val(data.id)
            $('#modal-realisasi-anggaran span.nama_kegiatan').text(data.nama_kegiatan)
            $('#modal-realisasi-anggaran span.keterangan').text(data.keterangan)
            $('#modal-realisasi-anggaran span.anggaran_disetujui').text(data.anggaran_disetujui)
            $('#modal-realisasi-anggaran input[name="anggaran_realisasi"]').val(data.anggaran_realisasi)
            $('#modal-realisasi-anggaran').modal('show')            
        })

        $('#tb-detail-biaya').on('click', '.btn-buat_catatan', function(){

            const data = {
                id: $(this).data('id'),
                nama_kegiatan: $(this).data('nama_kegiatan'),
                keterangan: $(this).data('keterangan'),
                anggaran_disetujui: $(this).data('anggaran_disetujui'),
                anggaran_realisasi: $(this).data('anggaran_realisasi')
            }

            $('#modal-buat-catatan input[name="id"]').val(data.id)
            $('#modal-buat-catatan span.nama_kegiatan').text(data.nama_kegiatan)
            $('#modal-buat-catatan span.keterangan').text(data.keterangan)
            $('#modal-buat-catatan span.anggaran_disetujui').text(data.anggaran_disetujui)
            $('#modal-buat-catatan span.anggaran_realisasi').text(data.anggaran_realisasi)
            $('#modal-buat-catatan').modal('show')
        })

        $('#tb-detail-biaya').on('click', '.btn-ubah_catatan', function(){

            const data = {
                id: $(this).data('id'),
                nama_kegiatan: $(this).data('nama_kegiatan'),
                keterangan: $(this).data('keterangan'),
                anggaran_disetujui: $(this).data('anggaran_disetujui'),
                anggaran_realisasi: $(this).data('anggaran_realisasi'),
                catatan_disetujui: $(this).data('catatan_disetujui')
            }
            
            $('#modal-buat-catatan textarea[name="catatan"]').val(data.catatan_disetujui)
            $('#modal-buat-catatan input[name="id"]').val(data.id)
            $('#modal-buat-catatan span.nama_kegiatan').text(data.nama_kegiatan)
            $('#modal-buat-catatan span.keterangan').text(data.keterangan)
            $('#modal-buat-catatan').modal('show')
        })

        var rupiah = document.getElementById('anggaran_realisasi');        
        
		rupiah.addEventListener('keyup', function(e){			            
			rupiah.value = formatRupiah(this.value, 'Rp ');            
		});
 		
		function formatRupiah(angka, prefix){
			var number_string = angka.replace(/[^,\d]/g, '').toString(),
			split   		= number_string.split(','),
			sisa     		= split[0].length % 3,
			rupiah     		= split[0].substr(0, sisa),
			ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
 
			if(ribuan){
				separator = sisa ? '.' : '';
				rupiah += separator + ribuan.join('.');
			}
 
			rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
			return prefix == undefined ? rupiah : (rupiah ? 'Rp ' + rupiah : '');
		}

        <?php endif; ?>

    })
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\hibah_upj_dev\application\views/users/realisasi_anggaran/v_realisasi_anggaran.blade.php ENDPATH**/ ?>