

<?php $__env->startSection('title', 'Hibah - Detail Kegiatan'); ?>

<?php $__env->startSection('page-title'); ?>
    <a href="<?php echo e($_SERVER['HTTP_REFERER']); ?>"><i class="mdi mdi-arrow-left"></i></a> Detail Kegiatan
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="<?php echo e(base_url('assets/css/dataTables.bootstrap4.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(base_url('assets/css/responsive.bootstrap4.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(base_url('assets/css/jquery-ui.custom-for-signature.css')); ?>">
<link rel="stylesheet" href="<?php echo e(base_url('assets/css/jquery.signature.css')); ?>">
<link rel="stylesheet" href="<?php echo e(base_url('assets/css/select2.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(base_url('assets/css/bootstrap-select.min.css')); ?>">
<style>
    .kbw-signature { width: 300px; height: 300px;}
    #ttd canvas{
        width: 100% !important;
        height: auto;
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item"><a href="javascript: void(0);"><i class="mdi mdi-briefcase-outline"></i> Hibah</a></li>
<li class="breadcrumb-item active"><a href="javascript: void(0);"><b><i class="mdi mdi-file-document-outline"></i> <?php echo e($data->kode_uraian); ?></a></b></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-purple">
                <h5 class="card-title mb-0 text-white">Data Hibah</h5>
            </div>
            <div class="card-body">
                <div class="row">     
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">PIC</label>
                            <p class="form-control-static">
                                <span class="badge bg-info p-2">
                                    <b><i class="mdi mdi-account"></i> <?php echo e($data->nama_karyawan == '' ? 'belum ditentukan' : $data->nama_karyawan); ?></b>
                                </span>
                            </p>
                        </div>
                    </div>               
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Nama Hibah</label>
                            <p class="form-control-static">
                                <span class="" style="font-size: 14px;">
                                    <?php echo e($data->nama_hibah_sponsorship); ?>

                                </span>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Deskripsi Kegiatan</label>
                            <p class="form-control-static">
                                <span class="" style="font-size: 14px;">
                                    <?php echo e($data->uraian_kegiatan); ?>

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
                            <label for="">Cara Ukur</label>
                            <p class="form-control-static">
                                <span class="" style="font-size: 14px;">
                                    <?php echo e($data->cara_ukur); ?>

                                </span>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Base Line</label>
                            <p class="form-control-static">
                                <span class="" style="font-size: 14px;">
                                    <?php echo e($data->base_line); ?>

                                </span>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Target</label>
                            <p class="form-control-static">
                                <span class="" style="font-size: 14px;">
                                    <?php echo e($data->target); ?>

                                </span>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Output</label>
                            <p class="form-control-static">
                                <span class="" style="font-size: 14px;">
                                    <?php echo e($data->output); ?>

                                </span>
                            </p>
                        </div>
                    </div>                    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Periode</label>
                            <p class="form-control-static">
                                <span class="" style="font-size: 14px;">
                                <?php switch($data->periode):
                                    case (1): ?>
                                        <?php echo e("Ganjil"); ?> 
                                        <?php break; ?>
                                    <?php case (2): ?>
                                        <?php echo e("Genap"); ?>

                                        <?php break; ?>
                                    <?php default: ?>
                                        <?php echo e("Unknown"); ?>

                                <?php endswitch; ?>
                                </span>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Kode Pencairan</label>
                            <p class="form-control-static">
                                <span class="badge bg-primary p-2">
                                    <b><?php echo e($data->kode_pencairan); ?></b>
                                </span>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Tanggal Buat</label>
                            <p class="form-control-static">
                                <span class="" style="font-size: 14px;">
                                    <i class="mdi mdi-calendar"></i> <?php echo e($data->tanggal_buat); ?>

                                </span>
                            </p>
                        </div>
                    </div>                
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Total Anggaran</label>
                            <p class="form-control-static">
                                <span class="badge bg-success p-2">
                                    <b><i class="mdi mdi-cash"></i> <?php echo e(rupiah($data->total_agr)); ?></b>
                                </span>
                            </p>
                        </div>
                    </div>                    
                </div>
            </div>
            <!--<div class="card-footer">
                <a href="javascript:void(0)" class="btn btn-primary btn-sm float-right ml-1" id="btn-finalisasi" data-id="<?php echo e(encrypt($data->id)); ?>"><i class="mdi mdi-content-save"></i> Finalisasi</a>
                <a href="javascript:void(0)" data-id="<?php echo e(encrypt($data->id)); ?>" data-nama_hibah="<?php echo e($data->nama_hibah_sponsorship); ?>" 
                    data-deskripsi="<?php echo e($data->uraian_kegiatan); ?>" data-kpi="<?php echo e($data->kpi); ?>" data-cara_ukur="<?php echo e($data->cara_ukur); ?>" 
                    data-base_line="<?php echo e($data->base_line); ?>" data-target="<?php echo e($data->target); ?>" data-output="<?php echo e($data->output); ?>" 
                    data-periode="<?php echo e($data->periode); ?>" data-kode_pencairan="<?php echo e($data->kode_pencairan); ?>" data-total_anggaran="<?php echo e($data->total_agr); ?>" 
                    data-ttd_pic="<?php echo e($data->ttd_pic); ?>" class="btn btn-secondary btn-sm float-right ml-1" id="ubah-data"><i class="mdi mdi-pencil"></i> Ubah</a>
                <a href="javascript:void(0)" data-id="<?php echo e(encrypt($data->id)); ?>" class="btn btn-danger btn-sm float-right" id="btn-batalkan"><i class="mdi mdi-trash-can-outline"></i> Batalkan</a>
            </div>-->
        </div>
    </div>

    <!--  Modal edit -->
    <?php echo form_open('app/hibah/v_detail/' . $CI->uri->segment(4) . '/edit_hibah', array('id' => 'form-ubah')); ?>

    <div class="modal fade bs-example-modal-lg" id="modal-edit" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0">Ubah Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" value="">
                    <div class="form-group">
                        <label for="">Nama Hibah</label>
                        <input type="text" name="nama_hibah" id="nama_hibah" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">Deskripsi Kegiatan</label>
                        <textarea name="deskripsi_kegiatan" id="deskripsi_kegiatan" class="form-control" cols="4" rows="4" required></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">KPI</label>
                                <textarea name="kpi" id="kpi" class="form-control" cols="4" rows="4" required></textarea>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Cara Ukur</label>
                                <textarea name="cara_ukur" id="cara_ukur" class="form-control" cols="4" rows="4" required></textarea>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Base Line</label>
                                <textarea name="base_line" id="base_line" class="form-control" cols="4" rows="4" required></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Target</label>
                                <textarea name="target" id="target" class="form-control" cols="4" rows="4" required></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Output</label>
                                <textarea name="output" id="output" class="form-control" cols="4" rows="4" required></textarea>
                            </div>
                        </div>                        
                    </div>
                    <div class="form-group">
                        <label for="">Kode Pencairan</label>
                        <input type="text" name="kode_pencairan" id="kode_pencairan" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label class="control-label " for="address2">Periode</label>
                        <div class="ml-1">
                            <div class="radio radio-info form-check-inline">
                                <input type="radio" id="periode1" value="1" name="periode">
                                <label for="periode1"> Ganjil </label>
                            </div>
                            <div class="radio form-check-inline">
                                <input type="radio" id="periode2" value="2" name="periode">
                                <label for="periode2"> Genap </label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-lg-2 control-label " for="address2">Ubah Anggaran *</label>
                        <div class="col-lg-10">
                            <input type="text" name="total_anggaran" id="total_anggaran" class="form-control" required>                                
                            <span class="help-block"><small>Tentukan total anggaran kegiatan.</small></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-2 control-label" for="address2">PIC *</label>
                        <div class="col-lg-10">
                            <select name="pic" id="pic" class="form-control select2" style="width:100%;" required>
                                <option value="">Pilih PIC Kegiatan</option>                                    
                                <?php $__currentLoopData = $unit->result(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <optgroup label="<?php echo e($item->nama_unit); ?>">
                                        <?php $__currentLoopData = $karyawan->result(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ky): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($ky->kode_unit == $item->kode_unit): ?>
                                                <option value="<?php echo e($ky->nik); ?>" <?php echo e($ky->nik == $data->pic ? "selected" : ""); ?>><?php echo e($ky->nama_lengkap); ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </optgroup>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <span class="help-block"><small>Tentukan pic.</small></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-2 control-label" for="address2">Unit *</label>
                        <div class="col-lg-10">
                            <select name="unit" id="unit" class="form-control select2" style="width:100%;" required>
                                <option value="">Pilih Unit Kegiatan</option>
                                <?php $__currentLoopData = $unit->result(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($item->kode_unit); ?>" <?php echo e($item->kode_unit == $data->kode_unit ? "selected" : ""); ?>><?php echo e($item->nama_unit); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <span class="help-block"><small>Tentukan unit.</small></span>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="">Tanda Tangan Sebelumnya:</label>
                            <img src="" alt="TTD Sebelumnya" srcset="" id="ttd_old">
                        </div>
                        <div class="col-md-6">
                            <label for="">Ubah Menjadi:</label><br />
                            <div id="ttd"></div>
                            <br/>
                            <button id="clear_ttd" class="btn btn-danger btn-sm"><i class="mdi mdi-trash-can-outline"></i> Hapus Tanda Tangan</button>
                            <textarea id="signature64" name="tanda_tangan" style="display: none"></textarea>
                        </div>                        
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-sm float-right"><i class="mdi mdi-content-save"></i> Simpan Perubahan</button>
                    <a href="#" data-dismiss="modal" class="btn btn-light btn-sm float-right mr-2">Batal</a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <?php echo form_close(); ?>

    <!-- /.modal -->

    <!-- Modal batalkan kegiatan -->
    <?php echo form_open('app/hibah/v_detail/' . $CI->uri->segment(4) . '/batalkan_kegiatan'); ?>

    <div id="modal-batalkan" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0">Batalkan Kegiatan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" value="">
                    <p class="mb-0 pb-0">Apakah anda yakin ingin membatalkan kegiatan ini?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm waves-effect" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-danger btn-sm waves-effect waves-light">Ya, batalkan!</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    <?php echo form_close(); ?>


    <?php echo form_open('app/hibah/v_detail/' . $CI->uri->segment(4) . '/finalisasi'); ?>

    <div id="modal-finalisasi" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0">Finalisasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" value="">                    
                    <div class="alert alert-info">
                        <p class="mb-0"><b>Note:</b> Pastikan anda sudah mengisi data dengan benar, setelah difinalisasi anda tidak dapat lagi mengubah data.</p>
                    </div>
                    <p class="mb-0 pb-0">Apakah anda yakin ingin melakukan finalisasi?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm waves-effect" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light"><i class="mdi mdi-file-lock-outline"></i> Finalisasi</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    <?php echo form_close(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script src="<?php echo e(base_url('assets/js/select2.min.js')); ?>"></script>
    <script src="<?php echo e(base_url('assets/js/bootstrap-select.min.js')); ?>"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="<?php echo e(base_url('assets/js/jquery.signature.min.js')); ?>"></script>
    <script src="<?php echo e(base_url('assets/js/jquery.ui.touch-punch.min.js')); ?>"></script>
    <script>
        $(document).ready(function(){

            $(".select2").select2()

            var sig = $('#ttd').signature({syncField: '#signature64', syncFormat: 'PNG'});
            $('#clear_ttd').click(function(e) {
                e.preventDefault();
                sig.signature('clear');
                $("#signature64").val('');
            });

            var rupiah = document.getElementById('total_anggaran');
            var final_anggaran = document.getElementById('final_anggaran')

            rupiah.addEventListener('keyup', function(e){			            
                rupiah.value = formatRupiah(this.value, 'Rp. ');            
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
                return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
            }

            $('#ubah-data').click(function(){
                
                const data = {
                    id: $(this).data('id'),
                    nama_hibah: $(this).data('nama_hibah'),
                    deskripsi: $(this).data('deskripsi'),
                    kpi: $(this).data('kpi'),
                    cara_ukur: $(this).data('cara_ukur'),
                    base_line: $(this).data('base_line'),
                    target: $(this).data('target'),
                    output: $(this).data('output'),
                    periode: $(this).data('periode'),
                    kode_pencairan: $(this).data('kode_pencairan'),
                    total_anggaran: $(this).data('total_anggaran'),
                    ttd_pic: $(this).data('ttd_pic'),
                }
                
                $('#modal-edit').modal('show')
                $('#modal-edit input[type="hidden"][name="id"]').val(data.id)
                $('#modal-edit input[name="nama_hibah"]').val(data.nama_hibah)
                $('#modal-edit input[name="kode_pencairan"]').val(data.kode_pencairan)
                $('#modal-edit #ttd_old').attr('src', 'data:image/png;base64, ' + data.ttd_pic)
                $('#modal-edit textarea[name="deskripsi_kegiatan"]').val(data.deskripsi)
                $('#modal-edit textarea[name="kpi"]').val(data.kpi)
                $('#modal-edit textarea[name="cara_ukur"]').val(data.cara_ukur)
                $('#modal-edit textarea[name="base_line"]').val(data.base_line)
                $('#modal-edit textarea[name="target"]').val(data.target)
                $('#modal-edit textarea[name="output"]').val(data.output)
                $('#modal-edit input[type="radio"][name="periode"][value="'+data.periode+'"]').attr('checked', true)
                $('#modal-edit input[name="total_anggaran"]').val(formatRupiah(data.total_anggaran.toString(), 'Rp. '))
            })

            $('#btn-batalkan').click(function(){
                $('#modal-batalkan').modal('show')
                $('#modal-batalkan input[name="id"]').val($(this).data('id'))
            })

            $('#btn-finalisasi').click(function(){
                $('#modal-finalisasi').modal('show')
                $('#modal-finalisasi input[name="id"]').val($(this).data('id'))
            })
        })
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('ig.layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp_php_7\htdocs\hibah_upj\application\views/ig/users/hibah/v_detail_hibah.blade.php ENDPATH**/ ?>