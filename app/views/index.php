<?php
session_start();

// Vérification de la session de l'utilisateur
if (!isset($_SESSION['user_logged_in']) || $_SESSION['user_logged_in'] !== true) {
    // Si l'utilisateur n'est pas connecté, redirection vers la page de connexion
    header("Location: login.php");
    exit(); // Arrête l'exécution du script après la redirection
}

// Si l'utilisateur est connecté, on affiche la page d'accueil
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MDM-Project - Accueil</title>
    <link rel="stylesheet" href="/css/styles.css">
</head>
<body>

    <!-- Inclure la navbar -->
    <?php include 'includes/navbar.php'; ?>

    <!-- Inclure le menu latéral -->
    <?php include 'includes/sidebar.php'; ?>

    <!-- Contenu principal -->
    <div class="main-content">
        <h1>Bienvenue sur MDM-Project</h1>
        <p>Choisissez une section dans le menu à gauche.</p>
    </div>

</body>
</html>