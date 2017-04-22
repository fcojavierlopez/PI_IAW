<!DOCTYPE html>
<html lang="">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Evento</title>
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

        include '../usuarios/conexion.php';

        $query2="SELECT ID_LUGAR, LOCALIDAD, PROVINCIA FROM lugar";

        $resultado = $connection->query($query2);

      if ($result = $connection->query("SELECT * from eventos
        where ID_EVENTO = '$id';")) {
        $obj = $result->fetch_object();
        echo "<br>";

        echo "<div class='container-fluid'>";
        echo "<div class='col-md-offset-4 col-md-3'>";

        echo "<form method='post'>";
        echo "<legend>Actualizar Evento</legend>";
        echo "ID <input class='form-control' name='idevento' value='$obj->ID_EVENTO' required \><br>";
        echo "Nombre <input class='form-control' name='nombre' value='$obj->NOMBRE' required \><br>";
        echo "Tipo <input class='form-control' name='tipo' value='$obj->TIPO' required \><br>";
        echo "Precio <input class='form-control' name='precio' type='text' value='$obj->PRECIO' \><br>";
        echo "Enlace <input class='form-control' name='enlace' type='text' value='$obj->URL' \><br>";
        echo "Fecha Inicio <input class='form-control' name='fi' type='text' value='$obj->FECHA_INICIO' \><br>";
        echo "Fecha Fin <input class='form-control' name='ff' type='text' value='$obj->FECHA_FIN' \><br>";

        echo "<span>Localidad</span>";
        ?>
        <select class='form-control' id="lugar" name="lugar" class = "lugar" required>
          <?php
          while ( $row = $resultado->fetch_array() )
          {
          ?>
            <option value="<?php echo $row['ID_LUGAR']?>">
              <?php
              echo $row['LOCALIDAD'].' - '.$row['PROVINCIA'];
            echo "</option>";
            }

        echo "</select>";


        echo "<br><br>";

        ?>

        <div class="col-md-offset-2 col-md-10">

          <input class="btn btn-primary" type='submit' name='send' value='Actualizar'>
          <a class="btn btn-primary" href="editar_eventos.php" role="button">Cancelar</a>
        </div>

        </form>
          </div>
        </div>
        <br>
        <?php

        echo "</from>";
      } else {

            echo "Error: " . $result . "<br>" . mysqli_error($connection);
      }

      unset($obj);

      if (isset($_POST['send'])) {

        var_dump($_POST);

        //variables
        $idevento=$_POST['idevento'];
        $nombre=$_POST['nombre'];
        $tipo=$_POST['tipo'];
        $precio=$_POST['precio'];
        $enlace=$_POST['enlace'];
        $fi=$_POST['fi'];
        $ff=$_POST['ff'];
        $idlugar=$_POST['lugar'];

      $query="UPDATE `eventos` SET  `ID_EVENTO` = '$idevento', `NOMBRE` = '$nombre', `TIPO`= '$tipo', `PRECIO`= '$precio', `URL`= '$enlace', `FECHA_INICIO`= '$fi', `FECHA_FIN`= '$ff', `ID_LUGAR`= '$idlugar'
      WHERE `eventos`.`ID_EVENTO` = '$id'";

        if ($result = $connection->query($query))
           {
            header ("Location: ./editar_eventos.php");
        } else {

              echo "Error: " . $result . "<br>" . mysqli_error($connection);
        }
      }
      unset($connection);
      ?>

      <script src="../js/jquery.js"></script>
      <script src="../js/bootstrap.min.js"></script>
    </body>
</html>
