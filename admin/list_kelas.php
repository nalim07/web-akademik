<?php
include '../koneksi.php';
session_start();

//sesi ketika login
if (!isset($_SESSION["sslogin"])) {
    header("location: ../auth/login.php");
    exit;
}

// Proses tambah kelas
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_kelas = $_POST['nama_kelas'];
    $tahun_ajaran = $_POST['tahun_ajaran'];

    // Cek apakah kelas sudah ada
    $query_cek = "SELECT * FROM tbl_kelas WHERE nama_kelas = '$nama_kelas' AND tahun_ajaran = '$tahun_ajaran'";
    $result_cek = mysqli_query($conn, $query_cek);

    if (mysqli_num_rows($result_cek) > 0) {
        $status = "exists";
    } else {
        $query = "INSERT INTO tbl_kelas (nama_kelas, tahun_ajaran) VALUES ('$nama_kelas', '$tahun_ajaran')";
        if (mysqli_query($conn, $query)) {
            $status = "success";
        } else {
            $status = "error";
        }
    }
}

// Proses hapus kelas
if (isset($_GET['hapus_id'])) {
    $hapus_id = $_GET['hapus_id'];
    $query_hapus = "DELETE FROM tbl_kelas WHERE id_kelas = '$hapus_id'";
    if (mysqli_query($conn, $query_hapus)) {
        $status_hapus = "success";
        header("Refresh: 5; url=list_kelas.php"); // Untuk Merefresh Halaman Secara otomatis
    } else {
        $status_hapus = "error";
    }
}

// Ambil data kelas
$query = "SELECT id_kelas, nama_kelas, tahun_ajaran FROM tbl_kelas";
$result = mysqli_query($conn, $query);

$title = "Tahun Ajaran";
require_once 'template_admin/header.php';
require_once 'template_admin/navbar.php';
?>

<div class="container-fluid">
    <!-- Page Heading -->
    <?php if (isset($status) && $status == "success") : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            Kelas berhasil ditambahkan!
        </div>
    <?php elseif (isset($status) && $status == "error") : ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            Terjadi kesalahan saat menambahkan kelas.
        </div>
    <?php elseif (isset($status) && $status == "exists") : ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            Kelas dengan nama dan tahun ajaran yang sama sudah ada.
        </div>
    <?php endif; ?>
    <?php if (isset($status_hapus) && $status_hapus == "success") : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            Kelas berhasil dihapus!
        </div>
    <?php elseif (isset($status_hapus) && $status_hapus == "error") : ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            Terjadi kesalahan saat menghapus kelas.
        </div>
    <?php endif; ?>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah Kelas</li>
        </ol>
    </nav>
    <!-- Form Tambah Kelas -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="mt-2 font-weight-bold text-primary text-start">Tambah Kelas</h6>
        </div>
        <div class="card-body">
            <form action="list_kelas.php" method="POST">
                <div class="form-group">
                    <label for="nama_kelas">Nama Kelas</label>
                    <input type="text" class="form-control" id="nama_kelas" name="nama_kelas" placeholder="Contoh: A" required>
                </div>
                <div class="form-group">
                    <label for="tahun_ajaran">Tahun Ajaran</label>
                    <select class="form-control" id="tahun_ajaran" name="tahun_ajaran" required>
                        <option value="">Pilih Tahun Ajaran</option>
                        <?php
                        $query_tahun_ajaran = "SELECT * FROM tbl_ta";
                        $result_tahun_ajaran = mysqli_query($conn, $query_tahun_ajaran);
                        while ($row_tahun_ajaran = mysqli_fetch_assoc($result_tahun_ajaran)) {
                            echo "<option value='" . $row_tahun_ajaran['tahun_ajaran'] . "'>" . $row_tahun_ajaran['tahun_ajaran'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary mt-2">Tambah</button>
            </form>
        </div>
    </div>
    <!-- Tabel Daftar Kelas -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="mt-2 font-weight-bold text-primary text-start">Daftar Kelas</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Kelas</th>
                            <th>Tahun Ajaran</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $no++ . "</td>";
                            echo "<td>" . $row['nama_kelas'] . "</td>";
                            echo "<td>" . $row['tahun_ajaran'] . "</td>";
                            echo "<td>";
                            echo "<a href='list_kelas.php?hapus_id=" . $row['id_kelas'] . "' class='btn btn-danger btn-sm'>Hapus</a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    // Menghilangkan alert setelah 5 detik
    setTimeout(function() {
        let alerts = document.querySelectorAll('.alert');
        alerts.forEach(function(alert) {
            alert.classList.remove('show');
            alert.classList.add('fade');
        });
    }, 5000);
</script>

<?php
require_once 'template_admin/footer.php';
?>