<?php

require_once '../koneksi.php';
session_start();

if (!isset($_SESSION["sslogin"])) {
    header("location: ../auth/login.php");
    exit;
}

$title = "Dashboard - Admin";
require_once 'template_admin/header.php';
require_once 'template_admin/navbar.php';

// Query untuk mendapatkan jumlah siswa
$sql_siswa = "SELECT COUNT(*) as jumlah_siswa FROM tbl_siswa";
$result_siswa = $conn->query($sql_siswa);
$data_siswa = $result_siswa->fetch_assoc();
$jumlah_siswa = $data_siswa['jumlah_siswa'];

// Query untuk mendapatkan jumlah guru
$sql_guru = "SELECT COUNT(*) as jumlah_guru FROM tbl_guru";
$result_guru = $conn->query($sql_guru);
$data_guru = $result_guru->fetch_assoc();
$jumlah_guru = $data_guru['jumlah_guru'];

?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="alert alert-primary" role="alert"><i class="fas fa-fw fa-tachometer-alt"></i><b> Dashboard</b></div>

    <!-- Content Row -->
    <div class="row">

        <div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Selamat Datang!</h4>
            <p>Selamat Datang di Sistem Informasi Akademik TK Aisyiyah Bustanul Athfal Labuan, Anda Login Sebagai <b><?= $_SESSION["ssUser"] ?></b></p>
        </div>

        <div class="row">
        </div>
    </div>

<div class="row">
    <!-- Jumlah Siswa Card -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Jumlah Siswa</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah_siswa ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user-graduate fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Jumlah Guru Card -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Jumlah Guru</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah_guru ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-chalkboard-teacher fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->



<?php
require_once 'template_admin/footer.php';

?>