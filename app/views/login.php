<?php
// Démarrer la session
session_start();

// Inclure la connexion à la base de données et le modèle User
require_once('../config/database.php');
require_once('../app/models/UserModel.php');

// Vérifier si l'utilisateur est déjà connecté
if (isset($_SESSION['user_id'])) {
    header("Location: index.php"); // Redirige vers la page principale si déjà connecté
    exit();
}

$message = '';

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Appeler la méthode d'authentification du modèle User
    $user = UserModel::authenticate($username, $password);

    if ($user) {
        // Si authentification réussie, enregistrer les informations dans la session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];

        // Rediriger vers la page d'accueil
        header("Location: index.php");
        exit();
    } else {
        // Si l'authentification échoue, afficher un message d'erreur
        $message = 'Nom d\'utilisateur ou mot de passe incorrect.';
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MDM-System - Connexion</title>
    <link rel="stylesheet" href="../public/css/styles.css">
</head>
<body>
    <div class="login-container">
        <h2>Connexion à MDM-System</h2>
        <?php if ($message): ?>
            <div class="error"><?php echo $message; ?></div>
        <?php endif; ?>
        <form method="POST" action="login.php">
            <div class="form-group">
                <label for="username">Nom d'utilisateur</label>
                <input type="text" name="username" id="username" required>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" name="password" id="password" required>
            </div>
            <div class="form-group">
                <button type="submit" class="btn-login">Se connecter</button>
            </div>
        </form>
    </div>
</body>
</html>
