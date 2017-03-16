<?php
require('secu/pluginCO.php');

if (isset($_GET['categorie'])) {
  # code...
}
else{
  $sql="SELECT id FROM theme";
  $trait=connexionBDD()->query($sql);
  $count=$trait->rowCount();
  $affichageTheme="<div class='col-sm-10'><form method='post' action='panier.php?ajouttheme'>";
  for ($i=1; $i <= $count; $i++) {
    $affichageTheme.="<div>Thème : ".$i."</div>";
    $sql="SELECT * FROM produit WHERE id_theme=(?)";
    $result=connexionBDD()->prepare($sql);
    $result->execute(array($i));
    while($row=$result->fetch()){
      $id=$row['id'];
      $nom=$row['nom'];
      $image=$row['image'];
      $description=$row['description'];
      $affichageTheme.="<div class='col-sm-6' style='border:1px solid grey;text-align:center;'>";
      $affichageTheme.="<h2>".$nom."</h2><figure class='figure'>";
      $affichageTheme.="<img style='width:50%;' src='images/restos/".$image."' class='figure-img img-fluid rounded' alt='".$nom."'>";
      $affichageTheme.="<figcaption class='figure-caption'>".$description."</figcaption>";
      $affichageTheme.="</figure><br>";
      $affichageTheme.="<input name='".$id."' value='".$id."' type='checkbox'></div>";
    }
    $sql="SELECT * FROM produit WHERE id_theme=(?)";
    $result=connexionBDD()->prepare($sql);
    $result->execute(array($i));
    while($row = $result -> fetch()){
      $id=$row['id'];
      $nom=$row['nom'];
      $image=$row['image'];
      $description=$row['description'];
      $affichageTheme.="<div class='col-sm-6' style='border:1px solid grey;text-align:center;'>";
      $affichageTheme.="<h2>".$nom."</h2><figure class='figure'>";
      $affichageTheme.="<img style='width:50%;' src='images/visites/".$image."' class='figure-img img-fluid rounded' alt='".$nom."'>";
      $affichageTheme.="<figcaption class='figure-caption'>".$description."</figcaption>";
      $affichageTheme.="</figure><br>";
      $affichageTheme.="<input name='".$id."' value='".$id."' type='checkbox'></div>";
    }
  }
  $affichageTheme.="</div><div class='col-sm-12' style='text-align:center;margin-top:8vh;margin-bottom:3vh;'>";
  $affichageTheme.="<select name='nbperson' required><option value='1'>1</option><option value='2'>2</option><option value='3'>3</option><option value='4'>4</option><option value='5'>5</option><option value='6'>6</option></select>";
  $affichageTheme.="<input class='btn btn-lg btn-primary' type='submit' value='Ajouter au panier'></form></div>";
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

    <?php
     echo $affichageTheme;
    ?>

  </body>
</html>
