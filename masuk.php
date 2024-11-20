<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Barang Masuk</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <style>
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
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-2" href="#">
            <img src="../images/sepatu.jpg" alt="Afnan Shoes Logo" class="logo">
            Afnan Shoes
            </a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            
            </form>
            <!-- Navbar-->
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
                                <div class="sb-nav-link-icon"><i class="fa fa-credit-card" aria-hidden="true"></i></div>
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
                        <h1 class="mt-4">Shoe Stock Management</h1>
                        
                        <div class="card mb-4">
                            <div class="card-header">
                            <form class="d-flex" role="search">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                                <button class="btn btn-outline-success" type="submit">Search</button>
                            </form>
                            </div>
                            <div class="container mt-3">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Product Name</th>
                                                <th>Brand</th>
                                                <th>Price</th>
                                                <th>Stock</th>
                                                <th>Picture</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                    <tbody>
                                    <tbody>
                                        <?php
                                        include 'koneksi.php';
                                        $sql = "SELECT id, nama_produk, deskripsi, harga, gambar_produk, stok FROM stock";
                                        $result = $koneksi->query($sql);

                                        if ($result->num_rows > 0) {
                                            $no = 1; // Tambahkan counter untuk nomor urut
                                            // Looping data dan menampilkannya ke tabel
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<tr>";
                                                echo "<td>" . $no . "</td>"; // Gunakan counter untuk nomor urut
                                                echo "<td>" . $row['nama_produk'] . "</td>";
                                                echo "<td>" . $row['deskripsi'] . "</td>";
                                                echo "<td>" . $row['harga'] . "</td>";
                                                echo "<td>" . $row['stok'] . "</td>";
                                                echo "<td>";
                                                if (!empty($row['gambar_produk'])) {
                                                    echo "<img src='uploads/" . $row['gambar_produk'] . "' width='100' alt='Gambar Produk'>";
                                                } else {
                                                    echo "<img src='path/to/default_image.png' width='100' alt='Gambar Tidak Tersedia'>"; // Ganti dengan path gambar default jika diperlukan
                                                }
                                                echo "</td>";

                                                echo "<td>
                                                    <a href='edit.php?id=" . $row['id'] . "' class='btn btn-warning'>Edit</a>
                                                    <a href='delete.php?id=" . $row['id'] . "' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\")' class='btn btn-danger'>Hapus</a>
                                                    <a href='detail.php?id=" . $row['id'] . "' class='btn btn-primary'>Detail</a>
                                                    </td>";
                                                echo "</tr>";
                                                $no++; // Increment counter setiap kali loop berjalan
                                            }
                                        } else {
                                            echo "<tr><td colspan='6'>Tidak ada produk ditemukan</td></tr>";
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
                            <img src="" class="img-fl" alt="" srcset="">
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>
