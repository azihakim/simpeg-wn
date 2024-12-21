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
						<h4 class="card-title">Form Penugasan Karyawan</h4>
						<p class="card-description"> Masukkan Data Dengan Benar </p>
						<form action="{{ route('penugasan.store') }}" method="POST" class="forms-sample" enctype="multipart/form-data">
							@csrf
							<div class="row">
								<div class="form-group col-md-12">
									<label>Karyawan</label>
									<select required name="user_id" class="form-control" id="id_karyawan" style="width:100%">
										<option value="">Pilih Karyawan</option>
										@foreach ($karyawan as $item)
											<option value="{{ $item->id }}" data-divisi_lama="{{ $item->divisi }}">{{ $item->nama }}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="keterangan">Upload Surat Resign</label>
										<div class="input-group col-xs-12">
											<input required="" name="surat" type="file" class="form-control file-upload-info"
												placeholder="Upload File">
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="keterangan">Keterangan</label>
										<textarea required name="keterangan" class="form-control" id="keterangan" style="height: 120px"></textarea>
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
