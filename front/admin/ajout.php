<?php
  require('../conf/bdd.php');

  $select="";
  $sql="SELECT id,nom FROM categorie";
  $affichage=connexionBDD()->query($sql);
  while($row = $affichage -> fetch()){
    $id_catego=$row['id'];
    $nom_catego=$row['nom'];
    if (isset($id_catego)) {
      $select.="<option value='".$id_catego."'>".$nom_catego."</option>";
    }
  }
  $select2="";
  $sql="SELECT id,nom FROM theme";
  $affichage=connexionBDD()->query($sql);
  while($row = $affichage -> fetch()){
    $id_catego=$row['id'];
    $nom_catego=$row['nom'];
    if (isset($id_catego)) {
      $select2.="<option value='".$id_catego."'>".$nom_catego."</option>";
    }
  }

if (isset($_GET['success'])) {
  echo "<p align='center' class='alert-success'>Le produit a bien été rajouté dans votre boutique !</p>";
}
  if (isset($_GET['ajoutProduit'])) {

    if ($_POST['categorie']=='1') {
      $dossier="../images/restos/";
    }
    if ($_POST['categorie']=='2') {
      $dossier="../images/visites/";
    }
    $fichier = basename($_FILES['image']['name']);
    $taille_maxi = 100000;
    $taille = filesize($_FILES['image']['tmp_name']);
    $extensions = array('.bmp','.png', '.gif', '.jpg', '.jpeg', '.jpeg','.JPG','.PNG','.GIF','.JPEG');
    $extension = strrchr($_FILES['image']['name'], '.');
    //Début des vérifications de sécurité...
    if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
    {
   $erreur = 'Vous devez uploader un fichier de type png, gif, jpg, jpeg...';
    }
    if($taille>$taille_maxi)
    {
   $erreur = 'Le fichier est trop gros...';
    }
    if(!isset($erreur)) //S'il n'y a pas d'erreur, on upload
    {
//On formate le nom du fichier ici...
$fichier = strtr($fichier,
'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ',
'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
$fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
if(move_uploaded_file($_FILES['image']['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
{
  $nom=$_POST['nom'];
  $image=$fichier;
  $description=$_POST['description'];
  $prix=$_POST['prix'];
  $categorie=$_POST['categorie'];
  $theme=$_POST['theme'];
  $sqlajout="INSERT INTO produit(id_typeproduit, id_theme, nom, image, description, prix) VALUES (?,?,?,?,?,?)";
  $traitement=connexionBDD()->prepare($sqlajout);
  $traitement->execute(array($categorie,$theme,$nom,$image,$description,$prix,));
  header('location:ajout.php?success');
}
else //Sinon (la fonction renvoie FALSE).
{
  echo 'Echec de l\'upload !';
}
    }
    else
    {
echo $erreur;
    }

  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Ajouter un produit</title>
    <link rel="stylesheet" href="../plugins\bootstrap-3.3.7-dist\css/bootstrap.min.css">
    <link rel="stylesheet" href="../plugins\font-awesome-4.7.0\css/font-awesome.min.css">

    <script src="../js/jquery.js"></script>

    <link rel="stylesheet" href="../css/master.css">
  </head>
  <body>

    <div class="col-sm-12">
      <a class="btn btn-md btn-warning" href="../index.php">Retourner sur le site</a>
    </div>
    <br>
    <br>
    <div class="col-sm-8">
    <h1>Ajout d'un produit</h1>
      <form class="" action="ajout.php?ajoutProduit" method="post" enctype="multipart/form-data">
        <div class="form-group">
        <label>Nom de l'activité :</label>
        <input type="text" name="nom" class="form-control">
      </div>
      <div class="form-group">
        <label>Prix/Personne :</label>
        <input type="number" step="0.01" name="prix" class="form-control">
      </div>
      <div class="form-group">
        <label for="comment">Description : </label>
        <textarea class="form-control" name="description" rows="5"></textarea>
      </div>
        <div class="form-group">
          <label>Selectionner la catégorie :</label>
          <select class="form-control" name="categorie">
            <?php echo $select; ?>
          </select>
        </div>
        <div class="form-group">
          <label>Selectionner le thème :</label>
          <select class="form-control" name="theme">
            <?php echo $select2; ?>
          </select>
        </div>
        <div class="form-group">
          <label>Image :</label>
          <input type="hidden" name="MAX_FILE_SIZE" value="100000" />
          <input type="file" class="form-control" name="image">
        </div>
        <button type="submit" class="btn btn-default btn-primary">Enregistrer</button>
      </form>
    </div>

  </body>
</html>
