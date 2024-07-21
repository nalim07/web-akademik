<?php
require_once '../koneksi.php';
session_start();

if (!isset($_SESSION["sslogin"])) {
    header("location: ../auth/login.php");
    exit;
}

$title = "Tambah Guru";
require_once 'template_admin/header.php';
require_once 'template_admin/navbar.php';

?>



<?php
require_once 'template_admin/footer.php';
?>
