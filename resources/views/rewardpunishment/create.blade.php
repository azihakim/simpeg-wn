@extends('master')
@section('content')
	<div class="container">
		@if (session('success'))
			<div class="alert alert-success" id="success-alert">
				{{ session('success') }}
			</div>
			<script>
				setTimeout(function() {
					document.getElementById('success-alert').style.display = 'none';
				}, 3000);
			</script>
		@endif
		@if (session('error'))
			<div class="alert alert-danger" id="error-alert">
				{{ session('error') }}
			</div>
			<script>
				setTimeout(function() {
					document.getElementById('error-alert').style.display = 'none';
				}, 3000);
			</script>
		@endif
		<div class="row">
			<div class="col-md-12 grid-margin stretch-card">
				<div class="card">
					<div class="card-body">
						<h4 class="card-title">Form Reward/Punishment Karyawan</h4>
						<p class="card-description"> Masukkan Data Dengan Benar </p>
						<form action="{{ route('rewardpunishment.store') }}" method="POST" class="forms-sample"
							enctype="multipart/form-data">
							@csrf
							<div class="row">
								<div class="form-group col-md-2">
									<label>Karyawan</label>
									<select required name="id_karyawan" class="form-control" id="id_karyawan" style="width:100%">
										<option value="">Pilih Karyawan</option>
										@foreach ($karyawan as $item)
											<option value="{{ $item->id }}" data-divisi_lama="{{ $item->divisi }}">{{ $item->nama }}</option>
										@endforeach
									</select>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label>Reward/Punishment</label>
										<select required class="form-control" name="jenis" id="jenis">
											<option selected disabled value="">Pilih Jenis</option>
											<option value="Reward">Reward</option>
											<option value="Punishment">Punishment</option>
										</select>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label>Tanggal</label>
										<input required="" type="date" class="form-control" name="tanggal" id="">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label for="keterangan">Keterangan</label>
										<textarea required name="keterangan" class="form-control" id="keterangan" style="height: 120px"></textarea>
									</div>
								</div>
								<!-- Input untuk Reward -->
								<div class="col-md-3" id="divReward" style="display: none;">
									<div class="form-group">
										<label>Reward</label>
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text">Rp</span>
											</div>
											<input type="number" name="reward" id="reward" class="form-control" placeholder="Reward"
												aria-label="Reward">
										</div>
									</div>
								</div>
								<!-- Input untuk Punishment -->
								<div class="col-md-4" id="divSuratPunishment" style="display: none;">
									<div class="form-group">
										<label>Upload Surat</label>
										<div class="input-group col-xs-12">
											<input name="surat_punishment" id="surat_punishment" type="file" class="form-control file-upload-info"
												placeholder="Upload File">
										</div>
									</div>
								</div>
							</div>
							<div class="d-flex justify-content-end">
								<button type="submit" class="btn btn-outline-primary">Simpan</button>
							</div>
						</form>


					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('js')
	<script>
		document.addEventListener('DOMContentLoaded', function() {
			const jenisSelect = document.getElementById('jenis');
			const divReward = document.getElementById('divReward');
			const divSuratPunishment = document.getElementById('divSuratPunishment');
			const rewardInput = document.getElementById('reward');
			const suratPunishmentInput = document.getElementById('surat_punishment');

			jenisSelect.addEventListener('change', function() {
				const selectedValue = this.value;

				// Reset tampilan dan required
				divReward.style.display = 'none';
				divSuratPunishment.style.display = 'none';
				rewardInput.removeAttribute('required');
				suratPunishmentInput.removeAttribute('required');

				// Tampilkan input berdasarkan jenis yang dipilih dan tambahkan required
				if (selectedValue === 'Reward') {
					divReward.style.display = 'block';
					rewardInput.setAttribute('required', 'required');
				} else if (selectedValue === 'Punishment') {
					divSuratPunishment.style.display = 'block';
					suratPunishmentInput.setAttribute('required', 'required');
				}
			});
		});
	</script>
@endsection
