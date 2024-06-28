<?php

require_once(__DIR__ . '/isConnect.php');
?>

<form action="comments_post_create.php" method="POST">
    <div class="mb-3">
        <label for="comment" class="form-label fw-bold">Ecrire un commentaire :</label>
        <textarea class="form-control" id="comment" name="comment" placeholder="Merci de laisser vos commentaires ici."></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Envoyer</button>
</form>