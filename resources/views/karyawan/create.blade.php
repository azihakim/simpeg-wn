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
						<h4 class="card-title">Form Tambah Karyawan</h4>
						<p class="card-description"> Masukkan Data Dengan Benar </p>
						<form action="{{ route('karyawan.store') }}" method="POST" class="forms-sample">
							@csrf
							<div class="form-group col-md-4">
								<label>Calon Karyawan</label>
								<select name="pelamar" class="form-control" id="pelamarSelect" style="width:100%">
									<option value="">Pilih Calon Karyawan</option>
									@foreach ($pelamar as $item)
										<option value="{{ $item->user->id }}" data-nama="{{ $item->user->nama }}" data-umur="{{ $item->user->umur }}"
											data-alamat="{{ $item->user->alamat }}" data-telepon="{{ $item->user->telepon }}"
											data-jenis_kelamin="{{ $item->user->jenis_kelamin }}" data-pelamarId="{{ $item->id }}">
											{{ $item->user->nama }}
										</option>
									@endforeach
								</select>
								<input type="hidden" name="id_pelamar">
							</div>
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label>Nama</label>
										<input required type="text" class="form-control" name="nama">
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>Umur</label>
										<input required type="text" class="form-control" name="umur">
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>Jenis Kelamin</label>
										{{-- <input required type="text" class="form-control" name="jenis_kelamin"> --}}
										<select required class="form-control" name="jenis_kelamin">
											<option value="">Pilih Jenis Kelamin</option>
											<option value="Laki-laki">Laki-laki</option>
											<option value="Perempuan">Perempuan</option>
										</select>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>Telepon</label>
										<input required type="text" class="form-control" name="telepon">
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>NIK</label>
										<input required type="text" class="form-control" name="nik">
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>Status Kerja</label>
										{{-- <input required type="text" class="form-control" name="status_kerja"> --}}
										<select required class="form-control" name="status_kerja">
											<option value="">Pilih Jenis Kelamin</option>
											<option value="Kontrak">Kontrak</option>
											<option value="Tetap">Tetap</option>
										</select>
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
		$(document).ready(function() {
			// Initialize select2
			// $('#pelamarSelect').select2();

			// Bind change event using jQuery
			$('#pelamarSelect').on('change', function() {
				const selectedOption = this.options[this.selectedIndex];

				// Update text inputs
				const inputNames = ['nama', 'umur', 'telepon'];
				inputNames.forEach(name => {
					const inputField = document.querySelector(`input[name="${name}"]`);
					if (inputField) {
						inputField.value = selectedOption.getAttribute(`data-${name}`) || '';
					}
				});

				// Update "Jenis Kelamin" select field
				const jenisKelamin = selectedOption.getAttribute('data-jenis_kelamin');
				const jenisKelaminField = document.querySelector(`select[name="jenis_kelamin"]`);
				if (jenisKelaminField) {
					// Set the selected option based on the data-jenis_kelamin attribute
					for (const option of jenisKelaminField.options) {
						option.selected = option.value === jenisKelamin;
					}
				}

				const pelamarId = selectedOption.getAttribute('data-pelamarId');
				const idPelamarField = document.querySelector('input[name="id_pelamar"]');
				if (idPelamarField) {
					idPelamarField.value = pelamarId;
				}
			});
		});
	</script>
@endsection
