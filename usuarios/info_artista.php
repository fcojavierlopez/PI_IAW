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
    echo "<br><br><br>";

      $id=$_GET['id'];

      $query="SELECT artista.NOMBRE, artista.DESCRIPCION, artista.IMAGEN, eventos.PRECIO, artista.ID_ARTISTA, eventos.FECHA_INICIO FROM artista join asiste on artista.ID_ARTISTA = asiste.ID_ARTISTA join eventos on asiste.ID_EVENTO = eventos.ID_EVENTO
      where artista.NOMBRE='$id' and eventos.NOMBRE='$id'";

      $query2="SELECT artista.NOMBRE, eventos.PRECIO, eventos.FECHA_INICIO, lugar.LOCALIDAD, artista.ID_ARTISTA, artista.URL FROM artista join asiste on artista.ID_ARTISTA = asiste.ID_ARTISTA join eventos on asiste.ID_EVENTO = eventos.ID_EVENTO join lugar on eventos.ID_LUGAR = lugar.ID_LUGAR
      where artista.NOMBRE='$id' and eventos.NOMBRE='$id'";

      if ($resultado = $connection->query($query)){
        $objeto = $resultado->fetch_object();


      echo "<div id='imagen'>";
      echo "<center><img src='../img/img_artistas/$objeto->IMAGEN' /><br>";
      echo "<h3>".$objeto->NOMBRE."</h3>";
      echo "</div>";
      echo "<div id='desc'>";
      echo "<p class='lead'>".$objeto->DESCRIPCION."</p></center>";
      echo "</div>";



?>
<div class="col-md-offset-4 col-md-7">
<div class="table-responsive">
<table class="table table-hover">
<thead>
  <tr class="warning">
    <th>Nombre</th>
    <th>Ciudad</th>
    <th>Fecha</th>
    <th>Precio</th>
    <th>WEB</th>
    <th>Comprar</th>
  </tr>
</thead>

<?php
if ($result = $connection->query($query2)){
  while ($objeto = $result->fetch_object()) {
      //Cada fila que encuentre imprimirá una fila con esta serie de celdas.
      echo '<tr>';
      echo '<td>'.$objeto->NOMBRE.'</td>';
      echo '<td>'.$objeto->LOCALIDAD.'</td>';
      echo '<td>'.$objeto->FECHA_INICIO.'</td>';
      echo '<td>'.$objeto->PRECIO.' €</td>';
      echo "<td><a href='$objeto->URL'><img width='40' height='40' src='../img/img_edicion/nueva_ventana.png' alt='enlace'/></a></td>";
      echo '<td><a class="btn btn-success" title="comprar" href="compra.php?id='.$objeto->ID_ARTISTA.'">Comprar</a></td>';
?>

<?php
      echo "</tr>";
  }
}
}
    echo "</table>";

        //Cerramos el array.
        $resultado->close();
        unset($objeto);
        unset($connection);

     ?>

</div>
</div>

     <script src="../js/jquery.js"></script>
     <script src="../js/bootstrap.min.js"></script>
  </body>
</html>
