@extends('master')
@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1>Kelola Jabatan</h1>
				{{-- <p>Daftar Karyawan</p> --}}
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
			<div class="col-md-8">
				<div class="card">
					<div class="card-body">
						<div class="d-flex justify-content-between">
							<div>
								<h4 class="card-title">Jabatan</h4>
							</div>
							@if (Auth::user()->jabatan == 'Admin')
								<div>
									<a href="{{ route('jabatan.create') }}" class="btn btn-outline-primary btn-icon-text">
										<i class="fa fa-plus-square btn-icon-prepend"></i> Tambah Jabatan</a>
								</div>
							@endif
						</div>
						<table id="example" class="display" style="width:100%">
							<thead>
								<tr>
									<th style="max-width: 5px">#</th>
									<th>Jabatan</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($data as $item)
									<tr>
										<td>{{ $loop->iteration }}</td>
										<td>{{ $item->nama_jabatan }}</td>
										<td>
											<a href="{{ route('jabatan.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
											<form action="{{ route('jabatan.destroy', $item->id) }}" method="POST" style="display:inline-block;">
												@csrf
												@method('DELETE')
												<button type="submit" class="btn btn-danger btn-sm"
													onclick="return confirm('yakin hapus data ini?');">Delete</button>
											</form>
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
