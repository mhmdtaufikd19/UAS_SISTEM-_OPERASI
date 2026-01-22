<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

require_once '../database/connection.php';
require_once '../model/User.php';

$userModel = new User($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $action = $_POST['action'] ?? '';
 
    /* ================= REGISTER ================= */
    if ($action === 'register') {

        $nama     = trim($_POST['nama'] ?? '');
        $email    = trim($_POST['email'] ?? '');
        $password = trim($_POST['password'] ?? '');
        $role     = 'user';

        if ($nama === '' || $email === '' || $password === '') {
            $_SESSION['error'] = 'Semua field wajib diisi';
            header('Location: ../view/auth/register.php');
            exit;
        }

        if ($userModel->findByEmail($email)) {
            $_SESSION['error'] = 'Email sudah terdaftar';
            header('Location: ../view/auth/register.php');
            exit;
        }

        $userModel->create($nama, $email, $password, $role);

        $_SESSION['success'] = 'Registrasi berhasil. Silakan login.';
        header('Location: ../view/auth/login.php');
        exit;
    }

    /* ================= LOGIN ================= */
    if ($action === 'login') {

        $email    = trim($_POST['email'] ?? '');
        $password = trim($_POST['password'] ?? '');

        if ($email === '' || $password === '') {
            $_SESSION['error'] = 'Email dan password wajib diisi';
            header('Location: ../view/auth/login.php');
            exit;
        }

        $user = $userModel->findByEmail($email);

        if (!$user || !password_verify($password, $user['password'])) {
            $_SESSION['error'] = 'Email atau password salah';
            header('Location: ../view/auth/login.php');
            exit;
        }

        if ($user['role'] === 'admin') {
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin'] = $user;
            header('Location: ../view/admin/index.php');
        } else {
            $_SESSION['user'] = $user;
            $_SESSION['user_logged_in'] = true;
            $_SESSION['user_name'] = $user['nama'];

            header('Location: ../view/user/index.php');
        }
        exit;
    }

    /* ================= LOGOUT ================= */
    if ($action === 'logout') {
        session_destroy();
        header('Location: ../view/user/index.php');
        exit;
    }

}