<?php
include '../koneksi.php';
session_start();
//sesi ketika login
if (!isset($_SESSION["sslogin"])) {
    header("location: ../auth/login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['action']) && $_GET['action'] == 'delete') {
    $id = $_GET['id'];
    $query = "DELETE FROM tbl_ta WHERE id='$id'";
    if (mysqli_query($conn, $query)) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
    header("Location: tahun_ajaran.php");
    exit;
}

