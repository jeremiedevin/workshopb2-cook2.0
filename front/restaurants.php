<?php
require('secu/pluginCO.php');

$affichageVisites="";
$sql="SELECT * FROM restaurants";
$result=connexionBDD()->query($sql);
while($row = $result -> fetch()){
  $nom=$row['nom'];
  $image=$row['image'];
  $description=$row['description'];
  $affichageVisites.="<div class='col-sm-6' style='border:1px solid grey;text-align:center;'>";
  $affichageVisites.="<h2>".$nom."</h2><figure class='figure'>";
  $affichageVisites.="<img style='width:50%;' src='images/restos/".$image."' class='figure-img img-fluid rounded' alt='".$nom."'>";
  $affichageVisites.="<figcaption class='figure-caption'>".$description."</figcaption>";
  $affichageVisites.="</figure><br></div>";
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
