<?php
session_start();
include '../admin/koneksi.php'; // File koneksi ke database

// Inisialisasi keranjang jika belum ada
if (!isset($_SESSION['keranjang'])) {
    $_SESSION['keranjang'] = [];
}

// Query untuk mengambil data produk dari tabel stock
$sql = "SELECT * FROM stock WHERE stok > 0"; // Hanya menampilkan produk dengan stok > 0
$result = $koneksi->query($sql);

if (!$result) {
    die("Error dalam query: " . $koneksi->error);
}

// Menghitung jumlah item dalam keranjang
$keranjang_count = array_sum(array_column($_SESSION['keranjang'], 'quantity'));
?>



<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Web Akhir</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
    <div class="container-fluid">
      <img src="../images/sepatu.jpg" alt="Logo" style="height: 40px; margin-right: 10px;">
      <a href="profil.php" class="navbar-brand">Afnan Shoes</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" 
              aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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

        <a href="keranjang.php" class="btn btn-outline-dark position-relative">
          <i class="bi bi-cart2"></i>
          <?php if ($keranjang_count > 0): ?>
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
              <?php echo $keranjang_count; ?>
            </span>
          <?php endif; ?>
        </a>

        <span style="margin: 0 4px;"></span>

        <form class="d-flex" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
        <span style="margin: 0 4px;"></span>
<a href="../login/logout.php" id="logout-btn" class="btn btn-primary text-light">
    <i class="fa-solid fa-arrow-right-from-bracket"></i> Logout
</a>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  document.getElementById("logout-btn").addEventListener("click", function(event) {
    event.preventDefault(); // Mencegah aksi klik biasa
    Swal.fire({
      title: "Are you sure?",
      text: "Apakah Kamu Ingin Logout!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, log out!"
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = "../login/logout.php"; // Arahkan ke halaman logout jika konfirmasi
      }
    });
  });
</script>

      </div>
    </div>
  </nav>
  
  <style>

    
    
  /* Efek hover pada card */
  .card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    overflow: hidden; /* Mencegah card meluap keluar */
  }

  /* Saat card di-hover */
  .card:hover {
      transform: scale(1.05); /* Perbesar ukuran card */
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2); /* Tambahkan bayangan */
  }
  
    /* Atur ukuran maksimal carousel */
    #carouselExampleCaptions {
      max-width: 2000px;
      /* Atur lebar maksimal sesuai keinginan */
      margin: 0 auto;
      /* Agar carousel tetap berada di tengah */
    }

    /* Atur tinggi maksimal gambar di dalam carousel */
    #carouselExampleCaptions img {
      max-height: 680px;
      /* Atur tinggi maksimal gambar sesuai keinginan */
      object-fit: cover;
      /* Memastikan gambar terisi penuh di dalam kotak tanpa meregang */
    }

    .carousel-caption {
      bottom: 20px;
      /* Sesuaikan posisi caption lebih rendah dari default */
    }

    .card-img-top {
      width: 100%;
      height: 250px;
      object-fit: cover;
    }

     /* Animasi pada ikon media sosial */
     .text-center a {
        transition: color 0.3s ease, transform 0.3s ease;
    }

    .text-center a:hover {
        color: #f1c40f;
        transform: scale(1.2);
    }

    /* Animasi modal fade-in dan slide */
    .modal.fade .modal-dialog {
        transform: translateY(-50px);
        opacity: 0;
        transition: all 0.5s ease-in-out;
    }

    .modal.fade.show .modal-dialog {
        transform: translateY(0);
        opacity: 1;
    }

    /* Animasi skala pada kolom informasi footer */
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

  <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="../images/boots-1638873.jpg" class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block">
          <h5>Welcome to Jual Beli Sepatu</h5>
          <a href="#" class="btn btn-warning">Get Started</a>
          <p>Some representative placeholder content for the first slide.</p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="../images/boot.jpg" class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block">
          <h5 class="text-light">Welcome to Jual Beli Sepatu</h5>
          <a href="#" class="btn btn-warning">Get Started</a>
          <p class="text-light">Some representative placeholder content for the second slide.</p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="../images/boots-1853964_640.jpg" class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block">
          <h5>Welcome to Jual Beli Sepatu</h5>
          <a href="#" class="btn btn-warning">Get Started</a>
          <p>Some representative placeholder content for the third slide.</p>
        </div>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>

  <div class="container-fluid my-4">
    <div class="row row-cols-2 row-cols-md-3 g-4">
      <?php
      include("../admin/koneksi.php");
      $sql = "SELECT id, nama_produk, deskripsi, harga, stok, gambar_produk FROM stock";
      $result = $koneksi->query($sql);

      if ($result->num_rows > 0) {
        // Looping data dan menampilkannya
        while ($row = $result->fetch_assoc()) {
          echo '
            <div class="col">
                <div class="card h-100">
                    <img src="../admin/uploads/' . htmlspecialchars($row['gambar_produk']) . '" class="card-img-top" alt="Produk Sepatu">
                    <div class="card-body">
                        <h5 class="card-title">' . htmlspecialchars($row['nama_produk']) . '</h5>
                        <p class="card-text">' . htmlspecialchars($row['deskripsi']) . '</p>
                        <p class="card-text"><strong>Harga:</strong> Rp ' . number_format($row['harga'], 0, ',', '.') . '</p> <!-- Menambahkan harga -->
                        <p class="card-text"><strong>Stock:</strong> ' . htmlspecialchars($row['stok']) . '</p> <!-- Menambahkan stok -->
                        <a href="payment.php?id=' . urlencode($row['id']) . '" class="btn btn-primary">Buy
                        </a>
                        <a href="tambah_keranjang.php?id=' . urlencode($row['id']) . '" class="btn btn-success">
                            <i class="bi bi-cart-plus"></i>
                        </a>
                        <!-- Tombol Info yang memicu Modal -->
                        <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#productModal" 
                                data-nama="' . htmlspecialchars($row['nama_produk']) . '" 
                                data-deskripsi="' . htmlspecialchars($row['deskripsi']) . '" 
                                data-harga="' . number_format($row['harga'], 0, ',', '.') . '" 
                                data-stok="' . htmlspecialchars($row['stok']) . '" 
                                data-gambar="../admin/uploads/' . htmlspecialchars($row['gambar_produk']) . '">
                            <i class="fas fa-info-circle"></i>
                        </button>
                    </div>
                </div>
            </div>
            ';
        }
      } else {
        echo "<div class='col'><p>Tidak ada produk ditemukan</p></div>";
      }
      ?>
    </div>
  </div>

    <!-- Footer HTML -->
