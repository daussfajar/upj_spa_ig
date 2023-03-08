<h6>Status Approval</h6>
<div class="card">
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered table-hover">
				<thead class="bg-dark text-white">
					<tr>
						<th class="v-middle text-center">Ka.Prodi / Unit</th>
						<th class="v-middle text-center">Dekan</th>
						<th class="v-middle text-center">Pre-Approval</th>
						<th class="v-middle text-center">Bagian Keuangan</th>
						<th class="v-middle text-center">Wakil Rektor</th>
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
                            ?>
						</td>
						<td class="v-middle text-center">

						</td>
						<td class="v-middle text-center">

						</td>
						<td class="v-middle text-center">

						</td>
						<td class="v-middle text-center">

						</td>
						<td class="v-middle text-center">

						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
<?php /**PATH C:\xampp_php_7\htdocs\hibah_upj\application\views/spa/approval/detail/status-approval.blade.php ENDPATH**/ ?>