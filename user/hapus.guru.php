<?php
// Include file konfigurasi database
include "../config.php";

// Pastikan id guru yang akan dihapus diterima dari parameter URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query SQL untuk hapus data guru berdasarkan id
    $sql = "DELETE FROM guru WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        // Alihkan ke halaman dataguru.php setelah berhasil menghapus data
        header("Location: dataguru.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    // Menutup koneksi database
    mysqli_close($conn);
} else {
    echo "ID tidak ditemukan.";
    exit();
}
?>
