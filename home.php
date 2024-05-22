<?php
session_start(); // Mulai sesi

require_once "./function/config.php";
require_once "./function/proses_pemesanan.php";

// Periksa apakah pengguna sudah login dan memiliki roles_id = 1 (pengguna biasa)
if (!isset($_SESSION['sesi']) || $_SESSION['roles_id'] != 1) {
	// Jika belum login atau bukan pengguna biasa, redirect ke halaman login.php
	header("Location: ./login.php");
	exit();
}

if (isset($_POST['submit'])) {
	if (prosesPemesanan($conn)) {
		header("Location: home.php");
	} else {
		echo "Ada masalah saat mengedit data";
	}
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/index.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="stylesheet" href="fontawesome-free-6.2.0-web/css/all.css">
	<link rel="stylesheet" href="./assets/css/style.css">
	<title>PROJECT | PWL</title>
</head>

<body>
	<div class="wrapper-outer">
		<div class="wrapper-inner">
			<nav class="navbar navbar-expand-lg sticky-top navbar-light bg-light">
				<div class="container">
					<a href="index" class="navbar-brand"><img src="./assets/image/logo.png" height="45" alt="CoolBrand"></a>
					<button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
						<span class="navbar-toggler-icon"></span>
					</button>
					<div class="collapse navbar-collapse" id="navbarCollapse">
						<div class="navbar-nav">
							<a href="home.php" class="nav-item nav-link active">Home</a>
							<a href="history.php" class="nav-item nav-link">History</a>
						</div>
						<div class="navbar-nav ms-auto ">
							<a class="nav-item nav-link disabled" tabindex="-1">
								<spand id="jam"></spand>
							</a>
							<a class="nav-icon nav-link fa fa-user icon"> <?php echo $_SESSION['sesi']; ?></a>
							<a href="logout.php" class="nav-item nav-link">Keluar</a>
						</div>
					</div>
				</div>
			</nav>
			<!--Main layout-->
			<main class="mt-5">
				<div class="container">
					<!--Section: Content-->
					<section>
						<div class="row">
							<div class="col-md-6 gx-5 mb-4">
								<div class="bg-image hover-overlay shadow-2-strong" data-mdb-ripple-color="light">
									<img src="https://upload.wikimedia.org/wikipedia/commons/7/7a/PDIKM_saat_dipotret_digitalisasi.jpg" class="img-fluid" />
									<a href="#!">
										<div class="mask" style="background-color: rgba(251, 251, 251, 0.15)"></div>
									</a>
								</div>
							</div>
							<div class="col-md-6 gx-5 mb-4">
								<h4><strong>Rekomendasi</strong></h4>
								<p class="text-muted">
									Kalau mendengar kata Padang, kamu pasti teringat akan Sate Padang, Soto Padang, Rumah Gadang, ya, ngaku deh? Padang memang salah satu kota besar yang punya karakter. Terlebih jika kalian punya teman orang Padang, mereka punya prinsip “pantang pulang sebelum sukses”. Kerap kali teman Padang kalian adalah orang yang gigih dan ambisius. Jadi cukup mudah mengingat karakter Padang dan orang-orangnya.
									Tapi tahukah kalian, Padang dan sekitarnya menawarkan banyak hal yang sayang untuk tidak disaksikan dengan mata kepala sendiri. Berikut rangkumannya yang saya temui disana.
								</p>
								<p>
									<strong>Alasan Wajib Ke Sumatra Barat</strong>
								</p>
								<p class="text-muted">
									1.Pemdangan tak kalah jauh dari Selandia baru <br>
									2.Kota Kelahiran bapak bangsa Indonesia<br>
									3.Wisata Budaya Minang dan Sejarah Melawan Penjajahan<br>
									4.Kuliner lezat
								</p>
							</div>
						</div>
					</section>
					<!--Section: Content-->
					<hr class="my-5" />

					<!--Section: Content-->
					<section class="text-center">
						<h4 class="mb-5"><strong>PILIHAN WISATA</strong></h4>
						<div class="row">
							<div class="col-lg-4 col-md-12 mb-4">
								<div class="card card-equal-height">
									<div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
										<img src="https://upload.wikimedia.org/wikipedia/commons/2/2f/Jam_Gadang_Okt_2020_1_crop.jpg" class="img-fluid" />
										<a href="home">
											<div class="mask" style="background-color: rgba(251, 251, 251, 0.15)"></div>
										</a>
									</div>
									<div class="card-body ">
										<h5 class="card-title">MINANGKABAU</h5>
										<p class="card-text">
											Terletak di Sumatra Barat
										</p>
										<a href="home" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#pesanModal">Pesan</a>
									</div>
								</div>
							</div>
							<div class="col-lg-4 col-md-6 mb-4">
								<div class="card card-equal-height">
									<div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
										<img src="https://totabuan.co/wp-content/uploads/2018/06/Pantai-Wisata-Bolsel.jpg" class="img-fluid" />
										<a href="home">
											<div class="mask" style="background-color: rgba(251, 251, 251, 0.15)"></div>
										</a>
									</div>
									<div class="card-body">
										<h5 class="card-title">BORSEL</h5>
										<p class="card-text">
											Terletak di Kecamatan Pinolosian Timur..
										</p>
										<a href="home" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#pesanModal">Pesan</a>
									</div>
								</div>
							</div>
							<div class="col-lg-4 col-md-6 mb-4">
								<div class="card card-equal-height">
									<div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
										<img src="https://assets.kompasiana.com/items/album/2016/07/18/pulau-bokori-500x330-578c29907697735f07856cb4.jpg?t=o&v=770" class="img-fluid" />
										<a href="home">
											<div class="mask" style="background-color: rgba(251, 251, 251, 0.15)"></div>
										</a>
									</div>
									<div class="card-body">
										<h5 class="card-title">TORONIPA</h5>
										<p class="card-text">
											Pantai ini terletak di Kabupaten Konawe.
										</p>
										<a href="home" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#pesanModal">pesan</a>
									</div>
								</div>
							</div>
						</div>
					</section>
					<!--Section: Content-->

					<!--Modal: Pesan Tiket Wisata-->
					<div class="modal fade" id="pesanModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLabel">Pesan Tiket Wisata</h5>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
								<div class="modal-body">
									<form action="" method="post"> <!-- Tambahkan action ke proses_pemesanan.php -->
										<div class="mb-3">
											<label for="username" class="form-label">Username:</label>
											<input type="text" class="form-control" id="username" name="username" value="<?php echo $_SESSION['sesi']; ?>" readonly>
										</div>
										<div class="mb-3">
											<label for="nama_lengkap" class="form-label">Nama Lengkap:</label>
											<input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" placeholder="Masukkan Nama Lengkap Anda" required>
										</div>
										<div class="mb-3">
											<label for="nomor_identitas" class="form-label">Nomor Identitas:</label>
											<input type="text" class="form-control" id="nomor_identitas" name="nomor_identitas" placeholder="Masukkan Nomor Identitas Anda" required>
										</div>
										<div class="mb-3">
											<label for="nomor_hp" class="form-label">Nomor HP:</label>
											<input type="text" class="form-control" id="nomor_hp" name="nomor_hp" placeholder="Masukkan Nomor HP Anda" required>
										</div>
										<div class="mb-3">
											<label for="pilihan_tiket" class="form-label">Pilih Tiket Wisata:</label>
											<select class="form-select" id="pilihan_tiket" name="pilihan_tiket" required>
												<option value="">Pilih Tiket Wisata</option>
												<option value="Minangkabau">Minangkabau</option>
												<option value="Borsel">Borsel</option>
												<option value="Toronipa">Toronipa</option>
											</select>
										</div>
										<div class="mb-3">
											<label for="jadwal_berangkat" class="form-label">Jadwal Berangkat:</label>
											<input type="datetime-local" class="form-control" id="jadwal_berangkat" name="jadwal_berangkat" required>
										</div>
										<button type="submit" name="submit" class="btn btn-primary">Pesan</button>
									</form>
								</div>
							</div>
						</div>
					</div>


				</div>
		</div>
		<!--Main layout-->
	</div>

	<footer class="footer">
		<div class="container">
			<span class="text-muted">&copy;AhmadBedul | 2024</span>
		</div>
	</footer>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<script type="text/javascript">
		window.onload = function() {
			jam();
		}

		function jam() {
			var e = document.getElementById('jam'),
				d = new Date(),
				h, m, s;
			h = d.getHours();
			m = set(d.getMinutes());
			s = set(d.getSeconds());
			e.innerHTML = h + ':' + m + ':' + s;
			setTimeout('jam()', 1000);
		}

		function set(e) {
			e = e < 10 ? '0' + e : e;
			return e;
		}
	</script>
</body>

</html>