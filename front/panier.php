<?php
require('secu/pluginCO.php');
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
      if (isset($_GET['ajouttheme'])) {
        $sql = "SELECT * FROM panier p WHERE p.id_client=(?)";
        $result=connexionBDD()->prepare($sql);
        $result->execute(array($id_client));
        while($results = $result -> fetch()) {
            $panier_decode=json_decode($results['panier_json'],true);
        }
        for ($i=1; $i <= max(array_keys($_POST)); $i++) {
          $sql="SELECT * FROM produit WHERE id=(?)";
          $traitement=connexionBDD()->prepare($sql);
          $traitement->execute(array($_POST[$i]));
          while($traitements = $traitement -> fetch()) {
            $idProduit=$traitements['id'];
            $qteProduit=1;
            $prixProduit=$traitements['prix'];
          }
          $positionProduit = array_search($_POST[$i],$panier_decode['produit']);
        $qteProduit=1;
        if ($positionProduit !== false)
        {
           $panier_decode['qte'][$positionProduit]+=$qteProduit;
           //$panier_decode['qte'][$positionProduit]=(string)$panier_decode['qte'][$positionProduit];
        }
        else
        {
           //Sinon on ajoute le produit
           array_push($panier_decode['produit'],$idProduit);
           array_push($panier_decode['qte'],$qteProduit);
           array_push($panier_decode['prix'],$prixProduit);
        }
          $panier_encode=json_encode($panier_decode,true);

          $sql="UPDATE panier SET panier_json=(?)";
          $update=connexionBDD()->prepare($sql);
          $update->execute(array($panier_encode));
          header('location:panier.php');
        }

      }
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
        $positionProduit = array_search($_GET['produit'],$panier_decode['produit']);
      $qteProduit=1;
      if ($positionProduit !== false)
      {
         $panier_decode['qte'][$positionProduit]+=$qteProduit;
         //$panier_decode['qte'][$positionProduit]=(string)$panier_decode['qte'][$positionProduit];
      }
      else
      {
         //Sinon on ajoute le produit
         array_push($panier_decode['produit'],$idProduit);
         array_push($panier_decode['qte'],$qteProduit);
         array_push($panier_decode['prix'],$prixProduit);
      }
        $panier_encode=json_encode($panier_decode,true);

        $sql="UPDATE panier SET panier_json=(?)";
        $update=connexionBDD()->prepare($sql);
        $update->execute(array($panier_encode));
        header('location:panier.php');
      }
      else{




        if (isset($_GET['supprproduit'])) {
          $sql = "SELECT * FROM panier p WHERE p.id_client=(?)";
          $result=connexionBDD()->prepare($sql);
          $result->execute(array($id_client));
          while($results = $result -> fetch()) {
            $panier_decode=json_decode($results['panier_json'],true);
          }

          $positionProduit = array_search($_GET['supprproduit'],$panier_decode['produit']);
          unset($panier_decode['produit'][$positionProduit]);
          unset($panier_decode['qte'][$positionProduit]);
          unset($panier_decode['prix'][$positionProduit]);

          var_dump($panier_decode);

          $sql="UPDATE panier SET panier_json=(?) WHERE id_client=(?)";
          $update=connexionBDD()->prepare($sql);
          $new_panier=json_encode($panier_decode,true);
          $update->execute(array($new_panier,$id_client));
          header('location:panier.php');





        }
        if (isset($_GET['modifProduit'])) {
          // modification des quantités produits (nombre personnes)
          $sql = "SELECT * FROM panier p WHERE p.id_client=(?)";
          $result=connexionBDD()->prepare($sql);
          $result->execute(array($id_client));
          while($results = $result -> fetch()) {
            $panier_decode=json_decode($results['panier_json'],true);
          }
          $sql="UPDATE panier SET panier_json=(?) WHERE id_client=(?)";
          $update=connexionBDD()->prepare($sql);
          $positionProduit = array_search($_GET['modifProduit'],$panier_decode['produit']);

                            if ($panier_decode['qte'][$positionProduit]==$_POST['new_qte']) {
                        // si la quantité est la même on change rien
                      }
                      else{
                        if ($positionProduit !== false)
                        {
                          if ($_POST['new_qte']>0) {
                            $panier_decode['qte'][$positionProduit]=$_POST['new_qte'];
                          }
                          else{
                            $panier_decode['qte'][$positionProduit]=$panier_decode['qte'][$positionProduit];
                          }

                        }
                        else
                        {
                          // erreur , produit pas dans le tableau
                        }
                      }

          $new_panier=json_encode($panier_decode,true);
          $update->execute(array($new_panier,$id_client));
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
          $panier="<table class='table'><tr><th>Produit</th><th>Nombre de personnes</th><th>Prix</th><th>Supprimer</th></tr>";
          $panier.="<tr>";
          for ($i=0; $i <= max(array_keys($panier_decode['produit'])); $i++) {
            $sql="SELECT nom,prix FROM produit WHERE id=(?)";
            $result=connexionBDD()->prepare($sql);
            if (isset($panier_decode['produit'][$i])) {
              $result->execute(array($panier_decode['produit'][$i]));
              while($results = $result -> fetch()) {
                  $nomproduit=$results['nom'];
                  $prixproduit=$results['prix'];
              }
              if (isset($nomproduit) && isset($prixproduit)) {
                $panier.="<tr><td>".$nomproduit."</td><td><form method='post' action='panier.php?modifProduit=".$panier_decode['produit'][$i]."'><input type='number' name='new_qte' value='".$panier_decode['qte'][$i]."'><input value='Modifier' type='submit'></form></td><td>".$prixproduit." € </td><td style='text-align:center;'><a href='panier.php?supprproduit=".$panier_decode['produit'][$i]."'><span class='glyphicon glyphicon-trash'></span></a></td></tr>";
                $total+=$panier_decode['qte'][$i]*$prixproduit;
              }
            }


          }
          $panier.="<tr><th colspan='2'>Total : </th><th>".$total." € </th></tr></table>";
        }
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
