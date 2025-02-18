<?php
// Inclure la classe User
include_once 'User.php';
// Créer une instance de la classe User
$user = new User();

// Initialiser les variables
$message = '';
$user_info = null;

// Vérifier si l'utilisateur est connecté
if (!$user->isLoggedIn()) {
    header('Location: login.php');  // Redirection vers la page de connexion si l'utilisateur n'est pas connecté
    exit();
}

// Récupérer les informations actuelles de l'utilisateur
$user_info = $user->getUserInfo();

// Si le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $login = $_POST['login'];
    $password = $_POST['password'];

    // Appeler la méthode updateProfile pour mettre à jour les informations
    $message = $user->updateProfile($login, $password);

    // Récupérer les nouvelles informations après mise à jour
    $user_info = $user->getUserInfo();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Modifier mon profil</title>
</head>
<header>
<a href="index.php"><p class="Acceuil">Acceuil</p></a>
</header>
<body>
    <div class="form-connection">
        <h2>Modifier mon profil</h2>
        
        <!-- Affichage du message -->
        <?php if (!empty($message)): ?>
            <div class="message"><?php echo $message; ?></div>
        <?php endif; ?>
        
        <form method="POST">
            <label for="login">Nom d'utilisateur</label>
            <input type="text" id="login" name="login" value="<?php echo htmlspecialchars($user_info['login']); ?>" required><br><br>

            <label for="password">Nouveau mot de passe</label>
            <input type="password" id="password" name="password" autocomplete="off" required><br><br>

            <button type="submit">Mettre à jour</button>
        </form>

        <p><a href="logout.php">Se déconnecter</a></p>
    </div>
</body>
<footer class="update-footer">
    <p>2025 Quizouille - Tous droits réservés.</p>
</footer>
</html>
