<?php
$unit_selected = $CI->input->post('unit_prodi', true);
$karyawan = $CI->db->query("SELECT a.nik,a.nama_lengkap,a.kode_unit FROM tbl_karyawan AS a 
WHERE a.status = 'Aktif' ORDER BY a.nama_lengkap ASC")->result();
$unit = $CI->db->get_where('tbl_unit', ['kode_unit' => $unit_selected])->row();
$unit_all = $CI->db->get('tbl_unit')->result();
?>



<?php $__env->startSection('title', 'Hibah - Preview Upload'); ?>

<?php $__env->startSection('page-title'); ?>
   <a href="<?php echo e(base_url('app/hibah')); ?>"><i class="mdi mdi-arrow-left"></i></a> Upload Excel
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="<?php echo e(base_url('assets/css/dataTables.bootstrap4.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(base_url('assets/css/responsive.bootstrap4.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(base_url('assets/css/jquery-ui.custom-for-signature.css')); ?>">
<link rel="stylesheet" href="<?php echo e(base_url('assets/css/jquery.signature.css')); ?>">
<link rel="stylesheet" href="<?php echo e(base_url('assets/css/select2.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(base_url('assets/css/bootstrap-select.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(base_url('assets/css/daterangepicker.css')); ?>">
<link rel="stylesheet" href="<?php echo e(base_url('assets/css/bootstrap-datepicker.min.css')); ?>">
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
<li class="breadcrumb-item active"><a href="javascript: void(0);"><i class="mdi mdi-file-upload-outline"></i> Preview Upload</a></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="col-md-12">
        <div class="card-box">            
            <h4 class="header-title"><i class="mdi mdi-microsoft-excel"></i> Preview Data</h4>            
            <div class="alert alert-danger" id='kosong'>
            Terdapat <b><span id='jumlah_kosong'></span></b> baris data yang belum lengkap! Mohon lengkapi data tersebut lalu upload kembali.
            </div>                        
            <div class="form-group mt-3">
                <label for="">Unit :</label>
                <span class="badge bg-info"><?php echo e($unit->nama_unit); ?></span>
            </div>
            <?php echo form_open('app/hibah/preview_upload/upload', array('autocomplete' => 'off', 'accept-charset' => 'utf-8')); ?>

            <div class="table-responsive mt-3">
                <table class="table table-bordered">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th width=50 style="vertical-align: middle">No</th>
                            <th style="vertical-align: middle">Nama Hibah/Sponsorship</th>
                            <th style="vertical-align: middle">Uraian Kegiatan</th>
                            <th class="texxt-center" style="vertical-align: middle">Jenis Income</th>
                            <th style="vertical-align: middle">KPI</th>
                            <th style="vertical-align: middle">Cara Ukur</th>
                            <th style="vertical-align: middle">Base Line</th>
                            <th style="vertical-align: middle">Target</th>
                            <th style="vertical-align: middle">Output</th>                            
                            <th class="text-center" style="vertical-align: middle">Periode</th>
                            <th class="text-center" style="vertical-align: middle">Kode Pencairan</th>
                            <th class="text-center" style="vertical-align: middle">Tahun</th>
                            <th class="text-center" style="vertical-align: middle">Total Anggaran</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $numrow = 1;
                            $kosong = 0;
                            $num = 1;
                        ?>
                        <?php $__currentLoopData = $sheet; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $nama_hibah_sponsorship = $row['A'];
                                $uraian = $row['B'];
                                $jenis_ig = $row['C'];
                                $kpi = $row['D'];
                                $cara_ukur = $row['E'];
                                $base_line = $row['F'];
                                $target = $row['G'];
                                $output = $row['H'];
                                //$unit_prodi = $row['I'];
                                $periode = $row['I'];
                                $kode_pencairan = $row['J'];
                                $tahun = $row['K'];
                                $total_anggaran = $row['L'];
                                $numrow++;
                            ?>

                            <?php if($numrow > 1): ?>
                                <input type="hidden" name="nama_hibah[]" value="<?php echo e($nama_hibah_sponsorship); ?>">
                                <input type="hidden" name="uraian[]" value="<?php echo e($uraian); ?>">
                                <input type="hidden" name="jenis_ig[]" value="<?php echo e($jenis_ig); ?>">
                                <input type="hidden" name="kpi[]" value="<?php echo e($kpi); ?>">
                                <input type="hidden" name="unit[]" value="<?php echo e($unit_selected); ?>">
                                <input type="hidden" name="cara_ukur[]" value="<?php echo e($cara_ukur); ?>">
                                <input type="hidden" name="base_line[]" value="<?php echo e($base_line); ?>">
                                <input type="hidden" name="target[]" value="<?php echo e($target); ?>">
                                <input type="hidden" name="output[]" value="<?php echo e($output); ?>">
                                <input type="hidden" name="periode[]" value="<?php echo e($periode); ?>">
                                <input type="hidden" name="kode_pencairan[]" value="<?php echo e($kode_pencairan); ?>">
                                <input type="hidden" name="tahun[]" value="<?php echo e($tahun); ?>">
                                <input type="hidden" name="total_anggaran[]" value="<?php echo e($total_anggaran); ?>">
                                <?php
                                    $td_nama_hibah_sponsorship = empty($nama_hibah_sponsorship) ? " style='background:#E07171;'" : "style='vertical-align:middle;'";
                                    $td_uraian = empty($uraian) ? " style='background:#E07171;'" : "style='vertical-align:middle;'";
                                    $td_jenis_ig = empty($jenis_ig) ? " style='background:#E07171;'" : "style='vertical-align:middle;'";
                                    $td_kpi = empty($kpi) ? " style='background:#E07171;'" : "style='vertical-align:middle;'";
                                    $td_cara_ukur = empty($cara_ukur) ? " style='background:#E07171;'" : "style='vertical-align:middle;'";
                                    $td_base_line = empty($base_line) ? " style='background:#E07171;'" : "style='vertical-align:middle;'";
                                    $td_target = empty($target) ? " style='background:#E07171;'" : "style='vertical-align:middle;'";
                                    $td_output = empty($output) ? " style='background:#E07171;'" : "style='vertical-align:middle;'";
                                    $td_periode = empty($periode) ? " style='background:#E07171;'" : "style='vertical-align:middle;'";
                                    $td_kode_pencairan = empty($kode_pencairan) ? " style='background:#E07171;'" : "style='vertical-align:middle;'";
                                    $td_tahun = empty($tahun) ? " style='background:#E07171;'" : "style='vertical-align:middle;'";
                                    $td_total_anggaran = empty($total_anggaran) ? " style='background:#E07171;'" : "style='vertical-align:middle;'";                                    

                                    if($nama_hibah_sponsorship == "" || $uraian == "" || $jenis_ig == "" || $kpi == "" || 
                                    $cara_ukur == "" || $base_line == "" || $target == "" || $output == "" || $periode == "" || 
                                    $kode_pencairan == "" || $tahun == "" || $total_anggaran == ""){
                                        // increment nilai kosong
                                        $kosong++;
                                    }
                                ?>

                                <tr>
                                    <th class="text-center" style="vertical-align: middle"><?php echo e($num++); ?></th>
                                    <td <?php echo $td_nama_hibah_sponsorship; ?>><?php echo e($nama_hibah_sponsorship); ?></td>
                                    <td <?php echo $td_uraian; ?>><?php echo e($uraian); ?></td>
                                    <td class="text-center" <?php echo $td_jenis_ig; ?>>
                                        <?php switch($jenis_ig):
                                            case ('hibah'): ?>
                                                <span class="badge bg-info">Hibah</span>
                                                <?php break; ?>
                                            <?php case ('sponsorship'): ?>
                                                <span class="badge bg-warning">Sponsorship</span>
                                                <?php break; ?>
                                            <?php default: ?>                                                
                                        <?php endswitch; ?>
                                    </td>
                                    <td <?php echo $td_kpi; ?>>
                                        <?php echo e($kpi); ?>

                                    </td>
                                    <td <?php echo $td_cara_ukur; ?>>
                                        <?php echo e($cara_ukur); ?>

                                    </td>
                                    <td <?php echo $td_base_line; ?>>
                                        <?php echo e($base_line); ?>

                                    </td>
                                    <td <?php echo $td_target; ?>>
                                        <?php echo e($target); ?>

                                    </td>
                                    <td <?php echo $td_output; ?>>
                                        <?php echo e($output); ?>

                                    </td>                                    
                                    <td class="text-center" <?php echo $td_periode; ?>>
                                        <?php switch($periode):
                                            case (1): ?>
                                                <span class="badge bg-success">Ganjil</span>
                                                <?php break; ?>
                                            <?php case (2): ?>
                                                <span class="badge bg-success">Genap</span>
                                                <?php break; ?>
                                            <?php default: ?>                                                
                                        <?php endswitch; ?>
                                    </td>
                                    <td class="text-center" <?php echo $td_kode_pencairan; ?>>
                                        <?php echo e($kode_pencairan); ?>

                                    </td>
                                    <td class="text-center" <?php echo $td_tahun; ?>>
                                        <?php echo e($tahun); ?>

                                    </td>
                                    <td class="text-center" <?php echo $td_total_anggaran; ?>>
                                        <?php echo e(rupiah($total_anggaran)); ?>

                                    </td>
                                </tr>
                                <tr>
                                    <th colspan="2" class="text-right" style="vertical-align: middle;">PIC :</th>
                                    <td colspan="4" style="vertical-align: middle;">
                                        <select class="form-control select2" name="pic[]" required>
                                            <option value="">Pilih PIC</option> 
                                            <?php $__currentLoopData = $unit_all; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <optgroup label="<?php echo e($item->nama_unit); ?>">
                                                    <?php $__currentLoopData = $karyawan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if($item->kode_unit == $kry->kode_unit): ?>                                                            
                                                            <option value="<?php echo e($kry->nik); ?>"><?php echo e($kry->nama_lengkap); ?></option>
                                                        <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </optgroup>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                                                                                     
                                        </select>
                                    </td>                                    
                                    <td colspan="7" style="vertical-align: middle;">
                                        
                                    </td>
                                </tr>
                            <?php endif; ?>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>                    
            </div>            
        </div>

        <?php if($kosong == 0): ?>
            <div class="card-box">    
                <label for="">Tanda Tangan</label><br />
                <div id="ttd"></div>
                <br/>
                <button id="clear_ttd" class="btn btn-danger btn-sm"><i class="mdi mdi-trash-can-outline"></i> Hapus Tanda Tangan</button>
                <textarea id="signature64" name="tanda_tangan" style="display: none" required></textarea>
                <div class="float-right">
                    <a href="<?php echo e(base_url('app/hibah')); ?>" class="btn btn-danger btn-sm">Batal</a>
                    <button type="submit" class="btn btn-primary btn-sm"><i class="mdi mdi-upload"></i> Upload Data</button>                                
                </div>                            
                <br>
            </div>
        <?php endif; ?>
        <?php echo form_close(); ?>


    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <script src="<?php echo e(base_url('assets/js/bootstrap-datepicker.min.js')); ?>"></script>
    <script src="<?php echo e(base_url('assets/js/daterangepicker.js')); ?>"></script>
    <script src="<?php echo e(base_url('assets/js/select2.min.js')); ?>"></script>
    <script src="<?php echo e(base_url('assets/js/bootstrap-select.min.js')); ?>"></script>

    <script src="<?php echo e(base_url('assets/js/jquery.signature.min.js')); ?>"></script>
    <script src="<?php echo e(base_url('assets/js/jquery.ui.touch-punch.min.js')); ?>"></script>

    <script src="<?php echo e(base_url('assets/js/jquery.steps.min.js')); ?>"></script>
    <script src="<?php echo e(base_url('assets/js/jquery.validate.min.js')); ?>"></script>
    <script src="<?php echo e(base_url('assets/js/form-wizard.init.js')); ?>"></script>
    <script>
        $(document).ready(function(){
            var sig = $('#ttd').signature({syncField: '#signature64', syncFormat: 'PNG'});
            $('#clear_ttd').click(function(e) {
                e.preventDefault();
                sig.signature('clear');
                $("#signature64").val('');
            });

            $(".select2").select2()
            $('#kosong').hide()

            <?php if($kosong > 0): ?>
                $(document).ready(function(){
                    // Ubah isi dari tag span dengan id jumlah_kosong dengan isi dari variabel kosong
                    $("#jumlah_kosong").html('<?php echo $kosong; ?>');
                    $("#kosong").show(); // Munculkan alert validasi kosong
                });
            <?php endif; ?>
        })
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp1\htdocs\hibah_upj\application\views/users/hibah/preview_upload_hibah.blade.php ENDPATH**/ ?>