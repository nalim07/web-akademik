<?php
include '../koneksi.php';
session_start();
//sesi ketika login
if (!isset($_SESSION["sslogin"])) {
    header("location: ../auth/login.php");
    exit;
}

$title = "Nilai Siswa";
require_once 'template_admin/header.php';
require_once 'template_admin/navbar.php';


// $id_siswa = $_GET['id'];

// $query = mysqli_query($conn, "SELECT * FROM tbl_nilai WHERE id_siswa='$id_siswa'");
// $data = mysqli_fetch_array($query);

?>

<div class="container-fluid">
    <!-- Page Heading -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Laporan Perkembangan Anak</li>
        </ol>
    </nav>
    <!-- Daftar Menu Laporan Perkembangan Anak -->
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="mt-2 font-weight-bold text-primary text-start"><i class="bi bi-graph-up"></i> Perkembangan & Pengetahuan</h6>
                </div>
                <div class="card-body">
                    <a href="input_perkembangan.php" class="btn btn-primary"><i class="bi bi-pencil-square"></i> Masukan Nilai</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="mt-2 font-weight-bold text-primary text-start">Coming Soon</h6>
                </div>
                <!-- <div class="card-body">
                    <a href="#" class="btn btn-primary">x</a>
                </div> -->
            </div>
        </div>
    </div>
</div>


<?php
require_once 'template_admin/footer.php';
?>