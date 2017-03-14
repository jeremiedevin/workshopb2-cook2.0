<?php

  $affichage="";
  $sql="SELECT * FROM visites";
  $result=connexionAdmin()->query($sql);
  while($resultat=$result->fetch()){
    $nom=$resultat['nom'];
    $image=$resultat['image'];
    $description=$resultat['description'];
    $theme=$resultat['id_theme'];

    $affichage.="<div class='col-md-4 filtr-item' data-category='1, 4' data-sort='Busy streets'>";
    $affichage.="<div class='agileits-img'>";
    $affichage.="<a href='images/visites/".$image."' class='swipebox' title='".$description."'>";
    $affichage.="<img class='img-responsive img-style row2' src='images/visites/".$image."' alt=''/>";
    $affichage.="</a></div></div>";
  }
  echo $affichage;

?>
