<?php
// Konfigurasi koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_pwl";
// $servername = "sql313.infinityfree.com"; // Ganti dengan nama server Anda
// $username = "if0_36369470"; // Ganti dengan nama pengguna database Anda
// $password = "ItKelasTerbuka"; // Ganti dengan kata sandi database Anda
// $dbname = "if0_36369470_pwl"; // Ganti dengan nama database Anda

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
