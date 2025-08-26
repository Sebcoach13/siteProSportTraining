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

// Gestion de la connexion automatique via cookie
if (!isset($_SESSION['user_id']) && isset($_COOKIE['remember_me_token']) && !empty($_COOKIE['remember_me_token'])) {
    $userModel = new UserModel($pdo);
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

// Définition de la page et de l'état de connexion
$page = $_GET['page'] ?? 'accueil';
$isLoggedIn = isset($_SESSION['user_id']);

// Pages protégées nécessitant une connexion
$protectedPages = ['agenda', 'panier', 'paiement', 'confirmation', 'confpaiement', 'moncompte', 'mesreservations'];

// Redirection si l'utilisateur n'est pas connecté et essaie d'accéder à une page protégée
if (in_array($page, $protectedPages) && !$isLoggedIn) {
    $_SESSION['redirect_after_login'] = $page;
    $_SESSION['redirect_after_login_params'] = $_GET;
    header('Location: /index.php?page=connection&error=Vous devez être connecté ou inscrit pour accéder à cette page.');
    exit();
}

$pageTitle = 'PRO SPORT-TRAINING - Coaching Sportif personnalisé';
$pageDescription = 'Découvrez PRO SPORT-TRAINING, votre coach sportif diplômé à Marseille et Aix-en-Provence. Accompagnement sur mesure pour tous vos objectifs de remise en forme.';

// Inclusion conditionnelle du header
if ((!isset($_GET['api']) || $_GET['api'] !== 'true') && $page !== 'paiement_process') {
    require_once __DIR__ . '/views/header.php';
}

// Le routeur principal
switch ($page) {
    case 'accueil':
        $pageTitle = 'PRO SPORT-TRAINING - Coaching Sportif à Marseille et Aix-en-Provence';
        $pageDescription = 'Coaching sportif à domicile ou en entreprise avec Sébastien Da Costa. Programmes personnalisés pour la performance, le bien-être et la perte de poids.';
        $controller = new HomeController($pdo);
        $controller->index();
        break;

    case 'apropos':
        $pageTitle = 'À propos de PRO SPORT-TRAINING - Sébastien Da Costa, Coach Sportif';
        $pageDescription = 'Découvrez le parcours de Sébastien Da Costa, votre coach sportif certifié. Plus de 10 ans d\'expérience dans le coaching personnalisé et la préparation physique.';
        $controller = new HomeController($pdo);
        $controller->apropos();
        break;

    case 'coaching':
        $pageTitle = 'Nos services de Coaching Sportif - Préparation Physique, Perte de Poids';
        $pageDescription = 'PRO SPORT-TRAINING propose des séances de coaching personnalisées : renforcement musculaire, cardio, boxe, et programmes sur mesure. Atteignez vos objectifs avec un accompagnement expert.';
        $controller = new HomeController($pdo);
        $controller->coaching();
        break;

    case 'contact':
        $pageTitle = 'Contactez votre Coach Sportif - PRO SPORT-TRAINING';
        $pageDescription = 'Besoin d\'un renseignement ou de prendre rendez-vous ? Contactez Sébastien Da Costa pour un accompagnement personnalisé. Devis gratuit.';
        $controller = new ContactController($pdo);
        $controller->index();
        break;

    case 'contact_submit':
        $controller = new ContactController($pdo);
        $controller->processContactForm();
        break;

    case 'agenda':
        $pageTitle = 'Agenda de Réservation - PRO SPORT-TRAINING';
        $pageDescription = 'Consultez l\'agenda de Sébastien Da Costa et réservez votre séance de coaching sportif en ligne. Horaires disponibles en temps réel.';
        $controller = new HomeController($pdo);
        $controller->agenda();
        break;
    
    case 'connection':
        $pageTitle = 'Connexion à votre compte - PRO SPORT-TRAINING';
        $pageDescription = 'Connectez-vous à votre espace personnel pour gérer vos réservations et vos informations.';
        $controller = new UserController($pdo);
        $controller->login();
        break;

    case 'inscription':
        $pageTitle = 'Inscription - Créez votre compte PRO SPORT-TRAINING';
        $pageDescription = 'Créez votre compte client pour réserver vos séances de coaching sportif facilement.';
        $controller = new UserController($pdo);
        $controller->register();
        break;
        
    case 'register':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller = new UserController($pdo);
            $controller->register();
        } else {
            header('Location: /index.php?page=inscription');
            exit();
        }
        break;

    case 'logout':
        $controller = new UserController($pdo);
        $controller->logout();
        break;

    case 'moncompte':
        $pageTitle = 'Mon Compte - Espace Client';
        $pageDescription = 'Gérez votre profil, vos informations personnelles et votre mot de passe.';
        $controller = new UserController($pdo);
        $controller->monCompte();
        break;

    case 'mesreservations':
        $pageTitle = 'Mes Réservations - Suivi des séances';
        $pageDescription = 'Consultez l\'historique de vos réservations de séances de coaching.';
        $controller = new UserController($pdo);
        $controller->mesReservations();
        break;
    
    case 'edit_profile':
        $pageTitle = 'Mon Compte - Modifier mon profil';
        $pageDescription = 'Mettez à jour vos informations personnelles.';
        $controller = new UserController($pdo);
        $controller->editProfile();
        break;

    case 'panier':
        $pageTitle = 'Votre Panier - PRO SPORT-TRAINING';
        $pageDescription = 'Revoyez et validez les séances de coaching que vous souhaitez réserver.';
        $controller = new CartController($pdo);
        $controller->index();
        break;
        
    case 'paiement':
        $pageTitle = 'Paiement sécurisé - PRO SPORT-TRAINING';
        $pageDescription = 'Finalisez votre réservation de séances de coaching via notre plateforme de paiement sécurisé.';
        $controller = new ReservationController($pdo);
        $controller->paiement();
        break;
    
    case 'paiement_process':
        $controller = new ReservationController($pdo);
        $controller->processStripePayment();
        break;

    case 'confpaiement':
        $pageTitle = 'Confirmation de Paiement - PRO SPORT-TRAINING';
        $pageDescription = 'Votre paiement a été traité avec succès.';
        $controller = new ReservationController($pdo);
        $controller->confirmationPaiement();
        break;

    case 'confirmation':
        $pageTitle = 'Confirmation de Réservation - PRO SPORT-TRAINING';
        $pageDescription = 'Votre réservation de séances de coaching est confirmée.';
        $controller = new ReservationController($pdo);
        $controller->confirmation();
        break;
        
    case 'api':
        $action = $_GET['action'] ?? '';
        $reservationController = new ReservationController($pdo);
        
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
    
    case 'mentions-legales':
        $pageTitle = 'Mentions Légales - PRO SPORT-TRAINING';
        $pageDescription = 'Informations légales et mentions obligatoires du site PRO SPORT-TRAINING.';
        $controller = new HomeController($pdo);
        $controller->mentionsLegales();
        break;

    case 'politique-confidentialite':
        $pageTitle = 'Politique de Confidentialité - PRO SPORT-TRAINING';
        $pageDescription = 'Découvrez notre politique de confidentialité concernant la gestion de vos données personnelles.';
        $controller = new HomeController($pdo);
        $controller->politiqueConfidentialite();
        break;

    // J'ai corrigé cette ligne pour que 'cgv' soit géré correctement.
    case 'cgv':
        $pageTitle = 'Conditions Générales de Vente - PRO SPORT-TRAINING';
        $pageDescription = 'Découvrez nos conditions générales de vente.';
        $controller = new HomeController($pdo);
        $controller->conditionsGeneralesDeVente();
        break;

    default:
        http_response_code(404);
        $pageTitle = 'Page introuvable - PRO SPORT-TRAINING';
        $pageDescription = 'La page que vous recherchez n\'existe pas.';
        $controller = new HomeController($pdo);
        $controller->notFound();
        break;
}

// Inclusion conditionnelle du footer
if ((!isset($_GET['api']) || $_GET['api'] !== 'true') && $page !== 'paiement_process') {
    require_once __DIR__ . '/views/footer.php';
}
?>
