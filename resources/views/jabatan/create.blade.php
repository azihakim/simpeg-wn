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
						<h4 class="card-title">Form Tambah Jabatan</h4>
						<p class="card-description"> Masukkan Data Dengan Benar </p>
						<form action="{{ route('jabatan.store') }}" method="POST" class="forms-sample" enctype="multipart/form-data">
							@csrf
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label>Jabatan</label>
										<input type="text" class="form-control" name="nama_jabatan" placeholder="Masukkan Jabatan Baru">
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<button type="submit" class="btn btn-outline-primary btn-lg mt-4">Simpan</button>
									</div>
								</div>
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
		document.getElementById('id_karyawan').addEventListener('change', function() {
			var selectedOption = this.options[this.selectedIndex];
			var divisiLama = selectedOption.getAttribute('data-divisi_lama');
			var divisiLamaId = selectedOption.value;
			document.querySelector('input[name="divisi_lama_id"]').value = divisiLamaId;
			document.querySelector('input[name="divisi_lama_display"]').value = divisiLama;
		});
	</script>
@endsection
