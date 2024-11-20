<?php
// Include file koneksi
include 'koneksi.php';

// Cek apakah parameter id tersedia di URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk menghapus data berdasarkan id
    $sql = "DELETE FROM stock WHERE id=$id";

    if ($koneksi->query($sql) === TRUE) {
        echo "<script>alert('Data berhasil dihapus');</script>";
    } else {
        echo "<script>alert('Gagal menghapus data');</script>";
    }

    // Redirect kembali ke halaman sebelumnya setelah penghapusan
    echo "<script>window.location.href = 'masuk.php';</script>";
}
?>
