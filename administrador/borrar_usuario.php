<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Eliminar Usuario</title>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">

  </head>
  <body>
    <?php
      session_start();

      if ($_SESSION['TIPO_USUARIO']==NULL) {
        header ("Location: ../usuarios/index.html");
      }

      include '../usuarios/conexion.php';

      $id=$_GET["id"];

      // var_dump($id);

      $query="DELETE FROM usuarios WHERE CORREO_ELECTRONICO = '$id'";
      $resultado = $connection->query($query);

      if (!$resultado) {
    echo "Consulta Errónea";
    } else {
    echo "<div class='col-md-offset-5'>";
    echo "<br>";
    echo "<h3>Usuario Eliminado<h3>";
    echo '<META HTTP-EQUIV="Refresh" CONTENT="3; URL=editar_usuario.php">';
    echo "</div>";

    }

    ?>

    <!-- <form action='editar_usuario.php' method="post"> -->
    <!-- <input type='submit' value='Volver a Edición' /> -->
    <!-- </form> -->

    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.min.js"></script>
  </body>
</html>
