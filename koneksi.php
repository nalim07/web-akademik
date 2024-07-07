<?php

$servername = "localhost";
$username = "root";
$password = "";
$db_name = "db_sekolah";

// Membuat koneksi
$conn = mysqli_connect($servername, $username, $password, $db_name);
    if (mysqli_connect_error()){
        die("koneksi Gagal karena". mysqli_connect_error());
    }

mysqli_select_db($conn, $db_name);

define('BASE_URL', 'http://localhost/web_akademik/');  