<?php
require_once '../koneksi.php';
require_once 'logging.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Periksa apakah id_siswa ada dalam $_POST
    if (!isset($_POST['id_siswa'])) {
        echo json_encode(['status' => 'error', 'message' => 'ID siswa tidak ditemukan.']);
        exit;
    }

    // Ambil semua data dari form
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

    // Persiapkan pernyataan update
    $stmt = $conn->prepare("UPDATE tbl_siswa SET 
        nama_siswa = ?, nis = ?, tanggal_masuk = ?, kelas = ?, tempat_lahir = ?, tanggal_lahir = ?, jenis_kelamin = ?, 
        alamat = ?, desa_kelurahan = ?, kecamatan = ?, kab_kota = ?, provinsi = ?, agama = ?, wali_siswa = ?, 
        no_hp_wali = ? WHERE id = ?");

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

    // Coba eksekusi pernyataan yang telah disiapkan
    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Tidak ada perubahan data']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Gagal mengupdate data: ' . $stmt->error]);
    }

    // Tutup statement
    $stmt->close();

    // Setelah proses update
    $check_query = "SELECT * FROM tbl_siswa WHERE id = ?";
    $check_stmt = $conn->prepare($check_query);
    $check_stmt->bind_param("i", $id_siswa);
    $check_stmt->execute();
    $result = $check_stmt->get_result();
    $updated_data = $result->fetch_assoc();

    logMessage("Data setelah update: " . print_r($updated_data, true));

    $check_stmt->close();
}

// Tutup koneksi database
mysqli_close($conn);
