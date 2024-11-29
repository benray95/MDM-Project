<?php
// Configuration de la connexion à la base de données
$host = 'localhost';  		// Hôte de la base de données
$dbname = 'mdm_project'; 	// Nom de la base de données
$username = 'root';   		// Nom d'utilisateur de la base de données
$password = 'mdm_password'; // Mot de passe de la base de données

// Création de la connexion PDO à la base de données
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Définir le mode d'erreur de PDO pour lever des exceptions
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
?>
