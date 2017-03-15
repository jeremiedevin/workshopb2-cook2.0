<?php
require('secu/pluginCO.php');

$affichageVisites="";
$sql="SELECT * FROM produit WHERE id_typeproduit=2";
$result=connexionBDD()->query($sql);
while($row = $result -> fetch()){
  $id=$row['id'];
  $nom=$row['nom'];
  $image=$row['image'];
  $description=$row['description'];
  $affichageVisites.="<div class='col-sm-6' style='border:1px solid grey;text-align:center;'>";
  $affichageVisites.="<h2>".$nom."</h2><figure class='figure'>";
  $affichageVisites.="<img style='width:50%;' src='images/visites/".$image."' class='figure-img img-fluid rounded' alt='".$nom."'>";
  $affichageVisites.="<figcaption class='figure-caption'>".$description."</figcaption>";
  $affichageVisites.="</figure>";
  $affichageVisites.="<br><a href='panier.php?produit=".$id."'><button class='' value=''><i class='fa fa-shopping-cart' aria-hidden='true'></i> Ajouter au panier</button></a><br>";
  $affichageVisites.="</div>";
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

    <?php echo $affichageVisites; ?>

  </body>
</html>
