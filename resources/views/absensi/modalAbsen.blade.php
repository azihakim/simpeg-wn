<!-- Modal Absen -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Keterangan Absen</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="row mb-3">
					<label class="form-label">Keterangan Absen</label>
					<div class="col-md-3">
						<div class="form-check-label">
							<input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios1" value="masuk">
							<label class="form-check-label" for="optionsRadios1">Masuk</label>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-check-label">
							<input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios2" value="pulang">
							<label class="form-check-label" for="optionsRadios2">Pulang</label>
						</div>
					</div>
				</div>

				<!-- Kamera dan Foto Preview -->
				<div class="row">
					<label class="form-label">Ambil Foto Bukti</label>
					<div class="col-md-3">
						<button type="button" class="btn btn-outline-primary btn-icon-text" data-bs-toggle="modal"
							data-bs-target="#cameraModal">
							<i class="mdi mdi-camera btn-icon-prepend"></i> Foto </button>
					</div>
					<div class="col-md-9">
						<img id="preview" src="" alt="Preview Foto" class="img-thumbnail d-none mt-2">
					</div>
				</div>
				<!-- Tampilkan Link Lokasi -->
				<div class="mt-3">
					<label>Lokasi:</label>
					<a href="#" id="locationLink" target="_blank" class="d-none">Lihat Lokasi di Google Maps</a>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
				<button type="button" class="btn btn-primary" id="saveButton" disabled onclick="submitAbsensi()">Simpan
					Absensi</button>
			</div>
		</div>
	</div>
</div>

<!-- Modal Kamera -->
<div class="modal fade" id="cameraModal" tabindex="-1" aria-labelledby="cameraModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="cameraModalLabel">Ambil Foto</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<video id="video" width="100%" autoplay playsinline></video>
				<canvas id="canvas" class="d-none"></canvas>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
				<button type="button" class="btn btn-primary" onclick="takePicture()">Ambil Foto</button>
			</div>
		</div>
	</div>
</div>

<!-- Hidden input untuk menyimpan data foto dan link lokasi -->
<input type="hidden" id="photoData" name="photoData">
<input type="hidden" id="locationData" name="locationData">

