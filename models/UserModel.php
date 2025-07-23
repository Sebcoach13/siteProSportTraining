<?php
// models/UserModel.php

require_once __DIR__ . '/../config/config.php';

class UserModel {
    private $pdo;

    public function __construct() {
        global $pdo;
        $this->pdo = $pdo;
    }

    /**
     * Vérifie si un email existe déjà dans la base de données.
     * @param string $email L'adresse email à vérifier.
     * @return bool True si l'email existe, False sinon.
     */
    public function emailExists($email) {
        $sql = "SELECT COUNT(*) FROM users WHERE email = :email";
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            return $stmt->fetchColumn() > 0;
        } catch (PDOException $e) {
            error_log("Erreur dans emailExists: " . $e->getMessage());
            return true; // Retourne true par défaut en cas d'erreur DB pour éviter les doublons accidentels
        }
    }

    /**
     * Enregistre un nouvel utilisateur dans la base de données.
     * @param string $firstname Prénom de l'utilisateur.
     * @param string $lastname Nom de l'utilisateur.
     * @param string $email Adresse email de l'utilisateur.
     * @param string $password_hashed Mot de passe haché de l'utilisateur.
     * @param string $role Rôle de l'utilisateur (ex: 'client', 'coach').
     * @return bool True si l'inscription est réussie, False sinon.
     */
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

    /**
     * Récupère un utilisateur par son adresse email.
     * @param string $email L'adresse email de l'utilisateur.
     * @return array|false Tableau associatif de l'utilisateur si trouvé, false sinon.
     */
    public function getUserByEmail($email) {
        $sql = "SELECT id, firstname, lastname, email, password, role, remember_token FROM users WHERE email = :email";
        try {
            // --- DEBOGAGE DANS LE MODEL : Vérification de l'objet PDO ---
            if (!$this->pdo instanceof PDO) {
                die('DEBUG (UserModel): $pdo n\'est pas un objet PDO valide. La connexion a échoué ou n\'est pas accessible.');
            }
            // --- FIN DEBOGAGE ---

            $stmt = $this->pdo->prepare($sql);

            // --- DEBOGAGE DANS LE MODEL : Vérification de la préparation ---
            if ($stmt === false) {
                $errorInfo = $this->pdo->errorInfo();
                die("DEBUG (UserModel): Erreur à la préparation de la requête SQL: " . $errorInfo[2]);
            }
            // --- FIN DEBOGAGE ---

            $stmt->bindParam(':email', $email);

            // --- DEBOGAGE DANS LE MODEL : Vérification de l'exécution ---
            $executionSuccess = $stmt->execute();
            if ($executionSuccess === false) {
                $errorInfo = $stmt->errorInfo();
                die("DEBUG (UserModel): Erreur à l'exécution de la requête SQL: " . $errorInfo[2]);
            }
            // --- FIN DEBOGAGE ---

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // --- DERNIER POINT DE DEBOGAGE DANS LE MODEL ---
            echo "DEBUG (UserModel): Email recherché: " . htmlspecialchars($email) . "<br>";
            echo "DEBUG (UserModel): Résultat de la récupération de l'utilisateur: ";
            var_dump($user);
            die(); // Arrête l'exécution ici pour voir le résultat détaillé
            // --- FIN DEBOGAGE ---

            return $user;
        } catch (PDOException $e) {
            error_log("Erreur PDO dans getUserByEmail: " . $e->getMessage());
            die("DEBUG (UserModel): Exception PDO: " . $e->getMessage()); // Affiche l'exception PDO directement
        }
    }

    /**
     * Récupère un utilisateur par son token "Se souvenir de moi".
     * @param string $token Le token à vérifier.
     * @return array|false Tableau associatif de l'utilisateur si trouvé, false sinon.
     */
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

    /**
     * Met à jour le token "Se souvenir de moi" pour un utilisateur donné.
     * @param int $userId L'ID de l'utilisateur.
     * @param string|null $token Le nouveau token, ou null pour le supprimer.
     * @return bool True si la mise à jour est réussie, False sinon.
     */
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