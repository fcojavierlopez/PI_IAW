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

      <h3 class="text-center">INSTALADOR WEB-PASO 2</h3>

    </header>

    </div>

    <?php
    include '../usuarios/conexion.php';

    if (!isset($_POST["email"])) : ?>

    <div class="form-group">
    <div class="col-sm-offset-5 col-sm-10">

      <form method="post">
        <fieldset>

          <br>

          <div class="forceColor"></div>
          <div class="topbar">
            <div class="spanColor"></div>

          <label>Correo Electrónico Administrador</label><br>
          <input name="email" type="text" class="input" id="email" placeholder="email" required>
          <br>

          <label>Contraseña</label><br>
          <input name="password" type="password" class="input" id="password" placeholder="Password" required>
          <br><br>

          <button type="submit" class="btn btn-primary">SIGUIENTE</button>

        </fieldset>
      </form>
    </div>
    </div>
    <?php else: ?>

      <?php
      $email=$_POST["email"];
      $passwd=$_POST["password"];
      $query = "SELECT * FROM usuarios WHERE CORREO_ELECTRONICO = '$email' and PASSWD = md5('$passwd')";
      $result = $connection->query($query);
      if ($result->num_rows==0) {
        $query1="INSERT INTO usuarios (`CORREO_ELECTRONICO`,`PASSWD`,`FECHA_ALTA`,`EDAD`,`APELLIDOS`,`NOMBRE`,`TIPO_USUARIO`)
        VALUES('$email',md5('$passwd'),sysdate(),20,'administrador','administrador','1')";
        $result = $connection->query($query1);

        if (!$result) {
        echo "error";
     } else {
       //echo "Registro completado";
       header("Refresh:0; url=cuatro.php");
     }
      }else {
       //echo "Ya estás registrado";
       header("Refresh:0; url=cuatro.php");
     }
     ?>
      <?php endif ?>


      <script src="../js/jquery.js"></script>
      <script src="../js/bootstrap.min.js"></script>

  </body>
</html>
