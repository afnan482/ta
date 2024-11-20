<?php
session_start();
include("../admin/koneksi.php"); // Koneksi database

if (isset($_GET['id_order'])) {
    $id_order = $_GET['id_order'];

    // Ambil data order
    $sql_order = "SELECT * FROM orders WHERE id = '$id_order'";
    $result = $koneksi->query($sql_order);
    $order = $result->fetch_assoc();

    // Ambil data customer
    $sql_customer = "SELECT * FROM customers WHERE id = '{$order['id_customer']}'";
    $result_customer = $koneksi->query($sql_customer);
    $customer = $result_customer->fetch_assoc();

    // Ambil detail pesanan
    $sql_order_items = "SELECT * FROM order_items WHERE id_order = '$id_order'";
    $result_order_items = $koneksi->query($sql_order_items);
} else {
    echo "<script>alert('Pesanan tidak ditemukan!'); window.location = 'index.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota Pesanan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2>Nota Pesanan</h2>
    <p><strong>Nama:</strong> <?= $customer['nama']; ?></p>
    <p><strong>Alamat:</strong> <?= $customer['alamat']; ?></p>
