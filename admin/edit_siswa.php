<?php

require_once '../koneksi.php';
session_start();

if (!isset($_SESSION["sslogin"])) {
    header("location: ../auth/login.php");
    exit;
}

$title = "Edit Data Siswa";
require_once 'template_admin/header.php';
require_once 'template_admin/navbar.php';

// Tambahkan kode berikut untuk mengambil data siswa
if (isset($_GET['id'])) {
    $id_siswa = $_GET['id'];
    $query = "SELECT * FROM tbl_siswa WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_siswa);
    $stmt->execute();
    $result = $stmt->get_result();
    $siswa = $result->fetch_assoc();

    if (!$siswa) {
        echo "<script>alert('Data siswa tidak ditemukan.'); window.location.href = 'data_siswa.php';</script>";
        exit;
    }
} else {
    echo "<script>alert('ID siswa tidak ditemukan.'); window.location.href = 'data_siswa.php';</script>";
    exit;
}

?>

<div class="container-fluid">

    <!-- Page Heading -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
            <li class="breadcrumb-item"><a href="data_siswa.php">List Data Siswa</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Data Siswa</li>
        </ol>
    </nav>
    <!-- Tabel Data Siswa -->
    <div class="card shadow mb-5">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between">
                <h6 class="mt-2 font-weight-bold text-primary text-start">Edit Data Siswa</h6>
                <a class="btn btn-outline-secondary" href="data_siswa.php" role="button" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .10rem; --bs-btn-font-size: .75rem;"><i class="bi bi-arrow-left"></i> Kembali</a>
            </div>
        </div>
        <div class="card-body">
            <form id="editSiswaForm" action="javascript:void(0);" method="POST" enctype="multipart/form-data">
                <div class="container-fluid">
                    <h6 class="my-3"><b>A. Edit Data Siswa</b></h6>
                    <div class="row">
                        <input type="hidden" name="id_siswa" value="<?php echo $id_siswa; ?>">
                        <div class="col-md-6">
                            <label for="nama_siswa" class="form-label">Nama Siswa</label>
                            <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" value="<?= $siswa['nama_siswa']; ?>" required>
                        </div>
                        <div class="col-md-6 ms-auto">
                            <label for="nis" class="form-label">NIS</label>
                            <input type="text" class="form-control" id="nis" name="nis" value="<?= $siswa['nis']; ?>" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6" style="margin-top: 10px;">
                            <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                            <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="<?= $siswa['tempat_lahir']; ?>" required>
                        </div>
                        <div class="col-md-6 ms-auto" style="margin-top: 10px;">
                            <label for="tanggal_masuk" class="form-label">Tanggal Masuk</label>
                            <input type="date" class="form-control" id="tanggal_masuk" name="tanggal_masuk" value="<?= $siswa['tanggal_masuk']; ?>" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6" style="margin-top: 10px;">
                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="<?= $siswa['tanggal_lahir']; ?>" required>
                        </div>
                        <div class="col-md-6 ms-auto" style="margin-top: 10px;">
                            <div>
                                <label for="kelas" class="form-label">Kelas</label>
                                <select class="form-control" id="kelas" name="kelas" required>
                                    <option value="">Pilih Kelas</option>
                                    <option value="A" <?= $siswa['kelas'] == 'A' ? 'selected' : ''; ?>>A</option>
                                    <option value="B" <?= $siswa['kelas'] == 'B' ? 'selected' : ''; ?>>B</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6" style="margin-top: 10px;">
                            <label class="form-label">Jenis Kelamin</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="jenis_kelamin" id="L" value="L" <?= $siswa['jenis_kelamin'] == 'L' ? 'checked' : ''; ?> required>
                                <label class="form-check-label" for="L">
                                    Laki-Laki
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="jenis_kelamin" id="P" value="P" <?= $siswa['jenis_kelamin'] == 'P' ? 'checked' : ''; ?> required>
                                <label class="form-check-label" for="P">
                                    Perempuan
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6" style="margin-top: 10px;">
                            <label for="provinsi" class="form-label">Provinsi</label>
                            <select class="form-control" id="provinsi" name="provinsi" required>
                                <option value="">Pilih Provinsi</option>
                                <option value="Aceh" <?= $siswa['provinsi'] == 'Aceh' ? 'selected' : ''; ?>>Aceh</option>
                                <option value="Sumatera Utara" <?= $siswa['provinsi'] == 'Sumatera Utara' ? 'selected' : ''; ?>>Sumatera Utara</option>
                                <option value="Sumatera Barat" <?= $siswa['provinsi'] == 'Sumatera Barat' ? 'selected' : ''; ?>>Sumatera Barat</option>
                                <option value="Riau" <?= $siswa['provinsi'] == 'Riau' ? 'selected' : ''; ?>>Riau</option>
                                <option value="Jambi" <?= $siswa['provinsi'] == 'Jambi' ? 'selected' : ''; ?>>Jambi</option>
                                <option value="Sumatera Selatan" <?= $siswa['provinsi'] == 'Sumatera Selatan' ? 'selected' : ''; ?>>Sumatera Selatan</option>
                                <option value="Bengkulu" <?= $siswa['provinsi'] == 'Bengkulu' ? 'selected' : ''; ?>>Bengkulu</option>
                                <option value="Lampung" <?= $siswa['provinsi'] == 'Lampung' ? 'selected' : ''; ?>>Lampung</option>
                                <option value="Kepulauan Bangka Belitung" <?= $siswa['provinsi'] == 'Kepulauan Bangka Belitung' ? 'selected' : ''; ?>>Kepulauan Bangka Belitung</option>
                                <option value="Kepulauan Riau" <?= $siswa['provinsi'] == 'Kepulauan Riau' ? 'selected' : ''; ?>>Kepulauan Riau</option>
                                <option value="Jawa Barat" <?= $siswa['provinsi'] == 'Jawa Barat' ? 'selected' : ''; ?>>Jawa Barat</option>
                                <option value="Jawa Tengah" <?= $siswa['provinsi'] == 'Jawa Tengah' ? 'selected' : ''; ?>>Jawa Tengah</option>
                                <option value="Jawa Timur" <?= $siswa['provinsi'] == 'Jawa Timur' ? 'selected' : ''; ?>>Jawa Timur</option>
                                <option value="Yogyakarta" <?= $siswa['provinsi'] == 'Yogyakarta' ? 'selected' : ''; ?>>Yogyakarta</option>
                                <option value="Banten" <?= $siswa['provinsi'] == 'Banten' ? 'selected' : ''; ?>>Banten</option>
                                <option value="Jakarta" <?= $siswa['provinsi'] == 'Jakarta' ? 'selected' : ''; ?>>Jakarta</option>
                                <option value="Bali" <?= $siswa['provinsi'] == 'Bali' ? 'selected' : ''; ?>>Bali</option>
                                <option value="Nusa Tenggara Barat" <?= $siswa['provinsi'] == 'Nusa Tenggara Barat' ? 'selected' : ''; ?>>Nusa Tenggara Barat</option>
                                <option value="Nusa Tenggara Timur" <?= $siswa['provinsi'] == 'Nusa Tenggara Timur' ? 'selected' : ''; ?>>Nusa Tenggara Timur</option>
                                <option value="Kalimantan Barat" <?= $siswa['provinsi'] == 'Kalimantan Barat' ? 'selected' : ''; ?>>Kalimantan Barat</option>
                                <option value="Kalimantan Tengah" <?= $siswa['provinsi'] == 'Kalimantan Tengah' ? 'selected' : ''; ?>>Kalimantan Tengah</option>
                                <option value="Kalimantan Selatan" <?= $siswa['provinsi'] == 'Kalimantan Selatan' ? 'selected' : ''; ?>>Kalimantan Selatan</option>
                                <option value="Kalimantan Timur" <?= $siswa['provinsi'] == 'Kalimantan Timur' ? 'selected' : ''; ?>>Kalimantan Timur</option>
                                <option value="Kalimantan Utara" <?= $siswa['provinsi'] == 'Kalimantan Utara' ? 'selected' : ''; ?>>Kalimantan Utara</option>
                                <option value="Sulawesi Utara" <?= $siswa['provinsi'] == 'Sulawesi Utara' ? 'selected' : ''; ?>>Sulawesi Utara</option>
                                <option value="Sulawesi Tengah" <?= $siswa['provinsi'] == 'Sulawesi Tengah' ? 'selected' : ''; ?>>Sulawesi Tengah</option>
                                <option value="Sulawesi Selatan" <?= $siswa['provinsi'] == 'Sulawesi Selatan' ? 'selected' : ''; ?>>Sulawesi Selatan</option>
                                <option value="Sulawesi Tenggara" <?= $siswa['provinsi'] == 'Sulawesi Tenggara' ? 'selected' : ''; ?>>Sulawesi Tenggara</option>
                                <option value="Gorontalo" <?= $siswa['provinsi'] == 'Gorontalo' ? 'selected' : ''; ?>>Gorontalo</option>
                                <option value="Sulawesi Barat" <?= $siswa['provinsi'] == 'Sulawesi Barat' ? 'selected' : ''; ?>>Sulawesi Barat</option>
                                <option value="Maluku" <?= $siswa['provinsi'] == 'Maluku' ? 'selected' : ''; ?>>Maluku</option>
                                <option value="Maluku Utara" <?= $siswa['provinsi'] == 'Maluku Utara' ? 'selected' : ''; ?>>Maluku Utara</option>
                                <option value="Papua" <?= $siswa['provinsi'] == 'Papua' ? 'selected' : ''; ?>>Papua</option>
                                <option value="Papua Barat" <?= $siswa['provinsi'] == 'Papua Barat' ? 'selected' : ''; ?>>Papua Barat</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6" style="margin-top: 10px;">
                            <label for="agama" class="form-label">Agama</label>
                            <select class="form-control" id="agama" name="agama" required>
                                <option value="">Pilih Agama</option>
                                <option value="Islam" <?= $siswa['agama'] == 'Islam' ? 'selected' : ''; ?>>Islam</option>
                                <option value="Kristen" <?= $siswa['agama'] == 'Kristen' ? 'selected' : ''; ?>>Kristen</option>
                                <option value="Katolik" <?= $siswa['agama'] == 'Katolik' ? 'selected' : ''; ?>>Katolik</option>
                                <option value="Hindu" <?= $siswa['agama'] == 'Hindu' ? 'selected' : ''; ?>>Hindu</option>
                                <option value="Buddha" <?= $siswa['agama'] == 'Buddha' ? 'selected' : ''; ?>>Buddha</option>
                                <option value="Konghucu" <?= $siswa['agama'] == 'Konghucu' ? 'selected' : ''; ?>>Konghucu</option>
                            </select>
                        </div>
                        <div class="col-md-6 ms-auto" style="margin-top: 10px;">
                            <label for="kab_kota" class="form-label">Kab/Kota</label>
                            <input type="text" class="form-control" id="kab_kota" name="kab_kota" value="<?= $siswa['kab_kota']; ?>" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6" style="margin-top: 10px;">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea class="form-control" id="alamat" name="alamat" required><?= $siswa['alamat']; ?></textarea>
                        </div>
                        <div class="col-md-6 ms-auto" style="margin-top: 10px;">
                            <label for="kecamatan" class="form-label">Kecamatan</label>
                            <input type="text" class="form-control" id="kecamatan" name="kecamatan" value="<?= $siswa['kecamatan']; ?>" required>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-6 ms-auto" style="margin-top: 10px;">
                            <label for="desa_kelurahan" class="form-label">Desa/Kelurahan</label>
                            <input type="text" class="form-control" id="desa_kelurahan" name="desa_kelurahan" value="<?= $siswa['desa_kelurahan']; ?>" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6" style="margin-top: 10px;">
                            <label for="wali_siswa" class="form-label">Wali Siswa</label>
                            <input type="text" class="form-control" id="wali_siswa" name="wali_siswa" value="<?= $siswa['wali_siswa']; ?>">
                        </div>
                        <div class="col-md-6 ms-auto" style="margin-top: 10px;">
                            <label for="no_hp_wali" class="form-label">No. Handphone Wali Siswa</label>
                            <input type="text" class="form-control" id="no_hp_wali" name="no_hp_wali" value="<?= $siswa['no_hp_wali']; ?>">
                        </div>
                    </div>
                    <hr>
                    <h6 class="my-3"><b>B. Edit Data Orang Tua</b></h6>
                    <div class="row">
                        <div class="col-md-6" style="margin-top: 10px;">
                            <label for="nama_ayah" class="form-label">Nama Ayah Kandung</label>
                            <input type="text" class="form-control" id="nama_ayah" name="nama_ayah" value="<?= $siswa['nama_ayah']; ?>" required>
                        </div>
                        <div class="col-md-6" style="margin-top: 10px;">
                            <label for="nama_ibu" class="form-label">Nama Ibu Kandung</label>
                            <input type="text" class="form-control" id="nama_ibu" name="nama_ibu" value="<?= $siswa['nama_ibu']; ?>" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 ms-auto" style="margin-top: 10px;">
                            <label for="alamat_ayah" class="form-label">Alamat Ayah</label>
                            <input type="text" class="form-control" id="alamat_ayah" name="alamat_ayah" value="<?= $siswa['alamat_ayah']; ?>" required>
                        </div>
                        <div class="col-md-6 ms-auto" style="margin-top: 10px;">
                            <label for="alamat_ibu" class="form-label">Alamat Ibu</label>
                            <input type="text" class="form-control" id="alamat_ibu" name="alamat_ibu" value="<?= $siswa['alamat_ibu']; ?>" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 ms-auto" style="margin-top: 10px;">
                            <label for="no_hp_ayah" class="form-label">No Handphone Ayah</label>
                            <input type="text" class="form-control" id="no_hp_ayah" name="no_hp_ayah" value="<?= $siswa['no_hp_ayah']; ?>">
                        </div>
                        <div class="col-md-6 ms-auto" style="margin-top: 10px;">
                            <label for="no_hp_ibu" class="form-label">No Handphone Ibu</label>
                            <input type="text" class="form-control" id="no_hp_ibu" name="no_hp_ibu" value="<?= $siswa['no_hp_ibu']; ?>">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group" style="margin-top: 12px;">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#konfirmasiModal">Update</button>
                        </div>
                    </div>
                </div>

                <!-- Modal Konfirmasi -->
                <div class="modal fade" id="konfirmasiModal" tabindex="-1" aria-labelledby="konfirmasiModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="konfirmasiModalLabel">Konfirmasi Update</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Apakah Anda yakin ingin mengupdate data siswa ini?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="button" class="btn btn-primary" onclick="submitForm()">Ya, Update</button>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

<script>
    function submitForm() {
        var form = document.getElementById('editSiswaForm');
        var formData = new FormData(form);

        fetch('proses_edit_siswa.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Tambahkan id_siswa ke URL
                    window.location.href = 'data_siswa.php?id=' + <?php echo $id_siswa; ?>;
                } else {
                    alert('Terjadi kesalahan: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat mengupdate data');
            });
    }
</script>

<?php
require_once 'template_admin/footer.php';
?>