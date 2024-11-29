<?php
// Démarre la session si elle n'est pas déjà démarrée
if (!isset($_SESSION)) {
    session_start();
}

// Si l'utilisateur n'est pas connecté, on le redirige vers la page de login
if (!isset($_SESSION['user_logged_in']) || !$_SESSION['user_logged_in']) {
    header("Location: login.php");
    exit();
}

// Inclure le fichier de configuration pour récupérer les paramètres globaux
include_once('../config/config.php');
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MDM-System - Page d'accueil</title>
    <link rel="stylesheet" href="../public/css/style.css">
</head>

<body>
    <div class="container">

        <!-- Bandeau en haut de la page -->
        <header class="header">
            <div class="logo">
                <h1>MDM-System</h1>
            </div>
            <div class="user-info">
                <span id="current-time"><?php echo date('Y-m-d H:i:s'); ?></span>
                <span class="user-name"><?php echo $_SESSION['user_name']; ?></span>
                <div class="profile-menu">
                    <button class="dropdown-btn">▼</button>
                    <div class="dropdown-content">
                        <a href="profile.php">Mon Profil</a>
                        <a href="logout.php">Déconnexion</a>
                    </div>
                </div>
            </div>
        </header>

        <!-- Barre de menu -->
        <nav class="nav-bar">
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="inventory.php">Inventaire</a></li>
                <li><a href="admin.php">Administration</a></li>
                <li><a href="about.php">À propos</a></li>
            </ul>
        </nav>

        <!-- Contenu principal -->
        <main class="main-content">
            <h2>Bienvenue dans le système de gestion des appareils mobiles</h2>
            <p>Vous êtes connecté en tant que <?php echo $_SESSION['user_name']; ?>.</p>
            <p>Utilisez le menu pour naviguer entre les différentes sections.</p>
        </main>
    </div>

    <script>
        // Mettre à jour l'heure en temps réel
        setInterval(function() {
            document.getElementById("current-time").innerText = new Date().toLocaleString();
        }, 1000);
    </script>
</body>

</html>
