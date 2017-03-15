<?php

require('secu/pluginCO.php');
$_SESSION['mail']='jeremie.devin@epsi.fr';
if (isset($_SESSION['mail'])) {

  $sql="SELECT id FROM user WHERE mail=(?)";
  $result=connexionBDD()->prepare($sql);
  $result->execute(array($_SESSION['mail']));
  $count = $result->rowCount();
  if ($count<=0){

  }
  else{
    while($row = $result -> fetch()){
      $id_client=$row['id'];
    }
    $sql="SELECT * FROM panier WHERE id_client=(?)";
    $traitement=connexionBDD()->prepare($sql);
    $traitement->execute(array($id_client));
    $count2 = $traitement->rowCount();
    if ($count2==0){
      $sql="INSERT INTO panier (panier_json,prix_panier,id_client) VALUES ('{\"qte\": [], \"prix\": [], \"produit\": []}',0,?)";
      $ajoutpanier=connexionBDD()->prepare($sql);
      $ajoutpanier->execute(array($id_client));
      header('location:panier.php?produit='.$id.'');
    }
    else{
      if (isset($_GET['produit'])) {
        // ajout d'un article
        $sql = "SELECT * FROM panier p WHERE p.id_client=(?)";
        $result=connexionBDD()->prepare($sql);
        $result->execute(array($id_client));
        while($results = $result -> fetch()) {
            $panier_decode=json_decode($results['panier_json'],true);
        }
        $sql="SELECT * FROM produit WHERE id=(?)";
        $traitement=connexionBDD()->prepare($sql);
        $traitement->execute(array($_GET['produit']));
        while($traitements = $traitement -> fetch()) {
          $idProduit=$traitements['id'];
          $qteProduit=1;
          $prixProduit=$traitements['prix'];
        }
        array_push($panier_decode['produit'],$idProduit);
        array_push($panier_decode['qte'],$qteProduit);
        array_push($panier_decode['prix'],$prixProduit);

        $panier_encode=json_encode($panier_decode,true);

        $sql="UPDATE panier SET panier_json=(?)";
        $update=connexionBDD()->prepare($sql);
        $update->execute(array($panier_encode));
        header('location:panier.php');
      }
      else{
        // affichage du panier
        $total="";
        $sql = "SELECT * FROM panier p WHERE p.id_client=(?)";
        $result=connexionBDD()->prepare($sql);
        $result->execute(array($id_client));
        while($results = $result -> fetch()) {
          $panier_decode=json_decode($results['panier_json'],true);
        }
        $panier="<table class='table'><tr><th>Produit</th><th>Quantité</th><th>Prix</th></tr>";
        $panier.="<tr>";
        for ($i=0; $i <= max(array_keys($panier_decode['produit'])); $i++) {
          $sql="SELECT nom,prix FROM produit WHERE id=(?)";
          $result=connexionBDD()->prepare($sql);
          $result->execute(array($panier_decode['produit'][$i]));
          while($results = $result -> fetch()) {
              $nomproduit=$results['nom'];
              $prixproduit=$results['prix'];
          }
          $panier.="<tr><td>".$nomproduit."</td><td>".$panier_decode['qte'][$i]."</td><td>".$prixproduit." € </td></tr>";
          $total+=$panier_decode['qte'][$i]*$prixproduit;
        }
        $panier.="<tr><th colspan='2'>Total : </th><th>".$total." € </th></tr></table>";
      }
    }
  }
}
else{
  header('location:connexion.php');
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

    <?php echo $panier; ?>

  </body>
</html>
