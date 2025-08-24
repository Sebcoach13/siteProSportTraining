<?php
require_once __DIR__ . '/header.php';
?>

<main class="auth-page">
    <section class="auth-container">
        <h2>« Connectez-vous pour réserver votre séance de coaching »</h2>
        <img src="/assets/img/utilisateur.png" alt="Photo du utilisateur" class="utilisateur-photo">
        <?php
        if (isset($_GET['error'])) {
            echo '<p class="error-message">' . htmlspecialchars($_GET['error']) . '</p>';
        }
        if (isset($_GET['success'])) {
            echo '<p class="success-message">' . htmlspecialchars($_GET['success']) . '</p>';
        }
        ?>

        <form action="/index.php?page=connection" method="POST">
            <div class="form-group">
                <img src="/assets/img/mail.png" alt="Photo mail" class="mail-photo">
                <label for="email">Email-ID :</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <img src="/assets/img/verrou.png" alt="Photo verrou" class="verrou-photo">
                <label for="password">Password :</label>
                <input type="password" id="password" name="password" required>
            </div>

            <button type="submit" name="submit_login" class="btn btn-login">Se connecter</button>
        </form>
        <p>Pas encore de compte ? <a href="/index.php?page=inscription">Inscrivez-vous ici</a>.</p>
    </section>
</main>

<?php
require_once __DIR__ . '/footer.php';
?>