<?php

/**
 * On ne traite pas les super globales provenant de l'utilisateur directement,
 * ces données doivent être testées et vérifiées.
 */

 $postData = $_POST;

 if (
    !isset($postData['email'])
    || !filter_var($postData['email'], FILTER_VALIDATE_EMAIL)
    || empty($postData['message'])
    || trim($postData['message']) === ''
) {
    echo('Il faut un email et un message valides pour soumettre le formulaire.');
    return;
}

//  1) tester si le fichier a bien été envoyé et s'il n'y a pas d'erreur 

$isFileLoaded = false;

 if(isset($_FILES['screenshot']) && $_FILES['screenshot']['error'] === 0) {
    // tester si le fichier est trop volumineux 
    if($_FILES['screenshot']['size'] > 1000000) {
        echo 'L\'envoi n\'a pas pu être effectué, erreur ou image trop volumineuse.';
        return;
    }

    // 2) tester si l'extension est autorisée  
    $extension = pathinfo($_FILES['screenshot']['name'], PATHINFO_EXTENSION);
    $allowedExtensions = ['jpeg', 'jpg', 'gif', 'png'];

    if(!in_array($extension,$allowedExtensions)){
        echo "L'envoi n'a pas pu être effectué, l'extension {$extension} n'est pas authorisée.";
        return;
    }

    // 3) tester si le dossier pour uploader les fichiers existent 
    $path = __DIR__ . '/uploads/' ;
    if(!is_dir($path)){
        echo 'L\'envoi n\'est pas pu être effectué, le dossier upload est manquant.';
        return;
    }

    // 4) on peut valider le fichier et le stocker définitivement
    $filename = uniqid('img_');
    $from = $_FILES['screenshot']['tmp_name'];
    $toBack = $path . $filename . '.' . $extension;
    move_uploaded_file($from, $toBack);
    $isFileLoaded = true;
 }
?>



<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site de Recettes - Contact reçu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>


<body class="d-flex flex-column min-vh-100">
    <div class="container">
        <!-- header -->
        <?php require_once(__DIR__ . '/header.php'); ?>
        <h1>Message bien reçu !</h1>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Rappel de vos informations</h5>
                <p class="card-text"><b>Email</b> : <?= $postData['email']; ?></p>
                <!-- strip_tags : retirer les balises HTML -->
                <p class="card-text"><b>Message</b> : <?= strip_tags($postData['message']); ?></p>
            <?php if($isFileLoaded) {?>
                <div class="alert alert-success" role="alert">
                L'envoi a bien été effectué !
            </div>
            <?php }?>
            </div>
        </div>
    </div>
    <!-- footer -->
    <?php require_once(__DIR__ . '/footer.php'); ?>
</body>


</html>