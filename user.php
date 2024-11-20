<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "percobaan";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Menghitung total login
$sql = "SELECT COUNT(*) as total_logins FROM logins";
$result = $conn->query($sql);
$total_logins = 0;

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $total_logins = $row['total_logins'];
}

// Menghitung total feedback
$feedback_sql = "SELECT COUNT(*) as total_feedback FROM feedback";
$feedback_result = $conn->query($feedback_sql);
$total_feedback = 0;

if ($feedback_result->num_rows > 0) {
    $row = $feedback_result->fetch_assoc();
    $total_feedback = $row['total_feedback'];
}

// Menghitung total produk
$product_sql = "SELECT COUNT(*) as total_products FROM stock"; // Sesuaikan nama tabel dan kolom
$product_result = $conn->query($product_sql);
$total_products = 0;

if ($product_result->num_rows > 0) {
    $row = $product_result->fetch_assoc();
    $total_products = $row['total_products'];
}

// Menghitung jumlah total pengguna
$result = $conn->query("SELECT COUNT(*) as total_users FROM user");
$row = $result->fetch_assoc();
$totalUsers = $row['total_users'];

// Query untuk mengambil data pengguna
$users_result = $conn->query("SELECT * FROM user");

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Admin Dashboard - Afnan Shoes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet" />
    <style>
    .card-custom {
        background-color: #4e73df;
        color: white;
        border-radius: 10px;
    }
    .navbar-brand, .sb-sidenav-footer, .nav-link, .sb-nav-link-icon {
        color: white;
    }
    .nav-link.active {
        background-color: transparent; /* Menghilangkan warna latar belakang aktif */
        color: white; /* Pastikan teks tetap putih */
        border-radius: 5px;
    }
    .navbar-dark .navbar-nav .nav-link:hover {
        color: #a8a9b1;
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
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
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
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
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
                        <a class="nav-link" href="home.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
                            Home
                        </a>
                        <a class="nav-link" href="stock.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-archive"></i></div>
                            Tambah Barang
                        </a>
                        <a class="nav-link" href="masuk.php">
                            <div class="sb-nav-link-icon"><i class="fa fa-box-open"></i></div>
                            Barang Masuk
                        </a>
                        <a class="nav-link" href="pembayaran.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-credit-card"></i></div>
                            Pembayaran
                        </a>
                        <a class="nav-link" href="total_pengguna.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                            Total Pengguna
                        </a>
                        <a class="nav-link" href="feedback.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-comment"></i></div>
                            Feedback
                        </a>
                        <a class="nav-link" href="user.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                            User
                        </a>
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
            <h1 class="mt-4">Admin User</h1>
            <div class="row mt-4">
                <!-- Kartu-kartu informasi -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card card-custom shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col me-2">
                                    <div class="text-xs font-weight-bold text-uppercase mb-1">Total User Logins</div>
                                    <div class="h5 mb-0 font-weight-bold text-white">
                                        <?php echo $total_logins; ?>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-users fa-2x text-white"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <a href="masuk.php" class="card-link">
                        <div class="card card-custom shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col me-2">
                                        <div class="text-xs font-weight-bold text-uppercase mb-1">Total Products</div>
                                        <div class="h5 mb-0 font-weight-bold text-white">
                                            <?php echo $total_products; ?>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-box fa-2x text-white"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <a href="total_pengguna.php" class="card-link">
                        <div class="card card-custom shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col me-2">
                                        <div class="text-xs font-weight-bold text-uppercase mb-1">Total Pengguna</div>
                                        <div class="h5 mb-0 font-weight-bold text-white">
                                            <?php echo $totalUsers; ?>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-user fa-2x text-white"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <a href="feedback.php" class="card-link">
                        <div class="card card-custom shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col me-2">
                                        <div class="text-xs font-weight-bold text-uppercase mb-1">Total feedback</div>
                                        <div class="h5 mb-0 font-weight-bold text-white">
                                            <?php echo $total_feedback; ?>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-comments fa-2x text-white"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Tambahkan kartu lainnya sesuai kebutuhan -->
            </div>
        </div>
    </main>

    <!-- Footer -->
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


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
