<?php
$pageTitle = $pageTitle ?? 'Pro Sport Training - Coaching Sportif Personnalisé';
$pageDescription = $pageDescription ?? 'Découvrez PRO SPORT-TRAINING, votre coach sportif diplômé à Marseille et Aix-en-Provence. Accompagnement sur mesure pour tous vos objectifs de remise en forme.';
$currentUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo htmlspecialchars($pageTitle); ?></title>
        
        <!-- Ajout de la balise meta description  SEO -->
        <meta name="description" content="<?php echo htmlspecialchars($pageDescription); ?>">
        
        <!-- Balise canonical pour éviter le contenu dupliqué  -->
        <link rel="canonical" href="<?php echo htmlspecialchars($currentUrl); ?>" />
        
        <!-- Balises Open Graph pour un meilleur partage sur les réseaux sociaux -->
        <meta property="og:title" content="<?php echo htmlspecialchars($pageTitle); ?>" />
        <meta property="og:description" content="<?php echo htmlspecialchars($pageDescription); ?>" />
        <meta property="og:url" content="<?php echo htmlspecialchars($currentUrl); ?>" />
        <meta property="og:type" content="website" />
        <meta property="og:image" content="URL_DE_L_IMAGE_A_DEFINIR_ICI" />
        <meta property="og:locale" content="fr_FR" />

        <!-- Indication aux robots d'indexation de suivre la page -->
        <meta name="robots" content="index, follow">
        <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.13/main.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="/assets/css/style.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" xintegrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        
    </head>
<body>
    <header class="header-main-line">
    <div class="header-logo-container">
        <a href="/index.php?page=accueil"><img src="/assets/img/logo2.png" alt="Logo Pro Sport Training" class="header-logo"></a>
        <div class="logo-text-bottom">
        </div>
    </div>
    
    <div class="header-right">
        <?php if ($page === 'accueil'): ?>
            <h1 class="header-main-title">PRO SPORT TRAINING</h1>
        <?php else: ?>
            <h2 class="header-main-title">PRO SPORT TRAINING</h2>
        <?php endif; ?>
        
        <button class="hamburger-btn" aria-expanded="false" aria-controls="main-menu">
            <span class="hamburger-line"></span>
            <span class="hamburger-line"></span>
            <span class="hamburger-line"></span>
        </button>

        <nav id="main-menu" class="nav-menu">
            <ul>
                <li><a href="/index.php?page=accueil">ACCUEIL</a></li>
                <li><a href="/index.php?page=apropos">À PROPOS</a></li>
                <li><a href="/index.php?page=coaching">COACHING</a></li>
                <li><a href="/index.php?page=contact">CONTACT</a></li>
                <li><a href="//index.php?page=agenda">RÉSERVER</a></li>
                
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="/index.php?page=moncompte">MON COMPTE</a></li>
                    <li><a href="/index.php?page=logout">DÉCONNEXION</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</header>
    <div class="content-wrapper">
