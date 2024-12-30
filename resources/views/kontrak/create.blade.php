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
		<div class="row justify-content-center">
			<div class="col-md-6 grid-margin stretch-card">
				<div class="card">
					<div class="card-body">
						<h4 class="card-title">Form Tambah Kontrak Karyawan</h4>
						<p class="card-description"> Masukkan Data Dengan Benar </p>
						<form action="{{ route('kontrak.store') }}" method="POST" class="forms-sample" enctype="multipart/form-data">
							@csrf
							<div class="row">
								<div class="form-group col-md-12">
									<label>Karyawan</label>
									<select required name="user_id" class="form-control" id="id_karyawan" style="width:100%">
										<option value="">Pilih Karyawan</option>
										@foreach ($karyawan as $item)
											<option value="{{ $item->id }}">{{ $item->nama }} -
												{{ $item->divisi->nama_jabatan }}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="row">
								<div class="form-group col-md-12">
									<label>Keterangan</label>
									<select required name="keterangan" class="form-control" id="id_karyawan" style="width:100%">
										<option disabled selected>Pilih</option>
										<option value="Kontrak">Kontrak</option>
										<option value="Tetap">Tetap</option>
									</select>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="keterangan">Upload Surat</label>
										<div class="input-group col-xs-12">
											<input required="" name="surat_kontrak" type="file" class="form-control file-upload-info"
												placeholder="Upload File">
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label>Tanggal Mulai Kontrak</label>
										<input required type="date" class="form-control" name="mulai_kontrak">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label>Tanggal Berakhir Kontrak</label>
										<input required type="date" class="form-control" name="akhir_kontrak">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="deskripsi">Deskripsi</label>
										<textarea required name="deskripsi" class="form-control" id="deskripsi" style="height: 120px"></textarea>
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
@endsection
