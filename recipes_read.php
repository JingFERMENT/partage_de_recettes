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
$sqlQuery = 'SELECT * FROM `recipes` WHERE recipe_id = :id';
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

// get the comments 
$sqlQuery = 'SELECT * FROM `comments` 
JOIN `recipes` ON recipes.recipe_id = comments.recipe_id 
JOIN `users` ON users.user_id = comments.user_id
WHERE recipes.recipe_id = :id ORDER BY created_at DESC';
$retrievedCommentStatement = $mysqlClient->prepare($sqlQuery);
$retrievedCommentStatement->execute([
    'id' => (int)$getData['id'],
]);

// display the comments
$comments = $retrievedCommentStatement->fetchAll();

// get the averge rating of the comments

$sqlQuery = 'SELECT ROUND(AVG(comments.review),1) AS rating FROM `comments` 
JOIN `recipes` ON recipes.recipe_id = comments.recipe_id 
WHERE recipes.recipe_id = :id';
$retrievedCommentStatementWithComments = $mysqlClient->prepare($sqlQuery);
$retrievedCommentStatementWithComments->execute([
    'id' => (int)$getData['id'],
]);

// display the average note
$averageNote = $retrievedCommentStatementWithComments->fetch();
$averageNoteInNumeric = (int) implode('', $averageNote);

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

        <h1 class="mt-5"><?= $recipe['title'] ?></h1>
        <div>
            <article>
                <?= $recipe['recipe'] ?>
            </article>
            <aside class="my-3">
                <p><i>Contribuée par <?= $recipe['author'] ?></i></p>
                
                <p><b>Evaluée par la communauté à <?=$averageNoteInNumeric?> / 5 </b></p>
            </aside>
        </div>
        <hr />
        <h2 class="text-secondary my-3">Commentaires</h2>
            <?php if ($comments != NULL) {
                foreach ($comments as $comment) { ?>
                    <p><?=date('Y-m-d', strtotime($comment['created_at']))
                    ?> <i>écrit par <?= $comment['full_name'] ?></i></p>
                    <p><?= $comment['comment'] ?></p>
                    
    <?php }
            } else { ?>
    <p>Aucun Commentaire</p>
<?php } ?>

<hr />
<h2 class="text-secondary my-3">A vous de jouer !</h2>
<?php if (isset($_SESSION['loggedUser'])) { ?>
    <?php require_once(__DIR__ . '/comments_create.php'); ?>
<?php } ?>
    </div>

    <?php require_once(__DIR__ . '/footer.php') ?>
</body>

</html>