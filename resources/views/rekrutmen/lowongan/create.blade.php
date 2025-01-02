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
						<h4 class="card-title">Form Tambah Lowongan</h4>
						<p class="card-description"> Masukkan Data Dengan Benar </p>
						<form action="{{ route('lowongan.store') }}" method="POST" class="forms-sample">
							@csrf
							<div class="form-group col-md-4">
								<label>Jabatan</label>
								<select name="jabatan" class="form-select js-example-basic-single" style="width:100%">
									@foreach ($jabatan as $item)
										<option value="{{ $item->id }}">{{ $item->nama_jabatan }}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group">
								<label for="exampleTextarea1">Deskripsi</label>
								<textarea name="deskripsi" class="form-control" id="exampleTextarea1" rows="1" style="overflow: show;"></textarea>
							</div>
							<div class="d-flex justify-content-end">
								<button type="submit" class="btn btn-outline-primary">Simpan</button>
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
