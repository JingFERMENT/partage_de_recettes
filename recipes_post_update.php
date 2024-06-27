<?php
session_start();
require_once(__DIR__ . '/isConnect.php');
require_once(__DIR__ . '/databaseconnect.php');
require_once(__DIR__. '/config/mysql.php');

$postData = $_POST;
$getData = $_GET;

//data validation for recipes creations

if (
    !isset($getData['id'])
    || !is_numeric($getData['id'])
    || empty($postData['title'])
    || empty($postData['recipe'])
    || trim(strip_tags($postData['title'])) === ''
    || trim(strip_tags($postData['recipe'])) === ''
) {
    echo 'Il manque des informations pour permettre l\'édition du formulaire.';
    return;
}

$id = (int)$getData['id'];
$title = trim(strip_tags($postData['title']));
$recipe = trim(strip_tags($postData['recipe']));

// query for create the recipes 
$sqlQuery = 'UPDATE `recipes` SET `title` = :title , `recipe` = :recipe
            WHERE `recipe_id` = :id';

// preparation 
$updateRecipesStatement =$mysqlClient->prepare($sqlQuery);

// execution 
$updateRecipesStatement->execute([
    'title' => $title,
    'recipe' => $recipe,
    'id' => $id,
]);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site de Recettes - Edition de recette</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>


<body class="d-flex flex-column min-vh-100">
    <div class="container">
        <!-- header -->
        <?php require_once(__DIR__ . '/header.php'); ?>
        <h1>Recette modifiée avec succès !</h1>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?=$title?></h5>
                <p class="card-text"><b>Email</b> : <?= $_SESSION['loggedUser']['email']; ?></p>
                <!-- strip_tags : retirer les balises HTML -->
                <p class="card-text"><b>Recette</b> : <?=$recipe?></p>
            </div>
        </div>
    </div>
    <!-- footer -->
    <?php require_once(__DIR__ . '/footer.php'); ?>
</body>


</html>