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
    <title>Cetak.in</title>
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
                <ul class="navbar-nav gap-3">
                    <li class="nav-item"><a class="nav-link active" href="index.php">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="product.php">Produk</a></li>
                    <li class="nav-item"><a class="nav-link" href="kontak.html">Kontak</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <?php
require_once '../../database/connection.php';
require_once '../../model/Product.php';

if (!isset($_GET['id'])) {
    die('Produk tidak ditemukan');
}

$productModel = new Product($pdo);
$product = $productModel->find($_GET['id']);

if (!$product) {
    die('Produk tidak ditemukan');
}
?>

    <div class="container py-5">
        <div class="row g-4">

            <!-- LEFT PRODUCT IMAGE -->
            <div class="col-lg-5">
                <div class="zoom-container border rounded p-3">
                    <img src="<?= htmlspecialchars($product['gambar']) ?>" class="img-fluid w-100 rounded zoom-image"
                        alt="<?= htmlspecialchars($product['nama_produk']) ?>">
                </div>
            </div>

            <!-- RIGHT PRODUCT DETAILS -->
            <div class="col-lg-7">

                <!-- PRODUCT TITLE -->
                <h3 class="fw-bold">
                    <?= htmlspecialchars($product['nama_produk']) ?>
                </h3>

                <!-- RATING (STATIC DULU) -->
                <div class="d-flex align-items-center mb-2">
                    <span class="text-warning fs-5">★ ★ ★ ★ ★</span>
                    <span class="ms-2 text-muted">(0 review produk)</span>
                </div>

                <!-- STOCK -->
                <?php if ($product['stok_produk'] > 0 && $product['is_available']): ?>
                <p class="text-success fw-semibold">✔ Stok tersedia</p>
                <?php else: ?>
                <p class="text-danger fw-semibold">✖ Out of Stock</p>
                <?php endif; ?>

                <!-- PRICE -->
                <h4 class="fw-bold mb-4">
                    Rp <?= number_format($product['harga'], 0, ',', '.') ?>
                </h4>

                <!-- QTY & BUTTON -->
                <div class="d-flex align-items-center gap-2 mb-4">

                    <!-- Quantity -->
                    <div class="input-group" style="width: 120px;">
                        <button class="btn btn-outline-secondary" type="button">-</button>
                        <input type="text" class="form-control text-center" value="1">
                        <button class="btn btn-outline-secondary" type="button">+</button>
                    </div>

                    <!-- Pesan -->
                    <?php if ($product['stok_produk'] > 0 && $product['is_available']): ?>
                    <a target="_blank"
                        href="https://wa.me/6285643351736?text=Halo,%20saya%20ingin%20memesan%20produk%20<?= urlencode($product['nama_produk']) ?>">
                        <button class="btn btn-outline-primary">
                            + Pesan
                        </button>
                    </a>
                    <?php else: ?>
                    <button class="btn btn-outline-secondary" disabled>
                        Tidak tersedia
                    </button>
                    <?php endif; ?>

                    <!-- Wishlist -->
                    <button class="btn btn-outline-dark">
                        ❤
                    </button>
                </div>

                <!-- TABS -->
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#desc">
                            Deskripsi
                        </button>
                    </li>
                </ul>

                <div class="tab-content p-3 border-bottom border-start border-end rounded-bottom">

                    <div class="tab-pane fade show active" id="desc">
                        <?= nl2br(htmlspecialchars($product['deskripsi'])) ?>
                    </div>

                </div>

                <!-- REVIEW -->
                <p class="mt-4 fs-5 text-muted">0 Reviews for this product</p>

            </div>

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