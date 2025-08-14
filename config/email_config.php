<?php
// Fichier de configuration pour l'envoi d'e-mails via PHPMailer

// Ce tableau contient les paramètres nécessaires pour se connecter à un serveur SMTP.
$email_config = [
    // L'adresse du serveur SMTP de votre fournisseur d'e-mail.
    // Exemple : 'smtp.gmail.com' pour Gmail, 'mail.votre-domaine.com' pour un hébergeur web.
    'host' => 'votre_serveur_smtp',

    // Active l'authentification SMTP (doit être true pour la plupart des serveurs).
    'smtp_auth' => true,

    // Le nom d'utilisateur pour l'authentification SMTP.
    // C'est généralement l'adresse e-mail que vous utilisez pour envoyer des messages.
    'username' => 'votre_email@exemple.com',

    // Le mot de passe de l'adresse e-mail.
    // Pour Gmail, il faut utiliser un "mot de passe d'application" si vous avez l'authentification à deux facteurs.
    'password' => 'votre_mot_de_passe',

    // Le protocole de chiffrement à utiliser (ssl ou tls).
    // SMTPSecure doit être 'ssl' pour le port 465, ou 'tls' pour le port 587.
    'smtp_secure' => 'tls',

    // Le port du serveur SMTP.
    // Port 465 pour SMTPSecure 'ssl', Port 587 pour SMTPSecure 'tls'.
    'port' => 587,

    // L'adresse e-mail qui apparaîtra comme l'expéditeur.
    'from_email' => 'votre_email@exemple.com',

    // Le nom qui apparaîtra comme l'expéditeur (ex: "Mon Site Web").
    'from_name' => 'Pro Sport-Training',

    // L'adresse e-mail à laquelle les messages de contact seront envoyés.
    // C'est la destination finale du formulaire.
    'to_email' => 'email_de_destination@exemple.com',
];

