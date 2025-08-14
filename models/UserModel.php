<?php
class UserModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function emailExists($email) {
        $sql = "SELECT COUNT(*) FROM users WHERE email = :email";
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            return $stmt->fetchColumn() > 0;
        } catch (PDOException $e) {
            error_log("Erreur dans emailExists: " . $e->getMessage());
            return true;
        }
    }

    public function registerUser($firstname, $lastname, $email, $password_hashed, $role = 'client') {
        $sql = "INSERT INTO users (firstname, lastname, email, password, role) VALUES (:firstname, :lastname, :email, :password, :role)";
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':firstname', $firstname);
            $stmt->bindParam(':lastname', $lastname);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password_hashed);
            $stmt->bindParam(':role', $role);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Erreur lors de l'inscription de l'utilisateur: " . $e->getMessage());
            return false;
        }
    }

    public function loginUser($email, $password) {
        $user = $this->getUserByEmail($email);

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }

        return false;
    }

    public function getUserByEmail($email) {
        $sql = "SELECT id, firstname, lastname, email, password, role, remember_token FROM users WHERE email = :email";
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erreur dans getUserByEmail: " . $e->getMessage());
            return false;
        }
    }

    public function getUserById($id) {
        $sql = "SELECT id, firstname, lastname, email, password, role, remember_token FROM users WHERE id = :id";
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erreur dans getUserById: " . $e->getMessage());
            return false;
        }
    }

    public function getUserByRememberToken($token) {
        $sql = "SELECT id, firstname, lastname, email, password, role FROM users WHERE remember_token = :token";
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':token', $token);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erreur dans getUserByRememberToken: " . $e->getMessage());
            return false;
        }
    }
    
    public function updateUser($userId, $firstname, $lastname, $email, $password) {
        $query = "UPDATE users SET firstname = :firstname, lastname = :lastname, email = :email, password = :password WHERE id = :id";
        try {
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(":firstname", $firstname);
            $stmt->bindParam(":lastname", $lastname);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":password", $password);
            $stmt->bindParam(":id", $userId);

            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Erreur lors de la mise à jour de l'utilisateur: " . $e->getMessage());
            return false;
        }
    }

    public function updateRememberToken($userId, $token) {
        $sql = "UPDATE users SET remember_token = :token WHERE id = :user_id";
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':token', $token);
            $stmt->bindParam(':user_id', $userId);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Erreur dans updateRememberToken: " . $e->getMessage());
            return false;
        }
    }
}
?>