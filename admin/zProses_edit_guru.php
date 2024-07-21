<?php
require_once '../koneksi.php';
session_start();

if (!isset($_SESSION["sslogin"])) {
    header("location: ../auth/login.php");
    exit;
}

// Ambil data dari form
$id_guru = $_POST['id_guru'];
$namaGuru = $_POST['namaGuru'];
$nbm = $_POST['nbm'];
$tempatLahir = $_POST['tempatLahir'];
$tanggalLahir = $_POST['tanggalLahir'];
$jenisKelamin = $_POST['jenisKelamin'];
$alamat = $_POST['alamat'];
$agama = $_POST['agama'];
$pendidikan_terakhir = $_POST['pendidikan_terakhir'];

// Proses upload foto
$foto_guru = $_FILES['foto_guru']['name'];
$target_dir = "../uploads/";
$target_file = $target_dir . basename($foto_guru);
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Cek apakah file gambar diunggah
if (!empty($_FILES['foto_guru']['tmp_name'])) {
    $check = getimagesize($_FILES['foto_guru']['tmp_name']);
    if ($check !== false) {
        if (move_uploaded_file($_FILES['foto_guru']['tmp_name'], $target_file)) {
            $foto_guru = basename($foto_guru);
        } else {
            $foto_guru = null;
        }
    } else {
        $foto_guru = null;
    }
} else {
    $foto_guru = null;
}

// Update data guru
$query = "UPDATE tbl_guru SET 
    namaGuru = ?, 
    nbm = ?, 
    tempatLahir = ?, 
    tanggalLahir = ?, 
    jenisKelamin = ?, 
    alamat = ?, 
    agama = ?, 
    pendidikan_terakhir = ?, 
    foto_guru = IFNULL(?, foto_guru) 
    WHERE id_guru = ?";

$stmt = $conn->prepare($query);
$stmt->bind_param(
    "sssssssssi",
    $namaGuru,
    $nbm,
    $tempatLahir,
    $tanggalLahir,
    $jenisKelamin,
    $alamat,
    $agama,
    $pendidikan_terakhir,
    $foto_guru,
    $id_guru
);

if ($stmt->execute()) {
    echo "<script>alert('Data guru berhasil diupdate.'); window.location.href = 'data_guru.php';</script>";
} else {
    echo "<script>alert('Gagal mengupdate data guru: " . $stmt->error . "'); window.location.href = 'data_guru.php';</script>";
}

$stmt->close();
$conn->close();
?>