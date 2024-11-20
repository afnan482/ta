<?php
session_start();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Sukses</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center mt-5">Terima Kasih atas Pesanan Anda!</h2>
        <p class="text-center">Pesanan Anda telah berhasil diproses.</p>

        <div class="row justify-content-center mt-4">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4>Rincian Pesanan</h4>
                    </div>
                    <div class="card-body">
                        <?php
                        if (isset($_SESSION['order_id'], $_SESSION['nama_pemesan'], $_SESSION['email'], 
                                  $_SESSION['alamat'], $_SESSION['nomor_telepon'], $_SESSION['metode_pembayaran'], $_SESSION['total_harga'])):
                        ?>
                            <p><strong>ID Pesanan:</strong> <?php echo $_SESSION['order_id']; ?></p>
                            <p><strong>Nama Pemesan:</strong> <?php echo $_SESSION['nama_pemesan']; ?></p>
                            <p><strong>Email:</strong> <?php echo $_SESSION['email']; ?></p>
                            <p><strong>Alamat Pengiriman:</strong> <?php echo $_SESSION['alamat']; ?></p>
                            <p><strong>Nomor Telepon:</strong> <?php echo $_SESSION['nomor_telepon']; ?></p>
                            <p><strong>Metode Pembayaran:</strong> <?php echo $_SESSION['metode_pembayaran']; ?></p>
                            <p><strong>Total Harga:</strong> Rp <?php echo number_format($_SESSION['total_harga'], 0, ',', '.'); ?></p>
                        <?php else: ?>
                            <p>Data pesanan tidak ditemukan.</p>
                        <?php endif; ?>
                    </div>
                    <div class="card-footer text-center">
                        <a href="index.php" class="btn btn-primary">Kembali ke Halaman Utama</a>
                        <button class="btn btn-success no-print" onclick="window.print();">Cetak Nota</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
