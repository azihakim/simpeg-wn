@extends('master')
@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1>Promosi/Demosi Karyawan</h1>
				{{-- <p>Daftar Karyawan</p> --}}
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
								<h4 class="card-title">Promosi Demosi</h4>
							</div>
							@if (Auth::user()->jabatan == 'Super Admin' || Auth::user()->jabatan == 'Admin')
								<div>
									<a href="{{ route('promosidemosi.create') }}" class="btn btn-outline-primary btn-icon-text">
										<i class="fa fa-plus-square btn-icon-prepend"></i> Tambah Promosi/Demosi Karyawan</a>
								</div>
							@endif
						</div>
						<table id="example" class="display" style="width:100%">
							<thead>
								<tr>
									<th>Nama</th>
									<th>Jenis</th>
									<th>Jabatan Lama</th>
									<th>Jabatan Baru</th>
									<th>Tanggal</th>
									<th>Status</th>
									@if (Auth::user()->jabatan == 'Super Admin' || Auth::user()->jabatan == 'Manajer' || Auth::user()->jabatan == 'Admin')
										<th>Aksi</th>
									@endif
								</tr>
							</thead>
							<tbody>
								@foreach ($data as $item)
									<tr>
										<td>{{ $item->karyawan->nama }}</td>
										<td>{{ $item->jenis }}</td>
										<td>{{ $item->divisiLama->nama_jabatan }}</td>
										<td>{{ $item->divisiBaru->nama_jabatan }}</td>
										<td>{{ $item->created_at->format('d/m/Y') }}</td>
										<td>{{ $item->status }}</td>
										<td>
											@if (Auth::user()->jabatan == 'Super Admin' || Auth::user()->jabatan == 'Admin')
												<a href="{{ route('promosidemosi.edit', $item->id) }}" class="btn btn-outline-warning btn-sm">Edit</a>
												<form action="{{ route('promosidemosi.destroy', $item->id) }}" method="POST" class="d-inline">
													@csrf
													@method('delete')
													<button type="submit" class="btn btn-outline-danger btn-sm"
														onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
												</form>
											@endif
											@if (Auth()->user()->jabatan == 'Manajer' || Auth::user()->jabatan == 'Super Admin')
												<div class="dropdown">
													<button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuOutlineButton1"
														data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Ubah Status</button>
													<div class="dropdown-menu" aria-labelledby="dropdownMenuOutlineButton1" style="">
														<h6 class="dropdown-header">Cek Surat</h6>
														<a class="dropdown-item" href="{{ Storage::url($item->surat_rekomendasi) }}" target="_blank">Cek
															Surat</a>
														<div class="dropdown-divider"></div>

														<h6 class="dropdown-header">Ubah Status</h6>
														<form action="{{ route('promosidemosi.status', $item->id) }}" method="POST" style="display:inline;">
															@csrf
															@method('PUT')
															<input type="hidden" name="status" value="Ditolak">
															<button class="dropdown-item" type="submit">Tolak</button>
														</form>
														<form action="{{ route('promosidemosi.status', $item->id) }}" method="POST" style="display:inline;">
															@csrf
															@method('PUT')
															<input type="hidden" name="status" value="Diterima">
															<button class="dropdown-item" type="submit">Terima</button>
														</form>
													</div>
												</div>
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
@endsection

@section('js')
@endsection
