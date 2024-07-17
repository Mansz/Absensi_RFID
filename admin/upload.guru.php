<?php
include '../config.php';


// Ambil data dari form dengan pemeriksaan
$username = isset($_POST['username']) ? $_POST['username'] : '';
$jabatan = isset($_POST['jabatan']) ? $_POST['jabatan'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';
$foto = isset($_FILES['foto']['name']) ? $_FILES['foto']['name'] : '';

// Direktori tujuan untuk menyimpan foto
$target_dir = "../foto/";
$target_file = $target_dir . basename($foto);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Periksa apakah file adalah gambar
if (!empty($foto)) {
    $check = getimagesize($_FILES["foto"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "<div class='alert alert-danger'>File bukan gambar.</div>";
        $uploadOk = 0;
    }

    // Batasi jenis file yang diperbolehkan
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "<div class='alert alert-danger'>Hanya file JPG, JPEG, PNG, dan GIF yang diperbolehkan.</div>";
        $uploadOk = 0;
    }

    // Periksa apakah $uploadOk adalah 0 karena error
    if ($uploadOk == 0) {
        echo "<div class='alert alert-danger'>File tidak diunggah.</div>";
    } else {
        if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
            // Simpan data ke database
            $sql = "INSERT INTO guru (username, jabatan, foto, password) VALUES ('$username','$jabatan', '$foto', '$password')";
            if ($conn->query($sql) === TRUE) {
                // Alihkan ke halaman datasiswa.php setelah berhasil menambahkan data
        header("Location: dataguru.php");
        exit();
            } else {
                echo "<div class='alert alert-danger'>Error: " . $sql . "<br>" . $conn->error . "</div>";
            }
        } else {
            echo "<div class='alert alert-danger'>Terjadi kesalahan saat mengunggah file.</div>";
        }
    }
} 

$conn->close();


?>