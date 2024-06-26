<?php 

function displayAuthor(string $authorEmail, array $users): string
    {
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