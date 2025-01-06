@extends('master')
@section('css')
@endsection
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
							<h1 style="margin-top: 20px">PT INDO GLOBAL CEMERLANG</h1>
							<img src="{{ asset('assets/images/logo.jpg') }}" style="widows: 400px;">
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
											1. Menyediakan sparepart motor dengan harga terjangkau dan kualitas yang terbaik.<br>
											2. Memberikan layanan pelanggan yang cepat, ramah, dan responsif untuk memastikan kepuasan pelanggan.<br>
											3. Membangun kemitraan yang kuat dengan pemasok, distributor dan memastikan distribusi produk yang efisien dan
											luas.<br>
											4. Menerapkan praktik bisnis yang ramah lingkungan dan kesejahteraan masyarakat.<br>
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
