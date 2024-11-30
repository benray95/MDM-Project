<?php
// Vérification du rôle de l'utilisateur
$role = $_SESSION['role'] ?? 'user';
?>

<div class="sidebar">
    <ul>
        <li><a href="index.php">Accueil</a></li>
        <li><a href="inventory.php">Inventaire</a></li>
        <?php if ($role === 'admin' || $role === 'super_admin'): ?>
            <li><a href="administration.php">Administration</a></li>
        <?php endif; ?>
        <li><a href="about.php">À propos</a></li>
    </ul>
</div>

