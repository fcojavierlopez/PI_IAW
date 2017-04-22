<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Nuevo Evento</title>
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

      <?php
      
      include '../usuarios/conexion.php';

      $query2="SELECT ID_LUGAR, LOCALIDAD, PROVINCIA FROM lugar";

      $result = $connection->query($query2);

       ?>
       <div class="container">
       <div class="col-md-offset-4 col-md-4">
         <br>
        <form method="post">
          <fieldset>
            <legend>Nuevo Evento</legend>
            <span>Nombre </span><input class="form-control" type="text" name="nombre" ><br>
            <span>Tipo </span><input class="form-control" type="text" name="tipo" ><br>
            <span>Precio </span><input class="form-control" type="text" name="precio"><br>
            <span>URL </span><input class="form-control" type="text" name="enlace"><br>
            <span>Fecha Inicio </span><input class="form-control" type="date" name="fi"><br>
            <span>Fecha Fin </span><input class="form-control" type="date" name="ff"><br>
            <span>Localidad</span>
            <select class="form-control" id="lugar" name="lugar" class = "lugar" required>
              <?php
              while ( $row = $result->fetch_array() )
              {
                ?>
                <option value="<?php echo $row['ID_LUGAR']?>">
                  <?php echo $row['LOCALIDAD'].' - '.$row['PROVINCIA']; ?>
                </option>

                <?php
                }
                ?>
            </select>

            <br>
            <div class="col-md-offset-3 col-md-10">
	          <input class="btn btn-primary" type="submit" value="Añadir" name="send">
            <a class="btn btn-primary" href="editar_eventos.php" role="button">Cancelar</a>
            </div>
	         </fieldset>
         <?php else: ?>
         <?php
           $connection = new mysqli('localhost', 'administrador', '2asirtriana', 'ventaentradas');

           //comprobación de errores
           if ($connection->connect_error) {
            die("Error de conexión: ". $connection->connect_error);
           }
          ?>
          <?php

          if (isset($_POST['send'])) {

            $nombre=$_POST['nombre'];
            $tipo=$_POST['tipo'];
            $precio=$_POST['precio'];
            $enlace=$_POST['enlace'];
            $fi=$_POST['fi'];
            $ff=$_POST['ff'];
            $idlugar=$_POST['lugar'];



              $query= "INSERT INTO eventos(`NOMBRE`,`TIPO`,`PRECIO`,`URL`,`FECHA_INICIO`,`FECHA_FIN`,`ID_LUGAR`)
              VALUES('$nombre','$tipo','$precio','$enlace','$fi','$ff','$idlugar')";


              $result = $connection->query($query);
              // var_dump($result);

              if ($result) {
                echo "<br>";
                echo "<h3 class='text-center'>Evento añadido</h3>";
                echo '<br>';
                echo '<META HTTP-EQUIV="Refresh" CONTENT="3; URL=editar_eventos.php">';
              }

              if (!$result) {
                echo "Error al añadir el nuevo evento, inténtelo de nuevo.";
                var_dump($query);
                echo '<br>';
                echo '<META HTTP-EQUIV="Refresh" CONTENT="10; URL=crear_evento.php">';
              }

            }

           ?>

          <?php endif ?>

    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.min.js"></script>
  </body>

</html>
