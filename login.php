<!-- if the user is not identified, display the form  -->
<?php if (!isset($_SESSION['loggedUser'])) { ?>
  <form action="submit_login.php" method="POST">
    
      <?php if (isset($_SESSION['LOGIN_ERROR_MESSAGE'])) { ?>
        <div class="alert alert-danger" role="alert">
          <?= $_SESSION['LOGIN_ERROR_MESSAGE'];
          unset($_SESSION['LOGIN_ERROR_MESSAGE']); ?>
        </div>
      <?php } ?>

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
<?php } else { ?>
  <!-- if the user successed, display the success message -->
  <div class="alert alert-success" role="alert">
    Bonjour <?= $_SESSION['loggedUser']['email'] ?>, bienvenu sur le site des recettes de cuisine.
  </div>
<?php } ?>