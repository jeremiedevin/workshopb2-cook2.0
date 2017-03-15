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

<div>
<h3>Informations de compte:</h3>
<?php
  if (isset($_SESSION['mail'])) {
    $sql="SELECT * FROM user WHERE mail=(?)";
    $findUser=connexionBDD()->prepare($sql);
    $findUser->execute(array($_SESSION['mail']));
    while($findUsername = $findUser -> fetch()) {
        $username=$findUsername['username'];
        $usermail=$findUsername['mail'];

    }
    echo "Nom d'utilisateur: ".$username."<br/>";

    echo "Mail: ".$usermail."<br/>";

  }
  else{
    echo "Error, information missing";
  }
?>
</div>

<!--bouton de deco avec un style... pas tarrible-->
<?php
  if (!empty($_GET['act'])) {
  session_destroy();
  header('Location: index.php');
  }
  else {
?>
<form action="moncompte.php" method="get">
  <input type="hidden" name="act" value="run">
  <input type="submit" value="Deconnexion" class="form-control">
</form>
<?php
  }
?>
<!--Fin du bouton de deco-->

    <?php require('footer.php') ?>

  </body>
</html>
