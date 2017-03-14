<?php
function connexionAdmin(){
  $dbhost = "localhost";
  $dbname = "id1066945_kegroupeepsi";
  $dbusername = "id1066945_kegroupeepsi";
  $dbpassword = "Epsi1234";

  try {

  $pdo = new PDO("mysql:host=$dbhost;dbname=$dbname",$dbusername,$dbpassword,array(1002 => 'SET NAMES utf8'));
}
catch(PDOException $e) {
      echo "Something went wrong";
       $e->getMessage();
  exit;
  }
  return $pdo;
}


if (isset($_GET['type'])) {
  switch ($_GET['type']) {
    case 'inscription':
      $username=$_POST['name_user'];
      $mail=$_POST['email'];
      $password=$_POST['password1'];

      // on fait un insert dans la bdd
      $sql="INSERT INTO user(username,mail,password) VALUES (?,?,?)";
      $traitement=connexionAdmin()->prepare($sql);
      $traitement->execute(array($username,$mail,password_hash($password, PASSWORD_DEFAULT)));

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
