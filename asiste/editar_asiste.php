<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Asistencia de Artistas</title>
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

    if ($resultado = $connection->query('SELECT artista.NOMBRE, asiste.ID_ARTISTA, eventos.NOMBRE as NOMEVENTO, asiste.ID_EVENTO, eventos.TIPO, eventos.FECHA_INICIO, eventos.FECHA_FIN, lugar.LOCALIDAD
                                          FROM artista join asiste on artista.ID_ARTISTA = asiste.ID_ARTISTA
                                          join eventos on asiste.ID_EVENTO = eventos.ID_EVENTO
                                          join lugar on eventos.ID_LUGAR = lugar.ID_LUGAR;')) {

    ?>

    <div class="col-md-offset-5 col-md-5">
        <h2>Asistencia</h2>
    </div>
    <br>
    <div class="col-md-offset-8 col-md-4">
      <a class="btn btn-primary" href="crear_asistencia.php" role="button">Crear Asistencia</a>
      <a class="btn btn-primary" href="../usuarios/control_panel.php" role="button">Panel de Control</a>
      <a class="btn btn-primary" href="../usuarios/logout.php" role="button">Cerrar Sesión</a>
    </div>

    <div class="container">
    <div class="col-md-12">
      <br>
    <div class="table-responsive">
    <table class="table table-hover">
<thead>
  <tr class="warning">
    <th>Nombre Artista</th>
    <th>ID Artista</th>
    <th>Nombre Evento</th>
    <th>ID Evento</th>
    <th>Tipo</th>
    <th>Fecha Inicio</th>
    <th>Fecha Fin</th>
    <th>Localidad</th>
    <th>Actualizar</th>
    <th>Borrar</th>
</thead>
<?php



          //Hacemos un fetch y búble mediante while para recorrer el array.
          while ($objeto = $resultado->fetch_object()) {
              //Cada fila que encuentre imprimirá una fila con esta serie de celdas.
              echo '<tr>';
              echo '<td>'.$objeto->NOMBRE.'</td>';
              echo '<td>'.$objeto->ID_ARTISTA.'</td>';
              echo '<td>'.$objeto->NOMEVENTO.'</td>';
              echo '<td>'.$objeto->ID_EVENTO.'</td>';
              echo '<td>'.$objeto->TIPO.'</td>';
              echo '<td>'.$objeto->FECHA_INICIO.'</td>';
              echo '<td>'.$objeto->FECHA_FIN.'</td>';
              echo '<td>'.$objeto->LOCALIDAD.'</td>';

              /*Insertamos los iconos con su hipervínculo el cual nos redigirirá hacia la página
              que le hemos indicado en el href.*/

              echo '<td><a title="actualizar" href="actualizar_asistencia.php?id='.$objeto->ID_EVENTO.'&id2='.$objeto->ID_ARTISTA.'">
              <img width="40" height="40" src="../img/img_edicion/actualizar.jpg" alt="actualizar"/></a></td>';

              echo '<td><a title="borrar" href="borrar_asistencia.php?id='.$objeto->ID_EVENTO.'&id2='.$objeto->ID_ARTISTA.'">
              <img width="40" height="40" src="../img/img_edicion/borrar.jpg" alt="borrar"/></a></td>';


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
