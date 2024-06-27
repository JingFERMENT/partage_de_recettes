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

        <h1>Supprimer la recette ?</h1>
        
        <form action="recipes_post_delete.php?id=<?=$getData['id']?>" method="POST">
            <button type="submit" class="btn btn-danger">La suppression est définitive</button>
        </form>
    </div>

    <?php require_once(__DIR__ . '/footer.php') ?>
</body>

</html>