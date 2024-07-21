<?php
require_once '../koneksi.php';

// Mendapatkan ID guru dari URL
$id_guru = $_GET['id_guru'];

// Query untuk mendapatkan nama file foto guru
$query_foto = "SELECT foto_guru FROM tbl_guru WHERE id_guru = '$id_guru'";
$result_foto = mysqli_query($conn, $query_foto);
$row_foto = mysqli_fetch_assoc($result_foto);
$nama_file_foto = $row_foto['foto_guru'];

// Query untuk menghapus data guru
$query = "DELETE FROM tbl_guru WHERE id_guru = '$id_guru'";
$sql = mysqli_query($conn, $query);

// Eksekusi query
if ($sql) {
    // Hapus file foto jika ada
    if (!empty($nama_file_foto) && file_exists("../uploads/" . $nama_file_foto)) {
        unlink("../uploads/" . $nama_file_foto);
    }

    echo "Data guru berhasil dihapus.";
    // Redirect ke halaman daftar guru
    header("Location: data_guru.php");
} else {
    echo "Gagal menghapus data guru.";
}

$conn->close();
?>
