<?php
require_once '../koneksi.php';
session_start();
//sesi ketika login
if (!isset($_SESSION["sslogin"])) {
    header("location: ../auth/login.php");
    exit;
}

$title = "Detail Guru";
require_once 'template_admin/header.php';
require_once 'template_admin/navbar.php';

// Mendapatkan ID guru dari URL
$id_guru = $_GET['id_guru'];

// Query untuk mengambil detail guru berdasarkan ID
$query = "SELECT * FROM tbl_guru WHERE id_guru = '$id_guru';";
$sql = mysqli_query($conn, $query);
$guru = mysqli_fetch_assoc($sql);

?>

<!-- Menampilkan detail guru -->
<div class="container mt-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="dashboard.php">Beranda</a></li>
            <li class="breadcrumb-item"><a href="data_guru.php">List Data Guru</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail Guru</li>
        </ol>
    </nav>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4">
                <div class="card shadow mb-5 card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <?php
                            $foto_path = "../uploads/" . $guru['foto_guru'];
                            if (!empty($guru['foto_guru']) && file_exists($foto_path)) {
                                $foto_url = $foto_path;
                            } else {
                                $foto_url = "../assets/img/profil_default.png";
                            }
                            ?>
                            <img class="mb-3" src="<?= $foto_url; ?>" alt="pas_foto" width="105px">
                            <form action="zUpload_foto_guru.php" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="id_guru" value="<?= $guru['id_guru']; ?>">
                                <div class="form-group">
                                    <input type="file" name="foto_guru" class="form-control-file" accept="image/*">
                                </div>
                                <button type="submit" class="btn btn-primary btn-sm my-2">Unggah Foto</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card shadow mb-5">
                    <div class="card-header">
                        <h3 class="mt-2 font-weight-bold text-primary text-start">Detail Data Guru</h3>
                        <div class="card-tools">
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <a href="data_guru.php" class="btn btn-success btn-sm">Kembali</a>
                                    <a href="zEdit_guru.php?id=<?= $guru['id_guru']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="border-bottom p-2">
                            <div class="row">
                                <div class="row">
                                    <div class="col-md-6" style="margin-bottom: 10px;">
                                        <label for="nama_guru">Nama Lengkap:</label>
                                        <input type="text" class="form-control" id="nama_guru" value="<?= $guru['namaGuru']; ?>" disabled>
                                    </div>
                                    <div class="col-md-6" style="margin-bottom: 10px;">
                                        <label for="nama_guru">NBM:</label>
                                        <input type="text" class="form-control" id="nama_guru" value="<?= $guru['nbm']; ?>" disabled>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6" style="margin-bottom: 10px;">
                                        <label for="tempat_lahir">Tempat Lahir:</label>
                                        <input type="text" class="form-control" id="tempat_lahir" value="<?= $guru['tempatLahir']; ?>" disabled>
                                    </div>
                                    <div class="col-md-6" style="margin-bottom: 10px;">
                                        <label for="tanggal_lahir">Tanggal Lahir:</label>
                                        <input type="text" class="form-control" id="tanggal_lahir" value="<?= $guru['tanggalLahir']; ?>" disabled>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6" style="margin-bottom: 10px;">
                                        <label for="jenis_kelamin">Jenis Kelamin:</label>
                                        <input type="text" class="form-control" id="jenis_kelamin" value="<?= $guru['jenisKelamin'] == 'L' ? 'Laki-laki' : 'Perempuan'; ?>" disabled>
                                    </div>
                                    <div class="col-md-6" style="margin-bottom: 10px;">
                                        <label for="alamat">Alamat:</label>
                                        <input type="text" class="form-control" id="alamat" value="<?= $guru['alamat']; ?>" disabled>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6" style="margin-bottom: 10px;">
                                        <label for="agama">Agama:</label>
                                        <input type="text" class="form-control" id="agama" value="<?= $guru['agama']; ?>" disabled>
                                    </div>
                                    <div class="col-md-6" style="margin-bottom: 10px;">
                                        <label for="pendidikan_terakhir">Pendidikan Terakhir:</label>
                                        <input type="text" class="form-control" id="pendidikan_terakhir" value="<?= $guru['pendidikan_terakhir']; ?>" disabled>
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