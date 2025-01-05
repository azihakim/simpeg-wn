@extends('master')
@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1>Karyawan</h1>
				<p>Daftar Karyawan</p>
			</div>
		</div>
		@if (session('success'))
			<div class="alert alert-success" id="success-alert">
				{{ session('success') }}
			</div>
		@endif
		@if (session('error'))
			<div class="alert danger">
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
							@if (Auth::user()->jabatan == 'Super Admin' || Auth::user()->jabatan == 'Admin' || Auth::user()->jabatan == 'Manajer')
								<div>
									<a href="{{ route('karyawan.create') }}" class="btn btn-outline-primary btn-icon-text">
										<i class="fa fa-plus-square btn-icon-prepend"></i> Tambah Karyawan</a>
								</div>
							@endif
						</div>
						<table id="example" class="display" style="width:100%">
							<thead>
								<tr>
									<th>Status</th>
									<th>Nama</th>
									<th>Status Kerja</th>
									<th>NIK</th>
									@if (Auth::user()->jabatan == 'Super Admin' || Auth::user()->jabatan == 'Admin')
										<th>Aksi</th>
									@endif
								</tr>
							</thead>
							<tbody>
								@foreach ($data as $item)
									<tr>
										<td>{{ $item->status }}</td>
										<td>{{ $item->nama }}</td>
										<td>{{ $item->status_kerja }}</td>
										<td>{{ $item->nik }}</td>
										@if (Auth::user()->jabatan == 'Super Admin' || Auth::user()->jabatan == 'Admin')
											<td>
												<a href="{{ route('karyawan.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
												<form action="{{ route('karyawan.destroy', $item->id) }}" method="POST" style="display:inline-block;">
													@csrf
													@method('DELETE')
													<button type="submit" class="btn btn-danger btn-sm">Delete</button>
												</form>
											</td>
										@endif
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
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
