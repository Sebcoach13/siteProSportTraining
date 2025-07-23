<?php
require_once __DIR__ . '/header.php';
?>

<main class="auth-page">
    <section class="auth-container">
        <h2>Connexion</h2>

        <?php
        if (isset($_GET['error'])) {
            echo '<p class="error-message">' . htmlspecialchars($_GET['error']) . '</p>';
        }
        if (isset($_GET['success'])) {
            echo '<p class="success-message">' . htmlspecialchars($_GET['success']) . '</p>';
        }
        ?>

        <form action="/siteProSportTraining/index.php?page=connection" method="POST">
            <div class="form-group">
                <label for="email">Email :</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="password">Mot de passe :</label>
                <input type="password" id="password" name="password" required>
            </div>

            <button type="submit" name="submit_login" class="btn btn-login">Se connecter</button>
        </form>
        <p>Pas encore de compte ? <a href="/siteProSportTraining/index.php?page=inscription">Inscrivez-vous ici</a>.</p>
    </section>
</main>

<?php
require_once __DIR__ . '/footer.php';
?>