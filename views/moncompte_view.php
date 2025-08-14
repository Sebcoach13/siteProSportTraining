<?php
// views/mon_compte.php

// Vérifie si l'utilisateur est connecté. Si ce n'est pas le cas, le redirige vers la page de connexion.
$isLoggedIn = isset($_SESSION['user_id']);
if (!$isLoggedIn) {
    header('Location: /siteProSportTraining/index.php?page=connection&error=Veuillez vous connecter pour accéder à cette page.');
    exit();
}

// Récupère les informations de l'utilisateur depuis la session
// Utilise l'opérateur de fusion null (??) pour éviter les erreurs si une variable n'existe pas
$firstName = $_SESSION['user_first_name'] ?? 'Utilisateur';
$lastName = $_SESSION['user_last_name'] ?? '';
$email = $_SESSION['user_email'] ?? '';
$role = $_SESSION['user_role'] ?? 'Client';

?>

<!--
    Le header et le footer ne sont pas inclus ici, car ils sont déjà inclus
    par le routeur principal (index.php) pour chaque page.
    Ce fichier ne doit contenir que le contenu de la page "Mon Compte".
-->
<main class="mon-compte-page">
    <section class="user-dashboard">
        <h1>Bienvenue, <?php echo htmlspecialchars($firstName); ?> !</h1>
        <p>C'est votre tableau de bord personnel.</p>

        <div class="user-info-block">
            <h2>Mes informations</h2>
            <p><strong>Nom :</strong> <?php echo htmlspecialchars($lastName); ?></p>
            <p><strong>Prénom :</strong> <?php echo htmlspecialchars($firstName); ?></p>
            <p><strong>Email :</strong> <?php echo htmlspecialchars($email); ?></p>
            <p><strong>Rôle :</strong> <?php echo htmlspecialchars($role); ?></p>
            <div class="profile-actions">
                <a href="/siteProSportTraining/index.php?page=edit_profile" class="btn btn-primary edit-profile-btn">Modifier mon profil</a>
            </div>
        </div>

        <div class="user-actions-block">
            <h2>Mes actions rapides</h2>
            <ul>
                <?php if ($role === 'Client'): ?>
                    <li><a href="/siteProSportTraining/index.php?page=agenda" class="btn">Prendre un rendez-vous</a></li>
                    <li><a href="/siteProSportTraining/index.php?page=mesreservations" class="btn">Voir mes réservations</a></li>
                <?php elseif ($role === 'Coach' || $role === 'Admin'): ?>
                    <li><a href="/siteProSportTraining/index.php?page=admin-dashboard" class="btn">Accéder au tableau de bord Admin/Coach</a></li>
                <?php endif; ?>
                <li><a href="/siteProSportTraining/index.php?page=logout" class="btn btn-danger">Déconnexion</a></li>
            </ul>
        </div>
    </section>
</main>
