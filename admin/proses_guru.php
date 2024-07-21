<?php
require_once '../koneksi.php';

require_once 'template/header.php';
require_once 'template/navbar.php';
session_start();

if (!isset($_SESSION["sslogin"])) {
    header("location: ../auth/login.php");
    exit;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM tbl_guru WHERE id = '$id'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $guru = mysqli_fetch_assoc($result);
        // Lakukan sesuatu dengan data guru
    } else {
        echo "Data guru tidak ditemukan.";
    }
} else {
    echo "ID guru tidak ditemukan.";
}
?>



<?php
require_once '../template/footer.php';
?>
