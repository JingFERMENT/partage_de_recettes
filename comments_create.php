<?php
require_once(__DIR__ . '/isConnect.php');
?>

<form action="comments_post_create.php?id=<?= $getData['id'] ?>" method="POST">
    <div class="mb-3">
        <label for="review" class="form-label fw-bold">Evaluer la recette entre 1 et 5:</label>
        <input type = "number" class="form-control" id="review" name="review" min= "1" max = "5" step = "1" />
    </div>
    <div class="mb-3">
        <label for="comment" class="form-label fw-bold">Ecrire un commentaire :</label>
        <textarea class="form-control" id="comment" name="comment" placeholder="Merci de laisser vos commentaires ici."></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Envoyer</button>
</form>