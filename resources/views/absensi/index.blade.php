@extends('master')
@section('css')
	{{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
@endsection
@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1>Absensi</h1>
				<p>Absensi Karyawan</p>
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
						<div class="d-flex justify-content-between">
							<div>
								<h4 class="card-title">List Karyawn</h4>
							</div>
							{{-- <div>
								<a href="" class="btn btn-outline-primary btn-icon-text">
									<i class="fa fa-plus-square btn-icon-prepend"></i> Tambah Karyawan</a>
							</div> --}}
							<div>
								<button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
									Absen
								</button>
								@if (Auth::user()->jabatan == 'Admin')
									<button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#rekapAbsensi">
										Rekap Absen
									</button>
								@endif
							</div>
						</div>
						<table id="example" class="display" style="width:100%">
							<thead>
								<tr>
									<th>Nama</th>
									<th>Keterangan</th>
									<th>Tanggal</th>
									<th>Lokasi</th>
									<th>Foto</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($data as $item)
									<tr>
										<td>{{ $item->user->nama }}</td>
										<td>{{ $item->keterangan }}</td>
										<td>{{ $item->created_at->format('d-m-Y') }}</td>
										<td>
											<a href="{{ $item->lokasi }}" target="_blank">Cek</a>
										</td>
										<td>
											@if ($item->foto)
												<img src="{{ asset('storage/absensi/' . $item->foto) }}" alt="foto" width="100">
											@else
												-
											@endif
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>

	@include('absensi.modalAbsen')
	@include('absensi.modalRekap')
@endsection

@section('js')
	<script>
		new DataTable('#example');
	</script>
	<script>
		setTimeout(function() {
			let successAlert = document.getElementById('success-alert');
			let fadeEffect = setInterval(function() {
				if (!successAlert.style.opacity) {
					successAlert.style.opacity = 1;
				}
				if (successAlert.style.opacity > 0) {
					successAlert.style.opacity -= 0.1;
				} else {
					clearInterval(fadeEffect);
					successAlert.style.display = 'none';
				}
			}, 50);
		}, 4000);
	</script>
@endsection
