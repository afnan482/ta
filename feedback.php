<?php
// admin_feedback.php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "percobaan";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Menangani penghapusan feedback
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];

    // Menghapus feedback berdasarkan ID
    $delete_sql = "DELETE FROM feedback WHERE id = ?";
    $stmt = $conn->prepare($delete_sql);
    $stmt->bind_param("i", $delete_id);

    if ($stmt->execute()) {
        echo "<script>alert('Feedback berhasil dihapus'); window.location.href='admin_feedback.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus feedback'); window.location.href='admin_feedback.php';</script>";
    }

    $stmt->close();
}

$sql = "SELECT id, nama, message, created_at FROM feedback ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Feedback</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <style>
        body {
            background-color: #f8f9fc;
        }
        .feedback-card {
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }
        .feedback-header {
            background-color: #4e73df;
            color: white;
            padding: 15px 20px;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
            font-weight: bold;
        }
        .table-hover tbody tr:hover {
            background-color: #f1f3f8;
        }
        
        .logo {
        width: 40px; /* Sesuaikan ukuran logo */
        height: 40px; /* Sesuaikan ukuran logo */
        border-radius: 50%; /* Membuat gambar berbentuk bulat */
        object-fit: cover; /* Agar gambar tidak terdistorsi */
        margin-right: 5px; /* Kurangi jarak antara logo dan teks */
        vertical-align: middle; /* Menyelaraskan logo dengan teks */
    }
        </style>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand ps-2" href="#">
            <img src="../images/sepatu.jpg" alt="Afnan Shoes Logo" class="logo">
            Afnan Shoes
        </a>
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="profil.php">Profil</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Admin</div>
                            <a class="nav-link" href="home.php"><div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>Home</a>
                            <a class="nav-link" href="stock.php"><div class="sb-nav-link-icon"><i class="fas fa-archive"></i></div>Tambah Barang</a>
                            <a class="nav-link" href="masuk.php"><div class="sb-nav-link-icon"><i class="fa fa-box-open" aria-hidden="true"></i></div>Barang Masuk</a>
                            <a class="nav-link" href="pembayaran.php"><div class="sb-nav-link-icon"><i class="fas fa-credit-card"></i></div>Pembayaran</a>
                            <a class="nav-link" href="total_pengguna.php"><div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>Total Pengguna</a>
                            <a class="nav-link" href="feedback.php"><div class="sb-nav-link-icon"><i class="fas fa-comment"></i></div>Feedback</a>
                            <a class="nav-link" href="user.php"><div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>User</a>
                            <a class="nav-link" id="logout-link" href="../login/login.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-sign-out-alt"></i></div>
                                Log Out
                            </a>

                            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                            <script>
                            document.getElementById("logout-link").addEventListener("click", function(event) {
                                event.preventDefault(); // Mencegah aksi klik biasa
                                Swal.fire({
                                title: "Are you sure?",
                                text: "You won't be able to revert this!",
                                icon: "warning",
                                showCancelButton: true,
                                confirmButtonColor: "#3085d6",
                                cancelButtonColor: "#d33",
                                confirmButtonText: "Yes, log out!"
                                }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = "../login/login.php"; // Arahkan ke halaman login jika konfirmasi
                                }
                                });
                            });
                            </script>

                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                <div class="d-flex align-items-center">
                    <!-- Ikon untuk menunjukkan status login -->
                    <i class="fas fa-user-circle fa-2x me-2"></i>
                    <div>
                        <div class="small text-muted">Logged in as:</div>
                        <div class="fw-bold text-warning">JualBeliSepatu</div>
                    </div>
                </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Feedback</h1>
                        <div class="container my-4">
                            <h2 class="text-center">Admin Dashboard - Feedback Pengguna</h2>
                            <div class="card feedback-card mt-4">
                                <div class="feedback-header">Feedback Pengguna</div>
                                <div class="card-body">
                                    <?php if ($result->num_rows > 0): ?>
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th scope="col">No</th>
                                                    <th scope="col">Nama</th>
                                                    <th scope="col">Feedback</th>
                                                    <th scope="col">Tanggal</th>
                                                    <th scope="col">Aksi</th> <!-- Menambahkan kolom Aksi -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                $no = 1;
                                                while ($row = $result->fetch_assoc()): ?>
                                                    <tr>
                                                        <td><?php echo $no++; ?></td>
                                                        <td><?php echo htmlspecialchars($row['nama']); ?></td>
                                                        <td><?php echo htmlspecialchars($row['message']); ?></td>
                                                        <td><?php echo htmlspecialchars($row['created_at']); ?></td>
                                                        <td>
                                                            <!-- Tombol Hapus -->
                                                            <a href="delete_feedback.php?delete_id=<?php echo $row['id']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus feedback ini?');" class="btn btn-danger btn-sm">Hapus</a>
                                                        </td>
                                                    </tr>
                                                <?php endwhile; ?>
                                            </tbody>
                                        </table>
                                    <?php else: ?>
                                        <p class="text-muted text-center">Tidak ada feedback yang tersedia.</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2024</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
<?php $conn->close(); ?>
