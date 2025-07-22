<main class="auth-page">
    <div class="auth-container">
        <p class="auth-intro">« Connectez-vous pour réserver votre séance de coaching »</p>

        <div class="profile-placeholder">
            <img src="assets/img/utilisateur.png" alt="Icône de profil par défaut">
        </div>

        <form id="loginForm" action="index.php?page=connection" method="POST">
            <?php
            // Affichage du message d'erreur si la variable $error est définie et non vide
            if (isset($error) && !empty($error)) {
                echo '<p class="error-message">' . htmlspecialchars($error) . '</p>';
            }
            ?>

            <div class="form-group">
                <label for="email" class="sr-only">Email-ID</label>
                <input type="email" id="email" name="email" placeholder="Email-ID" required value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
            </div>

            <div class="form-group">
                <label for="password" class="sr-only">Password</label>
                <input type="password" id="password" name="password" placeholder="Password" required>
            </div>

            <div class="form-options">
                <label for="remember_me">
                    <input type="checkbox" id="remember_me" name="remember_me"> Se souvenir de moi
                </label>
                <a href="#" class="forgot-password">Mot de passe oublié</a>
            </div>

            <button type="submit" name="submit_login" class="btn btn-login">LOGIN</button>
        </form>

        <a href="index.php?page=inscription" class="btn btn-register">ENREGISTRER</a>
    </div>
</main>