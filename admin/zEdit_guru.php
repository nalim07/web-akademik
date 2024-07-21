<?php
require_once '../koneksi.php';
session_start();

if (!isset($_SESSION["sslogin"])) {
    header("location: ../auth/login.php");
    exit;
}

$title = "Edit Guru";
require_once 'template_admin/header.php';
require_once 'template_admin/navbar.php';

// Mendapatkan ID guru dari URL
if (!isset($_GET['id_guru'])) {
    echo "ID guru tidak ditemukan!";
    exit;
}

$id_guru = $_GET['id_guru'];

// Query untuk mengambil detail guru berdasarkan ID
$query = "SELECT * FROM tbl_guru WHERE id_guru = '$id_guru';";
$sql = mysqli_query($conn, $query);

if (!$sql) {
    echo "Error: " . mysqli_error($conn);
    exit;
}

$guru = mysqli_fetch_assoc($sql);

if (!$guru) {
    echo "Data guru tidak ditemukan!";
    exit;
}
?>

<div class="container-fluid">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
            <li class="breadcrumb-item"><a href="data_guru.php">Data Guru</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Data</li>
        </ol>
    </nav>
    <!-- End Breadcrumb -->

    <!-- Edit Guru -->
    <div class="card shadow mb-5">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Guru</h6>
        </div>
        <div class="card-body">
            <form action="zProses_edit_guru.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id_guru" value="<?= $guru['id_guru']; ?>">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6" style="margin-top: 10px;">
                            <label for="namaGuru" class="form-label">Nama Guru</label>
                            <input type="text" class="form-control" id="namaGuru" name="namaGuru" value="<?= $guru['namaGuru']; ?>" required>
                        </div>
                        <div class="col-md-6 ms-auto" style="margin-top: 10px;">
                            <label for="nbm" class="form-label">NBM</label>
                            <input type="text" class="form-control" id="nbm" name="nbm" value="<?= $guru['nbm']; ?>" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6" style="margin-top: 10px;">
                            <label for="tempatLahir" class="form-label">Tempat Lahir</label>
                            <input type="text" class="form-control" id="tempatLahir" name="tempatLahir" value="<?= $guru['tempatLahir']; ?>" required>
                        </div>
                        <div class="col-md-6 ms-auto" style="margin-top: 10px;">
                            <label for="tanggalLahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control" id="tanggalLahir" name="tanggalLahir" value="<?= $guru['tanggalLahir']; ?>" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6" style="margin-top: 10px;">
                            <label class="form-label">Jenis Kelamin</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="jenisKelamin" id="L" value="L" <?= $guru['jenisKelamin'] == 'L' ? 'checked' : ''; ?> required>
                                <label class="form-check-label" for="L">
                                    Laki-Laki
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="jenisKelamin" id="P" value="P" <?= $guru['jenisKelamin'] == 'P' ? 'checked' : ''; ?> required>
                                <label class="form-check-label" for="P">
                                    Perempuan
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6 ms-auto" style="margin-top: 10px;">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $guru['alamat']; ?>" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6" style="margin-top: 10px;">
                            <label for="agama" class="form-label">Agama</label>
                            <select class="form-control" id="agama" name="agama" required>
                                <option value="">Pilih Agama</option>
                                <option value="Islam" <?= $guru['agama'] == 'Islam' ? 'selected' : ''; ?>>Islam</option>
                                <option value="Kristen" <?= $guru['agama'] == 'Kristen' ? 'selected' : ''; ?>>Kristen</option>
                                <option value="Katolik" <?= $guru['agama'] == 'Katolik' ? 'selected' : ''; ?>>Katolik</option>
                                <option value="Hindu" <?= $guru['agama'] == 'Hindu' ? 'selected' : ''; ?>>Hindu</option>
                                <option value="Buddha" <?= $guru['agama'] == 'Buddha' ? 'selected' : ''; ?>>Buddha</option>
                                <option value="Konghucu" <?= $guru['agama'] == 'Konghucu' ? 'selected' : ''; ?>>Konghucu</option>
                            </select>
                        </div>
                        <div class="col-md-6 ms-auto" style="margin-top: 10px;">
                            <label for="pendidikan_terakhir" class="form-label">Pendidikan Terakhir</label>
                            <input type="text" class="form-control" id="pendidikan_terakhir" name="pendidikan_terakhir" value="<?= $guru['pendidikan_terakhir']; ?>" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6" style="margin-top: 10px;">
                                <label for="foto_guru" class="form-label">Upload Foto</label>
                                <input type="file" class="form-control" id="foto_guru" name="foto_guru">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12" style="margin-top: 20px;">
                                <button type="submit" class="btn btn-primary">Update Guru</button>
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