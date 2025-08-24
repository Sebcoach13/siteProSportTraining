<?php

class UserController {

    private $pdo;
    private $userModel;

    public function __construct($pdo) {
        $this->pdo = $pdo;
        // On passe l'objet PDO au modèle lors de l'instanciation
        $this->userModel = new UserModel($this->pdo);
    }
    
    public function login() {
        $error = '';
        $redirectPage = 'connection';

        // Traitement du formulaire de connexion
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_login'])) {
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
        
            if (empty($email) || empty($password)) {
                $error = "Veuillez saisir votre email et votre mot de passe.";
            } else {
                $user = $this->userModel->loginUser($email, $password);
        
                if ($user) {
                    // Si l'utilisateur est trouvé, on stocke ses informations dans la session
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['user_email'] = $user['email'];
                    $_SESSION['user_first_name'] = $user['firstname'];
                    $_SESSION['user_last_name'] = $user['lastname'];
                    $_SESSION['user_role'] = $user['role'];

                    // On vérifie si l'utilisateur a été redirigé vers la page de connexion depuis une page protégée
                    if (isset($_SESSION['redirect_after_login'])) {
                        // On redirige l'utilisateur vers la page d'origine
                        $redirectPage = $_SESSION['redirect_after_login'];
                        unset($_SESSION['redirect_after_login']);
                        // On s'assure que les paramètres GET sont bien passés si nécessaire
                        if (isset($_SESSION['redirect_after_login_params'])) {
                            $params = http_build_query($_SESSION['redirect_after_login_params']);
                            unset($_SESSION['redirect_after_login_params']);
                            header('Location: /index.php?page=' . $redirectPage . '&' . $params);
                            exit();
                        }
                    } else {
                        // Sinon, on le redirige vers son compte par défaut
                        $redirectPage = 'moncompte';
                    }
                    
                    header('Location: /index.php?page=' . $redirectPage);
                    exit();
                } else {
                    $error = "Email ou mot de passe incorrect.";
                }
            }
            
            // Redirection en cas d'erreur de connexion via le routeur (index.php)
            $_SESSION['error_message'] = $error;
            header('Location: /index.php?page=connection');
            exit();
        }

        // Si la requête n'est pas une requête POST, on charge simplement la vue
        require_once __DIR__ . '/../views/connection.php';
    }

    public function register() {
        $error = '';
        $success = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_register'])) {
            $prenom = trim($_POST['firstname'] ?? '');
            $nom = trim($_POST['lastname'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            $confirm_password = $_POST['confirm_password'] ?? '';

            if (empty($email) || empty($password) || empty($confirm_password)) {
                $error = "Tous les champs obligatoires (Email, Mot de passe, Confirmation) doivent être remplis.";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error = "Format d'email invalide.";
            } elseif ($password !== $confirm_password) {
                $error = "Les mots de passe ne correspondent pas.";
            } elseif (strlen($password) < 6) {
                $error = "Le mot de passe doit contenir au moins 6 caractères.";
            } else {
                $password_hashed = password_hash($password, PASSWORD_DEFAULT);

                if ($this->userModel->registerUser($prenom, $nom, $email, $password_hashed)) {
                    $success = "Inscription réussie ! Vous pouvez maintenant vous connecter.";
                    $_SESSION['success_message'] = $success;
                    header('Location: /index.php?page=connection');
                    exit();
                } else {
                    $error = "L'inscription a échoué. Cet email est peut-être déjà utilisé.";
                }
            }

            if (!empty($error)) {
                $_SESSION['error_message'] = $error;
                header('Location: /index.php?page=inscription');
                exit();
            }
        }
        
        require_once __DIR__ . '/../views/inscription.php';
    }

    public function monCompte() {
        // La logique de la vue est déjà gérée dans moncompte.php
        require_once __DIR__ . '/../views/moncompte_view.php';
    }
    
    public function mesReservations() {
        require_once __DIR__ . '/../views/mes_reservations.php';
    }
    
    public function logout() {
        // Démarrage de la session si elle ne l'est pas déjà
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        session_destroy();
        setcookie('remember_me_token', '', time() - 3600, '/');
        header('Location: /index.php?page=accueil');
        exit();
    }
    
    public function editProfile() {
        require_once __DIR__ . '/../views/edit_profile_view.php';
    }
}
