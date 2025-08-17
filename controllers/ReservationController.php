<?php
class ReservationController {
    private $stripeSecretKey = 'sk_test_51PZ2Wd2Lg9F7sU6k1234567890abcdefghijkLMNOPQRSTUVWXYZa';

    public function paiement() {
        $cartItems = $_SESSION['cart'] ?? [];
        $total = 0;
        foreach ($cartItems as $item) {
            $total += $item['price'];
        }

        if (empty($cartItems)) {
            $_SESSION['message'] = ['type' => 'error', 'text' => 'Votre panier est vide. Veuillez ajouter des articles avant de passer au paiement.'];
            header('Location: /index.php?page=panier');
            exit();
        }

        require_once __DIR__ . '/../views/paiement.php';
    }

    public function processStripePayment() {
        header('Content-Type: application/json');

        $input = file_get_contents('php://input');
        $data = json_decode($input, true);

        $stripeToken = $data['stripeToken'] ?? null;

        if (!$stripeToken) {
            echo json_encode(['success' => false, 'message' => 'Token Stripe manquant.']);
            exit();
        }

        $cartItems = $_SESSION['cart'] ?? [];
        $total = 0;
        foreach ($cartItems as $item) {
            $total += $item['price'];
        }

        if (empty($cartItems) || $total <= 0) {
            echo json_encode(['success' => false, 'message' => 'Panier vide ou montant invalide.']);
            exit();
        }

        $amountInCents = $total * 100;
        
        unset($_SESSION['cart']);
        echo json_encode(['success' => true, 'message' => 'Paiement simulé réussi !']);
        exit();
    }

    public function confirmationPaiement() {
        $message = ['type' => 'success', 'text' => 'Votre paiement a été traité avec succès et votre réservation est confirmée !'];
        require_once __DIR__ . '/../views/confirmation.php';
    }

    public function getReservedSlotsApi() {
        header('Content-Type: application/json');
        echo json_encode([]);
        exit();
    }

    public function createReservationApi() {
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'message' => 'API de création de réservation non implémentée.']);
        exit();
    }
}