<script>
	const video = document.getElementById('video');
	const canvas = document.getElementById('canvas');
	const preview = document.getElementById('preview');
	const photoData = document.getElementById('photoData');
	const locationLink = document.getElementById('locationLink');
	const locationData = document.getElementById('locationData');

	function startCamera() {
		navigator.mediaDevices.getUserMedia({
				video: true
			})
			.then(stream => {
				video.srcObject = stream;
			})
			.catch(error => {
				console.error("Kamera tidak dapat diakses:", error);
			});
	}

	function takePicture() {
		const context = canvas.getContext('2d');
		canvas.width = video.videoWidth;
		canvas.height = video.videoHeight;
		context.drawImage(video, 0, 0, canvas.width, canvas.height);

		const dataUrl = canvas.toDataURL('image/png');
		preview.src = dataUrl;
		preview.classList.remove('d-none');
		photoData.value = dataUrl;

		getLocation();

		// Close the camera modal after taking the photo
		const cameraModal = document.getElementById('cameraModal');
		const exampleModal = document.getElementById('exampleModal');

		// Hide the camera modal
		const modalInstance = bootstrap.Modal.getInstance(cameraModal);
		modalInstance.hide();

		// Re-open exampleModal after a short delay to ensure cameraModal fully closes
		setTimeout(() => {
			bootstrap.Modal.getOrCreateInstance(exampleModal).show();
		}, 300);
	}


	function getLocation() {
		if (navigator.geolocation) {
			navigator.geolocation.getCurrentPosition(showPosition, showError);
		} else {
			alert("Geolocation tidak didukung oleh browser ini.");
		}
	}

	function showPosition(position) {
		const latitude = position.coords.latitude;
		const longitude = position.coords.longitude;
		const googleMapsLink = `https://www.google.com/maps?q=${latitude},${longitude}`;

		locationLink.href = googleMapsLink;
		locationLink.classList.remove('d-none');
		locationLink.innerText = "Lihat Lokasi di Google Maps";
		locationData.value = googleMapsLink;
	}

	function showError(error) {
		switch (error.code) {
			case error.PERMISSION_DENIED:
				alert("Pengguna menolak permintaan lokasi.");
				break;
			case error.POSITION_UNAVAILABLE:
				alert("Informasi lokasi tidak tersedia.");
				break;
			case error.TIMEOUT:
				alert("Permintaan lokasi habis waktu.");
				break;
			case error.UNKNOWN_ERROR:
				alert("Terjadi kesalahan yang tidak diketahui.");
				break;
		}
	}

	document.getElementById('cameraModal').addEventListener('shown.bs.modal', startCamera);

	document.getElementById('cameraModal').addEventListener('hidden.bs.modal', () => {
		let stream = video.srcObject;
		if (stream) {
			let tracks = stream.getTracks();
			tracks.forEach(track => track.stop());
		}
		video.srcObject = null;
	});

	const radioButtons = document.getElementsByName('optionsRadios');
	const saveButton = document.getElementById('saveButton');

	// Function to check if form is complete
	function validateForm() {
		const radioSelected = Array.from(radioButtons).some(radio => radio.checked);
		const photoTaken = photoData.value !== '';
		const locationSet = locationData.value !== '';

		// Enable the button if all conditions are met
		saveButton.disabled = !(radioSelected && photoTaken && locationSet);
	}

	// Add event listeners for radio buttons
	radioButtons.forEach(radio => {
		radio.addEventListener('change', validateForm);
	});

	// Modify takePicture function to call validateForm after setting the photo
	function takePicture() {
		const context = canvas.getContext('2d');
		canvas.width = video.videoWidth;
		canvas.height = video.videoHeight;
		context.drawImage(video, 0, 0, canvas.width, canvas.height);

		const dataUrl = canvas.toDataURL('image/png');
		preview.src = dataUrl;
		preview.classList.remove('d-none');
		photoData.value = dataUrl;

		getLocation();

		// Close the camera modal after taking the photo
		const cameraModal = document.getElementById('cameraModal');
		const exampleModal = document.getElementById('exampleModal');

		const modalInstance = bootstrap.Modal.getInstance(cameraModal);
		modalInstance.hide();

		setTimeout(() => {
			bootstrap.Modal.getOrCreateInstance(exampleModal).show();
		}, 300);

		// Call validateForm to check if form can be submitted
		validateForm();
	}

	// Modify showPosition to call validateForm after setting location
	function showPosition(position) {
		const latitude = position.coords.latitude;
		const longitude = position.coords.longitude;
		const googleMapsLink = `https://www.google.com/maps?q=${latitude},${longitude}`;

		locationLink.href = googleMapsLink;
		locationLink.classList.remove('d-none');
		locationLink.innerText = "Lihat Lokasi di Google Maps";
		locationData.value = googleMapsLink;

		// Call validateForm to check if form can be submitted
		validateForm();
	}

	// Run validation on page load in case fields are already filled
	document.addEventListener('DOMContentLoaded', validateForm);

	function submitAbsensi() {
		const radioSelected = document.querySelector('input[name="optionsRadios"]:checked').value;
		const photo = photoData.value;
		const location = locationData.value;

		fetch('/absensi/store', {
				method: 'POST',
				headers: {
					'Content-Type': 'application/json',
					'X-CSRF-TOKEN': '{{ csrf_token() }}' // Ensure this token is included
				},
				body: JSON.stringify({
					absen: radioSelected,
					photo: photo,
					location: location
				})
			})
			.then(response => {
				if (response.ok) {
					alert('Absensi berhasil disimpan.');
					// You can also reload the page or update the UI here
					bootstrap.Modal.getInstance(document.getElementById('exampleModal')).hide();
				} else {
					alert('Gagal menyimpan absensi. Silakan coba lagi.');
				}
			})
			.catch(error => {
				console.error('Error:', error);
				alert('Terjadi kesalahan saat mengirim data.');
			});
	}
</script>
