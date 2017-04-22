<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Artista Nuevo</title>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">

  </head>
  <body>
    <?php
      session_start();

      if ($_SESSION['TIPO_USUARIO']==NULL) {
        header ("Location: ../usuarios/index.html");
      }

      if (!isset($_POST["nombre"])) : ?>
      <br>

      <div class="container">
        <div class="col-md-offset-4 col-md-4">
          <form action="crear_artista.php" method="post" enctype="multipart/form-data">
            <fieldset>
              <legend>Nuevo Artista</legend>
              <br>
              <span>Nombre </span><input class="form-control" type="text" name="nombre" ><br>
              <span>Genero </span><input class="form-control" type="text" name="genero" ><br>
              <span>Descripción </span><textarea class="form-control" type="text" name="descripcion" required></textarea><br>
              <span>Imagen</span><input class="form-control" type="file" name="imagen" /><br>
              <span>Enlace </span><input class="form-control" type="text" name="enlace" required><br><br>

              <div class="col-md-offset-3 col-md-8">
	             <input class="btn btn-primary" type="submit" value="Añadir" name="send">
               <a class="btn btn-primary" href="editar_artista.php" role="button">Cancelar</a>
              </div>
	            </fieldset>
          </form>
        </div>
      </div>
         <?php else: ?>
         <?php

        //var_dump($_FILES);
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
          //  var_dump($target_file);
           //Put the file in its place
           move_uploaded_file($tmp_file, $target_file);

          include '../usuarios/conexion.php';

          ?>

          <?php

          if (isset($_POST['send'])) {

            $nombre=$_POST['nombre'];
            $genero=$_POST['genero'];
            $descripcion=$_POST['descripcion'];
            $enlace=$_POST['enlace'];



              $query= "INSERT INTO artista (`NOMBRE`,`GENERO`,`DESCRIPCION`,`IMAGEN`,`URL`)
              VALUES('$nombre','$genero','$descripcion','".$_FILES['imagen']['name']."','$enlace')";
              //  var_dump($query);

              $result = $connection->query($query);
              // var_dump($result);
              if ($result) {

                echo "<br>";
                echo "<h3 class='text-center'>Nuevo Artista añadido</h3>";
                echo "<META HTTP-EQUIV='Refresh' CONTENT='3; URL=editar_artista.php'>";
              }

              if (!$result) {

                echo "<br>";
                echo "<h3 class='text-center'>Error al añadir nuevo artista, inténtelo de nuevo.</h3>";
                // echo "<META HTTP-EQUIV='Refresh' CONTENT='5; URL=editar_artista.php'>";
              }

            }
          }
           ?>

          <?php endif ?>

    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.min.js"></script>
  </body>

</html>
