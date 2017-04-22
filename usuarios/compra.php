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

      $idartista=$_GET['id'];
      $mail=$_SESSION['CORREO_ELECTRONICO'];

      $query="SELECT eventos.URL, eventos.ID_EVENTO FROM eventos join asiste on eventos.ID_EVENTO = asiste.ID_EVENTO WHERE asiste.ID_ARTISTA='$idartista'";

      $query3="SELECT eventos.ID_EVENTO FROM eventos JOIN asiste ON eventos.ID_EVENTO = asiste.ID_EVENTO where asiste.ID_ARTISTA='$idartista'";



      if ($result = $connection->query($query)){
        $objeto = $result->fetch_object();

        $resultado = $connection->query($query3);

        $id_evento = $objeto->ID_EVENTO;
        $query2="INSERT INTO `compra`(`CORREO_ELECTRONICO`, `ID_EVENTO`) VALUES ('$mail','$id_evento')";


        $resultado = $connection->query($query2);
          header ("Location:$objeto->URL");

    }



    ?>

  </body>
</html>
