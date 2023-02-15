<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">    
    <link rel="shortcut icon" href="assets/images/favicon/favicon.ico" type="image/x-icon">
    <title>Formulir Pencairan Actbud</title>
    <style>
		hr.hr-16 {
			border: 0;
			border-top: 1px dashed black;
			text-align: center;
			margin-top: 25px;
		}
        table.table-bordered > thead > tr > th{
            border:2px solid black;
        }
        table.table-bordered > tbody > tr > td{
            border:2px solid black;
        }
        table.table-bordered > tbody > tr > th{
            border:2px solid black;
        }
        table.table-my > thead > tr > th{
            border:1px solid black;
            font-size: 13px;
            color:black;
        }
        table.table-my > tbody > tr > td{
            border:1px solid black;
            color:black;
            font-size: 12px;
        }
        table.table-my > tfoot > tr > td{
            border:1px solid black;
            color:black;
            font-size: 12px;
        }
        table.table-my > tfoot > tr > th{
            border:1px solid black;
            color:black;
            font-size: 12px;
        }
        table.table-my > tbody > tr > th{
            border:1px solid black;
            color:black;
            font-size:13px;
        }
        footer{
            position: fixed;
            left: 0px;
            right: 0px;
            height: 50px;
            margin-bottom: -50px;
        }
	</style>
