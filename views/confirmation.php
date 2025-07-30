<?php
include_once __DIR__ . '/header.php';
?>

<main>
    <section class="confirmation-section">
        <h2>Confirmation de votre réservation</h2>

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
        <a href="/siteProSportTraining/index.php?page=accueil" class="btn">Retour à l'accueil</a>
        <a href="/siteProSportTraining/index.php?page=mesreservations" class="btn secondary-button">Voir mes réservations</a>
    </section>
</main>

<?php
include_once __DIR__ . '/footer.php';
?>

<style>
    .confirmation-section {
        max-width: 800px;
        margin: 50px auto;
        padding: 30px;
        background-color: #ffffff;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        text-align: center;
    }
    .confirmation-section h2 {
        color: var(--color-text-primary);
        margin-bottom: 20px;
        font-size: var(--font-size-title-secondary);
    }
    .confirmation-section p {
        color: var(--color-text-primary);
        margin-bottom: 30px;
    }
    .confirmation-section .btn {
        margin: 10px;
    }
    .alert {
        padding: 15px;
        margin-bottom: 20px;
        border: 1px solid transparent;
        border-radius: 4px;
        text-align: left;
    }
    .alert-success {
        color: #155724;
        background-color: #d4edda;
        border-color: #c3e6cb;
    }
    .alert-error {
        color: #721c24;
        background-color: #f8d7da;
        border-color: #f5c6cb;
    }
    .secondary-button {
        background-color: #6c757d;
        color: white;
    }
    .secondary-button:hover {
        background-color: #5a6268;
    }
</style>
