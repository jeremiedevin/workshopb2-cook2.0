<?php
require('secu/pluginCO.php');

if (isset($_GET['categorie'])) {
  # code...
}
else{
  $sql="SELECT id FROM theme";
  $trait=connexionBDD()->query($sql);
  $count=$trait->rowCount();
  $affichageTheme="<div class='col-sm-10'>";
  for ($i=1; $i <= $count; $i++) {
    $affichageTheme.="<div>Thème : ".$i."</div>";
    $sql="SELECT * FROM restaurants WHERE id_theme=(?)";
    $result=connexionBDD()->prepare($sql);
    $result->execute(array($i));
    while($row=$result->fetch()){
      $nom=$row['nom'];
      $image=$row['image'];
      $description=$row['description'];
      $affichageTheme.="<div class='col-sm-6' style='border:1px solid grey;text-align:center;'>";
      $affichageTheme.="<h2>".$nom."</h2><figure class='figure'>";
      $affichageTheme.="<img style='width:50%;' src='images/restos/".$image."' class='figure-img img-fluid rounded' alt='".$nom."'>";
      $affichageTheme.="<figcaption class='figure-caption'>".$description."</figcaption>";
      $affichageTheme.="</figure><br></div>";
    }
    $sql="SELECT * FROM visites WHERE id_theme=(?)";
    $result=connexionBDD()->prepare($sql);
    $result->execute(array($i));
    while($row = $result -> fetch()){
      $nom=$row['nom'];
      $image=$row['image'];
      $description=$row['description'];
      $affichageTheme.="<div class='col-sm-6' style='border:1px solid grey;text-align:center;'>";
      $affichageTheme.="<h2>".$nom."</h2><figure class='figure'>";
      $affichageTheme.="<img style='width:50%;' src='images/visites/".$image."' class='figure-img img-fluid rounded' alt='".$nom."'>";
      $affichageTheme.="<figcaption class='figure-caption'>".$description."</figcaption>";
      $affichageTheme.="</figure><br></div>";
    }
  }
  $affichageTheme.="</div>";
}

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

    <?php require('header.php'); ?>

    <?php echo $affichageTheme; ?>

  </body>
</html>
