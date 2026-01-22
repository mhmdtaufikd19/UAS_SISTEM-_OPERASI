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
require_once '../../model/User.php';
$productModel = new Product($pdo);
$products = $productModel->getAll();
$productCount = count($products);

$userModel = new User($pdo);
$users = $userModel->getAllUsers();
$userCount = count($users);
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
            <div class="row g-3 mb-4">
                <div class="col-md-3">
                    <div class="card card-shadow p-3">
                        <small class="text-primary">Total Produk</small>
                        <h4><?php echo $productCount; ?></h4>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-shadow p-3">
                        <small class="text-success">Total User</small>
                        <h4><?php echo $userCount; ?></h4>
                    </div>
                </div>

            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>