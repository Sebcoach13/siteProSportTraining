<?php
// views/mon_compte.php
include_once __DIR__ . '/header.php';

$isLoggedIn = isset($_SESSION['user_id']);
if (!$isLoggedIn) {
    header('Location: /siteProSportTraining/index.php?page=connection&error=Veuillez vous connecter pour accéder à cette page.');
    exit();
}

$firstName = $_SESSION['user_first_name'] ?? 'Utilisateur';
$lastName = $_SESSION['user_last_name'] ?? '';
$email = $_SESSION['user_email'] ?? '';
$role = $_SESSION['user_role'] ?? 'Client'; 

?>

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

<?php
// Inclure le footer
include_once __DIR__ . '/footer.php';
?>

<style>
    /* Styles spécifiques à cette page, si non déjà dans style.css */
    .mon-compte-page {
        padding: 20px;
        background-color: var(--color-background-primary);
    }
    .user-dashboard {
        max-width: 800px;
        margin: 50px auto;
        padding: 30px;
        background-color: #ffffff;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        text-align: center;
    }
    .user-dashboard h1 {
        color: var(--color-text-primary);
        margin-bottom: 20px;
        font-size: var(--font-size-title-secondary);
    }
    .user-dashboard p {
        color: var(--color-text-primary);
        margin-bottom: 30px;
    }
    .user-info-block, .user-actions-block {
        background-color: var(--color-background-light-grey);
        border: 1px solid #eee;
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 20px;
        text-align: left;
    }
    .user-info-block h2, .user-actions-block h2 {
        color: var(--color-text-primary);
        margin-top: 0;
        margin-bottom: 15px;
        font-size: 1.3em;
    }
    .user-info-block p {
        margin: 10px 0;
        color: var(--color-text-primary);
    }
    .user-info-block strong {
        color: var(--color-text-primary);
    }
    .profile-actions, .user-actions-block ul {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 15px;
        list-style: none;
        padding: 0;
        justify-content: center; /* Centrer les boutons */
    }
    .profile-actions .btn, .user-actions-block .btn {
        flex-grow: 1; /* Permet aux boutons de prendre de l'espace */
        max-width: 200px; /* Limite la largeur des boutons */
    }
    .edit-profile-btn {
        background-color: var(--color-button-background);
        color: var(--color-text-nav-button);
    }
    .edit-profile-btn:hover {
        background-color: var(--color-button-hover);
    }
    .btn-danger {
        background-color: #dc3545;
        color: white;
    }
    .btn-danger:hover {
        background-color: #c82333;
    }
    /* Styles pour les liens dans les listes d'actions rapides */
    .user-actions-block ul li a.btn {
        width: 100%; /* S'assurer que les boutons prennent toute la largeur disponible dans leur conteneur */
        box-sizing: border-box; /* Inclure le padding et la bordure dans la largeur */
        text-align: center;
    }
</style>
