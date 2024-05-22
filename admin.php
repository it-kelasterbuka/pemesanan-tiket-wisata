<?php
session_start();
require_once "./function/user.php";
require_once "./function/config.php";

// Periksa apakah pengguna sudah login dan memiliki roles_id = 2 (admin)
if (!isset($_SESSION['sesi']) || $_SESSION['roles_id'] != 2) {
    // Jika belum login atau bukan pengguna biasa, redirect ke halaman login.php
    header("Location: login.php");
    exit();
}

// Proses jika admin mengubah status pesanan
if (isset($_POST['submit'])) {
    $id_pesanan = $_POST['id_pesanan'];

    // Query SQL untuk mengubah status pesanan menjadi "diterima"
    $sql = "UPDATE pesanan SET status = 'diterima' WHERE id = '$id_pesanan'";

    // Jalankan query SQL
    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("Status pesanan berhasil diubah.");</script>';
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Query SQL untuk mengambil daftar pesanan dalam antrian
$sqlAntrian = "SELECT * FROM pesanan WHERE status = 'dalam antrian'";
$resultAntrian = $conn->query($sqlAntrian);

// Query SQL untuk mendapatkan daftar pesanan yang sudah diterima
$sqlDiterima = "SELECT * FROM pesanan WHERE status = 'Diterima'";
$resultDiterima = $conn->query($sqlDiterima);

// Logout
if (isset($_GET['logout.php'])) {
    // Hapus semua data sesi
    session_destroy();

    // Redirect ke halaman login setelah logout
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Kelola Pesanan</title>
    <!-- Bootstrap CSS dari CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- jQuery CSS dan DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">

    <style>
        .footer {
            text-align: center;
            background-color: #343a40;
            /* Warna latar belakang footer */
            color: white;
            /* Warna teks footer */
            padding: 20px 0;
            /* Sesuaikan padding sesuai kebutuhan */
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Admin Panel</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="admin.php">Daftar Antrian</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin.php?view=diterima">Pesanan Diterima</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section>
        <div class="container">
            <?php
            // Tampilkan judul berdasarkan tautan yang dipilih
            if (isset($_GET['view']) && $_GET['view'] === 'diterima') {
                echo "<h1 class='mt-5 mb-4'>Daftar Pesanan yang Sudah Diterima</h1>";
                $result = $resultDiterima;
            } else {
                echo "<h1 class='mt-5 mb-4'>Daftar Pesanan dalam Antrian</h1>";
                $result = $resultAntrian;
            }
            ?>
            <div class="table-responsive">
                <table id="pesananTable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ID Pesanan</th>
                            <th>Username</th>
                            <th>Nama Lengkap</th>
                            <th>Nomor Identitas</th>
                            <th>Nomor HP</th>
                            <th>Pilihan Tiket</th>
                            <th>Jadwal Berangkat</th>
                            <th>Status</th>
                            <?php if (!isset($_GET['view']) || $_GET['view'] !== 'diterima') : ?>
                                <th>Action</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()) : ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['username']; ?></td>
                                <td><?php echo $row['nama_lengkap']; ?></td>
                                <td><?php echo $row['nomor_identitas']; ?></td>
                                <td><?php echo $row['nomor_hp']; ?></td>
                                <td><?php echo $row['pilihan_tiket']; ?></td>
                                <td><?php echo $row['jadwal_berangkat']; ?></td>
                                <td><?php echo $row['status']; ?></td>
                                <?php if (!isset($_GET['view']) || $_GET['view'] !== 'diterima') : ?>
                                    <td>
                                        <form action="" method="post">
                                            <input type="hidden" name="id_pesanan" value="<?php echo $row['id']; ?>">
                                            <button type="submit" name="submit" class="btn btn-success btn-sm">Terima Pesanan</button>
                                        </form>
                                    </td>
                                <?php endif; ?>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="container">
            <span>&copy;AhmadBedul | 2024</span>
        </div>
    </footer>

    <!-- Bootstrap JS dari CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- jQuery dan DataTables JS dari CDN -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#pesananTable').DataTable({
                "searching": true // Aktifkan fitur pencarian global
            });
        });
    </script>
</body>

</html>