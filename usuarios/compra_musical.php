<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>

    <?php
      session_start();

       if ($_SESSION['TIPO_USUARIO']==NULL) {
         header ("Location: index.html");
       }

      include 'conexion.php';

      $id=$_GET['id'];
      $mail=$_SESSION['CORREO_ELECTRONICO'];

      $query="SELECT URL, ID_EVENTO FROM eventos WHERE ID_EVENTO ='$id'";
      $query2="INSERT INTO `compra`(`CORREO_ELECTRONICO`, `ID_EVENTO`) VALUES ('$mail','$id')";



      if ($result = $connection->query($query)){
        $objeto = $result->fetch_object();

        $resultado = $connection->query($query2);
         header ("Location:$objeto->URL");

    }



    ?>

  </body>
</html>
