<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Pro Sport Training - Coaching Sportif Personnalisé</title>
        <link rel="stylesheet" href="/siteProSportTraining/assets/css/style.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    </head>
<body>
    <header class="header-main-line">
        <div class="header-logo-container">
            <img src="/siteProSportTraining/assets/img/logo1.png" alt="Logo Pro Sport Training" class="header-logo">
            <div class="logo-text-bottom">
            </div>
        </div>
        
        <div class="header-right">
            <h1 class="header-main-title">PRO SPORT TRAINING</h1>
            <nav>
                <ul>
                    <li><a href="/siteProSportTraining/index.php?page=accueil">ACCUEIL</a></li>
                    <li><a href="/siteProSportTraining/index.php?page=apropos">À PROPOS</a></li>
                    <li><a href="/siteProSportTraining/index.php?page=coaching">COACHING</a></li>
                    <li><a href="/siteProSportTraining/index.php?page=contact">CONTACT</a></li>
                    <li><a href="/siteProSportTraining/index.php?page=agenda">RÉSERVER</a></li>

                    <?php if (isset($_SESSION['user_id'])): ?>
                        <li><a href="/siteProSportTraining/index.php?page=moncompte">MON COMPTE</a></li>
                        <li><a href="/siteProSportTraining/index.php?page=logout">DÉCONNEXION</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </header>
    <div class="content-wrapper">