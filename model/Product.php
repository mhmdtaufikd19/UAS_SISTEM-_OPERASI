<?php
class Product {
    private $db;

    public function __construct($pdo) {
        $this->db = $pdo;
    }

    // CREATE
    public function create($d) {
        $sql = "INSERT INTO produk
        (nama_produk, harga, is_available, stok_produk, deskripsi, gambar)
        VALUES (?,?,?,?,?,?)";

        return $this->db->prepare($sql)->execute([
            $d['nama_produk'],
            $d['harga'],
            $d['is_available'],
            $d['stok_produk'],
            $d['deskripsi'],
            $d['gambar']
        ]);
    }

    // READ ALL
    public function getAll() {
        $sql = "SELECT *
                FROM produk
                ORDER BY id DESC";

        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    // READ BY ID
    public function find($id) {
        $stmt = $this->db->prepare("SELECT * FROM produk WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // UPDATE
    public function update($id, $d) {
        $sql = "UPDATE produk SET
            nama_produk = ?,
            harga = ?,
            is_available = ?,
            stok_produk = ?,
            deskripsi = ?,
            gambar = ?
            WHERE id = ?";

        return $this->db->prepare($sql)->execute([
            $d['nama_produk'],
            $d['harga'],
            $d['is_available'],
            $d['stok_produk'],
            $d['deskripsi'],
            $d['gambar'],
            $id
        ]);
    }

    // DELETE
    public function delete($id) {
        return $this->db->prepare(
            "DELETE FROM produk WHERE id = ?"
        )->execute([$id]);
    }
}
