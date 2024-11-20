<?php
session_start();
include("../User/config.php");

// Menghitung jumlah total pengguna
$result = $conn->query("SELECT COUNT(*) as total_users FROM user");
$row = $result->fetch_assoc();
$totalUsers = $row['total_users'];

// Query untuk mengambil data pengguna
$users_result = $conn->query("SELECT * FROM user");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Admin - CRUD Total Pengguna</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    
    <style>
        .logo {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 5px;
            vertical-align: middle;
        }
        .table-container {
            max-height: 400px; /* Membatasi tinggi tabel */
            overflow-y: auto; /* Menambahkan scroll vertikal */
        }
        /* Footer positioning */
        .sb-sidenav-footer {
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>

</head>
<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-2" href="#">
            <img src="../images/sepatu.jpg" alt="Afnan Shoes Logo" class="logo">
            Afnan Shoes
        </a>
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle"><i class="fas fa-bars"></i></button>
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
                        <a class="nav-link" href="home.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
                            Home
                        </a>
                        <a class="nav-link" href="stock.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-archive"></i></div>
                            Tambah Barang
                        </a>
                        <a class="nav-link" href="masuk.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-box-open"></i></div>
                            Barang Masuk
                        </a>
                        <a class="nav-link" href="pembayaran.php">
                            <div class="sb-nav-link-icon"><i class="fa fa-credit-card"></i></div>
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
                        <i class="fas fa-user-circle fa-2x me-2"></i>
                        <div>
                            <div class="small text-muted">Logged in as:</div>
                            <div class="fw-bold text-warning">JualBeliSepatu</div>
                        </div>
                    </div>
                </div>
            </nav>
        </div>

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-3">Total Pengguna</h1>
                    <div class="container mt-5">
                        
                        <!-- Menampilkan jumlah total pengguna -->
                        <div class="alert alert-info mt-3" role="alert">
                            Total Pengguna Terdaftar: <?php echo $totalUsers; ?>
                        </div>

                        <h4 class="mt-4">Daftar Pengguna</h4>
                        <div class="table-container">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Username</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    while ($user = $users_result->fetch_assoc()) {
                                        echo "<tr>
                                                <td>{$no}</td>
                                                <td>{$user['name']}</td>
                                                <td>{$user['email']}</td>
                                                <td>{$user['username']}</td>
                                                <td>
                                                    <a href='?id={$user['id']}' class='btn btn-warning btn-sm'>Edit</a>
                                                    <a href='?id={$user['id']}' class='btn btn-danger btn-sm'>Hapus</a>
                                                </td>
                                            </tr>";
                                        $no++;
                                    }
                                    ?>
                                </tbody>
                            </table>
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
                            <a href="#">Terms & Conditions</a>
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
