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
            if(!empty($ex_stamp) && (count($ex_stamp) > 1)){
                $time .= ', ' . $ex_stamp[1];
            }            
            break;
        case 006:
            $approval = ($data['st_hrd'] == "Disetujui HRD" ? "Disetujui" : "Ditolak");
            $stamp = date_create($data['stamp_hrd']);
            $ex_stamp = explode(' ', $data['stamp_hrd']);
            $time = "";
            if(!empty($ex_stamp) && (count($ex_stamp) > 1)){
                $time .= ', ' . $ex_stamp[1];
            }
            break;
        case 003:
            $approval = ($data['st_umum'] == "Disetujui GA" ? "Disetujui" : "Ditolak");
            $stamp = date_create($data['stamp_umum']);
            $ex_stamp = explode(' ', $data['stamp_umum']);
            $time = "";
            if(!empty($ex_stamp) && (count($ex_stamp) > 1)){
                $time .= ', ' . $ex_stamp[1];
            }
            break;
        case 013:
            $approval = ($data['st_bkal'] == "Disetujui BKAL" ? "Disetujui" : "Ditolak");
            $stamp = date_create($data['stamp_bkal']);
            $ex_stamp = explode(' ', $data['stamp_bkal']);
            $time = "";
            if(!empty($ex_stamp) && (count($ex_stamp) > 1)){
                $time .= ', ' . $ex_stamp[1];
            }
            break;
        case 016:
            $approval = ($data['st_p2m'] == "Disetujui P2M" ? "Disetujui" : "Ditolak");
            $stamp = date_create($data['stamp_p2m']);
            $ex_stamp = explode(' ', $data['stamp_p2m']);
            $time = "";
            if(!empty($ex_stamp) && (count($ex_stamp) > 1)){
                $time .= ', ' . $ex_stamp[1];
            }
            break;
        default:
            $st_pre_approval .= "-";
            break;
    }
    $st_pre_approval .= '
    <span class="font-weight-bold">
        <i class="mdi mdi-check-bold"></i> '.$approval.'
    </span>
    <br>
    <span class="font-12">
        '.tanggal_indo($stamp).$time.'
    </span>
    ';
} else {
    $n_pre_approval .= "";
    $st_pre_approval .= "-";
}

