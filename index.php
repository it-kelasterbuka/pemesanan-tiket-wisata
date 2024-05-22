<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#212529" />
    <meta name="color-scheme" content="dark" />
    <meta property="og:title" content="Pemesanan Tiket" />
    <meta property="og:description" content="Website Pemesanan Tiket Wisata" />
    <meta property="og:image" content="https://ahmadrandi06.000webhostapp.com/icon.png" />
    <title>PROJECT | PWL</title>

    <!-- favicons -->
    <link rel="icon" type="image/png" href="./assets/image/logo.png" sizes="32x32" />
    <link rel="apple-touch-icon" type="image/png" href="images/icon.png" sizes="120x120" />
    <title>Project | PWL</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            background-image: url('./assets/image/image-landing-page.jpg');
            /* Ganti dengan URL gambar latar belakang */
            background-size: cover;
            background-position: center;
            height: 100vh;
            /* Menyebabkan latar belakang menutupi seluruh halaman */
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Navbar dengan Transparansi */
        .navbar {
            background-color: rgba(255, 255, 255, 0.5);
            /* ubah nilai transparansi di sini */
        }

        /* Navbar Menu */
        .navbar-nav .nav-link {
            margin-right: 15px;
            /* Sesuaikan jarak sesuai keinginan */
            color: black;
            /* Ubah warna teks menjadi hitam */
        }

        /* Media Query untuk Mode Ponsel */
        @media (max-width: 768px) {
            .navbar-nav {
                margin-top: 30px;
                text-align: center;
                /* Atur margin atas pada daftar menu saat mode ponsel */
            }

            /* Menu Drawer */
            .navbar-collapse {
                z-index: -3;
                background-color: rgba(255, 255, 255, 0.8);
                position: fixed;
                top: 0;
                right: -100%;
                /* Geser menu ke kanan sejauh 100% dari lebar layar */
                width: 80%;
                transition: right 0.3s ease;
                /* Tambahkan transisi agar perubahan terlihat mulus */
            }

            li {
                margin-top: 30px;
            }

            .navbar-collapse.show {
                right: 0;
                width: 70%;
                height: 100%;
                /* Geser menu ke kiri sehingga muncul dari kanan */
            }

            .navbar-nav {
                flex-direction: column;
                padding-top: 50px;
                padding-right: 20px;
            }

            .navbar-nav .nav-link {
                margin-right: 0;
            }

            .navbar-toggler {
                margin: 10px;
                position: absolute;
                top: 0;
                right: 0;
            }

            .jumbotron {
                width: 100%;
                height: 100vh;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
            }

            h1 {
                font-size: 45px;
                text-transform: uppercase;
                font-family: 'Gambetta', serif;
                letter-spacing: -3px;
                transition: 700ms ease;
                font-variation-settings: "wght" 311;
                margin-bottom: 0.8rem;
                color: blue;
                outline: none;
                text-align: center;
            }

            h1:hover {
                font-variation-settings: "wght" 582;
                letter-spacing: 1px;
            }

            p {
                font-size: 1.2em;
                line-height: 150%;
                text-align: center;
                color: black;
                letter-spacing: .5px;
            }
        }

        /* Media Query untuk Mode Desktop */
        @media (min-width: 768px) {
            .navbar-collapse {
                display: block !important;
                right: 0 !important;
                width: auto !important;
                height: auto !important;
                position: relative !important;
                transition: none !important;
            }

            .navbar-nav {
                margin-left: auto;
                /* Menu navbar sejajar dengan navbar lainnya */
            }

            .navbar-brand img {
                margin-right: 15px;
                /* Atur jarak antara logo dan menu */
            }

            .navbar-brand .title {
                margin-left: 10px;
                font-size: 1.2rem;
                font-weight: bold;
            }

            /* Mengubah warna latar belakang menu saat disentuh */
            .navbar-nav .nav-link:hover {
                /* background-color: rgba(0, 255, 0, 0.1); */
                border-bottom: 3px solid rgb(16, 207, 16);
                transition: all .3s ease;
            }

            /* Jumbotron */
            .jumbotron {
                width: 100%;
                height: 100vh;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
            }

            h1 {
                font-size: 100px;
                text-transform: uppercase;
                font-family: 'Gambetta', serif;
                letter-spacing: -3px;
                transition: 700ms ease;
                font-variation-settings: "wght" 311;
                margin-bottom: 0.8rem;
                color: blue;
                outline: none;
                text-align: center;
            }

            h1:hover {
                font-variation-settings: "wght" 582;
                letter-spacing: 1px;
            }

            p {
                font-size: 1.2em;
                line-height: 150%;
                text-align: center;
                color: white;
                letter-spacing: .5px;
                font-weight: 600;
            }
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand" href="#">
                <img src="./assets/image/logo.png" alt="Logo" height="30">
                <span class="title">Pemesanan Tiket Wisata</span>
            </a>
            <!-- Toggler Button -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Navbar Menu -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="registrasi.php">Registrasi</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Jumbotron -->
    <div class="jumbotron">
        <h1 contenteditable>Tiket Wisata</h1>
        <p>Menerima pemesanan tiket wisata kota padang</p>
    </div>

    <!-- Your content here -->

    <!-- Bootstrap JS (required) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>