<?php
require_once '../koneksi.php';
session_start();

if (!isset($_SESSION["sslogin"])) {
    header("location: ../auth/login.php");
    exit;
}

$title = "Tambah Guru";
require_once 'template_admin/header.php';
require_once 'template_admin/navbar.php';

?>

<div class="container-fluid">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
            <li class="breadcrumb-item"><a href="data_guru.php">Data Guru</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah Data</li>
        </ol>
    </nav>
    <!-- End Breadcrumb -->

    <!-- Tambah Guru -->
    <div class="card shadow mb-5">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tambah Guru</h6>
        </div>
        <div class="card-body">
            <form action="proses_tambah_guru.php" method="POST" enctype="multipart/form-data">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6" style="margin-top: 10px;">
                            <label for="nama_guru" class="form-label">Nama Guru</label>
                            <input type="text" class="form-control" id="nama_guru" name="nama_guru" required>
                        </div>
                        <div class="col-md-6 ms-auto" style="margin-top: 10px;">
                            <label for="nbm" class="form-label">NBM</label>
                            <input type="text" class="form-control" id="nbm" name="nbm" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6" style="margin-top: 10px;">
                            <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                            <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" required>
                        </div>
                        <div class="col-md-6 ms-auto" style="margin-top: 10px;">
                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6" style="margin-top: 10px;">
                            <label class="form-label">Jenis Kelamin</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="jenis_kelamin" id="L" value="L" required>
                                <label class="form-check-label" for="L">
                                    Laki-Laki
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="jenis_kelamin" id="P" value="P" required>
                                <label class="form-check-label" for="P">
                                    Perempuan
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6 ms-auto" style="margin-top: 10px;">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" class="form-control" id="alamat" name="alamat" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6" style="margin-top: 10px;">
                            <label for="agama" class="form-label">Agama</label>
                            <select class="form-control" id="agama" name="agama" required>
                                <option value="">Pilih Agama</option>
                                <option value="Islam">Islam</option>
                                <option value="Kristen">Kristen</option>
                                <option value="Katolik">Katolik</option>
                                <option value="Hindu">Hindu</option>
                                <option value="Buddha">Buddha</option>
                                <option value="Konghucu">Konghucu</option>
                            </select>
                        </div>
                        <div class="col-md-6 ms-auto" style="margin-top: 10px;">
                            <label for="pendidikan_terakhir" class="form-label">Pendidikan Terakhir</label>
                            <input type="text" class="form-control" id="pendidikan_terakhir" name="pendidikan_terakhir" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6" style="margin-top: 10px;">
                                <label for="foto_guru" class="form-label">Upload Foto</label>
                                <input type="file" class="form-control" id="foto_guru" name="foto_guru">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12" style="margin-top: 20px;">
                                <button type="submit" class="btn btn-primary">Tambah Guru</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
require_once 'template_admin/footer.php';
?>