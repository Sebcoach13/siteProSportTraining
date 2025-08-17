<?php
// views/edit_profile.php
include_once __DIR__ . '/header.php';

// Récupérer les informations de l'utilisateur depuis la session pour pré-remplir le formulaire
$userFirstName = $_SESSION['user_first_name'] ?? '';
$userLastName = $_SESSION['user_last_name'] ?? '';
$userEmail = $_SESSION['user_email'] ?? '';
?>

<main>
    <section class="edit-profile-section">
        <h2>Modifier mon profil</h2>
        <p>Mettez à jour vos informations personnelles ci-dessous.</p>

        <form action="/index.php?page=edit_profile" method="POST" class="edit-profile-form">
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
            <a href="/index.php?page=moncompte" class="btn secondary-button">Annuler</a>
        </form>
    </section>
</main>

<?php
include_once __DIR__ . '/footer.php';
?>

