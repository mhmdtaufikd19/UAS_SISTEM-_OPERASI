<?php
session_start();
if($_SESSION['admin_logged_in'] !== true){
    header('Location: ../auth/login.php');
    message('error', 'Please log in as admin to access the admin dashboard.');
    exit;
}

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../../database/connection.php';
require_once '../../model/Product.php';


$ProductModel = new Product($pdo);
$Products = $ProductModel->getAll();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        body {
            background-color: #f5f7fb;
        }

        .sidebar {
            width: 250px;
            min-height: 100vh;
            background: linear-gradient(180deg, #4e73df, #224abe);
        }

        .sidebar a {
            color: #fff;
            text-decoration: none;
            padding: 12px 20px;
            display: block;
        }

        .sidebar a:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .card-shadow {
            box-shadow: 0 0.15rem 1.75rem rgba(58, 59, 69, .15);
        }
    </style>
</head>

<body>

    <div class="d-flex">

        <!-- Sidebar -->
        <div class="sidebar">
            <h4 class="text-center text-white py-4">cetakin admin</h4>
            <a href="index.php"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a>
            <a href="add_product.php"><i class="bi bi-box me-2"></i>Product</a>
            <p>
                <form action="/UAS_SO/controller/AuthController.php" method="POST">
                    <input type="hidden" name="action" value="logout">
                    <button type="submit" class="dropdown-item text-danger">
                        <i class="bi bi-box-arrow-right me-2"></i> Logout
                    </button>
                </form>
            </p>
        </div>

        <!-- Main Content -->
        <div class="flex-fill p-4">

            <!-- Navbar -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3>Dashboard</h3>
            </div>

            <!-- Stat Cards -->


            <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= htmlspecialchars($_SESSION['success']) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php unset($_SESSION['success']); ?>
            <?php endif; ?>

            <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= htmlspecialchars($_SESSION['error']) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php unset($_SESSION['error']); ?>
            <?php endif; ?>

            <div class="container mb-3">
                <div class="d-flex justify-content-between">
                    <h4>Product Management</h4>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModalProduct">
                        Add Product
                    </button>
                </div>
            </div>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Harga</th>
                        <th>Tersedia</th>
                        <th>Stok</th>
                        <th>Deskripsi</th>
                        <th>Gambar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($Products as $p): ?>
                    <tr>
                        <td><?= $p['id'] ?></td>
                        <td><?= htmlspecialchars($p['nama_produk']) ?></td>
                        <td><?= number_format($p['harga']) ?></td>
                        <td><?= $p['is_available'] ? 'Ya' : 'Tidak' ?></td>
                        <td><?= $p['stok_produk'] ?></td>
                        <td><?= htmlspecialchars($p['deskripsi']) ?></td>
                        <td>
                            <?php if ($p['gambar']): ?>
                            <img src="<?= $p['gambar'] ?>" width="100">
                            <?php endif; ?>
                        </td>
                        <td>
                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                data-bs-target="#editModalProduct" data-id="<?= $p['id'] ?>"
                                data-nama="<?= htmlspecialchars($p['nama_produk']) ?>" data-harga="<?= $p['harga'] ?>"
                                data-stok="<?= $p['stok_produk'] ?>"
                                data-deskripsi="<?= htmlspecialchars($p['deskripsi']) ?>"
                                data-gambar="<?= $p['gambar'] ?>">
                                Edit
                            </button>

                            <form action="/UAS_SO/controller/ProductController.php" method="POST" class="d-inline">
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="id" value="<?= $p['id'] ?>">
                                <button class="btn btn-sm btn-danger"
                                    onclick="return confirm('Hapus produk?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>


            <div class="modal fade" id="addModalProduct">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form method="POST" action="/UAS_SO/controller/ProductController.php"
                            enctype="multipart/form-data">
                            <div class="modal-header">
                                <h5>Tambah Produk</h5>
                            </div>
                            <div class="modal-body">

                                <input type="hidden" name="action" value="create">

                                <input name="nama_produk" class="form-control mb-2" placeholder="Nama Produk" required>
                                <input name="harga" type="number" class="form-control mb-2" placeholder="Harga"
                                    required>
                                <input name="stok_produk" type="number" class="form-control mb-2" placeholder="Stok"
                                    required>

                                <textarea name="deskripsi" class="form-control mb-2" placeholder="Deskripsi"></textarea>
                                <input type="file" name="gambar" class="form-control">

                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="editModalProduct">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form method="POST" action="/UAS_SO/controller/ProductController.php"
                            enctype="multipart/form-data">
                            <div class="modal-header">
                                <h5>Edit Produk</h5>
                            </div>
                            <div class="modal-body">

                                <input type="hidden" name="action" value="update">
                                <input type="hidden" name="id">
                                <input type="hidden" name="old_image">

                                <input name="nama_produk" class="form-control mb-2" required>
                                <input name="harga" type="number" class="form-control mb-2" required>
                                <select name="is_available" class="form-select mb-2" required>
                                    <option value="1" <?= $p['is_available'] ? 'selected' : '' ?>>
                                        Tersedia
                                    </option>
                                    <option value="0" <?= !$p['is_available'] ? 'selected' : '' ?>>
                                        Tidak Tersedia
                                    </option>
                                </select>

                                <input name="stok_produk" type="number" class="form-control mb-2" required>

                                <textarea name="deskripsi" class="form-control mb-2"></textarea>
                                <input type="file" name="gambar" class="form-control">

                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>

        <script>
            document.getElementById('editModalProduct')
                .addEventListener('show.bs.modal', function (e) {
                    const b = e.relatedTarget;
                    const f = this.querySelector('form');

                    f.id.value = b.dataset.id;
                    f.nama_produk.value = b.dataset.nama;
                    f.harga.value = b.dataset.harga;
                    f.is_available.value = b.dataset.is_available;
                    f.stok_produk.value = b.dataset.stok;
                    f.deskripsi.value = b.dataset.deskripsi;
                    f.old_image.value = b.dataset.gambar;
                });
            setTimeout(() => {
                document.querySelectorAll('.alert').forEach(el => el.remove());
            }, 3000);
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>