<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Beranda</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />


    <!-- Font Awesome -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="../../aset/logocetak.in.png" width="200" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav gap-3 align-items-center">

                    <li class="nav-item">
                        <a class="nav-link active" href="index.php">Beranda</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="product.php">Produk</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="kontak.html">Kontak</a>
                    </li>

                    <!-- AUTH -->
                    <?php if (!isset($_SESSION['user_logged_in'])): ?>

                    <!-- BELUM LOGIN -->
                    <li class="nav-item">
                        <a class="btn btn-outline-primary" href="../auth/login.php">
                            Login
                        </a>
                    </li>

                    <?php else: ?>

                    <!-- SUDAH LOGIN -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle fw-semibold" href="#" role="button"
                            data-bs-toggle="dropdown">
                            <?= htmlspecialchars($_SESSION['user_name']) ?>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <form action="/UAS_SO/controller/AuthController.php" method="POST">
                                    <input type="hidden" name="action" value="logout">
                                    <button type="submit" class="dropdown-item text-danger">
                                        Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>

                    <?php endif; ?>

                </ul>
            </div>

        </div>
    </nav>

    <!-- HERO -->
    <section class="container-fluid p-0">
        <div id="heroMainCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner hero-main">

                <div class="carousel-item active">
                    <img src="../../aset/1.png" class="d-block w-100" alt="">
                </div>

                <div class="carousel-item">
                    <img src="../../aset/2.png" class="d-block w-100" alt="">
                </div>
                <div class="carousel-item">
                    <img src="../../aset/3.png" class="d-block w-100" alt="">
                </div>
                <div class="carousel-item">
                    <img src="../../aset/4.png" class="d-block w-100" alt="">
                </div>
                <div class="carousel-item">
                    <img src="../../aset/5.png" class="d-block w-100" alt="">
                </div>

            </div>
        </div>
    </section>

    <!--Cetak.in-->
    <div class="container my-5">
        <h4 style="color: #0266AE; font-weight: bold; font-size: 35px;" class="title pb-3 text-center">Cetak.in Digital
            Printing
        </h4>
        <p style="opacity: 70%;" class="text-center"> Solusi cetak inovatif untuk mewujudkan ide kreatif Anda. Kami
            telah mencetak berbagai model dan desain produk. mulai dari Brosur Promosi, Iklan Banner/Spanduk, Buku
            Undangan Pernikahan, Sticker kemasan, dan
            yang lainnya. Teruslah berkarya dan kami akan membantu mewujudkannya, terima kasih telah memilih Cetak.in
            Digital
            Printing!
        </p>
    </div>

    <div class="container my-5">
        <h4 style="color: #0266AE; font-weight: bold; font-size: 35px;" class="title pb-3 text-center">Layanan Kami!
        </h4>
        <p style="opacity: 70%;" class="text-center"> Percetakan terdepan untuk kebutuhan promosi produk custom
            Anda, mulai dari Brosur Promosi, Iklan Banner/Spanduk, Buku Undangan Pernikahan, Sticker kemasan, dan
            yang lainnya. Kami menyediakan jasa Cetak produk Anda jumlah satuan sampai ribuan. Cetak.in Digital
            Printing dipercaya Berbagai Pemilik Bisnis, Perusahaan dan Individu.
        </p>
    </div>
    <?php
require_once '../../database/connection.php';
require_once '../../model/Product.php';

