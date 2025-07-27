<div class="container my-5">
    <h1>Modifier mon profil</h1>

    <?php if (!empty($success)): ?>
        <div class="alert alert-success" role="alert">
            <?php echo htmlspecialchars($success); ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($error)): ?>
        <div class="alert alert-danger" role="alert">
            <?php echo htmlspecialchars($error); ?>
        </div>
    <?php endif; ?>

    <form action="/siteProSportTraining/index.php?page=edit_profile" method="POST">
        <div class="mb-3">
            <label for="firstname" class="form-label">Prénom</label>
            <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo htmlspecialchars($user['firstname'] ?? ''); ?>" required>
        </div>
        <div class="mb-3">
            <label for="lastname" class="form-label">Nom</label>
            <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo htmlspecialchars($user['lastname'] ?? ''); ?>" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($user['email'] ?? ''); ?>" required>
        </div>
        <div class="mb-3">
            <label for="new_password" class="form-label">Nouveau mot de passe (laisser vide si inchangé)</label>
            <input type="password" class="form-control" id="new_password" name="new_password">
        </div>
        <div class="mb-3">
            <label for="confirm_new_password" class="form-label">Confirmer nouveau mot de passe</label>
            <input type="password" class="form-control" id="confirm_new_password" name="confirm_new_password">
        </div>
        <button type="submit" name="submit_update_profile" class="btn btn-primary">Mettre à jour le profil</button>
        <a href="/siteProSportTraining/index.php?page=moncompte" class="btn btn-secondary">Annuler</a>
    </form>
</div>