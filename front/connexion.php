<!DOCTYPE html>

<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <?php require('head.php'); ?>
  </head>
  <body>

    <?php require('menu.php'); ?>

  <!-- connexion -->

  <div class="col-sm-8" style="margin-left:16%;margin-right:16%;">
    <form>
      <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
        <input id="email" type="text" class="form-control" name="email" placeholder="Email">
      </div>
      <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
        <input id="password" type="password" class="form-control" name="password" placeholder="Password">
      </div>
      <button type="submit" class="btn btn-default">Se connecter</button>
  </form>
    </div>

    <!-- fin de connexion -->


    <?php require('footer.php') ?>

  </body>
</html>
