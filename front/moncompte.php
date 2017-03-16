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



    <div class="col-sm-12">
    <!--bouton de deco avec un style... pas tarrible-->
    <?php
      if (isset($_GET['deco']) && $_POST['act']) {
      session_destroy();
      header('Location: index.php');
      }
      else {
    ?>
    <form action="moncompte.php?deco" method="post">
      <input type="hidden" name="act" value="run">
      <input type="submit" value="Déconnexion" class="form-control">
    </form>
    <?php
      }
    ?>
    <!--Fin du bouton de deco-->
    </div>

<div class="col-sm-12">
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

    <?php require('footer.php') ?>

  </body>
</html>
