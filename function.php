<?php

function uploadFotoSiswa($file)
{
    $target_dir = "public/uploads/";
    $target_file = $target_dir . basename($file["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($file["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($file["size"] > 50000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        echo "Sorry, only JPG, JPEG, PNG files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($file["tmp_name"], $target_file)) {
            return $target_file;
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
    return null;
}

function tampilkanFotoSiswa($fotoPath)
{
    if ($fotoPath) {
        echo '<img src="' . BASE_URL . $fotoPath . '" class="img-fluid rounded" alt="Foto Siswa">';
    } else {
        echo '<img src="' . BASE_URL . 'default.jpg" class="img-fluid rounded" alt="Foto Siswa">';
    }
}

function editFotoSiswa($id_siswa, $file)
{
    global $conn;
    $result = [
        'success' => false,
        'message' => ''
    ];

    $fotoPath = uploadFotoSiswa($file);
    if ($fotoPath) {
        $query = "UPDATE tbl_siswa SET foto_siswa = ? WHERE id = ?";
        $stmt = mysqli_prepare($conn, $query);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "si", $fotoPath, $id_siswa);
            if (mysqli_stmt_execute($stmt)) {
                $result['success'] = true;
                $result['message'] = "Foto siswa berhasil diperbarui.";
            } else {
                $result['message'] = "Error saat memperbarui foto: " . mysqli_stmt_error($stmt);
            }
            mysqli_stmt_close($stmt);
        } else {
            $result['message'] = "Error saat menyiapkan query: " . mysqli_error($conn);
        }
    } else {
        $result['message'] = "Gagal mengunggah foto.";
    }

    return $result;
}
