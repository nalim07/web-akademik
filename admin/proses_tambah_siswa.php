<?php

require_once '../koneksi.php';
session_start();

if (!isset($_SESSION["sslogin"])) {
    header("location: ../auth/login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_siswa = $_POST['nama_siswa'];
    $nis = $_POST['nis'];
    $tanggal_masuk = $_POST['tanggal_masuk'];
    $kelas = $_POST['kelas'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $alamat = $_POST['alamat'];
    $desa_kelurahan = $_POST['desa_kelurahan'];
    $kecamatan = $_POST['kecamatan'];
    $kab_kota = $_POST['kab_kota'];
    $provinsi = $_POST['provinsi'];
    $agama = $_POST['agama'];
    $wali_siswa = $_POST['wali_siswa'];
    $no_hp_wali = $_POST['no_hp_wali'];
    $foto_siswa = $_FILES['foto_siswa'];

    // if ($foto_siswa != '') {
    //     $url = "tambahsiswa.php";
    //     $foto_siswa = uploadimg($url);
    // } else {
    //     $foto_siswa = '../assets/img/default.png';
    // }

    $sql = "INSERT INTO siswa_kelasa (nama_siswa, nis, tanggal_masuk, kelas, tempat_lahir, tanggal_lahir, jenis_kelamin, alamat, desa_kelurahan, kecamatan, kab_kota, provinsi, agama, wali_siswa, no_hp_wali, foto_siswa) 
            VALUES ('$nama_siswa', '$nis', '$tanggal_masuk', '$kelas', '$tempat_lahir', '$tanggal_lahir', '$jenis_kelamin', '$alamat', '$desa_kelurahan', '$kecamatan', '$kab_kota', '$provinsi', '$agama', '$wali_siswa', '$no_hp_wali', '$foto_siswa')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>
                alert('Data Berhasil ditambahkan!');
                document.location.href = 'data_siswa.php';
            </script>";
        return;
    } else {
        echo "<script>
        alert('Data gagal ditambahkan!');
        document.location.href = 'data_siswa.php';
        </script>" . mysqli_error($con);
        return;
    }

    mysqli_close($conn);
}