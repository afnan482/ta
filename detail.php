<?php
// Koneksi ke database
include 'koneksi.php';

// Cek apakah ada ID produk yang dikirim
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk mendapatkan data produk berdasarkan ID
    $sql = "SELECT * FROM stock WHERE id = $id";
    $result = $koneksi->query($sql);

    if ($result->num_rows > 0) {
        // Mengambil data produk
        $row = $result->fetch_assoc();
    } else {
        echo "Produk tidak ditemukan.";
        exit;
    }
} else {
    echo "ID produk tidak ada.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Detail Produk</h2>
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <td><?php echo $row['id']; ?></td>
        </tr>
        <tr>
            <th>Nama Produk</th>
            <td><?php echo $row['nama_produk']; ?></td>
        </tr>
        <tr>
            <th>Deskripsi</th>
            <td><?php echo $row['deskripsi']; ?></td>
        </tr>
        <tr>
            <th>Harga</th>
            <td><?php echo $row['harga']; ?></td>
        </tr>
        <tr>
            <th>Stok</th>
            <td><?php echo $row['stok']; ?></td>
        </tr>
        <tr>
            <th>Gambar Produk</th>
            <td>
            <img src="uploads/<?php echo $row['gambar_produk']; ?>" alt="Produk Gambar" style="width: 200px; height: auto;">
            </td>
        </tr>
    </table>
    <a href="masuk.php" class="btn btn-secondary">Kembali</a>
</div>
</body>
</html>
