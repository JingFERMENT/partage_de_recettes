<?php
$recipes = [
    [
        'title' => 'Cassoulet',
        'recipe' => 'Etape 1 : des flageolets !',
        'author' => 'mickael.andrieu@exemple.com',
        'is_enabled' => true,
    ],
    [
        'title' => 'Couscous',
        'recipe' => 'Etape 1 : de la semoule',
        'author' => 'mickael.andrieu@exemple.com',
        'is_enabled' => false,
    ],
    [
        'title' => 'Escalope milanaise',
        'recipe' => 'Etape 1 : prenez une belle escalope',
        'author' => 'mathieu.nebra@exemple.com',
        'is_enabled' => true,
    ],
];
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Affichage des recettes</title>
</head>

<body>
    <h1>Affichage des recettes</h1>
    <!-- boucles for the recipes-->
    <?php foreach ($recipes as $recipe) {
        // check if the key exists, if yes, display the recipe
        if (array_key_exists('is_enabled', $recipe) && $recipe['is_enabled'] === true) { ?>
            <article>
                <h3><?= $recipe['title'] ?></h3>
                <div><?= $recipe['recipe'] ?></div>
                <i><?= $recipe['author'] ?></i>
            </article>
    <?php }
    } ?>
</body>

</html>