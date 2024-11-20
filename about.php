<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="custom.css">
    <style>

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.about-header, .about-content h3, .about-content p, .about-content ul {
    animation: fadeIn 1s ease-in-out;
    animation-fill-mode: forwards;
    opacity: 0;
}

.about-header {
    animation-delay: 0.3s;
}

.about-content h3 {
    animation-delay: 0.5s;
}

.about-content p, .about-content ul {
    animation-delay: 0.7s;
}

        body {
            background-color: #f8f9fa;
        }
        .about-section {
            padding: 60px 0;
        }
        .about-header {
            text-align: center;
            margin-bottom: 40px;
        }
        .about-header h1 {
            font-size: 2.5rem;
            font-weight: bold;
        }
        .about-content {
            text-align: justify;
        }

        
    .footer .col {
        transition: transform 0.3s ease;
    }

    .footer .col:hover {
        transform: scale(1.05);
    }

    /* Efek zoom dan bounce untuk ikon media sosial */
    .footer .text-center a {
        display: inline-block;
        color: #bdc3c7;
        transition: transform 0.3s ease;
    }

    /* Efek zoom saat hover */
    .footer .text-center a:hover {
        transform: scale(1.2); /* Zoom in */
    }

    /* Efek bounce untuk ikon saat muncul */
    @keyframes bounceIn {
        0%, 20%, 50%, 80%, 100% {
            transform: translateY(0);
        }
        40% {
            transform: translateY(-10px);
        }
        60% {
            transform: translateY(-5px);
        }
    }

    /* Menambahkan animasi bounce */
    .footer .text-center a {
        animation: bounceIn 1s;
    }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top">
  <div class="container-fluid">
  <img src="../images/sepatu.jpg" alt="Logo" style="height: 40px; margin-right: 10px;">
    <a href="index.php" class="navbar-brand">Afnan Shoes</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="about.php">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="web.php">Our Best Product</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="feedback.php">Feedback</a>
        </li>
        
      </ul>
    
    <span style="margin: 0 4px;"></span>
    
    </div>
  </div>
</nav>

<div class="container about-section">
    <div class="about-header">
        <h1>Tentang Kami</h1>
        <p>Sumber terpercaya Anda untuk alas kaki berkualitas.</p>
    </div>
    <div class="about-content">
        <h3>Siapa Kami</h3>
        <p>
            Afnan Shoes adalah pengecer terkemuka dalam sepatu berkualitas, berkomitmen untuk menyediakan pilihan sepatu terbaik dengan harga bersaing. Misi kami adalah meningkatkan pengalaman berbelanja dengan menawarkan produk berkualitas tinggi dan layanan pelanggan yang luar biasa.
        </p>

        <h3>Visi Kami</h3>
        <p>
            Visi kami adalah menjadi tujuan utama bagi para pecinta alas kaki dengan terus meningkatkan ragam produk dan layanan kami untuk memenuhi kebutuhan pelanggan yang selalu berkembang.
        </p>

        <h3>Nilai-Nilai Kami</h3>
        <ul>
            <li>Kualitas: Kami percaya dalam menawarkan produk terbaik.</li>
            <li>Kepuasan Pelanggan: Pelanggan adalah prioritas utama kami.</li>
            <li>Inovasi: Kami merangkul perubahan dan mencari cara baru untuk berkembang.</li>
            <li>Integritas: Kami menjalankan bisnis dengan kejujuran dan transparansi.</li>
        </ul>

        <h3>Hubungi Kami</h3>
        <p>Jika Anda memiliki pertanyaan atau permintaan, jangan ragu untuk menghubungi kami di <a href="mailto:info@afnanshoes.com">info@afnanshoes.com</a>.</p>
    </div>
</div>


    <span style="margin: 0 4px;"></span>

    <!-- Footer HTML -->
<footer class="footer" style="background-color: #333; color: #f1f1f1; padding: 40px 0; font-family: Arial, sans-serif;">
    <div class="container-fluid">
        <div class="row">
            <!-- Social Media Links -->
            <div class="col mb-3">
                <h5 style="color: #f1c40f; font-size: 1.4em; margin-bottom: 15px;">Tentang Kami</h5>
                <ul style="list-style: none; padding: 0; display: flex; flex-direction: column;">
                <p style="color: #d3d3d3;">Kami menyediakan berbagai macam sepatu berkualitas dengan harga terjangkau. Kepuasan pelanggan adalah prioritas kami.</p>
                </ul>
            </div>

            <!-- Contact Info -->
            <div class="col mb-4">
                <h5 style="color: #f1c40f; font-size: 1.4em; margin-bottom: 15px;">Contact Us</h5>
                <p style="color: #d3d3d3;">Phone: 081-223-345-067</p>
                <p style="color: #d3d3d3;">Email: <a href="mailto:afnanshoes@gmail.com" style="color: #bdc3c7; text-decoration: none;">afnanshoes@gmail.com</a></p>
            </div>

            <!-- Address -->
            <div class="col mb-4">
                <h5 style="color: #f1c40f; font-size: 1.4em; margin-bottom: 15px;">Address</h5>
                <p style="color: #d3d3d3;">Jl. Kauman Gg 4, Malang, JawaTimur, Indonesia</p>
            </div>

            <div class="col-3 mb-3">
            <h5 style="color: #f1c40f; font-size: 1.4em; margin-bottom: 15px;">Our Location</h5>
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3944.917929496091!2d112.62029951533414!3d-7.982298894256026!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd629b9503c89a3%3A0x3b0b0cf4cf80b5d8!2sJl.%20Kauman%20Gg.%204%2C%20Kauman%2C%20Kec.%20Klojen%2C%20Kota%20Malang%2C%20Jawa%20Timur%2065155%2C%20Indonesia!5e0!3m2!1sen!2sid!4v1601112345678!5m2!1sen!2sid" 
                width="100%" 
                height="200" 
                style="border:0;" 
                allowfullscreen="" 
                loading="lazy">
            </iframe>
        </div>
    </div>
</div>

        <!-- Social Media Icons Row -->
        <div class="text-center mt-4">
            <a href="https://www.instagram.com/" style="color: #bdc3c7; margin: 0 10px; font-size: 1.5em;"><i class="fa-brands fa-instagram"></i></a>
            <a href="https://www.facebook.com/" style="color: #bdc3c7; margin: 0 10px; font-size: 1.5em;"><i class="fa-brands fa-facebook"></i></a>
            <a href="https://www.twitter.com/" style="color: #bdc3c7; margin: 0 10px; font-size: 1.5em;"><i class="fa-brands fa-twitter"></i></a>
            <a href="https://www.tiktok.com/" style="color: #bdc3c7; margin: 0 10px; font-size: 1.5em;"><i class="fa-brands fa-tiktok"></i></a>
            <a href="https://www.linkedin.com/" style="color: #bdc3c7; margin: 0 10px; font-size: 1.5em;"><i class="fa-brands fa-linkedin"></i></a>
        </div>

        <!-- Copyright -->
        <div class="text-center mt-4" style="border-top: 1px solid #555; padding-top: 20px; color: #bdc3c7;">
            <p>© 2024 Your Website Name. All Rights Reserved.</p>
        </div>
    </div>
</footer>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</body>
</html>
