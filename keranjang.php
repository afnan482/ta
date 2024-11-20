<?php
session_start();
include("../admin/koneksi.php"); // Pastikan koneksi database ada

// Mengupdate jumlah produk di keranjang
if (isset($_POST['update_keranjang'])) {
    $id_produk = $_POST['id_produk'];
    $jumlah = $_POST['jumlah'];

    // Memperbarui jumlah produk dalam keranjang
    if ($jumlah > 0) {
        $_SESSION['keranjang'][$id_produk] = $jumlah;
    } else {
        unset($_SESSION['keranjang'][$id_produk]);
    }

    // Redirect agar halaman ter-refresh
    header('Location: keranjang.php');
    exit;
}

// Menghapus produk dari keranjang
if (isset($_GET['hapus'])) {
    $id_produk = $_GET['hapus'];
    unset($_SESSION['keranjang'][$id_produk]);

    // Redirect agar halaman ter-refresh
    header('Location: keranjang.php');
    exit;
}

// Menampilkan notifikasi jika ada
if (isset($_SESSION['message'])) {
    echo "<div class='alert alert-success text-center' role='alert'>" . $_SESSION['message'] . "</div>";
    unset($_SESSION['message']); // Menghapus pesan setelah ditampilkan
}

// Mengecek apakah ada produk di dalam keranjang
if (isset($_SESSION['keranjang']) && count($_SESSION['keranjang']) > 0) {
    echo "<h3 class='my-4 text-center text-primary'>Keranjang Belanja</h3>";

    // Menampilkan produk yang ada di keranjang
    echo "<div class='table-responsive'>";
    echo "<table class='table table-striped table-bordered table-sm'>";
    echo "<thead class='thead-dark'>
            <tr>
                <th class='text-center'>Gambar</th>
                <th class='text-center'>Nama Produk</th>
                <th class='text-center'>Harga</th>
                <th class='text-center'>Jumlah</th>
                <th class='text-center'>Stok</th> <!-- Kolom stok -->
                <th class='text-center'>Total</th>
                <th class='text-center'>Aksi</th>
            </tr>
          </thead><tbody>";

    $totalHarga = 0; // Variabel untuk menghitung total harga

    foreach ($_SESSION['keranjang'] as $id_produk => $jumlah) {
        // Ambil data produk dari database berdasarkan ID
        $sql = "SELECT * FROM stock WHERE id = '$id_produk'";
        $result = $koneksi->query($sql);

        if ($result->num_rows > 0) {
            $product = $result->fetch_assoc();
            $stok = $product['stok']; // Ambil stok produk
            $subtotal = $product['harga'] * $jumlah; // Menghitung subtotal harga produk
            $totalHarga += $subtotal; // Menambahkan subtotal ke total harga

            echo "<tr class='text-center'>";
            echo "<td><img src='../admin/uploads/" . $product['gambar_produk'] . "' alt='" . $product['nama_produk'] . "' class='img-fluid' style='width: 90px; height: 90px;'></td>"; // Menambahkan gambar produk
            echo "<td>" . $product['nama_produk'] . "</td>";
            echo "<td>Rp " . number_format($product['harga'], 0, ',', '.') . "</td>";
            echo "<td>
                    <form action='keranjang.php' method='POST'>
                        <input type='number' name='jumlah' value='$jumlah' min='1' max='$stok' class='form-control w-50 mx-auto'>
                        <input type='hidden' name='id_produk' value='$id_produk'>
                        <button type='submit' name='update_keranjang' class='btn btn-warning btn-sm mt-2'>Update</button>
                    </form>
                  </td>";
            echo "<td>$stok</td>"; 
            echo "<td>Rp " . number_format($subtotal, 0, ',', '.') . "</td>";
            echo "<td>
                    <a href='keranjang.php?hapus=$id_produk' class='btn btn-danger btn-sm'>Hapus</a>
                  </td>";
            echo "</tr>";
        }
    }

    echo "</tbody></table>";
    echo "</div>";

    // Menampilkan total harga
    echo "<h4 class='text-center text-success'>Total Harga: <strong>Rp " . number_format($totalHarga, 0, ',', '.') . "</strong></h4>";

    // Tombol untuk melanjutkan ke halaman checkout
    echo "<div class='text-center'>
            <a href='checkout.php' class='btn btn-success btn-lg my-4'>Lanjutkan ke Checkout</a>
          </div>";
} else {
    echo "<p class='text-center text-warning'>Keranjang Anda kosong.</p>";
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
            padding-top: 60px;
        }

        .container {
            max-width: 1200px;
            margin-top: 50px;
        }

        .table-responsive {
            padding: 0 15px;
        }

        h3,
        h4 {
            font-family: 'Segoe UI', sans-serif;
            color: #007bff;
        }

        .btn-warning {
            background-color: #ffc107;
        }

        .btn-warning:hover {
            background-color: #e0a800;
        }

        .btn-success {
            background-color: #28a745;
        }

        .btn-success:hover {
            background-color: #218838;
        }

        .alert {
            margin-top: 20px;
        }

        chatgpt-sidebar {
            display: none !important;
            width: 0;
            height: 0;
        }

        chatgpt-sidebar-popups{
            display: none !important;
            width: 0;
            height: 0;
        }

        
    .footer .col {
        transition: transform 0.3s ease;
    }

    .footer .col:hover {
        transform: scale(1.05);
    }

    /* Efek zoom dan bounce untuk ikon media sosial */
    .footer .text-center a {
        display: inline-block;
        color: #bdc3c7;
        transition: transform 0.3s ease;
    }

    /* Efek zoom saat hover */
    .footer .text-center a:hover {
        transform: scale(1.2); /* Zoom in */
    }

    /* Efek bounce untuk ikon saat muncul */
    @keyframes bounceIn {
        0%, 20%, 50%, 80%, 100% {
            transform: translateY(0);
        }
        40% {
            transform: translateY(-10px);
        }
        60% {
            transform: translateY(-5px);
        }
    }

    /* Menambahkan animasi bounce */
    .footer .text-center a {
        animation: bounceIn 1s;
    }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top position-fixed top-0 w-100">
  <div class="container-fluid">
  <img src="../images/sepatu.jpg" alt="Logo" style="height: 40px; margin-right: 10px;">
    <a href="index.php" class="navbar-brand">Afnan Shoes</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="about.php">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="web.php">Our Best Product</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="feedback.php">Feedback</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
    
