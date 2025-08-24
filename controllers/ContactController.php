<?php
require_once __DIR__ . '/../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require_once __DIR__ . '/../models/ContactModel.php';

class ContactController {

    private $pdo;
    private $contactModel;

    public function __construct($pdo) {
        $this->pdo = $pdo;
        $this->contactModel = new ContactModel($this->pdo);
    }

    public function index() {
        require_once __DIR__ . '/../views/contact.php';
    }

    public function processContactForm() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = trim($_POST['nom'] ?? '');
            $prenom = trim($_POST['prenom'] ?? '');
            $societe = trim($_POST['societe'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $message = trim($_POST['message'] ?? '');
            $subject = "Nouveau message de contact de " . $prenom . " " . $nom;

            if (empty($nom) || empty($prenom) || empty($email) || empty($message)) {
                $_SESSION['error_message'] = "Veuillez remplir tous les champs obligatoires.";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['error_message'] = "Le format de l'email est invalide.";
            } else {
                $db_insert_success = $this->contactModel->insertMessage($prenom, $nom, $email, $subject, $message);
                
                require_once __DIR__ . '/../config/email_config.php';
                $mail = new PHPMailer(true);
                $mail_sent = false;

                try {
                    $mail->isSMTP();
                    $mail->Host       = $email_config['host'];
                    $mail->SMTPAuth   = $email_config['smtp_auth'];
                    $mail->Username   = $email_config['username'];
                    $mail->Password   = $email_config['password'];
                    $mail->SMTPSecure = $email_config['smtp_secure'];
                    $mail->Port       = $email_config['port'];
                    $mail->CharSet    = 'UTF-8';

                    $mail->setFrom($email_config['from_email'], $email_config['from_name']);
                    $mail->addAddress($email_config['to_email']);
                    $mail->addReplyTo($email, $prenom . ' ' . $nom);

                    $mail->isHTML(false);
                    $mail->Subject = $subject;
                    
                    $email_content = "Nom: " . $nom . "\n";
                    $email_content .= "Prénom: " . $prenom . "\n";
                    if (!empty($societe)) {
                        $email_content .= "Société: " . $societe . "\n";
                    }
                    $email_content .= "Email: " . $email . "\n\n";
                    $email_content .= "Message:\n" . $message . "\n";
                    
                    $mail->Body = $email_content;
                    
                    $mail->send();
                    $mail_sent = true;

                } catch (Exception $e) {
                    $_SESSION['error_message'] = "Le message n'a pas pu être envoyé. Erreur de PHPMailer: {$mail->ErrorInfo}";
                }

                if ($db_insert_success && $mail_sent) {
                    $_SESSION['success_message'] = "Votre message a été envoyé avec succès et enregistré ! Nous vous répondrons bientôt.";
                } elseif (!$db_insert_success) {
                    $_SESSION['error_message'] = "Une erreur est survenue lors de l'enregistrement du message en base de données.";
                } elseif (!$mail_sent) {
                     
                }
            }
        }
        
        header('Location: /index.php?page=contact');
        exit();
    }
}