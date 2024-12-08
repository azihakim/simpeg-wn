@extends('master')
@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1>Reward/Punishment Karyawan</h1>
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
								<h4 class="card-title">Reward Punishment</h4>
							</div>
							@if (Auth::user()->jabatan == 'Admin')
								<div>
									<a href="{{ route('rewardpunishment.create') }}" class="btn btn-outline-primary btn-icon-text">
										<i class="fa fa-plus-square btn-icon-prepend"></i> Tambah Reward/Punishment Karyawan</a>
								</div>
							@endif
						</div>
						<table id="example" class="display" style="width:100%">
							<thead>
								<tr>
									<th>#</th>
									<th>Nama Karyawan</th>
									<th>Jenis</th>
									<th>Tanggal</th>
									<th>Reward</th>
									<th>Surat Punishment</th>
									<th>Status</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($rewardPunishments as $item)
									<tr>
										<td>{{ $loop->iteration }}</td>
										<td>{{ $item->karyawan->nama }}</td>
										<td>{{ $item->jenis }}</td>
										<td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}</td>
										<td>{{ $item->reward ? 'Rp' . number_format($item->reward, 0, ',', '.') : '-' }}</td>
										<td>
											@if ($item->surat_punishment)
												<a href="{{ Storage::url($item->surat_punishment) }}" target="_blank">Lihat File</a>
											@else
												-
											@endif
										</td>
										<td>{{ $item->status }}</td>
										<td>
											<a href="{{ route('rewardpunishment.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
											<form action="{{ route('rewardpunishment.destroy', $item->id) }}" method="POST"
												style="display: inline-block;" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
												@csrf
												@method('DELETE')
												<button type="submit" class="btn btn-sm btn-danger">Hapus</button>
											</form>

											@if (Auth()->user()->jabatan == 'Manajer')
												<div class="dropdown">
													<button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuOutlineButton1"
														data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Ubah Status</button>
													<div class="dropdown-menu" aria-labelledby="dropdownMenuOutlineButton1" style="">
														<h6 class="dropdown-header">Ubah Status</h6>
														<form action="{{ route('rewardpunishment.status', $item->id) }}" method="POST" style="display:inline;">
															@csrf
															@method('PUT')
															<input type="hidden" name="status" value="Ditolak">
															<button class="dropdown-item" type="submit">Tolak</button>
														</form>
														<form action="{{ route('rewardpunishment.status', $item->id) }}" method="POST" style="display:inline;">
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
