<?php
session_start();
require_once(__DIR__ . '/variables.php');
require_once(__DIR__ . '/functions.php');

$postData = $_POST;

//validation du formulaire
if (isset($postData['email']) && isset($postData['password'])) {
    if (!filter_var($postData['email'], FILTER_VALIDATE_EMAIL)) {
        $_SESSION['LOGIN_ERROR_MESSAGE'] = 'Merci de saisir un email valide.';
    } else {
        foreach ($users as $user) {
            if (
                $user['email'] === $postData['email'] &&
                $user['password'] === $postData['password']
            ) {
                $_SESSION['loggedUser'] = [
                    'email' => $user['email'],
                    'user_id' => $user['user_id'],
                ];
            }
        }
    }

    if (!isset($_SESSION['loggedUser'])) {
        $_SESSION['LOGIN_ERROR_MESSAGE'] = sprintf(
            'L\'email que vous avez envoyé ne permet pas d\'identifer : %s',
            $postData['email']
        );
    }

   redirectToUrl('index.php');
}
