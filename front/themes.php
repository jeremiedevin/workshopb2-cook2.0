<?php
require('secu/pluginCO.php');

$affichageVisites="";
$sql="SELECT * FROM theme";
$result=connexionBDD()->query($sql);
while($row = $result -> fetch()){
  
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

  </body>
</html>
