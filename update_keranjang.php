<?php
session_start(); // Memulai session untuk menyimpan data keranjang

// Pastikan koneksi ke database sudah benar
include("../admin/koneksi.php");

// Cek apakah ada produk dan jumlah yang ingin diperbarui
if (isset($_GET['id']) && isset($_GET['jumlah'])) {
    $produk_id = $_GET['id'];
    $jumlah = $_GET['jumlah'];

    // Perbarui jumlah produk di keranjang
    if ($jumlah > 0) {
        $_SESSION['keranjang'][$produk_id] = $jumlah;
    } else {
        unset($_SESSION['keranjang'][$produk_id]);
    }

    // Redirect kembali ke halaman keranjang setelah update
    header("Location: keranjang.php");
    exit();
}
?>
