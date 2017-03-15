<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Viz'eat - K&E</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="index.php">Accueil</a></li>
      <li><a href="themes.php">Thèmes</a></li>
      <li><a href="visites.php">Visites</a></li>
      <li><a href="restaurants.php">Restaurants</a></li>
    </ul>
    <?php
      if (isset($_SESSION['mail'])) {
        $sql="SELECT username FROM user WHERE mail=(?)";
        $findUser=connexionBDD()->prepare($sql);
        $findUser->execute(array($_SESSION['mail']));
        while($findUsername = $findUser -> fetch()) {
            $username=$findUsername['username'];
        }
        echo "<a href='moncompte.php' style='float:right' class='btn btn-danger navbar-btn'><i class='fa fa-user'> </i> ".$username."</a>";

        echo "<a href='panier.php' style='float:right' class='btn btn-danger navbar-btn'><i class='glyphicon glyphicon-shopping-cart'></i> Panier</a>";  //glyphicon glyphicon-shopping-cart
      }
      else{
        echo "<a href='connexion.php' style='float:right' class='btn btn-danger navbar-btn'><i class='fa fa-user'> </i> Connexion/Inscription</a>";
      }
    ?>
  </div>






</nav>
