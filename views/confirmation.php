<main class="auth-page">
    <div class="auth-container">
        <p class="auth-intro">« Connectez-vous pour réserver votre séance de coaching »</p>

        <div class="profile-placeholder">
            <img src="assets/img/default_profile.png" alt="Icône de profil par défaut">
        </div>

        <form id="loginForm" action="index.php?page=connection" method="POST">
            <div class="form-group">
                <label for="email" class="sr-only">Email-ID</label> <input type="email" id="email" name="email" placeholder="Email-ID" required>
            </div>

            <div class="form-group">
                <label for="password" class="sr-only">Password</label>
                <input type="password" id="password" name="password" placeholder="Password" required>
                <a href="#" class="forgot-password">S'inscrire</a> </div>

            <div class="form-options">
                <label for="remember_me">
                    <input type="checkbox" id="remember_me" name="remember_me"> Se souvenir de moi
                </label>
                <a href="#" class="forgot-password">Mot de passe oublié</a>
            </div>

            <button type="submit" class="btn btn-login">LOGIN</button>
        </form>

        <a href="index.php?page=inscription" class="btn btn-register">ENREGISTRER</a>
    </div>
</main>