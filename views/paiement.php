<?php
include_once __DIR__ . '/header.php';
?>

<main>
    <section class="paiement-section">
        <h2>Finaliser votre réservation</h2>
        <p>Veuillez remplir les informations de paiement pour confirmer votre réservation.</p>

        <?php if (empty($cartItems)): ?>
            <p class="error-message">Votre panier est vide. <a href="/index.php?page=coaching">Retour aux prestations</a></p>
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
                    <div id="card-element" class="stripe-card-element">
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

<script src="https://js.stripe.com/v3/"></script>

<script>
    const stripe = Stripe('pk_test_51RqcmGEHBPogubYZpUcshH9bvH29lDhrtwWFrBmgSU2nhKJHslRwbNh3W2x9JWGpOwaIofPlYFTOjIMIEoYd2q8B00HeegEL0c'); 
    const elements = stripe.elements();

    const card = elements.create('card');
    card.mount('#card-element');

    card.addEventListener('change', function(event) {
        const displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
            displayError.style.display = 'block';
        } else {
            displayError.textContent = '';
            displayError.style.display = 'none';
        }
    });

    const form = document.getElementById('payment-form');
    const cardErrors = document.getElementById('card-errors');

    form.addEventListener('submit', async function(event) {
        event.preventDefault();

        const { token, error } = await stripe.createToken(card);

        if (error) {
            cardErrors.textContent = error.message;
            cardErrors.style.display = 'block';
        } else {
            cardErrors.style.display = 'none';

            try {
                const response = await fetch('/index.php?page=paiement_process', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ stripeToken: token.id })
                });

                const result = await response.json();

                if (result.success) {
                    window.location.href = '/index.php?page=confpaiement';
                } else {
                    cardErrors.textContent = result.message || 'Une erreur est survenue lors du paiement.';
                    cardErrors.style.display = 'block';
                }
            } catch (fetchError) {
                cardErrors.textContent = 'Erreur de connexion au serveur de paiement.';
                cardErrors.style.display = 'block';
            }
        }
    });
</script>

