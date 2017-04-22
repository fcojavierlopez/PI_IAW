<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Nuevo Usuario</title>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
  </head>
  <body>
    <?php
      session_start();

      if ($_SESSION['TIPO_USUARIO']==NULL) {
        header ("Location: ../usuarios/index.html");
      }

      if (!isset($_POST["email"])) : ?>

      <br>
      <div class="container">
      <div class="col-md-offset-4 col-md-4">
        <form method="post">
          <fieldset>
            <legend>Nuevo Usuario</legend>
            <span>Correo Electrónico </span><input class="form-control" type="email" name="email" required><br>
            <span>Passwd </span><input class="form-control" type="password" name="password" ><br>
            <span>Repetir Passwd </span><input class="form-control" type="password" name="password2" ><br>
            <span>Edad </span><input class="form-control" type="text" name="edad" required><br>
            <span>Apellidos </span><input class="form-control" type="text" name="apellidos" required><br>
            <span>Nombre </span><input class="form-control" type="text" name="nombre" required><br>
              <div class="col-md-offset-2 col-md-8">
              <span>Tipo Usuario </span>
              <select id="tipo" name="tipo" class = "tipo" required>
                <option value="0">Usuario</option>
                <option value="1">Administrador</option>
              </select>
              </div>
              <br><br><br>

            <div class="col-md-offset-3 col-md-8">
	          <input class="btn btn-primary" type="submit" value="Crear" name="send">
            <a class="btn btn-primary" href="editar_usuario.php" role="button">Cancelar</a>
            </div>

	         </fieldset>
         </form>
            </div>
          </div>
         <?php else: ?>

         <?php

           include '../usuarios/conexion.php';

          ?>
          
          <?php

          if (isset($_POST['send'])) {
            $email=$_POST['email'];
            $passwd=$_POST['password'];
            $passwd2=$_POST['password2'];
            $edad=$_POST['edad'];
            $apellidos=$_POST['apellidos'];
            $nombre=$_POST['nombre'];
            $tipo=$_POST['tipo'];

            if ($passwd==$passwd2) {
              $query= "INSERT INTO usuarios (`CORREO_ELECTRONICO`,`PASSWD`,`FECHA_ALTA`,`EDAD`,`APELLIDOS`,`NOMBRE`,`TIPO_USUARIO`)
              VALUES('$email',md5('".$_POST['password']."'),sysdate(),$edad,'".$_POST['apellidos']."','".$_POST['nombre']."',$tipo)";

              $result = $connection->query($query);

              if ($result) {
                echo "<br>";
                echo "<h3 class='text-center'>Nuevo Usuario Creado</h3>";
                echo '<br>';
                echo '<META HTTP-EQUIV="Refresh" CONTENT="2; URL=editar_usuario.php">';
              }

            }  else {
              echo "Error. Contraseñas diferentes, intentar de nuevo.";
              echo '<br>';
              echo '<META HTTP-EQUIV="Refresh" CONTENT="2; URL=crear_usuario.php">';
            }

          }
           ?>

          <?php endif ?>


  <script src="../js/jquery.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  </body>

</html>
