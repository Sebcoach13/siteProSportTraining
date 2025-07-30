<?php
// views/edit_profile.php
include_once __DIR__ . '/header.php';

// Récupérer les informations de l'utilisateur depuis la session pour pré-remplir le formulaire
$userFirstName = $_SESSION['user_first_name'] ?? '';
$userLastName = $_SESSION['user_last_name'] ?? '';
$userEmail = $_SESSION['user_email'] ?? '';
// Pour un vrai système, vous récupéreriez les données depuis la base de données ici
?>

<main>
    <section class="edit-profile-section">
        <h2>Modifier mon profil</h2>
        <p>Mettez à jour vos informations personnelles ci-dessous.</p>

        <form action="/siteProSportTraining/index.php?page=edit_profile" method="POST" class="edit-profile-form">
            <div class="form-group">
                <label for="firstname">Prénom :</label>
                <input type="text" id="firstname" name="firstname" value="<?php echo htmlspecialchars($userFirstName); ?>" required>
            </div>
            <div class="form-group">
                <label for="lastname">Nom :</label>
                <input type="text" id="lastname" name="lastname" value="<?php echo htmlspecialchars($userLastName); ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email :</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($userEmail); ?>" required>
            </div>
            <div class="form-group">
                <label for="password">Nouveau mot de passe (laissez vide si inchangé) :</label>
                <input type="password" id="password" name="password">
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirmer le nouveau mot de passe :</label>
                <input type="password" id="confirm_password" name="confirm_password">
            </div>
            
            <button type="submit" class="btn">Enregistrer les modifications</button>
            <a href="/siteProSportTraining/index.php?page=moncompte" class="btn secondary-button">Annuler</a>
        </form>
    </section>
</main>

<?php
include_once __DIR__ . '/footer.php';
?>

<style>
    .edit-profile-section {
        max-width: 600px;
        margin: 50px auto;
        padding: 30px;
        background-color: #ffffff;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        text-align: center;
    }
    .edit-profile-section h2 {
        color: var(--color-text-primary);
        margin-bottom: 20px;
        font-size: var(--font-size-title-secondary);
    }
    .edit-profile-section p {
        color: var(--color-text-primary);
        margin-bottom: 30px;
    }
    .edit-profile-form .form-group {
        margin-bottom: 20px;
        text-align: left;
    }
    .edit-profile-form label {
        display: block;
        margin-bottom: 8px;
        font-weight: var(--font-weight-bold);
        color: var(--color-text-primary);
    }
    .edit-profile-form input[type="text"],
    .edit-profile-form input[type="email"],
    .edit-profile-form input[type="password"] {
        width: calc(100% - 20px);
        padding: 12px 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 1em;
        box-sizing: border-box;
    }
    .edit-profile-form .btn {
        margin-top: 20px;
        width: 100%;
        padding: 15px;
    }
    .edit-profile-form .secondary-button {
        background-color: #6c757d;
        color: white;
        margin-top: 10px;
    }
    .edit-profile-form .secondary-button:hover {
        background-color: #5a6268;
    }
</style>
