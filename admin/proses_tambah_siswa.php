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
    $foto_siswa = $_FILES['foto_siswa']['name'];
    $nama_ayah = $_POST['nama_ayah'];
    $alamat_ayah = $_POST['alamat_ayah'];
    $no_hp_ayah = $_POST['no_hp_ayah'];
    $nama_ibu = $_POST['nama_ibu'];
    $alamat_ibu = $_POST['alamat_ibu'];
    $no_hp_ibu = $_POST['no_hp_ibu'];
    $wali_siswa = $_POST['wali_siswa'];
    $no_hp_wali = $_POST['no_hp_wali'];

    if ($foto_siswa != "") {
        $ekstensi_diperbolehkan = array('png', 'jpg', 'jpeg');
        $x = explode('.', $foto_siswa);
        $ekstensi = strtolower(end($x));
        $file_tmp = $_FILES['foto_siswa']['tmp_name'];
        $angka_acak = rand(1, 999);
        $nama_gambar_baru = $angka_acak . '-' . $foto_siswa;

        if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
            move_uploaded_file($file_tmp, '../uploads/' . $nama_gambar_baru);

            $query = "INSERT INTO tbl_siswa (nama_siswa, nis, tanggal_masuk, kelas, tempat_lahir, tanggal_lahir, jenis_kelamin, alamat, desa_kelurahan, kecamatan, kab_kota, provinsi, agama, wali_siswa, no_hp_wali, foto_siswa) VALUES ('$nama_siswa', '$nis', '$tanggal_masuk', '$kelas', '$tempat_lahir', '$tanggal_lahir', '$jenis_kelamin', '$alamat', '$desa_kelurahan', '$kecamatan', '$kab_kota', '$provinsi', '$agama', '$wali_siswa', '$no_hp_wali', '$nama_gambar_baru')";
            $result = mysqli_query($conn, $query);

            if (!$result) {
                die("Query gagal dijalankan: " . mysqli_errno($conn) . " - " . mysqli_error($conn));
            } else {
                // Ganti alert dengan set session untuk pesan sukses
                $_SESSION['success_message'] = "Data berhasil ditambah.";
                header("Location: data_siswa.php");
                exit();
            }
        } else {
            echo "<script>alert('Ekstensi gambar yang boleh hanya jpg atau png.');window.location='tambah_siswa.php';</script>";
        }
    } else {
        // Jika tidak ada foto yang diupload
        $query = "INSERT INTO tbl_siswa (nama_siswa, nis, tanggal_masuk, kelas, tempat_lahir, tanggal_lahir, jenis_kelamin, alamat, desa_kelurahan, kecamatan, kab_kota, provinsi, agama, nama_ayah, alamat_ayah, no_hp_ayah, nama_ibu, alamat_ibu, no_hp_ibu, wali_siswa, no_hp_wali) VALUES ('$nama_siswa', '$nis', '$tanggal_masuk', '$kelas', '$tempat_lahir', '$tanggal_lahir', '$jenis_kelamin', '$alamat', '$desa_kelurahan', '$kecamatan', '$kab_kota', '$provinsi', '$agama', '$nama_ayah', '$alamat_ayah', '$no_hp_ayah', '$nama_ibu', '$alamat_ibu', '$no_hp_ibu', '$wali_siswa', '$no_hp_wali')";
        $result = mysqli_query($conn, $query);

        if (!$result) {
            die("Query gagal dijalankan: " . mysqli_errno($conn) . " - " . mysqli_error($conn));
        } else {
            // Ganti alert dengan set session untuk pesan sukses
            $_SESSION['success_message'] = "Data berhasil ditambah.";
            header("Location: data_siswa.php");
            exit();
        }
    }
}

mysqli_close($conn);
