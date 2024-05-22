<?php
require_once "config.php";

function prosesPemesanan($conn)
{
    // Periksa apakah ada data yang dikirim dari formulir pemesanan
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Ambil data yang dikirim dari formulir
        $username = $_SESSION['sesi'];
        $nama_lengkap = $_POST['nama_lengkap'];
        $nomor_identitas = $_POST['nomor_identitas'];
        $nomor_hp = $_POST['nomor_hp'];
        $pilihan_tiket = $_POST['pilihan_tiket'];
        $jadwal_berangkat = $_POST['jadwal_berangkat'];

        // Siapkan statement SQL untuk menyimpan data pesanan ke dalam tabel
        $sql = "INSERT INTO pesanan (username, nama_lengkap, nomor_identitas, nomor_hp, pilihan_tiket, jadwal_berangkat)
            VALUES ('$username', '$nama_lengkap', '$nomor_identitas', '$nomor_hp', '$pilihan_tiket', '$jadwal_berangkat')";

        // Jalankan statement SQL
        if ($conn->query($sql) === TRUE) {
            // Jika penyimpanan berhasil, arahkan pengguna ke halaman sukses
            header("Location: ./history.php");
            exit();
        } else {
            // Jika terjadi kesalahan, tampilkan pesan kesalahan
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

function prosesPerubahanPesanan($conn)
{
    // Periksa apakah ada data yang dikirim dari formulir perubahan pesanan
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Ambil data yang dikirim dari formulir
        $id_pesanan = $_POST['id_pesanan'];
        $nama_lengkap = $_POST['nama_lengkap'];
        $nomor_identitas = $_POST['nomor_identitas'];
        $nomor_hp = $_POST['nomor_hp'];
        $pilihan_tiket = $_POST['pilihan_tiket'];
        $jadwal_berangkat = $_POST['jadwal_berangkat'];

        // Siapkan statement SQL untuk memperbarui data pesanan dalam tabel
        $sql = "UPDATE pesanan 
                SET nama_lengkap = '$nama_lengkap', 
                    nomor_identitas = '$nomor_identitas', 
                    nomor_hp = '$nomor_hp', 
                    pilihan_tiket = '$pilihan_tiket', 
                    jadwal_berangkat = '$jadwal_berangkat' 
                WHERE id = '$id_pesanan'";

        // Jalankan statement SQL
        if ($conn->query($sql) === TRUE) {
            // Jika perubahan berhasil, arahkan pengguna kembali ke halaman history
            header("Location: ../history.php");
            exit();
        } else {
            // Jika terjadi kesalahan, tampilkan pesan kesalahan
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
