<?php

require '../koneksi.php';
require_once '../function.php';

session_start();

if (!isset($_SESSION["sslogin"])) {
    header("location: ../auth/login.php");
    exit;
}

$title = "Tambah Data";
require_once 'template_admin/header.php';
require_once 'template_admin/navbar.php';

?>

<div class="container-fluid">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
            <li class="breadcrumb-item"><a href="data_siswa.php">Data Siswa</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah Data</li>
        </ol>
    </nav>
    <!-- End Breadcrumb -->

    <!-- Tambah Siswa -->
    <div class="card shadow mb-5">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tambah Siswa</h6>
        </div>
        <div class="card-body">
            <form action="proses_tambah_siswa.php" method="POST" enctype="multipart/form-data">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="nama_siswa" class="form-label">Nama Siswa</label>
                            <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" required>
                        </div>
                        <div class="col-md-6 ms-auto">
                            <label for="nis" class="form-label">NIS</label>
                            <input type="text" class="form-control" id="nis" name="nis" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6" style="margin-top: 10px;">
                            <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                            <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" required>
                        </div>
                        <div class="col-md-6 ms-auto" style="margin-top: 10px;">
                            <label for="tanggal_masuk" class="form-label">Tanggal Masuk</label>
                            <input type="date" class="form-control" id="tanggal_masuk" name="tanggal_masuk" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6" style="margin-top: 10px;">
                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
                        </div>
                        <div class="col-md-6 ms-auto" style="margin-top: 10px;">
                            <div>
                                <label for="kelas" class="form-label">Kelas</label>
                                <select class="form-control" id="kelas" name="kelas" required>
                                    <option value="">Pilih Kelas</option>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                </select>
                            </div>
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
                        <div class="col-md-6" style="margin-top: 10px;">
                            <label for="provinsi" class="form-label">Provinsi</label>
                            <select class="form-control" id="provinsi" name="provinsi" required>
                                <option value="">Pilih Provinsi</option>
                                <option value="Aceh">Aceh</option>
                                <option value="Sumatera Utara">Sumatera Utara</option>
                                <option value="Sumatera Barat">Sumatera Barat</option>
                                <option value="Riau">Riau</option>
                                <option value="Jambi">Jambi</option>
                                <option value="Sumatera Selatan">Sumatera Selatan</option>
                                <option value="Bengkulu">Bengkulu</option>
                                <option value="Lampung">Lampung</option>
                                <option value="Kepulauan Bangka Belitung">Kepulauan Bangka Belitung</option>
                                <option value="Kepulauan Riau">Kepulauan Riau</option>
                                <option value="Jawa Barat">Jawa Barat</option>
                                <option value="Jawa Tengah">Jawa Tengah</option>
                                <option value="Jawa Timur">Jawa Timur</option>
                                <option value="Yogyakarta">Yogyakarta</option>
                                <option value="Banten">Banten</option>
                                <option value="Jakarta">Jakarta</option>
                                <option value="Jawa Barat">Jawa Barat</option>
                                <option value="Bali">Bali</option>
                                <option value="Nusa Tenggara Barat">Nusa Tenggara Barat</option>
                                <option value="Nusa Tenggara Timur">Nusa Tenggara Timur</option>
                                <option value="Kalimantan Barat">Kalimantan Barat</option>
                                <option value="Kalimantan Tengah">Kalimantan Tengah</option>
                                <option value="Kalimantan Selatan">Kalimantan Selatan</option>
                                <option value="Kalimantan Timur">Kalimantan Timur</option>
                                <option value="Kalimantan Utara">Kalimantan Utara</option>
                                <option value="Sulawesi Utara">Sulawesi Utara</option>
                                <option value="Sulawesi Tengah">Sulawesi Tengah</option>
                                <option value="Sulawesi Selatan">Sulawesi Selatan</option>
                                <option value="Sulawesi Tenggara">Sulawesi Tenggara</option>
                                <option value="Gorontalo">Gorontalo</option>
                                <option value="Sulawesi Barat">Sulawesi Barat</option>
                                <option value="Maluku">Maluku</option>
                                <option value="Maluku Utara">Maluku Utara</option>
                                <option value="Papua">Papua</option>
                                <option value="Papua Barat">Papua Barat</option>
                            </select>
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
                            <label for="kab_kota" class="form-label">Kab/Kota</label>
                            <input type="text" class="form-control" id="kab_kota" name="kab_kota" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6" style="margin-top: 10px;">
                            <label for="foto_siswa" class="form-label">Foto Siswa</label>
                            <input type="file" class="form-control" id="foto_siswa" name="foto_siswa">
                        </div>
                        <div class="col-md-6 ms-auto" style="margin-top: 10px;">
                            <label for="kecamatan" class="form-label">Kecamatan</label>
                            <input type="text" class="form-control" id="kecamatan" name="kecamatan" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6" style="margin-top: 10px;">
                            <label for="wali_siswa" class="form-label">Wali Siswa</label>
                            <input type="text" class="form-control" id="wali_siswa" name="wali_siswa" required>
                        </div>
                        <div class="col-md-6 ms-auto" style="margin-top: 10px;">
                            <label for="desa_kelurahan" class="form-label">Desa/Kelurahan</label>
                            <input type="text" class="form-control" id="desa_kelurahan" name="desa_kelurahan" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6" style="margin-top: 10px;">
                            <label for="no_hp_wali" class="form-label">No. Handphone Wali Siswa</label>
                            <input type="text" class="form-control" id="no_hp_wali" name="no_hp_wali" maxlength="13" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 13)" required>
                        </div>
                        <div class="col-md-6 ms-auto" style="margin-top: 10px;">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea class="form-control" id="alamat" name="alamat" required></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" style="margin-top: 12px;">
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
require_once 'template_admin/footer.php'
?>