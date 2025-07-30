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
            <p>Votre panier est vide. <a href="/siteProSportTraining/index.php?page=coaching">Retour aux prestations</a></p>
        <?php else: ?>
            <div class="cart-items">
                <?php foreach ($cartItems as $itemKey => $item): ?>
                    <div class="cart-item">
                        <img src="<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>">
                        <div class="item-details">
                            <h3><?php echo htmlspecialchars($item['name']); ?></h3>
                            <p>Date de réservation: <?php echo htmlspecialchars($item['date']); ?></p>
                            <p>Prix: <?php echo htmlspecialchars(number_format($item['price'], 2, ',', ' ')); ?> €</p>
                            <a href="/siteProSportTraining/index.php?page=panier&action=remove&item_key=<?php echo htmlspecialchars($itemKey); ?>" class="remove-item-btn">Supprimer</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="cart-summary">
                <h3>Total du panier: <?php echo htmlspecialchars(number_format($total, 2, ',', ' ')); ?> €</h3>
                <a href="/siteProSportTraining/index.php?page=paiement" class="btn">Confirmer le panier et passer au paiement</a>
            </div>
        <?php endif; ?>
    </section>
</main>

<?php
include_once __DIR__ . '/footer.php';
?>

<style>
    .panier-section {
        max-width: 800px;
        margin: 50px auto;
        padding: 30px;
        background-color: #ffffff;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        text-align: center;
    }
    .panier-section h2 {
        color: var(--color-text-primary);
        margin-bottom: 30px;
        font-size: var(--font-size-title-secondary);
    }
    .cart-items {
        margin-bottom: 30px;
        text-align: left;
    }
    .cart-item {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 1px solid #eee;
    }
    .cart-item:last-child {
        border-bottom: none;
    }
    .cart-item img {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 8px;
        margin-right: 20px;
        flex-shrink: 0;
    }
    .item-details {
        flex-grow: 1;
    }
    .item-details h3 {
        margin: 0 0 5px 0;
        color: var(--color-text-primary);
        font-size: 1.2em;
    }
    .item-details p {
        margin: 0;
        color: var(--color-text-primary);
        font-size: 0.9em;
    }
    .remove-item-btn {
        color: #dc3545;
        text-decoration: none;
        font-size: 0.85em;
        margin-left: 15px;
        white-space: nowrap;
    }
    .remove-item-btn:hover {
        text-decoration: underline;
    }
    .cart-summary {
        text-align: right;
        margin-top: 30px;
        padding-top: 20px;
        border-top: 2px solid #ddd;
    }
    .cart-summary h3 {
        color: var(--color-text-primary);
        font-size: 1.5em;
        margin-bottom: 20px;
    }
    .btn {
        display: inline-block;
        padding: 12px 25px;
        background-color: var(--color-button-background);
        color: var(--color-text-nav-button);
        text-decoration: none;
        border-radius: 5px;
        font-weight: var(--font-weight-bold);
        transition: background-color 0.3s ease;
    }
    .btn:hover {
        background-color: var(--color-button-hover);
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
</style>
