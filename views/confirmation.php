<?php
include_once __DIR__ . '/header.php';
?>

<main>
    <section class="confirmation-section">
        <h2>Confirmation de votre Payement</h2>

        <?php if (isset($message)): ?>
            <div class="alert alert-<?php echo htmlspecialchars($message['type']); ?>">
                <?php echo htmlspecialchars($message['text']); ?>
            </div>
        <?php else: ?>
            <div class="alert alert-success">
                Votre réservation a été confirmée avec succès ! Un e-mail de confirmation vous a été envoyé.
            </div>
        <?php endif; ?>
        
        <p>Merci pour votre confiance. Nous sommes impatients de vous accompagner !</p>
        <a href="/index.php?page=accueil" class="btn">Retour à l'accueil</a>
        <a href="/index.php?page=mesreservations" class="btn secondary-button">Voir mes réservations</a>
    </section>
</main>

<?php
include_once __DIR__ . '/footer.php';
?>

