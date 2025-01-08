@extends('master')
@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1>Form Edit PHK</h1>
			</div>
		</div>
		@if (session('success'))
			<div class="alert alert-success" id="success-alert">
				{{ session('success') }}
			</div>
		@endif
		@if (session('error'))
			<div class="alert alert-danger">
				{{ session('error') }}
			</div>
		@endif
		<div class="row justify-content-center">
			<div class="col-md-6">
				<div class="card">
					<div class="card-body">
						<form action="{{ route('phk.update', $data->id) }}" method="POST" enctype="multipart/form-data">
							@csrf
							@method('PUT')
							<div class="form-group">
								<label for="nama">Nama Karyawan</label>
								<input type="text" class="form-control" id="nama" name="nama" value="{{ $data->user->nama }}"
									readonly>
							</div>
							<div class="form-group">
								<label for="status">Status</label>
								<select class="form-control" id="status" name="status">
									<option value="Aktif" {{ $data->status == 'Aktif' ? 'selected' : '' }}>Aktif</option>
									<option value="Non Aktif" {{ $data->status == 'Non Aktif' ? 'selected' : '' }}>Non Aktif</option>
								</select>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="keterangan">Keterangan</label>
										<textarea required name="keterangan" class="form-control" id="keterangan" style="height: 120px">{{ $data->keterangan }}</textarea>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="surat">Surat PHK</label>
								<input type="file" class="form-control" id="surat" name="surat_phk">
								@if ($data->surat)
									<a href="{{ Storage::url('surat_phk/' . $data->surat) }}" target="_blank">Lihat Surat</a>
								@endif
							</div>
							<button type="submit" class="btn btn-primary">Simpan Perubahan</button>
							<a href="{{ route('phk.index') }}" class="btn btn-secondary">Batal</a>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('js')
@endsection
