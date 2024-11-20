<?php
session_start();

// Memeriksa apakah ada ID produk yang ingin dihapus
if (isset($_GET['id'])) {
    $id_produk = $_GET['id'];

    // Menghapus produk dari keranjang
    if (isset($_SESSION['keranjang'][$id_produk])) {
        unset($_SESSION['keranjang'][$id_produk]);
    }
}

// Redirect kembali ke halaman keranjang
header("Location: keranjang.php");
exit;
?>
