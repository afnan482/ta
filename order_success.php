<?php
session_start();
$message = $_SESSION['message'] ?? "Transaksi selesai.";
unset($_SESSION['message']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Success</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-5">
        <div class="alert alert-success text-center">
            <h4><?= htmlspecialchars($message); ?></h4>
            <a href="index.php" class="btn btn-primary mt-3">Kembali ke Produk</a>
        </div>
    </div>
</body>
</html>
