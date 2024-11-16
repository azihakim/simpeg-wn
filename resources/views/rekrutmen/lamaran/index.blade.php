@extends('master')
@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1>LAMARAN</h1>
				<p>Daftar Lamaran</p>
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
								<h4 class="card-title">List Lamaran</h4>
							</div>
						</div>
						<table id="example" class="display" style="width:100%">
							<thead>
								<tr>
									<th>Pelamar</th>
									<th>Jabatan</th>
									<th>Status</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($lamaran as $item)
									<tr>
										<td>{{ $item->user->nama }}</td>
										<td>{{ $item->lowongan->jabatan }}</td>
										<td>
											@if ($item->status == 'Diajukan')
												<label class="badge badge-warning">{{ $item->status }}</label>
											@elseif ($item->status == 'Ditolak')
												<label class="badge badge-danger">{{ $item->status }}</label>
											@elseif ($item->status == 'Diterima')
												<label class="badge badge-success">{{ $item->status }}</label>
											@endif
										</td>
										<td>
											@if ($item->status == 'Diajukan')
												<a href="{{ route('lamaran.edit', $item->id) }}" class="btn btn-warning btn-block">Edit</a>
											@endif
											<div class="dropdown">
												<button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuOutlineButton1"
													data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Respon</button>
												<div class="dropdown-menu" aria-labelledby="dropdownMenuOutlineButton1" style="">
													<h6 class="dropdown-header">Cek Lamaran</h6>
													<a class="dropdown-item" href="#">Cek Berkas</a>
													<div class="dropdown-divider"></div>

													<h6 class="dropdown-header">Ubah Status</h6>
													<form action="{{ route('lamaran.status', $item->id) }}" method="POST" style="display:inline;">
														@csrf
														@method('PUT')
														<input type="hidden" name="status" value="Ditolak">
														<button class="dropdown-item" type="submit">Tolak</button>
													</form>
													<form action="{{ route('lamaran.status', $item->id) }}" method="POST" style="display:inline;">
														@csrf
														@method('PUT')
														<input type="hidden" name="status" value="Diterima">
														<button class="dropdown-item" type="submit">Terima</button>
													</form>
												</div>
											</div>
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
