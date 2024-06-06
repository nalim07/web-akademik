<?php
require "koneksi.php";
if (isset($_POST["submit"])) {
    $nip = $_POST["nip"];
    $namaGuru = $_POST["namaGuru"];
    $tanggalLahir = $_POST["tanggalLahir"];
    $jenisKelamin = $_POST["jenisKelamin"];
    $alamat = $_POST["alamat"];
    $agama = $_POST["agama"];

    $sql = "INSERT INTO tbl_guru (nip, namaGuru, tanggalLahir, jenisKelamin, alamat, agama)
    VALUES ('$nip','$namaGuru','$tanggalLahir','$jenisKelamin','$alamat','$agama')";
    $query = mysqli_query($conn, $sql);

    if ($query) {
        echo "<script>
                alert('Data Berhasil ditambahkan!');
                document.location.href = 'index.php';
            </script>";
    } else {
        echo "<script>
        alert('Data gagal ditambahkan!');
        document.location.href = 'index.php';
    </script>" . mysqli_error($conn);
    }
}
