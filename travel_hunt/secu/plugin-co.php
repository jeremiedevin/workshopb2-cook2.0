<?php

if (isset($_GET['type'])) {
  switch ($_GET['type']) {
    case 'inscription':
      $username=$_POST['name_user'];
      $mail=$_POST['email'];
      $password1=$_POST['password1'];
      $password2=$_POST['password2'];

      // on fait un insert dans la bdd 

      break;
    case 'connexion':
      # code...
      break;

    default:
      # code...
      break;
  }
}


 ?>
