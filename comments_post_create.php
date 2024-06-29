<?php 
session_start();
require_once(__DIR__ . '/isConnect.php');
require_once(__DIR__ . '/databaseconnect.php');
require_once(__DIR__. '/config/mysql.php');

// data validation for comments' form 

$getData = $_GET;

$postData = $_POST;

if (
    !isset($getData['id'])
    || !is_numeric($getData['id'])
    || empty($postData['comment'])
    || trim(strip_tags($postData['comment'])) === ''
) {
    echo 'Le commentaire est invalide !';
    return;
}

$comment = trim(strip_tags($postData['comment']));

// query for create the comment
$sqlQuery = 'INSERT INTO `comments` (`user_id`, `recipe_id`, `comment`)
            VALUES (:user_id, :recipe_id, :comment);';

// preparation 
$insertComment =$mysqlClient->prepare($sqlQuery);

// execution 
$insertComment->execute([
    'user_id'=> $_SESSION['loggedUser']['user_id'],
    'recipe_id' => $getData['id'],
    'comment' => $comment
]);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site de Recettes - Envoi des commentaires</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>


<body class="d-flex flex-column min-vh-100">
    <div class="container">
        <!-- header -->
        <?php require_once(__DIR__ . '/header.php'); ?>
        <h1>Commentaire ajouté avec succès !</h1>
        <div class="card">
            <div class="card-body">
                <p class="card-text"><b>Votre commentaire</b> : <?=$comment?></p>
            </div>
        </div>
    </div>
    <!-- footer -->
    <?php require_once(__DIR__ . '/footer.php'); ?>
</body>


</html>
