<?php
include '../admin/koneksi.php';

// Periksa apakah ID produk ada di URL
if (isset($_GET['id'])) {
    $product_id = (int) $_GET['id']; // Pastikan ID dalam format integer untuk keamanan

    // Query untuk mengambil data produk berdasarkan ID
    $sql = "SELECT * FROM stock WHERE id = $product_id";
    $result = $koneksi->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Bersihkan data untuk mencegah XSS
        $nama_produk = htmlspecialchars($row['nama_produk']);
        $deskripsi = htmlspecialchars($row['deskripsi']);
        $harga = number_format($row['harga'], 2, ',', '.');
        $stok = (int) $row['stok'];
        $gambar_produk = htmlspecialchars($row['gambar_produk']);
    } else {
        echo "<p class='text-center'>Produk tidak ditemukan.</p>";
        exit;
    }
} else {
    echo "<p class='text-center'>ID produk tidak diberikan.</p>";
    exit;
}

$koneksi->close();
?>

<!DOCTYPE html>
  <html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Product Page - Buy Shoes</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>

      <!-- Navigation Bar -->
      <nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top">
    <div class="container-fluid">
    <img src="../images/sepatu.jpg" alt="Logo" style="height: 30px; margin-right: 10px;">
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

      <!-- Product Section -->
      <div class="container my-5">
          <div class="row">
              <div class="col-md-6">
                  <!-- Product Image -->
                  <img src="../admin/uploads/<?= $gambar_produk; ?>" class="img-fluid" alt="<?= $nama_produk; ?>">
              </div>
  
              <div class="col-md-6">
                  <!-- Product Info -->
                  <h2><?= $nama_produk; ?></h2>
                  <p><strong>Harga:</strong> Rp <?= $harga; ?></p>
                  <p><strong>Deskripsi:</strong> <?= $deskripsi; ?></p>
                  <p><strong>Stok Tersedia:</strong> <?= $stok; ?></p>

                <form method="POST" action="tambah_keranjang.php">
                    <input type="hidden" name="id_produk" value="<?= $product_id; ?>">
                    <div class="mb-3">
                        <label for="jumlah" class="form-label">Jumlah</label>
                        <input type="number" name="jumlah" id="jumlah" class="form-control" value="1" min="1" max="<?= $stok; ?>" required>
                    </div>

                  <div class="d-flex justify-content-between">
                      <button class="btn btn-primary" style="width: 48%;">Add To Cart</button>
                      <button class="btn btn-success" style="width: 48%;" formaction="buy_now.php">Buy Now</button>

                  </div>
              </div>
          </div>

          <!-- Product Description -->
          <div class="mt-5">
              <h5>Product Description</h5>
              <p>This Nike Air Max is designed for comfort and style, perfect for running or casual wear. With advanced cushioning technology, it provides excellent support during workouts or everyday use.</p>
          </div>

          <!-- Product Reviews -->
          <div class="mt-4">
              <h5>Customer Reviews</h5>
              <div class="border p-3 mb-2">
                  <p><strong>John Doe</strong> - 5/5</p>
                  <p>These shoes are amazing! They are comfortable and look great.</p>
              </div>
              <div class="border p-3 mb-2">
                  <p><strong>Jane Smith</strong> - 4/5</p>
                  <p>Good quality shoes, but a bit tight around the toe area. Overall satisfied.</p>
              </div>
              <button class="btn btn-outline-primary mt-2">Write a Review</button>
          </div>
      </div>

      <!-- Footer -->
      <footer class="bg-light text-center py-3">
          <p>&copy; 2024 Shoes Store | All Rights Reserved</p>
      </footer>

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
  </html>