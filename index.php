<?php

session_start();

spl_autoload_register(function ($className) {
    $directories = [
        'controllers/',
        'models/',
    ];

    foreach ($directories as $directory) {
        $filePath = $directory . $className . '.php';
        if (file_exists($filePath)) {
            require_once $filePath;
            return;
        }
    }
});

require_once 'config/config.php';

// Logique de "se souvenir de moi"
if (!isset($_SESSION['user_id']) && isset($_COOKIE['remember_me_token']) && !empty($_COOKIE['remember_me_token'])) {
    $userModel = new UserModel();
    $user = $userModel->getUserByRememberToken($_COOKIE['remember_me_token']);

    if ($user) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['user_first_name'] = $user['firstname'];
        $_SESSION['user_last_name'] = $user['lastname'];
        $_SESSION['user_role'] = $user['role'];

        $newToken = bin2hex(random_bytes(32));
        $userModel->updateRememberToken($user['id'], $newToken);
        setcookie('remember_me_token', $newToken, time() + (86400 * 30), '/');
    } else {
        setcookie('remember_me_token', '', time() - 3600, '/');
    }
}

$page = $_GET['page'] ?? 'accueil';
$isLoggedIn = isset($_SESSION['user_id']); // Vérifie si l'utilisateur est connecté

// Pages qui nécessitent une authentification
// Seul 'agenda' et le tunnel de commande sont protégés. 'contact' est accessible directement.
$protectedPages = ['agenda', 'panier', 'paiement', 'confirmation', 'confpaiement'];

// Si la page demandée est protégée et que l'utilisateur n'est PAS connecté
if (in_array($page, $protectedPages) && !$isLoggedIn) {
    // Stocke la page d'origine pour redirection après connexion
    $_SESSION['redirect_after_login'] = $page;
    header('Location: /siteProSportTraining/index.php?page=connection&error=Vous devez être connecté ou inscrit pour accéder à cette page.');
    exit();
}


// Inclure le header AVANT d'exécuter la logique du contrôleur,
// SAUF si c'est une requête API
if (!isset($_GET['api']) || $_GET['api'] !== 'true') {
    require_once __DIR__ . '/views/header.php';
}

switch ($page) {
    case 'accueil':
        $controller = new HomeController();
        $controller->index();
        break;

    case 'apropos':
        $controller = new HomeController();
        $controller->apropos();
        break;

    case 'coaching':
        $controller = new HomeController();
        $controller->coaching();
        break;

    case 'contact':
        // ACCES DIRECT. Aucun changement nécessaire ici car ce n'est plus dans $protectedPages
        $controller = new ContactController();
        $controller->index();
        break;

    case 'agenda':
        // LOGIQUE DEJA EN PLACE. Sera exécutée seulement si $isLoggedIn est true
        $controller = new ReservationController();
        $controller->agenda();
        break;

    case 'api':
        $action = $_GET['action'] ?? '';
        $reservationController = new ReservationController();
        
        switch ($action) {
            case 'reservations/slots':
                $reservationController->getReservedSlotsApi();
                break;
            case 'reservations/create':
                $reservationController->createReservationApi();
                break;
            default:
                http_response_code(404);
                echo json_encode(['success' => false, 'message' => 'API endpoint not found.']);
                exit();
        }
        break;

    case 'connection':
        $controller = new UserController();
        $controller->login();
        break;

    case 'inscription':
        $controller = new UserController();
        $controller->register();
        break;
    
    case 'register':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller = new UserController();
            $controller->register();
        } else {
            header('Location: /siteProSportTraining/index.php?page=inscription');
            exit();
        }
        break;

    case 'logout':
        $controller = new UserController();
        $controller->logout();
        break;

    case 'panier':
        // LOGIQUE DEJA EN PLACE. Sera exécutée seulement si $isLoggedIn est true
        $controller = new CartController();
        $controller->index();
        break;

    case 'paiement':
        // LOGIQUE DEJA EN PLACE. Sera exécutée seulement si $isLoggedIn est true
        $controller = new ReservationController();
        $controller->paiement();
        break;

    case 'confpaiement':
        // LOGIQUE DEJA EN PLACE. Sera exécutée seulement si $isLoggedIn est true
        $controller = new ReservationController();
        $controller->confirmationPaiement();
        break;

    case 'confirmation':
        // LOGIQUE DEJA EN PLACE. Sera exécutée seulement si $isLoggedIn est true
        $controller = new ReservationController();
        $controller->confirmation();
        break;

    case 'mentions-legales':
        $controller = new HomeController();
        $controller->mentionsLegales();
        break;

    case 'politique-confidentialite':
        $controller = new HomeController();
        $controller->politiqueConfidentialite();
        break;

    default:
        http_response_code(404);
        $controller = new HomeController();
        $controller->notFound();
        break;
}

// Inclure le footer APRÈS l'exécution de la logique du contrôleur,
// SAUF si c'est une requête API
if (!isset($_GET['api']) || $_GET['api'] !== 'true') {
    require_once __DIR__ . '/views/footer.php';
}

?>