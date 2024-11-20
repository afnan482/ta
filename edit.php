<?php
include 'koneksi.php'; 

$id = $_GET['id'];

// Ambil data produk berdasarkan ID
$sql = "SELECT * FROM stock WHERE id=$id";
$result = $koneksi->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    echo "Produk tidak ditemukan.";
    exit; // Menghentikan eksekusi jika produk tidak ditemukan
}

if (isset($_POST['update'])) {
    $nama_produk = $_POST['nama_produk'];
    $deskripsi = $_POST['deskripsi'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    // Cek jika ada gambar baru yang diunggah
    if ($_FILES['gambar_produk']['error'] == UPLOAD_ERR_OK) {
        // Path untuk menyimpan gambar yang diunggah
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES['gambar_produk']['name']);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Cek apakah gambar adalah gambar sebenarnya
        $check = getimagesize($_FILES['gambar_produk']['tmp_name']);
        if ($check === false) {
            echo "File yang diunggah bukan gambar.";
            $uploadOk = 0;
        }

        // Cek ukuran file (misalnya, batas 5MB)
        if ($_FILES['gambar_produk']['size'] > 5000000) {
            echo "Maaf, ukuran file terlalu besar.";
            $uploadOk = 0;
        }

        // Cek jika $uploadOk diatur ke 0 karena ada kesalahan
        if ($uploadOk == 0) {
            echo "Maaf, file tidak dapat diunggah.";
        } else {
            // Coba unggah file
            if (move_uploaded_file($_FILES['gambar_produk']['tmp_name'], $target_file)) {
                $gambar_produk = basename($_FILES['gambar_produk']['name']); // Simpan hanya nama file
            } else {
                echo "Terjadi kesalahan saat mengunggah file.";
                $gambar_produk = $row['gambar_produk']; // Gunakan gambar lama jika gagal
            }
        }
    } else {
        // Jika tidak ada gambar baru yang diunggah, gunakan gambar lama
        $gambar_produk = $row['gambar_produk'];
    }

    // Update query dengan gambar baru (jika ada) atau gambar lama
    $sql_update = "UPDATE stock SET nama_produk='$nama_produk', deskripsi='$deskripsi', harga='$harga', stok='$stok', gambar_produk='$gambar_produk' WHERE id=$id";

    if ($koneksi->query($sql_update) === TRUE) {
        echo "<script>alert('Data berhasil diupdate!'); window.location='masuk.php';</script>";
    } else {
        echo "Error: " . $sql_update . "<br>" . $koneksi->error;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Edit Produk</title>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Edit Produk</h2>
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="nama_produk" class="form-label">Nama Produk:</label>
                <input type="text" id="nama_produk" name="nama_produk" class="form-control" value="<?php echo htmlspecialchars($row['nama_produk']); ?>" required>
            </div>

            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi:</label>
                <input type="text" id="deskripsi" name="deskripsi" class="form-control" value="<?php echo htmlspecialchars($row['deskripsi']); ?>" required>
            </div>

            <div class="mb-3">
                <label for="harga" class="form-label">Harga:</label>
                <input type="number" id="harga" name="harga" class="form-control" value="<?php echo htmlspecialchars($row['harga']); ?>" required>
            </div>

            <div class="mb-3">
                <label for="stok" class="form-label">Stok:</label>
                <input type="number" id="stok" name="stok" class="form-control" value="<?php echo htmlspecialchars($row['stok']); ?>" required>
            </div>

            <div class="mb-3">
                <label for="gambar_produk" class="form-label">Gambar Produk:</label>
                <input type="file" id="gambar_produk" name="gambar_produk" class="form-control">
            </div>

            <!-- Menampilkan gambar produk yang ada saat ini -->
            <div class="mb-3">
                <?php if (!empty($row['gambar_produk']) && file_exists('uploads/' . $row['gambar_produk'])): ?>
                    <img src="uploads/<?php echo htmlspecialchars($row['gambar_produk']); ?>" alt="Gambar Produk" class="img-fluid" style="max-width: 200px;">
                <?php else: ?>
                    <p>Gambar produk tidak tersedia.</p>
                <?php endif; ?>
            </div>

            <button type="submit" name="update" class="btn btn-primary mb-3">Update</button>
            <a href="masuk.php" class="btn btn-secondary mb-3">Batal</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