<footer class="footer" style="background-color: #333; color: #f1f1f1; padding: 40px 0; font-family: Arial, sans-serif;">
    <div class="container-fluid">
        <div class="row">
            <!-- Social Media Links -->
            <div class="col mb-3">
                <h5 style="color: #f1c40f; font-size: 1.4em; margin-bottom: 15px;">Tentang Kami</h5>
                <ul style="list-style: none; padding: 0; display: flex; flex-direction: column;">
                <p style="color: #d3d3d3;">Kami menyediakan berbagai macam sepatu berkualitas dengan harga terjangkau. Kepuasan pelanggan adalah prioritas kami.</p>
                </ul>
            </div>

            <!-- Contact Info -->
            <div class="col mb-4">
                <h5 style="color: #f1c40f; font-size: 1.4em; margin-bottom: 15px;">Contact Us</h5>
                <p style="color: #d3d3d3;">Phone: 081-223-345-067</p>
                <p style="color: #d3d3d3;">Email: <a href="mailto:afnanshoes@gmail.com" style="color: #bdc3c7; text-decoration: none;">afnanshoes@gmail.com</a></p>
            </div>

            <!-- Address -->
            <div class="col mb-4">
                <h5 style="color: #f1c40f; font-size: 1.4em; margin-bottom: 15px;">Address</h5>
                <p style="color: #d3d3d3;">Jl. Kauman Gg 4, Malang, JawaTimur, Indonesia</p>
            </div>

            <div class="col-3 mb-3">
            <h5 style="color: #f1c40f; font-size: 1.4em; margin-bottom: 15px;">Our Location</h5>
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3944.917929496091!2d112.62029951533414!3d-7.982298894256026!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd629b9503c89a3%3A0x3b0b0cf4cf80b5d8!2sJl.%20Kauman%20Gg.%204%2C%20Kauman%2C%20Kec.%20Klojen%2C%20Kota%20Malang%2C%20Jawa%20Timur%2065155%2C%20Indonesia!5e0!3m2!1sen!2sid!4v1601112345678!5m2!1sen!2sid" 
                width="100%" 
                height="200" 
                style="border:0;" 
                allowfullscreen="" 
                loading="lazy">
            </iframe>
        </div>
    </div>
</div>

        <!-- Social Media Icons Row -->
        <div class="text-center mt-4">
            <a href="https://www.instagram.com/" style="color: #bdc3c7; margin: 0 10px; font-size: 1.5em;"><i class="fa-brands fa-instagram"></i></a>
            <a href="https://www.facebook.com/" style="color: #bdc3c7; margin: 0 10px; font-size: 1.5em;"><i class="fa-brands fa-facebook"></i></a>
            <a href="https://www.twitter.com/" style="color: #bdc3c7; margin: 0 10px; font-size: 1.5em;"><i class="fa-brands fa-twitter"></i></a>
            <a href="https://www.tiktok.com/" style="color: #bdc3c7; margin: 0 10px; font-size: 1.5em;"><i class="fa-brands fa-tiktok"></i></a>
            <a href="https://www.linkedin.com/" style="color: #bdc3c7; margin: 0 10px; font-size: 1.5em;"><i class="fa-brands fa-linkedin"></i></a>
        </div>

        <!-- Copyright -->
        <div class="text-center mt-4" style="border-top: 1px solid #555; padding-top: 20px; color: #bdc3c7;">
            <p>© 2024 Your Website Name. All Rights Reserved.</p>
        </div>
    </div>
</footer>

        <!-- Konten keranjang belanja akan muncul di sini -->
    </div>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</body>
</html>