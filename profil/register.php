<?php
// Inclure la classe User
include_once 'User.php';

// Créer une instance de la classe User (qui hérite de Database)
$user = new User();

// Initialiser la variable de message
$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];  // Récupérer le nom d'utilisateur depuis le formulaire
    $password = $_POST['password'];  // Récupérer le mot de passe depuis le formulaire

    // Appeler la méthode register de la classe User pour inscrire l'utilisateur
    $message = $user->register($username, $password);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Inscription</title>
</head>
<header>
<a href="../index.php"><p>Acceuil</p></a>
</header>
<body>
<div class="form-connection">
    <h2>Inscription</h2>
    <form method="POST">
        <label for="username">Nom d'utilisateur</label>
        <input type="text" id="username" name="username" autocomplete="off" required><br><br>

        <label for="password">Mot de passe</label>
        <input type="password" id="password" name="password" autocomplete="off" required><br><br>

        <button type="submit">S'inscrire</button>
        <!-- Affichage du message d'erreur sous le bouton -->
        <?php if (!empty($message)): ?>
            <p class="error-message"><?php echo $message; ?></p>
        <?php endif; ?>
        <p>Tu veux te connecter maintenant ? <a href="login.php">C'est ici !</a></p>
    </form>
</div>
</body>
<footer class="register-footer">
    <p>2025 - Tous droits réservés.</p>
</footer>
</html>
