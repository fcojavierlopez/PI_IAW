<!DOCTYPE html>
<html lang="">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Compras</title>
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
      $id2 = $_GET["id2"];

        include '../usuarios/conexion.php';

        $query2="SELECT NOMBRE, ID_EVENTO FROM eventos";
        $resultado = $connection->query($query2);


      if ($result = $connection->query("SELECT * from compra
        where CORREO_ELECTRONICO = '$id' and ID_EVENTO ='$id2'")) {

        $obj = $result->fetch_object();

        echo "<br><br>";


        echo "<div class='container-fluid'>";
        echo "<div class='col-md-offset-4 col-md-3'>";

        echo "<form method='post'>";

        echo "<legend>Actualizar Compras</legend>";
        echo "<span>Email</span><input class='form-control' name='email' value='$obj->CORREO_ELECTRONICO' required \><br><br>";
        ?>

        <span>Evento</span>

        <select class='form-control' id="evento" name="evento" class = "evento" required>
          <?php
          while ( $row = $resultado->fetch_array() )
          {
          ?>
            <option value="<?php echo $row['ID_EVENTO']?>">
              <?php
              echo $row['NOMBRE'];
            echo "</option>";
            }

        echo "</select><br><br>";
        echo "Numero Entradas <input class='form-control' name='numentradas' value='$obj->NUMERO_ENTRADAS' required \><br>";

        echo "<br><br>";

        ?>

        <div class="col-md-offset-2 col-md-10">
        <input class="btn btn-primary" type='submit' name='send' value='Actualizar'>
        <a class="btn btn-primary" href="editar_compra.php" role="button">Cancelar</a>
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
        $email=$_POST['email'];
        $evento=$_POST['evento'];
        $numentradas=$_POST['numentradas'];

      $query="UPDATE `compra` SET  `CORREO_ELECTRONICO` = '$email', `ID_EVENTO` = '$evento', `NUMERO_ENTRADAS`= '$numentradas'
      WHERE `compra`.`CORREO_ELECTRONICO` = '$id' and `compra`.`ID_EVENTO` = '$id2'";

        if ($result = $connection->query($query))
           {
            header ("Location: ./editar_compra.php");
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
