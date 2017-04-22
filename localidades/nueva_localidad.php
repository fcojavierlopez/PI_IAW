<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Nueva Localidad</title>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
  </head>
  <body>
    <?php
      session_start();

      if ($_SESSION['TIPO_USUARIO']==NULL) {
        header ("Location: ../usuarios/index.html");
      }

      if (!isset($_POST["localidad"])) : ?>

      <div class="container">
      <div class="col-md-offset-4 col-md-4">
        <br>
        <form method="post">
          <fieldset>
            <legend>Nueva Localidad</legend>
            <span>Localidad </span><input class="form-control" type="text" name="localidad" ><br>
            <span>Provincia </span><input class="form-control" type="text" name="provincia" ><br>
            <span>País </span><input class="form-control" type="text" name="pais" ><br>
            <span>Latitud </span><input class="form-control" type="text" name="latitud"><br>
            <span>Longitud </span><input class="form-control" type="text" name="longitud"><br>

            <br>

            <div class="col-md-offset-3">
	          <input class="btn btn-primary" type="submit" value="Añadir" name="send">
            <a class="btn btn-primary" href="editar_localidades.php" role="button">Cancelar</a>
            </div>
	         </fieldset>
         <?php else: ?>

          <?php

          include '../usuarios/conexion.php';

          if (isset($_POST['send'])) {
            $localidad=$_POST['localidad'];
            $provincia=$_POST['provincia'];
            $pais=$_POST['pais'];
            $latitud=$_POST['latitud'];
            $longitud=$_POST['longitud'];



              $query= "INSERT INTO lugar(`LOCALIDAD`,`PROVINCIA`,`PAIS`,`LATITUD`,`LONGITUD`)
              VALUES('$localidad','$provincia','$pais',$latitud,$longitud)";

              $result = $connection->query($query);
              // var_dump($result);

              if ($result) {
                echo "<br>";
                echo "<h3 class='text-center'>Nueva Localidad añadida</h3>";
                echo '<META HTTP-EQUIV="Refresh" CONTENT="2; URL=editar_localidades.php">';
              }

              if (!$result) {
                echo "Error al añadir la nueva localidad, inténtelo de nuevo.";
                var_dump($query);
                echo '<br>';
                echo '<META HTTP-EQUIV="Refresh" CONTENT="3; URL=nueva_localidad.php">';
              }

            }

           ?>

         </div>
       </div>

          <?php endif ?>

    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.min.js"></script>
  </body>

</html>
