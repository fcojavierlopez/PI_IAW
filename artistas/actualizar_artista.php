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

      include '../usuarios/conexion.php';

      if (!isset($_POST["nombre"])){

      $id = $_GET['id'];



      if ($result = $connection->query("SELECT * from artista
        where ID_ARTISTA = '$id';")) {
        $obj = $result->fetch_object();

        echo "<br>";

        echo "<div class='container-fluid'>";
        echo "<div class='col-md-offset-4 col-md-3'>";

        echo "<form action='actualizar_artista.php' method='post' enctype='multipart/form-data'>";

        echo "<legend class='text-center'>Actualizar Artista</legend>";
        echo "<span>ID Artista</span><input name='idartista' class='form-control' value='$obj->ID_ARTISTA' required \><br>";
        echo "<span>Nombre</span><input name='nombre' class='form-control' value='$obj->NOMBRE' required \><br>";
        echo "<span>Genero</span><input name='genero' class='form-control' value='$obj->GENERO' required \><br>";
        echo "<span>Descripcion</span><input name='descripcion' class='form-control' type='textarea' value='$obj->DESCRIPCION' \><br>";
        echo "<span>Imagen</span><input class='form-control' type='file' name='imagen' value='$obj->IMAGEN' \><br>";
        echo "<span>Enlace</span><input name='enlace' class='form-control' type='text' value='$obj->URL' \><br>";
        // Para que la información del GET no se pierda a la hora de enviar el formulario hacemos un type hidden.
        echo "<input type='hidden' name='id' value='".$_GET['id']."'>";

        ?>

          <div class='col-md-offset-2 col-md-10'>
            <input type='submit' class='btn btn-primary' name='send' value='Actualizar'>
            <a class="btn btn-primary" href="editar_artista.php" role="button">Cancelar</a>
          </form>
          </div>



      <?php
      } else {

          echo "Error: " . $result . "<br>" . mysqli_error($connection);
    }
        }

      unset($obj);

      if (isset($_POST['send'])) {



        var_dump($_POST);

        //variables
        $idartista=$_POST['idartista'];
        $nombre=$_POST['nombre'];
        $genero=$_POST['genero'];
        $descripcion=$_POST['descripcion'];
        $enlace=$_POST['enlace'];

        var_dump($_FILES);

        // var_dump($_FILES);
        //Temp file. Where the uploaded file is stored temporary
        $tmp_file = $_FILES['imagen']['tmp_name'];
        //Dir where we are going to store the file
        $target_dir = "../img/img_artistas/";
        //Full name of the file.
        $target_file = strtolower($target_dir . basename($_FILES['imagen']['name']));
        //Can we upload the file
        $valid= true;
        //Check if the file already exists
        if (file_exists($target_file)) {
          echo "Sorry, file already exists.";
          $valid = false;
        }
        //Check the size of the file. Up to 2Mb
        if ($_FILES['imagen']['size'] > (2048000)) {
          $valid = false;
          echo 'Oops!  Your file\'s size is to large.';
        }
        //Check the file extension: We need an image not any other different type of file
        $file_extension = pathinfo($target_file, PATHINFO_EXTENSION); // We get the entension
        if ($file_extension!="jpg" && $file_extension!="jpeg" && $file_extension!="png" && $file_extension!="gif") {
          $valid = false;
          echo "Only JPG, JPEG, PNG & GIF files are allowed";
        }

        if ($valid) {
          var_dump($target_file);
          //Put the file in its place
          move_uploaded_file($tmp_file, $target_file);

          $id2=$_POST['id'];

      $query="UPDATE `artista` SET  `ID_ARTISTA` = '$idartista', `NOMBRE` = '$nombre', `GENERO`= '$genero', `DESCRIPCION`= '$descripcion',`IMAGEN`='".$_FILES['imagen']['name']."', `URL`= '$enlace'
      WHERE `artista`.`ID_ARTISTA` = '$id2'";

      var_dump($query);

        if ($result = $connection->query($query))
           {
            header ("Location: ./editar_artista.php");
        } else {

              echo "Error: " . $result . "<br>" . mysqli_error($connection);
        }
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
