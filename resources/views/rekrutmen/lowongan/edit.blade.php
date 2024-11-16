@extends('master')
@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12 grid-margin stretch-card">
				<div class="card">
					<div class="card-body">
						<h4 class="card-title">Form Tambah Lowongan</h4>
						<p class="card-description"> Masukkan Data Dengan Benar </p>
						<form action="{{ route('lowongan.update', $lowongan->id) }}" method="POST" class="forms-sample">
							@csrf
							@method('PUT')
							<div class="row">
								<div class="form-group col-md-4">
									<label>Jabatan</label>
									<select required name="jabatan" class="form-select js-example-basic-single" style="width:100%">
										@foreach ($jabatan as $item)
											<option value="{{ $item->jabatan }}" {{ $item->jabatan == $lowongan->jabatan ? 'selected' : '' }}>
												{{ $item->jabatan }}</option>
										@endforeach
									</select>
								</div>
								<div class="form-group col-md-2">
									<label>Status</label>
									<select required class="form-select" name="status">
										<option value="Aktif" {{ $lowongan->status == 'Aktif' ? 'selected' : '' }}>Aktif</option>
										<option value="Non-Aktif" {{ $lowongan->status == 'Non-Aktif' ? 'selected' : '' }}>Non-Aktif</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="exampleTextarea1">Deskripsi</label>
								<textarea name="deskripsi" class="form-control" id="exampleTextarea1" rows="4">{{ $lowongan->deskripsi }}</textarea>
							</div>
							<div class="d-flex justify-content-between">
								<button type="reset" class="btn btn-outline-danger">Kembali</button>
								<button type="submit" class="btn btn-outline-primary">Simpan</button>
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
