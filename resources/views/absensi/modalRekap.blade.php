<!-- Modal Rekap Absensi -->
<div class="modal fade" id="rekapAbsensi" tabindex="-1" aria-labelledby="rekapAbsensiLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="rekapAbsensiLabel">Rekap Absensi</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form action="{{ route('absensi.rekap') }}" method="POST">
				@csrf
				<div class="modal-body">
					<!-- Pesan Validasi -->
					@if ($errors->any())
						<div class="alert alert-danger">
							{{ $errors->first() }}
						</div>
					@endif

					<!-- Input Tanggal Dari dan Sampai -->
					<div class="row mb-3">
						<div class="col-md-6">
							<label for="tanggalDari" class="form-label">Tanggal Dari</label>
							<input type="date" class="form-control" id="tanggalDari" name="tanggal_dari" required>
						</div>
						<div class="col-md-6">
							<label for="tanggalSampai" class="form-label">Tanggal Sampai</label>
							<input type="date" class="form-control" id="tanggalSampai" name="tanggal_sampai" required>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
					<button type="submit" class="btn btn-primary">Download Rekap Absensi</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script>
	document.addEventListener('DOMContentLoaded', function() {
		const tanggalDari = document.getElementById('tanggalDari');
		const tanggalSampai = document.getElementById('tanggalSampai');

		tanggalDari.addEventListener('change', function() {
			tanggalSampai.min = this.value;
		});

		tanggalSampai.addEventListener('change', function() {
			tanggalDari.max = this.value;
		});
	});
</script>
