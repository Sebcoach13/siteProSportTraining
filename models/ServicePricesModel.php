<?php
require_once __DIR__ . '/../config/config.php';

class ServicePricesModel {
    private $pdo;

    public function __construct() {
      
        global $pdo;
        $this->pdo = $pdo;
    }

    public function getPrices() {
        $sql = "SELECT service_type, price FROM service_prices";
        try {
            $stmt = $this->pdo->query($sql);
            $prices = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $prices[$row['service_type']] = (float)$row['price']; 
            }
            return $prices;
        } catch (PDOException $e) {
            error_log("Erreur lors de la récupération des prix des services: " . $e->getMessage());
            return [
                'Coaching Individuel' => 50.00,
                'Coaching en Groupe' => 30.00,
                'Séance d\'essai' => 0.00 // 
            ];
        }
    }
}