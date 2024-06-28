<?php
session_start();
require_once(__DIR__ .'/functions.php');
require_once(__DIR__ . '/isConnect.php');
require_once(__DIR__ . '/config/mysql.php');
require_once(__DIR__ . '/databaseconnect.php');

$getData= $_GET;

// check the id
if (!isset($getData['id']) || !is_numeric($getData['id'])) {
    echo 'La suppression ne peut pas être effectuée.';
    return;
}

// delete the recipe
$sqlQuery = 'DELETE FROM `recipes` WHERE recipe_id = :id';
$retrievedRecipeStatement = $mysqlClient->prepare($sqlQuery);
$retrievedRecipeStatement->execute([
    'id' => (int)$getData['id'],
]);

redirectToUrl('index.php');

