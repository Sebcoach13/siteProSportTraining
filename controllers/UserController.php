<?php
class UserController {
    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    public function login() {
        $error = $_GET['error'] ?? '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $rememberMe = isset($_POST['remember_me']);

            $user = $this->userModel->getUserByEmail($email);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_email'] = $user['email'];
                $_SESSION['user_first_name'] = $user['firstname'];
                $_SESSION['user_last_name'] = $user['lastname'];
                $_SESSION['user_role'] = $user['role'];

                if ($rememberMe) {
                    $token = bin2hex(random_bytes(32));
                    $this->userModel->updateRememberToken($user['id'], $token);
                    setcookie('remember_me_token', $token, time() + (86400 * 30), '/', '', false, true);
                }

                if (isset($_SESSION['redirect_after_login'])) {
                    $redirectPage = $_SESSION['redirect_after_login'];
                    $redirectParams = $_SESSION['redirect_after_login_params'] ?? [];
                    
                    unset($_SESSION['redirect_after_login']);
                    unset($_SESSION['redirect_after_login_params']);

                    $queryString = http_build_query($redirectParams);
                    header('Location: /siteProSportTraining/index.php?page=' . $redirectPage . '&' . $queryString);
                    exit();
                } else {
                    header('Location: /siteProSportTraining/index.php?page=moncompte');
                    exit();
                }
            } else {
                $error = 'Email ou mot de passe incorrect.';
            }
        }
        require_once __DIR__ . '/../views/connection.php';
    }

    public function register() {
        require_once __DIR__ . '/../views/inscription.php';
    }

    public function logout() {
        // Détruire toutes les variables de session
        $_SESSION = array();

        // Supprimer le cookie de session
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }

        // Supprimer le cookie "remember_me_token" si il existe
        if (isset($_COOKIE['remember_me_token'])) {
            setcookie('remember_me_token', '', time() - 3600, '/', '', false, true);
         
        }

        // Finalement, détruire la session
        session_destroy();

        // Rediriger vers la page d'accueil
        header('Location: /siteProSportTraining/index.php?page=accueil');
        exit();
    }

    public function monCompte() {
        require_once __DIR__ . '/../views/moncompte_view.php';
    }

    public function editProfile() {
        require_once __DIR__ . '/../views/edit_profile_view.php';
    }

    public function mesReservations() {
        $reservations = [
            [
                'service_name' => 'Boxe - Séance individuelle',
                'date' => '2025-08-10',
                'price' => 60.00,
                'status' => 'Confirmée'
            ],
            [
                'service_name' => 'Préparation Physique - 5 séances',
                'date' => '2025-08-15',
                'price' => 250.00,
                'status' => 'En attente'
            ],
        ];

        require_once __DIR__ . '/../views/mes_reservations.php';
    }
}
