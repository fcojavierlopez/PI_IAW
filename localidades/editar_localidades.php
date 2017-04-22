<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Localidades</title>
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

    if ($resultado = $connection->query('SELECT ID_LUGAR, LOCALIDAD, PROVINCIA, PAIS, LATITUD, LONGITUD FROM lugar;')) {

    ?>
    <div class="col-md-offset-5 col-md-5">
        <h2>Localidades</h2>
    </div>
    <br>
    <div class="col-md-offset-7 col-md-6">
      <a class="btn btn-primary" href="nueva_localidad.php" role="button">Añadir Nueva Localidad</a>
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
          <th>ID Localidad</th>
          <th>Localidad</th>
          <th>Provincia</th>
          <th>País</th>
          <th>Latitud</th>
          <th>Longitud</th>
          <th>actualizar</th>
          <th>Borrar</th>
        </thead>
    <?php



          //Hacemos un fetch y búble mediante while para recorrer el array.
          while ($objeto = $resultado->fetch_object()) {
              //Cada fila que encuentre imprimirá una fila con esta serie de celdas.
              echo '<tr>';
              echo '<td>'.$objeto->ID_LUGAR.'</td>';
              echo '<td>'.$objeto->LOCALIDAD.'</td>';
              echo '<td>'.$objeto->PROVINCIA.'</td>';
              echo '<td>'.$objeto->PAIS.'</td>';
              echo '<td>'.$objeto->LATITUD.'</td>';
              echo '<td>'.$objeto->LONGITUD.'</td>';

              /*Insertamos los iconos con su hipervínculo el cual nos redigirirá hacia la página
              que le hemos indicado en el href.*/

              echo '<td><a title="actualizar" href="actualizar_localidad.php?id='.$objeto->ID_LUGAR.'">
              <img width="40" height="40" src="../img/img_edicion/actualizar.jpg" alt="actualiza"/></a></td>';

              echo '<td><a title="borrar" href="borrar_localidad.php?id='.$objeto->ID_LUGAR.'">
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


  <script src="../js/jquery.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  </body>
</html>
