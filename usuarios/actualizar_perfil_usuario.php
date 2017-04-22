<!DOCTYPE html>
<html lang="">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Perfil</title>
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

        include 'conexion.php';

        include 'barra_menu_perfil.php';

      if ($result = $connection->query("SELECT * from usuarios
        where CORREO_ELECTRONICO = '$id';")) {

        $obj = $result->fetch_object();

        echo "<br><br><br>";


        echo "<div class='container-fluid'>";
          echo "<div class='col-md-offset-4 col-md-3'>";

        echo "<form method='post'>";

        echo "<legend class='text-center'>Nuevo Perfil</legend>";
        echo "Email <input class='form-control' name='email' value='$obj->CORREO_ELECTRONICO' required \><br><br>";
        echo "Edad <input class='form-control' name='edad' type='text' value='$obj->EDAD' required\><br><br>";
        echo "Apellidos <input class='form-control' name='apellidos' value='$obj->APELLIDOS' required \><br><br>";
        echo "Nombre <input class='form-control' name='nombre' value='$obj->NOMBRE' required \><br><br>";

        ?>

        <div class="col-md-offset-2 col-md-10">
        <input class="btn btn-primary" type='submit' name='send' value='Actualizar'>
        <a class="btn btn-primary" href="perfil_usuario.php" role="button">Cancelar</a>
        </div>

      </form>

      <?php
      } else {

            echo "Error: ".$result."<br>".mysqli_error($connection);
      }

      unset($obj);

      if (isset($_POST['send'])) {

        //variables
        $email=$_POST['email'];
        $edad=$_POST['edad'];
        $apellidos=$_POST['apellidos'];
        $nombre=$_POST['nombre'];

      $query="UPDATE `usuarios` SET  `CORREO_ELECTRONICO` = '$email', `EDAD` = '$edad', `APELLIDOS`= '$apellidos', `NOMBRE`= '$nombre'
      WHERE `usuarios`.`CORREO_ELECTRONICO` = '$id'";

        if ($result = $connection->query($query))
           {
             header ("Location: ../usuarios/perfil_usuario.php");
             var_dump($query);
        } else {

              echo "Error: ".$result."<br>".mysqli_error($connection);
        }
      }
      unset($connection);
      ?>

      </div>
    </div>


      <script src="../js/jquery.js"></script>
      <script src="../js/bootstrap.min.js"></script>
    </body>
</html>
