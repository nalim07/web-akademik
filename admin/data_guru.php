<?php
require_once '../koneksi.php';

session_start();
//sesi ketika login
if (!isset($_SESSION["sslogin"])) {
    header("location: ../auth/login.php");
    exit;
}

$title = "Data Guru";
require_once 'template_admin/header.php';
require_once 'template_admin/navbar.php';

?>
<div class="container-fluid">
    <div class="container mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Beranda</a></li>
                <li class="breadcrumb-item active" aria-current="page">Data Guru</li>
            </ol>
        </nav>
        <div class="card shadow mb-5">
            <div class="card-header py-3">
                <div class="d-flex justify-content-between">
                    <h6 class="mt-2 font-weight-bold text-primary text-start">Tabel Data Guru</h6>
                    <a class="btn btn-outline-success" href="tambah_guru.php" role="button" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .10rem; --bs-btn-font-size: .75rem;"><i class="bi bi-person-fill-add"></i>Tambah Data</a>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NBM</th>
                                <th>Nama Lengkap</th>
                                <th>Jenis Kelamin</th>
                                <th>Alamat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            // Tambahkan query untuk mengambil data dari database
                            $sql = mysqli_query($conn, "SELECT * FROM tbl_guru");
                            while ($row = mysqli_fetch_assoc($sql)) {
                                echo "<tr>";
                                echo "<td>" . $no++ . "</td>";
                                echo "<td>" . $row['nbm'] . "</td>";
                                echo "<td>" . $row['namaGuru'] . "</td>";
                                echo "<td>";
                                if ($row['jenisKelamin'] == 'L') {
                                    echo "Laki-laki";
                                } elseif ($row['jenisKelamin'] == 'P') {
                                    echo "Perempuan";
                                } else {
                                    echo $row['jenisKelamin']; // Menampilkan nilai asli jika tidak sesuai L atau P
                                }
                                echo "</td>";
                                echo "<td>" . $row['alamat'] . "</td>";
                                echo "<td>
                        <a href='view_guru.php?id_guru=" . $row['id_guru'] . "' class='btn btn-info btn-sm'>Detail</a>
                        <a href='zEdit_guru.php?id_guru=" . $row['id_guru'] . "' class='btn btn-warning btn-sm'>Edit</a>
                        <button class='btn btn-danger btn-sm' data-bs-toggle='modal' data-bs-target='#hapusModal" . $row['id_guru'] . "'>Hapus</button>
                      </td>";
                                echo "</tr>";
                                // Modal
                                echo "<div class='modal fade' id='hapusModal" . $row['id_guru'] . "' tabindex='-1' aria-labelledby='hapusModalLabel" . $row['id_guru'] . "' aria-hidden='true'>
                                        <div class='modal-dialog'>
                                            <div class='modal-content'>
                                                <div class='modal-header'>
                                                    <h5 class='modal-title' id='hapusModalLabel" . $row['id_guru'] . "'>Konfirmasi Hapus</h5>
                                                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                                </div>
                                                <div class='modal-body'>
                                                    Apakah Anda yakin ingin menghapus data ini?
                                                </div>
                                                <div class='modal-footer'>
                                                    <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Batal</button>
                                                    <a href='hapus_guru.php?id_guru=" . $row['id_guru'] . "' class='btn btn-danger'>Hapus</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require_once 'template_admin/footer.php';
?>