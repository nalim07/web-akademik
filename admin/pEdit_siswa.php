<?php
require_once '../koneksi.php';

if (isset($_POST['edit'])) {
    
    // Edit
    $edit = mysqli_query($conn, "UPDATE siswa_kelasa SET 
    nama_siswa = '{$_POST['nama_siswa']}',
    nis = '{$_POST['nis']}',
    tanggal_masuk = '{$_POST['tanggal_masuk']}',
    kelas = '{$_POST['kelas']}',
    tempat_lahir = '{$_POST['tempat_lahir']}',
    tanggal_lahir = '{$_POST['tanggal_lahir']}',
    jenis_kelamin = '{$_POST['jenis_kelamin']}',
    alamat = '{$_POST['alamat']}',
    desa_kelurahan = '{$_POST['desa_kelurahan']}',
    kecamatan = '{$_POST['kecamatan']}',
    kab_kota = '{$_POST['kab_kota']}',
    provinsi = '{$_POST['provinsi']}',
    agama = '{$_POST['agama']}',
    wali_siswa = '{$_POST['wali_siswa']}',
    no_hp_wali = '{$_POST['no_hp_wali']}'
    WHERE id = '{$_POST['id_siswa']}'");

    // Tambahkan penanganan file yang diunggah di sini
    
    if ($edit) {
        echo "<script>alert('Berhasil diubah'); window.location.href='data_siswa.php';</script>";
    } else {
        echo "<script>alert('Gagal diubah'); window.location.href='data_siswa.php';</script>";
    }
}
?>