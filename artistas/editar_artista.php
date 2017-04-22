<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Artistas</title>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
  </head>
  <style>

table {

  text-align: center;
  border-collapse: collapse;

}

th {

    text-align: center;
}
  </style>
  <body>

    <?php
    session_start();

    if ($_SESSION['TIPO_USUARIO']==NULL) {
      header ("Location: ../usuarios/index.html");
    }

    include '../usuarios/conexion.php';

    if ($resultado = $connection->query('SELECT ID_ARTISTA, NOMBRE, GENERO, DESCRIPCION, URL FROM artista;')) {

    ?>
    <div class="col-md-offset-5 col-md-5">
        <h2>ARTISTAS</h2>
    </div>
    <br>
    <div class="col-md-offset-8 col-md-4">
    <a class="btn btn-primary" href="crear_artista.php" role="button">Crear Artista</a>
    <a class="btn btn-primary" href="../usuarios/control_panel.php" role="button">Panel de Control</a>
    <a class="btn btn-primary" href="../usuarios/logout.php" role="button">Cerrar Sesión</a>
    <br><br>
    </div>

    <div class="container">
    <div class="col-md-offset-1 col-md-10">
    <div class="table-responsive">
    <table class="table table-hover">

      <thead>
        <tr class="warning">
          <th>ID Artista</th>
          <th>Nombre</th>
          <th>Genero</th>
          <th>Descripción</th>
          <th>Enlace</th>
          <th>actualizar</th>
          <th>Borrar</th>
        </thead>
        <?php



          //Hacemos un fetch y búble mediante while para recorrer el array.
          while ($objeto = $resultado->fetch_object()) {
              //Cada fila que encuentre imprimirá una fila con esta serie de celdas.
              echo '<tr>';
              echo '<td>'.$objeto->ID_ARTISTA.'</td>';
              echo '<td>'.$objeto->NOMBRE.'</td>';
              echo '<td>'.$objeto->GENERO.'</td>';
              echo '<td>'.substr($objeto->DESCRIPCION,0,100).'</td>';
              // echo '<td>'.$objeto->URL.'</td>';
              echo "<td><a href='$objeto->URL'>
              <img width='40' height='40' src='../img/img_edicion/nueva_ventana.png' alt='enlace'/></a></td>";

              /*Insertamos los iconos con su hipervínculo el cual nos redigirirá hacia la página
              que le hemos indicado en el href.*/

              echo '<td><a title="actualizar" href="actualizar_artista.php?id='.$objeto->ID_ARTISTA.'">
              <img width="40" height="40" src="../img/img_edicion/actualizar.jpg" alt="actualiza"/></a></td>';

              echo '<td><a title="borrar" href="borrar_artista.php?id='.$objeto->ID_ARTISTA.'">
              <img width="40" height="40" src="../img/img_edicion/borrar.jpg" alt="borra"/></a></td>';


              echo '</tr>';
          }

          //Cerramos el array.
          $resultado->close();
          unset($objeto);
          unset($connection);
      }

 ?>
  </table>

      </div>
    </div>
  </div>

  <br>

    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.min.js"></script>
  </body>
</html>
