<?php
session_start();
require_once "classes/livreor.php";
require_once "profil/user.php";

// Récupérer le mot-clé de recherche
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Initialisation des variables pour la pagination
$livreOr = new LivreOr();
$commentsPerPage = 4;  // Nombre de commentaires à afficher par page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $commentsPerPage;

// Modifier la méthode countComments et getComments pour inclure la recherche
$totalComments = $livreOr->countComments($search);  // Passer $search à la méthode
$totalPages = ceil($totalComments / $commentsPerPage);
$comments = $livreOr->getComments($commentsPerPage, $offset, $search);  // Passer $search à la méthode
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livre d'Or</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Livre d'Or</h1>
    
    <?php if (isset($_SESSION['user_id'])): ?>
        <a href="Commentaire.php">Ajouter un commentaire</a>
    <?php endif; ?>

    <!-- Formulaire de recherche -->
    <form method="get" action="livre-or.php">
        <input type="text" name="search" placeholder="Rechercher un commentaire..." value="<?= htmlspecialchars($search) ?>">
        <button type="submit">Rechercher</button>
    </form>
    
    <div class="comments">
        <?php foreach ($comments as $comment): ?>
            <div class="comment">
                <p>Posté le <?= date("d/m/Y", strtotime($comment['date'])) ?> par <?= htmlspecialchars($comment['login']) ?></p>
                <p><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
            </div>
        <?php endforeach; ?>
    </div>
    
    <div class="pagination">
        <?php 
        // Affichage du lien "Précédent"
        if ($page > 1): ?>
            <a href="?page=<?= $page - 1 ?>&search=<?= htmlspecialchars($search) ?>">Précédent</a>
        <?php endif; ?>

        <?php
        // Affichage de la première page et des trois petits points si nécessaire
        if ($page > 2): ?>
            <a href="?page=1&search=<?= htmlspecialchars($search) ?>">1</a>
            <span>...</span>
        <?php endif; ?>

        <?php
        // Afficher uniquement les pages après la page actuelle (pas avant)
        $range = 3;  // Afficher 3 pages après la page actuelle
        $start = $page + 1;  // Commencer à afficher à partir de la page suivante
        $end = min($totalPages, $page + $range);  // Afficher jusqu'à $range pages après la page actuelle

        // Affichage des pages après la page actuelle
        for ($i = $start; $i <= $end; $i++): ?>
            <a href="?page=<?= $i ?>&search=<?= htmlspecialchars($search) ?>" <?= ($i == $page) ? 'class="active"' : '' ?>><?= $i ?></a>
        <?php endfor; ?>

        <?php
        // Affichage des trois petits points et de la dernière page si nécessaire
        if ($page < $totalPages - 1): ?>
            <span>...</span>
            <a href="?page=<?= $totalPages ?>&search=<?= htmlspecialchars($search) ?>"><?= $totalPages ?></a>
        <?php endif; ?>

        <?php 
        // Affichage du lien "Suivant"
        if ($page < $totalPages): ?>
            <a href="?page=<?= $page + 1 ?>&search=<?= htmlspecialchars($search) ?>">Suivant</a>
        <?php endif; ?>
    </div>

</body>
</html>
