<?php
require_once '../../database/connection.php';
require_once '../../model/Product.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
$productModel = new Product($pdo);
$products = $productModel->getAll();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Produk</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" href="style.css">
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
    <!-- PRODUK -->
    <div class="container my-5">
        <h4 class="title pb-3 text-center">Produk Kami</h4>

        <div class="row g-4">

            <?php if (empty($products)): ?>
            <div class="col-12 text-center text-muted">
                Produk belum tersedia
            </div>
            <?php endif; ?>

            <?php foreach ($products as $p): ?>
            <?php if ($p['is_available']): ?>
            <div class="col-12 col-sm-6 col-lg-3">

                <div class="product-card h-100 border rounded">

                    <div class="image-box">
                        <img src="<?= htmlspecialchars($p['gambar']) ?>" class="img-fluid"
                            alt="<?= htmlspecialchars($p['nama_produk']) ?>">
                    </div>

                    <div class="p-3">
                        <h6><?= htmlspecialchars($p['nama_produk']) ?></h6>

                        <p class="fw-bold text-primary">
                            Rp <?= number_format($p['harga'], 0, ',', '.') ?>
                        </p>

                        <?php if ($p['stok_produk'] > 0): ?>
                        <a href="detail_produk.php?id=<?= $p['id'] ?>" class="btn btn-primary w-100">
                            Pesan
                        </a>
                        <?php else: ?>
                        <button class="btn btn-danger w-100" disabled>
                            Habis
                        </button>
                        <?php endif; ?>
                    </div>

                </div>
            </div>
            <?php endif; ?>
            <?php endforeach; ?>

        </div>
    </div>

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