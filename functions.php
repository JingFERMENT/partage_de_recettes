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
    [
        'title' => 'Salade Romaine',
        'recipe' => 'Etape 1 : prenez une belle salade',
        'author' => 'lorene.castor@exemple.com',
        'is_enabled' => true,
    ],
];

function displayAuthor(string $authorEmail, array $users): string
    {
        //var_dump($authorEmail); die();
        foreach($users as $user) {
            if ($authorEmail === $user['email']) {
                return $user['full_name'] . '(' . $user['age'] . ' ans)';
            }
        }

        return 'Author not found';
    }
function isValidRecipe(array $recipe): bool
    {
        return $recipe['is_enabled'];
    }
function getRecipes(array $recipes) : array
    {
        $valid_recipes = [];
        foreach($recipes as $recipe) {
            if (isValidRecipe($recipe)) {
                $valid_recipes[] = $recipe;
            }
        }
    return $valid_recipes;
}

// function for redirect the URL
function redirectToUrl(string $url):never {
    header("Location: {$url}");
    exit();

}
?>