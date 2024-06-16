<?php

require_once '../koneksi.php';
// session_start();

// if (!isset($_SESSION["sslogin"])) {
//     header("location: ../auth/login.php");
//     exit;
// }

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_siswa = $_POST['nama_siswa'];
    $tanggal_masuk = $_POST['tanggal_masuk'];
    $kelas = $_POST['kelas'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $agama = $_POST['agama'];
    $alamat = $_POST['alamat'];
    $wali_siswa = $_POST['wali_siswa'];

    $sql = "INSERT INTO siswa_kelasa (nama_siswa, tanggal_masuk, kelas, tempat_lahir, tanggal_lahir, jenis_kelamin, agama, alamat, wali_siswa) 
            VALUES ('$nama_siswa', '$tanggal_masuk', '$kelas', '$tempat_lahir', '$tanggal_lahir', '$jenis_kelamin', '$agama', '$alamat', '$wali_siswa')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>
                alert('Data Berhasil ditambahkan!');
                document.location.href = 'kelasa.php';
            </script>";
        return;
    } else {
        echo "<script>
        alert('Data gagal ditambahkan!');
        document.location.href = 'kelasa.php';
        </script>" . mysqli_error($con);
        return;
    }

    mysqli_close($conn);
}