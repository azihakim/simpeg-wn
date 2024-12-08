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
			<div class="alert alert-error">
				{{ session('error') }}
			</div>
		@endif
		<div class="row">
			<div class="col-md-12 grid-margin stretch-card">
				<div class="card">
					<div class="card-body">
						<h4 class="card-title">Form Edit Promosi/Demosi Karyawan</h4>
						<p class="card-description"> Masukkan Data Dengan Benar </p>
						<form action="{{ route('promosidemosi.update', $data->id) }}" method="POST" class="forms-sample"
							enctype="multipart/form-data">
							@csrf
							@method('PUT')
							<div class="row">
								<div class="form-group col-md-2">
									<label>Karyawan</label>
									<select name="id_karyawan" class="form-control" id="id_karyawan" style="width:100%">
										<option value="">Pilih Karyawan</option>
										@foreach ($allKaryawan as $item)
											<option value="{{ $item->id }}" data-divisi_lama="{{ $item->divisi }}"
												{{ $item->id == $karyawan->id ? 'selected' : '' }}>
												{{ $item->nama }}
											</option>
										@endforeach
									</select>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label>Promosi/Demosi</label>
										<select required class="form-control" name="jenis">
											<option value="Promosi" {{ $data->jenis == 'Promosi' ? 'selected' : '' }}>Promosi</option>
											<option value="Demosi" {{ $data->jenis == 'Demosi' ? 'selected' : '' }}>Demosi</option>
										</select>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-2">
									<div class="form-group">
										<label>Divisi Lama</label>
										<input type="text" class="form-control" name="divisi_lama" value="{{ $data->divisi_lama }}" readonly>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label>Divisi Baru</label>
										<input required type="text" class="form-control" name="divisi_baru" value="{{ $data->divisi_baru }}">
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>Upload Surat</label>
										<div class="input-group col-xs-12">
											<input name="surat_rekomendasi" type="file" class="form-control file-upload-info"
												placeholder="Upload File">
										</div>
										@if ($data->surat_rekomendasi)
											<p><a href="{{ Storage::url($data->surat_rekomendasi) }}" target="_blank">Lihat Surat Sebelumnya</a></p>
										@endif
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
