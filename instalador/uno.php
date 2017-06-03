<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <title>INSTALADOR</title>
  </head>
  <body>


    <div class="container">
    <header class="jumbotron">

      <h3 class="text-center">INSTALADOR WEB-PASO 1</h3>

    </header>

    </div>

    <?php
    if (!isset($_POST["nombre"])) : ?>

    <div class="form-group">
    <div class="col-sm-offset-5 col-sm-10">

      <form method="post">
        <fieldset>

          <br>

          <div class="forceColor"></div>
          <div class="topbar">
            <div class="spanColor"></div>

          <label>NOMBRE BBDD</label><br>
          <input name="nombre" type="text" class="input" id="nombre" placeholder="BBDD" required>
          <br>

          <label>usuario BBDD</label><br>
          <input name="usuario" type="text" class="input" id="usuario" placeholder="usuario" required>
          <br>

          <label>IP BBDD</label><br>
          <input name="ip" type="text" class="input" id="ip" placeholder="IP BBDD" required>
          <br>

          <label>Contraseña BBDD</label><br>
          <input name="password" type="password" class="input" id="password" placeholder="Password" required>
          <br><br>

          <button type="submit" class="btn btn-primary">SIGUIENTE</button>

        </fieldset>
      </form>
    </div>
    </div>
    <?php else: ?>

      <?php
      $nombrebbdd=$_POST["nombre"];
      $usuario=$_POST["usuario"];
      $passwd=$_POST["password"];
      $ip=$_POST["ip"];
      $a = '<?php $connection = new mysqli("'.$ip.'", "'.$usuario.'", "'.$passwd.'", "'.$nombrebbdd.'");';
      $file=fopen("../usuarios/conexion.php","w");
      fwrite($file,$a);
      fclose($file);
      $connection = new mysqli("$ip","$usuario","$passwd");
      $consulta= "create database $nombrebbdd;";
      $result = $connection->query($consulta);
      if (!$result) {
         echo "Query Error";
       var_dump($consulta);
      }
      header("Refresh:0; url=dos.php");
      ?>
      <?php endif ?>

      <script src="../js/jquery.js"></script>
      <script src="../js/bootstrap.min.js"></script>
    </body>
  </html>
