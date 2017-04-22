<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Mi Perfil</title>
  </head>

  <style>

table {

  text-align: center;
  border-collapse: collapse;

}

th {
  text-align: center;
}

h3 {
  text-align: center;
}

.evita_menu {
  margin-top: 50px;
  padding: 50px;
}
  </style>

  <body>

    <?php
    session_start();

    if ($_SESSION['TIPO_USUARIO']==NULL) {
      header ("Location: index.html");
    }

    include 'conexion.php';

    include 'barra_menu_perfil.php';

    $id=$_SESSION['CORREO_ELECTRONICO'];

    $query2 = "SELECT COUNT(compra.ID_EVENTO) as Num_Compras, SUM(compra.NUMERO_ENTRADAS) as Total_Entradas_Compradas
              FROM usuarios JOIN compra ON usuarios.CORREO_ELECTRONICO = compra.CORREO_ELECTRONICO JOIN eventos ON compra.ID_EVENTO = eventos.ID_EVENTO
              WHERE usuarios.CORREO_ELECTRONICO = '$id'
              GROUP BY usuarios.CORREO_ELECTRONICO";

    /*Consulta a la base de datos. Nos devuelve una serie de datos que será
    guardada en $resultado para más tarde ser recorrido.*/
    if ($resultado = $connection->query("SELECT CORREO_ELECTRONICO, FECHA_ALTA, EDAD, APELLIDOS, NOMBRE FROM usuarios where CORREO_ELECTRONICO = '$id';")) {
  ?>

  <div class="row evita_menu">
  <div class="col-md-offset-1 col-md-4">

    <h3>Datos de <?php echo $_SESSION['NOMBRE'] ?></h3>

  <?php

      echo "<br>";

                  echo "<ul>";

              //Hacemos un fetch y búble mediante while para recorrer el array.
              while ($objeto = $resultado->fetch_object()) {
                  //Cada fila que encuentre imprimirá una fila con esta serie de celdas.

                  echo '<li><b>Email:</b> '.$objeto->CORREO_ELECTRONICO.'</li><br>';
                  echo '<li><b>Fecha de Alta:</b> '.$objeto->FECHA_ALTA.'</li><br>';
                  echo '<li><b>Edad:</b> '.$objeto->EDAD.'</li><br>';
                  echo '<li><b>Nombre:</b> '.$objeto->NOMBRE.'</li><br>';
                  echo '<li><b>Apellidos:</b> '.$objeto->APELLIDOS.'</li><br>';


                  /*Insertamos los iconos con su hipervínculo el cual nos redigirirá hacia la página
                  que le hemos indicado en el href.*/
                  // echo "<br><br>";
                  echo '<td><a class="btn btn-primary" title="actualizar" href="actualizar_perfil_usuario.php?id='.$objeto->CORREO_ELECTRONICO.'">actualizar Perfil</a></td>';

              }

              //Cerramos el array.
              $resultado->close();
              unset($objeto);
              unset($connection);
          }

     ?>

   </ul>
</div>

  <div class=" col-md-5">
   <table class="table table-bordered">
     <h3>Historial de Compras y Asistencias</h3><br>
   <thead>
     <tr class="success">
       <th>Compras y Asistencias</th>
       <th>Total Entradas Compradas</th>

   </thead>

   <?php

    if ($resultado2=$connection2->query($query2)) {



             //Hacemos un fetch y búble mediante while para recorrer el array.
             while ($objeto2 = $resultado2->fetch_object()) {
                 //Cada fila que encuentre imprimirá una fila con esta serie de celdas.
                 echo '<tr>';
                 echo '<td>'.$objeto2->Num_Compras.'</td>';
                 echo '<td>'.$objeto2->Total_Entradas_Compradas.'</td>';

                 echo "</tr>";
    }

                //Cerramos el array.
                $resultado2->close();
                unset($objeto2);
                unset($connection2);


  }

  ?>
    </table>
  </div>
</div>
  <br>

   <script src="../js/jquery.js"></script>
   <script src="../js/bootstrap.min.js"></script>
</body>
</html>
