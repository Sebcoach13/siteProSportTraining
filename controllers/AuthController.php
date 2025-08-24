<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// 1. Inclure le fichier de connexion à la base de données
require_once __DIR__ . '/../config/config.php';
// 2. Inclure le modèle d'utilisateur
require_once __DIR__ . '/../models/UserModel.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_register'])) {
    $prenom = trim($_POST['firstname'] ?? '');
    $nom = trim($_POST['lastname'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    if (empty($email) || empty($password) || empty($confirm_password)) {
        $error = "Tous les champs obligatoires (Email, Mot de passe, Confirmation) doivent être remplis.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Format d'email invalide.";
    } elseif ($password !== $confirm_password) {
        $error = "Les mots de passe ne correspondent pas.";
    } elseif (strlen($password) < 6) {
        $error = "Le mot de passe doit contenir au moins 6 caractères.";
    } else {
        $password_hashed = password_hash($password, PASSWORD_DEFAULT);
        
        // Instancier UserModel en passant l'objet PDO à son constructeur
        $userModel = new UserModel($pdo);

        if ($userModel->registerUser($prenom, $nom, $email, $password_hashed)) {
            $success = "Inscription réussie ! Vous pouvez maintenant vous connecter.";
            header('Location: /views/connection.php?success=' . urlencode($success));
            exit();
        } else {
            $error = "L'inscription a échoué. Cet email est peut-être déjà utilisé.";
        }
    }
    
    if (!empty($error)) {
        header('Location: /views/inscription.php?error=' . urlencode($error));
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_login'])) {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($email) || empty($password)) {
        $error = "Veuillez saisir votre email et votre mot de passe.";
    } else {
        // Instancier UserModel en passant l'objet PDO à son constructeur
        $userModel = new UserModel($pdo);
        $user = $userModel->loginUser($email, $password);

        if ($user) {
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_prenom'] = $user['prenom'];
            $_SESSION['user_nom'] = $user['nom'];
            header('Location: /views/accueil.php');
            exit();
        } else {
            $error = "Email ou mot de passe incorrect.";
        }
    }
    header('Location: /views/connection.php?error=' . urlencode($error));
    exit();
}

if (isset($_GET['error'])) {
    $error = htmlspecialchars($_GET['error']);
}
if (isset($_GET['success'])) {
    $success = htmlspecialchars($_GET['success']);
}

?>