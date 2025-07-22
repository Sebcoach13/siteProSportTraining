<?php
// controllers/UserController.php

require_once __DIR__ . '/../models/UserModel.php';

class UserController {
    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    public function login() {
        $error = '';
        // Ajoutez cette partie pour gérer le message de succès après une inscription réussie
        $success = '';
        if (isset($_GET['registration_success']) && $_GET['registration_success'] === 'true') {
            $success = "Inscription réussie ! Vous pouvez maintenant vous connecter.";
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_login'])) {
            $email = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
            $password = $_POST['password'] ?? '';

            if (empty($email) || empty($password)) {
                $error = "Veuillez remplir tous les champs.";
            } else {
                $user = $this->userModel->getUserByEmail($email);

                if ($user && password_verify($password, $user['password'])) {
                    // Connexion réussie
                    session_start(); // Assurez-vous que la session est démarrée
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['user_email'] = $user['email'];
                    $_SESSION['user_role'] = $user['role'];

                    // Gérer "Se souvenir de moi"
                    if (isset($_POST['remember_me'])) {
                        // Générer un token sécurisé
                        $token = bin2hex(random_bytes(32));
                        // Stocker le token haché dans la base de données (si votre UserModel le supporte)
                        // Si UserModel::setRememberMeToken n'existe pas, il faudra l'ajouter
                        $this->userModel->setRememberMeToken($user['id'], $token); // Cette méthode doit être implémentée dans UserModel

                        // Définir un cookie pour 30 jours (86400 secondes * 30 jours)
                        setcookie('remember_me_token', $token, time() + (86400 * 30), "/");
                    }

                    header('Location: index.php?page=accueil'); // Rediriger l'utilisateur vers la page d'accueil
                    exit();
                } else {
                    $error = "Email ou mot de passe incorrect.";
                }
            }
        }

        require_once 'views/connection.php';
    }

    public function register() {
        $error = '';
        $success = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_register'])) {
            $firstname = trim($_POST['firstname'] ?? '');
            $lastname = trim($_POST['lastname'] ?? '');
            $email = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
            $password = $_POST['password'] ?? '';
            $confirmPassword = $_POST['confirm_password'] ?? '';

            if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error = "Veuillez entrer une adresse email valide.";
            } elseif ($this->userModel->emailExists($email)) {
                $error = "Cette adresse email est déjà utilisée.";
            } elseif (empty($password) || strlen($password) < 8) {
                $error = "Le mot de passe doit contenir au moins 8 caractères.";
            } elseif ($password !== $confirmPassword) {
                $error = "Les mots de passe ne correspondent pas.";
            }

            if (empty($error)) {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                if ($this->userModel->registerUser($firstname, $lastname, $email, $hashedPassword, 'client')) {
                    $success = "Inscription réussie ! Vous pouvez maintenant vous connecter.";
                    header('Location: index.php?page=connection&registration_success=true');
                    exit();
                } else {
                    $error = "Une erreur est survenue lors de l'inscription. Veuillez réessayer.";
                }
            }
        }

        require_once 'views/inscription.php';
    }

    public function logout() {
        session_start(); // Assurez-vous que la session est démarrée avant de la manipuler
        session_unset();
        session_destroy();
        setcookie('remember_me_token', '', time() - 3600, '/');
        header('Location: index.php?page=accueil');
        exit();
    }
}