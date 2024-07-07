<?php
require_once '../koneksi.php';

// Mendapatkan ID siswa dari URL
$id_siswa = $_GET['id'];

// Query untuk mendapatkan nama file foto siswa
$query_foto = "SELECT foto_siswa FROM siswa_kelasa WHERE id = '$id_siswa'";
$result_foto = mysqli_query($conn, $query_foto);
$row_foto = mysqli_fetch_assoc($result_foto);
$nama_file_foto = $row_foto['foto_siswa'];

// Query untuk menghapus data siswa
$query = "DELETE FROM siswa_kelasa WHERE id = '$id_siswa'";
$sql = mysqli_query($conn, $query);

// Eksekusi query
if ($sql) {
    // Hapus file foto jika ada
    if (!empty($nama_file_foto) && file_exists("../uploads/" . $nama_file_foto)) {
        unlink("../uploads/" . $nama_file_foto);
    }
    
    echo "Data siswa berhasil dihapus.";
    // Redirect ke halaman daftar siswa
    header("Location: data_siswa.php");
} else {
    echo "Gagal menghapus data siswa.";
}

$conn->close();
?>
