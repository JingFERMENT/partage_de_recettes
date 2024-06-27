<?php
session_start();
require_once(__DIR__ . '/isConnect.php');
require_once(__DIR__ . '/config/mysql.php');
require_once(__DIR__ . '/databaseconnect.php');

$getData = $_GET;

// check the id
if (!isset($getData['id']) || !is_numeric($getData['id'])) {
    echo 'La modification ne peut pas être effectuée.';
    return;
}

// get the recipe
$sqlQuery = 'SELECT * FROM `recipes` where recipe_id = :id';
$retrievedRecipeStatement = $mysqlClient->prepare($sqlQuery);
$retrievedRecipeStatement->execute([
    'id' => (int)$getData['id'],
]);

// display the recipe 
$recipe = $retrievedRecipeStatement->fetch(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site des Recettes - Edition de recette</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="d-flex flex-column min-vh-100">
    <div class="container">

        <?php require_once(__DIR__ . '/header.php') ?>

        <h1>Metter à jour <?= $recipe['title'] ?></h1>

        <!-- Ajouter un formulaire de création de recettes. -->
        <form action="recipes_post_update.php?id=<?=$getData['id']?>" method="POST">
            <div class="mb-3">
                <label for="title" class="form-label">Titre de la recette</label>
                <input type="text" class="form-control" id="title" name="title" aria-describedby="titleHelp" value="<?= $recipe['title'] ?>">
                <div id="titleHelp" class="form-text">Merci d'utiliser un titre percutant !</div>
            </div>
            <div class="mb-3">
                <label for="recipe" class="form-label">Description de la recette</label>
                <textarea class="form-control" id="recipe" name="recipe" placeholder="Merci de bien numéroter les étapes clés de la recette."><?= $recipe['recipe'] ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Modifier</button>
        </form>
    </div>

    <?php require_once(__DIR__ . '/footer.php') ?>
</body>

</html>