<?php
include_once __DIR__ . '/header.php';
?>

<main>
    <section class="my-reservations-section">
        <h2>Mes Réservations</h2>
        <p>Voici le récapitulatif de vos réservations passées et à venir.</p>
        
        <?php if (empty($reservations)): ?>
            <div class="alert alert-info">
                Vous n'avez aucune réservation pour le moment.
            </div>
        <?php else: ?>
            <div class="reservations-list">
                <?php foreach ($reservations as $reservation): ?>
                    <div class="reservation-item">
                        <h3><?php echo htmlspecialchars($reservation['service_name']); ?></h3>
                        <p>Date: <?php echo htmlspecialchars($reservation['date']); ?></p>
                        <p>Prix: <?php echo htmlspecialchars(number_format($reservation['price'], 2, ',', ' ')); ?> €</p>
                        <p>Statut: <?php echo htmlspecialchars($reservation['status']); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <a href="/siteProSportTraining/index.php?page=moncompte" class="btn secondary-button">Retour au compte</a>
    </section>
</main>

<?php
include_once __DIR__ . '/footer.php';
?>

<style>
    .my-reservations-section {
        max-width: 800px;
        margin: 50px auto;
        padding: 30px;
        background-color: #ffffff;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        text-align: center;
    }
    .my-reservations-section h2 {
        color: var(--color-text-primary);
        margin-bottom: 20px;
        font-size: var(--font-size-title-secondary);
    }
    .my-reservations-section p {
        color: var(--color-text-primary);
        margin-bottom: 30px;
    }
    .reservations-list {
        margin-top: 20px;
    }
    .reservation-item {
        border: 1px solid #eee;
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 15px;
        background-color: #f9f9f9;
        text-align: left;
    }
    .reservation-item h3 {
        color: var(--color-text-primary);
        margin-top: 0;
        margin-bottom: 10px;
    }
    .reservation-item p {
        margin: 5px 0;
        color: var(--color-text-primary);
    }
    .alert-info {
        color: #0c5460;
        background-color: #d1ecf1;
        border-color: #bee5eb;
        padding: 15px;
        margin-bottom: 20px;
        border-radius: 4px;
        text-align: left;
    }
    .secondary-button {
        margin-top: 20px;
        background-color: #6c757d;
        color: white;
    }
    .secondary-button:hover {
        background-color: #5a6268;
    }
</style>
