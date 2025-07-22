<?php
// models/UserModel.php

require_once __DIR__ . '/../config/config.php';

class UserModel {
    private $pdo;

    public function __construct() {
        global $pdo;
        $this->pdo = $pdo;
    }

    public function registerUser($firstname, $lastname, $email, $hashedPassword, $role = 'client') {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO users (firstname, lastname, email, password, role) VALUES (:firstname, :lastname, :email, :password, :role)");
            $stmt->bindParam(':firstname', $firstname);
            $stmt->bindParam(':lastname', $lastname);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $hashedPassword);
            $stmt->bindParam(':role', $role);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Erreur d'enregistrement utilisateur: " . $e->getMessage());
            return false;
        }
    }

    public function emailExists($email) {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    public function getUserByEmail($email) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getUserByRememberToken($token) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE remember_token = :token AND remember_token_expires_at > NOW()");
        $stmt->bindParam(':token', $token);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateRememberToken($userId, $token) {
        $expiresAt = date('Y-m-d H:i:s', strtotime('+30 days'));
        $stmt = $this->pdo->prepare("UPDATE users SET remember_token = :token, remember_token_expires_at = :expires_at WHERE id = :id");
        $stmt->bindParam(':token', $token);
        $stmt->bindParam(':expires_at', $expiresAt);
        $stmt->bindParam(':id', $userId);
        return $stmt->execute();
    }
}