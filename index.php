<?php include  'include/header.php'; ?>
<?php
session_start();
$errVide = isset($_SESSION['errVide']) ? $_SESSION['errVide'] : '';
$errConnexion = isset($_SESSION['errConnexion']) ? $_SESSION['errConnexion'] : '';
// Réinitialiser les messages d'erreur après les avoir affichés
unset($_SESSION['errVide']);
unset($_SESSION['errConnexion']);
?>

<form action="login/login.php" method="post">
  <div class="modal-body">
    <div class="form-group">
      <label>Email</label>
      <input type="text" name="email" id="email" class="form-control" placeholder="email">
      <p><?= $errVide ?></p>
    </div>
    <div class="form-group">
      <label>Mot de passe</label>
      <input type="password" name="password" id="password"  class="form-control" placeholder="mot de passe">
      <p><?= $errConnexion?></p>
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
    <button type="submit" name="loginAdmin" class="btn btn-default" style="background-color:#568ADC;color:white;">Se connecter</button>
  </div>
</form>
<?php include  'include/footer.php'; ?>
