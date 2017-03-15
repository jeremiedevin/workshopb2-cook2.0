<?php
require('secu/pluginCO.php'); ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <?php require('head.php'); ?>
  </head>
  <body>

    <?php require('menu.php'); ?>
<div>
<h3>Informations de compte:</h3>

</div>

<!--bouton de deco avec un style... pas tarrible-->
<?php
  if (!empty($_GET['act'])) {
  session_destroy();
  } else {
?>
<form action="moncompte.php" method="get">
  <input type="hidden" name="act" value="run">
  <input type="submit" value="Deconnexion" class="form-control">
</form>
<?php
  }
?>
    <?php require('footer.php') ?>

  </body>
</html>
