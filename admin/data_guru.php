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

<div class="container mt-5">
    <h2>Data Guru</h2>
    <a href="tambah_guru.php" class="btn btn-primary mb-3">Tambah Guru</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>NIP</th>
                <th>Mata Pelajaran</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            while ($row = mysqli_fetch_assoc($sql)) {
                echo "<tr>";
                echo "<td>" . $no++ . "</td>";
                echo "<td>" . $row['nama'] . "</td>";
                echo "<td>" . $row['nip'] . "</td>";
                echo "<td>" . $row['mata_pelajaran'] . "</td>";
                echo "<td>
                        <a href='edit_guru.php?id=" . $row['id'] . "' class='btn btn-warning btn-sm'>Edit</a>
                        <a href='hapus_guru.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\")'>Hapus</a>
                      </td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php
require_once '../template_admin/footer.php';
?>