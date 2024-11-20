<?php
// submit_feedback.php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "percobaan";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Proses kirim feedback
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $komentar = $_POST['komentar'];

    $sql = "INSERT INTO feedback (nama, message) VALUES ('$nama', '$komentar')";
    
    if ($conn->query($sql) === TRUE) {
        echo "<br>";
        // Feedback berhasil dikirim, tampilkan SweetAlert
        echo "
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Feedback berhasil dikirim!',
                    showConfirmButton: false,
                    timer: 1500
                }).then(function() {
                    window.location = 'feedback.php'; // Redirect ke halaman feedback setelah alert
                });
            </script>
        ";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        // Jika ada kesalahan, tampilkan alert error
        echo "
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Terjadi kesalahan saat mengirim feedback!',
                }).then(function() {
                    window.location = 'feedback.php'; // Redirect ke halaman feedback setelah error
                });
            </script>
        ";
    }
}
