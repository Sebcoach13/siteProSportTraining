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
        setcookie('remember_me_token', $newToken, time() + (86400 * 30), '/', '', false, true);
    } else {
        setcookie('remember_me_token', '', time() - 3600, '/');
    }
}

$page = $_GET['page'] ?? 'accueil';
$isLoggedIn = isset($_SESSION['user_id']);

$protectedPages = ['agenda', 'panier', 'paiement', 'confirmation', 'confpaiement', 'moncompte', 'mesreservations'];

if (in_array($page, $protectedPages) && !$isLoggedIn) {
    $_SESSION['redirect_after_login'] = $page;
    $_SESSION['redirect_after_login_params'] = $_GET;
    header('Location: /siteProSportTraining/index.php?page=connection&error=Vous devez être connecté ou inscrit pour accéder à cette page.');
    exit();
}
$pageTitle = 'PRO SPORT-TRAINING - Coaching Sportif personnalisé';
$pageDescription = 'Découvrez PRO SPORT-TRAINING, votre coach sportif diplômé à Marseille et Aix-en-Provence. Accompagnement sur mesure pour tous vos objectifs de remise en forme.';

if ((!isset($_GET['api']) || $_GET['api'] !== 'true') && $page !== 'paiement_process') {
    require_once __DIR__ . '/views/header.php';
}

switch ($page) {
    case 'accueil':
        // Titre et description optimisés pour la page d'accueil
        $pageTitle = 'PRO SPORT-TRAINING - Coaching Sportif à Marseille et Aix-en-Provence';
        $pageDescription = 'Coaching sportif à domicile ou en entreprise avec Sébastien Da Costa. Programmes personnalisés pour la performance, le bien-être et la perte de poids.';
        $controller = new HomeController();
        $controller->index();
        break;

    case 'apropos':
        // Titre et description optimisés pour la page "À Propos"
        $pageTitle = 'À propos de PRO SPORT-TRAINING - Sébastien Da Costa, Coach Sportif';
        $pageDescription = 'Découvrez le parcours de Sébastien Da Costa, votre coach sportif certifié. Plus de 10 ans d\'expérience dans le coaching personnalisé et la préparation physique.';
        $controller = new HomeController();
        $controller->apropos();
        break;

    case 'coaching':
        // Titre et description optimisés pour la page "Coaching"
        $pageTitle = 'Nos services de Coaching Sportif - Préparation Physique, Perte de Poids';
        $pageDescription = 'PRO SPORT-TRAINING propose des séances de coaching personnalisées : renforcement musculaire, cardio, boxe, et programmes sur mesure. Atteignez vos objectifs avec un accompagnement expert.';
        $controller = new HomeController();
        $controller->coaching();
        break;

    case 'contact':
        // Titre et description optimisés pour la page "Contact"
        $pageTitle = 'Contactez votre Coach Sportif - PRO SPORT-TRAINING';
        $pageDescription = 'Besoin d\'un renseignement ou de prendre rendez-vous ? Contactez Sébastien Da Costa pour un accompagnement personnalisé. Devis gratuit.';
        $controller = new ContactController();
        $controller->index();
        break;

    case 'agenda':
        // Titre et description optimisés pour la page "Agenda"
        $pageTitle = 'Agenda de Réservation - PRO SPORT-TRAINING';
        $pageDescription = 'Consultez l\'agenda de Sébastien Da Costa et réservez votre séance de coaching sportif en ligne. Horaires disponibles en temps réel.';
        $controller = new HomeController();
        $controller->agenda();
        break;
    
    // Ajout d'autres cas pour les pages spécifiques afin d'éviter d'avoir le titre par défaut sur toutes les pages.
    case 'connection':
        $pageTitle = 'Connexion à votre compte - PRO SPORT-TRAINING';
        $pageDescription = 'Connectez-vous à votre espace personnel pour gérer vos réservations et vos informations.';
        $controller = new UserController();
        $controller->login();
        break;

    case 'inscription':
        $pageTitle = 'Inscription - Créez votre compte PRO SPORT-TRAINING';
        $pageDescription = 'Créez votre compte client pour réserver vos séances de coaching sportif facilement.';
        $controller = new UserController();
        $controller->register();
        break;
        
    case 'mentions-legales':
        $pageTitle = 'Mentions Légales - PRO SPORT-TRAINING';
        $pageDescription = 'Informations légales et mentions obligatoires du site PRO SPORT-TRAINING.';
        $controller = new HomeController();
        $controller->mentionsLegales();
        break;

    case 'politique-confidentialite':
        $pageTitle = 'Politique de Confidentialité - PRO SPORT-TRAINING';
        $pageDescription = 'Découvrez notre politique de confidentialité concernant la gestion de vos données personnelles.';
        $controller = new HomeController();
        $controller->politiqueConfidentialite();
        break;

    case 'moncompte':
        $pageTitle = 'Mon Compte - Espace Client';
        $pageDescription = 'Gérez votre profil, vos informations personnelles et votre mot de passe.';
        $controller = new UserController();
        $controller->monCompte();
        break;

    case 'mesreservations':
        $pageTitle = 'Mes Réservations - Suivi des séances';
        $pageDescription = 'Consultez l\'historique de vos réservations de séances de coaching.';
        $controller = new UserController();
        $controller->mesReservations();
        break;

    // ne nécessitent pas de modifications de titre/description
    case 'api':
    case 'register':
    case 'logout':
    case 'panier':
    case 'paiement':
    case 'paiement_process':
    case 'confpaiement':
    case 'confirmation':
    case 'edit_profile':
        if ($page === 'api') {
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
        } elseif ($page === 'register') {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $controller = new UserController();
                $controller->register();
            } else {
                header('Location: /siteProSportTraining/index.php?page=inscription');
                exit();
            }
        } elseif ($page === 'logout') {
            $controller = new UserController();
            $controller->logout();
        } elseif ($page === 'panier') {
            $controller = new CartController();
            $controller->index();
        } elseif ($page === 'paiement') {
            $controller = new ReservationController();
            $controller->paiement();
        } elseif ($page === 'paiement_process') {
            $controller = new ReservationController();
            $controller->processStripePayment();
        } elseif ($page === 'confpaiement') {
            $controller = new ReservationController();
            $controller->confirmationPaiement();
        } elseif ($page === 'confirmation') {
            $controller = new ReservationController();
            $controller->confirmation();
        } elseif ($page === 'edit_profile') {
            $controller = new UserController();
            $controller->editProfile();
        }
        break;

    default:
        // Titre et description optimisés pour une page 404
        http_response_code(404);
        $pageTitle = 'Page introuvable - PRO SPORT-TRAINING';
        $pageDescription = 'La page que vous recherchez n\'existe pas.';
        $controller = new HomeController();
        $controller->notFound();
        break;
}

if ((!isset($_GET['api']) || $_GET['api'] !== 'true') && $page !== 'paiement_process') {
    require_once __DIR__ . '/views/footer.php';
}
?>
