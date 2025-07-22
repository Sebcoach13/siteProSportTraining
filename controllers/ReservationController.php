<?php

require_once __DIR__ . '/../models/ReservationModel.php';

class ReservationController {
    private $model;

    public function __construct() {
        $this->model = new ReservationModel();
    }

    public function agenda() {
        require_once 'views/agenda.php';
    }

    public function getReservedSlotsApi() {
        header('Content-Type: application/json');

        $reservedSlots = $this->model->getReservedSlots();

        echo json_encode(['success' => true, 'slots' => $reservedSlots]);
        exit();
    }

    public function createReservationApi() {
        header('Content-Type: application/json');

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode(['success' => false, 'message' => 'Méthode non autorisée.']);
            exit();
        }

        $input = file_get_contents('php://input');
        $data = json_decode($input, true);

        if (!isset($data['user_id'], $data['coach_id'], $data['service_type'], $data['reservation_date'], $data['start_time'], $data['end_time'], $data['duration_minutes'], $data['price'])) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Données de réservation manquantes.']);
            exit();
        }

        $userId = $data['user_id'];

        $isReserved = $this->model->isSlotReserved(
            $data['reservation_date'],
            $data['start_time'],
            $data['end_time'],
            $data['coach_id']
        );

        if ($isReserved) {
            http_response_code(409);
            echo json_encode(['success' => false, 'message' => 'Ce créneau est déjà réservé.']);
            exit();
        }

        $result = $this->model->createReservation(
            $userId,
            $data['coach_id'],
            $data['service_type'],
            $data['reservation_date'],
            $data['start_time'],
            $data['end_time'],
            $data['duration_minutes'],
            $data['price'],
            'pending',
            'unpaid',
            $data['notes'] ?? null
        );

        if ($result) {
            http_response_code(201);
            echo json_encode(['success' => true, 'message' => 'Réservation créée avec succès.']);
        } else {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => 'Erreur lors de la création de la réservation.']);
        }
        exit();
    }

    public function paiement() {
        require_once 'views/paiement.php';
    }

    public function confirmationPaiement() {
        require_once 'views/confpaiement.php';
    }

    public function confirmation() {
        require_once 'views/confirmation.php';
    }
}