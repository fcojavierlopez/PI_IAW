<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Concierto</title>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/info.css">
  </head>
  <body>

    <?php
    session_start();

    if ($_SESSION['TIPO_USUARIO']==NULL) {
      header ("Location: ../usuarios/index.html");
    }

    include 'conexion.php';

    include 'barra_menu.php';
    echo "</div>";
    echo "<br><br><br>";

      $id=$_GET['id'];
    echo "<h3 class='text-center'>$id</h3>";
      ?>



      <div id='tablamusical' class="col-md-offset-6 col-md-7 text-center">
        <div class="table-responsive">
          <table class="table table-hover">
            <thead>
              <tr class="success">
                <th class="text-center">Nombre</th>
                <th class="text-center">Fecha Inicio</th>
                <th class="text-center">Fecha Fin</th>
                <th class="text-center">Ciudad</th>
                <th class="text-center">Precio</th>
                <th class="text-center">Comprar</th>
              </tr>
            </thead>

    <?php
      $query="SELECT eventos.NOMBRE, eventos.FECHA_INICIO, eventos.FECHA_FIN, lugar.LOCALIDAD, eventos.PRECIO, eventos.URL, eventos.ID_EVENTO FROM eventos join lugar on eventos.ID_LUGAR = lugar.ID_LUGAR WHERE eventos.NOMBRE='$id'";

      if ($result = $connection->query($query)){
      while ($objeto = $result->fetch_object()) {
          //Cada fila que encuentre imprimirá una fila con esta serie de celdas.
          echo '<tr>';
          echo '<td>'.$objeto->NOMBRE.'</td>';
          echo '<td>'.$objeto->FECHA_INICIO.'</td>';
          echo '<td>'.$objeto->FECHA_FIN.'</td>';
          echo '<td>'.$objeto->LOCALIDAD.'</td>';
          echo '<td>'.$objeto->PRECIO.' €</td>';
          echo '<td><a class="btn btn-success" title="comprar" href="compra_musical.php?id='.$objeto->ID_EVENTO.'">Comprar</a></td>';
          echo "</tr>";

          }
        }
        echo "</table>";
        echo "</div>";
        echo "</div>";

    ?>


     <script src="../js/jquery.js"></script>
     <script src="../js/bootstrap.min.js"></script>
  </body>
</html>
