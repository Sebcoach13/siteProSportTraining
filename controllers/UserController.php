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
        $success = '';

        // Récupérer le message de succès de l'inscription si présent dans l'URL
        if (isset($_GET['registration_success']) && $_GET['registration_success'] === 'true') {
            $success = "Inscription réussie ! Vous pouvez maintenant vous connecter.";
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_login'])) {
            $email = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
            $password = $_POST['password'] ?? '';

            if (empty($email) || empty($password)) {
                $error = "Veuillez remplir tous les champs.";
            } else {
                // L'appel à getUserByEmail va maintenant exécuter les 'die()' de débogage de UserModel.php
                $user = $this->userModel->getUserByEmail($email);

                // Une fois que les tests de UserModel sont passés et que vous avez supprimé les 'die()' là-bas,
                // le code ci-dessous sera exécuté pour la vérification du mot de passe et la connexion.
                if ($user && password_verify($password, $user['password'])) {
                    // Connexion réussie
                    // NE PAS appeler session_start() ici, il est déjà appelé dans index.php
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['user_email'] = $user['email'];
                    $_SESSION['user_first_name'] = $user['firstname'];
                    $_SESSION['user_last_name'] = $user['lastname'];
                    $_SESSION['user_role'] = $user['role'];

                    // Gérer "Se souvenir de moi"
                    if (isset($_POST['remember_me'])) {
                        $token = bin2hex(random_bytes(32));
                        $this->userModel->updateRememberToken($user['id'], $token); 
                        // secure et httponly pour une meilleure sécurité du cookie
                        setcookie('remember_me_token', $token, time() + (86400 * 30), "/", "", false, true); 
                    } else {
                        $this->userModel->updateRememberToken($user['id'], null);
                        setcookie('remember_me_token', '', time() - 3600, '/');
                    }

                    if (isset($_SESSION['redirect_after_login'])) {
                        $redirectPage = $_SESSION['redirect_after_login'];
                        unset($_SESSION['redirect_after_login']);
                        header('Location: /siteProSportTraining/index.php?page=' . $redirectPage . '&success=Connexion réussie !');
                    } else {
                        header('Location: /siteProSportTraining/index.php?page=accueil&success=Connexion réussie !');
                    }
                    exit();
                } else {
                    // Ce message s'affichera si l'utilisateur n'est pas trouvé OU si le mot de passe est incorrect
                    $error = "Email ou mot de passe incorrect.";
                }
            }
        }

        require_once __DIR__ . '/../views/connection.php';
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

            if (empty($firstname) || empty($lastname)) {
                $error = "Veuillez remplir tous les champs (nom et prénom).";
            } elseif (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
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
                    header('Location: /siteProSportTraining/index.php?page=connection&registration_success=true');
                    exit();
                } else {
                    $error = "Une erreur est survenue lors de l'inscription. Veuillez réessayer.";
                }
            }
        }

        require_once __DIR__ . '/../views/inscription.php';
    }

    public function logout() {
        session_unset();
        session_destroy();
        setcookie('remember_me_token', '', time() - 3600, '/');
        header('Location: /siteProSportTraining/index.php?page=accueil');
        exit();
    }
}
?>