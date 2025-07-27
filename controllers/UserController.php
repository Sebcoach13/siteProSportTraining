<?php

require_once __DIR__ . '/../models/UserModel.php';

class UserController {
    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    public function login() {
        $error = '';
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
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['user_email'] = $user['email'];
                    $_SESSION['user_first_name'] = $user['firstname'];
                    $_SESSION['user_last_name'] = $user['lastname'];
                    $_SESSION['user_role'] = $user['role'];

                    if (isset($_POST['remember_me'])) {
                        $token = bin2hex(random_bytes(32));
                        $this->userModel->updateRememberToken($user['id'], $token); 
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

    public function monCompte() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /siteProSportTraining/index.php?page=connection&error=Veuillez vous connecter pour accéder à cette page.');
            exit();
        }
        require_once __DIR__ . '/../views/moncompte_view.php'; 
    }

    public function editProfile() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /siteProSportTraining/index.php?page=connection&error=Veuillez vous connecter pour accéder à cette page.');
            exit();
        }

        $user = $this->userModel->getUserById($_SESSION['user_id']);

        if (!$user) {
            $_SESSION = [];
            session_destroy();
            header('Location: /siteProSportTraining/index.php?page=connection&error=Votre session est invalide.');
            exit();
        }

        $error = '';
        $success = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_update_profile'])) {
            $firstname = trim($_POST['firstname'] ?? '');
            $lastname = trim($_POST['lastname'] ?? '');
            $email = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
            $newPassword = $_POST['new_password'] ?? '';
            $confirmNewPassword = $_POST['confirm_new_password'] ?? '';

            if (empty($firstname) || empty($lastname)) {
                $error = "Veuillez remplir le nom et le prénom.";
            } elseif (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error = "Veuillez entrer une adresse email valide.";
            } elseif ($email !== $user['email'] && $this->userModel->emailExists($email)) {
                $error = "Cette adresse email est déjà utilisée par un autre compte.";
            }

            if (!empty($newPassword)) {
                if (strlen($newPassword) < 8) {
                    $error = "Le nouveau mot de passe doit contenir au moins 8 caractères.";
                } elseif ($newPassword !== $confirmNewPassword) {
                    $error = "Les nouveaux mots de passe ne correspondent pas.";
                }
            }

            if (empty($error)) {
                $hashedPassword = !empty($newPassword) ? password_hash($newPassword, PASSWORD_DEFAULT) : $user['password'];

                if ($this->userModel->updateUser($user['id'], $firstname, $lastname, $email, $hashedPassword)) {
                    $_SESSION['user_email'] = $email;
                    $_SESSION['user_first_name'] = $firstname;
                    $_SESSION['user_last_name'] = $lastname;
                    $success = "Votre profil a été mis à jour avec succès.";
                    $user = $this->userModel->getUserById($_SESSION['user_id']); 
                } else {
                    $error = "Une erreur est survenue lors de la mise à jour du profil.";
                }
            }
        }

        require_once __DIR__ . '/../views/edit_profile_view.php';
    }
}