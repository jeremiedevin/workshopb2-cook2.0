<?php

function connexionBDD(){
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

?>
