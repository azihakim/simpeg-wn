<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>SIMPEG</title>
	<!-- plugins:css -->
	<link rel="stylesheet" href="{{ asset('assets/vendors/feather/feather.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/vendors/ti-icons/css/themify-icons.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/vendors/font-awesome/css/font-awesome.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/vendors/typicons/typicons.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/vendors/simple-line-icons/css/simple-line-icons.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
	<!-- endinject -->
	<!-- Plugin css for this page -->
	<link rel="stylesheet" href="{{ asset('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/js/select.dataTables.min.css') }}">
	<!-- End plugin css for this page -->
	<!-- inject:css -->
	<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
	<!-- endinject -->
	<link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" />
	<link rel="stylesheet" href="{{ asset('assets/vendors/select2/select2.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css') }}">
	<link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css">

	@yield('css')
</head>

<body class="with-welcome-text">
	<div class="container-scroller">
		<!-- partial:partials/_navbar.html -->
		<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
			<div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
				<div class="me-3">
					<button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
						<span class="icon-menu"></span>
					</button>
				</div>
				<div>

					<span class="mb-1 mt-3 fw-semibold navbar-brand brand-logo">SIMPEG</span>
					<!-- <a class="navbar-brand brand-logo" href="index.html">
						<img src="assets/images/logo.svg" alt="logo" />
					</a> -->
					<!-- <a class="navbar-brand brand-logo-mini" href="index.html">
						<img src="assets/images/logo-mini.svg" alt="logo" />
					</a> -->
				</div>
			</div>
			<div class="navbar-menu-wrapper d-flex align-items-top">
				<ul class="navbar-nav ms-auto">
					<li class="nav-item dropdown d-none d-lg-block user-dropdown">
						<a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
							<span class="mb-1 mt-3 fw-semibold">{{ Auth::user()->nama }} - {{ Auth::user()->jabatan }}</span>&nbsp;
							{{-- <img class="img-xs rounded-circle" src="assets/images/faces/face8.jpg" alt="Profile image"> --}}
							<i class="img-md rounded-circle fa fa-user-circle-o"></i>
						</a>
						<div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
							<div class="dropdown-header text-center">
								<i class="img-md rounded-circle fa fa-user-circle-o"></i>
								{{-- <img class="img-md rounded-circle" src="assets/images/faces/face8.jpg" alt="Profile image"> --}}
								<p class="mb-1 mt-3 fw-semibold">{{ Auth::user()->nama }}</p>
								<p class="fw-light text-muted mb-0">{{ Auth::user()->jabatan }}</p>
							</div>
							<a class="dropdown-item" href="{{ route('logout') }}"
								onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
								{{ __('Log Out') }}
							</a>
							<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
								@csrf
							</form>
						</div>
					</li>
				</ul>
				<button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
					data-bs-toggle="offcanvas">
					<span class="mdi mdi-menu"></span>
				</button>
			</div>
		</nav>
		<!-- partial -->
		<div class="container-fluid page-body-wrapper">
			<!-- partial:partials/_sidebar.html -->
			<nav class="sidebar sidebar-offcanvas" id="sidebar">
				<ul class="nav">
					<li class="nav-item">
						<a class="nav-link" href="">
							<i class="mdi mdi-grid-large menu-icon"></i>
							<span class="menu-title">Dashboard</span>
						</a>
					</li>
					<li class="nav-item nav-category">Rekrutmen</li>
					<li class="nav-item">
						<a class="nav-link" data-bs-toggle="collapse" href="#form-elements" aria-expanded="false"
							aria-controls="form-elements">
							<i class="menu-icon fa fa-address-card-o"></i>
							<span class="menu-title">Rekrutmen</span>
							<i class="menu-arrow"></i>
						</a>
						<div class="collapse" id="form-elements">
							<ul class="nav flex-column sub-menu">
								<li class="nav-item"><a class="nav-link" href="{{ route('lowongan.index') }}">Lowongan</a></li>
								<li class="nav-item"><a class="nav-link" href="{{ route('lamaran.index') }}">Lamaran</a></li>
							</ul>
						</div>
					</li>
					@if (Auth()->user()->jabatan != 'Pelamar')
						<li class="nav-item nav-category">Karyawan</li>
						<li class="nav-item">
							<a class="nav-link" data-bs-toggle="collapse" href="#karyawan" aria-expanded="false"
								aria-controls="karyawan">
								<i class="fa fa-users menu-icon"></i>
								<span class="menu-title">Karyawan</span>
								<i class="menu-arrow"></i>
							</a>
							<div class="collapse" id="karyawan">
								<ul class="nav flex-column sub-menu">
									<li class="nav-item"> <a class="nav-link" href="{{ route('karyawan.index') }}">Karyawan</a></li>
									<li class="nav-item"> <a class="nav-link" href="{{ route('absensi.index') }}">Absensi</a></li>
									<li class="nav-item"> <a class="nav-link" href="{{ route('cutiizin.index') }}">Cuti/Izin</a></li>
								</ul>
							</div>
						</li>

						<li class="nav-item">
							<a class="nav-link" href="{{ route('promosidemosi.index') }}">
								<i class="fa fa-sitemap menu-icon"></i>
								<span class="menu-title">Promosi/Demosi</span>
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="{{ route('rewardpunishment.index') }}">
								<i class="fa fa-legal menu-icon"></i>
								<span class="menu-title">Reward/Punishment</span>
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="{{ route('resign.index') }}">
								<i class="fa fa-times-circle-o menu-icon"></i>
								<span class="menu-title">Resign</span>
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="{{ route('penugasan.index') }}">
								<i class="fa fa-vcard menu-icon"></i>
								<span class="menu-title">Penugasan</span>
							</a>
						</li>
					@endif

				</ul>
			</nav>
			<!-- partial -->
			<div class="main-panel">
				<div class="content-wrapper">
					<div class="row">
						@yield('content')
					</div>
				</div>
				<!-- content-wrapper ends -->
				<!-- partial:partials/_footer.html -->
				<footer class="footer">
					<div class="d-sm-flex justify-content-center justify-content-sm-between">
						<!-- <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Premium <a
								href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin template</a> from
							BootstrapDash.</span> -->
						<span class="float-none float-sm-end d-block mt-1 mt-sm-0 text-center">SIMPEG © 2024.</span>
					</div>
				</footer>
				<!-- partial -->
			</div>
			<!-- main-panel ends -->
		</div>
		<!-- page-body-wrapper ends -->
	</div>
	<!-- container-scroller -->
	<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
	<script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
	<!-- plugins:js -->
	<script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
	<script src="{{ asset('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
	<!-- endinject -->
	<!-- Plugin js for this page -->
	<script src="{{ asset('assets/vendors/chart.js/chart.umd.js') }}"></script>
	<script src="{{ asset('assets/vendors/progressbar.js/progressbar.min.js') }}"></script>
	<script src="{{ asset('assets/vendors/typeahead.js/typeahead.bundle.min.js') }}"></script>
	<script src="{{ asset('assets/vendors/select2/select2.min.js') }}"></script>
	<!-- End plugin js for this page -->
	<!-- inject:js -->
	<script src="{{ asset('assets/js/off-canvas.js') }}"></script>
	<script src="{{ asset('assets/js/template.js') }}"></script>
	<script src="{{ asset('assets/js/settings.js') }}"></script>
	<script src="{{ asset('assets/js/hoverable-collapse.js') }}"></script>
	<script src="{{ asset('assets/js/todolist.js') }}"></script>
	<!-- endinject -->
	<!-- Custom js for this page-->
	<script src="{{ asset('assets/js/jquery.cookie.js') }}" type="text/javascript"></script>
	<script src="{{ asset('assets/js/dashboard.js') }}"></script>
	<script src="{{ asset('assets/js/file-upload.js') }}"></script>
	<script src="{{ asset('assets/js/typeahead.js') }}"></script>
	<script src="{{ asset('assets/js/select2.js') }}"></script>
	<!-- End custom js for this page-->
	@yield('js')

	<script>
		new DataTable('#example');
	</script>
</body>

</html>
