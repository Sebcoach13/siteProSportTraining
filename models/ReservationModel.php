<?php

require_once __DIR__ . '/../config/config.php';

class ReservationModel {
    private $db;

    public function __construct() {
        global $pdo;
        $this->db = $pdo;
    }

    public function createReservation($userId, $coachId, $serviceType, $reservationDate, $startTime, $endTime, $durationMinutes, $price, $status = 'pending', $paymentStatus = 'unpaid', $notes = null) {
        $stmt = $this->db->prepare("
            INSERT INTO reservations (
                user_id, coach_id, service_type, reservation_date, start_time, end_time,
                duration_minutes, price, status, payment_status, notes
            ) VALUES (
                :user_id, :coach_id, :service_type, :reservation_date, :start_time, :end_time,
                :duration_minutes, :price, :status, :payment_status, :notes
            )
        ");

        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':coach_id', $coachId, PDO::PARAM_INT);
        $stmt->bindParam(':service_type', $serviceType, PDO::PARAM_STR);
        $stmt->bindParam(':reservation_date', $reservationDate, PDO::PARAM_STR);
        $stmt->bindParam(':start_time', $startTime, PDO::PARAM_STR);
        $stmt->bindParam(':end_time', $endTime, PDO::PARAM_STR);
        $stmt->bindParam(':duration_minutes', $durationMinutes, PDO::PARAM_INT);
        $stmt->bindParam(':price', $price, PDO::PARAM_STR);
        $stmt->bindParam(':status', $status, PDO::PARAM_STR);
        $stmt->bindParam(':payment_status', $paymentStatus, PDO::PARAM_STR);
        $stmt->bindParam(':notes', $notes, PDO::PARAM_STR);

        return $stmt->execute();
    }

    public function getReservedSlots() {
        $stmt = $this->db->query("
            SELECT
                id, user_id, coach_id, service_type, reservation_date, start_time, end_time,
                duration_minutes, price, status, payment_status
            FROM
                reservations
            WHERE
                status IN ('pending', 'confirmed')
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function isSlotReserved($reservationDate, $startTime, $endTime, $coachId = null) {
        $query = "
            SELECT COUNT(*)
            FROM reservations
            WHERE
                reservation_date = :reservation_date AND
                ((start_time < :end_time AND end_time > :start_time)) AND
                status IN ('pending', 'confirmed')
        ";

        if ($coachId !== null) {
            $query .= " AND coach_id = :coach_id";
        }

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':reservation_date', $reservationDate);
        $stmt->bindParam(':start_time', $startTime);
        $stmt->bindParam(':end_time', $endTime);

        if ($coachId !== null) {
            $stmt->bindParam(':coach_id', $coachId, PDO::PARAM_INT);
        }

        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    public function getReservationById($reservationId) {
        $stmt = $this->db->prepare("SELECT * FROM reservations WHERE id = :id");
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

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':new_status', $newStatus, PDO::PARAM_STR);
        if ($newPaymentStatus !== null) {
            $stmt->bindParam(':new_payment_status', $newPaymentStatus, PDO::PARAM_STR);
        }
        $stmt->bindParam(':id', $reservationId, PDO::PARAM_INT);
        return $stmt->execute();
    }
}