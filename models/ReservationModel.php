<?php

require_once __DIR__ . '/../config/config.php';

class ReservationModel {
    private $pdo;

    public function __construct() {
        global $pdo;
        $this->pdo = $pdo;
    }

    public function addReservation($userId, $date, $time, $serviceType, $price) {
        $coachId = null;
        $endTime = date('H:i:s', strtotime($time . ' +1 hour'));
        $durationMinutes = 60;
        $status = 'confirmed';
        $paymentStatus = 'paid';

        $sql = "
            INSERT INTO reservations (
                user_id, coach_id, service_type, reservation_date, start_time, end_time,
                duration_minutes, price, status, payment_status, created_at, updated_at
            ) VALUES (
                :user_id, :coach_id, :service_type, :reservation_date, :start_time, :end_time,
                :duration_minutes, :price, :status, :payment_status, NOW(), NOW()
            )
        ";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
            $stmt->bindParam(':coach_id', $coachId, PDO::PARAM_INT);
            $stmt->bindParam(':service_type', $serviceType, PDO::PARAM_STR);
            $stmt->bindParam(':reservation_date', $date, PDO::PARAM_STR);
            $stmt->bindParam(':start_time', $time, PDO::PARAM_STR);
            $stmt->bindParam(':end_time', $endTime, PDO::PARAM_STR);
            $stmt->bindParam(':duration_minutes', $durationMinutes, PDO::PARAM_INT);
            $stmt->bindParam(':price', $price, PDO::PARAM_STR);
            $stmt->bindParam(':status', $status, PDO::PARAM_STR);
            $stmt->bindParam(':payment_status', $paymentStatus, PDO::PARAM_STR);
            
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Erreur lors de l'ajout de réservation (addReservation): " . $e->getMessage());
            return false;
        }
    }

    public function getReservedSlots() {
        $sql = "SELECT reservation_date, start_time, service_type FROM reservations WHERE status IN ('confirmed', 'pending')";
        try {
            $stmt = $this->pdo->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erreur lors de la récupération des créneaux réservés (getReservedSlots): " . $e->getMessage());
            return [];
        }
    }

    public function isSlotReserved($date, $time, $serviceType) {
        $sql = "SELECT COUNT(*) FROM reservations WHERE reservation_date = :date AND start_time = :time AND service_type = :service_type AND status IN ('confirmed', 'pending')";
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':date', $date);
            $stmt->bindParam(':time', $time);
            $stmt->bindParam(':service_type', $serviceType);
            $stmt->execute();
            return $stmt->fetchColumn() > 0;
        } catch (PDOException $e) {
            error_log("Erreur lors de la vérification du créneau réservé (isSlotReserved): " . $e->getMessage());
            return true;
        }
    }

    public function getReservationById($reservationId) {
        $stmt = $this->pdo->prepare("SELECT * FROM reservations WHERE id = :id");
        $stmt->bindParam(':id', $reservationId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateReservationStatus($reservationId, $newStatus, $newPaymentStatus = null) {
        $query = "UPDATE reservations SET status = :new_status, updated_at = CURRENT_TIMESTAMP";
        if ($newPaymentStatus !== null) {
            $query .= ", payment_status = :new_payment_status";
        }
        $query .= " WHERE id = :id";

        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':new_status', $newStatus, PDO::PARAM_STR);
        if ($newPaymentStatus !== null) {
            $stmt->bindParam(':new_payment_status', $newPaymentStatus, PDO::PARAM_STR);
        }
        $stmt->bindParam(':id', $reservationId, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function getUserReservations($userId) {
        $sql = "SELECT * FROM reservations WHERE user_id = :user_id ORDER BY reservation_date DESC, start_time ASC";
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':user_id', $userId);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erreur lors de la récupération des réservations de l'utilisateur: " . $e->getMessage());
            return [];
        }
    }
}