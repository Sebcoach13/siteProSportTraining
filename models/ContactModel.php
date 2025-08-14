<?php

class ContactModel {

    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    /**
     * Insère un nouveau message de contact dans la base de données.
     *
     * @param string $firstname
     * @param string $lastname
     * @param string $email
     * @param string $subject
     * @param string $message
     * @return bool Vrai en cas de succès, faux sinon.
     */
    public function insertMessage($firstname, $lastname, $email, $subject, $message) {
        $sql = "INSERT INTO contact_messages (firstname, lastname, email, subject, message) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$firstname, $lastname, $email, $subject, $message]);
    }
}
