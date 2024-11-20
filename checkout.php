<?php
session_start();
include("../admin/koneksi.php"); // Pastikan koneksi database ada

// Pastikan keranjang tidak kosong
if (!isset($_SESSION['keranjang']) || count($_SESSION['keranjang']) == 0) {
    $_SESSION['message'] = "Keranjang Anda kosong!";
    header('Location: keranjang.php'); // Redirect ke keranjang.php jika kosong
    exit;
}

// Proses Checkout ketika form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $nama_pemesan = $_POST['nama_pemesan'];
    $alamat = $_POST['alamat'];
    $nomor_telepon = $_POST['nomor_telepon'];
    $email = $_POST['email'];

    // Validasi input
    if (empty($nama_pemesan) || empty($alamat) || empty($nomor_telepon) || empty($email)) {
        $_SESSION['message'] = "Semua data harus diisi!";
        header('Location: checkout.php'); // Tampilkan pesan error jika ada input yang kosong
        exit;
    }

    // Simpan data pesanan ke tabel 'orders'
    $sql_order = "INSERT INTO orders (nama_pemesan, alamat, nomor_telepon, email, status) VALUES ('$nama_pemesan', '$alamat', '$nomor_telepon', '$email', 'pending')";
    if ($koneksi->query($sql_order) === TRUE) {
        $order_id = $koneksi->insert_id; // ID pesanan yang baru saja disimpan

        // Simpan detail pesanan ke tabel 'order_items'
        foreach ($_SESSION['keranjang'] as $id_produk => $jumlah) {
            // Ambil harga produk
            $sql_produk = "SELECT harga, nama_produk FROM stock WHERE id = '$id_produk'";
            $result_produk = $koneksi->query($sql_produk);
            $produk = $result_produk->fetch_assoc();
            
            $harga = $produk['harga'];
            $subtotal = $harga * $jumlah;

            // Simpan ke tabel order_items
            $sql_order_items = "INSERT INTO order_items (order_id, produk_id, jumlah, harga, subtotal) VALUES ('$order_id', '$id_produk', '$jumlah', '$harga', '$subtotal')";
            $koneksi->query($sql_order_items);
        }

        // Menghapus keranjang setelah checkout
        unset($_SESSION['keranjang']);
        $_SESSION['message'] = "Pesanan berhasil dibuat! Silakan lanjutkan ke pembayaran.";
        header('Location: sukses.php'); // Redirect ke halaman sukses setelah checkout berhasil
        exit;
    } else {
        $_SESSION['message'] = "Terjadi kesalahan saat memproses pesanan. Coba lagi!";
        header('Location: checkout.php');
        exit;
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
        body {
    background-color: #e9ecef; /* Mengatur warna background utama menjadi putih */
    font-family: Arial, sans-serif;
    color: #333;
}
.container {
    max-width: 800px;
    background-color: #f8f9fa; /* Latar belakang kontainer dengan warna putih cerah */
    padding: 2rem;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
    color: #333;
    margin-top: 3rem;
}
.form-label {
    color: #28a745; /* Mengatur warna label menjadi hijau */
}
.form-control, .form-select {
    border: 2px solid #28a745; /* Mengatur border input menjadi hijau */
    border-radius: 8px;
}
.btn-custom {
    background-color: #28a745; /* Mengatur tombol menjadi hijau */
    color: #fff;
    border-radius: 8px;
    transition: background 0.3s ease;
}
.btn-custom:hover {
    background-color: #218838; /* Warna hijau gelap saat tombol dihover */
}
.list-group-item {
    background-color: #e9ecef; /* Warna background untuk item list */
    border: none;
    border-radius: 5px;
    margin-bottom: 5px;
}
.list-group-item:last-child {
    background-color: #28a745; /* Warna item terakhir hijau */
    color: #fff;
}
h2, h4 {
    color: #28a745; /* Mengatur warna judul menjadi hijau */
    font-weight: bold;
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
<nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top">
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
    
    <span style="margin: 0 4px;"></span>
    
    </div>
  </div>
</nav>

<div class="container">
    <h2 class="text-center mb-4">Checkout</h2>
    <div class="row">
        <div class="col-md-6">
            <h4>Informasi Pengiriman</h4>
            <form method="POST" action="proses_checkout.php">
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" id="name" name="nama_pemesan" placeholder="Nama lengkap Anda" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email Anda" required>
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Alamat</label>
                    <textarea class="form-control" id="address" name="alamat" rows="3" placeholder="Alamat lengkap Anda" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Nomor Telepon</label>
                    <input type="tel" class="form-control" id="phone" name="nomor_telepon" placeholder="Nomor telepon Anda" required oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                </div>
        </div>
        <div class="col-md-6">
            <h4>Rincian Pesanan</h4>
            <ul class="list-group mb-3">
                <?php
                $totalHarga = 0; // Inisialisasi total harga
                if (isset($_SESSION['keranjang']) && count($_SESSION['keranjang']) > 0) {
                    foreach ($_SESSION['keranjang'] as $id_produk => $jumlah) {
                        // Ambil data produk dari database berdasarkan ID
                        $sql = "SELECT * FROM stock WHERE id = '$id_produk'";
                        $result = $koneksi->query($sql);

                        if ($result->num_rows > 0) {
                            $product = $result->fetch_assoc();
                            $namaProduk = $product['nama_produk'];
                            $harga = $product['harga'];
                            $subtotal = $harga * $jumlah;
                            $totalHarga += $subtotal;

                            echo "
                            <li class='list-group-item d-flex justify-content-between align-items-center'>
                                $namaProduk (x$jumlah)
                                <span>Rp " . number_format($subtotal, 0, ',', '.') . "</span>
                            </li>";
                        }
                    }
                } else {
                    echo "<li class='list-group-item text-center'>Keranjang kosong.</li>";
                }
                ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <strong>Total</strong>
                    <strong>Rp <?= number_format($totalHarga, 0, ',', '.'); ?></strong>
                </li>
            </ul>
            <h4>Metode Pembayaran</h4>
            <div class="mb-3">
                <label for="payment" class="form-label">Pilih Metode Pembayaran</label>
                <select class="form-select" id="payment" name="metode_pembayaran" required>
                    <option value="credit_card">Kartu Kredit</option>
                    <option value="bank_transfer">Transfer Bank</option>
                    <option value="cod">Bayar di Tempat (COD)</option>
                </select>
            </div>
            <input type="hidden" name="keranjang" value='<?php echo json_encode($_SESSION['keranjang']); ?>'>
            <div class="d-grid">
                <button type="submit" class="btn btn-custom">Proses Checkout</button>
            </div>
        </div>
    </div>
</div>


    <span style="margin: 0 4px;"></span>

    <!-- Footer HTML -->
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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</body>
</html>