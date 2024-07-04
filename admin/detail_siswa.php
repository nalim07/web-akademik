<?php

require_once '../koneksi.php';
session_start();
//sesi ketika login
if (!isset($_SESSION["sslogin"])) {
    header("location: ../auth/login.php");
    exit;
}

$title = "Detail Siswa";
require_once 'template_admin/header.php';
require_once 'template_admin/navbar.php';

// Mendapatkan ID siswa dari URL
$id_siswa = $_GET['id_siswa'];

// Query untuk mengambil detail siswa berdasarkan ID
$query = "SELECT * FROM siswa_kelasa WHERE id = '$id_siswa';";
$sql = mysqli_query($conn, $query);
$siswa = mysqli_fetch_assoc($sql);

?>

<!-- Menampilkan detail siswa -->
<div class="container mt-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="dashboard.php">Beranda</a></li>
            <li class="breadcrumb-item"><a href="data_siswa.php">Daftar Siswa</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail Siswa</li>
        </ol>
    </nav>
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h2 class="mb-0">Detail Siswa</h2>
        </div>
        <div class="card-body" style="font-size: 1rem;">
            <div class="row">
                <div class="text-center">
                    <img src="<?php echo $siswa['foto_siswa']; ?>" class="img-fluid rounded" alt="Foto Siswa">
                </div>
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="nama_siswa">Nama:</label>
                            <input type="text" class="form-control" id="nama_siswa" value="<?php echo $siswa['nama_siswa']; ?>" disabled>
                        </div>
                        <div class="col-md-6">
                            <label for="nis">NIS:</label>
                            <input type="text" class="form-control" id="nis" value="<?php echo $siswa['nis']; ?>" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="kelas">Kelas:</label>
                        <input type="text" class="form-control" id="kelas" value="<?php echo $siswa['kelas']; ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_masuk">Tanggal Masuk:</label>
                        <input type="text" class="form-control" id="tanggal_masuk" value="<?php echo $siswa['tanggal_masuk']; ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="tempat_lahir">Tempat Lahir:</label>
                        <input type="text" class="form-control" id="tempat_lahir" value="<?php echo $siswa['tempat_lahir']; ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_lahir">Tanggal Lahir:</label>
                        <input type="text" class="form-control" id="tanggal_lahir" value="<?php echo $siswa['tanggal_lahir']; ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="jenis_kelamin">Jenis Kelamin:</label>
                        <input type="text" class="form-control" id="jenis_kelamin" value="<?php echo $siswa['jenis_kelamin']; ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="agama">Agama:</label>
                        <input type="text" class="form-control" id="agama" value="<?php echo $siswa['agama']; ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat:</label>
                        <input type="text" class="form-control" id="alamat" value="<?php echo $siswa['alamat']; ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="desa_kelurahan">Desa/Kelurahan:</label>
                        <input type="text" class="form-control" id="desa_kelurahan" value="<?php echo $siswa['desa_kelurahan']; ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="kecamatan">Kecamatan:</label>
                        <input type="text" class="form-control" id="kecamatan" value="<?php echo $siswa['kecamatan']; ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="kab_kota">Kab/Kota:</label>
                        <input type="text" class="form-control" id="kab_kota" value="<?php echo $siswa['kab_kota']; ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="provinsi">Provinsi:</label>
                        <input type="text" class="form-control" id="provinsi" value="<?php echo $siswa['provinsi']; ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="wali_siswa">Wali Siswa:</label>
                        <input type="text" class="form-control" id="wali_siswa" value="<?php echo $siswa['wali_siswa']; ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="no_hp_wali">No. Handphone Wali Siswa:</label>
                        <input type="text" class="form-control" id="no_hp_wali" value="<?php echo $siswa['no_hp_wali']; ?>" disabled>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
require_once 'template_admin/footer.php';
?>