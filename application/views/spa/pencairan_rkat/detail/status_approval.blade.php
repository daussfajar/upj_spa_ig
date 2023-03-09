<?php 
$n_pre_approval = "";
$st_pre_approval = "";
if($data['nama_sign'] != ""){
    $n_pre_approval .= "(" . $data['nama_sign'] . ")";
    
    switch ($data['sign']) {
        case 004:
            $approval = ($data['st_ict'] == "Disetujui ICT" ? "Disetujui" : "Ditolak");
            $stamp = date_create($data['stamp_ict']);
            $ex_stamp = explode(' ', $data['stamp_ict']);
            $time = "";
            if(!empty($ex_stamp) && (count($ex_stamp) >= 1)){
                $time .= $ex_stamp[1];
            }
            $st_pre_approval .= '
            <span class="font-weight-bold">
                <i class="mdi mdi-check-bold"></i> '.$approval.'
            </span>
            <br>
            <span class="font-12">
                '.tanggal_indo(date_format($stamp, "Y-m-d")).', '.$time.'
            </span>
            ';
            break;
        
        default:
            # code...
            break;
    }
} else {
    $n_pre_approval .= "<br>(Tidak Ada Pre-Approval)";
    $st_pre_approval .= "-";

}

?>
<h6>Status Approval</h6>
<div class="card">
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered table-hover">
				<thead class="bg-dark text-white">
					<tr>
						<th class="v-middle text-center">Ka.Prodi / Unit</th>
						<th class="v-middle text-center">Dekan</th>
						<th class="v-middle text-center">Pre-Approval <?= $n_pre_approval ?></th>
						<th class="v-middle text-center">Bagian Keuangan</th>
						<th class="v-middle text-center">Wakil Rektor 1</th>
                        <th class="v-middle text-center">Wakil Rektor 2</th>
						<th class="v-middle text-center">Rektor</th>
						<th class="v-middle text-center">Presiden</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td class="v-middle text-center">
                            <?php 
                            if($data['st_kabag'] != ""){
                                $stamp = date_create($data['stamp_kabag']);
                                $ex_stamp = explode(' ', $data['stamp_kabag']);
                                $time = "";
                                if(!empty($ex_stamp) && (count($ex_stamp) >= 1)){
                                    $time .= $ex_stamp[1];
                                }

                                if($data['st_kabag'] == "Disetujui"){
                                    echo '<span class="font-weight-bold">
                                        <i class="mdi mdi-check-bold"></i> Disetujui
                                        </span>';
                                    echo '<br>';
                                    echo '
                                    <span class="font-12">
                                        '.tanggal_indo(date_format($stamp, "Y-m-d")).', '.$time.'
                                    </span>
                                    ';
                                } else if($data['st_kabag'] == "Ditolak"){
                                    echo '<span class="font-weight-bold">
                                        <i class="mdi mdi-close"></i> Ditolak
                                        </span>';
                                    echo '<br>';
                                    echo '
                                    <span class="font-12">
                                        '.tanggal_indo(date_format($stamp, "Y-m-d")).', '.$time.'
                                    </span>
                                    ';
                                } else {
                                    echo '-';
                                }
                            }

                            if($data['st_kabag'] == ""){
                                echo "-";
                            }
                            ?>
						</td>
						<td class="v-middle text-center">
                            <?php 
                            if($data['st_fhb'] != "" || $data['st_ftd'] != ""){
                                $stamp = date_create($data['st_fhb']);
                                $ex_stamp = explode(' ', $data['stamp_fhb']);
                                $time = "";
                                if(!empty($ex_stamp) && (count($ex_stamp) >= 1)){
                                    $time .= $ex_stamp[1];
                                }

                                if($data['st_fhb'] == "Disetujui"){
                                    echo '<span class="font-weight-bold">
                                        <i class="mdi mdi-check-bold"></i> Disetujui
                                        </span>';
                                    echo '<br>';
                                    echo '
                                    <span class="font-12">
                                        '.tanggal_indo(date_format($stamp, "Y-m-d")).', '.$time.'
                                    </span>
                                    ';
                                } else if($data['st_fhb'] == "Ditolak"){
                                    echo '<span class="font-weight-bold">
                                        <i class="mdi mdi-close"></i> Ditolak
                                        </span>';
                                    echo '<br>';
                                    echo '
                                    <span class="font-12">
                                        '.tanggal_indo(date_format($stamp, "Y-m-d")).', '.$time.'
                                    </span>
                                    ';
                                }

                                $stamp = date_create($data['st_ftd']);
                                $ex_stamp = explode(' ', $data['stamp_ftd']);
                                $time = "";
                                if(!empty($ex_stamp) && (count($ex_stamp) >= 1)){
                                    $time .= $ex_stamp[1];
                                }

                                if($data['st_ftd'] == "Disetujui"){
                                    echo '<span class="font-weight-bold">
                                        <i class="mdi mdi-check-bold"></i> Disetujui
                                        </span>';
                                    echo '<br>';
                                    echo '
                                    <span class="font-12">
                                        '.tanggal_indo(date_format($stamp, "Y-m-d")).', '.$time.'
                                    </span>
                                    ';
                                } else if($data['st_ftd'] == "Ditolak"){
                                    echo '<span class="font-weight-bold">
                                        <i class="mdi mdi-close"></i> Ditolak
                                        </span>';
                                    echo '<br>';
                                    echo '
                                    <span class="font-12">
                                        '.tanggal_indo(date_format($stamp, "Y-m-d")).', '.$time.'
                                    </span>
                                    ';
                                }
                            }

                            if($data['st_ftd'] == "" && $data['st_fhb'] == ""){
                                echo '-';
                            }
                            ?>
						</td>
						<td class="v-middle text-center">
                            <?= $st_pre_approval ?>
						</td>
						<td class="v-middle text-center">
                            <?php 
                            if($data['st_keu'] != ""){
                                $stamp = date_create($data['stamp_keu']);
                                $ex_stamp = explode(' ', $data['stamp_keu']);
                                $time = "";
                                if(!empty($ex_stamp) && (count($ex_stamp) >= 1)){
                                    $time .= $ex_stamp[1];
                                }

                                if($data['st_keu'] == "Disetujui"){
                                    echo '<span class="font-weight-bold">
                                        <i class="mdi mdi-check-bold"></i> Disetujui
                                        </span>';
                                    echo '<br>';
                                    echo '
                                    <span class="font-12">
                                        '.tanggal_indo(date_format($stamp, "Y-m-d")).', '.$time.'
                                    </span>
                                    ';
                                } else if($data['st_keu'] == "Ditolak"){
                                    echo '<span class="font-weight-bold">
                                        <i class="mdi mdi-close"></i> Ditolak
                                        </span>';
                                    echo '<br>';
                                    echo '
                                    <span class="font-12">
                                        '.tanggal_indo(date_format($stamp, "Y-m-d")).', '.$time.'
                                    </span>
                                    ';
                                } else {
                                    echo '-';
                                }                                
                            }

                            if($data['st_keu'] == ""){
                                echo "-";
                            }
                            ?>
						</td>
						<td class="v-middle text-center">
                            <?php 
                            if($data['st_warek_1'] != ""){
                                $stamp = date_create($data['stamp_warek_1']);
                                $ex_stamp = explode(' ', $data['stamp_warek_1']);
                                $time = "";
                                if(!empty($ex_stamp) && (count($ex_stamp) >= 1)){
                                    $time .= $ex_stamp[1];
                                }

                                if($data['st_warek_1'] == "Disetujui"){
                                    echo '<span class="font-weight-bold">
                                        <i class="mdi mdi-check-bold"></i> Disetujui
                                        </span>';
                                    echo '<br>';
                                    echo '
                                    <span class="font-12">
                                        '.tanggal_indo(date_format($stamp, "Y-m-d")).', '.$time.'
                                    </span>
                                    ';
                                } else if($data['st_warek_1'] == "Ditolak"){
                                    echo '<span class="font-weight-bold">
                                        <i class="mdi mdi-close"></i> Ditolak
                                        </span>';
                                    echo '<br>';
                                    echo '
                                    <span class="font-12">
                                        '.tanggal_indo(date_format($stamp, "Y-m-d")).', '.$time.'
                                    </span>
                                    ';
                                } else {
                                    echo '-';
                                }                                
                            }
                            if($data['st_warek_1'] == ""){
                                echo "-";
                            }
                            ?>
						</td>
                        <td class="v-middle text-center">
                            <?php 
                            if($data['st_warek_2'] != ""){
                                $stamp = date_create($data['stamp_warek1']);
                                $ex_stamp = explode(' ', $data['stamp_warek1']);
                                $time = "";
                                if(!empty($ex_stamp) && (count($ex_stamp) >= 1)){
                                    $time .= $ex_stamp[1];
                                }

                                if($data['st_warek_2'] == "Disetujui"){
                                    echo '<span class="font-weight-bold">
                                        <i class="mdi mdi-check-bold"></i> Disetujui
                                        </span>';
                                    echo '<br>';
                                    echo '
                                    <span class="font-12">
                                        '.tanggal_indo(date_format($stamp, "Y-m-d")).', '.$time.'
                                    </span>
                                    ';
                                } else if($data['st_warek_2'] == "Ditolak"){
                                    echo '<span class="font-weight-bold">
                                        <i class="mdi mdi-close"></i> Ditolak
                                        </span>';
                                    echo '<br>';
                                    echo '
                                    <span class="font-12">
                                        '.tanggal_indo(date_format($stamp, "Y-m-d")).', '.$time.'
                                    </span>
                                    ';
                                } else {
                                    echo '-';
                                }                                
                            }
                            if($data['st_warek_2'] == ""){
                                echo "-";
                            }
                            ?>
						</td>
						<td class="v-middle text-center">
                            <?php 
                            if($data['st_rek'] != ""){
                                $stamp = date_create($data['stamp_rek']);
                                $ex_stamp = explode(' ', $data['stamp_rek']);
                                $time = "";
                                if(!empty($ex_stamp) && (count($ex_stamp) >= 1)){
                                    $time .= $ex_stamp[1];
                                }

                                if($data['st_rek'] == "Disetujui"){
                                    echo '<span class="font-weight-bold">
                                        <i class="mdi mdi-check-bold"></i> Disetujui
                                        </span>';
                                    echo '<br>';
                                    echo '
                                    <span class="font-12">
                                        '.tanggal_indo(date_format($stamp, "Y-m-d")).', '.$time.'
                                    </span>
                                    ';
                                } else if($data['st_rek'] == "Ditolak"){
                                    echo '<span class="font-weight-bold">
                                        <i class="mdi mdi-close"></i> Ditolak
                                        </span>';
                                    echo '<br>';
                                    echo '
                                    <span class="font-12">
                                        '.tanggal_indo(date_format($stamp, "Y-m-d")).', '.$time.'
                                    </span>
                                    ';
                                } else {
                                    echo '-';
                                }                                
                            }
                            if($data['st_rek'] == ""){
                                echo "-";
                            }
                            ?>
						</td>
						<td class="v-middle text-center">
                            <?php 
                            if($data['st_pres'] != ""){
                                $stamp = date_create($data['stamp_pres']);
                                $ex_stamp = explode(' ', $data['stamp_pres']);
                                $time = "";
                                if(!empty($ex_stamp) && (count($ex_stamp) >= 1)){
                                    $time .= $ex_stamp[1];
                                }

                                if($data['st_pres'] == "Disetujui"){
                                    echo '<span class="font-weight-bold">
                                        <i class="mdi mdi-check-bold"></i> Disetujui
                                        </span>';
                                    echo '<br>';
                                    echo '
                                    <span class="font-12">
                                        '.tanggal_indo(date_format($stamp, "Y-m-d")).', '.$time.'
                                    </span>
                                    ';
                                } else if($data['st_pres'] == "Ditolak"){
                                    echo '<span class="font-weight-bold">
                                        <i class="mdi mdi-close"></i> Ditolak
                                        </span>';
                                    echo '<br>';
                                    echo '
                                    <span class="font-12">
                                        '.tanggal_indo(date_format($stamp, "Y-m-d")).', '.$time.'
                                    </span>
                                    ';
                                } else {
                                    echo '-';
                                }                                
                            }
                            if($data['st_pres'] == ""){
                                echo "-";
                            }
                            ?>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
