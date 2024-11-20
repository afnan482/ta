<?php
include 'koneksi.php';  // Memanggil koneksi database

// Debug: Memastikan bahwa data telah diterima
echo "<br>";

// Cek apakah semua input sudah diisi
if (isset($_POST['nama_produk'], $_POST['deskripsi'], $_POST['harga'], $_POST['stok'], $_FILES['gambar_produk'])) {
    // Menangkap data dari form
    $nama_produk = $_POST['nama_produk'];
    $deskripsi = $_POST['deskripsi'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    
    // Proses upload gambar
    $gambar_produk = $_FILES['gambar_produk']['name'];
    $target_dir = "uploads/"; // Direktori untuk menyimpan file gambar
    $target_file = $target_dir . basename($gambar_produk);
    
    // Cek apakah file berhasil diunggah
    if (move_uploaded_file($_FILES['gambar_produk']['tmp_name'], $target_file)) {
        // Query untuk menyimpan data ke database
        $sql = "INSERT INTO stock (gambar_produk, nama_produk, deskripsi, harga, stok) 
                VALUES ('$gambar_produk', '$nama_produk', '$deskripsi', '$harga', '$stok')";

        // Eksekusi query
        if (mysqli_query($koneksi, $sql)) { 
            // Menampilkan SweetAlert jika data berhasil disimpan
            echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
            echo "<script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Data berhasil disimpan!',
                        text: 'Produk baru berhasil ditambahkan.',
                    }).then(function() {
                        window.location.href = 'stock.php'; // Redirect setelah alert
                    });
                  </script>";
        } else {
            echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
            echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal menyimpan data!',
                        text: 'Terjadi kesalahan dalam menyimpan produk.',
                    });
                  </script>";
        }

    } else {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Upload gambar gagal!',
                    text: 'Terjadi masalah saat mengunggah gambar produk.',
                });
              </script>";
    }
} else {
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
    echo "<script>
            Swal.fire({
                icon: 'warning',
                title: 'Form belum lengkap!',
                text: 'Harap isi semua input sebelum mengirim.',
            });
          </script>";
}

mysqli_close($koneksi);  // Menutup koneksi
?>