<footer class="footer" style="background-color: #333; color: #f1f1f1; padding: 40px 0; font-family: Arial, sans-serif;">
    <div class="container-fluid">
        <div class="row">
            <!-- Tentang Kami -->
            <div class="col mb-3">
                <h5 style="color: #f1c40f; font-size: 1.4em; margin-bottom: 15px;">Tentang Kami</h5>
                <p style="color: #d3d3d3;">Kami menyediakan berbagai macam sepatu berkualitas dengan harga terjangkau. Kepuasan pelanggan adalah prioritas kami.</p>
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
                <p style="color: #d3d3d3;">Jl. Kauman Gg 4, Malang, Jawa Timur, Indonesia</p>
            </div>

            <!-- Our Location -->
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

<!-- Modal untuk Info Produk -->
<div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productModalLabel">Nama Produk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <img id="modalImage" src="" alt="Produk Sepatu" class="img-fluid">
                    </div>
                    <div class="col-md-6">
                        <p id="modalDescription">Deskripsi Produk</p>
                        <p><strong>Harga:</strong> Rp <span id="modalPrice">0</span></p>
                        <p><strong>Stock:</strong> <span id="modalStock">0</span></p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<script>
// JavaScript untuk Mengisi Data Modal
var productModal = document.getElementById('productModal');
productModal.addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget;
    var nama = button.getAttribute('data-nama');
    var deskripsi = button.getAttribute('data-deskripsi');
    var harga = button.getAttribute('data-harga');
    var stok = button.getAttribute('data-stok');
    var gambar = button.getAttribute('data-gambar');

    var modalTitle = productModal.querySelector('.modal-title');
    var modalImage = productModal.querySelector('#modalImage');
    var modalDescription = productModal.querySelector('#modalDescription');
    var modalPrice = productModal.querySelector('#modalPrice');
    var modalStock = productModal.querySelector('#modalStock');

    modalTitle.textContent = nama;
    modalDescription.textContent = deskripsi;
    modalPrice.textContent = harga;
    modalStock.textContent = stok;
    modalImage.src = gambar;
    modalImage.alt = nama;
});
</script>
</body>
</html>
