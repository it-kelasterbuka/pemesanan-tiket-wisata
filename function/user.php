<?php
// function registerUser($conn, $username, $password, $confirmpass)
// {
//     // Validasi konfirmasi password
//     if ($password !== $confirmpass) {
//         return "Konfirmasi password tidak cocok!";
//     }

//     // Escape input pengguna untuk mencegah SQL Injection
//     $username = $conn->real_escape_string($username);
//     $password = $conn->real_escape_string($password);
//     $confirmpass = $conn->real_escape_string($confirmpass);

//     // Buat query untuk menambahkan pengguna baru ke database
//     $sql = "INSERT INTO users (username, password, confirmpass) VALUES ('$username', '$password', '$confirmpass')";

//     // Eksekusi query
//     if ($conn->query($sql) === TRUE) {
//         return true; // Registrasi berhasil
//     } else {
//         return "Error: " . $sql . "<br>" . $conn->error;
//     }
// }
function registerUser($conn, $username, $password, $confirmpass)
{
    // Validasi konfirmasi password
    if ($password !== $confirmpass) {
        return "Konfirmasi password tidak cocok!";
    }

    // Escape input pengguna untuk mencegah SQL Injection
    $username = $conn->real_escape_string($username);
    // Tidak perlu menggunakan real_escape_string() untuk password dan confirmpass karena kita akan melakukan hash pada password

    // Hash password menggunakan algoritma yang aman (misalnya, bcrypt)
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Gunakan prepared statement untuk mencegah SQL Injection
    $stmt = $conn->prepare("INSERT INTO users (username, password, roles_id) VALUES (?, ?, 1)");
    $stmt->bind_param("ss", $username, $hashedPassword);

    // Eksekusi prepared statement
    if ($stmt->execute()) {
        // Registrasi berhasil, arahkan ke halaman login.php
        header("Location: login.php");
        exit(); // Pastikan untuk keluar dari skrip setelah mengarahkan header
    } else {
        return "Error: " . $stmt->error;
    }
}

// function loginUser($conn, $username, $password)
// {
//     // Escape input pengguna untuk mencegah SQL Injection
//     $username = $conn->real_escape_string($username);

//     // Buat query untuk mencari pengguna dengan username yang cocok
//     $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
//     $result = $conn->query($sql);

//     // Periksa apakah pengguna ditemukan
//     if ($result->num_rows == 1) {
//         return true; // Login berhasil
//     } else {
//         return "Username atau password salah!";
//     }
// }

function loginUser($conn, $username, $password)
{
    // Escape input pengguna untuk mencegah SQL Injection
    $username = $conn->real_escape_string($username);

    // Buat query untuk mencari pengguna dengan username yang cocok
    $sql = "SELECT id, password, roles_id FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    // Periksa apakah pengguna ditemukan
    if ($result && $result->num_rows == 1) {
        // Ambil data pengguna dari hasil query
        $row = $result->fetch_assoc();

        // Verifikasi password
        if (password_verify($password, $row['password'])) {
            // Login berhasil
            session_start(); // Mulai sesi

            // Simpan informasi pengguna ke dalam session
            $_SESSION['sesi'] = true;
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $username;
            $_SESSION['roles_id'] = $row['roles_id'];

            // Periksa roles_id untuk menentukan halaman tujuan
            if ($row['roles_id'] == 1) {
                // Jika roles_id adalah 1, arahkan ke halaman home.php
                header("Location: ./home.php");
                exit(); // Pastikan untuk keluar dari skrip setelah mengarahkan header
            } elseif ($row['roles_id'] == 2) {
                // Jika roles_id adalah 2, arahkan ke halaman admin.php
                header("Location: ./admin.php");
                exit(); // Pastikan untuk keluar dari skrip setelah mengarahkan header
            }
        } else {
            return "Password salah!";
        }
    } else {
        return "Username tidak ditemukan!";
    }
}


function getUserRolesID($conn, $username)
{
    // Escape input pengguna untuk mencegah SQL Injection
    $username = $conn->real_escape_string($username);

    // Buat query untuk mengambil roles_id berdasarkan username
    $sql = "SELECT roles_id FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    // Periksa apakah pengguna ditemukan
    if ($result && $result->num_rows == 1) {
        // Ambil roles_id dari hasil query
        $row = $result->fetch_assoc();
        return $row['roles_id'];
    } else {
        // Jika username tidak ditemukan atau terdapat kesalahan lain, kembalikan false
        return false;
    }
}

function logoutUser()
{
    // Mulai atau lanjutkan sesi
    session_start();

    // Hapus semua data sesi
    $_SESSION = array();

    // Hapus cookie sesi jika ada
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(
            session_name(),
            '',
            time() - 42000,
            $params["path"],
            $params["domain"],
            $params["secure"],
            $params["httponly"]
        );
    }

    // Hancurkan sesi
    session_destroy();

    // Redirect ke halaman login atau halaman lain yang sesuai
    header("Location: login.php");
    exit();
}
