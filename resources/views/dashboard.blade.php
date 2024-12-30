@extends('master')
@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1>Dashboard</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12 stretch-card grid-margin">
				<div class="card">

					<div style="text-align: center">
						<div class="col-sm-12">
							<img src="{{ asset('assets/images/logo.jpg') }}" alt="">
							<h1>PT INDO GLOBAL CEMERLANG</h1>
						</div>
					</div>
					<div class="row justify-content-center" style="text-align: center">
						<div class="col-md-12">
							<div class="card border-0">
								<div class="card-body">
									<div class="card-title"> VISI </div>
									<div class="d-flex justify-content-center">
										<h4>“MENJADI SUPPLIER SPAREPART MOTOR YANG TERPERCAYA” </h4>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row justify-content-center" style="text-align: center">
						<div class="col-md-12">
							<div class="card border-0">
								<div class="card-body">
									<div class="card-title"> MISI </div>
									<div class="d-flex justify-content-center">
										<ol>
											<li>Menyediakan sparepart motor dengan harga terjangkau dan kualitas yang terbaik.</li>
											<li>Memberikan layanan pelanggan yang cepat, ramah, dan responsif untuk memastikan kepuasan pelanggan.</li>
											<li>Membangun kemitraan yang kuat dengan pemasok, distributor dan memastikan distribusi produk yang efisien
												dan luas.</li>
											<li>Menerapkan praktik bisnis yang ramah lingkungan dan kesejahteraan masyarakat.</li>
										</ol>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
