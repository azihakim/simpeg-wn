@extends('master')
@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1>LOWONGAN</h1>
				<p>Daftar Lowongan kerja</p>
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
								<h4 class="card-title">List Lowongan</h4>
							</div>
							@if (Auth::user()->jabatan == 'Admin' || Auth::user()->jabatan == 'Super Admin')
								<div>
									<a href="{{ route('lowongan.create') }}" class="btn btn-outline-primary btn-icon-text">
										<i class="fa fa-plus-square btn-icon-prepend"></i> Tambah Lowongan</a>
								</div>
							@endif
						</div>
						<table id="example" class="display" style="width:100%">
							<thead>
								<tr>
									<th>Jabatan</th>
									<th>Status</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($lowongan as $item)
									<tr>
										<td>{{ $item->divisi->nama_jabatan }}</td>
										<td style="text-align: center">
											@if ($item->status == 'Aktif')
												<label class="badge badge-primary">{{ $item->status }}</label>
											@else
												<label class="badge badge-danger">{{ $item->status }}</label>
											@endif
										</td>
										@if (Auth::user()->jabatan == 'Pelamar')
											<td style="text-align: center">
												<a href="{{ route('lamaran.regist', $item->id) }}" class="btn btn-outline-info btn-block">Daftar</a>
											</td>
										@elseif (Auth::user()->jabatan == 'Super Admin')
											<td style="text-align: center">
												<a href="{{ route('lowongan.edit', $item->id) }}" class="btn btn-warning btn-block">Edit</a>
												<form action="{{ route('lowongan.destroy', $item->id) }}" method="post" style="display: inline">
													@csrf
													@method('DELETE')
													<button type="submit" class="btn btn-danger">Hapus</button>
												</form>
											</td>
										@else
											<td></td>
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