$productModel = new Product($pdo);
$products = $productModel->getAll();
?>
    <div class="container my-5">
        <h4 class="title pb-3 text-center">Produk Kami</h4>

        <div class="row g-4">

            <?php foreach ($products as $p): ?>
            <?php if ($p['is_available']): ?>
            <div class="col-12 col-sm-6 col-lg-3">

                <div class="product-card h-100">

                    <!-- IMAGE -->
                    <div class="image-box">
                        <div class="img-zoom-container">
                            <img src="<?= htmlspecialchars($p['gambar']) ?>" class="img-fluid product-image"
                                alt="<?= htmlspecialchars($p['nama_produk']) ?>">
                        </div>
                    </div>

                    <div class="p-3">
                        <h6 class="product-title">
                            <?= htmlspecialchars($p['nama_produk']) ?>
                        </h6>

                        <p class="product-price">
                            Rp <?= number_format($p['harga'], 0, ',', '.') ?>
                        </p>

                        <?php if ($p['stok_produk'] > 0): ?>
                        <a href="detail_produk.php?id=<?= $p['id'] ?>" class="btn btn-primary w-100">
                            <i class="bi bi-cart-plus"></i> Pesan
                        </a>
                        <?php else: ?>
                        <button class="btn btn-danger w-100" disabled>
                            ✖ Habis
                        </button>
                        <?php endif; ?>
                    </div>

                </div>
            </div>
            <?php endif; ?>
            <?php endforeach; ?>

        </div>
    </div>

    <section class="testimonials py-5">
        <div class="container">
            <h2 class="text-center mb-5">Testimoni Pelanggan Kami</h2>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <img src="../../aset/bahlil.jpeg" alt="Client 1" class="rounded-circle me-3">
                                <div>
                                    <h6 class="mb-0">Bahlil</h6>
                                    <small>CEO, Company ABC</small>
                                </div>
                            </div>
                            <p class="card-text">"Bagus banget hasil cetakan di sini, sesuai pesanan dan desain
                                yang
                                dikirim, warnanya bagus, yang paling penting adalah adminnya sangat-sangat
                                ramah,
                                fast
                                respon, dan selalu konfirmasi jika ada kendala, sangat memuaskan, terima kasih."
                            </p>
                            <div class="d-flex gap-4 card-image">
                                <img src="../../aset/testi_brosur.jpg" alt="">
                                <img src="../../aset/testi_b2.jpg" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <img src="../../aset/verel.png" alt="Client 1" class="rounded-circle me-3">
                                <div>
                                    <h6 class="mb-0">Verrel</h6>
                                    <small>Anggota DPR</small>
                                </div>
                            </div>
                            <p class="card-text">"Pelayanan Baik. Hasil bagus. Langganan bikin sticker disini."
                            </p>
                            <div class="d-flex gap-4 card-image">
                                <img src="../../aset/tes.sticker1.jpg" alt="">
                                <img src="../../aset/tes.sticker2.jpg" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <img src="../../aset/jokowi.jpg" alt="Client 1" class="rounded-circle me-3">
                                <div>
                                    <h6 class="mb-0">Jokowi</h6>
                                    <small>Pria Solo</small>
                                </div>
                            </div>
                            <p class="card-text">"Bagus jelas cetakan Banner nya, warnanya sesuai desain yang
                                dibuat
                                dan
                                tidak buram, saya puas dan bakal cetak lagi di Percetakan Cetak.in digital
                                printing
                                ini."</p>
                            <div class="d-flex gap-4 card-image">
                                <img src="../../aset/tes.banner1.jpg" alt="">
                                <img src="../../aset/tes.banner2.jpg" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- KONTAK -->
    <section class="container py-5">
        <h4 class="title pb-3 text-center">Kontak Kami</h4>
        <div class="row">
            <div class="col-md-6 mb-4">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3958.2577936229563!2d107.1450042747552!3d-6.822659995018909!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e683f3e2f6f4d7b%3A0x8e4e4f4e4e4e4e4e!2sCetak.in57!5e0!3m2!1sen!2sid!4v1701301234567!5m2!1sen!2sid"
                    class="w-100 rounded" height="400" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>

            <div class="col-md-6">
                <ul class="list-unstyled">
                    <li><i class="fas fa-map-marker-alt me-2"></i>Jl. KH. Saleh No.57 A Pabuaran, Cianjur</li>
                    <li class="mt-2"><i class="fas fa-phone me-2"></i>+6285643351736</li>
                    <li class="mt-2"><i class="fab fa-instagram me-2"></i>@cetak.in57</li>
                    <li class="mt-2"><i class="fas fa-envelope me-2"></i>cetak.in57@gmail.com</li>
                </ul>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="#0266AE text-white py-5">
        <div class="container text-center text-md-start">
            <div class="mb-4 text-center">
                <img src="../../aset/logo2.png" class="img-fluid" alt="">
            </div>
            <div class="row g-4 d-md-flex justify-content-around">

                <div class="col-md-3">
                    <h5>Tentang Kami</h5>
                    <p>Kami hadir sebagai mitra terpercaya
                        yang responsif, fleksibel, dan
                        profesional. Kami tidak sekedar
                        mencetak, tetapi membantu klien
                        menemukan pilihan terbaik — dari
                        banner, x-banner, sticker, dan juga
                        brosur promosi.</p>
                </div>

                <div class="col-md-3">
                    <h5>Jam Operasional</h5>
                    <p>Senin–Jumat: 08.00–20.00<br>Sabtu–Minggu: 08.00–17.00</p>
                </div>

                <div class="col-md-3">
                    <h5>Lokasi Kami</h5>
                    <p>Jl. KH. Saleh <br>
                        No.57 A <br>
                        Pabuaran, Kec.Cianjur <br>
                        Kab.Cianjur</p>
                </div>

                <div class="col-md-3">
                    <h5>Kontak</h5>
                    <p>cetak.in57@gmail.com<br>+6285643351736</p>
                </div>
            </div>
        </div>
    </footer>

    <div class="text-center py-3 bg-light text-black">
        &copy; 2026 My Cetak.In. All rights reserved.
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>


</body>

</html>