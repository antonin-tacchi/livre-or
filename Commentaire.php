<?php
session_start();
require_once __DIR__ . "/classes/Comment.php"; // On inclut la classe Comment

if (!isset($_SESSION['user'])) {
    header("Location: /livre-or/profil/login.php");
    exit();
}

$commentObj = new Comment();

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['comment'])) {
    $commentObj->addComment($_SESSION['user'], $_POST['comment']);
    header("Location: commentaire.php");
    exit();
}

$comments = $commentObj->getComments();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Livre d'or</title>
</head>
<header>
    <a href="livre-or.php">Livre d'or</a>
    <a href="profil/logout.php">Déconnexion</a>
<body>
    <h1>Ajouter un commentaire</h1>
    <form method="POST" action="">
        <textarea name="comment" required></textarea>
        <button type="submit">Envoyer</button>
    </form>
</body>
</html>
