<?php
require_once(__DIR__ . '/variables.php');
require_once(__DIR__ . '/functions.php');
require_once(__DIR__ .'/config/mysql.php');
require_once(__DIR__ .'/databaseconnect.php');
session_start();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site de recettes - Page d'accueil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="d-flex flex-column min-vh-100">
    <div class="container">
        <!-- inclusion de l'entête du site -->
        <?php require_once(__DIR__ . '/header.php'); ?>
        <h1>Site de recettes</h1>

        <!-- formulaire de connexion -->
        <?php require_once(__DIR__ . '/login.php'); ?>

        <?php foreach (getRecipes($recipes) as $recipe) { ?>
            <article>
                <h3><?= $recipe['title']; ?></h3>
                <div><?= $recipe['recipe']; ?></div>
                <i><?= displayAuthor($recipe['author'], $users); ?></i>
            </article>
            <?php if (isset($_SESSION['loggedUser']) && $recipe['author'] === $_SESSION['loggedUser']['email']) { ?>
                <ul class="list-group list-group-horizontal">
                    <li class="list-group-item"><a class="link-warning" href="recipes_update.php?id=<?=$recipe['recipe_id']?>">Editer l'article</a></li>
                    <li class="list-group-item"><a class="link-danger" href="">Supprimer l'article</a></li>
                </ul>
        <?php }
        } ?>
    </div>

    <!-- inclusion du bas de page du site -->
    <?php require_once(__DIR__ . '/footer.php'); ?>
</body>

</html>