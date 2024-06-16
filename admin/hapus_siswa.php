<?php
require_once '../koneksi.php';

// Mendapatkan ID siswa dari URL
$id_siswa = $_GET['id'];

// Query untuk menghapus data siswa
$query = "DELETE FROM siswa_kelasa WHERE id = '$id_siswa';";
$sql = mysqli_query($conn, $query);

// Eksekusi query
if ($sql) {
    echo "Data siswa berhasil dihapus.";
    // Redirect ke halaman daftar siswa atau halaman lain
    header("Location: kelasa.php");
} else {
    echo "Gagal menghapus data siswa.";
}

$conn->close();
?>

