<?php
session_start();
require('conf/bdd.php');


if (isset($_GET['type'])) {
  switch ($_GET['type']) {
    case 'inscription':
      $username=$_POST['name_user'];
      $mail=$_POST['email'];
      $password=$_POST['password1'];

      // on fait un insert dans la bdd
      $sql="INSERT INTO user(username,mail,password) VALUES (?,?,?)";
      $traitement=connexionBDD()->prepare($sql);
      $traitement->execute(array($username,$mail,password_hash($password, PASSWORD_DEFAULT)));
      header('location:inscription.php?success=inscription');
      break;

    case 'connexion':
      $mail=$_POST['email'];
      $password=$_POST['password'];

      $sql="SELECT password FROM user WHERE mail=(?)";
      $result=connexionBDD()->prepare($sql);
      $result->execute(array($mail));
      while($resultat=$result->fetch()){
        $password_bdd=$resultat['password'];
      }
      if (isset($password_bdd)) {
        if (password_verify($password,$password_bdd)) {
          $_SESSION['mail']=$mail;
        }
        else{
          // message d'erreur mot de passe incorrect
        }
      }
      else{
        // message d'erreur username does not exist
      }
      header('location:connexion.php');
      break;

    default:
      # code...
      break;
  }
}
else{
  // rien , type n'est pas set

  //verifier l'existence de session mail
  if (isset($_SESSION['mail'])) {
    $sql="SELECT username FROM user WHERE mail=(?)";
    $findUser=connexionBDD()->prepare($sql);
    $findUser->execute(array($_SESSION['mail']));
    $count = $findUser->rowCount();
    if ($count<=0) {
      header('location:connexion.php');
    }
  }
  else{
    //header('location:connexion.php');  //ce header pose problème de redirection en boucle
  }
}


 ?>
