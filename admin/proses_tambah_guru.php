<?php
require_once '../koneksi.php';

session_start();

if (!isset($_SESSION["sslogin"])) {
    header("location: ../auth/login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nbm = $_POST['nbm'];
    $nama_guru = $_POST['nama_guru'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $alamat = $_POST['alamat'];
    $agama = $_POST['agama'];
    $pendidikan_terakhir = $_POST['pendidikan_terakhir'];
    $foto_guru = $_FILES['foto_guru']['name'];

    if ($foto_guru != "") {
        $ekstensi_diperbolehkan = array('png', 'jpg', 'jpeg');
        $x = explode('.', $foto_guru);
        $ekstensi = strtolower(end($x));
        $file_tmp = $_FILES['foto_guru']['tmp_name'];
        $angka_acak = rand(1, 999);
        $nama_gambar_baru = $angka_acak . '-' . $foto_guru;

        if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
            move_uploaded_file($file_tmp, '../uploads/' . $nama_gambar_baru);

            $query = "INSERT INTO tbl_guru (nbm, namaGuru, tempatLahir, tanggalLahir, jenisKelamin, alamat, agama, pendidikan_terakhir, foto_guru) VALUES ('$nbm', '$nama_guru', '$tempat_lahir', '$tanggal_lahir', '$jenis_kelamin', '$alamat', '$agama', '$pendidikan_terakhir', '$nama_gambar_baru')";
            $result = mysqli_query($conn, $query);

            if (!$result) {
                die("Query gagal dijalankan: " . mysqli_errno($conn) . " - " . mysqli_error($conn));
            } else {
                $_SESSION['success_message'] = "Data berhasil ditambah.";
                header("Location: data_guru.php");
                exit();
            }
        } else {
            echo "<script>alert('Ekstensi gambar yang boleh hanya jpg atau png.');window.location='tambah_guru.php';</script>";
        }
    } else {
        $nama_gambar_baru = 'default.jpg'; // Tambahkan nilai default untuk foto_guru
    }

    $query = "INSERT INTO tbl_guru (nbm, namaGuru, tempatLahir, tanggalLahir, jenisKelamin, alamat, agama, pendidikan_terakhir, foto_guru) VALUES ('$nbm', '$nama_guru', '$tempat_lahir', '$tanggal_lahir', '$jenis_kelamin', '$alamat', '$agama', '$pendidikan_terakhir', '$nama_gambar_baru')";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query gagal dijalankan: " . mysqli_errno($conn) . " - " . mysqli_error($conn));
    } else {
        $_SESSION['success_message'] = "Data berhasil ditambah.";
        header("Location: data_guru.php");
        exit();
    }
}

mysqli_close($conn);