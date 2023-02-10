

<?php $__env->startSection('title', 'Master Data - Karyawan'); ?>

<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="<?php echo e(base_url('assets/css/dataTables.bootstrap4.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(base_url('assets/css/responsive.bootstrap4.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(base_url('assets/css/select2.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(base_url('assets/css/bootstrap-select.min.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-title'); ?>
    <i class="mdi mdi-account"></i> Data Karyawan
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item"><a href="javascript: void(0);"><i class="mdi mdi-folder-open"></i> Master Data</a></li>
<li class="breadcrumb-item active"><a href="javascript: void(0);">Karyawan</a></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="col-md-12">
        <div class="card-box">
            <div class="float-right">
                <a href="javascript:void(0)" data-toggle="modal" data-target="#modal-tambah-karyawan" class="btn btn-success btn-xs">+ Tambah Karyawan</a>
            </div>
            <br><br>
            <div class="table-responsive">
                <table class="table table-bordered dataTable">
                    <thead class="text-white bg-purple">
                        <tr>
                            <th class="text-center" style="vertical-align: middle;" width=50>No</th>
                            <th class="text-center" style="vertical-align: middle;">NIK</th>
                            <th class="text-center" style="vertical-align: middle;">Nama Lengkap</th>
                            <th class="text-center" style="vertical-align: middle;">Email</th>
                            <th class="text-center" style="vertical-align: middle;">Unit</th>
                            <th class="text-center" style="vertical-align: middle;">Jabatan</th>
                            <th class="text-center" style="vertical-align: middle;">Terakhir Login</th>
                            <th class="text-center" style="vertical-align: middle;">Status</th>
                            <th class="text-center" style="vertical-align: middle;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tb-karyawan">
                        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <th class="text-center" style="vertical-align: middle;"><?php echo e($loop->iteration); ?></th>
                                <td class="text-center" style="vertical-align: middle;">
                                    <span class="badge bg-purple">
                                        <?php echo e($item->nik); ?>

                                    </span>
                                </td>
                                <td style="vertical-align: middle;">
                                    <span class="" style="font-size: 14px;">
                                        <?php echo e($item->nama_lengkap); ?>

                                    </span>
                                </td>
                                <td style="vertical-align: middle;">
                                    <span class="" style="font-size: 14px;">
                                        <?php echo e($item->email); ?>

                                    </span>
                                </td>
                                <td class="text-center" style="vertical-align: middle;">
                                    <span class="badge bg-info">
                                        <?php echo e($item->nama_unit); ?>

                                    </span>
                                </td>
                                <td class="text-center" style="vertical-align: middle;">
                                    <span class="badge bg-secondary">
                                        <?php echo e($item->keterangan_tingkatan); ?>

                                    </span>
                                </td>
                                <td class="text-center" style="vertical-align: middle;">
                                    <span class="" style="font-size: 14px;">
                                        <?php echo e($item->terakhir_login); ?>

                                    </span>
                                </td>
                                <td class="text-center" style="vertical-align: middle;">
                                    <?php if($item->status == 'Tidak Aktif'): ?>
                                        <span class="badge bg-danger">
                                            <i class="mdi mdi-close"></i> Tidak Aktif
                                        </span>
                                    <?php elseif($item->status == 'Aktif'): ?>
                                        <span class="badge bg-success">
                                            <i class="mdi mdi-check-bold"></i> Aktif
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center" style="vertical-align: middle;" width=200>
                                    <a href="<?php echo e(base_url('app/master-data/karyawan/' . encrypt($item->nik) . '/set_status?status=' . $item->status.'&nama_lengkap='.$item->nama_lengkap)); ?>" class="badge bg-info"
                                    <?php echo $item->status == 'Aktif' ? 'onclick="return confirm(\'Apakah anda yakin ingin non-aktifkan akun '.$item->nama_lengkap.'?\')"' : 'onclick="return confirm(\'Apakah anda yakin ingin mengaktifkan akun '.$item->nama_lengkap.'?\')"'; ?>>
                                        <i class="mdi mdi-<?php echo e($item->status == 'Aktif' ? 'eye-off' : 'eye'); ?>"></i>
                                    </a>
                                    <a href="javascript:void(0)" class="badge bg-primary btn-edit" 
                                    data-nik="<?php echo e($item->nik); ?>" data-e_nik="<?php echo e(encrypt($item->nik)); ?>" data-nama_lengkap="<?php echo e($item->nama_lengkap); ?>" 
                                    data-email="<?php echo e($item->email); ?>" data-kode_unit="<?php echo e($item->kode_unit); ?>" 
                                    data-kode_tingkatan="<?php echo e($item->kode_tingkatan); ?>">
                                        <i class="mdi mdi-pencil"></i>
                                    </a>
                                    <a href="javascript:void(0)" class="badge bg-purple btn-ubahpass" data-nik="<?php echo e($item->nik); ?>" 
                                        data-nama_lengkap="<?php echo e($item->nama_lengkap); ?>" 
                                        data-unit="<?php echo e($item->nama_unit); ?>" 
                                        data-email="<?php echo e($item->email); ?>"
                                        data-e_nik="<?php echo e(encrypt($item->nik)); ?>"
                                        data-jabatan="<?php echo e($item->keterangan_tingkatan); ?>">
                                        <i class="mdi mdi-key"></i>
                                    </a>
                                    <a href="javascript:void(0)" data-nik="<?php echo e($item->nik); ?>" 
                                        data-nama_lengkap="<?php echo e($item->nama_lengkap); ?>" 
                                        data-unit="<?php echo e($item->nama_unit); ?>" 
                                        data-email="<?php echo e($item->email); ?>"
                                        data-e_nik="<?php echo e(encrypt($item->nik)); ?>"
                                        data-jabatan="<?php echo e($item->keterangan_tingkatan); ?>" class="badge bg-danger btn-hapus">
                                        <i class="mdi mdi-trash-can"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Edit Karyawan -->
    <?php echo form_open('', array('id' => 'form-edit-karyawan')); ?>    
    <div id="modal-edit-karyawan" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title mt-0">Edit Karyawan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">    
                <input type="hidden" name="nik">
                <div class="form-group row mb-0">
                    <label for="" class="col-3">NIK</label>
                    <p class="form-control-static col-8">
                        <span class="form-nik"></span>
                    </p>
                </div>
                <div class="form-group row">
                    <label for="" class="col-3">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control nama-lengkap col-8" required>
                </div>
                <div class="form-group row">
                    <label for="" class="col-3">Email</label>
                    <input type="email" id="email" name="email" class="form-control email col-8" required>
                </div>
                <div class="form-group row">
                    <label for="" class="col-3">Unit/Bagian</label>
                    <select name="unit" id="unit" class="form-control unit col-8">
                        <?php $__currentLoopData = $unit; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($item->kode_unit); ?>"><?php echo e($item->nama_unit); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="form-group row">
                    <label for="" class="col-3">Jabatan</label>
                    <select name="jabatan" id="jabatan" class="form-control jabatan col-8">
                        <?php $__currentLoopData = $jabatan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($item->kode_tingkatan); ?>"><?php echo e($item->keterangan_tingkatan); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light btn-sm waves-effect" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light">Simpan</button>
            </div>
        </div>
        <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <?php echo form_close(); ?>


    <!-- Modal Tambah Karyawan -->
    <?php echo form_open('app/master-data/karyawan/tambah_karyawan', array('id' => 'form-tambah-karyawan')); ?>    
    <div id="modal-tambah-karyawan" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title mt-0">Tambah Karyawan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">    
                <input type="hidden" name="nik">
                <div class="form-group row">
                    <label for="" class="col-3">NIK</label>
                    <input type="text" name="nik" id="nik" class="form-control col-8" required>
                </div>
                <div class="form-group row">
                    <label for="" class="col-3">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control col-8" required>
                </div>
                <div class="form-group row">
                    <label for="" class="col-3">Email</label>
                    <input type="email" id="email" name="email" class="form-control col-8" required>
                </div>
                <div class="form-group row">
                    <label for="" class="col-3">Unit/Bagian</label>
                    <select name="unit" id="unit" class="form-control col-8">
                        <option value="">Pilih Unit</option>
                        <?php $__currentLoopData = $unit; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($item->kode_unit); ?>"><?php echo e($item->nama_unit); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="form-group row">
                    <label for="" class="col-3">Jabatan</label>
                    <select name="jabatan" id="jabatan" class="form-control jabatan col-8">
                        <option value="">Pilih Jabatan</option>
                        <?php $__currentLoopData = $jabatan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($item->kode_tingkatan); ?>"><?php echo e($item->keterangan_tingkatan); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light btn-sm waves-effect" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light">Simpan</button>
            </div>
        </div>
        <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <?php echo form_close(); ?>


    <?php echo form_open('app/master-data/karyawan/ubahpass', array('id' => 'form-ubahpass-karyawan')); ?>

    <div id="modal-ubahpass-karyawan" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0">Ubah Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="nik" value="">
                    <table>
                        <tr>
                            <td width=40>
                                <img src="https://www.nicepng.com/png/detail/128-1280406_view-user-icon-png-user-circle-icon-png.png" alt="image" class="img-fluid d-block rounded-circle" width="32" />
                            </td>
                            <td>
                                <span style="font-weight: bold;" class="cp-user_detail"></span>
                            </td>
                        </tr>
                    </table>
                    <hr class="mt-2 mb-1" style="background-color:black;">
                    <div class="form-group">
                        <label for="">New Password</label>
                        <input type="text" class="form-control" placeholder="Buat password baru..." name="password" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-xs waves-effect" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary btn-xs waves-effect waves-light">Simpan Password</button>
                </div>
            </div>        
        </div>
    </div>
    <?php echo form_close(); ?>


    <?php echo form_open('', array('id' => 'form-hapus-karyawan')); ?>

    <div id="modal-hapus-karyawan" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title mt-0">Hapus Karyawan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">    
                <input type="hidden" name="nik">
                <p class="mb-0">
                    Apakah anda yakin ingin menghapus <b><span class="detail"></span></b>?
                </p>
            </div>      
            <div class="modal-footer">
                <div class="float-right">
                    <a href="javascript:void(0)" class="btn btn-light btn-xs" data-dismiss="modal">Batal</a>
                    <button type="submit" class="btn btn-danger btn-xs">Hapus</button>
                </div>
            </div>      
        </div>
    </div>
    <?php echo form_close(); ?>


    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script src="<?php echo e(base_url('assets/js/select2.min.js')); ?>"></script>
