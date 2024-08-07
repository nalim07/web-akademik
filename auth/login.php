<?php
require_once '../koneksi.php';
session_start();

if (isset($_SESSION["sslogin"])) {
    header("location: ../admin/dashboard.php");
    exit;
}


//proses login
if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = md5($_POST["password"]); // Hash password dengan MD5

    $sql = "SELECT * FROM user WHERE 
    username = '$username' AND password = '$password'";

    $result = $conn->query($sql);

    //cek username
    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        $_SESSION["ssUser"] = $username;
        $_SESSION["sslogin"] = true;
        header("location: ../admin/dashboard.php");
    } else {
        echo "<script>alert('Username atau password salah. Silakan coba lagi.'); window.location.href = 'login.php';</script>";
    }
    $conn->close();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin - Login</title>

    <!-- Custom fonts for this template-->
    <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../assets/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- ikon -->
    <link rel="shortcut icon" href="../assets/img/logo-tk.png" type="image/png">

</head>

<body class="bg-gradient-primary">

    <div class="container"><br><br><br>

        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-6 col-md-5">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Selamat Datang</h1>
                                    </div>
                                    <form class="user" method="post" action="">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" id="username" name="username" placeholder="Masukan Username" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" id="exampleInputPassword" name="password" placeholder="Masukkan Kata Sandi" required>
                                        </div>
                                        <!-- Tombol Masuk -->
                                        <button type="submit" name="login" class="btn btn-primary btn-user btn-block">Masuk</button>
                                        <div class="text-center mt-3">
                                            <a class="btn btn-secondary btn-user btn-block" href="../index.php">Kembali ke Beranda</a>
                                        </div>
                                        <hr>
                                    </form>
                                    <div class="text-center">
                                        <a class="small" href="forgot-password.html">Lupa Kata Sandi?</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../assets/vendor/jquery/jquery.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../assets/js/sb-admin-2.min.js"></script>

</body>

</html>

</html>