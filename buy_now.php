<?php
session_start();
include '../admin/koneksi.php'; // Pastikan koneksi database benar

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_produk'], $_POST['jumlah'])) {
    $id_produk = (int)$_POST['id_produk'];
    $jumlah = (int)$_POST['jumlah'];

    // Validasi input jumlah
    if ($jumlah <= 0) {
        $_SESSION['message'] = "Jumlah pembelian tidak valid.";
        header("Location: product.php?id=$id_produk");
        exit;
    }

    // Ambil data produk dari database
    $sql = "SELECT * FROM stock WHERE id = ?";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("i", $id_produk);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
        $stok = $product['stok'];
        $harga = $product['harga'];
        $nama_produk = $product['nama_produk'];

        // Periksa stok
        if ($jumlah > $stok) {
            $_SESSION['message'] = "Stok tidak mencukupi untuk jumlah pembelian.";
            header("Location: product.php?id=$id_produk");
            exit;
        }

        // Kurangi stok produk
        $stok_baru = $stok - $jumlah;
        $update_stok_sql = "UPDATE stock SET stok = ? WHERE id = ?";
        $update_stok_stmt = $koneksi->prepare($update_stok_sql);
        $update_stok_stmt->bind_param("ii", $stok_baru, $id_produk);
        $update_stok_stmt->execute();

        // Buat data pesanan di tabel `orders`
        $order_sql = "INSERT INTO orders (customer_id, order_date, total) VALUES (?, NOW(), ?)";
        $order_stmt = $koneksi->prepare($order_sql);

        // Asumsi `customer_id` berasal dari session user yang login
        $customer_id = $_SESSION['user_id'] ?? 0; // Ganti dengan sistem autentikasi Anda
        $total = $jumlah * $harga;

        $order_stmt->bind_param("id", $customer_id, $total);
        $order_stmt->execute();
        $order_id = $koneksi->insert_id; // Ambil ID pesanan yang baru

        // Tambahkan item pesanan ke tabel `order_items`
        $item_sql = "INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)";
        $item_stmt = $koneksi->prepare($item_sql);
        $item_stmt->bind_param("iiid", $order_id, $id_produk, $jumlah, $harga);
        $item_stmt->execute();

        // Redirect ke halaman sukses
        $_SESSION['message'] = "Pesanan berhasil dibuat untuk $jumlah x $nama_produk.";
        header("Location: order_success.php");
        exit;
    } else {
        $_SESSION['message'] = "Produk tidak ditemukan.";
        header("Location: index.php");
        exit;
    }
} else {
    $_SESSION['message'] = "Permintaan tidak valid.";
    header("Location: index.php");
    exit;
}
?>
