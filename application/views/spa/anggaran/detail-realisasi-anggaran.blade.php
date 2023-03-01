<?php 
$session = $CI->session->userdata('user_sessions');
$year = date('Y');
?>
@extends('spa.layouts.user')

@section('title')
    Anggaran - Realisasi
@endsection

@section('page-title')
    Realisasi Anggaran <?= $year ?>
@endsection

@section('css')
<link rel="stylesheet" href="{{ base_url('assets/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ base_url('assets/css/responsive.bootstrap4.min.css') }}">
<style>
    .a-penyesuaian-biaya:hover{
        cursor:pointer !important;
    }
</style>
@endsection

@section('breadcrumb')
<li class="breadcrumb-item">Anggaran</li>
<li class="breadcrumb-item active">Realisasi</li>
@endsection

@section('content')
<div class="col-lg-12">
    <a href="<?= base_url('app/sim-spa/anggaran/realisasi') ?>" class="btn btn-secondary text-white btn-sm"><i class="mdi mdi-arrow-left"></i> Kembali</a>
    <div class="card mt-3">
        <div class="card-header">
            Data Detail Actbud
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="">Prodi / Bagian / Unit</label>
                    <input class="form-control" name="unit" value="<?= $actbud['nama_unit']; ?>" type="text" readonly/>
                </div>
                <div class="col-md-6 form-group">
                    <label for="">PIC</label>
                    <input class="form-control" name="pic" value="<?= $actbud['nama_lengkap']; ?>" type="text" readonly/>
                </div>
                <div class="col-md-12 form-group">
                    <label for="">Nama & Uraian Kegiatan</label>
                    <textarea class="form-control" name="nama_kegiatan" readonly rows="3"><?= $actbud['nama_kegiatan']; ?></textarea>
                </div>
                <div class="col-md-12 form-group">
                    <label for="">No Borang Kegiatan</label>
                    <input class="form-control" name="no_borang" value="<?= $actbud['no_borang']; ?>" type="text" readonly/>
                </div>
                <div class="col-md-12 form-group">
                    <label for="">KPI Yang Dicapai</label>
                    <textarea class="form-control" name="kpi" readonly rows="3"><?= $actbud['kpi']; ?></textarea>
                </div>
                <div class="col-md-6 form-group">
                    <label for="">No. Dokumen</label>
                    <input class="form-control" name="kode_uraian" value="<?= $actbud['kode_uraian']; ?>" type="text" readonly/>
                </div>
                <div class="col-md-6 form-group">
                    <label for="">Kode Pencairan</label>
                    <input class="form-control" name="kode_pencairan" value="<?= $actbud['kode_pencairan']; ?>" type="text" readonly/>
                    <input hidden name="kd_act" value="<?php echo $actbud['kd_act'];?>">
                </div>
                <div class="col-md-6 form-group">
                    <label for="">Anggaran</label>
                    <input class="form-control" name="agr" value="Rp. <?= number_format($actbud['agr'],'0','.','.'); ?>" type="text" readonly/>
                </div>
                <div class="col-md-6 form-group">
                    <label for="">Tanggal Diajukan</label>
                    <input class="form-control" name="tanggal_pembuatan" value="<?= $actbud['tanggal_pembuatan']; ?>" type="text" readonly/>
                </div>
                <div class="col-md-6 form-group">
                    <label for="">Tanggal Pelaksanaan (Mulai)</label>
                    <input class="form-control" name="tgl_m" value="<?= $actbud['tgl_m'] ?>" type="text" readonly/>
                </div>
                <div class="col-md-6 form-group">
                    <label for="">Tanggal Pelaksanaan (Selesai)</label>
                    <input class="form-control" name="tgl_s" value="<?= $actbud['tgl_s'] ?>" type="text" readonly/>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            Data Detail Biaya
        </div>
        <div class="card-body">
            <div class="table-responsive my-4">
                <table class="table table-striped table-bordered table-hover" id="table-detail-realisasi-anggaran" style="width:100%;">
                    <thead>
                        <tr>
                            <th><center>No</center></th>
                            <th><center>Jenis Biaya</center></th>
                            <th><center>Keterangan Jenis Biaya</center></th>
                            <th><center>Biaya Yang Disetujui</center></th>
                            <th><center>Realisasi Biaya</center></th>
                            <th><center>Catatan Realisasi</center></th>
                        </tr>
                    </thead>
                    <tbody id="tbody-table-detail-realisasi-anggaran">
                    <?php
                        $totalBiayaDisetujui = 0;
                        $totalRealisasiBiaya = 0;
                        if(!empty($t_j_b_act)){
                            $no = 1;
                            foreach($t_j_b_act as $key){
                                $totalBiayaDisetujui += $key['aju_agr'];
                                $totalRealisasiBiaya += $key['pra_pyn'];
                    ?>
                                <tr>
                                    <td align="center"><?= $no++; ?></td>
                                    <td><?= $key['jns_b']; ?></td>
                                    <td><?= $key['ket']; ?></td>
                                    <td align="right">Rp. <?= number_format($key['aju_agr'],'0','.','.'); ?></td>
                                    <td align="right">
                                        <?php
                                            if($key['status_penyesuaian'] == ''){
                                        ?>
                                                <a class="a-penyesuaian-biaya text-primary" data-id="<?= $key['id']; ?>" data-kd-act="<?= $key['kd_act']; ?>" data-jns-b="<?= $key['jns_b'] ?>" data-pra-pyn="<?= $key['pra_pyn'] ?>" data-ket-pyn="<?= $key['ket_pyn'] ?>"><i class="mdi mdi-pencil" aria-hidden="true"></i> <?= number_format($key['pra_pyn'],'0','.','.'); ?> </center></a>
                                        <?php
                                            }else{
                                        ?>
                                                <i class="mdi mdi-lock" aria-hidden="true"></i> Rp. <?= number_format($key['pra_pyn'],'0','.','.'); ?>
                                        <?php
                                            }
                                        ?>
                                    </td>
                                    <td><?= $key['ket_pyn']; ?></td>
                                </tr>
                    <?php
                            }
                        }
                    ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td align="center" colspan="3"><strong>Total</strong></td>
                            <td align="right"><strong>Rp. <?= $totalBiayaDisetujui; ?></strong></td>
                            <td align="right"><strong>Rp. <?= $totalRealisasiBiaya; ?></strong></td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