</head>
<body class="bg-white">
    <div id="page-1">
        <table class="table table-bordered">
            <tr>
                <th rowspan=2 style="vertical-align:middle;" class="text-center" width=139>
                    <img src="assets/images/logo/upjlogo.png" alt="UPJ Logo" srcset="" width="139">
                </th>
                <th rowspan=2 class="text-center" style="vertical-align:middle;color:black;font-size:14px;" width=230>
                    FORMULIR<br> PENCAIRAN ACTBUD<br> <?= $data->jns_agr . '/' . $data->id ?>
                </th>
                <td class="text-center" style="vertical-align:middle;color:black;font-size:12px;" width=100>No. Dokumen</td>            
            </tr>
            <tr>                        
                <td class="text-center" style="font-size:12px;vertical-align:middle;color:black;"><?= $data->kode_uraian ?></td>
            </tr>
        </table>

        <table class="table table-sm table-my" style="border:1px solid black;">  
            <tr>
                <td width=100 style="vertical-align:middle;"><b>Nama dan uraian Hibah/Sponsorship</b></td>
                <td width=10 style="vertical-align:middle;" class="text-center">:</td>
                <td colspan="4">
                    <b><?= $data->nama_hibah_sponsorship ?></b>
                    <hr class="mt-0 mb-0">
                    <?= $data->uraian_kegiatan ?>
                </td>
            </tr>
            <tr>
                <td width=100><b>PIC</b></td>
                <td width=10 class="text-center">:</td>
                <td><?= $data->nama_pic ?></td>
                <td><b>Pelaksana</b></td>
                <td width=10 class="text-center">:</td>
                <td><?= $data->nama_pelaksana ?></td>
            </tr>         
            <tr>
                <td width=100>Prodi / Bagian / Unit</td>
                <td width=10 class="text-center">:</td>
                <td><b><?= $data->nama_unit ?></b></td>
                <td>Kode Pencairan</td>
                <td width=10 class="text-center">:</td>
                <td><?= $data->kode_pencairan ?></td>
            </tr>
            <tr>
                <td style="vertical-align:middle">Nama Kegiatan</td>
                <td width=10 class="text-center" style="vertical-align:middle">:</td>
                <td colspan="4"><?= $data->nama_kegiatan ?></td>
            </tr>
            <tr>
                <td style="vertical-align:middle">Deskripsi Kegiatan</td>
                <td width=10 class="text-center" style="vertical-align:middle">:</td>
                <td colspan="4"><?= $data->deskripsi_kegiatan ?></td>
            </tr>
            <tr>
                <td style="vertical-align:middle">Anggaran</td>
                <td width=10 class="text-center" style="vertical-align:middle">:</td>
                <td style="vertical-align:middle"><?= rupiah($data->agr) ?></td>
                <td style="vertical-align:middle">Tanggal Pelaksanaan</td>
                <td width=10 class="text-center" style="vertical-align:middle">:</td>
                <td style="vertical-align:middle;font-size:11px;" class="text-center"><?= tanggal_indo_singkat($data->tgl_mulai) . ' s/d ' . tanggal_indo_singkat($data->tgl_selesai) ?></td>
            </tr>
            <tr>
                <td style="vertical-align:middle">KPI yang dicapai</td>
                <td width=10 class="text-center" style="vertical-align:middle">:</td>
                <td style="vertical-align:middle"><?= $data->kpi ?></td>                
                <td style="vertical-align:middle">Jenis</td>
                <td width=10 class="text-center" style="vertical-align:middle">:</td>
                <td style="vertical-align:middle;font-size:11px;" class="text-center"><?= ucfirst($data->jenis_ig) ?></td>
            </tr>
            <tr>
                <td style="vertical-align:middle">Periode</td>
                <td width=10 class="text-center" style="vertical-align:middle">:</td>
                <td style="vertical-align:middle"><?= $data->periode == 1 ? 'Ganjil' : 'Genap' ?></td>
                <td style="vertical-align:middle">Tanggal Pengajuan</td>
                <td width=10 class="text-center" style="vertical-align:middle">:</td>
                <td class="text-center" style="font-size:11px;"><?= tanggal_indo(substr($data->tanggal_pembuatan, 0, 10)) ?></td>
            </tr>
        </table>

        <table class="table table-sm table-my" style="border:1px solid black;">  
            <thead style="font-size:12px;">
                <tr>
                    <th colspan="4" style="font-size:12px;">RINCIAN BIAYA</th>
                </tr>
                <tr>
                    <th class="text-center" style="font-size:12px;" width="30">No</th>
                    <th class="text-center" style="font-size:12px;">Nama Kegiatan</th>
                    <th class="text-center" style="font-size:12px;">Keterangan</th>
                    <th class="text-center" style="font-size:12px;">Anggaran</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach($rincian_kegiatan->result() as $item){
                ?>
                    <tr>
                        <td class="text-center" style="vertical-align:middle;"><?= $no++ ?></td>
                        <td style="vertical-align:middle;"><?= $item->nama_kegiatan ?></td>
                        <td style="vertical-align:middle;"><?= $item->keterangan ?></td>
                        <td class="text-center" style="vertical-align:middle;"><?= rupiah($item->total_anggaran) ?></td>
                    </tr>
                <?php } ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3" class="text-right">Total Yang Diajukan : </th>
                    <th class="text-center"><?= rupiah($sisa->digunakan) ?></th>
                </tr>
            </tfoot>
        </table>

        <table class="table table-sm table-my" style="border:1px solid black;">  
            <thead style="font-size:12px;">
                <tr>
                    <th colspan="<?= $data->sign != "" ? 4 : 3 ?>" style="font-size:12px;">MENYETUJUI</th>
                </tr>
                <tr>
                    <th class="text-center" style="font-size:12px;">Ka. Prodi/Unit</th>
                    <?php if($data->sign != ""): ?>
                        <th class="text-center" style="font-size:12px;">Pre-Approval</th>
                    <?php endif; ?>
                    <th class="text-center" style="font-size:12px;">Keuangan</th>
                    <th class="text-center" style="font-size:12px;">Warek</th>
                </tr>                
            </thead>
            <tbody>
                <tr>
                    <td class="text-center" style="vertical-align:middle;">
                        Disetujui<br>
                        <b><?= $data->nama_kabag ?></b><br>
                        <?= substr($data->stamp_kabag, 0, 19) ?>
                    </td>
                    <?php if($data->sign != ""): ?>
                        <td class="text-center" style="vertical-align:middle;">
                            Disetujui<br>
                            <b><?= $data->nama_sign ?></b><br>
                            <?= substr($data->stamp_sign, 0, 19) ?>
                        </td>
                    <?php endif; ?>
                    <td class="text-center" style="vertical-align:middle;">
                        Disetujui<br>
                        <b><?= $data->nama_keu ?></b><br>
                        <?= substr($data->stamp_keu, 0, 19) ?>
                    </td>
                    <td class="text-center" style="vertical-align:middle;">
                        Disetujui Warek 1<br>
                        <b><?= $data->nama_warek_1 ?></b><br>
                        <?= substr($data->stamp_warek1, 0, 19) ?><br>
                        <hr class="mt-1 mb-1">
                        Disetujui Warek 2<br>
                        <b><?= $data->nama_warek_2 ?></b><br>
                        <?= substr($data->stamp_warek2, 0, 19) ?>                        
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>