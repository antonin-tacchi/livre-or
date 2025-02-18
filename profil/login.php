<?php
// Inclure la classe User
include_once 'User.php';  // Inclure la classe User qui hérite de Database

// Créer une instance de la classe User (qui hérite de Database)
$user = new User();

// Initialiser la variable de message d'erreur
$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer les informations du formulaire
    $login = $_POST['username'];  // Nom d'utilisateur
    $password = $_POST['password'];  // Mot de passe

    // Appeler la méthode login de la classe User pour connecter l'utilisateur
    $message = $user->login($login, $password);

    // Si la connexion est réussie, on redirige vers l'accueil
    if ($message === "Connexion réussie.") {
        header('Location: ../index2.php');  // Redirection vers la page d'accueil après connexion réussie
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Connexion</title>
</head>
<header>
<a href="../index.php"><p class="Acceuil">Acceuil</p></a>
</header>
<body>
    <div class="form-connection">
    <h2>Connexion</h2>
    <form method="POST">
        <label for="username"><p>Nom d'utilisateur</p></label>
        <input type="text" id="username" name="username" autocomplete="off" required><br><br>

        <label for="password"><p>Mot de passe</p></label>
        <input type="password" id="password" name="password" autocomplete="off" required><br><br>

        <button type="submit"><p>Se connecter</p></button>

        <!-- Affichage du message d'erreur sous le bouton -->
        <?php if (!empty($message)): ?>
            <div class="error-message"><p><?php echo $message; ?></p></div>
        <?php endif; ?>
    </form>
    <p>Pas encore de compte ? <a href="register.php">Créez-en un !</a></p>
    </div>
</body>
<footer class="login-footer">
    <p>2025 - Tous droits réservés.</p>
</footer>   
</html>