<br>

<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            Finalisasi Penyesuaian Anggaran
        </div>
        <div class="card-body">
            {!! form_open('app/sim-spa/anggaran/realisasi/' . $id . '/finalisasi-penyesuaian-anggaran', array('class' => 'myForm')) !!}
                <input type="hidden" name="id" value="<?= $id ?>">
                <input type="hidden" name="pra_pyn" value="<?= $totalRealisasiBiaya; ?>" >
                <button type="submit" class="btn btn-primary waves-effect waves-light btn-block"><i class="mdi mdi-content-save"></i> Finalisasi Penyesuaian Anggaran</button>
            {!! form_close() !!}
        </div>
    </div>
</div>

{!! form_open('app/sim-spa/anggaran/realisasi/' . $id . '/penyesuaian-biaya', array('class' => 'myForm')) !!}
    <div id="modal-penyesuaian-biaya" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0">Realisasi Jenis Biaya</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>                
                <div class="modal-body">
                    <input type="hidden" name="id" value="">
                    <input type="hidden" name="kd_act" value="">
                    <div class="form-group">
                        <label for="">Jenis Biaya</label>
                        <textarea class="form-control" name="jenis_biaya" id="jenis_biaya" rows="4" readonly></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Nominal Realisasi</label>
                        <input class="form-control" name="pra_pyn" id="pra_pyn" type="number" min="0" required/>
                    </div>
                    <div class="form-group">
                        <label for="">Catatan Realisasi</label>
                        <textarea class="form-control" name="ket_pyn" id="ket_pyn" rows="4"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm waves-effect" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light"><i class="mdi mdi-content-save"></i> Simpan</button>
                </div>
            </div>
        </div>
    </div>
{!! form_close() !!}

@endsection

@section('js')
<script src="{{ base_url('assets/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ base_url('assets/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ base_url('assets/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ base_url('assets/js/responsive.bootstrap4.min.js') }}"></script>
<script>
    $(document).ready(function(){
        $("#table-detail-realisasi-anggaran").DataTable();
        
        $('#tbody-table-detail-realisasi-anggaran').on('click', '.a-penyesuaian-biaya', function(){
            var id = $(this).data('id');
            var kd_act = $(this).data('kd-act');
            var jns_b = $(this).data('jns-b');
            var pra_pyn = $(this).data('pra-pyn');
            var ket_pyn = $(this).data('ket-pyn');
            $('#modal-penyesuaian-biaya input[name="id"]').val(id);
            $('#modal-penyesuaian-biaya input[name="kd_act"]').val(kd_act);
            $('#modal-penyesuaian-biaya textarea[name="jenis_biaya"]').text(jns_b);
            $('#modal-penyesuaian-biaya input[name="pra_pyn"]').val(pra_pyn);
            $('#modal-penyesuaian-biaya textarea[name="ket_pyn"]').text(ket_pyn);
            $('#modal-penyesuaian-biaya').modal('show');
        });
    });

    /* Fungsi formatRupiah */
    function formatRupiah(angka, prefix){
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split   		= number_string.split(','),
        sisa     		= split[0].length % 3,
        rupiah     		= split[0].substr(0, sisa),
        ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if(ribuan){
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }
</script>
@endsection