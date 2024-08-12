<?php
// app/models/User.php
namespace App\Models;

use PDO;

class User {
    private $db;

    public function __construct() {
        global $conn;
        $this->db = $conn;
    }

    public function findByUsername($username) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = :username LIMIT 1");
        $stmt->execute(['username' => $username]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function findByEmail($email) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
        $stmt->execute(['email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function findById($id) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = :id LIMIT 1");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function register($data) {
        $stmt = $this->db->prepare("
            INSERT INTO users (username, email, password, first_name, last_name, country, phone, role_id, avatar)
            VALUES (:username, :email, :password, :first_name, :last_name, :country, :phone, :role_id, :avatar)
        ");

        $passwordHash = password_hash($data['password'], PASSWORD_BCRYPT);

        return $stmt->execute([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => $passwordHash,
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'country' => $data['country'],
            'phone' => $data['phone'],
            'role_id' => 3, // Ejemplo: 3 puede ser el ID para el rol de usuario estándar
            'avatar' => 'default_avatar.png'
        ]);
    }

    public function verifyPassword($inputPassword, $storedPasswordHash) {
        return password_verify($inputPassword, $storedPasswordHash);
    }

    public function updateProfile($id, $data) {
        $stmt = $this->db->prepare("
            UPDATE users
            SET
                first_name = :first_name,
                last_name = :last_name,
                country = :country,
                phone = :phone,
                avatar = :avatar
            WHERE
                id = :id
        ");

        return $stmt->execute([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'country' => $data['country'],
            'phone' => $data['phone'],
            'avatar' => $data['avatar'],
            'id' => $id
        ]);
    }

    public function updatePassword($id, $newPasswordHash) {
        $stmt = $this->db->prepare("UPDATE users SET password = :password WHERE id = :id");

        return $stmt->execute([
            'password' => $newPasswordHash,
            'id' => $id
        ]);
    }
}
