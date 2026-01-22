<?php
class User{
    private $db;
    public function __construct($pdo){
        $this->db = $pdo;
    }

    public function findByEmail($email){
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($nama, $email, $password, $role)
    {
        $hash = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $this->db->prepare("INSERT INTO users (nama, email, password, role) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$nama, $email, $hash, $role]);

    }
    public function getAllUsers()
    {
        $stmt = $this->db->query("SELECT * FROM users where role = 'user' ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function deleteUser($id)
    {
        $stmt = $this->db->prepare("DELETE FROM users WHERE id = ?");
        return $stmt->execute([$id]);
    }
    public function updateUser($id, $nama, $email, $password = null)
    {
        if ($password) {
            $hash = password_hash($password, PASSWORD_BCRYPT);
            $stmt = $this->db->prepare("UPDATE users SET nama = ?, email = ?, password = ? WHERE id = ?");
            return $stmt->execute([$nama, $email, $hash, $id]);
        } else {
            $stmt = $this->db->prepare("UPDATE users SET nama = ?, email = ? WHERE id = ?");
            return $stmt->execute([$nama, $email, $id]);
        }
    }

}