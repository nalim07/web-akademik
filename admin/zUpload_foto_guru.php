<?php
require_once '../koneksi.php';
session_start();

if (!isset($_SESSION["sslogin"])) {
    header("location: ../auth/login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_guru = $_POST['id_guru'];

    // Ambil informasi foto lama
    $query_foto_lama = "SELECT foto_guru FROM tbl_guru WHERE id_guru = '$id_guru'";
    $result_foto_lama = mysqli_query($conn, $query_foto_lama);
    $row_foto_lama = mysqli_fetch_assoc($result_foto_lama);
    $foto_lama = $row_foto_lama['foto_guru'];

    // Proses upload foto baru
    if (isset($_FILES['foto_guru']) && $_FILES['foto_guru']['error'] == 0) {
        $foto = $_FILES['foto_guru'];
        $nama_file = $foto['name'];
        $tmp_name = $foto['tmp_name'];
        $ekstensi = pathinfo($nama_file, PATHINFO_EXTENSION);
        $nama_file_baru = "foto_" . $id_guru . "_" . time() . "." . $ekstensi;
        $tujuan_upload = "../uploads/" . $nama_file_baru;

        if (move_uploaded_file($tmp_name, $tujuan_upload)) {
            // Hapus foto lama jika ada
            if (!empty($foto_lama) && file_exists("../uploads/" . $foto_lama)) {
                unlink("../uploads/" . $foto_lama);
            }

            // Update database dengan nama file foto baru
            $query_update = "UPDATE tbl_guru SET foto_guru = '$nama_file_baru' WHERE id_guru = '$id_guru'";
            mysqli_query($conn, $query_update);

            $_SESSION['pesan'] = "Foto berhasil diunggah.";
        } else {
            $_SESSION['pesan'] = "Gagal mengunggah foto.";
        }
    } else {
        $_SESSION['pesan'] = "Tidak ada file yang diunggah atau terjadi kesalahan.";
    }

    header("Location: view_guru.php?id_guru=" . $id_guru);
    exit;
}
