<!DOCTYPE html>
<html lang="">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
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

            /*Consulta a la base de datos. Nos devuelve una serie de datos que será
            guardada en $resultado para más tarde ser recorrido.*/
            if ($resultado = $connection->query('SELECT CORREO_ELECTRONICO, FECHA_ALTA, EDAD, APELLIDOS, NOMBRE, TIPO_USUARIO FROM usuarios;')) {
      ?>

      <div class="col-md-offset-5 col-md-5">
          <h2>USUARIOS</h2>
      </div>
      <br>
      <div class="col-md-offset-8 col-md-4">
        <a class="btn btn-primary" href="crear_usuario.php" role="button">Crear Usuarios</a>
        <a class="btn btn-primary" href="../usuarios/control_panel.php" role="button">Panel de Control</a>
        <a class="btn btn-primary" href="../usuarios/logout.php" role="button">Cerrar Sesión</a>
        <br><br>
      </div>
      <div class="container">
      <div class="col-md-offset-1 col-md-10">
      <div class="table-responsive">

      <!--Creamos la tabla y la de la fila principal cuyos datos son fijos (títulos de las
      celdas)-->
      <table class="table table-hover">
      <thead>
        <tr class="warning">
          <th>Correo Electrónico</th>
          <th>Fecha de Alta</th>
          <th>Edad</th>
          <th>Apellidos</th>
          <th>Nombre</th>
          <th>Tipo de Usuario</th>
          <th>Actualizar Usuario</th>
          <th>Borrar Usuario</th>
      </thead>

      <?php

                //Hacemos un fetch y búble mediante while para recorrer el array.
                while ($objeto = $resultado->fetch_object()) {
                    //Cada fila que encuentre imprimirá una fila con esta serie de celdas.
                    echo '<tr>';
                    echo '<td>'.$objeto->CORREO_ELECTRONICO.'</td>';
                    echo '<td>'.$objeto->FECHA_ALTA.'</td>';
                    echo '<td>'.$objeto->EDAD.'</td>';
                    echo '<td>'.$objeto->APELLIDOS.'</td>';
                    echo '<td>'.$objeto->NOMBRE.'</td>';
                    echo '<td>'.$objeto->TIPO_USUARIO.'</td>';

                    /*Insertamos los iconos con su hipervínculo el cual nos redigirirá hacia la página
                    que le hemos indicado en el href.*/

                    echo '<td><a title="actualizar" href="actualizar_usuario.php?id='.$objeto->CORREO_ELECTRONICO.'">
                    <img width="40" height="40" src="../img/img_edicion/actualizar.jpg" alt="actualizar"/></a></td>';

                    echo '<td><a title="borrar" href="borrar_usuario.php?id='.$objeto->CORREO_ELECTRONICO.'">
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
    <br>


    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    </body>
</html>
