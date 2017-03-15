<?php
require('secu/pluginCO.php');
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <?php require('head.php'); ?>
  </head>
  <body>

    <?php require('menu.php'); ?>

  <!-- connexion -->

  <div class="col-sm-8" style="margin-left:16%;margin-right:16%;text-align:center;">
    <form method="post" action="connexion.php?type=connexion">
      <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
        <input id="email" type="text" class="form-control" name="email" placeholder="Email">
      </div>
      <br>
      <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
        <input id="password" type="password1" class="form-control" name="password" placeholder="Password">
      </div>
      <br>
      <button type="submit" class="btn btn-default">Se connecter</button>
  </form>
    </div>
    <br>
    <!-- fin de connexion -->
    <div class="col-sm-8" style="margin-left:16%;margin-right:16%;">
      <a class="btn btn-lg btn-primary" href="inscription.php">Pas encore de compte ? Inscrivez-vous ICI.</a>
    </div>

    
    <?php require('footer.php') ?>

  </body>
</html>
