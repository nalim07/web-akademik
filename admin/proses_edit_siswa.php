<?php
require_once '../koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data yang dikirim melalui form
    $id_siswa = $_POST['id_siswa'];
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
    $foto_siswa = $_FILES['foto_siswa']['name'];

    $uploadOk = 1;

    // Upload foto_siswa jika ada file yang diunggah
    if (!empty($foto_siswa)) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["foto_siswa"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["foto_siswa"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["foto_siswa"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            if (!move_uploaded_file($_FILES["foto_siswa"]["tmp_name"], $target_file)) {
                echo "Sorry, there was an error uploading your file.";
                $uploadOk = 0;
            }
        }
    }

    // Prepare an update statement
    if ($uploadOk == 1) {
        $stmt = $conn->prepare("UPDATE siswa_kelasa SET 
            nama_siswa = ?, nis = ?, tanggal_masuk = ?, kelas = ?, tempat_lahir = ?, tanggal_lahir = ?, jenis_kelamin = ?, 
            alamat = ?, desa_kelurahan = ?, kecamatan = ?, kab_kota = ?, provinsi = ?, agama = ?, wali_siswa = ?, 
            no_hp_wali = ?, foto_siswa = ? WHERE id = ?");

        // Bind variables to the prepared statement as parameters
        $stmt->bind_param(
            "ssssssssssssssssi",
            $nama_siswa,
            $nis,
            $tanggal_masuk,
            $kelas,
            $tempat_lahir,
            $tanggal_lahir,
            $jenis_kelamin,
            $alamat,
            $desa_kelurahan,
            $kecamatan,
            $kab_kota,
            $provinsi,
            $agama,
            $wali_siswa,
            $no_hp_wali,
            $foto_siswa,
            $id_siswa
        );
    } else {
        $stmt = $conn->prepare("UPDATE siswa_kelasa SET 
            nama_siswa = ?, nis = ?, tanggal_masuk = ?, kelas = ?, tempat_lahir = ?, tanggal_lahir = ?, jenis_kelamin = ?, 
            alamat = ?, desa_kelurahan = ?, kecamatan = ?, kab_kota = ?, provinsi = ?, agama = ?, wali_siswa = ?, 
            no_hp_wali = ? WHERE id = ?");

        // Bind variables to the prepared statement as parameters
        $stmt->bind_param(
            "sssssssssssssssi",
            $nama_siswa,
            $nis,
            $tanggal_masuk,
            $kelas,
            $tempat_lahir,
            $tanggal_lahir,
            $jenis_kelamin,
            $alamat,
            $desa_kelurahan,
            $kecamatan,
            $kab_kota,
            $provinsi,
            $agama,
            $wali_siswa,
            $no_hp_wali,
            $id_siswa
        );
    }

    // Attempt to execute the prepared statement
    if ($stmt->execute()) {
        // Jika berhasil disimpan, redirect ke halaman data siswa
        header("location: data_siswa.php");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement
    $stmt->close();

    // Tutup koneksi database
    mysqli_close($conn);
}
