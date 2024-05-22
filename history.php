<?php
session_start(); // Memulai sesi

require_once "./function/proses_pemesanan.php";

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['sesi'])) {
    header("Location: login.php");
    exit();
}

// Ambil nomor identitas dari sesi pengguna
$username = $_SESSION['sesi'];

// Query SQL untuk mengambil data pesanan berdasarkan nomor identitas
$sql = "SELECT * FROM pesanan WHERE username = '$username'";
$result = $conn->query($sql);

if (isset($_POST['submit'])) {
    if (prosesPerubahanPesanan($conn)) {
        header("Location: home.php");
    } else {
        echo "Ada masalah saat mengedit data";
    }
}

if (isset($_GET['success']) && $_GET['success'] == 1) {
    echo "<p>Data berhasil diubah!</p>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="./assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <nav class="navbar navbar-expand-lg sticky-top navbar-light bg-light">
        <div class="container">
            <a href="home" class="navbar-brand"><img src="./assets/image/logo.png" height="45" alt="CoolBrand"></a>
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav">
                    <a href="home" class="nav-item nav-link active">Home</a>
                    <a href="history" class="nav-item nav-link">History</a>
                </div>
                <div class="navbar-nav ms-auto ">
                    <!-- Check if user is logged in -->
                    <?php if (isset($_SESSION['sesi'])) { ?>
                        <a class="nav-icon nav-link fa fa-user icon"> <?php echo $_SESSION['sesi']; ?></a>
                        <a href="logout" class="nav-item nav-link">Keluar</a>
                    <?php } else { ?>
                        <a href="login" class="nav-item nav-link">Masuk</a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h2 class="mb-4">History Pesanan</h2>
        <div class="row row-cols-1 row-cols-md-2 g-4">
            <?php
            // Check if there are any orders
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
            ?>
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Kode Pesanan : <?php echo $row['id']; ?></h5>
                                <p class="card-text">Nama: <?php echo $row['nama_lengkap']; ?></p>
                                <p class="card-text">Nomor Identitas: <?php echo $row['nomor_identitas']; ?></p>
                                <p class="card-text">Nomor HP: <?php echo $row['nomor_hp']; ?></p>
                                <p class="card-text">Pilihan Tiket: <?php echo $row['pilihan_tiket']; ?></p>
                                <p class="card-text">Jadwal Berangkat: <?php echo $row['jadwal_berangkat']; ?></p>
                                <p class="card-text">Status Pesanan: <?php echo $row['status']; ?></p>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ubahPesananModal<?php echo $row['id']; ?>">
                                    Ubah
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Ubah Pesanan -->
                    <div class="modal fade" id="ubahPesananModal<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="ubahPesananModalLabel<?php echo $row['id']; ?>" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="ubahPesananModalLabel<?php echo $row['id']; ?>">Ubah Pesanan</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- Form ubah pesanan -->
                                    <form action="" method="POST">
                                        <input type="hidden" name="id_pesanan" value="<?php echo $row['id']; ?>">
                                        <div class="mb-3">
                                            <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                                            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="<?php echo $row['nama_lengkap']; ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="nomor_identitas" class="form-label">Nomor Identitas</label>
                                            <input type="text" class="form-control" id="nomor_identitas" name="nomor_identitas" value="<?php echo $row['nomor_identitas']; ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="nomor_hp" class="form-label">Nomor HP</label>
                                            <input type="text" class="form-control" id="nomor_hp" name="nomor_hp" value="<?php echo $row['nomor_hp']; ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="pilihan_tiket" class="form-label">Pilihan Tiket</label>
                                            <input type="text" class="form-control" id="pilihan_tiket" name="pilihan_tiket" value="<?php echo $row['pilihan_tiket']; ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="jadwal_berangkat" class="form-label">Jadwal Berangkat</label>
                                            <!-- Menggabungkan tanggal dan waktu ke dalam satu input -->
                                            <?php
                                            $jadwal_berangkat = date("Y-m-d H:i:s", strtotime($row['jadwal_berangkat']));
                                            ?>
                                            <input type="datetime-local" class="form-control" id="jadwal_berangkat" name="jadwal_berangkat" value="<?php echo $jadwal_berangkat; ?>">
                                        </div>
                                        <button type="submit" name="submit" class="btn btn-primary">Simpan Perubahan</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

            <?php
                }
            } else {
                echo "<p>Belum ada pesanan.</p>";
            }
            ?>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>