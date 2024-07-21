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
$query = "SELECT * FROM tbl_siswa WHERE id = '$id_siswa';";
$sql = mysqli_query($conn, $query);
$siswa = mysqli_fetch_assoc($sql);

?>

<!-- Menampilkan detail siswa -->
<div class="container mt-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="dashboard.php">Beranda</a></li>
            <li class="breadcrumb-item"><a href="data_siswa.php">List Data Siswa</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail Siswa</li>
        </ol>
    </nav>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4">
                <div class="card shadow mb-5 card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <?php
                            $foto_path = "../uploads/" . $siswa['foto_siswa'];
                            if (!empty($siswa['foto_siswa']) && file_exists($foto_path)) {
                                $foto_url = $foto_path;
                            } else {
                                $foto_url = "../assets/img/profil_default.png";
                            }
                            ?>
                            <img class="mb-3" src="<?= $foto_url; ?>" alt="pas_foto" width="105px">
                            <form action="upload_foto.php" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="id_siswa" value="<?= $siswa['id']; ?>">
                                <div class="form-group">
                                    <input type="file" name="foto_siswa" class="form-control-file" accept="image/*">
                                </div>
                                <button type="submit" class="btn btn-primary btn-sm my-2">Unggah Foto</button>
                            </form>
                        </div>
                        <div class="row mb-2">
                            <div class="col-12">
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label col-form-label-sm"><b>Nama</b></label>
                                    <div class="col-sm-8">
                                        <span class="form-control-plaintext" style="color: #000000;"><?= $siswa['nama_siswa']; ?></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label col-form-label-sm"><b>NIS</b></label>
                                    <div class="col-sm-8">
                                        <span class="form-control-plaintext" style="color: #000000;"><?= $siswa['nis']; ?></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label col-form-label-sm"><b>Kelas</b></label>
                                    <div class="col-sm-8">
                                        <span class="form-control-plaintext" style="color: #000000;"><?= $siswa['kelas']; ?></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label col-form-label-sm"><b>Tanggal Masuk</b></label>
                                    <div class="col-sm-8">
                                        <span class="form-control-plaintext" style="color: #000000;"><?= $siswa['tanggal_masuk']; ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card shadow mb-5">
                    <div class="card-header">
                        <h3 class="mt-2 font-weight-bold text-primary text-start">Data Pribadi</h3>
                        <div class="card-tools">
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <a href="data_siswa.php" class="btn btn-success btn-sm">Kembali</a>
                                    <a href="edit_siswa.php?id=<?= $siswa['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-pills bg-nav-pills nav-justified mb-3">
                            <li class="nav-item">
                                <a href="#student1" data-toggle="tab" aria-expanded="false" class="nav-link rounded-0 active">
                                    <i class="mdi mdi-home-variant d-lg-none d-block me-1"></i>
                                    <span class="d-block">Siswa</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#orangtua" data-toggle="tab" aria-expanded="true" class="nav-link rounded-0">
                                    <i class="mdi mdi-account-circle d-lg-none d-block me-1"></i>
                                    <span class="d-block">Orang Tua</span>
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="student1">
                                <div class="border-bottom p-2">
                                    <h6 class="my-3"><b>A. Data Pribadi Siswa</b></h6>
                                    <div class="form-group">
                                        <label for="nama_siswa">Nama Lengkap:</label>
                                        <input type="text" class="form-control" id="nama_siswa" value="<?= $siswa['nama_siswa']; ?>" disabled>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="tempat_lahir">Tempat Lahir:</label>
                                            <input type="text" class="form-control" id="tempat_lahir" value="<?= $siswa['tempat_lahir']; ?>" disabled>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="tanggal_lahir">Tanggal Lahir:</label>
                                            <input type="text" class="form-control" id="tanggal_lahir" value="<?= $siswa['tanggal_lahir']; ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-6">
                                            <label for="jenis_kelamin">Jenis Kelamin:</label>
                                            <input type="text" class="form-control" id="jenis_kelamin" value="<?= ($siswa['jenis_kelamin'] == 'L') ? 'Laki-laki' : (($siswa['jenis_kelamin'] == 'P') ? 'Perempuan' : $siswa['jenis_kelamin']); ?>" disabled>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="kecamatan">Kecamatan:</label>
                                            <input type="text" class="form-control" id="kecamatan" value="<?= $siswa['kecamatan']; ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-6">
                                            <label for="agama">Agama:</label>
                                            <input type="text" class="form-control" id="agama" value="<?= $siswa['agama']; ?>" disabled>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="kab_kota">Kab/Kota:</label>
                                            <input type="text" class="form-control" id="kab_kota" value="<?= $siswa['kab_kota']; ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-6">
                                            <label for="alamat">Alamat:</label>
                                            <input type="text" class="form-control" id="alamat" value="<?= $siswa['alamat']; ?>" disabled>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="provinsi">Provinsi:</label>
                                            <input type="text" class="form-control" id="provinsi" value="<?= $siswa['provinsi']; ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="row my-3">
                                        <div class="col-md-6">
                                            <label for="desa_kelurahan">Desa/Kelurahan:</label>
                                            <input type="text" class="form-control" id="desa_kelurahan" value="<?= $siswa['desa_kelurahan']; ?>" disabled>
                                        </div>
                                    </div>
                                    <hr>
                                    <h6 class="my-3"><b>B. Wali Siswa</b></h6>
                                    <div class="form-group">
                                        <label for="wali_siswa">Nama Wali Siswa:</label>
                                        <input type="text" class="form-control" id="wali_siswa" value="<?= $siswa['wali_siswa']; ?>" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="no_hp_wali">No HP Wali:</label>
                                        <input type="text" class="form-control" id="no_hp_wali" value="<?= $siswa['no_hp_wali']; ?>" disabled>
                                    </div>
                                </div>
                            </div>
                            <!-- Data Orang Tua -->
                            <div class="tab-pane" id="orangtua">
                                <div class="border-bottom p-2">
                                    <h6 class="my-3"><b>A. Data Ayah</b></h6>
                                    <div class="form-group">
                                        <label for="nama_ayah">Nama Ayah:</label>
                                        <input type="text" class="form-control" id="nama_ayah" value="<?= $siswa['nama_ayah']; ?>" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="alamat_ayah">Alamat:</label>
                                        <input type="text" class="form-control" id="alamat_ayah" value="<?= $siswa['alamat_ayah']; ?>" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="no_hp_ayah">No Handphone:</label>
                                        <input type="text" class="form-control" id="no_hp_ayah" value="<?= $siswa['no_hp_ayah']; ?>" disabled>
                                    </div>
                                    <hr>
                                    <h6 class="my-3"><b>B. Data Ibu</b></h6>
                                    <div class="form-group">
                                        <label for="nama_ibu">Nama Ibu:</label>
                                        <input type="text" class="form-control" id="nama_ibu" value="<?= $siswa['nama_ibu']; ?>" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="alamat_ibu">Alamat:</label>
                                        <input type="text" class="form-control" id="alamat_ibu" value="<?= $siswa['alamat_ibu']; ?>" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="no_hp_ibu">No Handphone:</label>
                                        <input type="text" class="form-control" id="no_hp_ibu" value="<?= $siswa['no_hp_ibu']; ?>" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>


<?php
require_once 'template_admin/footer.php';
?>