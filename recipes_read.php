<?php
session_start();

require_once(__DIR__ . '/config/mysql.php');
require_once(__DIR__ . '/databaseconnect.php');

$getData = $_GET;

// check the id
if (!isset($getData['id']) || !is_numeric($getData['id'])) {
    echo 'Il n\'y a pas de recette correspondante. ';
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

// error management when the recipe does not exist
if (!$recipe) {
    echo 'La recette n\'existe pas';
    return;
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site des Recettes - <?= $recipe['title'] ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="d-flex flex-column min-vh-100">
    <div class="container">

        <?php require_once(__DIR__ . '/header.php') ?>

        <h1 class="my-5"><?= $recipe['title'] ?></h1>

        <div>
            <article>
                <?= $recipe['recipe'] ?>
            </article>
            <aside class="my-3">
                <p><i>Contribuée par <?= $recipe['author'] ?></i></p>
            </aside>
        </div>

        <?php if(!$comments === NULL) {
             echo 'Vos commentaires';
        } else  {
            echo 'Nom de l\'utilisateur';
        }?>
        
        


        <?php if (isset($_SESSION['loggedUser'])) { ?>
            <?php require_once(__DIR__ . '/comments_create.php'); ?>
        <?php } ?>
    </div>

    <?php require_once(__DIR__ . '/footer.php') ?>
</body>

</html>