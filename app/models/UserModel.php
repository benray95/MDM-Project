<?php
require_once('../config/database.php'); // Connexion à la base de données

class UserModel {

    // Fonction pour authentifier un utilisateur
    public static function authenticate($username, $password) {
        global $pdo;
        
        // Requête SQL pour récupérer les informations de l'utilisateur par son nom d'utilisateur
        $sql = "SELECT * FROM users WHERE username = :username LIMIT 1";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Vérification du mot de passe
        if ($user && password_verify($password, $user['password'])) {
            return $user; // L'utilisateur est authentifié avec succès
        }

        return false; // Authentification échouée
    }
}
?>
