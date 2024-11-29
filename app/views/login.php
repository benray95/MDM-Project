<?php
session_start();

// Inclure le fichier de connexion à la base de données
require_once '../includes/database.php';  // Mise à jour du chemin

if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true) {
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    try {
        // Utilisation de la connexion PDO déjà établie dans database.php
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->execute(['username' => $username]);

        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_logged_in'] = true;
            $_SESSION['username'] = $username;
            header("Location: index.php");
            exit();
        } else {
            $error_message = "Identifiants incorrects.";
        }
    } catch (PDOException $e) {
        $error_message = "Erreur de connexion à la base de données : " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MDM-System - Connexion</title>

    <!-- Inclusion du fichier CSS -->
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="login-container">
        <h1>Page de Connexion</h1>

        <?php
        if (isset($error_message)) {
            echo "<p class='error'>$error_message</p>";
        }
        ?>

        <form action="login.php" method="POST">
            <label for="username">Nom d'utilisateur :</label>
            <input type="text" name="username" id="username" required>
            <br><br>
            <label for="password">Mot de passe :</label>
            <input type="password" name="password" id="password" required>
            <br><br>
            <input type="submit" value="Se connecter">
        </form>
    </div>
</body>
</html>
