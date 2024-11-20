<?php

if (isset($_GET['delete_id'])) {
    
    $delete_id = $_GET['delete_id'];

    // Koneksi database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "percobaan";

    // Membuat koneksi
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Mengecek koneksi
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    // Query untuk menghapus feedback
    $delete_sql = "DELETE FROM feedback WHERE id = ?";
    
    // Persiapkan statement SQL
    if ($stmt = $conn->prepare($delete_sql)) {
        // Bind parameter ID yang diterima dari URL
        $stmt->bind_param("i", $delete_id);
        
        // Jalankan query dan cek hasilnya
        if ($stmt->execute()) {
            // Jika berhasil, tampilkan pesan sukses dan kembali ke halaman feedback
            echo "<script>alert('Feedback berhasil dihapus'); window.location.href='feedback.php';</script>";
        } else {
            // Jika gagal, tampilkan pesan error
            echo "<script>alert('Gagal menghapus feedback'); window.location.href='feedback.php';</script>";
        }

        // Menutup statement
        $stmt->close();
    } else {
        // Jika query tidak bisa dipersiapkan, tampilkan error
        echo "<script>alert('Terjadi kesalahan dalam query!'); window.location.href='feedback.php';</script>";
    }

    // Menutup koneksi
    $conn->close();
}
?>
