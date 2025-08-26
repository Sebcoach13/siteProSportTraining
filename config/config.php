<?php

define('DB_HOST', 'mysql-messites.alwaysdata.net');
define('DB_NAME', 'messites_pro_sport_training_db'); 
define('DB_USER', 'messites');
define('DB_PASS', 'Llink1973@');

try {
    $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
} catch (PDOException $e) {
    echo "<h1>Erreur critique ! La connexion à la base de données a échoué.</h1>";
    echo "<p>Veuillez contacter l'administrateur du site ou vérifier les logs.</p>";
    echo "<p><strong>Message technique :</strong> " . htmlspecialchars($e->getMessage()) . "</p>";
    echo "<p>Code d'erreur : " . $e->getCode() . "</p>";
    error_log("ERREUR PDO de connexion dans config.php: " . $e->getMessage() . " (Code: " . $e->getCode() . ")");
    exit();
}

?>