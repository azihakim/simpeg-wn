@extends('master')
@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1>Edit Penugasan Karyawan</h1>
			</div>
		</div>
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
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
						<form action="{{ route('penugasan.update', $penugasan->id) }}" method="POST" enctype="multipart/form-data">
							@csrf
							@method('PUT')
							<div class="form-group">
								<label for="nama">Nama Karyawan</label>
								<input type="text" class="form-control" id="nama" name="nama" value="{{ $penugasan->user->nama }}"
									readonly>
							</div>
							<div class="form-group">
								<label for="status">Status</label>
								<select class="form-control" id="status" name="status">
									<option value="Aktif" {{ $penugasan->status == 'Aktif' ? 'selected' : '' }}>Aktif</option>
									<option value="Non Aktif" {{ $penugasan->status == 'Non Aktif' ? 'selected' : '' }}>Non Aktif</option>
								</select>
							</div>
							<div class="form-group">
								<label for="surat">Surat Penugasan</label>
								<input type="file" class="form-control" id="surat" name="surat">
								@if ($penugasan->surat)
									<a href="{{ Storage::url('surat_penugasan/' . $penugasan->surat) }}" target="_blank">Lihat Surat</a>
								@endif
							</div>
							<button type="submit" class="btn btn-primary">Simpan Perubahan</button>
							<a href="{{ route('penugasan.index') }}" class="btn btn-secondary">Batal</a>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('js')
@endsection
