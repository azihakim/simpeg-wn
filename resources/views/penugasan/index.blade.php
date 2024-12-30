@extends('master')
@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1>Pengajuan Penugasan Karyawan</h1>
				{{-- <p>Daftar Karyawan</p> --}}
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
								<h4 class="card-title">Data Penugasan</h4>
							</div>
							@if (Auth::user()->jabatan == 'Super Admin')
								<div>
									<a href="{{ route('penugasan.create') }}" class="btn btn-outline-primary btn-icon-text">
										<i class="fa fa-plus-square btn-icon-prepend"></i> Tambah Pengajuan Penugasan</a>
								</div>
							@endif
						</div>
						<table id="example" class="display" style="width:100%">
							<thead>
								<tr>
									<th>#</th>
									<th>Nama Karyawan</th>
									<th>Status</th>
									<th>Surat</th>
									@if (Auth::user()->jabatan == 'Super Admin')
										<th>Aksi</th>
									@endif
								</tr>
							</thead>
							<tbody>
								@foreach ($data as $item)
									<tr>
										<td>{{ $loop->iteration }}</td>
										<td>{{ $item->user->nama }}</td>
										<td>{{ $item->status }}</td>
										<td>
											<a href="{{ Storage::url('surat_penugasan/' . $item->surat) }}" class="btn btn-outline-info"
												target="_blank">Cek Surat</a>
										</td>
										@if (Auth::user()->jabatan == 'Super Admin')
											<td>
												<div class="dropdown">
													<button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuOutlineButton1"
														data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Aksi</button>
													<div class="dropdown-menu" aria-labelledby="dropdownMenuOutlineButton1" style="">
														<div class="dropdown-divider"></div>

														@if (Auth()->user()->jabatan == 'Super Admin')
															<h6 class="dropdown-header">Ubah Status</h6>
															<form action="{{ route('penugasan.status', $item->id) }}" method="POST" style="display:inline;">
																@csrf
																@method('PUT')
																<input type="hidden" name="status" value="Aktif">
																<button class="dropdown-item" type="submit">Aktif</button>
															</form>
															<form action="{{ route('penugasan.status', $item->id) }}" method="POST" style="display:inline;">
																@csrf
																@method('PUT')
																<input type="hidden" name="status" value="Non Aktif">
																<button class="dropdown-item" type="submit">Non Aktif</button>
															</form>
														@endif
													</div>
												</div>
												<a href="{{ route('penugasan.edit', $item->id) }}" class="btn btn-outline-warning">Edit</a>
												<form action="{{ route('penugasan.destroy', $item->id) }}" method="POST" class="d-inline">
													@csrf
													@method('delete')
													<button class="btn btn-outline-danger"
														onclick="return confirm('Yakin Ingin Menghapus Data Ini?')">Hapus</button>
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
@endsection
