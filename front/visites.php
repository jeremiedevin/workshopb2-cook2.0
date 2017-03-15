<?php
require('secu/pluginCO.php');

$affichageVisites="";
$sql="SELECT * FROM produit WHERE id_typeproduit=2";
$result=connexionBDD()->query($sql);
while($row = $result -> fetch()){
  $id=$row['id'];
  $nom=$row['nom'];
  $image=$row['image'];
  $prix=$row['prix'];
  $description=$row['description'];
  $affichageVisites.="<div class='col-sm-6' style='border:1px solid grey;text-align:center;'>";
  $affichageVisites.="<h2>".$nom."</h2><figure class='figure'>";
  $affichageVisites.="<img style='width:50%;' src='images/visites/".$image."' class='figure-img img-fluid rounded' alt='".$nom."'>";
  $affichageVisites.="<figcaption class='figure-caption'>".$description."</figcaption>";
  $affichageVisites.="</figure>";
  $affichageVisites.="".$prix."€";
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
    <!--DEBUT test manu pour changer emplacement du marker googlemap-->
<button onclick="changeMarkerPosition(marker)">Click me to change map marker</button>
<script lang="javascript">
    function changeMarkerPosition(marker) {
        var latlng = new google.maps.LatLng(-24.397, 140.644);
        marker.setPosition(latlng);
    }
</script>
    <!--FIN test manu pour changer emplacement du marker googlemap-->

</script>
  </body>
</html>
