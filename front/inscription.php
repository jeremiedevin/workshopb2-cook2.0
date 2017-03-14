<?php
require('secu/pluginCO.php');
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

  <!-- inscription -->

  <div class="col-sm-8" style="margin-left:16%;margin-right:16%;">
    <form action="inscription.php?type=inscription" method="post">
      <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
        <input id="name_user" type="text" class="form-control" name="name_user" placeholder="Nom d'utilisateur">
      </div>
       <div class="input-group">
         <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
         <input id="email" type="text" class="form-control" name="email" placeholder="Email">
       </div>
       <div class="input-group">
         <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
         <input id="password" type="password" class="form-control" name="password1" placeholder="Password">
       </div>
			 <div class="wthree-text">
			      <input type="checkbox" name="accept" id="brand1" value="">
						<label for="brand1"><span></span>Je ne suis pas un robot</label>
			 </div>
			 <input type="submit" value="S'inscrire">
		</form>
  </div>

    <!-- fin de inscription -->

    <?php require('footer.php') ?>

  </body>
</html>
