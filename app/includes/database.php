<?php
// database.php

// Paramètres de connexion à la base de données
$host = 'localhost'; // Hôte de la base de données
$dbname = 'mdm_database'; // Nom de la base de données
$username = 'root'; // Nom d'utilisateur (à modifier selon votre configuration)
$password = 'mdm'; // Mot de passe (à modifier selon votre configuration)

// Tentative de connexion à la base de données
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Définir le mode d'erreur des exceptions
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Affichage d'une erreur si la connexion échoue
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
?>

