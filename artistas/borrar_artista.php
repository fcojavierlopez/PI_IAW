<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Eliminar Artista</title>
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

      $query="DELETE FROM artista WHERE ID_ARTISTA = '$id'";
      $resultado = $connection->query($query);

      if (!$resultado) {

    echo "<br>";
    echo "<h3 class='text-center'>Consulta Errónea</h3>";
    echo '<META HTTP-EQUIV="Refresh" CONTENT="5; URL=editar_artista.php">';
    } else {

    echo "<br>";
    echo "<h3 class='text-center'>Artista Eliminado</h3>";
    echo '<META HTTP-EQUIV="Refresh" CONTENT="3; URL=editar_artista.php">';
    }

    ?>


    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</body>
</html>
