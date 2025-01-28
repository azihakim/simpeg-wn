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
			<div class="alert danger">
				{{ session('error') }}
			</div>
		@endif
		<div class="row">
			<div class="col-md-12 grid-margin stretch-card">
				<div class="card">
					<div class="card-body">
						<h4 class="card-title">Form Edit Karyawan</h4>
						<p class="card-description"> Ubah Data Karyawan </p>
						<form action="{{ route('karyawan.update', $data->id) }}" method="POST" class="forms-sample">
							@csrf
							@method('PUT')
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label>Status</label>
										<select required class="form-control" name="status">
											<option value="">Status</option>
											<option value="Aktif" {{ $data->status == 'Aktif' ? 'selected' : '' }}>Aktif</option>
											<option value="Non-Aktif" {{ $data->status == 'Non-Aktif' ? 'selected' : '' }}>Non-Aktif</option>
										</select>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label>Nama</label>
										<input required type="text" class="form-control" name="nama" value="{{ $data->nama }}">
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>Tanggal Lahir</label>
										<input required type="date" class="form-control" name="tgl_lahir" value="{{ $data->tgl_lahir }}">
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>Jenis Kelamin</label>
										<select required class="form-control" name="jenis_kelamin">
											<option value="">Pilih Jenis Kelamin</option>
											<option value="Laki-laki" {{ $data->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
											<option value="Perempuan" {{ $data->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
										</select>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>Telepon</label>
										<input required type="number" class="form-control" name="telepon" value="{{ $data->telepon }}">
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>NIK</label>
										<input required type="number" class="form-control" name="nik" value="{{ $data->nik }}">
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>Status Kerja</label>
										<select required class="form-control" name="status_kerja">
											<option value="">Pilih Status Kerja</option>
											<option value="Kontrak" {{ $data->status_kerja == 'Kontrak' ? 'selected' : '' }}>Kontrak</option>
											<option value="Tetap" {{ $data->status_kerja == 'Tetap' ? 'selected' : '' }}>Tetap</option>
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
