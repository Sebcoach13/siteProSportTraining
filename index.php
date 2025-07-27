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
$isLoggedIn = isset($_SESSION['user_id']); 

$protectedPages = ['agenda', 'panier', 'paiement', 'confirmation', 'confpaiement', 'moncompte'];

if (in_array($page, $protectedPages) && !$isLoggedIn) {
    $_SESSION['redirect_after_login'] = $page;
    header('Location: /siteProSportTraining/index.php?page=connection&error=Vous devez être connecté ou inscrit pour accéder à cette page.');
    exit();
}

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
        $controller = new ContactController();
        $controller->index();
        break;

    case 'agenda':
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
        $controller = new CartController();
        $controller->index();
        break;

    case 'paiement':
        $controller = new ReservationController();
        $controller->paiement();
        break;

    case 'confpaiement':
        $controller = new ReservationController();
        $controller->confirmationPaiement();
        break;

    case 'confirmation':
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

    case 'moncompte':
        $controller = new UserController();
        $controller->monCompte();
        break;
        case 'moncompte':
        $controller = new UserController();
        $controller->monCompte();
        break;

    case 'edit_profile': 
        $controller = new UserController();
        $controller->editProfile(); 
        break;

    default:
        http_response_code(404);
        $controller = new HomeController();
        $controller->notFound();
        break;
}

if (!isset($_GET['api']) || $_GET['api'] !== 'true') {
    require_once __DIR__ . '/views/footer.php';
}

?>