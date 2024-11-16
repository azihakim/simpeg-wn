@extends('master')
@section('content')
	<div class="container">
		@if (session('success'))
			<div class="alert alert-success" id="success-alert">
				{{ session('success') }}
			</div>
		@endif
		@if (session('error'))
			<div class="alert alert-error">
				{{ session('error') }}
			</div>
		@endif
		<div class="row">
			<div class="col-md-12 grid-margin stretch-card">
				<div class="card">
					<div class="card-body">
						<h4 class="card-title">Form Edit Pendaftaran</h4>
						<p class="card-description"> Masukkan Data Dengan Benar </p>
						<form action="{{ route('lamaran.update', $data->id) }}" method="POST" class="forms-sample"
							enctype="multipart/form-data">
							@method('PUT')
							@csrf
							<div class="form-group col-md-4">
								<label>Jabatan</label>
								<input type="text" class="form-control" value="{{ $data->lowongan->jabatan }}" disabled>
								<input type="hidden" name="id_lowongan" class="form-control" value="{{ $data->lowongan->id }}">
							</div>
							<div class="form-group">
								<label for="exampleTextarea1">Deskripsi</label>
								<textarea disabled name="deskripsi" class="form-control" id="exampleTextarea1" rows="4">{{ $data->lowongan->deskripsi }}</textarea>
							</div>
							<a href="{{ asset('storage/lamaran_files/' . $data->file) }}" class="btn btn-outline-primary btn-icon-text"
								target="_blank"><i class="fa fa-file-pdf-o btn-icon-prepend"></i>
								Cek Berkas </a>

							<br>
							<br>
							<div class="form-group">
								<label>Upload File Baru</label>
								<p class="card-description">Upload file yang dibutuhkan sesuai persyaratan</p>
								<input required type="file" name="file" class="file-upload-default">
								<div class="input-group">
									<input required type="text" class="form-control file-upload-info" placeholder="Upload File">
									<span class="input-group-append">
										<button class="file-upload-browse btn btn-primary" type="button">Upload</button>
									</span>
								</div>
							</div>
							<div class="d-flex justify-content-end">
								<button type="submit" class="btn btn-outline-primary">Perbarui</button>
								{{-- <button type="reset" class="btn btn-secondary">Reset</button> --}}
							</div>
							{{-- <button class="btn btn-light">Cancel</button> --}}
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('js')
@endsection
