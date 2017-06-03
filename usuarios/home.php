<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Home</title>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!--Elección del tema  -->
    <link rel="stylesheet" href=<?php

    session_start();
    $nombre="conexion.php";
$instalador = "instalador";
$index="instalador/index.php";
$uno="instalador/uno.php";
$dos="instalador/dos.php";
$tres="instalador/tres.php";
$cuatro="instalador/cuatro.php";

    if(file_exists($nombre)){
include($nombre);
if(file_exists($index)){
unlink($index);
unlink($uno);
unlink($dos);
unlink($tres);
unlink($cuatro);
rmdir($instalador);
}
}else{
header("Location:../instalador/index.php");
}

    $user=$_SESSION['CORREO_ELECTRONICO'];

    $consulta="SELECT TEMA from usuarios where CORREO_ELECTRONICO='$user';";
    $result = $connection->query($consulta);
    $obj=$result->fetch_object();
    $tema=$obj->TEMA;

    if ($tema==1) {
      echo "../css/eventos.css";
    }if ($tema==2) {
      echo "../css/eventos2.css";
    }if($tema==3) {
      echo "../css/eventos3.css";
    }
    ?>
    >
    <!--FIN Elección del tema  -->

  </head>
  <body>

    <?php


    if ($_SESSION['TIPO_USUARIO']==NULL) {
      header ("Location: index.html");
    }

      include 'barra_menu.php';

    ?>

    <br><br><br>

    <p><b>Selector de Temas</b></p>

    <a href='../fonts/blanco.php?usuario=<?php echo $user; ?>'>B/</a>
    <a href='../fonts/verdep.php?usuario=<?php echo $user; ?>'>V/</a>
    <a href='../fonts/cyan.php?usuario=<?php echo $user; ?>'>C</a>

    <?php

      echo "<div id='topmusic'>";

      echo "<h3 class='text-center'>TOP MUSIC</h3>";

      echo "</div>";

      echo "<div id='carousel'>";

      include 'carousel.php';

      echo "<div>";



      $query="SELECT artista.NOMBRE, artista.IMAGEN FROM eventos join asiste ON eventos.ID_EVENTO = asiste.ID_EVENTO
                                                                 JOIN artista ON asiste.ID_ARTISTA = artista.ID_ARTISTA
                                                    where eventos.TIPO ='concierto' LIMIT 4";

    echo "<div id='conciertohome'>";

    echo "<h2 class='text-center'><a>Conciertos del momento</a></h2>";

      if ($resultado = $connection->query($query)){
          while ($objeto = $resultado->fetch_object()) {

          echo "<div class='artista'>";


          echo '<center><a href="info_artista.php?id='.$objeto->NOMBRE.'"><img class="img-responsive" src=../img/img_artistas/'.$objeto->IMAGEN.'></a>';

            echo'<h3><a href="info_artista.php?id='.$objeto->NOMBRE.'">'.$objeto->NOMBRE.'<a/></h3></center>';
          echo "</div>";
          }
        }
        echo "</div>";

        $query2="SELECT eventos.NOMBRE FROM eventos where eventos.TIPO ='festival' LIMIT 4";



      echo "<div id='festivalhome'>";

      echo "<h2 class='text-center'>Festivales del momento</h2>";

        if ($resultado2 = $connection->query($query2)){
            while ($objeto = $resultado2->fetch_object()) {

            echo "<div class='artista'><center>";

              echo'<h3><a href="info_festival.php?id='.$objeto->NOMBRE.'">'.$objeto->NOMBRE.'<a/></h3></center>';
            echo "</div>";
            }
          }
          echo "</div>";

          $query3="SELECT artista.NOMBRE, artista.IMAGEN FROM eventos join asiste ON eventos.ID_EVENTO = asiste.ID_EVENTO
                                                                     JOIN artista ON asiste.ID_ARTISTA = artista.ID_ARTISTA
                                                        where eventos.TIPO ='monologo' LIMIT 3";

          echo "<div id='monologohome'>";

          echo "<h2 class='text-center'>Monólogos recomendados</h2>";

            if ($resultado3 = $connection->query($query3)){
                while ($objeto = $resultado3->fetch_object()) {

                echo "<div class='artista'><center>";

                  echo '<center><a href="info_artista.php?id='.$objeto->NOMBRE.'"><img class="img-responsive" src=../img/img_artistas/'.$objeto->IMAGEN.'></a>';

                  echo'<h3><a href="info_artista.php?id='.$objeto->NOMBRE.'">'.$objeto->NOMBRE.'<a/></h3></center>';

                echo "</div>";
                }
              }
              echo "</div>";

              $query4="SELECT eventos.NOMBRE FROM eventos where eventos.TIPO ='musical'";

            echo "<div id='musicalhome'>";

            echo "<h2 class='text-center'>Musicales recomendados</h2>";

              if ($resultado4 = $connection->query($query4)){
                  while ($objeto = $resultado4->fetch_object()) {

                  echo "<div class='artista'><center>";

                    echo'<h3><a href="info_musical.php?id='.$objeto->NOMBRE.'">'.$objeto->NOMBRE.'<a/></h3></center>';
                  echo "</div>";
                  }
                }
                echo "</div>";

          // dashboard

          include 'dashboard.php';

     ?>

     <script src="../js/jquery.js"></script>
     <script src="../js/bootstrap.min.js"></script>
  </body>
</html>
