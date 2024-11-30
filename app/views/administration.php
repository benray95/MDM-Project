<?php
session_start();

// Vérification que l'utilisateur est connecté
if (!isset($_SESSION['user_logged_in']) || $_SESSION['user_logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

// Inclusion des fichiers nécessaires
require_once __DIR__ . '/../includes/database.php';

// Traitement des actions utilisateur
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $userId = $_POST['user_id'] ?? 0;

    try {
        if ($action === 'add' && !empty($username) && !empty($password)) {
            // Ajouter un utilisateur
            $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
            $stmt->execute(['username' => $username, 'password' => password_hash($password, PASSWORD_DEFAULT)]);
            $message = "Utilisateur ajouté avec succès !";
        } elseif ($action === 'delete' && $userId > 0) {
            // Supprimer un utilisateur
            $stmt = $pdo->prepare("DELETE FROM users WHERE id = :id");
            $stmt->execute(['id' => $userId]);
            $message = "Utilisateur supprimé avec succès !";
        } elseif ($action === 'update' && $userId > 0 && !empty($username)) {
            // Modifier un utilisateur
            $stmt = $pdo->prepare("UPDATE users SET username = :username WHERE id = :id");
            $params = ['id' => $userId, 'username' => $username];

            // Modifier le mot de passe si fourni
            if (!empty($password)) {
                $stmt = $pdo->prepare("UPDATE users SET username = :username, password = :password WHERE id = :id");
                $params['password'] = password_hash($password, PASSWORD_DEFAULT);
            }
            $stmt->execute($params);
            $message = "Utilisateur mis à jour avec succès !";
        }
    } catch (Exception $e) {
        $message = "Erreur : " . $e->getMessage();
    }
}

// Récupération de tous les utilisateurs
$stmt = $pdo->query("SELECT * FROM users");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration - MDM-Project</title>
    <link rel="stylesheet" href="/css/styles.css">
</head>
<body>

	<!-- Inclure la navbar -->
	<?php include '../includes/navbar.php'; ?>

	<!-- Inclure la sidebar -->
    <?php include '../includes/sidebar.php'; ?>

	<!-- Contenu principal -->
	<div class="main-content">
		<h1>Administration des utilisateurs</h1>

		<!-- Affichage des messages de succès ou d'erreur -->
		<?php if ($message): ?>
			<p class="message"><?= htmlspecialchars($message) ?></p>
		<?php endif; ?>

		<!-- Formulaire d'ajout d'utilisateur -->
		<section class="user-form">
            <h2>Ajouter un utilisateur</h2>
            <form method="POST" class="form">
                <input type="hidden" name="action" value="add">
                <div class="form-group">
                    <label for="username">Nom d'utilisateur</label>
                    <input type="text" name="username" placeholder="Nom d'utilisateur" required>
                </div>
                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" name="password" placeholder="Mot de passe" required>
                </div>
                <button type="submit" class="btn">Ajouter</button>
            </form>
        </section>

        <!-- Liste des utilisateurs -->
        <section class="user-list">
            <h2>Liste des utilisateurs</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Role</th>
                        <th>Modify</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?= htmlspecialchars($user['id']) ?></td>
                            <td><?= htmlspecialchars($user['username']) ?></td>
                            <td><?= htmlspecialchars($user['role']) ?></td>
                            <td>
                                <div class="action-buttons">
                                    <!-- Formulaire de modification -->
                                    <form method="POST" style="display: inline-block;">
                                        <input type="hidden" name="action" value="update">
                                        <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                                        <input type="text" name="username" value="<?= htmlspecialchars($user['username']) ?>" required>
                                        <input type="password" name="password" placeholder="Nouveau mot de passe">
                                        <button type="submit" class="btn-update">Modifier</button>
                                    </form>
                                </div>
                            </td>
                            <td>
                                    <!-- Formulaire de suppression -->
                                    <form method="POST" style="display: inline-block;">
                                        <input type="hidden" name="action" value="delete">
                                        <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                                        <button type="submit" class="btn-delete">Supprimer</button>
                                    </form>
                            </td>
                        </tr>
                     <?php endforeach; ?>
                </tbody>
            </table>
        </section>
    </div>

</body>
</html>


