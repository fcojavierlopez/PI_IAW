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

      $query="SELECT eventos.NOMBRE, eventos.FECHA_INICIO, eventos.FECHA_FIN, lugar.LOCALIDAD, eventos.PRECIO, eventos.ID_EVENTO FROM eventos join lugar on eventos.ID_LUGAR = lugar.ID_LUGAR WHERE eventos.NOMBRE='$id'";



      if ($resultado = $connection->query($query)){
        $objeto = $resultado->fetch_object();


      echo "<div id='nombre'>";
      echo "<h3>".$objeto->NOMBRE."</h3>";
      echo "</div>";

      echo "<div id='fecha'>";
      echo "<h4>Fecha Inicio del Festival: ".$objeto->FECHA_INICIO."</center></h4>";
      echo "<h4>Fecha Fin del Festival: ".$objeto->FECHA_FIN."</center></h4>";
      echo "</div>";
      echo "<div id='localidad'>";
      echo "<h4>Localidad: ".$objeto->LOCALIDAD."</h4>";
      echo "</div>";
      echo "<div id='precio'>";
      echo "<h4>Precio: ".$objeto->PRECIO." €</h4>";
      echo "</div>";
      echo "<div id='comprafestival'>";
      echo '<td><a class="btn btn-success" title="comprar" href="compra.php?id='.$objeto->ID_EVENTO.'">Comprar</a></td>';
      echo "</div>";
      echo "<div id='titulofestival'>";
      echo "<h3>Artistas asistentes en el Evento</h3>";
      echo "</div>";



    }
    ?>

    <div id='tablafestival' class="col-md-offset-6 col-md-6 text-center">
      <div class="table-responsive">
        <table class="table table-hover">
          <thead>
            <tr class="success">
              <th class="text-center">Nombre</th>
              <th class="text-center">WEB</th>
            </tr>
          </thead>

  <?php

  $query2="SELECT artista.NOMBRE, artista.URL from artista join asiste on artista.ID_ARTISTA = asiste.ID_ARTISTA join eventos on asiste.ID_EVENTO = eventos.ID_EVENTO WHERE eventos.TIPO = 'festival' and eventos.NOMBRE='$id'";

  if ($result = $connection->query($query2)){
  while ($objeto = $result->fetch_object()) {
      //Cada fila que encuentre imprimirá una fila con esta serie de celdas.
      echo '<tr>';
      echo '<td>'.$objeto->NOMBRE.'</td>';
      echo "<td><a href='$objeto->URL'><img width='40' height='40' src='../img/img_edicion/nueva_ventana.png' alt='enlace'/></a></td>";
      echo "</tr>";

      }
    }
    echo "</table>";
    echo "</div>";
    echo "</div>";



        //Cerramos el array.
        $resultado->close();
        unset($objeto);
        unset($connection);

     ?>


     <script src="../js/jquery.js"></script>
     <script src="../js/bootstrap.min.js"></script>
  </body>
</html>
