@extends('master')
@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12 grid-margin stretch-card">
				<div class="card">
					<div class="card-body">
						<h4 class="card-title">Form Pendaftaran</h4>
						<p class="card-description"> Masukkan Data Dengan Benar </p>
						<form action="{{ route('lamaran.store') }}" method="POST" class="forms-sample" enctype="multipart/form-data">
							@csrf
							<div class="form-group col-md-4">
								<label>Jabatan</label>
								<input type="text" class="form-control" value="{{ $lowongan->divisi->nama_jabatan }}" disabled>
								<input type="hidden" name="id_lowongan" class="form-control" value="{{ $lowongan->id }}">
							</div>
							<div class="form-group">
								<label for="exampleTextarea1">Deskripsi</label>
								<textarea disabled name="deskripsi" class="form-control" id="exampleTextarea1" rows="1"
								 style="overflow: hidden; resize: none;">{{ $lowongan->deskripsi }}</textarea>
							</div>
							<div class="form-group">
								<label>Upload File</label>
								<p class="card-description">Upload file yang dibutuhkan sesuai persyaratan</p>
								<input required type="file" name="file" class="file-upload-default">
								<div class="input-group col-xs-12">
									<input required type="text" class="form-control file-upload-info" disabled="" placeholder="Upload File">
									<span class="input-group-append">
										<button class="file-upload-browse btn btn-primary" type="button">Upload</button>
									</span>
								</div>
							</div>
							<div class="d-flex justify-content-end">
								<button type="submit" class="btn btn-outline-primary">Daftar</button>
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
	<script>
		// Function to automatically adjust the height of the textarea based on content
		function adjustTextareaHeight() {
			const textarea = document.getElementById('exampleTextarea1');
			textarea.style.height = 'auto'; // Reset height before recalculating
			textarea.style.height = (textarea.scrollHeight) + 'px'; // Set the height based on scrollHeight
		}

		// Call the function on page load to adjust the height initially
		window.onload = function() {
			adjustTextareaHeight();
		};

		// Optional: Add an event listener for input in case the content is dynamically updated
		document.getElementById('exampleTextarea1').addEventListener('input', adjustTextareaHeight);
	</script>
@endsection
