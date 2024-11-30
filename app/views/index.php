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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - MDM-Project</title>
    <link rel="stylesheet" href="public/css/styles.css">
    <script>
        // Script pour l'horloge dynamique
        function updateClock() {
            const now = new Date();
            const timeString = now.toLocaleTimeString();
            const dateString = now.toLocaleDateString();
            document.getElementById('clock').textContent = `${dateString} ${timeString}`;
        }
        setInterval(updateClock, 1000);
        window.onload = updateClock;
    </script>
</head>
<body>
    <!-- Navigation -->
    <?php include __DIR__ . '/includes/navbar.php'; ?>

    <div class="content">
        <h1>Bienvenue sur MDM-Project</h1>
        <p>Veuillez choisir une section dans le menu ci-dessus.</p>
    </div>
</body>
</html>