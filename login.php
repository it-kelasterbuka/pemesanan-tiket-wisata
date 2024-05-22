<?php
require_once "./function/config.php";
require_once "./function/user.php";

session_start(); // Mulai sesi di awal

// Memeriksa apakah form telah dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Periksa apakah kedua bidang username dan password telah diisi
    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        // Panggil fungsi loginUser dengan menyertakan koneksi database
        $loginResult = loginUser($conn, $_POST['username'], $_POST['password']);
        if ($loginResult !== true) {
            // Jika login gagal, tampilkan pesan kesalahan
            $error_message = $loginResult;
        }
    } else {
        // Jika salah satu atau kedua bidang kosong, tampilkan pesan kesalahan
        $error_message = "Username dan password harus diisi!";
    }
}

// Periksa apakah pengguna sudah login
if (isset($_SESSION['sesi'])) {
    // Redirect ke halaman yang sesuai berdasarkan roles_id
    if ($_SESSION['roles_id'] == 1) {
        header("Location: home.php");
        exit();
    } elseif ($_SESSION['roles_id'] == 2) {
        header("Location: admin.php");
        exit();
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PROJECT | PWL</title>
    <!-- Bootstrap Icons CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-color: #f5f5f5;
        }

        .card {
            width: 100%;
            max-width: 400px;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .form-signin .form-floating:focus-within {
            z-index: 2;
        }

        .form-signin input[type="text"],
        .form-signin input[type="password"] {
            direction: ltr;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
            margin-bottom: 15px;
        }

        .form-signin input[type="text"]:focus,
        .form-signin input[type="password"]:focus {
            z-index: 3;
        }

        /* Custom button style */
        .button-29 {
            align-items: center;
            appearance: none;
            background-image: radial-gradient(100% 100% at 100% 0, #5adaff 0, #5468ff 100%);
            border: 0;
            border-radius: 6px;
            box-shadow: rgba(45, 35, 66, .4) 0 2px 4px, rgba(45, 35, 66, .3) 0 7px 13px -3px, rgba(58, 65, 111, .5) 0 -3px 0 inset;
            box-sizing: border-box;
            color: #fff;
            cursor: pointer;
            display: inline-flex;
            font-family: "JetBrains Mono", monospace;
            height: 48px;
            justify-content: center;
            line-height: 1;
            list-style: none;
            overflow: hidden;
            padding-left: 16px;
            padding-right: 16px;
            position: relative;
            text-align: left;
            text-decoration: none;
            transition: box-shadow .15s, transform .15s;
            user-select: none;
            -webkit-user-select: none;
            touch-action: manipulation;
            white-space: nowrap;
            will-change: box-shadow, transform;
            font-size: 18px;
            margin-bottom: 15px;
            /* Tambahkan jarak antara tombol dan field */
        }

        .button-29:focus {
            box-shadow: #3c4fe0 0 0 0 1.5px inset, rgba(45, 35, 66, .4) 0 2px 4px, rgba(45, 35, 66, .3) 0 7px 13px -3px, #3c4fe0 0 -3px 0 inset;
        }

        .button-29:hover {
            box-shadow: rgba(45, 35, 66, .4) 0 4px 8px, rgba(45, 35, 66, .3) 0 7px 13px -3px, #3c4fe0 0 -3px 0 inset;
            transform: translateY(-2px);
        }

        .button-29:active {
            box-shadow: #3c4fe0 0 3px 7px inset;
            transform: translateY(2px);
        }

        .small {
            font-size: 2.5rem;
        }

        .rise {
            text-shadow: -0.01em -0.01em 0.01em #000;
            animation: rise 1.5s ease-in-out 0.5s forwards;
        }

        @keyframes rise {
            to {
                text-shadow: 0em 0.01em #ff5, 0em 0.02em #ff5, 0em 0.02em 0.03em #ff5,
                    -0.01em 0.01em #333, -0.02em 0.02em #333, -0.03em 0.03em #333,
                    -0.04em 0.04em #333, -0.01em -0.01em 0.03em #000, -0.02em -0.02em 0.03em #000,
                    -0.03em -0.03em 0.03em #000;
                transform: translateY(-0.025em) translateX(0.04em);
            }
        }

        .outline {
            background-clip: text;
            color: #ffdd40;
            animation: outline 1s ease-in-out 1.5s forwards;
        }

        @keyframes outline {
            from {
                text-shadow: 0em -7em 10em #fff;
            }

            to {
                text-shadow: 0 0.02em #fff, 0.02em 0 #fff, -0.02em 0 #fff, 0 -0.02em #fff;
            }
        }

        .back-icon {
            position: absolute;
            top: 10px;
            left: 10px;
            font-size: 2rem;
            cursor: pointer;
            color: black;
        }

        .back-icon:hover {
            color: #343a40;
        }

        /* Responsive Mobile */
        @media(max-width: 576px) {
            .card {
                max-width: 90%;
                margin: 0 auto;
                margin-top: 15%;
            }
        }

        /* Responsive Desktop */
        @media(min-width: 720px) and (max-width: 1024px) {
            .card {
                max-width: 50%;
                margin: 0 auto;
                margin-top: 20%;
            }
        }
    </style>
</head>

<body class="text-center">
    <div class="card">
        <a href="index.php" class="bi bi-arrow-left back-icon"></a>
        <!-- Error Message -->

        <form class="form-signin" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <img class="mb-2 mt-4" src="./assets/image/logo.png" alt="logo-login" width="100" height="100">
            <p class="small rise">Welcome</p>

            <?php if (isset($error_message)) : ?>
                <div class="alert alert-danger" role="alert"><?php echo $error_message; ?></div>
            <?php endif; ?>

            <div class="form-floating">
                <input type="text" class="form-control" id="floatingInput" name="username" placeholder="Username">
                <label for="floatingInput">Username</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password">
                <label for="floatingPassword">Password</label>
            </div>

            <button class="w-100 btn btn-lg button-29" type="submit">Sign in</button>
            <p class="mt-3 mb-3 text-muted">&copy;AhmadBedul | 2024</p>
        </form>

    </div>
</body>

</html>