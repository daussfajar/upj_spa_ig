{!! form_open('app/sim-spa/approval/kepala-unit/detail/' . $id_actbud . '/submit_actbud', array('id' => 'form-persetujuan', 'class' => 'myForm')) !!}	
	<div class="card">
		<div class="card-header bg-transparent">
			<h5 class="card-title mb-0">FORM PERSETUJUAN</h5>
		</div>
		<div class="card-body">
            <div class="alert alert-info">
				<p class="mb-0"><i class="mdi mdi-information-variant"></i> Note: Sebelum submit, pastikan anda sudah
					membaca dan mengetahui kegiatan ini.</p>
			</div>
            <div class="form-group row">
				<label class="col-md-3 control-label">Apakah actbud ini disetujui?</label>
				<div class="col-md-9">
					<div class="radio radio-success form-check-inline">
						<input type="radio" id="chk-setuju" value="Disetujui" name="approval" required>
						<label for="chk-setuju"> Ya, Setuju </label>
					</div>
					<div class="radio radio-danger form-check-inline">
						<input type="radio" id="chk-tidak-setuju" value="Ditolak" name="approval" required>
						<label for="chk-tidak-setuju"> Tidak Setuju </label>
					</div>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-3 control-label">Catatan (jika ada)</label>
				<div class="col-md-9">
					<textarea name="catatan" id="catatan" placeholder="Buat catatan disini..." cols="3" rows="3"
						class="form-control"></textarea>
				</div>
			</div>
        </div>
        <div class="card-footer">
			<button type="submit" class="btn btn-md btn-primary btn-block">
                Submit
            </button>
		</div>
    </div>
{!! form_close() !!}