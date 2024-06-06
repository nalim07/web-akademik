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

?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="alert alert-primary" role="alert"><i class="fas fa-fw fa-tachometer-alt"></i><b>Dashboard</b></div>

    <!-- Content Row -->
    <div class="row">

        <div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Selamat Datang!</h4>
            <p>Selamat Datang di Sistem Informasi Akademik TK Aisyiyah Bustanul Athfal Labuan, Anda Login Sebagai <b><?= $_SESSION["ssUser"] ?></b></p>
        </div>



        <div class="row">
        </div>
    </div>
    

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->



<?php
require_once 'template_admin/footer.php';

?>