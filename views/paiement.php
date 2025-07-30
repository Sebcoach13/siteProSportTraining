<?php
// views/paiement.php
include_once __DIR__ . '/header.php';
?>

<main>
    <section class="paiement-section">
        <h2>Finaliser votre réservation</h2>
        <p>Veuillez remplir les informations de paiement pour confirmer votre réservation.</p>

        <?php if (empty($cartItems)): ?>
            <p class="error-message">Votre panier est vide. <a href="/siteProSportTraining/index.php?page=coaching">Retour aux prestations</a></p>
        <?php else: ?>
            <div class="paiement-summary">
                <h3>Récapitulatif de votre commande :</h3>
                <ul>
                    <?php foreach ($cartItems as $item): ?>
                        <li><?php echo htmlspecialchars($item['name']); ?> (Date: <?php echo htmlspecialchars($item['date']); ?>) - <?php echo htmlspecialchars(number_format($item['price'], 2, ',', ' ')); ?> €</li>
                    <?php endforeach; ?>
                </ul>
                <p><strong>Total à payer : <?php echo htmlspecialchars(number_format($total, 2, ',', ' ')); ?> €</strong></p>
            </div>

            <form id="payment-form" class="paiement-form">
                <div class="form-group">
                    <label for="card-element">Détails de la carte :</label>
                    <!-- Un élément sera inséré ici par Stripe.js pour les champs de carte sécurisés -->
                    <div id="card-element">
                        <!-- Stripe Elements will be inserted here -->
                        <input type="text" id="card_number" placeholder="Numéro de carte" required style="width: calc(100% - 20px); padding: 12px 10px; border: 1px solid #ddd; border-radius: 5px; font-size: 1em; box-sizing: border-box; margin-bottom: 15px;">
                        <input type="text" id="card_expiry" placeholder="MM/AA" required style="width: calc(50% - 25px); padding: 12px 10px; border: 1px solid #ddd; border-radius: 5px; font-size: 1em; box-sizing: border-box; margin-right: 10px;">
                        <input type="text" id="card_cvc" placeholder="CVC" required style="width: calc(50% - 25px); padding: 12px 10px; border: 1px solid #ddd; border-radius: 5px; font-size: 1em; box-sizing: border-box;">
                    </div>
                </div>
                <div id="card-errors" role="alert" class="error-message" style="display:none;"></div>
                <button type="submit" class="btn">Payer maintenant</button>
            </form>
        <?php endif; ?>
    </section>
</main>

<?php
include_once __DIR__ . '/footer.php';
?>

<!-- Stripe.js CDN -->
<script src="https://js.stripe.com/v3/"></script>

<script>
    // Remplacez 'pk_test_YOUR_PUBLISHABLE_KEY' par votre clé publique Stripe réelle
    // C'est une clé PUBLIABLE, elle peut être exposée en toute sécurité.
    const stripe = Stripe('pk_test_51PZ2Wd2Lg9F7sU6kEaMv2WbWcQJ1C0Sg1XyYm2N6O2J7K9L0M1N2O3P4Q5R6S7T8U9V0W1X2Y3Z4'); // Exemple de clé test

    const form = document.getElementById('payment-form');
    const cardNumberInput = document.getElementById('card_number');
    const cardExpiryInput = document.getElementById('card_expiry');
    const cardCvcInput = document.getElementById('card_cvc');
    const cardErrors = document.getElementById('card-errors');

    form.addEventListener('submit', async function(event) {
        event.preventDefault(); // Empêche la soumission normale du formulaire

        // Récupérer les valeurs des champs (pour cette démo simplifiée)
        const cardNumber = cardNumberInput.value;
        const cardExpiry = cardExpiryInput.value; // Format MM/AA
        const cardCvc = cardCvcInput.value;

        // Extraire mois et année de la date d'expiration
        const [expMonth, expYear] = cardExpiry.split('/');

        // Créer un token de carte avec Stripe.js
        const { token, error } = await stripe.createToken('card', {
            number: cardNumber,
            exp_month: expMonth,
            exp_year: expYear,
            cvc: cardCvc
        });

        if (error) {
            // Afficher les erreurs à l'utilisateur
            cardErrors.textContent = error.message;
            cardErrors.style.display = 'block';
        } else {
            // Envoyer le token au serveur PHP
            cardErrors.style.display = 'none';
            const response = await fetch('/siteProSportTraining/index.php?page=paiement_process', { // Nouvelle route
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ stripeToken: token.id })
            });

            const result = await response.json();

            if (result.success) {
                window.location.href = '/siteProSportTraining/index.php?page=confpaiement';
            } else {
                cardErrors.textContent = result.message || 'Une erreur est survenue lors du paiement.';
                cardErrors.style.display = 'block';
            }
        }
    });
</script>

<style>
    .paiement-section {
        max-width: 600px;
        margin: 50px auto;
        padding: 30px;
        background-color: #ffffff;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        text-align: center;
    }
    .paiement-section h2 {
        color: var(--color-text-primary);
        margin-bottom: 20px;
        font-size: var(--font-size-title-secondary);
    }
    .paiement-section p {
        color: var(--color-text-primary);
        margin-bottom: 30px;
    }
    .paiement-summary {
        background-color: #f9f9f9;
        border: 1px solid #eee;
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 30px;
        text-align: left;
    }
    .paiement-summary h3 {
        color: var(--color-text-primary);
        margin-top: 0;
        margin-bottom: 15px;
        font-size: 1.3em;
    }
    .paiement-summary ul {
        list-style: none;
        padding: 0;
        margin-bottom: 15px;
    }
    .paiement-summary li {
        color: var(--color-text-primary);
        margin-bottom: 8px;
        font-size: 0.95em;
    }
    .paiement-summary strong {
        font-size: 1.2em;
        color: var(--color-text-primary);
    }
    .paiement-form .form-group {
        margin-bottom: 20px;
        text-align: left;
    }
    .paiement-form label {
        display: block;
        margin-bottom: 8px;
        font-weight: var(--font-weight-bold);
        color: var(--color-text-primary);
    }
    /* Les styles pour les inputs sont maintenant définis inline pour la démo, ou via Stripe Elements */
    .paiement-form .form-row {
        display: flex;
        gap: 20px;
    }
    .paiement-form .form-row .form-group {
        flex: 1;
    }
    .paiement-form .btn {
        width: 100%;
        padding: 15px;
        margin-top: 20px;
    }
    .error-message {
        color: red;
        background-color: #ffe6e6;
        border: 1px solid red;
        padding: 10px;
        margin-bottom: 15px;
        border-radius: 5px;
        text-align: center;
    }
</style>
