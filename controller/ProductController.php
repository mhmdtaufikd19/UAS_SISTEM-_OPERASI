<?php
session_start();
require_once __DIR__.'/../database/connection.php';
require_once __DIR__.'/../model/Product.php';

$product = new Product($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $image = $_POST['old_image'] ?? null;

    if (!empty($_FILES['gambar']['name'])) {

        // PATH FISIK ke folder yang SUDAH ADA
        $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/UAS_SO/gambar/';

        // pastikan folder bisa ditulis
        if (!is_writable($uploadDir)) {
            die('Folder gambar tidak bisa ditulis');
        }

        $filename = time() . '_' . basename($_FILES['gambar']['name']);
        $target   = $uploadDir . $filename;

        if (move_uploaded_file($_FILES['gambar']['tmp_name'], $target)) {
            // PATH RELATIF untuk database
            $image = '/UAS_SO/gambar/' . $filename;
        } else {
            die('Upload gambar gagal');
        }
    }


    if ($_POST['action'] === 'create') {
        $product->create([
            'nama_produk'=>$_POST['nama_produk'],
            'harga'=>$_POST['harga'],
            'stok_produk'=>$_POST['stok_produk'],
            'is_available'=>$_POST['stok_produk']>0,
            'deskripsi'=>$_POST['deskripsi'],
            'gambar'=>$image
        ]);
        $_SESSION['success']='Produk ditambahkan';
    }

    if ($_POST['action'] === 'update') {
        $product->update($_POST['id'], [
            'nama_produk'=>$_POST['nama_produk'],
            'harga'=>$_POST['harga'],
            'stok_produk'=>$_POST['stok_produk'],
            'is_available'=>$_POST['is_available'],
            'deskripsi'=>$_POST['deskripsi'],
            'gambar'=>$image
        ]);
        $_SESSION['success']='Produk diupdate';
    }

    if ($_POST['action'] === 'delete') {
        $product->delete($_POST['id']);
        $_SESSION['success']='Produk dihapus';
    }

    header('Location: ../view/admin/add_product.php');
    exit;
}