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
        echo "Data berhasil ditambahkan";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}

// Menangkap data yang dikirim dari form
// if (isset($_POST['submit'])) {
//     if ($_POST['submit']) {
//         var_dump($_POST);
//         die();
//     }
    // $namaSiswa = $_POST['nama_siswa'];
    // $tanggalMasuk = $_POST['tanggal_masuk'];
    // $kelas = $_POST['kelas'];
    // $tempat_lahir = $_POST['tempat_lahir'];
    // $tanggal_lahir = $_POST['tanggal_lahir'];
    // $jenisKelamin = $_POST['jenis_kelamin'];
    // $agama = $_POST['agama'];
    // $alamat = $_POST['alamat'];
    // $waliSiswa = $_POST['wali_siswa'];


    // Query untuk memasukkan data ke dalam tabel tbl_siswa
//     $sql = "INSERT INTO siswa_kelasa (nama_siswa, tanggal_masuk, kelas, tempat_lahir, tanggal_lahir, jenis_kelamin, agama, alamat, wali_siswa) 
// VALUES ('$namaSiswa', '$tanggalMasuk', '$kelas', '$tempat_lahir', '$tanggal_lahir', '$jenisKelamin', '$agama', '$alamat', '$waliSiswa')";

//     $query = mysqli_query($conn, $sql);

//     if ($query) {
//         echo "<script>
//                 alert('Data Berhasil ditambahkan!');
//                 document.location.href = 'kelasa.php';
//             </script>";
//         return;
//     } else {
//         echo "<script>
//         alert('Data gagal ditambahkan!');
//         document.location.href = 'kelasa.php';
//     </script>" . mysqli_error($con);
//         return;
//     }
// }
