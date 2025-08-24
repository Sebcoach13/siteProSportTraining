<?php
include_once __DIR__ . '/header.php';
?>

<main>
    <section class="panier-section">
        <h2>Votre Panier</h2>

        <?php if (isset($message)): ?>
            <div class="alert alert-<?php echo htmlspecialchars($message['type']); ?>">
                <?php echo htmlspecialchars($message['text']); ?>
            </div>
        <?php endif; ?>

        <?php if (empty($cartItems)): ?>
            <p>Votre panier est vide. <a href="/index.php?page=coaching">Retour aux prestations</a></p>
        <?php else: ?>
            <div class="cart-items">
                <?php foreach ($cartItems as $itemKey => $item): ?>
                    <div class="cart-item">
                        <img src="<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>">
                        <div class="item-details">
                            <h3><?php echo htmlspecialchars($item['name']); ?></h3>
                            <p>Date de réservation: <?php echo htmlspecialchars($item['date']); ?></p>
                            <p>Prix: <?php echo htmlspecialchars(number_format($item['price'], 2, ',', ' ')); ?> €</p>
                            <a href="/index.php?page=panier&action=remove&item_key=<?php echo htmlspecialchars($itemKey); ?>" class="remove-item-btn">Supprimer</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="cart-summary">
                <h3>Total du panier: <?php echo htmlspecialchars(number_format($total, 2, ',', ' ')); ?> €</h3>
                <a href="/index.php?page=paiement" class="btn">Confirmer le panier et passer au paiement</a>
            </div>
        <?php endif; ?>
    </section>
</main>

<?php
include_once __DIR__ . '/footer.php';
?>

