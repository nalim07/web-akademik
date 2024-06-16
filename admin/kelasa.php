<?php

require_once '../koneksi.php';
session_start();
//sesi ketika login
if (!isset($_SESSION["sslogin"])) {
    header("location: ../auth/login.php");
    exit;
}

$title = "Data Siswa - Kelas A";
require_once 'template_admin/header.php';
require_once 'template_admin/navbar.php';

// Query untuk mengambil data siswa dari tabel tbl_siswa
$query = "SELECT * FROM siswa_kelasa;";
$sql = mysqli_query($conn, $query);


?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Kelas A</li>
        </ol>
    </nav>
    <!-- Tabel Data Siswa -->
    <div class="card shadow mb-5">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between">
                <h6 class="mt-2 font-weight-bold text-primary text-start">Tabel Data Siswa Kelas A</h6>
                <a class="btn btn-outline-success" href="tambahsiswa.php" role="button" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .10rem; --bs-btn-font-size: .75rem;"><i class="bi bi-person-fill-add"></i>Tambah Data</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Nama</th>
                            <th>Tgl Masuk</th>
                            <th>Kelas</th>
                            <th>Tempat Lahir</th>
                            <th>Tgl Lahir</th>
                            <th>Jenis Kelamin</th>
                            <th>Agama</th>
                            <th>Alamat</th>
                            <th>Wali Siswa</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="text-center">
                            <?php
                            $no=1;
                            // Menampilkan data siswa dalam tabel
                            while ($result = mysqli_fetch_assoc($sql)) {
                                echo "<tr class='text-center'>";
                                echo "<td>" . $no;$no++ . "</td>";
                                echo "<td>" . $result['nama_siswa'] . "</td>";
                                echo "<td>" . $result['tanggal_masuk'] . "</td>";
                                echo "<td>" . $result['kelas'] . "</td>";
                                echo "<td>" . $result['tempat_lahir'] . "</td>";
                                echo "<td>" . $result['tanggal_lahir'] . "</td>";
                                echo "<td>" . $result['jenis_kelamin'] . "</td>";
                                echo "<td>" . $result['agama'] . "</td>";
                                echo "<td>" . $result['alamat'] . "</td>";
                                echo "<td>" . $result['wali_siswa'] . "</td>";
                                echo "<td>";
                                echo "<a href='edit_siswa.php?id_siswa=" . $result['id'] . "' class='btn btn-info btn-sm'><i class='bi bi-pencil-square' title='Edit'></i></a>&nbsp;";
<<<<<<< HEAD
                                echo "<a href='hapus_siswa.php?id=" . $result['id'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\");'><i class='bi bi-trash' title='hapus'></i></a>";
=======
                                echo "<a href='hapus_siswaA.php?id=" . $result['id'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\");'><i class='bi bi-trash' title='Hapus'></i></a>";
>>>>>>> origin/main
                                echo "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<?php
require_once 'template_admin/footer.php';
?>