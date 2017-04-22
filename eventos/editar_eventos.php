<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Eventos</title>
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

    if ($resultado = $connection->query('SELECT ID_EVENTO, NOMBRE, TIPO, PRECIO, URL, FECHA_INICIO, FECHA_FIN, lugar.LOCALIDAD
                                          FROM eventos join lugar on eventos.ID_LUGAR=lugar.ID_LUGAR;')) {

    ?>
    <div class="col-md-offset-5 col-md-5">
        <h2>Eventos</h2>
    </div>
    <br>
    <div class="col-md-offset-8 col-md-4">
      <a class="btn btn-primary" href="crear_evento.php" role="button">Crear Evento</a>
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
                  <th>ID Evento</th>
                  <th>Nombre</th>
                  <th>Tipo</th>
                  <th>Precio</th>
                  <th>URL</th>
                  <th>Fecha Inicio</th>
                  <th>Fecha Fin</th>
                  <th>Localidad</th>
                  <th>Actualizar</th>
                  <th>Borrar</th>
                </thead>
                <tbody>
                  <?php

                            //Hacemos un fetch y búble mediante while para recorrer el array.
                            while ($objeto = $resultado->fetch_object()) {
                                //Cada fila que encuentre imprimirá una fila con esta serie de celdas.
                                echo '<tr>';
                                echo '<td>'.$objeto->ID_EVENTO.'</td>';
                                echo '<td>'.$objeto->NOMBRE.'</td>';
                                echo '<td>'.$objeto->TIPO.'</td>';
                                echo '<td>'.$objeto->PRECIO.'</td>';
                                echo "<td><a href='$objeto->URL'><img width='40' height='40' src='../img/img_edicion/compra1.jpg' alt='comprar'/></a></td>";
                                echo '<td>'.$objeto->FECHA_INICIO.'</td>';
                                echo '<td>'.$objeto->FECHA_FIN.'</td>';
                                echo '<td>'.$objeto->LOCALIDAD.'</td>';

                                /*Insertamos los iconos con su hipervínculo el cual nos redigirirá hacia la página
                                que le hemos indicado en el href.*/

                                echo '<td><a title="actualizar" href="actualizar_evento.php?id='.$objeto->ID_EVENTO.'">
                                <img width="40" height="40" src="../img/img_edicion/actualizar.jpg" alt="actualizar"/></a></td>';

                                echo '<td><a title="borrar" href="borrar_evento.php?id='.$objeto->ID_EVENTO.'">
                                <img width="40" height="40" src="../img/img_edicion/borrar.jpg" alt="borrar"/></a></td>';


                                echo '</tr>';
                            }

                            //Cerramos el array.
                            $resultado->close();
                            unset($objeto);
                            unset($connection);
                        }

                   ?>
                </tbody>
        </table>
        </div>
      </div>
    </div>
<br>

<script src="../js/jquery.js"></script>
<script src="../js/bootstrap.min.js"></script>
</body>
</html>
