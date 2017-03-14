<?php
require('secu/pluginCO.php');

$affichageVisites="";
$sql="SELECT * FROM visites";
$result=connexionBDD()->query($sql);
while($row = $result -> fetch()){
  $nom=$row['nom'];
  $image=$row['image'];
  $description=$row['description'];
  $affichageVisites.="<div class='col-sm-6'><figure class='figure'>";
  $affichageVisites.="<img src='images/visites/".$image."' class='figure-img img-fluid rounded' alt='".$nom."'>";
  $affichageVisites.="<figcaption class='figure-caption'>".$description."</figcaption>";
  $affichageVisites.="</figure></div>";
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

    <?php echo $affichageVisites; ?>

  </body>
</html>
