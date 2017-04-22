<!DOCTYPE html>
<html lang="">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Usuario</title>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    </head>
    <body>

      <?php

      session_start();

      if ($_SESSION['TIPO_USUARIO']==NULL) {
        header ("Location: ../usuarios/index.html");
      }

      $id = $_GET['id'];

        include '../usuarios/conexion.php';

      if ($result = $connection->query("SELECT * from usuarios
        where CORREO_ELECTRONICO = '$id';")) {

        $obj = $result->fetch_object();

        echo "<br>";

        echo "<div class='container-fluid'>";
        echo "<div class='col-md-offset-4 col-md-3'>";

        echo "<form method='post'>";

        echo "<legend>Actualizar Usuario</legend>";
        echo "Email <input name='email' class='form-control' value='$obj->CORREO_ELECTRONICO' required \><br>";
        echo "Password <input name='password' class='form-control' type='password' value'$obj->PASSWD' required\><br>";
        echo "Edad <input name='edad' class='form-control' type='text' value'$obj->EDAD' required\><br>";
        echo "Apellidos <input name='apellidos' class='form-control' value='$obj->APELLIDOS' required \><br>";
        echo "Nombre <input name='nombre' class='form-control' value='$obj->NOMBRE' required \><br>";
        echo "<div class='col-md-offset-3 col-md-8'>";
        echo "Tipo Usuario ";
        echo '<SELECT id="tipo" name="tipo" class="tipo" required>';
        echo '<option value="0">Usuario</option>';
        echo '<option value="1">Administrador</option>';
        echo "</select><br><br><br>";
        echo "</div>";

        ?>

        <div class='col-md-offset-2 col-md-10'>
        <input class='btn btn-primary' type='submit' value='Actualizar' name='send'>
        <a class="btn btn-primary" href="editar_usuario.php" role="button">Cancelar</a>
        </div>


      </form>
        <?php
      } else {

            echo "Error: " . $result . "<br>" . mysqli_error($connection);
      }

      unset($obj);

      if (isset($_POST['send'])) {

        var_dump($_POST);

        //variables
        $email=$_POST['email'];
        $passwd=$_POST['password'];
        $edad=$_POST['edad'];
        $apellidos=$_POST['apellidos'];
        $nombre=$_POST['nombre'];
        $tipo=$_POST['tipo'];

      $query="UPDATE `usuarios` SET  `CORREO_ELECTRONICO` = '$email', `PASSWD` =md5('$passwd'), `EDAD` = '$edad', `APELLIDOS`= '$apellidos', `NOMBRE`= '$nombre', `TIPO_USUARIO`= '$tipo'
      WHERE `usuarios`.`CORREO_ELECTRONICO` = '$id'";


        if ($result = $connection->query($query))
           {
             header ("Location: ./editar_usuario.php");
             var_dump($query);
        } else {

              echo "Error: " . $result . "<br>" . mysqli_error($connection);
        }
      }
      unset($connection);
      ?>

      </div>

    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    </body>
</html>
