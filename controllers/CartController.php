<?php
class CartController {
    private $services = [
        1 => ['name' => 'Boxe', 'price' => 60, 'image' => '/assets/img/coachBoxe.png'],
        2 => ['name' => 'Préparation Physique', 'price' => 60, 'image' => '/assets/img/coachPrepa.png'],
        3 => ['name' => 'Musculation', 'price' => 60, 'image' => '/assets/img/coachMuscu.png'],
    ];

    public function index() {
        error_log("CartController::index() appelé.");

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
            error_log("Panier initialisé dans la session.");
        } else {
            error_log("Panier déjà existant dans la session. Contenu actuel: " . print_r($_SESSION['cart'], true));
        }

        $date = $_GET['date'] ?? null;
        $serviceId = $_GET['service_id'] ?? null;
        $action = $_GET['action'] ?? null;

        error_log("Paramètres GET reçus: date=" . ($date ?? 'null') . ", service_id=" . ($serviceId ?? 'null') . ", action=" . ($action ?? 'null'));

        if ($date && $serviceId) {
            error_log("Date et Service ID présents. Tentative d'ajout au panier.");
            if (isset($this->services[$serviceId])) {
                $service = $this->services[$serviceId];
                $itemKey = $serviceId . '_' . $date; 
                
                if (!isset($_SESSION['cart'][$itemKey])) {
                    $_SESSION['cart'][$itemKey] = [
                        'service_id' => $serviceId,
                        'name' => $service['name'],
                        'price' => $service['price'],
                        'image' => $service['image'],
                        'date' => $date
                    ];
                    error_log("Article ajouté au panier: " . $service['name'] . " pour la date " . $date);
                   
                    header('Location: /index.php?page=panier');
                    exit();
                } else {
                    error_log("Article déjà présent dans le panier pour cette date.");
                }
            } else {
                error_log("ERREUR: Prestation non trouvée pour service_id=" . $serviceId);
                $_SESSION['message'] = ['type' => 'error', 'text' => 'Prestation non trouvée.'];
            }
        }

        if ($action === 'remove' && isset($_GET['item_key'])) {
            $itemKeyToRemove = $_GET['item_key'];
            if (isset($_SESSION['cart'][$itemKeyToRemove])) {
                unset($_SESSION['cart'][$itemKeyToRemove]);
                $_SESSION['message'] = ['type' => 'success', 'text' => 'Article supprimé du panier.'];
                error_log("Article supprimé du panier: " . $itemKeyToRemove);
            } else {
                error_log("ERREUR: Article à supprimer non trouvé dans le panier: " . $itemKeyToRemove);
            }
            header('Location: /index.php?page=panier');
            exit();
        }

        $total = 0;
        foreach ($_SESSION['cart'] as $item) {
            $total += $item['price'];
        }
        error_log("Total du panier calculé: " . $total);

        $cartItems = $_SESSION['cart'];
        $message = $_SESSION['message'] ?? null;
        unset($_SESSION['message']);

        error_log("Contenu final du panier avant de charger la vue: " . print_r($cartItems, true));

        require_once __DIR__ . '/../views/panier.php';
    }
}