<script src="<?php echo e(base_url('assets/js/bootstrap-select.min.js')); ?>"></script>

<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="<?php echo e(base_url('assets/js/jquery.signature.min.js')); ?>"></script>
<script src="<?php echo e(base_url('assets/js/jquery.ui.touch-punch.min.js')); ?>"></script>

<script src="<?php echo e(base_url('assets/js/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(base_url('assets/js/dataTables.bootstrap4.min.js')); ?>"></script>
<script src="<?php echo e(base_url('assets/js/dataTables.responsive.min.js')); ?>"></script>
<script src="<?php echo e(base_url('assets/js/responsive.bootstrap4.min.js')); ?>"></script>

<script src="<?php echo e(base_url('assets/js/jquery.steps.min.js')); ?>"></script>
<script src="<?php echo e(base_url('assets/js/jquery.validate.min.js')); ?>"></script>
<script src="<?php echo e(base_url('assets/js/form-wizard.init.js')); ?>"></script>
<script src="<?php echo e(base_url('assets/js/bootstrap-filestyle.min.js')); ?>"></script>
<script>
    $(document).ready(function(){
        $('.dataTable').dataTable({
            stateSave: true
        })

        $('#tb-karyawan').on('click', '.btn-hapus', function(){
            const data = {
                nik: $(this).data('nik'),
                nama_lengkap: $(this).data('nama_lengkap'),
                unit: $(this).data('unit'),
                email: $(this).data('email'),
                jabatan: $(this).data('jabatan'),
                e_nik: $(this).data('e_nik')
            }

            const base_url = '<?php echo e(base_url()); ?>'
            $('#form-hapus-karyawan').attr('action', base_url + 'app/master-data/karyawan/hapus/' + data.e_nik + '?_a=' + btoa(data.nik))
            
            $('#modal-hapus-karyawan input[type="hidden"][name="nik"]').val(data.nik)
            $('#modal-hapus-karyawan span.detail').text(data.nik + ' - ' + data.nama_lengkap + ' ('+data.unit+', '+data.jabatan+', '+data.email+')')
            $('#modal-hapus-karyawan').modal('show')
        })

        $('#tb-karyawan').on('click', '.btn-edit', function(){

            const data = {
                nik: $(this).data('nik'),
                nama_lengkap: $(this).data('nama_lengkap'),
                email: $(this).data('email'),
                kode_unit: $(this).data('kode_unit'),
                kode_tingkatan: $(this).data('kode_tingkatan'),
                e_nik: $(this).data('e_nik')
            }

            const base_url = '<?php echo e(base_url()); ?>'
            $('#form-edit-karyawan').attr('action', base_url + 'app/master-data/karyawan/edit/' + data.e_nik + '?_a=' + btoa(data.nik))
            
            $('#modal-edit-karyawan span.form-nik').text(data.nik)
            $('#modal-edit-karyawan input[type="hidden"][name="nik"]').val(data.nik)
            $('#modal-edit-karyawan input.nama-lengkap').val(data.nama_lengkap)
            $('#modal-edit-karyawan input.email').val(data.email)
            $('#modal-edit-karyawan select.unit option[value="'+data.kode_unit+'"]').attr('selected', true)
            $('#modal-edit-karyawan select.jabatan option[value="'+data.kode_tingkatan+'"]').attr('selected', true)
            $('#modal-edit-karyawan').modal('show')
        })

        $('#tb-karyawan').on('click', '.btn-ubahpass', function(){
            const data = {
                nik: $(this).data('nik'),
                nama_lengkap: $(this).data('nama_lengkap'),
                unit: $(this).data('unit'),
                email: $(this).data('email'),
                jabatan: $(this).data('jabatan'),
                e_nik: $(this).data('e_nik')
            }

            $('#modal-ubahpass-karyawan input[name="nik"]').val(data.nik)
            $('#modal-ubahpass-karyawan span.cp-user_detail').text(data.nama_lengkap+' ('+data.nik+', '+data.email+')')
            $('#modal-ubahpass-karyawan').modal('show')
        })
    })
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp_php_7\htdocs\hibah_upj\application\views/admin/master_data/karyawan.blade.php ENDPATH**/ ?>