?>
<div class="card card-border">
    <div class="card-header border-success bg-transparent">
        <h3 class="card-title mb-0"><i class="mdi mdi-calendar-clock"></i> HISTORY APPROVAL</h3>
    </div>
	<div class="card-body pt-0">
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
                                $stamp = date('Y-m-d', strtotime($data['stamp_kabag']));
                                $ex_stamp = explode(' ', $data['stamp_kabag']);
                                $time = "";
                                if(!empty($ex_stamp) && (count($ex_stamp) > 1)){
                                    $time .= $ex_stamp[1];
                                }

                                if($data['st_kabag'] == "Disetujui"){
                                    echo '<span class="font-weight-bold">
                                        <i class="mdi mdi-check-bold"></i> Disetujui
                                        </span>';
                                    echo '<br>';
                                    echo '
                                    <span class="font-12">
                                        '.tanggal_indo($stamp).', '.$time.'
                                    </span>
                                    ';
                                } else if($data['st_kabag'] == "Ditolak"){
                                    echo '<span class="font-weight-bold">
                                        <i class="mdi mdi-close"></i> Ditolak
                                        </span>';
                                    echo '<br>';
                                    echo '
                                    <span class="font-12">
                                        '.tanggal_indo($stamp).', '.$time.'
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
                                $stamp = date('Y-m-d', strtotime($data['stamp_fhb']));
                                $ex_stamp = explode(' ', $data['stamp_fhb']);
                                $time = "";
                                if(!empty($ex_stamp) && (count($ex_stamp) > 1)){
                                    $time .= $ex_stamp[1];
                                }

                                if($data['st_fhb'] == "Disetujui"){
                                    echo '<span class="font-weight-bold">
                                        <i class="mdi mdi-check-bold"></i> Disetujui
                                        </span>';
                                    echo '<br>';
                                    echo '
                                    <span class="font-12">
                                        '.tanggal_indo($stamp).', '.$time.'
                                    </span>
                                    ';
                                } else if($data['st_fhb'] == "Ditolak"){
                                    echo '<span class="font-weight-bold">
                                        <i class="mdi mdi-close"></i> Ditolak
                                        </span>';
                                    echo '<br>';
                                    echo '
                                    <span class="font-12">
                                        '.tanggal_indo($stamp).', '.$time.'
                                    </span>
                                    ';
                                }

                                $stamp = date('Y-m-d', strtotime($data['stamp_ftd']));
                                $ex_stamp = explode(' ', $data['stamp_ftd']);
                                $time = "";
                                if(!empty($ex_stamp) && (count($ex_stamp) > 1)){
                                    $time .= $ex_stamp[1];
                                }

                                if($data['st_ftd'] == "Disetujui"){
                                    echo '<span class="font-weight-bold">
                                        <i class="mdi mdi-check-bold"></i> Disetujui
                                        </span>';
                                    echo '<br>';
                                    echo '
                                    <span class="font-12">
                                        '.tanggal_indo($stamp).', '.$time.'
                                    </span>
                                    ';
                                } else if($data['st_ftd'] == "Ditolak"){
                                    echo '<span class="font-weight-bold">
                                        <i class="mdi mdi-close"></i> Ditolak
                                        </span>';
                                    echo '<br>';
                                    echo '
                                    <span class="font-12">
                                        '.tanggal_indo($stamp).', '.$time.'
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
                                $stamp = date('Y-m-d', strtotime($data['stamp_keu']));
                                $ex_stamp = explode(' ', $data['stamp_keu']);
                                $time = "";
                                if(!empty($ex_stamp) && (count($ex_stamp) > 1)){
                                    $time .= $ex_stamp[1];
                                }

                                if($data['st_keu'] == "Disetujui"){
                                    echo '<span class="font-weight-bold">
                                        <i class="mdi mdi-check-bold"></i> Disetujui
                                        </span>';
                                    echo '<br>';
                                    echo '
                                    <span class="font-12">
                                        '.tanggal_indo($stamp).', '.$time.'
                                    </span>
                                    ';
                                } else if($data['st_keu'] == "Ditolak"){
                                    echo '<span class="font-weight-bold">
                                        <i class="mdi mdi-close"></i> Ditolak
                                        </span>';
                                    echo '<br>';
                                    echo '
                                    <span class="font-12">
                                        '.tanggal_indo($stamp).', '.$time.'
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
                                $stamp = date('Y-m-d', strtotime($data['stamp_warek1']));
                                $ex_stamp = explode(' ', $data['stamp_warek1']);
                                $time = "";
                                if(!empty($ex_stamp) && (count($ex_stamp) > 1)){
                                    $time .= $ex_stamp[1];
                                }

                                if($data['st_warek_1'] == "Disetujui"){
                                    echo '<span class="font-weight-bold">
                                        <i class="mdi mdi-check-bold"></i> Disetujui
                                        </span>';
                                    echo '<br>';
                                    echo '
                                    <span class="font-12">
                                        '.tanggal_indo($stamp).', '.$time.'
                                    </span>
                                    ';
                                } else if($data['st_warek_1'] == "Ditolak"){
                                    echo '<span class="font-weight-bold">
                                        <i class="mdi mdi-close"></i> Ditolak
                                        </span>';
                                    echo '<br>';
                                    echo '
                                    <span class="font-12">
                                        '.tanggal_indo($stamp).', '.$time.'
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
                                $stamp = date('Y-m-d', strtotime($data['stamp_warek2']));
                                $ex_stamp = explode(' ', $data['stamp_warek2']);
                                $time = "";
                                if(!empty($ex_stamp) && (count($ex_stamp) > 1)){
                                    $time .= $ex_stamp[1];
                                }

                                if($data['st_warek_2'] == "Disetujui"){
                                    echo '<span class="font-weight-bold">
                                        <i class="mdi mdi-check-bold"></i> Disetujui
                                        </span>';
                                    echo '<br>';
                                    echo '
                                    <span class="font-12">
                                        '.tanggal_indo($stamp).', '.$time.'
                                    </span>
                                    ';
                                } else if($data['st_warek_2'] == "Ditolak"){
                                    echo '<span class="font-weight-bold">
                                        <i class="mdi mdi-close"></i> Ditolak
                                        </span>';
                                    echo '<br>';
                                    echo '
                                    <span class="font-12">
                                        '.tanggal_indo($stamp).', '.$time.'
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
                                $stamp = date('Y-m-d', strtotime($data['stamp_rek']));
                                $ex_stamp = explode(' ', $data['stamp_rek']);
                                $time = "";
                                if(!empty($ex_stamp) && (count($ex_stamp) > 1)){
                                    $time .= $ex_stamp[1];
                                }

                                if($data['st_rek'] == "Disetujui"){
                                    echo '<span class="font-weight-bold">
                                        <i class="mdi mdi-check-bold"></i> Disetujui
                                        </span>';
                                    echo '<br>';
                                    echo '
                                    <span class="font-12">
                                        '.tanggal_indo($stamp).', '.$time.'
                                    </span>
                                    ';
                                } else if($data['st_rek'] == "Ditolak"){
                                    echo '<span class="font-weight-bold">
                                        <i class="mdi mdi-close"></i> Ditolak
                                        </span>';
                                    echo '<br>';
                                    echo '
                                    <span class="font-12">
                                        '.tanggal_indo($stamp).', '.$time.'
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
                                $stamp = date('Y-m-d', strtotime($data['stamp_pres']));
                                $ex_stamp = explode(' ', $data['stamp_pres']);
                                $time = "";
                                if(!empty($ex_stamp) && (count($ex_stamp) > 1)){
                                    $time .= $ex_stamp[1];
                                }

                                if($data['st_pres'] == "Disetujui"){
                                    echo '<span class="font-weight-bold">
                                        <i class="mdi mdi-check-bold"></i> Disetujui
                                        </span>';
                                    echo '<br>';
                                    echo '
                                    <span class="font-12">
                                        '.tanggal_indo($stamp).', '.$time.'
                                    </span>
                                    ';
                                } else if($data['st_pres'] == "Ditolak"){
                                    echo '<span class="font-weight-bold">
                                        <i class="mdi mdi-close"></i> Ditolak
                                        </span>';
                                    echo '<br>';
                                    echo '
                                    <span class="font-12">
                                        '.tanggal_indo($stamp).', '.$time.'
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
<?php /**PATH C:\xampp_php_7\htdocs\hibah_upj\application\views/spa/pencairan_rkat/detail/status_approval.blade.php ENDPATH**/ ?>