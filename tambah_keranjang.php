<?php
session_start();
include("../admin/koneksi.php"); // Pastikan koneksi database ada

// Mengecek apakah ada parameter 'id' di URL
if (isset($_GET['id'])) {
    $id_produk = $_GET['id'];

    // Mengambil data produk dari database berdasarkan ID produk
    $sql = "SELECT * FROM stock WHERE id = '$id_produk'";
    $result = $koneksi->query($sql);

    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();

        // Jika keranjang belum ada, inisialisasi keranjang
        if (!isset($_SESSION['keranjang'])) {
            $_SESSION['keranjang'] = array();
        }

        // Mengecek apakah produk sudah ada di dalam keranjang
        if (isset($_SESSION['keranjang'][$id_produk])) {
            // Jika sudah ada, tambah jumlahnya
            $_SESSION['keranjang'][$id_produk]++;
        } else {
            // Jika belum ada, tambahkan produk dengan jumlah 1
            $_SESSION['keranjang'][$id_produk] = 1;
        }

        // Menyimpan pesan notifikasi di session
        $_SESSION['message'] = "Produk " . $product['nama_produk'] . " telah ditambahkan ke keranjang.";

        // Redirect ke halaman keranjang setelah menambah produk
        header('Location: keranjang.php');
        exit;
    } else {
        echo "Produk tidak ditemukan.";
    }
} else {
    echo "ID produk tidak valid.";
}
?>
