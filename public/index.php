<?php
// Démarrer la session
session_start();

// Vérifier si l'utilisateur est connecté, sinon rediriger vers la page de connexion
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Rediriger vers login si non connecté
    exit();
}

// Récupérer les informations de l'utilisateur depuis la session
$username = $_SESSION['username'];

// Inclure la connexion à la base de données et tout autre fichier nécessaire
require_once('../config/database.php');

// Variable pour afficher un message de bienvenue
$message = "Bienvenue, $username!";
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MDM-System - Tableau de bord</title>
    <link rel="stylesheet" href="../public/css/styles.css">
</head>
<body>
    <header class="header">
        <div class="logo">
            <h1>MDM-System</h1>
        </div>
        <div class="header-info">
            <span class="date-time"><?php echo date("d M Y H:i:s"); ?></span> <!-- Affiche la date et l'heure -->
            <div class="profile">
                <span class="username"><?php echo $username; ?></span> <!-- Affiche le nom de l'utilisateur connecté -->
                <div class="dropdown">
                    <button class="dropbtn">Profil</button>
                    <div class="dropdown-content">
                        <a href="#">Voir le profil</a>
                        <a href="logout.php">Déconnexion</a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <nav class="nav-bar">
        <ul>
            <li><a href="inventory.php">Inventaire</a></li>
            <li><a href="admin.php">Administration</a></li>
            <li><a href="about.php">À propos</a></li>
        </ul>
    </nav>

    <main>
        <div class="dashboard">
            <h2>Tableau de bord</h2>
            <p><?php echo $message; ?></p>
            <p>Bienvenue sur le tableau de bord de MDM-System. Vous pouvez commencer à gérer les appareils et accéder aux fonctionnalités de l'application.</p>
        </div>
    </main>

    <footer class="footer">
        <p>© 2024 MDM-System. Tous droits réservés.</p>
    </footer>
</body>
</html>
