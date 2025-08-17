<?php
require_once __DIR__ . '/header.php';
?>

<main class="auth-page">
    <section class="auth-container">
        <h2>Inscription</h2>

        <?php
        if (isset($error) && !empty($error)) {
            echo '<p class="error-message">' . htmlspecialchars($error) . '</p>';
        }
        if (isset($success) && !empty($success)) {
            echo '<p class="success-message">' . htmlspecialchars($success) . '</p>';
        }
        ?>

        <form action="/index.php?page=inscription" method="POST">
            <div class="form-group">
                <label for="firstname">Prénom :</label>
                <input type="text" id="firstname" name="firstname" value="<?php echo htmlspecialchars($_POST['firstname'] ?? ''); ?>">
            </div>

            <div class="form-group">
                <label for="lastname">Nom :</label>
                <input type="text" id="lastname" name="lastname" value="<?php echo htmlspecialchars($_POST['lastname'] ?? ''); ?>">
            </div>

            <div class="form-group">
                <label for="email">Email :</label>
                <input type="email" id="email" name="email" required value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
            </div>

            <div class="form-group">
                <label for="password">Mot de passe :</label>
                <input type="password" id="password" name="password" required>
            </div>

            <div class="form-group">
                <label for="confirm_password">Confirmer le mot de passe :</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>

            <button type="submit" name="submit_register" class="btn btn-login">S'inscrire</button>
        </form>
        <p>Déjà un compte ? <a href="/index.php?page=connection">Connectez-vous ici</a>.</p>
    </section>
</main>

<?php
require_once __DIR__ . '/footer.php';
?>