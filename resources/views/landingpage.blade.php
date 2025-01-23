<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Landing Page</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
	<style>
		.stretch-card {
			display: flex;
			align-items: stretch;
			justify-content: stretch;
		}

		.card-title {
			font-weight: bold;
			font-size: 1.5rem;
			margin-bottom: 20px;
		}

		ol {
			text-align: left;
			margin: 0 auto;
			max-width: 600px;
		}
	</style>
</head>

<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<div class="container-fluid">
			<a class="navbar-brand" href="#">PT INDO GLOBAL CEMERLANG</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
				aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNav">
				<ul class="navbar-nav ms-auto">
					<li class="nav-item">
						<a class="btn btn-primary" href="/login">Login</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>

	<div class="container">
		<div class="row">
			<div class="col-md-12 text-center my-4">
				<div class="text-center">
					<div class="col-sm-12">
						<h1 style="margin-top: 20px">PT INDO GLOBAL CEMERLANG</h1>
						<img src="assets/images/logo.jpg" alt="Logo" style="width: 400px;">
					</div>
				</div>
			</div>
		</div>

		<div class="row justify-content-center">
			<div class="col-sm-12 stretch-card grid-margin">
				<div class="row justify-content-center text-center mt-4" id="visi">
					<div class="col-md-12">
						<div class="card-body">
							<div class="card-title">VISI</div>
							<div class="d-flex justify-content-center">
								<h4>“MENJADI SUPPLIER SPAREPART MOTOR YANG TERPERCAYA”</h4>
							</div>
						</div>
					</div>
				</div>

				<div class="row justify-content-center text-center mt-4" id="misi">
					<div class="col-md-12">
						<div class="card-body">
							<div class="card-title">MISI</div>
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

	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>
