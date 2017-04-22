<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Nueva Asistencia</title>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
  </head>
  <body>
    <?php
      session_start();

      if ($_SESSION['TIPO_USUARIO']==NULL) {
        header ("Location: ../usuarios/index.html");
      }

      if (!isset($_POST["evento"])) : ?>

      <?php

      include '../usuarios/conexion.php';

      $query2="SELECT eventos.NOMBRE, eventos.ID_EVENTO, lugar.LOCALIDAD FROM eventos join lugar on eventos.ID_LUGAR = lugar.ID_LUGAR";
      $resultado = $connection->query($query2);

      $query3="SELECT NOMBRE, ID_ARTISTA FROM artista";
      $resultado2 = $connection->query($query3);

       ?>

       <br><br><br>

       <div class="container">
       <div class="col-md-offset-4 col-md-4">

        <form method="post">
          <fieldset>
            <legend>Nueva Asistencia</legend>

            <span>Eventos</span>
            <select class="form-control" id="evento" name="evento" class = "evento" required>
              <?php
              while ( $row = $resultado->fetch_array() )
              {
                ?>
                <option value="<?php echo $row['ID_EVENTO']?>">
                  <?php echo $row['NOMBRE']." - ".$row['LOCALIDAD'] ; ?>
                </option>

                <?php
                }
                ?>
            </select><br><br>

            <span>Artistas</span>
            <select class="form-control" id="artista" name="artista" class = "artista" required>
              <?php
              while ( $row2 = $resultado2->fetch_array() )
              {
                ?>
                <option value="<?php echo $row2['ID_ARTISTA']?>">
                  <?php echo $row2['NOMBRE']; ?>
                </option>

                <?php
                }
                ?>
            </select><br><br><br>

            <div class="col-md-offset-3 col-md-10">
	          <input class="btn btn-primary" type="submit" value="Crear" name="send">
            <a class="btn btn-primary" href="editar_asiste.php" role="button">Cancelar</a>
            </div>

	         </fieldset>
         <?php else: ?>

          <?php

          include '../usuarios/conexion.php';

          if (isset($_POST['send'])) {

            $evento=$_POST['evento'];
            $artista=$_POST['artista'];


              $query= "INSERT INTO asiste(`ID_EVENTO`,`ID_ARTISTA`)
              VALUES('$evento','$artista')";


              $result = $connection->query($query);
              // var_dump($result);

              if ($result) {
                echo '<br>';
                echo "<h3 class='text-center'>Nueva Asistencia Creada</h3>";
                echo '<META HTTP-EQUIV="Refresh" CONTENT="2; URL=editar_asiste.php">';
              }

              if (!$result) {
                echo '<br>';
                echo "<h3 class='text-center'>Error al añadir la nueva Asistencia, inténtelo de nuevo.</h3>";
                var_dump($query);
                echo '<META HTTP-EQUIV="Refresh" CONTENT="10; URL=crear_asistencia.php">';
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
