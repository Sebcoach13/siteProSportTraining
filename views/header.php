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
        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    </head>
<body>
    <header>
        <div class="header-left">
            <img src="assets/img/logo1.png" alt="Logo Pro Sport Training" class="header-logo">
            <h1>Pro Sport Training</h1>
        </div>
        <nav>
            <ul>
                <li><a href="index.php?page=accueil">ACCUEIL</a></li>
                <li><a href="index.php?page=apropos">À PROPOS</a></li>
                <li><a href="index.php?page=coaching">COACHING</a></li>
                <li><a href="index.php?page=contact">CONTACT</a></li>
                <li><a href="index.php?page=agenda">RÉSERVER</a></li>

                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="index.php?page=moncompte">MON COMPTE</a></li>
                    <li><a href="index.php?page=logout">DÉCONNEXION</a></li>
                <?php else: ?>
                    <li><a href="index.php?page=connection">CONNEXION</a></li>
                    <li><a href="index.php?page=inscription">INSCRIPTION</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>