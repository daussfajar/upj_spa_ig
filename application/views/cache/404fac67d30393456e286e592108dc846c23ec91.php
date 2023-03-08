<html>
<head>
    <title>UPJ-SPA | Laporan Pencairan RKAT</title>
    <style type="text/css">
    body,td,th {
        font-family: "Times New Roman", Times, serif;
        font-size: 10px;
    }
    </style>
</head>
<body>
    <div class="row">
        <div class="col-lg-12">
            <table width="100%">
                <tr>
                    <td>
                        <center>
                            <h3 class="page-header">
                                Universitas Pembangunan Jaya
                                <br>
                                <strong>PETTY CASH</strong>
                            </h3>
                        </center>
                    </td>
                    <td width="10%"> No. Dokumen
                        <br>
                        <?php
                            if($actbud[0]['jns_aju_agr'] == 'actbud'){
                                echo 'ACT/' . $actbud[0]['kd_act'];
                            }else{
                                echo 'PTY/' . $actbud[0]['kd_act'];
                            }
                        ?>
                    </td>
                </tr>
            </table>
        </div>
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading" align="center"></div>
                <div class="panel-body">
                    <div class="row">
                        <div class="row-lg-12">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <table border="1" width="100%">
                                        <tr>
                                            <td width="19%" align="left" valign="top">
                                                <label>Prodi / Bagian / Unit :</label>
                                            </td>
                                            <td width="24%" align="left" valign="top">
                                                <strong><?= $unit['nama_unit'];?></strong>
                                            </td>
                                            <td width="25%" align="left" valign="top">
                                                <strong><label>PIC :</label></strong>
                                                <?= $actbud[0]['nama_lengkap'];?>
                                            </td>
                                            <td width="25%" align="left" valign="top">
                                                <strong><label>Pelaksana :</label></strong>
                                                <?= $nm['nama_lengkap'];?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="left" valign="top">
                                                <label>Nama & Uraian Kegiatan :</label>
                                            </td>
                                            <td colspan="3" align="left" valign="top">
                                                <?= $actbud[0]['deskrip_keg'];?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="left" valign="top">
                                                <label>No.Dokumen:</label>
                                            </td>
                                            <td colspan="3" align="left" valign="top">
                                                <?php
                                                    if($actbud[0]['jns_aju_agr'] == 'actbud'){
                                                ?>
                                                        ACT/<?= $actbud[0]['kd_act']?>
                                                <?php
                                                    }else{
                                                ?>
                                                        PTY/<?= $actbud[0]['kd_act']?>
                                                <?php
                                                    }
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="left" valign="top">
                                                <label>Kode Pencairan:</label>
                                            </td>
                                            <td colspan="3" align="left" valign="top">
                                                <?= $actbud[0]['kode_pencairan'];?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="left" valign="top">
                                                <label>Tanggal Diajukan:</label>
                                            </td>
                                            <td colspan="3" align="left" valign="top">
                                                <?= $actbud[0]['tanggal_pembuatan'];?>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="panel panel-default" align="center">
                <div class="panel-heading">
                    <h4 align="left"><strong>JENIS BIAYA</strong></h4>
                </div>
                <table class="table table-striped table-bordered table-hover" border="1" width="100%" align="center">
                    <thead>
                        <tr>
                            <th><center>No </center></th>
                            <th width="40%"><center>Jenis Biaya</center></th>
                            <th width="35%"><center>Keterangan</center></th>
                            <th><center>Anggaran Yang Diajukan</center></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $totalTJBActbud = 0;
                        $no =1;
                        if(!empty($t_j_b_act)){
                            foreach($t_j_b_act as $data_t_j_b_act){
                                $totalTJBActbud += $data_t_j_b_act['aju_agr'];
                    ?>
                                <tr>
                                    <td width="6%" align="left" valign="top"><center><?= $no;?></center></td>
                                    <td align="left" valign="top"><?= $data_t_j_b_act['jns_b'];?></td>
                                    <td align="left" valign="top"><?= $data_t_j_b_act['ket'];?></td>
                                    <td width="23%" align="right" valign="top"><?= number_format($data_t_j_b_act['aju_agr'],'0','.','.'); ?></td>
                                </tr>
                    <?php
                                $no++;
                            }
                        }else{
                    ?>
                            <tr>
                                <td colspan="4">Data Kosong</td>
                            </tr>
                    <?php
                        }
                    ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3"><center><strong>Total Yang Diajukan</strong></center></td>
                            <td  align="right"> 
                                <?= number_format($totalTJBActbud,'0','.','.'); ?>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 align="left"><strong>MENYETUJUI</strong></h4>
                </div>
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table width="100%" border="1" class="table table-striped table-bordered table-hover" >
                            <thead>
                                <tr>
                                    <th width="10%">
                                        <center>PIC</center>
                                    </th>
                                    <th width="10%">
                                        <center>Keuangan (Catatan)</center>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td valign="top" >
                                        <center>
                                            <strong><?= $actbud[0]['st_kabag'];?></strong>
                                            <br>
                                            <?= $actbud[0]['c_kabag']; ?>
                                            <br>
                                            <?= $actbud[0]['stamp_kabag']; ?>
                                        </center>
                                    </td>
                                    <td valign="top">
                                        <center>
                                            <strong><?= $actbud[0]['st_keu'];?></strong>
                                            <br>
                                            <?= $actbud[0]['c_keu']; ?>
                                            <br>
                                            <?= $actbud[0]['stamp_keu']; ?>
                                        </center>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="dataTable_wrapper">
                        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="table table-striped table-bordered table-hover" >
                            <thead>
                                <tr>
                                    <th width="44%" height="115">
                                        <center>
                                            <table width="100%" border="0" align="left" cellpadding="1" cellspacing="1" class="table table-striped table-bordered table-hover" >
                                                <thead>
                                                    <tr>
                                                        <th colspan="3" align="left"><u>Tanda Terima Dana/ Petty Cash</u> </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td width="29%" align="left" valign="top" ><p>Jumlah Diterima:</p>
                                                        <p>....................................................</p></td>
                                                        <td colspan="2" align="left" valign="top" ><p>                                          Diterima Oleh ,<br>
                                                        </p>
                                                        <p>                                        Nama,............................................<br>
                                                        Tgl,.................................................                                          </p></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3" align="left" valign="top" ><hr width="100%"></td>
                                                    </tr>
                                                    <tr>
                                                        <td height="138" colspan="2" align="left" valign="top" >
                                                            <table width="100%" border="1" align="left" cellpadding="2" class="table table-striped table-bordered table-hover" >
                                                                <thead>
                                                                    <tr>
                                                                    <th colspan="3" align="left"><u>Pertanggung Jawaban/ Realisasi</u></th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td width="32%" height="95" align="left" valign="top">
                                                                            <p>Jumlah yang digunakan:
                                                                                <br>
                                                                                <br>
                                                                                .....................................
                                                                                <br>
                                                                                Sisa Dana Dikembalikan:
                                                                            </p>
                                                                            <p>....................................</p>
                                                                        </td>
                                                                        <td width="44%" align="left" valign="top">
                                                                            <p>Dipertanggung Jawabkan Oleh,
                                                                                <br>
                                                                                <br>
                                                                                <br>
                                                                                <br>
                                                                                <br>
                                                                                Nama,..........................<br>
                                                                                Tgl,..............................
                                                                            </p>
                                                                        </td>
                                                                        <td width="24%" align="left" valign="top">
                                                                            <p>
                                                                                Menyetujui,
                                                                                <br>
                                                                                <br>
                                                                                <br>
                                                                                <br>
                                                                                <br>
                                                                                Nama,....................
                                                                                <br>
                                                                            </p>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                        <td width="36%" align="left" valign="top" >
                                                            <table width="100%" border="1" align="left" cellpadding="2" class="table table-striped table-bordered table-hover" >
                                                                <thead>
                                                                    <tr>
                                                                        <th colspan="2" align="left"><u>Bagian Keuangan</u></th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td width="49%" height="95" align="left" valign="top">
                                                                            <p>Dana Diterima:</p>
                                                                            <p>............................</p>
                                                                        </td>
                                                                        <td width="51%" align="left" valign="top">
                                                                            Dana Diterima Oleh,
                                                                            <br>
                                                                            <br>
                                                                            <br>
                                                                            <br>
                                                                            <br>
                                                                            Nama,........................
                                                                            <br>
                                                                            Tgl,.........................
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <p>&nbsp;</p>
                                            <p>&nbsp;</p>
                                            <p>&nbsp;</p>
                                            <p>&nbsp;</p>
                                        </center>
                                    </th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>     
<script>
    window.print();
</script>
<?php /**PATH C:\xampp_php_7\htdocs\hibah_upj\application\views/spa/admin/rkat/cetak-petty-cash-laporan-pencairan.blade.php ENDPATH**/ ?>