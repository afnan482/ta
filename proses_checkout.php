<?php
session_start();
include('../admin/koneksi.php'); // Pastikan koneksi database sudah benar

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $nama_pemesan = $_POST['nama_pemesan'];
    $email = $_POST['email'];
    $alamat = $_POST['alamat'];
    $nomor_telepon = $_POST['nomor_telepon'];
    $metode_pembayaran = $_POST['metode_pembayaran'];
    $keranjang = json_decode($_POST['keranjang'], true); // Mengambil keranjang dari form

    // Hitung total harga berdasarkan keranjang
    $total_harga = 0;
    foreach ($keranjang as $id_produk => $jumlah) {
        $sql_product = "SELECT harga FROM stock WHERE id = ?";
        $stmt_product = $koneksi->prepare($sql_product);
        $stmt_product->bind_param("i", $id_produk); // Bind parameter untuk id_produk
        $stmt_product->execute();
        $result = $stmt_product->get_result();
        $product = $result->fetch_assoc();
        $total_harga += $product['harga'] * $jumlah;
    }

    // Simpan data customer ke tabel customers
    $sql_customer = "INSERT INTO customers (name, email, phone, address) VALUES (?, ?, ?, ?)";
    $stmt_customer = $koneksi->prepare($sql_customer);
    $stmt_customer->bind_param("ssss", $nama_pemesan, $email, $nomor_telepon, $alamat);
    $stmt_customer->execute();
    $customer_id = $stmt_customer->insert_id;

    // Simpan data pesanan ke tabel orders
    $sql_order = "INSERT INTO orders (customer_id, order_date, total_price, payment_method) VALUES (?, NOW(), ?, ?)";
    $stmt_order = $koneksi->prepare($sql_order);
    $stmt_order->bind_param("ids", $customer_id, $total_harga, $metode_pembayaran);
    $stmt_order->execute();
    $order_id = $stmt_order->insert_id;

    // Simpan data order_items
    foreach ($keranjang as $id_produk => $jumlah) {
        $sql_order_item = "INSERT INTO order_items (order_id, product_name, quantity, price) 
                           VALUES (?, ?, ?, ?)";
        $stmt_order_item = $koneksi->prepare($sql_order_item);
        $stmt_order_item->bind_param("isid", $order_id, $product['name'], $jumlah, $product['harga']);
        $stmt_order_item->execute();
    }

    // Simpan data pesanan di sesi
    $_SESSION['order_id'] = $order_id;
    $_SESSION['nama_pemesan'] = $nama_pemesan;
    $_SESSION['email'] = $email;
    $_SESSION['alamat'] = $alamat;
    $_SESSION['nomor_telepon'] = $nomor_telepon;
    $_SESSION['metode_pembayaran'] = $metode_pembayaran;
    $_SESSION['total_harga'] = $total_harga;

    // Redirect ke halaman sukses checkout
    header("Location: sukses_checkout.php");
    exit;
}
?>
