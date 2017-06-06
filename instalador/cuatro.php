<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <title>INSTALADOR</title>
  </head>
  <body>
    <div class="container">
    <header class="jumbotron">
      <h3 class="text-center">INSTALADOR WEB-PASO 3</h3>
    </header>
    </div>

<?php

  include '../usuarios/conexion.php';

 ?>


    <?php if (!isset($_POST["example"])) : ?>
        <form class="checkclass" name="examples" id="examples" novalidate method="post">
        <div class="checkbox">
        <center><label><input type="checkbox" name="example">Ejemplo de Musical</label></center>
        <br>
         <center><input type="submit" value="Enviar"></center>
        </div>
        </form>
      <?php else :?>
          <?php

          $query2="INSERT INTO `lugar` (`ID_LUGAR`, `LOCALIDAD`, `PROVINCIA`, `PAIS`, `LATITUD`, `LONGITUD`)
          VALUES ('1', 'Madrid', 'Madrid', 'España', NULL, NULL);";

          $result= $connection->query($query2);


          $query="INSERT INTO `eventos`(`ID_EVENTO`, `NOMBRE`, `TIPO`, `PRECIO`, `URL`, `FECHA_INICIO`, `FECHA_FIN`, `ID_LUGAR`)
           VALUES (1,'Ejemplo','musical',20,'ejemplo.es','2017-06-20','2017-06-20',1)";

          $result= $connection->query($query);
          if (!$result) {
               echo "Query Error";
             var_dump($query);
          } else {
            header("Refresh:0; url=../usuarios/home.php");
        }
          ?>
  <?php endif ?>


    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.min.js"></script>
  </body>
</html>
