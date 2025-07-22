<?php

class ContactController {

    public function __construct() {
    }

    public function index() {
        $success_message = '';
        $error_message = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_contact'])) {
            $nom = trim($_POST['nom'] ?? '');
            $prenom = trim($_POST['prenom'] ?? '');
            $societe = trim($_POST['societe'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $message = trim($_POST['message'] ?? '');

            if (empty($nom) || empty($prenom) || empty($email) || empty($message)) {
                $error_message = "Veuillez remplir tous les champs obligatoires.";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error_message = "Le format de l'email est invalide.";
            } else {
                $to = "contact@prosporttraining.fr";
                $subject = "Nouveau message de contact de " . $nom . " " . $prenom;
                $headers = "From: " . $email . "\r\n";
                $headers .= "Reply-To: " . $email . "\r\n";
                $headers .= "Content-type: text/plain; charset=UTF-8\r\n";

                $email_content = "Nom: " . $nom . "\n";
                $email_content .= "Prénom: " . $prenom . "\n";
                if (!empty($societe)) {
                    $email_content .= "Société: " . $societe . "\n";
                }
                $email_content .= "Email: " . $email . "\n\n";
                $email_content .= "Message:\n" . $message . "\n";

                if (mail($to, $subject, $email_content, $headers)) {
                    $success_message = "Votre message a été envoyé avec succès ! Nous vous répondrons bientôt.";
                    $_POST = []; 
                } else {
                    $error_message = "Une erreur est survenue lors de l'envoi du message. Veuillez réessayer.";
                }
            }
        }

        require_once 'views/contact.php';
    }
}