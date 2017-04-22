<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Compras</title>
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

    if ($resultado = $connection->query('SELECT usuarios.NOMBRE, usuarios.APELLIDOS, compra.CORREO_ELECTRONICO, eventos.NOMBRE as NEVENTO, compra.ID_EVENTO, lugar.LOCALIDAD, compra.NUMERO_ENTRADAS
                                          FROM usuarios join compra on usuarios.CORREO_ELECTRONICO=compra.CORREO_ELECTRONICO join eventos on compra.ID_EVENTO = eventos.ID_EVENTO join lugar
                                          on eventos.ID_LUGAR = lugar.ID_LUGAR;')) {

    ?>

    <div class="col-md-offset-5 col-md-5">
        <h2>Compras</h2>
    </div>
    <br>
    <div class="col-md-offset-8 col-md-4">
      <a class="btn btn-primary" href="../usuarios/control_panel.php" role="button">Panel de Control</a>
      <a class="btn btn-primary" href="../usuarios/logout.php" role="button">Cerrar Sesión</a>
    </div>

    <div class="container">
    <div class="col-md-offset-1 col-md-10">
      <br>
    <div class="table-responsive">
    <table class="table table-hover">
      <thead>
        <tr class="warning">
          <th>Nombre Usuario</th>
          <th>Apellidos Usuario</th>
          <th>Email</th>
          <th>Nombre Evento</th>
          <th>ID Evento</th>
          <th>Localidad</th>
          <th>Número de Entradas</th>
          <th>Actualizar</th>
          <th>Borrar</th>
        </thead>
    <?php



          //Hacemos un fetch y búble mediante while para recorrer el array.
          while ($objeto = $resultado->fetch_object()) {
              //Cada fila que encuentre imprimirá una fila con esta serie de celdas.
              echo '<tr>';
              echo '<td>'.$objeto->NOMBRE.'</td>';
              echo '<td>'.$objeto->APELLIDOS.'</td>';
              echo '<td>'.$objeto->CORREO_ELECTRONICO.'</td>';
              echo '<td>'.$objeto->NEVENTO.'</td>';
              echo '<td>'.$objeto->ID_EVENTO.'</td>';
              echo '<td>'.$objeto->LOCALIDAD.'</td>';
              echo '<td>'.$objeto->NUMERO_ENTRADAS.'</td>';

              /*Insertamos los iconos con su hipervínculo el cual nos redigirirá hacia la página
              que le hemos indicado en el href.*/

              echo '<td><a title="actualizar" href="actualizar_compra.php?id='.$objeto->CORREO_ELECTRONICO.'&id2='.$objeto->ID_EVENTO.'">
              <img width="40" height="40" src="../img/img_edicion/actualizar.jpg" alt="actualizar"/></a></td>';

              echo '<td><a title="borrar" href="borrar_compra.php?id='.$objeto->CORREO_ELECTRONICO.'&id2='.$objeto->ID_EVENTO.'">
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
