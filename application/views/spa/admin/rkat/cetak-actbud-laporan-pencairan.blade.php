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
                                <strong>FORM ACTBUD</strong>
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
                                                <label>No Borang Kegiatan :</label>
                                            </td>
                                            <td colspan="3" align="left" valign="top">
                                                <?= $actbud[0]['no_borang']; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="left" valign="top">
                                                <label>KPI yang Dicapai :</label>
                                            </td>
                                            <td colspan="3" align="left" valign="top">
                                                <?= $actbud[0]['kpi'];?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="left" valign="top">
                                                <label>No.Dokumen:</label>
                                            </td>
                                            <td colspan="1" align="left" valign="top">
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
                                            <td colspan="2" align="left" valign="top">
                                                <strong><label>Kode Pencairan:</label></strong>
                                                <?= $actbud[0]['kode_pencairan'];?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="left" valign="top">
                                                <label>Anggaran:</label>
                                            </td>
                                            <td colspan="1" align="left" valign="top">
                                                <?= number_format($actbud[0]['agr'],'0','.','.');?>
                                            </td>
                                            <td colspan="2" align="left" valign="top">
                                                <strong><label>Tanggal Diajukan:</label></strong>
                                                <?= $actbud[0]['tanggal_pembuatan'];?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="left" valign="top">
                                                <label>Tanggal Kegiatan/ Pelaksanaan:</label>
                                            </td>
                                            <td align="left" valign="top">
                                                <strong>Mulai:</strong> <?= $actbud[0]['tgl_m'];?>
                                            </td>
                                            <td colspan="2" align="left" valign="top">
                                                <strong> Selesai:</strong> <?= $actbud[0]['tgl_s'];?>
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
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel panel-default" >
                    <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 align="left"><strong>MENYETUJUI</strong></h4>
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped table-bordered table-hover" border="1" align="top">
                            <thead>
                                <tr>
                                    <th width="10%"><center>KA. Prodi/Unit</center></th>
                                    <th width="10%"><center>Dekan</center></th>
                                    <th width="10%"><center>Approval</center></th>
                                    <th width="10%"><center>Keuangan</center></th>
                                    <th width="10%"><center>Warek</center></th>
                                    <th width="10%"><center>Rektor</center></th>
                                    <th width="10%"><center>Presiden</center></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="odd gradeX">
                                    <td valign="top">
                                        <center>
                                            <p>
                                                <strong><?= $actbud[0]['st_kabag'];?></strong>
                                                <br><?= $actbud[0]['c_kabag']; ?>
                                                <br><?= $actbud[0]['stamp_kabag']; ?>
                                            </p>
                                        </center>
                                    </td>
                                    <td valign="top" ><center>
                                        <p>
                                            <strong><?= $actbud[0]['st_fhb'];?></strong>
                                            <br><?=  $actbud[0]['c_fhb']; ?>
                                            <br><?= $actbud[0]['stamp_fhb']; ?>
                                        </p>
                                        <p>
                                            <strong><?= $actbud[0]['st_ftd'];?></strong>
                                            <br><?= $actbud[0]['c_ftd']; ?>
                                            <br><?= $actbud[0]['stamp_ftd']; ?>
                                        </p>
                                    </center>
                                    </td>
                                    <td valign="top">
                                        <center>
                                            <p>
                                                <strong>
                                                    <?= $actbud[0]['st_hrd'];?> 
                                                    <?= $actbud[0]['st_umum'];?>
                                                    <?= $actbud[0]['st_ict'];?>
                                                    <?= $actbud[0]['st_bkal'];?>
                                                    <?= $actbud[0]['st_p2m'];?>
                                                </strong>
                                                <br>
                                                <?= $actbud[0]['c_hrd']; ?>
                                                <?= $actbud[0]['c_umum']; ?>
                                                <?= $actbud[0]['c_ict']; ?>
                                                <?= $actbud[0]['c_bkal']; ?>
                                                <?= $actbud[0]['c_p2m']; ?>
                                                <br>
                                                <?= $actbud[0]['stamp_hrd']; ?>
                                                <?= $actbud[0]['stamp_umum']; ?>
                                                <?= $actbud[0]['stamp_ict']; ?>
                                                <?= $actbud[0]['stamp_bkal']; ?>
                                                <?= $actbud[0]['stamp_p2m']; ?>
                                            </p>
                                        </center>
                                    </td>
                                    <td valign="top">
                                        <center>
                                            <p>
                                                <strong><?= $actbud[0]['st_keu'];?></strong>
                                                <br>
                                                <?= $actbud[0]['c_keu']; ?>
                                                <br>
                                                <?= $actbud[0]['stamp_keu']; ?>
                                            </p>
                                        </center>
                                    </td>
                                    <td valign="top">
                                        <center>
                                            <p>
                                                <strong><?= $actbud[0]['st_warek_1'];?></strong>
                                                <br>
                                                <?= $actbud[0]['c_warek1']; ?>
                                                <br>
                                                <?= $actbud[0]['stamp_warek1']; ?> 
                                                <br>
                                                <br>
                                                <strong><?= $actbud[0]['st_warek_2'];?></strong>
                                                <br>
                                                <?= $actbud[0]['c_warek2']; ?>
                                                <br>
                                                <?= $actbud[0]['stamp_warek2']; ?>
                                            </p>
                                        </center>
                                    </td>
                                    <td valign="top">
                                        <center>
                                            <p>
                                                <strong><?= $actbud[0]['st_rek'];?></strong>
                                                <br>
                                                <?= $actbud[0]['c_rek']; ?>
                                                <br>
                                                <?= $actbud[0]['stamp_rek']; ?>
                                            </p>
                                        </center>
                                    </td>
                                    <td valign="top">
                                        <center>
                                        <p>
                                            <strong><?= $actbud[0]['st_pres'];?></strong>
                                            <br>
                                            <?= $actbud[0]['c_pres']; ?>
                                            <br>
                                            <?= $actbud[0]['stamp_pres']; ?>
                                        </p>
                                    </center>
                                    </td>
                                </tr>
                            </tbody>
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
