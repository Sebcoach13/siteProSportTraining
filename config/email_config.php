<?php
// Fichier de configuration pour l'envoi d'e-mails via PHPMailer

$email_config = [
    // Hôte SMTP pour Outlook/Hotmail
    'host' => 'smtp.gmail.com',

    // L'authentification est nécessaire
    'smtp_auth' => true,

    // Ton adresse Hotmail/Outlook
    'username' => 'dacostasebastien83@gmail.com',

    // Ton mot de passe de compte Hotmail/Outlook
    'password' => 'Llinkinpark1973@',

    // Le protocole de sécurité TLS est obligatoire
    'smtp_secure' => 'tls',

    // Le port standard pour TLS
    'port' => 587,

    // L'adresse qui apparaîtra comme l'expéditeur
    'from_email' => 'dacostasebastien83@gmail.com',

    // Le nom qui apparaîtra comme l'expéditeur
    'from_name' => 'Pro Sport-Training',

    // L'adresse où le message de contact sera envoyé
    'to_email' => 'dacostasebastien83@gmail.com',
];