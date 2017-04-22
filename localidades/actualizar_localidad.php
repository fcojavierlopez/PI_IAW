<!DOCTYPE html>
<html lang="">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Artista</title>
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

      if ($result = $connection->query("SELECT * from lugar
        where ID_LUGAR = '$id';")) {
        $obj = $result->fetch_object();

        echo "<br>";

        echo "<div class='container-fluid'>";
        echo "<div class='col-md-offset-4 col-md-3'>";

        echo "<form method='post'>";

        echo "<legend>Actualizar localidad</legend>";
        echo "ID Localidad <input class='form-control' name='idlugar' value='$obj->ID_LUGAR' required \><br>";
        echo "Localidad <input class='form-control' name='localidad' value='$obj->LOCALIDAD' required \><br>";
        echo "Provincia <input class='form-control' name='provincia' value='$obj->PROVINCIA' required \><br>";
        echo "País <input class='form-control' name='pais' type='text' value='$obj->PAIS' \><br>";
        echo "Latitud <input class='form-control' name='latitud' type='text' value='$obj->LATITUD' \><br>";
        echo "Longitud <input class='form-control' name='longitud' type='text' value='$obj->LONGITUD' \><br>";
        ?>

        <div class="col-md-offset-2 col-md-10">
        <input class='btn btn-primary' type='submit' name='send' value='Actualizar'>
        <a class='btn btn-primary' href='editar_localidades.php' role='button'>Cancelar</a>
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
        $idlugar=$_POST['idlugar'];
        $localidad=$_POST['localidad'];
        $provincia=$_POST['provincia'];
        $pais=$_POST['pais'];
        $latitud=$_POST['latitud'];
        $longitud=$_POST['longitud'];

      $query="UPDATE `lugar` SET  `ID_LUGAR` = '$idlugar', `LOCALIDAD` = '$localidad', `PROVINCIA`= '$provincia', `PAIS`= '$pais', `LATITUD`= '$latitud', `LONGITUD`= '$longitud'
      WHERE `lugar`.`ID_LUGAR` = '$id'";

        if ($result = $connection->query($query))
           {
            header ("Location: ./editar_localidades.php");
        } else {

              echo "Error: " . $result . "<br>" . mysqli_error($connection);
        }
      }
      unset($connection);
      ?>

      <div>
      <div>

      <script src="../js/jquery.js"></script>
      <script src="../js/bootstrap.min.js"></script>
    </body>
</html>
