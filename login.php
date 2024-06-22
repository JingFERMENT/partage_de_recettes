<?php


$postData = $_POST;


if (isset($postData['email']) && isset($postData['password'])) {
  if (!filter_var($postData['email'], FILTER_VALIDATE_EMAIL)) {
    $errormsg = 'Merci de saisir un email valide.';
  } else {
    foreach ($users as $user) {
      if (
        $user['email'] === $postData['email'] &&
        $user['password'] === $postData['password']
      ) {
        $loggedUser = [
          'email' => $user['email'],
        ];
      } 
    }
  }

  if(!isset($loggedUser)) {
    $errormsg = sprintf(
      'l\'email que vous avez envoyé ne permet pas d\'identifer : (%s)', $postData['email']);
  }

  



}
?>

<!-- if the user is not identified, display the form  -->
 <?php if(!isset($loggedUser)) {?>
<form action="index.php" method="POST">
  <!-- if user failed, display the error message -->
  <div class="text-danger" ><?=$errormsg ?? '' ?></div>
  <div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="email" class="form-control" id="email" name="email" aria-describedby="email" placeholder="exemple@hotmail.com">
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Mot de passe</label>
    <input type="password" class="form-control" id="password" name="password">
  </div>
  <button type="submit" class="btn btn-primary">Envoyer</button>
</form>
<?php } else {?>
<!-- if the user successed, display the success message -->
<div class="text-success">
  Bonjour <?= $loggedUser['email'] ?>, bienvenu sur le site des recettes de cuisine.
<?php } ?>
</div>