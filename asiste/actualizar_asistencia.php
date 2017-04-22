<!DOCTYPE html>
<html lang="">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Asistencia</title>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    </head>
    <body>

      <?php

      session_start();

      if ($_SESSION['TIPO_USUARIO']==NULL) {
        header ("Location: ../usuarios/index.html");
      }

      $id = $_GET['id'];
      $id2 = $_GET['id2'];

        include '../usuarios/conexion.php';

        $query2="SELECT NOMBRE, ID_EVENTO FROM eventos";
        $resultado = $connection->query($query2);

        $query3="SELECT NOMBRE, ID_ARTISTA FROM artista";
        $resultado2 = $connection->query($query3);

      if ($result = $connection->query("SELECT * from eventos
        where ID_EVENTO = '$id';")) {
        $obj = $result->fetch_object();

        echo "<br><br><br>";

        echo "<div class='container-fluid'>";
        echo "<div class='col-md-offset-4 col-md-3'>";

        echo "<form method='post'>";

        ?>

        <fieldset>
          <legend>Nueva Asistencia</legend>
          <br>

          <span>Eventos</span>
          <select id="evento" name="evento" class = "evento" required>
            <?php
            while ( $row = $resultado->fetch_array() )
            {
              ?>
              <option value="<?php echo $row['ID_EVENTO']?>">
                <?php echo $row['NOMBRE']; ?>
              </option>

              <?php
              }
              ?>
          </select>

          <br><br><br><br>

          <span>Artistas</span>
          <br>
          <select id="artista" name="artista" class = "artista" required>
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
          </select><br><br>
        </fieldset>

        <?php
        echo "<br><br>";

        ?>

        <div class="col-md-offset-2 col-md-10">
        <input class="btn btn-primary" type='submit' name='send' value='Actualizar'>
        <a class="btn btn-primary" href="editar_asiste.php" role="button">Cancelar</a>
        </div>

        <?php
        echo "</form>";
      } else {

            echo "Error: " . $result . "<br>" . mysqli_error($connection);
      }

      unset($obj);

      if (isset($_POST['send'])) {

        var_dump($_POST);

        //variables
        $evento=$_POST['evento'];
        $artista=$_POST['artista'];

      $query="UPDATE `asiste` SET  `ID_EVENTO` = '$evento', `ID_ARTISTA` = '$artista'
      WHERE `asiste`.`ID_EVENTO` = '$id' and `asiste`.`ID_ARTISTA` = '$id2'";

        if ($result = $connection->query($query))
           {
            header ("Location: ./editar_asiste.php");
        } else {

              echo "Error: " . $result . "<br>" . mysqli_error($connection);
        }
      }
      unset($connection);
      ?>

    </div>
    </div>


      <script src="../js/jquery.js"></script>
      <script src="../js/bootstrap.min.js"></script>
    </body>
</html>
