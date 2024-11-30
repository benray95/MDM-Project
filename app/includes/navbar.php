<?php
// Nom d'utilisateur pour affichage dans le menu
$username = $_SESSION['username'] ?? 'Invité';
$role = $_SESSION['role'] ?? 'user';
?>

<nav class="navbar">
    <div class="navbar-left">
        <span class="app-name">MDM-Project</span>
    </div>

    <div class="navbar-center">
        <!-- Espace vide entre la navbar et l'horloge (si besoin) -->
    </div>

    <div class="navbar-right">
        <span id="clock"></span>
        <div class="user-menu">
            <span><?php echo htmlspecialchars($username); ?></span>
            <div class="dropdown">
                <a href="settings.php">Paramètres</a>
                <a href="logout.php">Déconnexion</a>
            </div>
        </div>
    </div>
</nav>

<script>
    // Script pour l'horloge dynamique
    function updateClock() {
        const now = new Date();
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const seconds = String(now.getSeconds()).padStart(2, '0');
        const timeString = `${hours}:${minutes}:${seconds}`;
        document.getElementById('clock').textContent = timeString;
    }
    setInterval(updateClock, 1000); // Mise à jour de l'horloge chaque seconde
    updateClock(); // Pour éviter le délai d'une seconde
</script>
