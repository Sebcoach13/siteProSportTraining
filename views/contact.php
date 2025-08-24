<section class="contact-form-section">
    <h2>Contactez-nous</h2>

    <?php
    // Afficher les messages de succès ou d'erreur depuis la session
    if (isset($_SESSION['success_message']) && !empty($_SESSION['success_message'])) {
        echo '<p style="color: green;">' . htmlspecialchars($_SESSION['success_message']) . '</p>';
        unset($_SESSION['success_message']); 
    }
    if (isset($_SESSION['error_message']) && !empty($_SESSION['error_message'])) {
        echo '<p style="color: red;">' . htmlspecialchars($_SESSION['error_message']) . '</p>';
        unset($_SESSION['error_message']); 
    }
    ?>

    <form action="/index.php?page=contact_submit" method="POST" class="contact-form">
        <div class="form-group">
            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" value="<?php echo htmlspecialchars($_POST['nom'] ?? ''); ?>" required>
        </div>

        <div class="form-group">
            <label for="prenom">Prénom :</label>
            <input type="text" id="prenom" name="prenom" value="<?php echo htmlspecialchars($_POST['prenom'] ?? ''); ?>" required>
        </div>

        <div class="form-group">
            <label for="societe">Société (Optionnel) :</label>
            <input type="text" id="societe" name="societe" value="<?php echo htmlspecialchars($_POST['societe'] ?? ''); ?>">
        </div>

        <div class="form-group">
            <label for="email">Email :</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>" required>
        </div>

        <div class="form-group">
            <label for="message">Message :</label>
            <textarea id="message" name="message" rows="8" required><?php echo htmlspecialchars($_POST['message'] ?? ''); ?></textarea>
        </div>

        <button type="submit" name="submit_contact">Envoyer</button>
        
    </form>
</section>
