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

        <a href="/index.php?page=moncompte" class="btn secondary-button">Retour au compte</a>
    </section>
</main>

<?php
include_once __DIR__ . '/footer.php';
?>

